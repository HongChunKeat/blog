<?php

namespace plugin\dapp\app\controller\user;

# library
use plugin\dapp\app\controller\Base;
use support\Request;
# database & logic
use app\model\database\AccountUserModel;
use app\model\logic\HelperLogic;

class GetProfile extends Base
{
    # [outputs-pattern]
    protected $patternOutputs = [
        "user_id",
        "avatar",
        "web3_address",
        "nickname",
        "login_id",
        "telegram",
        "discord",
        "twitter",
        "google",
    ];

    public function index(Request $request)
    {
        # user id
        $cleanVars["uid"] = $request->visitor["id"];

        $res = AccountUserModel::where("id", $cleanVars["uid"])->first();

        # [result]
        if ($res) {
            $res["telegram"] = $res["telegram_name"];
            $res["discord"] = $res["discord_name"];
            $res["twitter"] = $res["twitter_name"];
            $res["google"] = $res["google_name"];

            $this->response = [
                "success" => true,
                "data" => HelperLogic::formatOutput($res, $this->patternOutputs),
            ];
        }

        # [standard output]
        return $this->output();
    }
}
