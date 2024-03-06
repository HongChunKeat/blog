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

class Listing extends Base
{
    # [validation-rule]
    protected $rule = [
        "size" => "require|number",
        "page" => "require|number",
        "status" => "",
    ];

    # [inputs-pattern]
    protected $patternInputs = [
        "status",
    ];

    # [outputs-pattern]
    protected $patternOutputs = [
        "sn",
        "user",
        "main_image",
        "title",
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
        $cleanVars = HelperLogic::cleanParams($request->get(), $this->patternInputs, 1);

        # user id
        $cleanVars["uid"] = $request->visitor["id"];

        # [proceed]
        if (!count($this->error)) {
            $cleanVars[] = ["removed_at", null];

            if (isset($cleanVars["status"])) {
                $status = SettingLogic::get("operator", ["code" => $cleanVars["status"]]);
                $cleanVars["status"] = $status["id"] ?? 0;
            }

            # [paging query]
            $res = UserBlogModel::paging(
                $cleanVars,
                $request->get("page"),
                $request->get("size"),
                ["*"],
                ["id", "desc"]
            );

            if ($res) {
                # [add and edit column using for loop]
                foreach ($res["items"] as $row) {
                    $user = AccountUserModel::where("id", $row["uid"])->first();
                    if ($user) {
                        $row["user"] = $user["nickname"] ?? $user["user_id"];
                    }

                    $status = SettingLogic::get("operator", ["id" => $row["status"]]);
                    $row["status"] = $status ? $status["code"] : "";

                    if (isset($row["tag"])) {
                        $row["tag"] = json_decode($row["tag"]);
                    }

                    $row["time_passed"] = (time() - strtotime($row["updated_at"])) . "000";
                }

                $this->response = [
                    "success" => true,
                    "data" => [
                        "data" => HelperLogic::formatOutput($res["items"], $this->patternOutputs, 1),
                        "count" => $res["count"],
                        "last_page" => ceil($res["count"] / $request->get("size")),
                    ],
                ];
            }
        }

        # [standard output]
        return $this->output();
    }
}
