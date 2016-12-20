1 - configurer .env comme ceci :
En cas d'erreur -> DH_HOST = localhost 

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