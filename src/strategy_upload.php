<?php

namespace Deployer;

task('strategy:upload:release', function () {
    $options = [
        '--exclude=node_modules',
        '--exclude=".*"',
        '--exclude=".*/"',
        '--delete',
    ];

    upload('{{source_path}}/', '{{release_path}}', compact('options'));
})->desc('Uploads local files');
