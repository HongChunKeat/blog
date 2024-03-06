<?php

namespace plugin\dapp\app\controller\public\blog;

# library
use plugin\dapp\app\controller\Base;
use support\Request;
use support\Db;
# database & logic
use app\model\database\UserBlogModel;
use app\model\database\LogUserModel;
use app\model\logic\HelperLogic;
use app\model\logic\SettingLogic;

class ViewCount extends Base
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

        # [checking]
        [$blog] = $this->checking($cleanVars);

        # [proceed]
        if (!count($this->error) && ($this->successTotalCount == $this->successPassedCount)) {
            $res = "";

            # [process]
            if (count($cleanVars) > 0) {
                $res = UserBlogModel::defaultWhere()->where(["id" => $blog["id"]])->update([
                    "views" => Db::raw("views + 1")
                ]);
            }

            # [result]
            if ($res) {
                LogUserModel::log($request, "blog_add_view_count", "user_blog", $blog["id"]);
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
        if (isset($params["sn"])) {
            $blog = UserBlogModel::defaultWhere()->where("sn", $params["sn"])->first();
            if (!$blog) {
                $this->error[] = "blog:not_found";
            } else {
                $this->successPassedCount++;

                $approved = SettingLogic::get("operator", ["code" => "approved"]);
                if ($blog["status"] != $approved["id"]) {
                    $this->error[] = "blog:invalid";
                } else {
                    $this->successPassedCount++;
                }
            }
        }

        return [$blog ?? 0];
    }
}
