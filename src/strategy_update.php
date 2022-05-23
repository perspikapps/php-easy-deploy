<?php

namespace Deployer;

task('strategy:update:release', [
    'deploy:update_code',
])->desc('Uploads local files');

task('strategy:update:released', [
    'deploy:vendor',
])->desc('Uploads vendor files');
