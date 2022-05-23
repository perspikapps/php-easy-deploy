<?php

namespace Deployer;

set_time_limit(0);
ini_set('memory_limit', '-1');

require 'recipe/common.php';
require_once __DIR__.'/func_defineHost.php';
require_once __DIR__.'/func_loadHostsMap.php';
require_once __DIR__.'/func_updateEnv.php';
require_once __DIR__.'/func_invokeHook.php';
require_once __DIR__.'/task_setenv.php';

task(
    'strategy:release',
    static function () {
        invokeHook('release');
    }
)->hidden();

// Strategy before symlink
task(
    'strategy:released',
    static function () {
        invokeHook('released');
    }
)->hidden();

// Strategy before unlock
task(
    'strategy:done',
    static function () {
        invokeHook('done');
    }
)->hidden();

// Strategy after failure
task(
    'strategy:failed',
    function () {
        invokeHook('failed');
    }
)->hidden();

// Strategy after rollback
task(
    'strategy:rollback',
    function () {
        invokeHook('rollback');
    }
)->hidden();

// Deploy Task
task(
    'deploy',
    [
        'deploy:info',
        'deploy:setup',
        'deploy:lock',
        'deploy:release',
        'strategy:release',
        'deploy:shared',
        'deploy:writable',
        'strategy:released',
        'deploy:symlink',
        'deploy:setenv',
        'strategy:done',
        'deploy:unlock',
        'deploy:cleanup',
        'deploy:success',
    ]
)->hidden();

after('deploy:failed', 'deploy:unlock');
after('deploy:failed', 'strategy:failed');
after('rollback', 'strategy:rollback');

// Load map
loadHostsMap();
