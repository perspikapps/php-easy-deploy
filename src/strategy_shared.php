<?php

namespace Deployer;

task('strategy:shared:release', function () {
    $hta = <<<'EOT'
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Enable symbolic links
    Options +FollowSymLinks

    # Handle Authorization MemberHeader
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Remove public URL from the path
    RewriteCond %{REQUEST_URI} !^/current/public/
    RewriteRule ^(.*)$ /current/public/\$1 [L,QSA]

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
EOT;

    cd('{{deploy_path}}');
    run('echo "'.$hta.'" > ./.htaccess');
})->desc('Sets .htaccess');
