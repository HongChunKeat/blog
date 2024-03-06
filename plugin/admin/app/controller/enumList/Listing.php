<?php

namespace plugin\admin\app\controller\enumList;

# library
use support\Request;
use plugin\admin\app\controller\Base;
# database & logic
use app\model\database\SettingOperatorModel;
use app\model\database\SettingLangModel;
use app\model\database\PermissionTemplateModel;
use app\model\logic\HelperLogic;

class Listing extends Base
{
    # [validation-rule]
    protected $rule = [
        "type" => "require|max:80"
    ];

    # [inputs-pattern]
    protected $patternInputs = ["type"];

    public function index(Request $request)
    {
        # [validation]
        $this->validation($request->get(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->get(), $this->patternInputs);

        # [proceed]
        if (!count($this->error)) {
            $res = "";

            // filter by type
            switch ($cleanVars["type"]) {
                case "yes_no":
                    $res = [
                        "1" => "yes",
                        "0" => "no",
                    ];
                    break;

                case "active_status":
                    $res = [
                        "1" => "active",
                        "0" => "inactive",
                    ];
                    break;

                case "account_status":
                    $res = [
                        "active" => "active",
                        "inactivated" => "inactivated",
                        "freezed" => "freezed",
                        "suspended" => "suspended"
                    ];
                    break;

                case "permission_action":
                    $res = [
                        "POST" => "POST",
                        "GET" => "GET",
                        "PUT" => "PUT",
                        "DELETE" => "DELETE",
                        "PATCH" => "PATCH",
                    ];
                    break;

                case "admin_role":
                    $res = [];
                    $settings = PermissionTemplateModel::select("id", "template_code")->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["template_code"];
                    }
                    break;

                case "operator_type":
                    $res = [];
                    $settings = SettingOperatorModel::select("id", "code")
                        ->where("category", "type")
                        ->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["code"];
                    }
                    break;

                case "lang":
                    $res = [];
                    $settings = SettingLangModel::select("id", "code")->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["code"];
                    }
                    break;

                default:
                    // handle default case if needed
                    break;
            }

            # [result]
            if ($res) {
                $this->response = [
                    "success" => true,
                    "data" => $res,
                ];
            }
        }

        # [standard output]
        return $this->output();
    }
}
