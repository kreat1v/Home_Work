<?php
// здесь задаем наши конфигурации

use App\Core\Config;

/**
 * Routing
 */
Config::set('routes', ['default', 'admin']);
Config::set('defaultRoute', 'default');
Config::set('defaultController', 'pages');
Config::set('defaultAction', 'index');  

/**
 * Languages
 */
Config::set('languages', ['en', 'ru']);
Config::set('defaultLanguage', 'ru');

/**
 * Debug
 */
Config::set('debug', true);

/**
 * Meta
 */
Config::set('siteName', 'Academy MVC');

/**
 * Database
 */
Config::set('db.host', 'localhost:3306');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.name', 'mvc');