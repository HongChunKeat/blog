<?php

namespace plugin\dapp\app\controller\public\user;

# library
use plugin\dapp\app\controller\Base;
use support\Request;
# database & logic
use app\model\database\AccountUserModel;
use app\model\logic\HelperLogic;

class GetProfile extends Base
{
    # [validation-rule]
    protected $rule = [
        "user" => "require",
    ];

    # [inputs-pattern]
    protected $patternInputs = [
        "user",
    ];

    # [outputs-pattern]
    protected $patternOutputs = [
        "user_id",
        "avatar",
        "intro",
        "web3_address",
        "nickname",
    ];

    public function index(Request $request)
    {
        # [validation]
        $this->validation($request->get(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->get(), $this->patternInputs);

        # [proceed]
        if (!count($this->error)) {
            $res = "";
            $res = AccountUserModel::where("user_id", $cleanVars["user"])->first();

            # [result]
            if ($res) {
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
