<?php
require_once 'config.php';

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE products SET category_id=:category_id, product_code=:product_code, product_name=:product_name, 
            brand=:brand, cost_price=:cost_price, selling_price=:selling_price, stock_quantity=:stock_quantity, 
            unit=:unit, detail=:detail, status=:status WHERE product_id=:product_id";
    $stmt = $conn->prepare($sql);
    $_POST['product_id'] = $id;
    $stmt->execute($_POST);
    header("Location: index.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();
$categories = $conn->query("SELECT * FROM categories")->fetchAll();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขสินค้า</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>แก้ไขสินค้า</h2>
    <form method="POST" class="row g-3">
        <div class="col-md-6">
            <label>หมวดหมู่</label>
            <select name="category_id" class="form-select">
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['category_id'] ?>" <?= $cat['category_id'] == $product['category_id'] ? 'selected' : '' ?>><?= $cat['category_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6"><label>รหัสสินค้า</label><input type="text" name="product_code" class="form-control" value="<?= $product['product_code'] ?>" required></div>
        <div class="col-md-6"><label>ชื่อสินค้า</label><input type="text" name="product_name" class="form-control" value="<?= $product['product_name'] ?>" required></div>
        <div class="col-md-6"><label>ยี่ห้อ</label><input type="text" name="brand" class="form-control" value="<?= $product['brand'] ?>"></div>
        <div class="col-md-4"><label>ราคาทุน</label><input type="number" step="0.01" name="cost_price" class="form-control" value="<?= $product['cost_price'] ?>" required></div>
        <div class="col-md-4"><label>ราคาขาย</label><input type="number" step="0.01" name="selling_price" class="form-control" value="<?= $product['selling_price'] ?>" required></div>
        <div class="col-md-4"><label>จำนวนคงเหลือ</label><input type="number" name="stock_quantity" class="form-control" value="<?= $product['stock_quantity'] ?>" required></div>
        <div class="col-md-4"><label>หน่วยนับ</label><input type="text" name="unit" class="form-control" value="<?= $product['unit'] ?>"></div>
        <div class="col-md-4">
            <label>สถานะ</label>
            <select name="status" class="form-select">
                <option value="active" <?= $product['status'] == 'active' ? 'selected' : '' ?>>active</option>
                <option value="inactive" <?= $product['status'] == 'inactive' ? 'selected' : '' ?>>inactive</option>
            </select>
        </div>
        <div class="col-12"><label>รายละเอียด</label><textarea name="detail" class="form-control"><?= $product['detail'] ?></textarea></div>
        <div class="col-12">
            <button type="submit" class="btn btn-warning">อัปเดต</button>
            <a href="index.php" class="btn btn-secondary">ยกเลิก</a>
        </div>
    </form>
</body>
</html>