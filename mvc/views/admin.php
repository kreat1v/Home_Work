<?php

/** @var array $data */
$router = \App\Core\App::getRouter();

$session = \App\Core\App::getSession();

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Admin <?=\App\Core\Config::get('siteName')?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/default.css">
    <script type="application/javascript" src="/js/admin.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/"><?=__('header.homepage')?> Admin</a>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?=$router->buildUri('pages.index')?>"><?=__('header.pages')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=$router->buildUri('contacts.index')?>"><?=__('header.contact_us')?></a>
                </li>
            </ul>
        </div>
    </nav>

	<main class="container main">
        <div class="row">
        <?php
        if ($session->hasFlash()):
            foreach ($session->getFlash() as $message):
        ?>
            <div class="alert alert-warning">
                <?=$message?>
            </div>
        <?php
            endforeach;
        endif;
        ?>
		<?=$data['content']?>
        </div>
	</main>
</body>
</html>