<?php

if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $data = [];

    if (strlen($title)) {
        $data['title'] = $title;
    }

    if (!empty($data)) {
        if ($id > 0) {
            $result = updateCategory($id, $data);
        } else {
            $result = createCategory($data);
        }
    }
}

$categoryResult = categoryList();
$line = mysqli_fetch_all($categoryResult, MYSQLI_ASSOC);

$numberOfGoods = 5;
$p = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($p < 1 || $p > ceil(count($line)/$numberOfGoods)) {
    header("Location: ?page=category&p=1");
}

$options = new Pagination([
    'itemsCount' => count($line),
    'itemsPerPage' => $numberOfGoods,
    'currentPage' => $p
]);

$id = $_GET['id'];

if (isset($_GET['delete'])) {
    if ($_GET['delete'] > 0 && $_GET['delete'] == $id) {
        $result = deleteCategory($id);
        header("Location: ?page=category&p=$p");
    }
}

?>
<div>
    <a href="?page=category&id=0">Добавить категорию</a>

    <?php
    if (isset($id)) {
        $title = '';
        if ($id > 0) {
            $category = mysqli_fetch_assoc(categoryList($id));
            $title = $category['title'];
        }
        ?>

        <form action="?page=category&p=<?=$p?>" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="text" value="<?=$title?>" placeholder="Название категории" name="title">
            <input type="submit" name="save" value="Сохранить">
        </form>

    <?php } ?>

    <ul>
    <?php
    $category = array_slice($line, $p*$numberOfGoods - $numberOfGoods, $numberOfGoods);
    foreach ($category as $key => $value) {
        ?>
        <li>
            <a href="?page=category&p=<?=$p?>&id=<?=$category[$key]['id']?>">
                <?=$category[$key]['id']?>: <?=$category[$key]['title']?>
            </a>
            <a href="?page=category&p=<?=$p?>&id=<?=$category[$key]['id']?>&delete=<?=$category[$key]['id']?>">
                Удалить
            </a>
        </li>
    <?php } ?>
</div>

<div>
    <?php
    foreach ($options->buttons as $button){
        if ($button->isActive){ ?>
            <a href = '?page=category&p=<?=$button->page?>'><?=$button->text?></a>
        <?php } else {?>
            <span style="color:#555555"><?=$button->text?></span>
        <?php }
        } ?>
</div>
