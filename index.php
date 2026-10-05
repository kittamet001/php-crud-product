<?php
require_once 'config.php';

if (isset($_GET['delete_id'])) {
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = :id");
    $stmt->execute(['id' => $_GET['delete_id']]);
    header("Location: index.php");
    exit();
}

$stmt = $conn->prepare("SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ระบบจัดการสินค้า - อาจารย์นิทัศน์</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>รายการสินค้าทั้งหมด</h2>
    <a href="add.php" class="btn btn-primary mb-3">+ เพิ่มสินค้าใหม่</a>
    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>รหัส</th>
                <th>ชื่อสินค้า</th>
                <th>หมวดหมู่</th>
                <th>ยี่ห้อ</th>
                <th>ราคาขาย</th>
                <th>คงเหลือ</th>
                <th>สถานะ</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $row): ?>
            <tr>
                <td><?= $row['product_code'] ?></td>
                <td><?= $row['product_name'] ?></td>
                <td><?= $row['category_name'] ?></td>
                <td><?= $row['brand'] ?></td>
                <td><?= number_format($row['selling_price'], 2) ?></td>
                <td><?= $row['stock_quantity'] ?> <?= $row['unit'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['product_id'] ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                    <a href="index.php?delete_id=<?= $row['product_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบ?')">ลบ</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>