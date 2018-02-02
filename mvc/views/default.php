<?php

/** @var array $data */

use App\Core\Localization;

$router = \App\Core\App::getRouter();
$session = \App\Core\App::getSession();

?><!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?=\App\Core\Config::get('siteName')?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/default.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body style="margin-top: 100px">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="<?=$router->buildUri('pages.index')?>"><?=__('header.homepage')?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if($router->getController(true) == 'Pages') { ?>active<?php } ?>">
                    <a class="nav-link" href="<?=$router->buildUri('pages.index')?>"><?=__('header.pages')?></a>
                </li>
                <li class="nav-item <?php if($router->getController(true) == 'Contacts' && $router->getAction(true) == 'index') { ?>active<?php } ?>">
                    <a class="nav-link" href="<?=$router->buildUri('contacts.index')?>"><?=__('header.contact_us')?></a>
                </li>
	            <?php if ($session->get('id')):?>
                <li class="nav-item <?php if($router->getController(true) == 'Contacts' && $router->getAction(true) == 'view') { ?>active<?php } ?>">
                    <a class="nav-link" href="<?=$router->buildUri('contacts.view')?>"><?=__('header.messages')?></a>
                </li>
	            <?php endif; ?>
	            <?php if ($session->get('role') == 'admin'):?>
                <li class="nav-item">
                    <a class="btn btn-outline-success my-2 my-sm-0" href="<?=$router->buildUri('admin.pages')?>"><?=__('header.admin')?></a>
                </li>
	            <?php endif; ?>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=__('header.language')?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="<?=Localization::chooseLang('ru')?>">Русский</a>
                        <a class="dropdown-item" href="<?=Localization::chooseLang('en')?>">English</a>
                    </div>
                </li>
	            <?php if (!$session->get('id')):?>
                <li class="nav-item <?php if($router->getController(true) == 'User' && $router->getAction(true) == 'login') { ?>active<?php } ?>">
                    <a class="nav-link" href="<?=$router->buildUri('user.login')?>"><?=__('header.login')?></a>
                </li>
                <li class="nav-item <?php if($router->getController(true) == 'User' && $router->getAction(true) == 'register') { ?>active<?php } ?>">
                    <a class="nav-link" href="<?=$router->buildUri('user.register')?>"><?=__('header.do_register')?></a>
                </li>
	            <?php endif; ?>
	            <?php if ($session->get('id')):?>
                <li class="nav-item <?php if($router->getController(true) == 'User') { ?>active<?php } ?>">
                    <a class="nav-link" href="<?=$router->buildUri('user.index')?>"><?=__('header.profile') .' | '. $session->get('email')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=$router->buildUri('user.logout')?>"><?=__('header.logout')?></a>
                </li>
	            <?php endif; ?>
            </ul>
        </div>
    </nav>

	<main class="container main">
        <div class="row">
        <?php
        if ($session->hasFlash()):
            foreach ($session->getFlash() as $message):
        ?>
            <div class="alert alert-warning col-xl-4 col-lg-4 col-md-6 col-12">
                <?=$message?>
            </div>
        <?php
            endforeach;
        endif;
        ?>
        </div>
        <?=$data['content']?>
	</main>

    <footer class="container">
        <hr>
        <p>&copy; Company 2017-2018</p>
    </footer>
</body>
</html>