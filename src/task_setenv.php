<?php

namespace Deployer;

require_once __DIR__.'/func_updateEnv.php';

task(
    'deploy:setenv',
    function () {
        foreach (currentHost()->getLabels() as $label => $value) {
            updateEnv('APP_'.strtoupper($label), $value);
        }
    }
)->desc('Apply remote env variables');
