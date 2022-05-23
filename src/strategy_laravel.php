<?php

namespace Deployer;

require_once 'recipe/laravel.php';

task('strategy:laravel:released', [
    'artisan:storage:link',
    'artisan:migrate',
    'artisan:db:seed',
    'artisan:optimize:clear',
])->desc('Configure and Run migrations');

task('strategy:laravel:done', [
    'artisan:config:cache',
    'artisan:route:cache',
    'artisan:view:cache',
    'artisan:event:cache',
])->desc('Clear all caches');

task('strategy:laravel:rollback', [
    'artisan:optimize:clear',
    'artisan:config:cache',
])->desc('Clear all caches');
