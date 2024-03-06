<?php

namespace plugin\admin\app\controller\user\blog;

# library
use plugin\admin\app\controller\Base;
use support\Request;
# database & logic
use app\model\database\LogAdminModel;
use app\model\database\UserBlogModel;
use app\model\database\AccountUserModel;
use app\model\database\SettingOperatorModel;
use app\model\logic\HelperLogic;

class Update extends Base
{
    # [validation-rule]
    protected $rule = [
        "uid" => "number|max:11",
        "main_image" => "max:500",
        "image" => "max:2000",
        "title" => "",
        "summary" => "max:150",
        "content" => "max:50000",
        "tag" => "max:100",
        "status" => "number|max:11",
        "views" => "number|egt:0|max:11",
        "remark" => "",
    ];

    # [inputs-pattern]
    protected $patternInputs = [
        "uid",
        "main_image",
        "image",
        "title",
        "summary",
        "content",
        "tag",
        "status",
        "views",
        "remark",
    ];

    public function index(Request $request, int $targetId = 0)
    {
        # [validation]
        $this->validation($request->post(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->post(), $this->patternInputs, 1);

        # [checking]
        $this->checking(["id" => $targetId] + $cleanVars);

        # [proceed]
        if (!count($this->error)) {
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

                $res = UserBlogModel::where("id", $targetId)->update($cleanVars);
            }

            # [result]
            if ($res) {
                LogAdminModel::log($request, "update", "user_blog", $targetId);
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
        # [condition]
        // check uid
        if (!empty($params["uid"])) {
            if (!AccountUserModel::where("id", $params["uid"])->first()) {
                $this->error[] = "uid:invalid";
            }
        }

        //check status
        if (!empty($params["status"])) {
            $statusList = SettingOperatorModel::where("category", "status")
                ->whereIn("code", ["pending", "approved", "rejected"])
                ->get()
                ->toArray();

            if (!in_array($params["status"], array_column($statusList, "id"))) {
                $this->error[] = "status:invalid";
            }
        }
    }
}
