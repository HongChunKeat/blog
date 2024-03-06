<?php

namespace app\model\logic;

use app\model\database\SettingGeneralModel;
use app\model\database\SettingLangModel;
use app\model\database\SettingOperatorModel;

class SettingLogic
{
    public static function get(string $table = "", array $params = [], bool $list = false)
    {
        $_response = false;

        switch ($table) {
            case "general":
                $_response = SettingGeneralModel::where($params)->where("is_show", 1);
                break;
            case "lang":
                $_response = SettingLangModel::where($params);
                break;
            case "operator":
                $_response = SettingOperatorModel::where($params);
                break;
        }

        if ($list) {
            $_response = $_response->get();
        } else {
            $_response = $_response->first();
        }

        return $_response;
    }
}
