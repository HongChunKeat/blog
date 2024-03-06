<?php

use Webman\Route;
use plugin\admin\app\controller as admin;

/**
 * 执行操作: 前端访客
 *    List = GET /tickets/list - 列出所有
 *    List = GET /tickets - 列出 paging
 *    Read = GET /tickets/{id} - 列出 id
 *    Create = POST /tickets - 创建
 *    Update = PUT /tickets/{id} - 更新信息
 *    UpdatePartial = PATCH /tickets/{id} - 部分修改, 例如修改状态
 *    Delete = DELETE /tickets/{id} - 删掉 9839 这张车票
 */ 

Route::group("/admin", function () {
    // global
    Route::group("/global", function () {
        Route::post("/redisFlush", [admin\GlobalController::class, "redisFlush"]);
        Route::post("/redis", [admin\GlobalController::class, "redis"]);
    });

    // auth
    Route::group("/auth", function () {
        Route::get("/request", [admin\auth\Ask::class, "index"]);
        Route::post("/verify", [admin\auth\Verify::class, "index"]);
        Route::post("/logout", [admin\auth\Logout::class, "index"])->middleware([
            plugin\admin\app\middleware\JwtAuthMiddleware::class,
        ]);
        Route::get("/rule", [admin\auth\Rule::class, "index"])->middleware([
            plugin\admin\app\middleware\JwtAuthMiddleware::class,
        ]);
    })->middleware([
        plugin\admin\app\middleware\MaintenanceMiddleware::class,
    ]);

    // enum list
    Route::group("/enumList", function () {
        Route::get("/list", [admin\enumList\Listing::class, "index"]);
    })->middleware([
        plugin\admin\app\middleware\JwtAuthMiddleware::class,
        plugin\admin\app\middleware\PermissionControlMiddleware::class,
        plugin\admin\app\middleware\MaintenanceMiddleware::class,
    ]);

    // account
    Route::group("/account", function () {
        Route::group("/admin", function () {
            Route::get("/list", [admin\account\admin\Listing::class, "index"]);
            Route::get("", [admin\account\admin\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\account\admin\Read::class, "index"]);
            Route::post("", [admin\account\admin\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\account\admin\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\account\admin\Delete::class, "index"]);
        });

        Route::group("/user", function () {
            Route::get("/list", [admin\account\user\Listing::class, "index"]);
            Route::get("", [admin\account\user\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\account\user\Read::class, "index"]);
            Route::post("", [admin\account\user\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\account\user\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\account\user\Delete::class, "index"]);
        });
    })->middleware([
        plugin\admin\app\middleware\JwtAuthMiddleware::class,
        plugin\admin\app\middleware\PermissionControlMiddleware::class,
        plugin\admin\app\middleware\MaintenanceMiddleware::class,
    ]);

    // log
    Route::group("/log", function () {
        Route::group("/admin", function () {
            Route::get("/list", [admin\log\admin\Listing::class, "index"]);
            Route::get("", [admin\log\admin\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\log\admin\Read::class, "index"]);
            Route::post("", [admin\log\admin\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\log\admin\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\log\admin\Delete::class, "index"]);
        });

        Route::group("/user", function () {
            Route::get("/list", [admin\log\user\Listing::class, "index"]);
            Route::get("", [admin\log\user\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\log\user\Read::class, "index"]);
            Route::post("", [admin\log\user\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\log\user\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\log\user\Delete::class, "index"]);
        });        
    })->middleware([
        plugin\admin\app\middleware\JwtAuthMiddleware::class,
        plugin\admin\app\middleware\PermissionControlMiddleware::class,
        plugin\admin\app\middleware\MaintenanceMiddleware::class,
    ]);

    // permission
    Route::group("/permission", function () {
        Route::group("/admin", function () {
            Route::get("/list", [admin\permission\admin\Listing::class, "index"]);
            Route::get("", [admin\permission\admin\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\permission\admin\Read::class, "index"]);
            Route::post("", [admin\permission\admin\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\permission\admin\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\permission\admin\Delete::class, "index"]);
        });

        Route::group("/template", function () {
            Route::get("/list", [admin\permission\template\Listing::class, "index"]);
            Route::get("", [admin\permission\template\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\permission\template\Read::class, "index"]);
            Route::post("", [admin\permission\template\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\permission\template\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\permission\template\Delete::class, "index"]);
        });

        Route::group("/warehouse", function () {
            Route::get("/list", [admin\permission\warehouse\Listing::class, "index"]);
            Route::get("", [admin\permission\warehouse\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\permission\warehouse\Read::class, "index"]);
            Route::post("", [admin\permission\warehouse\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\permission\warehouse\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\permission\warehouse\Delete::class, "index"]);
        });
    })->middleware([
        plugin\admin\app\middleware\JwtAuthMiddleware::class,
        plugin\admin\app\middleware\PermissionControlMiddleware::class,
        plugin\admin\app\middleware\MaintenanceMiddleware::class,
    ]);

    // setting
    Route::group("/setting", function () {
        Route::group("/general", function () {
            Route::get("/list", [admin\setting\general\Listing::class, "index"]);
            Route::get("/{id:\d+}", [admin\setting\general\Read::class, "index"]);
            Route::get("", [admin\setting\general\Paging::class, "index"]);
            Route::post("", [admin\setting\general\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\setting\general\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\setting\general\Delete::class, "index"]);
        });

        Route::group("/lang", function () {
            Route::get("/list", [admin\setting\lang\Listing::class, "index"]);
            Route::get("/{id:\d+}", [admin\setting\lang\Read::class, "index"]);
            Route::get("", [admin\setting\lang\Paging::class, "index"]);
            Route::post("", [admin\setting\lang\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\setting\lang\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\setting\lang\Delete::class, "index"]);
        });

        Route::group("/operator", function () {
            Route::get("/list", [admin\setting\operator\Listing::class, "index"]);
            Route::get("/{id:\d+}", [admin\setting\operator\Read::class, "index"]);
            Route::get("", [admin\setting\operator\Paging::class, "index"]);
            Route::post("", [admin\setting\operator\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\setting\operator\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\setting\operator\Delete::class, "index"]);
        });
    })->middleware([
        plugin\admin\app\middleware\JwtAuthMiddleware::class,
        plugin\admin\app\middleware\PermissionControlMiddleware::class,
        plugin\admin\app\middleware\MaintenanceMiddleware::class,
    ]);

    // user
    Route::group("/user", function () {
        Route::group("/blog", function () {
            Route::get("/list", [admin\user\blog\Listing::class, "index"]);
            Route::get("", [admin\user\blog\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\user\blog\Read::class, "index"]);
            Route::post("", [admin\user\blog\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\user\blog\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\user\blog\Delete::class, "index"]);
        });
    })->middleware([
        plugin\admin\app\middleware\JwtAuthMiddleware::class,
        plugin\admin\app\middleware\PermissionControlMiddleware::class,
        plugin\admin\app\middleware\MaintenanceMiddleware::class,
    ]);
});
