<?php

if (isset($_POST['save']) || isset($_POST['rename'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $categoryId = $_POST['category_id'];
    $data = [];

    if (strlen($title) && strlen($price)) {
        $data['title'] = $title;
        $data['price'] = $price;
        $data['category_id'] = $categoryId;
    }

    if (!empty($data)) {
        if ($id > 0) {
            $result = updateProduct($id, $data);
        } else {
            $result = createProduct($data);
        }
    }
}

$id = $_GET['id'];
$categoryResult = categoryList();

// Реализация пагинации
$productResult = productList(null, $_GET['category_id']);
$line = mysqli_fetch_all($productResult, MYSQLI_ASSOC);

$numberOfGoods = 5;
$lastPage = ceil(count($line)/$numberOfGoods);

$p = isset($_GET['p']) ? (int)$_GET['p'] : 1;
//if (isset($_POST['save']) || $p > $lastPage) {
//    header("Location: ?page=product&category_id={$_POST['category_id']}&p=$lastPage");
//}

$options = new Pagination([
    'itemsCount' => count($line),
    'itemsPerPage' => $numberOfGoods,
    'currentPage' => $p
]);

// Реализация удаления товаров
if (isset($_GET['delete'])) {
    if ($_GET['delete'] > 0 && $_GET['delete'] == $id) {
        $result = deleteProduct($id);
        header("Location: ?page=product&category_id={$_GET['category_id']}&p=$p");
    }
}

if ($_POST['category_id']){
    header("Location: ?page=product&category_id={$_POST['category_id']}");
}

if (isset($_POST['rename'])) {
    header("Location: ?page=product&category_id={$_GET['category_id']}&p=$p");
}

?>
<div>
    <a href="?page=product&id=0">Добавить товар</a>

    <?php
    if (isset($id)) {
        $title = '';
        $price = '';
        $categoryId = '';
        if ($id > 0) {
            $product = mysqli_fetch_assoc(productList($id));
            $title = $product['title'];
            $price = $product['price'];
            $categoryId = $product['category_id'];
            $categoryName = mysqli_fetch_assoc(categoryList($categoryId));
        }
        ?>

        <form method="post">
            <input type="hidden" value="<?=$id?>" name="id">
            <input type="text" value="<?=$title?>" placeholder="Название товара" name="title">
            <input type="text" value="<?=$price?>" placeholder="Цена товара" name="price">
            <select name="category_id" required>
                <?php if ($id > 0) { ?>
                    <option value="<?=$categoryId?>"><?=$categoryName['title']?></option>
                <?php } ?>
                <?php
                    while ($category = mysqli_fetch_assoc($categoryResult)){
                ?>
                        <option value="<?=$category['id']?>"><?=$category['title']?></option>
                <?php } ?>
            </select>
            <input type="submit" name="<?php
            if ($id == 0) {
                echo 'save';
            } else {
                echo 'rename';
            }
            ?>" value="Сохранить">
        </form>
    <?php }
    print_r($_POST);
    ?>

    <form method="post" id="go">
        <select size = 10 name="category_id" onchange="document.getElementById('go').submit()">
            <?php
            $categoryResult = categoryList();
            while ($category = mysqli_fetch_assoc($categoryResult)) {
                ?>
                <option value="<?=$category['id']?>"><?=$category['title']?></option>
            <?php } ?>
        </select>
    </form>

    <ul>
        <?php
        if (isset($_GET['category_id'])) {
            $product = array_slice($line, $p*$numberOfGoods - $numberOfGoods, $numberOfGoods);
            foreach ($product as $key => $value) {
                ?>
                <li>
                    <a href="?page=product&category_id=<?=$_GET['category_id']?>&id=<?php
                    echo $product[$key]['id'];
                    if ($lastPage > 1) {
                        echo '&p='.$p;
                    }
                    ?>" class="price">
                        <?=$product[$key]['id']?>: <?=$product[$key]['title']?>
                    </a>
                    <p class="price"><?=$product[$key]['price']?></p>
                    <a href="?page=product&category_id=<?=$_GET['category_id']?>&id=<?php
                    echo $product[$key]['id'];
                    if ($lastPage > 1) {
                        echo '&p='.$p;
                    }
                    ?>&delete=<?=$product[$key]['id']?>">
                        Удалить
                    </a>
                </li>

                <?php
            }
        }
        ?>
    </ul>
</div>

<div>
    <?php
    if (isset($_GET['category_id'])) {
        foreach ($options->buttons as $button) {
            if ($button->isActive) { ?>
                <a href='?page=product&category_id=<?=$_GET['category_id']?>&p=<?= $button->page ?>'><?= $button->text ?></a>
            <?php } else { ?>
                <span style="color:#555555"><?= $button->text ?></span>
            <?php }
        }
    }?>
</div>