-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2026 at 04:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `created_at`) VALUES
(1, 'อุปกรณ์อิเล็กทรอนิกส์', 'สินค้าไอที คอมพิวเตอร์ และอุปกรณ์เสริม', '2026-10-05 12:46:28'),
(2, 'เครื่องใช้ไฟฟ้า', 'เครื่องใช้ไฟฟ้าภายในบ้านและสำนักงาน', '2026-10-05 12:46:28'),
(3, 'เครื่องเขียน', 'อุปกรณ์การเรียนและเครื่องใช้ในออฟฟิศ', '2026-10-05 12:46:28'),
(4, 'สินค้าอุปโภคบริโภค', 'ของใช้ในชีวิตประจำวัน อาหาร เครื่องดื่ม และของกินของใช้', '2026-10-05 13:15:46'),
(5, 'สาธารณูปโภคและบริการ', 'ค่าบริการ ค่าน้ำ ค่าไฟ และบัตรเติมเงินต่างๆ', '2026-10-05 13:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_code` varchar(20) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `cost_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `selling_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `unit` varchar(20) DEFAULT 'ชิ้น',
  `detail` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product_code`, `product_name`, `brand`, `cost_price`, `selling_price`, `stock_quantity`, `unit`, `detail`, `status`, `updated_at`) VALUES
(1, 1, 'P001', 'เมาส์ไร้สาย Ergonomic', 'Logitech', 450.00, 790.00, 25, 'อัน', 'เมาส์เพื่อสุขภาพ ลดอาการปวดข้อมือ เชื่อมต่อ Bluetooth', 'active', '2026-10-05 19:46:28'),
(2, 1, 'P002', 'คีย์บอร์ด Mechanical RGB', 'Keychron', 2200.00, 3190.00, 10, 'ตัว', 'สวิตช์ Red Switch เสียงเงียบ พิมพ์สบาย', 'active', '2026-10-05 19:46:28'),
(3, 2, 'P003', 'พัดลมไอเย็น 10 ลิตร', 'Hatari', 1250.00, 1690.00, 10, 'เครื่อง', 'ปรับความแรงได้ 3 ระดับ ประหยัดไฟเบอร์ 5', 'active', '2026-10-05 20:57:47'),
(4, 3, 'P004', 'ปากกาเจล 0.5 mm (กล่อง 12 ด้าม)', 'Zebra', 120.00, 180.00, 50, 'กล่อง', 'หมึกเข้ม แห้งไว ไม่เลอะมือ', 'active', '2026-10-05 19:46:28'),
(5, 4, 'P005', 'น้ำดื่มสะอาด 600 ml (แพ็ค 12 ขวด)', 'Singha', 45.00, 55.00, 100, 'แพ็ค', 'น้ำดื่มสะอาดผ่านการกรองมาตรฐาน', 'active', '2026-10-05 20:15:46'),
(6, 4, 'P006', 'บะหมี่กึ่งสำเร็จรูป รสต้มยำกุ้ง', 'มาม่า', 140.00, 180.00, 50, 'กล่อง', 'ขนาดบรรจุ 30 ซองต่อกล่อง', 'active', '2026-10-05 20:15:46'),
(7, 4, 'P007', 'สบู่เหลวอาบน้ำ 500 ml', 'Dettol', 110.00, 159.00, 30, 'ขวด', 'สูตรลดการสะสมของแบคทีเรีย 99.9%', 'active', '2026-10-05 20:15:46'),
(8, 5, 'P008', 'บัตรเติมเงินโทรศัพท์ 100 บาท', 'AIS', 97.00, 100.00, 200, 'ใบ', 'บัตรเติมเงินแฮปปี้/วันทูคอล', 'active', '2026-10-05 20:15:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_code` (`product_code`),
  ADD KEY `fk_product_category` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
