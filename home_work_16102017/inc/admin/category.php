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

$id = $_GET['id'];
$categoryResult = categoryList();

if (isset($_GET['delete'])) {
    if ($_GET['delete'] > 0 && $_GET['delete'] == $id) {
        $result = deleteCategory($id);
        header("Location: ?page=category");
    }
}

$p = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$options = [
    'itemsCount' => 23,
    'itemsPerPage' => 5,
    'currentPage' => $p
];

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

        <form action="?page=category" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="text" value="<?=$title?>" placeholder="Название категории" name="title">
            <input type="submit" name="save" value="Сохранить">
        </form>

    <?php } ?>

    <ul>
    <?php

    while ($category = mysqli_fetch_assoc($categoryResult)) {
        print_r($category);
        ?>
            <li>
                <a href="?page=category&id=<?=$category['id']?>">
                    <?=$category['id']?>: <?=$category['title']?>
                </a>
                <a href="?page=category&id=<?=$category['id']?>&delete=<?=$category['id']?>">
                    Удалить
                </a>
            </li>
        <?php } ?>
    </ul>

</div>