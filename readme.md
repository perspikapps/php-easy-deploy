<!-- @format -->

# Easy Deployer

[![Packagist](https://img.shields.io/packagist/v/perspikapps/php-easy-deployer.svg)](https://packagist.org/packages/perspikapps/php-easy-deployer)
[![Packagist](https://poser.pugx.org/perspikapps/php-easy-deployer/d/total.svg)](https://packagist.org/packages/perspikapps/php-easy-deployer)
[![Packagist](https://img.shields.io/packagist/l/perspikapps/php-easy-deployer.svg)](https://packagist.org/packages/perspikapps/php-easy-deployer)

[![Commitizen friendly](https://img.shields.io/badge/commitizen-friendly-brightgreen.svg)](http://commitizen.github.io/cz-cli/) [![semantic-release](https://img.shields.io/badge/%20%20%F0%9F%93%A6%F0%9F%9A%80-semantic--release-e10079.svg)](https://github.com/semantic-release/semantic-release)

[![Buy me a coffee](https://badgen.net/badge/buymeacoffe/tomgrv/yellow?icon=buymeacoffee)](https://buymeacoffee.com/tomgrv)

This package handles deployement configuration via a `deploy.yaml` file to define deploy strategy and a `.hostmap` file to define target strategy

## Installation

Install via composer

```bash
composer require perspikapps/php-easy-deployer
```

## Usage

Deployment is handled by [deployphp/deployer](https://github.com/deployphp/deployer) package.

### deploy.yaml

_See [deployer](https://github.com/deployphp/deployer) config for details_

```yaml
import:
    - vendor/perspikapps/php-easy-deployer/src/strategy_laravel.php
    - vendor/perspikapps/php-easy-deployer/src/strategy_upload.php
    - vendor/perspikapps/php-easy-deployer/src/strategy_update.php
    - vendor/perspikapps/php-easy-deployer/src/strategy_shared.php
    - vendor/perspikapps/php-easy-deployer/src/strategy.php

config:
    source_path: './'
    shared_dirs:
        - storage
    shared_files:
        - .env
    writable_dirs:
        - bootstrap/cache
        - storage
        - storage/app
        - storage/app/public
        - storage/framework
        - storage/framework/cache
        - storage/framework/sessions
        - storage/framework/views
        - storage/logs
    log_files:
        - storage/logs/*.log
```

### .hostname

Specify ONE deployement target per line as url:

-   url scheme = strategies to activate (`+` separated, each must be loaded in `import` section of `deploy.yaml` file)
-   url user/host/port = server to deploy to
-   url path = path on server to deploy to
-   url query = deploy options to use
-   url anchor = variables to set in .env file after deployment

```ini
upload+laravel://user@dev.exemple.com/var/home/{{hostname}}?bin/php=/opt/plesk/php/7.4/bin/php&writable_mode=chmod#debug=true&env=staging
upload+laravel://user@beta.exemple.com/var/home/{{hostname}}?bin/php=/opt/plesk/php/7.4/bin/php&writable_mode=chmod#debug=true&env=beta
upload+laravel://user@www.exemple.com/var/home/{{hostname}}?bin/php=/opt/plesk/php/7.4/bin/php&writable_mode=chmod#debug=false&env=production
```

## Security

If you discover any security related issues, please email
instead of using the issue tracker.

## Credits

-   [tomgrv](https://github.com/tomgrv)
-   [deployphp](https://github.com/deployphp)
