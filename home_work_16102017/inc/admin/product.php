<?php

if (isset($_POST['save'])) {
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

if (isset($_GET['delete'])) {
    if ($_GET['delete'] > 0 && $_GET['delete'] == $id) {
        $result = deleteProduct($id);
        header("Location: ?page=product");
    }
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

        <form action="?page=product" method="post">
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
            <input type="submit" name="save" value="Сохранить">
        </form>
    <?php } ?>

    <ul>
        <?php
            $categoryResult = categoryList();
            while ($category = mysqli_fetch_assoc($categoryResult)) {
        ?>

        <li>
            <?=$category['title']?>
            <ul>
                <?php
                    $productResult = productList();
                    while ($product = mysqli_fetch_assoc($productResult)) {
                        if ($product['category_id'] == $category['id']) {
                ?>

                <li>
                    <a href="?page=product&id=<?=$product['id']?>" class="price">
                        <?=$product['id']?>: <?=$product['title']?>
                    </a>
                    <p class="price"><?=$product['price']?></p>
                    <a href="?page=product&id=<?=$product['id']?>&delete=<?=$product['id']?>">
                        Удалить
                    </a>
                </li>

                <?php
                        }
                    }
                ?>
            </ul>
        </li>

        <?php } ?>
    </ul>
</div>