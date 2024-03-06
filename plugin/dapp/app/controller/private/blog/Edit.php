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
use app\model\logic\SettingLogic;

class Edit extends Base
{
    # [validation-rule]
    protected $rule = [
        "sn" => "require",
        "main_image" => "max:500",
        "image" => "max:2000",
        "title" => "require",
        "summary" => "max:150",
        "content" => "require|max:50000",
        "tag" => "max:100",
    ];

    # [inputs-pattern]
    protected $patternInputs = [
        "sn",
        "main_image",
        "image",
        "title",
        "summary",
        "content",
        "tag",
    ];

    public function index(Request $request)
    {
        # [validation]
        $this->validation($request->post(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->post(), $this->patternInputs, 1);

        # user id
        $cleanVars["uid"] = $request->visitor["id"];

        # [checking]
        $this->checking($cleanVars);

        # [proceed]
        if (!count($this->error) && ($this->successTotalCount == $this->successPassedCount)) {
            $res = "";

            # [process]
            if (count($cleanVars) > 0) {
                if (!empty($cleanVars["image"])) {
                    $cleanVars["image"] = HelperLogic::explodeParams($cleanVars["image"]);
                    $cleanVars["image"] = json_encode($cleanVars["image"]);
                }

                if (!empty($cleanVars["tag"])) {
                    $cleanVars["tag"] = HelperLogic::explodeParams($cleanVars["tag"]);
                    $cleanVars["tag"] = json_encode($cleanVars["tag"]);
                }

                $sn = $cleanVars["sn"];
                unset($cleanVars["uid"]);
                unset($cleanVars["sn"]);

                $pending = SettingLogic::get("operator", ["code" => "pending"]);
                $cleanVars["status"] = $pending["id"];
                $res = UserBlogModel::defaultWhere()->where(["sn" => $sn])->update($cleanVars);
            }

            # [result]
            if ($res) {
                LogUserModel::log($request, "blog_edit");
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
