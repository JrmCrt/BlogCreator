1 - configurer .env comme ceci :
En cas d'erreur -> DB_HOST = localhost 

APP_ENV=local
APP_KEY=base64:IP3erTdnxAJn/sdTluVlrrWREWkN+YIk7VrSy6bo7kw=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=DBNAME
DB_USERNAME=username
DB_PASSWORD=password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_KEY=
PUSHER_SECRET=

2 - Installer la base de donnée

3 - Il est possible qu'il soit nécessaire de regenerer une clef, dans ce cas entrer la commande suivante :
	php artisan key:generate

4 - Composer install

5 - Mise en place du vHost

	1 - ajouter un alias dans C:/Windows/System32/Drivers/etc/hosts 

	2 - Décommenter l'include de vhost dans wamp/bin/apache/apache{version}/conf/extra dans httpd.conf

	3 - Ouvrir wamp/bin/apache/apache{version}/conf/extra/httpd-vhosts.conf et ajouter le vhosts en se basant su l'exemple
