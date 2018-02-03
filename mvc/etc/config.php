<?php // Здесь задаем наши конфигурации.

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
Config::set('debug', false);

/**
 * Meta
 */
Config::set('siteName', 'MVC project');

/**
 * Database
 */
Config::set('db.host', 'localhost:3306');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.name', 'mvc');

/**
 * Набор случайных символов для усложнения подборки пользовательского пароля ("соль").
 */
Config::set('salt', 'g5kgat83kd0pbm51d');