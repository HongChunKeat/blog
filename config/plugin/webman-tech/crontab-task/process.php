<?php

use WebmanTech\CrontabTask\Schedule;

// 添加多个定时任务，在同个进程中（注意会存在阻塞）
//    ->addTasks("task2", [
//        ["*/1 * * * * *", \WebmanTech\CrontabTask\Tasks\SampleTask::class],
//        ["*/1 * * * * *", \WebmanTech\CrontabTask\Tasks\SampleTask::class],
//    ])

return (new Schedule())
    // ->addTask("test", "0 0 * * *", \app\crontab\tasks\MiscTask::class)
    ->buildProcesses();