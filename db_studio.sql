-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 14, 2016 at 04:50 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_studio`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_nameth` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `album_nameeng` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `album_createdate` date NOT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=60 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`album_id`, `album_nameth`, `album_nameeng`, `album_createdate`) VALUES
(46, 'แต่งงาน', 'wedding', '2014-07-25'),
(47, 'แฟชั่น', 'fashion', '2014-07-25'),
(48, 'ชุดไทย', 'thai', '2014-07-25'),
(49, 'ครอบครัว', 'family', '2014-07-25'),
(52, 'สัญลักษณ์เครื่องมือ', 'tools', '2014-07-25'),
(51, 'ตกแต่ง', 'decorations', '2014-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `album_file`
--

CREATE TABLE IF NOT EXISTS `album_file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `album_file`
--

INSERT INTO `album_file` (`file_id`, `album_id`, `file_name`) VALUES
(1, 59, 'image/upload/album/20160611185315.jpg'),
(2, 59, 'image/upload/album/20160611185315.jpg'),
(3, 59, 'image/upload/album/20160611185315.jpg'),
(4, 58, 'image/upload/album/20160611185518.jpg'),
(5, 58, 'image/upload/album/20160611185518.jpg'),
(6, 58, 'image/upload/album/20160611185518.jpg'),
(7, 58, 'image/upload/album/20160611185518.jpg'),
(8, 58, 'image/upload/album/20160611185518.jpg'),
(9, 58, 'image/upload/album/20160611185518.jpg'),
(10, 58, 'image/upload/album/20160611185537.jpg'),
(11, 58, 'image/upload/album/20160611185537.jpg'),
(12, 58, 'image/upload/album/20160611185537.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE IF NOT EXISTS `bank` (
  `bank_id` int(3) NOT NULL AUTO_INCREMENT,
  `bank_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=69 ;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_id`, `bank_code`, `bank_name`) VALUES
(55, 'BBL', 'กรุงเทพ'),
(56, 'SCB', 'ไทยพาณิชย์'),
(57, 'BAY', 'กรุงศรีอยุธยา'),
(58, 'KTB', 'กรุงไทย'),
(59, 'TMB', 'ธนาคารทหารไทย'),
(62, 'SCIB', 'นครหลวงไทย'),
(68, 'KBANK', 'กสิกรไทย'),
(64, 'KK', 'เกียตนาคิน'),
(65, 'CITI', 'ซิตี้แบงค์'),
(66, 'BOT', 'แบงค์ชาติ'),
(67, 'BAAC', 'ธกส.');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `img_img` text COLLATE utf8_unicode_ci NOT NULL,
  `img_createdate` date NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`img_id`, `album_id`, `img_img`, `img_createdate`) VALUES
(11, 1, 'images/img_img_/23_20130630_061852.PNG', '2013-10-27'),
(12, 1, 'images/img_img_/22_20130722_072447.png', '2013-11-08'),
(5, 1, 'images/img_img_/11_20130625_214059.jpg', '2013-10-27'),
(10, 1, 'images/img_img_/21_20130703_093310.jpg', '2013-10-27'),
(8, 1, 'images/img_img_/22_20130722_072447.png', '2013-10-27'),
(9, 2, 'images/img_img_/23_20130630_072215.PNG', '2013-10-27'),
(25, 4, 'images/img_img_/service.png', '2014-01-06'),
(24, 1, 'images/img_img_/selectproduct.png', '2014-01-06'),
(26, 1, 'images/img_img_/logout.png', '2014-01-06'),
(27, 2, 'images/img_img_/editprofile.png', '2014-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `loc_id` int(5) NOT NULL AUTO_INCREMENT,
  `loc_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `loc_price` double(6,2) NOT NULL,
  `loc_createdate` date NOT NULL,
  PRIMARY KEY (`loc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`loc_id`, `loc_name`, `loc_price`, `loc_createdate`) VALUES
(1, 'ระยอง', 5000.00, '2013-10-27'),
(2, 'สระแก้ว', 9999.99, '2013-11-07'),
(3, 'จันทบุรี', 1000.00, '2013-11-18'),
(4, 'รังสิต', 10.00, '2013-11-13'),
(5, 'ลาดพร้าว', 100.00, '2013-11-14'),
(9, 'พัทลุง', 999.00, '2014-01-11'),
(10, 'ยะลา', 1000.00, '2014-01-11'),
(12, 'กรุงเทพ', 9999.99, '2014-01-18'),
(13, 'จันทบุรี', 950.00, '2014-01-18'),
(14, 'เชียงใหม่', 450.00, '2014-01-18'),
(15, 'ปทุมธานี', 350.00, '2014-01-18'),
(16, 'อุบลราชธานี', 250.00, '2014-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `order_header`
--

CREATE TABLE IF NOT EXISTS `order_header` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pers_id` int(11) NOT NULL,
  `order_date` date DEFAULT NULL,
  `order_time_begin` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_time_end` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `order_number_fermale` int(3) DEFAULT NULL,
  `order_number_male` int(3) DEFAULT NULL,
  `order_totalprice` double(10,2) DEFAULT NULL,
  `order_deposit` double(10,2) DEFAULT NULL,
  `order_status` int(1) NOT NULL DEFAULT '0' COMMENT '0 = ยังไม่จ่าย,1 = จ่ายแล้ว,2=cancel,3=fail',
  `order_approve_status` int(1) NOT NULL DEFAULT '0' COMMENT 'สถานะ การอนุมัติ 0 = ยัง,1 = แล้ว,2 = error',
  `order_createdate` datetime NOT NULL,
  `order_takephoto` int(1) NOT NULL DEFAULT '0' COMMENT 'สถานะ การถ่ายภาพ 0= ยัง,1 = ถ่ายแล้ว',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `order_header`
--

INSERT INTO `order_header` (`order_id`, `order_code`, `pers_id`, `order_date`, `order_time_begin`, `order_time_end`, `order_number_fermale`, `order_number_male`, `order_totalprice`, `order_deposit`, `order_status`, `order_approve_status`, `order_createdate`, `order_takephoto`) VALUES
(7, '20160612_070601', 38, '2016-06-13', '11:45:00', '13:45:00', 0, 1, 2222.00, 10.00, 0, 0, '2016-06-12 12:17:01', 0),
(6, '20160612_070615', 38, '2016-06-14', '09:45:00', '14:00:00', 2, 1, 67670.00, 5000.00, 0, 0, '2016-06-12 12:15:15', 0),
(3, '20160612_0', 38, '2016-06-14', '09:15:00', '10:00:00', 2, 1, 16.00, 10.00, 0, 0, '2016-06-12 12:08:43', 0),
(4, '20160612_070622', 38, '2016-06-14', '09:15:00', '10:00:00', 5, 1, 4.00, 2.00, 1, 1, '2016-06-12 12:09:22', 0),
(5, '20160612_070617', 38, '2016-06-14', '09:15:00', '09:30:00', 1, 1, 1111.00, 1000.00, 0, 0, '2016-06-12 12:10:17', 0),
(8, '20160612_140654', 38, '2016-06-14', '09:45:00', '11:30:00', 5, 1, 888.00, 500.00, 1, 1, '2016-06-12 19:29:54', 0),
(9, '20160613_130658', 39, '2016-06-14', '09:15:00', '10:00:00', 0, 1, 4444.00, 500.00, 0, 0, '2016-06-13 18:51:58', 0),
(10, '20160613_140635', 39, '2016-06-14', '09:30:00', '10:15:00', 0, 0, 5555.00, 50.00, 0, 1, '2016-06-13 19:06:35', 0),
(11, '20160613_180610', 38, '2016-06-14', '09:00:00', '12:00:00', 1, 5, 165015.00, 5000.00, 0, 0, '2016-06-13 23:21:10', 0),
(12, '20160614_150629', 38, '2018-06-20', '09:00:00', '12:00:00', 0, 1, 400.00, 200.00, 2, 0, '2016-06-14 20:28:29', 0),
(13, '20160614_150640', 38, '2016-06-18', '09:00:00', '10:15:00', 5, 1, 10030.00, 5000.00, 0, 0, '2016-06-14 20:31:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `choose_id` int(11) NOT NULL,
  `item_no` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_type` enum('PACKAGE','UNIT') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`item_id`, `order_id`, `choose_id`, `item_no`, `item_price`, `item_type`) VALUES
(1, 1, 1, 5, 9999, 'PACKAGE'),
(2, 1, 55, 4, 1111, 'UNIT'),
(3, 1, 46, 4, 4, 'UNIT'),
(4, 2, 1, 5, 9999, 'PACKAGE'),
(5, 2, 55, 4, 1111, 'UNIT'),
(6, 2, 46, 4, 4, 'UNIT'),
(7, 3, 46, 4, 4, 'UNIT'),
(8, 4, 46, 1, 4, 'UNIT'),
(9, 5, 55, 1, 1111, 'UNIT'),
(10, 6, 55, 50, 1111, 'UNIT'),
(11, 6, 2, 10, 1212, 'PACKAGE'),
(12, 7, 55, 2, 1111, 'UNIT'),
(13, 8, 6, 1, 888, 'PACKAGE'),
(14, 9, 55, 4, 1111, 'UNIT'),
(15, 10, 55, 5, 1111, 'UNIT'),
(16, 11, 7, 10, 999, 'PACKAGE'),
(17, 11, 9, 10, 500, 'PACKAGE'),
(18, 11, 46, 10, 4, 'UNIT'),
(19, 11, 1, 15, 9999, 'PACKAGE'),
(20, 12, 46, 100, 4, 'UNIT'),
(21, 13, 46, 10, 4, 'UNIT'),
(22, 13, 7, 10, 999, 'PACKAGE');

-- --------------------------------------------------------

--
-- Table structure for table `order_location`
--

CREATE TABLE IF NOT EXISTS `order_location` (
  `order_lo_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  PRIMARY KEY (`order_lo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `order_location`
--

INSERT INTO `order_location` (`order_lo_id`, `order_id`, `loc_id`) VALUES
(1, 10, 12),
(2, 10, 1),
(3, 10, 14),
(4, 11, 12),
(5, 11, 3),
(6, 11, 13),
(7, 11, 5),
(8, 12, 12),
(9, 12, 3),
(10, 13, 1),
(11, 13, 4);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE IF NOT EXISTS `package` (
  `pac_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `pac_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pac_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pac_createdate` date NOT NULL,
  PRIMARY KEY (`pac_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`pac_id`, `pac_name`, `pac_image`, `pac_createdate`) VALUES
(25, 'แต่งงาน', 'image/upload/package/20160611155123.jpg', '2016-06-11'),
(26, 'แฟชั่น', 'image/upload/package/20160611155134.jpg', '2016-06-11'),
(27, 'ไทย', 'image/upload/package/20160611155143.jpg', '2016-06-11'),
(28, 'ครอบครัว', 'image/upload/package/20160611155152.jpg', '2016-06-11'),
(29, 'ชุดไทยเดิม1', 'image/upload/package/20160611154630.jpg', '2016-06-11'),
(31, 'ขึ้นบ้านไหม่', 'image/upload/package/20160611182403.jpg', '2016-06-11'),
(32, 'งานแต่งวันรุ่น', 'image/upload/package/20160611182431.jpg', '2016-06-11'),
(33, 'ลาดพร้าวซอย 1', 'image/upload/package/20160611184523.jpg', '2016-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `package_set`
--

CREATE TABLE IF NOT EXISTS `package_set` (
  `pacset_id` int(11) NOT NULL AUTO_INCREMENT,
  `pac_id` int(11) NOT NULL,
  `pacset_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pacset_price` double(8,2) NOT NULL,
  `pacset_remark` text COLLATE utf8_unicode_ci NOT NULL,
  `pacset_createdate` date NOT NULL,
  PRIMARY KEY (`pacset_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `package_set`
--

INSERT INTO `package_set` (`pacset_id`, `pac_id`, `pacset_name`, `pacset_price`, `pacset_remark`, `pacset_createdate`) VALUES
(1, 28, '8888', 9999.00, '9999', '2016-06-11'),
(2, 28, '121212', 1212.00, '1212', '2016-06-11'),
(3, 26, '787878', 8989.00, '898989', '2016-06-11'),
(4, 25, '242424', 4242.00, '24242', '2016-06-11'),
(5, 28, 'ทดสอบ', 999.00, '9999', '2016-06-11'),
(6, 28, 'ทดสอบการสร้าง ชุด แพ๊กเก็ต', 888.00, '7777', '2016-06-11'),
(7, 29, 'ไทย 1 ', 999.00, '9999', '2016-06-12'),
(8, 29, 'ไทย 2', 10599.00, '', '2016-06-12'),
(9, 31, 'ขึ้นบ้าใหม่ 1', 500.00, '', '2016-06-13'),
(10, 26, 'แฟชั่น 1', 1000.00, '', '2016-06-13'),
(11, 32, 'งานแต่งวันรุ่น 1', 15000.00, '', '2016-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `package_set_detail`
--

CREATE TABLE IF NOT EXISTS `package_set_detail` (
  `setd_id` int(11) NOT NULL AUTO_INCREMENT,
  `pacset_id` int(11) NOT NULL,
  `setd_imgsize` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `setd_number` int(11) NOT NULL,
  `setd_index` int(11) NOT NULL,
  PRIMARY KEY (`setd_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=67 ;

--
-- Dumping data for table `package_set_detail`
--

INSERT INTO `package_set_detail` (`setd_id`, `pacset_id`, `size_id`, `setd_number`, `setd_index`) VALUES
(1, 1, '1', 99999, 0),
(2, 1, '1', 99999, 0),
(3, 1, '3', 8888, 1),
(4, 1, '1', 99999, 0),
(5, 1, '1', 7777, 2),
(6, 1, '5', 99999, 0),
(29, 3, '2', 89898989, 0),
(28, 2, '1', 66, 7),
(25, 2, '5', 444444, 3),
(27, 2, '1', 55, 6),
(23, 2, '3', 33333, 2),
(26, 2, '1', 44, 5),
(19, 2, '2', 87878, 4),
(30, 3, '2', 898989, 2),
(31, 4, '3', 424242, 0),
(32, 5, '3', 88888, 0),
(33, 5, '3', 7777, 1),
(34, 5, '3', 999, 2),
(35, 5, '2', 9999, 3),
(36, 5, '1', 5555, 4),
(39, 6, '1', 444, 0),
(38, 5, '3', 88888, 0),
(40, 7, '1', 2, 0),
(41, 7, '5', 3, 1),
(42, 7, '2', 2, 2),
(43, 7, '5', 5, 3),
(44, 8, '10', 1, 0),
(45, 8, '11', 2, 1),
(46, 8, '11', 3, 2),
(47, 8, '5', 5, 3),
(48, 8, '5', 8, 4),
(49, 8, '11', 5, 5),
(50, 8, '11', 5, 6),
(51, 9, '1', 2, 0),
(52, 9, '1', 2, 1),
(53, 10, '3', 10, 0),
(54, 10, '11', 15, 1),
(55, 10, '2', 10, 2),
(56, 10, '1', 5, 3),
(57, 10, '5', 3, 4),
(58, 10, '5', 1, 5),
(59, 10, '5', 5, 6),
(60, 11, '5', 5, 0),
(61, 11, '3', 1, 1),
(62, 11, '3', 2, 2),
(63, 11, '11', 5, 3),
(64, 11, '11', 10, 4),
(65, 11, '11', 15, 5),
(66, 11, '11', 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_id` int(3) NOT NULL,
  `order_id` int(11) NOT NULL,
  `pay_date` date NOT NULL,
  `pay_time` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `pay_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pay_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `pay_createdate` date NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `bank_id`, `order_id`, `pay_date`, `pay_time`, `pay_file`, `pay_comment`, `pay_createdate`) VALUES
(33, 55, 4, '2013-06-20', '15:00', 'image/upload/payment/20160612152743.pdf', '', '2016-06-12'),
(32, 55, 8, '2013-06-20', '17:10', 'image/upload/payment/20160612152203.pdf', '5555', '2016-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `pers_id` int(11) NOT NULL AUTO_INCREMENT,
  `pref_id` int(2) NOT NULL,
  `pers_status` enum('CUSTOMER','ADMIN') COLLATE utf8_unicode_ci NOT NULL COMMENT '1=admin,2=customer',
  `pers_username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pers_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pers_fname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pers_lname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pers_idcard` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pers_birthday` date NOT NULL,
  `pers_address` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pers_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `pers_email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pers_active` enum('active','nonactive') COLLATE utf8_unicode_ci NOT NULL,
  `pers_createdate` date NOT NULL,
  PRIMARY KEY (`pers_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`pers_id`, `pref_id`, `pers_status`, `pers_username`, `pers_password`, `pers_fname`, `pers_lname`, `pers_idcard`, `pers_birthday`, `pers_address`, `pers_phone`, `pers_email`, `pers_active`, `pers_createdate`) VALUES
(1, 1, 'ADMIN', 'admin', '1234', 'admin', 'admin', '111-111-111111-11', '2013-10-27', '191', '0878356866', 'admin@hotmail.com', 'active', '2013-10-27'),
(39, 3, 'CUSTOMER', 'test', '1234', 'test', 'test', '1212121221212', '2011-06-20', '454545', '9', 'admin@gmail.com', 'active', '0000-00-00'),
(38, 0, 'CUSTOMER', 'user', '1234', 'user', 'user', '8', '2010-06-20', '8', '8', 'user@gmail.com', 'active', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `photo_size`
--

CREATE TABLE IF NOT EXISTS `photo_size` (
  `size_id` int(11) NOT NULL AUTO_INCREMENT,
  `size_name` varchar(50) NOT NULL,
  `size_unit` varchar(25) NOT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `photo_size`
--

INSERT INTO `photo_size` (`size_id`, `size_name`, `size_unit`) VALUES
(1, '11x11', 'นิ้ว'),
(2, '2x2', 'เซนติเมตร'),
(3, '1x1', 'นิ้ว'),
(4, '99x99', 'นิ้ว'),
(5, '1212x1212', 'นิ้ว'),
(10, '777x8888', 'เซนติเมตร'),
(11, '100x100', 'เซนติเมตร');

-- --------------------------------------------------------

--
-- Table structure for table `prefix`
--

CREATE TABLE IF NOT EXISTS `prefix` (
  `pref_id` int(11) NOT NULL AUTO_INCREMENT,
  `pref_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `pref_desc` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pref_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `prefix`
--

INSERT INTO `prefix` (`pref_id`, `pref_name`, `pref_desc`) VALUES
(1, 'Mr', 'นาย'),
(2, 'Miss', 'นางสาว'),
(3, 'Mrs', 'นาง'),
(4, 'Dr', 'ด๊อกเตอร์'),
(11, 'ด.ช.', 'เด็กชาย'),
(12, 'ด.ญ.', 'เด็กหญิง'),
(13, 'ว่าที่ ร.ต.', 'ว่าที่ ร้อยตรี');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prod_price` int(11) NOT NULL,
  `prod_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prod_createdate` date NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_name`, `prod_price`, `prod_image`, `prod_createdate`) VALUES
(50, 'พูลสวัสดิ์', 10000, 'image/upload/product/20160611203955.jpg', '2016-06-12'),
(39, 'ทดสอบ', 100, 'image/upload/product/20160611203934.jpg', '2016-06-12'),
(46, '4', 4, 'image/upload/product/20160611203753.jpg', '2016-06-12'),
(49, 'กระเป๋า', 100, 'image/upload/product/20160611203925.jpg', '2016-06-12'),
(55, 'Picture', 1111, 'image/upload/product/20160611203804.jpg', '2016-06-12'),
(56, 'ทดสอบ', 100, 'image/upload/product/20160611203945.jpg', '2016-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `prom_id` int(11) NOT NULL AUTO_INCREMENT,
  `prom_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prom_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prom_startdate` date NOT NULL,
  `prom_enddate` date NOT NULL,
  `prom_createdate` date NOT NULL,
  PRIMARY KEY (`prom_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`prom_id`, `prom_name`, `prom_file`, `prom_startdate`, `prom_enddate`, `prom_createdate`) VALUES
(17, 'ลด ราคา เฉพาะ', '6ncqsOSroL.jpg', '2014-08-03', '2014-08-12', '2014-07-26'),
(15, 'ซื้อ 2 แถม 1', 'bZKLQ4PE1Q.jpg', '2014-07-26', '2014-08-30', '2014-07-26'),
(16, 'ซื้อ 3 แถม 1', 'ulIUramlUZ.jpg', '2014-08-01', '2014-08-29', '2014-07-26'),
(14, 'ซื้อ 1 แถม 1', '7c0XL0RIK3.gif', '2014-08-03', '2014-08-30', '2014-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `prov_id` int(5) NOT NULL AUTO_INCREMENT,
  `prov_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`prov_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=79 ;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`prov_id`, `prov_name`) VALUES
(1, 'กรุงเทพมหานคร   '),
(2, 'สมุทรปราการ   '),
(3, 'นนทบุรี   '),
(4, 'ปทุมธานี   '),
(5, 'พระนครศรีอยุธยา   '),
(6, 'อ่างทอง   '),
(7, 'ลพบุรี   '),
(8, 'สิงห์บุรี   '),
(9, 'ชัยนาท   '),
(10, 'สระบุรี'),
(11, 'ชลบุรี   '),
(12, 'ระยอง   '),
(13, 'จันทบุรี   '),
(14, 'ตราด   '),
(15, 'ฉะเชิงเทรา   '),
(16, 'ปราจีนบุรี   '),
(17, 'นครนายก   '),
(18, 'สระแก้ว   '),
(19, 'นครราชสีมา   '),
(20, 'บุรีรัมย์   '),
(21, 'สุรินทร์   '),
(22, 'ศรีสะเกษ   '),
(23, 'อุบลราชธานี   '),
(24, 'ยโสธร   '),
(25, 'ชัยภูมิ   '),
(26, 'อำนาจเจริญ   '),
(27, 'หนองบัวลำภู   '),
(28, 'ขอนแก่น   '),
(29, 'อุดรธานี   '),
(30, 'เลย   '),
(31, 'หนองคาย   '),
(32, 'มหาสารคาม   '),
(33, 'ร้อยเอ็ด   '),
(34, 'กาฬสินธุ์   '),
(35, 'สกลนคร   '),
(36, 'นครพนม   '),
(37, 'มุกดาหาร   '),
(38, 'เชียงใหม่   '),
(39, 'ลำพูน   '),
(40, 'ลำปาง   '),
(41, 'อุตรดิตถ์   '),
(42, 'แพร่   '),
(43, 'น่าน   '),
(44, 'พะเยา   '),
(45, 'เชียงราย   '),
(46, 'แม่ฮ่องสอน   '),
(47, 'นครสวรรค์   '),
(48, 'อุทัยธานี   '),
(49, 'กำแพงเพชร   '),
(50, 'ตาก   '),
(51, 'สุโขทัย   '),
(52, 'พิษณุโลก   '),
(53, 'พิจิตร   '),
(54, 'เพชรบูรณ์   '),
(55, 'ราชบุรี   '),
(56, 'กาญจนบุรี   '),
(57, 'สุพรรณบุรี   '),
(58, 'นครปฐม   '),
(59, 'สมุทรสาคร   '),
(60, 'สมุทรสงคราม   '),
(61, 'เพชรบุรี   '),
(62, 'ประจวบคีรีขันธ์   '),
(63, 'นครศรีธรรมราช   '),
(64, 'กระบี่   '),
(65, 'พังงา   '),
(66, 'ภูเก็ต   '),
(67, 'สุราษฎร์ธานี   '),
(68, 'ระนอง   '),
(69, 'ชุมพร   '),
(70, 'สงขลา   '),
(71, 'สตูล   '),
(72, 'ตรัง   '),
(73, 'พัทลุง   '),
(74, 'ปัตตานี   '),
(75, 'ยะลา   '),
(76, 'นราธิวาส   '),
(77, 'บึงกาฬ');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
