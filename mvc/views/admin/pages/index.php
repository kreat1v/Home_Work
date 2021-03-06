<?php // Представление админского контроллера по умолчанию - Index.

$router = \App\Core\App::getRouter();

?>
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-8 col-12">
        <h2>Pages management</h2>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-8 col-12 pt-3">
        <a class="btn btn-lg btn-success" href="<?=$router->buildUri('edit')?>">Create page</a>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-8 col-12 pt-3">
        <ul class="list-group">
            <li class="list-group-item active">Pages List</li>
            <?php foreach ($data as $page): ?>
                <li class="list-group-item">
                    <?=$page['title']?>
                    <a class="btn btn-sm btn-success" style="float: right; margin-left: 10px" href="<?=$router->buildUri('edit', [$page['id']])?>">Edit</a>
                    <a class="btn btn-sm btn-warning" style="float: right" onclick="return confirmDelete()" href="<?=$router->buildUri('delete', [$page['id']])?>">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>