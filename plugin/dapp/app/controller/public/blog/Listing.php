<?php

namespace plugin\dapp\app\controller\public\blog;

# library
use plugin\dapp\app\controller\Base;
use support\Request;
# database & logic
use plugin\dapp\app\model\logic\UserProfileLogic;
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
        "user" => "",
        "trending" => "require|in:1,0",
    ];

    # [inputs-pattern]
    protected $patternInputs = [
        "user",
        "trending",
    ];

    # [outputs-pattern]
    protected $patternOutputs = [
        "sn",
        "user",
        "main_image",
        "title",
        "tag",
        "views",
        "created_at",
        "time_passed"
    ];

    public function index(Request $request)
    {
        # [validation]
        $this->validation($request->get(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->get(), $this->patternInputs);

        # [proceed]
        if (!count($this->error)) {
            $cleanVars[] = ["removed_at", null];
            $approved = SettingLogic::get("operator", ["code" => "approved"]);
            $cleanVars["status"] = $approved["id"];

            # [search join table columns]
            if (isset($cleanVars["user"])) {
                // 4 in 1 search
                $user = UserProfileLogic::multiSearch($cleanVars["user"]);
                $cleanVars["uid"] = $user["id"] ?? 0;
            }

            // trending
            $order = "id";
            if (isset($cleanVars["trending"]) && $cleanVars["trending"]) {
                $order = "views";
            }

            # [unset key]
            unset($cleanVars["user"]);
            unset($cleanVars["trending"]);

            # [paging query]
            $res = UserBlogModel::paging(
                $cleanVars,
                $request->get("page"),
                $request->get("size"),
                ["*"],
                [$order, "desc"]
            );

            if ($res) {
                # [add and edit column using for loop]
                foreach ($res["items"] as $row) {
                    $user = AccountUserModel::where("id", $row["uid"])->first();
                    if ($user) {
                        $row["user"] = $user["nickname"] ?? $user["user_id"];
                    }

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
