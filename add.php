<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO products (category_id, product_code, product_name, brand, cost_price, selling_price, stock_quantity, unit, detail, status) 
            VALUES (:category_id, :product_code, :product_name, :brand, :cost_price, :selling_price, :stock_quantity, :unit, :detail, :status)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($_POST);
    header("Location: index.php");
    exit();
}

$categories = $conn->query("SELECT * FROM categories")->fetchAll();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เพิ่มสินค้า</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>เพิ่มสินค้าใหม่</h2>
    <form method="POST" class="row g-3">
        <div class="col-md-6">
            <label>หมวดหมู่</label>
            <select name="category_id" class="form-select" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['category_id'] ?>"><?= $cat['category_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6"><label>รหัสสินค้า</label><input type="text" name="product_code" class="form-control" required></div>
        <div class="col-md-6"><label>ชื่อสินค้า</label><input type="text" name="product_name" class="form-control" required></div>
        <div class="col-md-6"><label>ยี่ห้อ</label><input type="text" name="brand" class="form-control"></div>
        <div class="col-md-4"><label>ราคาทุน</label><input type="number" step="0.01" name="cost_price" class="form-control" required></div>
        <div class="col-md-4"><label>ราคาขาย</label><input type="number" step="0.01" name="selling_price" class="form-control" required></div>
        <div class="col-md-4"><label>จำนวนคงเหลือ</label><input type="number" name="stock_quantity" class="form-control" required></div>
        <div class="col-md-4"><label>หน่วยนับ</label><input type="text" name="unit" class="form-control" value="ชิ้น"></div>
        <div class="col-md-4">
            <label>สถานะ</label>
            <select name="status" class="form-select">
                <option value="active">active</option>
                <option value="inactive">inactive</option>
            </select>
        </div>
        <div class="col-12"><label>รายละเอียด</label><textarea name="detail" class="form-control"></textarea></div>
        <div class="col-12">
            <button type="submit" class="btn btn-success">บันทึก</button>
            <a href="index.php" class="btn btn-secondary">ยกเลิก</a>
        </div>
    </form>
</body>
</html>