<?php

namespace plugin\dapp\app\controller\private\blog;

# library
use plugin\dapp\app\controller\Base;
use support\Request;
# database & logic
use app\model\database\LogUserModel;
use app\model\database\AccountUserModel;
use app\model\database\UserBlogModel;
use app\model\logic\HelperLogic;

class Delete extends Base
{
    # [validation-rule]
    protected $rule = [
        "sn" => "require",
    ];

    # [inputs-pattern]
    protected $patternInputs = [
        "sn",
    ];

    public function index(Request $request)
    {
        # [validation]
        $this->validation($request->post(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->post(), $this->patternInputs);

        # user id
        $cleanVars["uid"] = $request->visitor["id"];

        # [checking]
        $this->checking($cleanVars);

        # [proceed]
        if (!count($this->error) && ($this->successTotalCount == $this->successPassedCount)) {
            $res = "";

            # [process]
            if (count($cleanVars) > 0) {
                $res = UserBlogModel::defaultWhere()->where(["sn" => $cleanVars["sn"]])->update([
                    "removed_at" => date("Y-m-d H:i:s")
                ]);
            }

            # [result]
            if ($res) {
                LogUserModel::log($request, "blog_delete");
                $this->response = [
                    "success" => true,
                ];
            }
        }

        # [standard output]
        return $this->output();
    }

    private function checking(array $params = [])
    {
        # [init success condition]
        $this->successTotalCount = 2;

        # [condition]
        if (isset($params["uid"])) {
            $user = AccountUserModel::where(["id" => $params["uid"], "status" => "active"])->first();
            if (!$user) {
                $this->error[] = "user:missing";
            } else {
                $this->successPassedCount++;
                if (isset($params["sn"])) {
                    if (!UserBlogModel::defaultWhere()->where(["uid" => $params["uid"], "sn" => $params["sn"]])->first()) {
                        $this->error[] = "blog:not_found";
                    } else {
                        $this->successPassedCount++;
                    }
                }
            }
        }
    }
}
