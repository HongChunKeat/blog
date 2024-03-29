<?php

namespace plugin\admin\app\controller\user\blog;

# library
use support\Request;
use plugin\admin\app\controller\Base;
# database & logic
use plugin\dapp\app\model\logic\UserProfileLogic;
use app\model\database\AccountUserModel;
use app\model\database\SettingOperatorModel;
use app\model\database\UserBlogModel;
use app\model\logic\HelperLogic;

class Paging extends Base
{
    # [validation-rule]
    protected $rule = [
        "size" => "require|number",
        "page" => "require|number",
        "id" => "number|max:11",
        "sn" => "",
        "uid" => "number|max:11",
        "user" => "",
        "main_image" => "max:500",
        "image" => "max:2000",
        "title" => "",
        "summary" => "max:150",
        "content" => "max:50000",
        "tag" => "max:100",
        "status" => "number|max:11",
        "views" => "number|egt:0|max:11",
        "remark" => "",
        "created_at_start" => "date",
        "created_at_end" => "date",
        "updated_at_start" => "date",
        "updated_at_end" => "date",
        "removed_at_start" => "date",
        "removed_at_end" => "date",
    ];

    # [inputs-pattern]
    protected $patternInputs = [
        "id",
        "sn",
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

    public function index(Request $request)
    {
        # [validation]
        $this->validation($request->get(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->get(), $this->patternInputs);

        # [proceed]
        if (!count($this->error)) {
            # [search join table columns]
            if (isset($cleanVars["user"])) {
                // 4 in 1 search
                $user = UserProfileLogic::multiSearch($cleanVars["user"]);
                $cleanVars["uid"] = $user["id"] ?? 0;
            }

            # [unset key]
            unset($cleanVars["user"]);

            # [search date range]
            $cleanVars = array_merge(
                $cleanVars,
                HelperLogic::buildDateSearch($request, ["created_at", "updated_at","removed_at"])
            );

            # [paging query]
            $res = UserBlogModel::paging(
                $cleanVars,
                $request->get("page"),
                $request->get("size"),
                ["*"],
                ["id", "desc"]
            );

            # [result]
            if ($res) {
                # [add and edit column using for loop]
                foreach ($res["items"] as $row) {
                    $user = AccountUserModel::where("id", $row["uid"])->first();
                    $row["user"] = $user ? $user["user_id"] : "";

                    $status = SettingOperatorModel::where("id", $row["status"])->first();
                    $row["status"] = $status ? $status["code"] : "";
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
