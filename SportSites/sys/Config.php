<?php

/**
* Aqui es on tenim totes les variables amb les seves rutes.
*
* @author SportSites
* BASE_URL serveix per tenir la url del localhost o servidor on esta el site
* ICON_SITES aqui es on guardarem els icones dels sites de la pagina
* VIDEO aqui es on guardem el video de la pagina
* MUSIC aqui es on guardem la musica de la pagina
* IMG_SITES aqui es on guardem les imatges dels sites que es pujen
* IMG_ESPORTS aqui es on guardem les categories
* IMG_PERFIL aqui es on guardarem les imatges de perfil dels usuaris
* FOOTER_IMG aqui es on guardem les imatges dels footer
*/
define('BASE_URL', 'http://2daw16.cesnuria.com/SportSites/');
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_LAYOUT', 'SportSites');

define('APP_NAME', 'Sport Sites');
define('ICON_SITES','Templates/SportSites/css/imgs/');
define('VIDEO','Templates/SportSites/css/video/');
define('MUSIC','Templates/SportSites/css/music/');
define('IMG_SITES','app/views/sites/imgs/');
define('IMG_ESPORTS','app/views/esports/imgs/');
define('IMG_PERFIL','app/views/perfil/img_perfils/');
define('NO_IMATGE','no_imagen.jpg');
define('FOOTER_IMG','Templates/SportSites/css/imgs/');
define('APP_LOGO','img/logo.png');
define('APP_SLOGAN', '');
define('APP_COMPANY', 'SportSites.SL');
define('SESSION_TIME', 10);


//CONFIGURACIO DE LA BASE DE DADES
define('DB_HOST', 'localhost');
define('DB_USER', '2daw16_root');
define('DB_PASS', 'toor123');
define('DB_NAME', '2daw16_SportSites');
define('DB_CHAR', 'utf8');


//CONFIGURACIO DEL SITE PER FTP
define('FTP_URL','92.222.38.97');
define('FTP_USER','2daw16_alejandro');
define('FTP_PASS','zarcero_20');
define('RUTA_FTP_IMG','/home/2daw16/web/2daw16.cesnuria.com/public_html/SportSites/');

?>