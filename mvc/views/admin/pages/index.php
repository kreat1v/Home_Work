<?php // Представление админского контроллера по умолчанию - Index.

$router = \App\Core\App::getRouter();

?>
<div class="col-lg-12">
    <h1>Pages management</h1>
</div>

<div class="col-lg-12">

	<div class="row">
		<div class="col-lg-12">
			<a class="btn btn-sm btn-success" href="<?=$router->buildUri('edit')?>">Create page</a>
		</div>
	</div>

	<ul class="list-group">
        <li class="list-group-item active">Pages List</li>
		<?php foreach ($data as $page): ?>
            <li class="list-group-item">
	            <?=$page['title']?>
                <a class="btn btn-sm btn-success" href="<?=$router->buildUri('edit', [$page['id']])?>">Edit</a>
                <a class="btn btn-sm btn-warning" onclick="return confirmDelete()" href="<?=$router->buildUri('delete', [$page['id']])?>">Delete</a>
            </li>
		<?php endforeach; ?>
    </ul>

</div>