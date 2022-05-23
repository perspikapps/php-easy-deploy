<?php

namespace Deployer;

/*
 * Strategy specific functions
 */

function updateEnv($key, $value)
{
    writeln('<fg=bright-green>info</> Apply <fg=bright-magenta>'.$key.'='.$value.'</>');
    run("grep -q '^$key' {{deploy_path}}/shared/.env &&  sed -i -e '/$key/ s/=.*$/=$value/' {{deploy_path}}/shared/.env || echo '$key=$value' >>  {{deploy_path}}/shared/.env");
}
