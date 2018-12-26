En caso de Deploy:

Para solucionar los errores en base a:

[2018-10-24 18:00:54] request.CRITICAL: Uncaught PHP Exception InvalidArgumentException: "The directory "/var/www/pedido/releases/20181024115238/var/cache/prod/jms_serializer" is not writable." at /var/www/pedido/releases/20181024115238/vendor/jms/metadata/src/Metadata/Cache/FileCache.php line 17 {"exception":"[object] (InvalidArgumentException(code: 0): The directory \"/var/www/pedido/releases/20181024115238/var/cache/prod/jms_serializer\" is not writable. at /var/www/pedido/releases/20181024115238/vendor/jms/metadata/src/Metadata/Cache/FileCache.php:17)"} []

con el usuario root
./bin/console deploy

cd /var/www/pedido/current

export APP_ENV=prod

composer install --no-dev --optimize-autoloader

php bin/console cache:clear --env=prod --no-debug

//APP_ENV=prod APP_DEBUG=0 php bin/console cache:clear

Aplicamos los siguientes permisos:

sudo setfacl -R -m u:"apache":rwX -m u:apache:rwX var/cache/prod/jms_serializer
sudo setfacl -dR -m u:"apache":rwX -m u:apache:rwX var/cache/prod/jms_serializer

sudo setfacl -R -m u:"apache":rwX -m u:apache:rwX var/cache/prod/easy_admin
sudo setfacl -dR -m u:"apache":rwX -m u:apache:rwX var/cache/prod/easy_admin

sudo apachectl restart

Fuente https://www.codeproject.com/Articles/1157102/Apache-Symfony-on-RHEL