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

class Create extends Base
{
    # [validation-rule]
    protected $rule = [
        "uid" => "require|number|max:11",
        "main_image" => "max:500",
        "image" => "max:2000",
        "title" => "require",
        "summary" => "max:150",
        "content" => "max:50000",
        "tag" => "max:100",
        "status" => "require|number|max:11",
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

    public function index(Request $request)
    {
        # [validation]
        $this->validation($request->post(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->post(), $this->patternInputs);

        # [checking]
        $this->checking($cleanVars);

        # [proceed]
        if (!count($this->error)) {
            $res = "";

            # [process]
            if (count($cleanVars) > 0) {
                if (isset($cleanVars["image"])) {
                    $cleanVars["image"] = HelperLogic::explodeParams($cleanVars["image"]);
                    $cleanVars["image"] = json_encode($cleanVars["image"]);
                }

                if (isset($cleanVars["tag"])) {
                    $cleanVars["tag"] = HelperLogic::explodeParams($cleanVars["tag"]);
                    $cleanVars["tag"] = json_encode($cleanVars["tag"]);
                }

                $cleanVars["sn"] = HelperLogic::generateUniqueSN("user_blog");
                $res = UserBlogModel::create($cleanVars);
            }

            # [result]
            if ($res) {
                LogAdminModel::log($request, "create", "user_blog", $res["id"]);
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
        if (isset($params["uid"])) {
            if (!AccountUserModel::where("id", $params["uid"])->first()) {
                $this->error[] = "uid:invalid";
            }
        }

        //check status
        if (isset($params["status"])) {
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
