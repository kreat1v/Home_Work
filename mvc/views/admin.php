<?php

/** @var array $data */

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
    <script type="application/javascript" src="/js/admin.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark ">
            <a class="navbar-brand" href="<?=$router->buildUri('admin.pages.index')?>"><?=__('header.homepage')?> Admin Dashboard</a>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-brand mr-auto"></ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$router->buildUri('default.user.index')?>"><?=__('admin_nav.back_profile')?></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?php if($router->getController(true) == 'Pages') { ?>active<?php } ?>" href="<?=$router->buildUri('admin.pages.index')?>"><?=__('admin_nav.pages_management')?></a>
                    </li>
                </ul>

                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?php if($router->getController(true) == 'Contacts' && $router->getAction(true) == 'anonymous') { ?>active<?php } ?>" href="<?=$router->buildUri('admin.contacts.anonymous')?>"><?=__('admin_nav.external_messages')?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($router->getController(true) == 'Contacts' && $router->getAction(true) == 'user') { ?>active<?php } ?>" href="<?=$router->buildUri('admin.contacts.user')?>"><?=__('admin_nav.user_messages')?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($router->getController(true) == 'Contacts' && $router->getAction(true) == 'index') { ?>active<?php } ?>" href="<?=$router->buildUri('admin.contacts.index')?>"><?=__('admin_nav.all_messages')?></a>
                    </li>
                </ul>

                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?php if($router->getController(true) == 'User') { ?>active<?php } ?>" href="<?=$router->buildUri('admin.user.index')?>"><?=__('admin_nav.users')?></a>
                    </li>
                </ul>
            </nav>

            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
                <div class="container pt-3">
                    <div class="row">
                    <?php if ($session->hasFlash()):
                        foreach ($session->getFlash() as $message): ?>
                            <div class="alert alert-warning col-xl-4 col-lg-4 col-md-6 col-12">
                                <?=$message?>
                            </div>
                        <?php endforeach;
                    endif; ?>
                    </div>
                    <?=$data['content']?>
                </div>
            </main>
        </div>
    </div>

</body>
</html>