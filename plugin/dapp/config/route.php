<?php

use Webman\Route;
use plugin\dapp\app\controller as dapp;

/**
 * 执行操作: 前端访客
 *    List = GET /listing - 列出所有
 *    List = GET /tickets - 列出 paging
 *    Read = GET /tickets/{id} - 列出 id
 *    Create = POST /tickets - 创建
 *    Update = PUT /tickets/{id} - 更新信息
 *    UpdatePartial = PATCH /tickets/{id} - 部分修改, 例如修改状态
 *    Delete = DELETE /tickets/{id} - 删掉 9839 这张车票
 */

Route::group("/dapp", function () {
    // auth
    Route::group("/auth", function () {
        Route::get("/request", [dapp\auth\Ask::class, "index"]);
        Route::post("/verify", [dapp\auth\Verify::class, "index"]);
        Route::post("/logout", [dapp\auth\Logout::class, "index"])->middleware([
            plugin\dapp\app\middleware\JwtAuthMiddleware::class,
        ]);
    })->middleware([
        plugin\dapp\app\middleware\MaintenanceMiddleware::class,
    ]);

    //public
    Route::group("/public", function () {
        // user
        Route::group("/user", function () {
            Route::get("/getProfile", [dapp\public\user\GetProfile::class, "index"]);
        });

        // blog
        Route::group("/blog", function () {
            Route::get("/listing", [dapp\public\blog\Listing::class, "index"]);
            Route::get("/read", [dapp\public\blog\Read::class, "index"]);
            Route::post("/viewCount", [dapp\public\blog\ViewCount::class, "index"]);
        });
    })->middleware([
        plugin\dapp\app\middleware\MaintenanceMiddleware::class,
    ]);

    //private
    Route::group("/private", function () {
        // user
        Route::group("/user", function () {
            Route::post("/setProfile", [dapp\private\user\SetProfile::class, "index"]);
        });

        // blog
        Route::group("/blog", function () {
            Route::post("/write", [dapp\private\blog\Write::class, "index"]);
            Route::post("/edit", [dapp\private\blog\Edit::class, "index"]);
            Route::post("/delete", [dapp\private\blog\Delete::class, "index"]);
            Route::get("/listing", [dapp\private\blog\Listing::class, "index"]);
            Route::get("/read", [dapp\private\blog\Read::class, "index"]);
        });
    })->middleware([
        plugin\dapp\app\middleware\JwtAuthMiddleware::class,
        plugin\dapp\app\middleware\MaintenanceMiddleware::class,
    ]);
});
