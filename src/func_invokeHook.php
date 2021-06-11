<?php

namespace Deployer;

use InvalidArgumentException;

/*
 * Strategy specific functions
 */

function invokeHook(string $name)
{
    foreach (currentHost()->get('strategies') as $strategy) {
        try {
            invoke('strategy:'.$strategy.':'.$name);
        } catch (InvalidArgumentException $e) {
            writeln('Strategy <'.$strategy.':'.$name.'> not declared, skip');
        }
    }
}
