<?php

namespace Deployer;

task('strategy:upload:release', function () {
    $excludes = [
        'node_modules*',
        '.*',
    ];

    if (is_file('./modules_statuses.json')) {
        $modules = json_decode(file_get_contents('./modules_statuses.json'), true);
        $excludes = array_merge(
            $excludes,
            array_map(function ($key, $value) {
                return 'modules/'.$key.($value ? '/node_modules' : '').'*';
            }, array_keys($modules), $modules)
        );
    }

    file_put_contents('.no_deploy', implode("\n", $excludes));

    $options =
        [
            '--exclude-from=.no_deploy',
            '--delete',
            '--copy-links',
            '--quiet',
        ];

    $progress_bar = false;

    upload('{{source_path}}/', '{{release_path}}', compact('options', 'progress_bar'));
})->desc('Uploads local files');
