<?php

namespace Deployer;

require_once __DIR__.'/func_defineHost.php';

function loadHostsMap(string $map = null): void
{
    if (! isset($map)) {
        $map = file('.hostmap', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    } else {
        $map = explode("\n", trim($map, "\n"));
    }

    $map = array_filter($map, function ($url) {
        return
            ! str_starts_with($url, '#');
    });

    if ($map) {
        foreach ($map as $url) {
            defineHost($url);
        }
    }
}
