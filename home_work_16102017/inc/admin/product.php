<?php

// Обработка данных из формы
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

// Реализация удаления товаров
if (isset($_GET['delete'])) {
    if ($_GET['delete'] > 0 && $_GET['delete'] == $id) {
        $result = deleteProduct($id);
    }
}

// Реализация пагинации
$p = isset($_GET['p']) ? (int)$_GET['p'] : 1;

$numberOfProducts = 5;
$limitStart = $p*$numberOfProducts - $numberOfProducts;
$productResult = productSection($numberOfProducts, $limitStart, $_GET['category_id']);
$lastPage = ceil(productCount($_GET['category_id'])/$numberOfProducts);

if ($p > $lastPage) {
    header("Location: ?page=product&category_id={$_GET['category_id']}&p=$lastPage");
}

if (isset($_POST['save'])) {
    $lastPage = ceil(productCount($_POST['category_id'])/$numberOfProducts);
    header("Location: ?page=product&category_id={$_POST['category_id']}&p=$lastPage");
} elseif ($_POST['category_id']){
    header("Location: ?page=product&category_id={$_POST['category_id']}");
}

if (isset($_POST['rename'])) {
    header("Location: ?page=product&category_id={$_GET['category_id']}&p=$p");
}

$options = new Pagination([
    'itemsCount' => productCount($_GET['category_id']),
    'itemsPerPage' => $numberOfProducts,
    'currentPage' => $p
]);

?>
<div>
    <a href="?page=product&id=0">Добавить товар</a>

    <!-- Получения данных для редактирования продукции -->
    <?php
    if (isset($id) && !isset($_GET['delete'])) {
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

        <!-- Форма добавления продукции -->
        <form method="post">
            <input type="hidden" value="<?=$id?>" name="id">
            <input type="text" value="<?=$title?>" placeholder="Название товара" name="title">
            <input type="text" value="<?=$price?>" placeholder="Цена товара" name="price">
            <select name="category_id" required>
                <?php if ($id > 0) { ?>
                    <option value="<?=$categoryId?>"><?=$categoryName['title']?></option>
                <?php } ?>
                <?php
                    $categoryResult = categoryList();
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
    <?php } ?>

    <!-- Форма доступных категорий -->
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

    <!-- Выбранная категория -->
    <h3>
        <?php
        if (isset($_GET['category_id'])) {
            echo mysqli_fetch_assoc(categoryList($_GET['category_id']))['title'];
        }
        ?>
    </h3>

    <!-- Вывод выборки продукции -->
    <ul>
        <?php
        if (isset($_GET['category_id'])) {
            while ($product = mysqli_fetch_assoc($productResult)) {
                ?>
                <li>
                    <a href="?page=product&category_id=<?=$_GET['category_id']?>&id=<?php
                    echo $product['id'];
                    if ($lastPage > 1) {
                        echo '&p='.$p;
                    }
                    ?>" class="price">
                        <?=$product['id']?>: <?=$product['title']?>
                    </a>
                    <p class="price"><?=$product['price']?></p>
                    <a href="?page=product&category_id=<?=$_GET['category_id']?>&id=<?php
                    echo $product['id'];
                    if ($lastPage > 1) {
                        echo '&p='.$p;
                    }
                    ?>&delete=<?=$product['id']?>">
                        Удалить
                    </a>
                </li>
                <?php
            }
        }
        ?>
    </ul>
</div>

<!-- Вывод пагинации -->
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