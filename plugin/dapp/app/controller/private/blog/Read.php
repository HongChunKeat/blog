<?php

namespace plugin\dapp\app\controller\private\blog;

# library
use plugin\dapp\app\controller\Base;
use support\Request;
# database & logic
use app\model\database\AccountUserModel;
use app\model\database\UserBlogModel;
use app\model\logic\HelperLogic;
use app\model\logic\SettingLogic;

class Read extends Base
{
    # [validation-rule]
    protected $rule = [
        "sn" => "require",
    ];

    # [inputs-pattern]
    protected $patternInputs = [
        "sn",
    ];

    # [outputs-pattern]
    protected $patternOutputs = [
        "user",
        "main_image",
        "image",
        "title",
        "summary",
        "content",
        "tag",
        "views",
        "status",
        "created_at",
        "time_passed"
    ];

    public function index(Request $request)
    {
        # [validation]
        $this->validation($request->get(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->get(), $this->patternInputs);

        # user id
        $cleanVars["uid"] = $request->visitor["id"];

        # [proceed]
        if (!count($this->error)) {
            $res = UserBlogModel::defaultWhere()->where($cleanVars)->first();

            if ($res) {
                $user = AccountUserModel::where("id", $res["uid"])->first();
                if ($user) {
                    $res["user"] = $user["nickname"] ?? $user["user_id"];
                }

                $status = SettingLogic::get("operator", ["id" => $res["status"]]);
                $res["status"] = $status ? $status["code"] : "";

                if (isset($res["image"])) {
                    $res["image"] = json_decode($res["image"]);
                }

                if (isset($res["tag"])) {
                    $res["tag"] = json_decode($res["tag"]);
                }

                $res["time_passed"] = (time() - strtotime($res["updated_at"])) . "000";

                $this->response = [
                    "success" => true,
                    "data" => HelperLogic::formatOutput($res, $this->patternOutputs),
                ];
            }
        }

        # [standard output]
        return $this->output();
    }
}
