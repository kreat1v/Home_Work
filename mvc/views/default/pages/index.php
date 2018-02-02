<?php
// представление контроллера по умолчанию - Index
?>
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-8 col-12">
        <h1>Welcome to homepage</h1>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-8 col-12">
        <ul class="list-group">
            <li class="list-group-item active">Pages List</li>
            <?php foreach ($data as $page): ?>
                <li class="list-group-item">
                    <a href="<?=\App\Core\App::getRouter()->buildUri('view', [$page['id']])?>"><?=$page['title']?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>