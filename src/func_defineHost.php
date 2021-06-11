<?php

namespace Deployer;

use Deployer\Host\Host;

/*
 * Define single Host
 */

function defineHost(string $url, string $stage = null): Host
{
    $data = parse_url($url);

    // Init
    if (isset($data['query'])) {
        parse_str($data['query'], $params);
    } else {
        $params = [];
    }

    if (isset($data['fragment'])) {
        parse_str($data['fragment'], $labels);
    } else {
        $labels = [];
    }

    if (isset($data['scheme'])) {
        $strategies = explode('+', $data['scheme']);
    } else {
        $strategies = [];
    }

    if (isset($stage)) {
        $labels['stage'] = $stage;
    }

    $host = host($data['host'])
        ->setSshMultiplexing(false)
        ->setDeployPath($data['path'])
        ->setLabels($labels)
        ->set('strategies', $strategies);

    if (isset($data['pass']) && str_starts_with($data['pass'], 'identity=')) {
        $host->setIdentityFile(substr($data['pass'], 9));
    }

    $host->setSshArguments([
        '-o UserKnownHostsFile=/dev/null',
        '-o StrictHostKeyChecking=no',
    ]);

    if (isset($data['user'])) {
        $host->setRemoteUser($data['user'])
            ->set('http_user', $data['user']);
    }

    foreach ($params as $key => $value) {
        $host->set($key, $value);
    }

    return $host;
}
