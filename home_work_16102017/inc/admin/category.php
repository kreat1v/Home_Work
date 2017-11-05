<?php

// Обработка данных из формы
if (isset($_POST['save']) || isset($_POST['rename'])) {
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

// Реализация удаления категорий
if (isset($_GET['delete'])) {
    if ($_GET['delete'] > 0 && $_GET['delete'] == $id) {
        $result = deleteCategory($id);
    }
}

// Реализация пагинации
$p = isset($_GET['p']) ? (int)$_GET['p'] : 1;

$numberOfCategories = 5;
$limitStart = $p*$numberOfCategories - $numberOfCategories;
$categoryResult = categorySection($numberOfCategories, $limitStart);
$lastPage = ceil(categoryCount()/$numberOfCategories);

if (isset($_POST['save']) || $p > $lastPage) {
    header("Location: ?page=category&p=$lastPage");
}

if ($p < 1) {
    header("Location: ?page=category&p=1");
}

$options = new Pagination([
    'itemsCount' => categoryCount(),
    'itemsPerPage' => $numberOfCategories,
    'currentPage' => $p
]);

?>
<div>
    <a href="?page=category&p=<?=$p?>&id=0">Добавить категорию</a>

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
            <input type="submit" name="<?php
            if ($id == 0) {
                echo 'save';
            } else {
                echo 'rename';
            }
            ?>" value="Сохранить">
        </form>

    <?php } ?>

    <ul>
    <?php
    while ($category = mysqli_fetch_assoc($categoryResult)) {
        ?>
        <li>
            <a href="?page=category&p=<?=$p?>&id=<?=$category['id']?>">
                <?=$category['id']?>: <?=$category['title']?>
            </a>
            <a href="?page=category&p=<?=$p?>&id=<?=$category['id']?>&delete=<?=$category['id']?>">
                Удалить
            </a>
        </li>
    <?php } ?>
    </ul>
</div>

<!-- Вывод пагинации -->
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