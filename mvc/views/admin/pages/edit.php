<?php // Представление админского контроллера для редактирования страниц.

$isNew = empty($data) || isset($data['new']);

?>
<div class="col-lg-12">
	<h1><?=$isNew ? 'Create' : 'Edit'?></h1>
</div>

<div class="col-lg-12">
	<form action="" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="<?=isset($data['title']) ? $data['title'] : ''?>" class="form-control" />
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea rows="15" id="content" name="content" class="form-control"><?=isset($data['content']) ? $data['content'] : ''?></textarea>
        </div>
        <div class="form-group">
            <label for="active">Publish page</label>
            <input type="checkbox" value="1" id="active" name="active" <?=($isNew || $data['active'] ? 'checked' : '')?> />
        </div>
        <button type="submit" class="btn btn-success">Save</button>
	</form>
</div>