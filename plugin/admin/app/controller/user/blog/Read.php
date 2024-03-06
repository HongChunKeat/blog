<?php

namespace plugin\admin\app\controller\user\blog;

# library
use plugin\admin\app\controller\Base;
use support\Request;
# database & logic
use app\model\database\AccountUserModel;
use app\model\database\SettingOperatorModel;
use app\model\database\UserBlogModel;
use app\model\logic\HelperLogic;

class Read extends Base
{
    # [outputs-pattern]
    protected $patternOutputs = [
        "id",
        "sn",
        "created_at",
        "updated_at",
        "removed_at",
        "uid",
        "user",
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
        # [process]
        $res = UserBlogModel::where("id", $targetId)->first();

        # [result]
        if ($res) {
            $user = AccountUserModel::where("id", $res["uid"])->first();
            $res["user"] = $user ? $user["user_id"] : "";

            $status = SettingOperatorModel::where("id", $res["status"])->first();
            $res["status"] = $status ? $status["code"] : "";

            if (isset($res["image"])) {
                $res["image"] = json_decode($res["image"]);
            }

            if (isset($res["tag"])) {
                $res["tag"] = json_decode($res["tag"]);
            }

            $this->response = [
                "success" => true,
                "data" => HelperLogic::formatOutput($res, $this->patternOutputs),
            ];
        }

        # [standard output]
        return $this->output();
    }
}
