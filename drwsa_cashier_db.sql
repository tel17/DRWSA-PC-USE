-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2025 at 01:14 PM
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
-- Database: `drwsa_cashier_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_db`
--

CREATE TABLE `admin_db` (
  `id` int(11) NOT NULL,
  `account_id` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `account_type` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `account_created` date NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_db`
--

INSERT INTO `admin_db` (`id`, `account_id`, `email`, `password`, `firstname`, `lastname`, `account_type`, `contact`, `position`, `account_created`, `image_url`) VALUES
(1, '922831912', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 'admin', '09548381222', 'Admin', '2024-09-23', 'Screenshot_2017-01-17-16-56-56.jpg'),
(2, '123456789', 'hakdog@gmail.com', '6bb02b9216e00e07e59f66787653dd18', 'hakdog', 'hakdog', 'admin2', '09075656823', 'admin', '2025-01-02', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_active`
--

CREATE TABLE `tbl_active` (
  `id` int(11) NOT NULL,
  `account_number_active` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `consumer_status_active` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `blk_lot` varchar(255) NOT NULL,
  `reading` varchar(255) NOT NULL,
  `date_reconnected` date NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` int(10) NOT NULL,
  `maintenance` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_active`
--

INSERT INTO `tbl_active` (`id`, `account_number_active`, `name`, `consumer_status_active`, `area`, `blk_lot`, `reading`, `date_reconnected`, `month`, `year`, `maintenance`, `remarks`) VALUES
(6, 1324655, 'Ryan oliver', '', 'SILANGAN', '2 ', '13456', '2025-02-06', '2025-02-01', 2025, 'john doe', 'asd'),
(7, 9999, 'TESTING LANG', '', 'SILANGAN', 'q12', '13456', '2025-02-05', '2025-02-01', 2025, 'john doe', 'asd'),
(8, 9999, 'TESTING LANG', '', 'SILANGAN', 'q12', '13456', '2025-02-07', '2025-02-01', 2025, 'john doe', 'asd'),
(9, 1324655, 'Ryan oliver', '', 'SILANGAN', '2 ', '13456', '2025-02-06', '2025-02-01', 2025, 'john doe', 'asd'),
(10, 1324655, 'Ryan oliver', '', 'SILANGAN', '2 ', '13456', '2025-02-06', '2025-03-01', 2025, 'john doe', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area`
--

CREATE TABLE `tbl_area` (
  `id` int(11) NOT NULL,
  `area` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_area`
--

INSERT INTO `tbl_area` (`id`, `area`) VALUES
(0, 'SILANGAN'),
(0, 'KANLURAN'),
(0, 'JANOPOL');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_collectors_profile`
--

CREATE TABLE `tbl_collectors_profile` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_collectors_profile`
--

INSERT INTO `tbl_collectors_profile` (`id`, `fullname`, `username`, `password`) VALUES
(5, 'aa', 'aaa', '$2y$10$SHBlkIuiHksAFPzWfIlyZemcmy1aq6htKTzFAIDeBafAkhAd8l08u'),
(6, 'hh', 'hh', '$2y$10$5hrbhtjEkq1HTCZ0b9CfSeNvcBO2tbV/Veyv6RnVcDUIE8wt8kt8y'),
(7, 'chester', 'chester', '$2y$10$zGB09SeczZ7nW2/POEqUVORr187yZqlHJH0vNf2Di8c8RV76ptts.'),
(8, 'zz', 'zz', '$2y$10$K9ITqTA7kuadYIRGFVbzx.t2vlsZ.Vo9JoLRGuGLF7IvBgy.LqWZa'),
(9, 'oliver', 'oliver', '$2y$10$DXPw.BXXXnuVOEDpBaUQseljLhLA.VfJEPwDvW73iTf5eZgpbvqkG'),
(10, 'oliver', 'aa', '$2y$10$36aXUCWmmXb6jGDbEMfhdOVI4cV/SfUsHk6w/ZHspvqcWUy3WHUny'),
(11, 'hha', 'aa', '$2y$10$YivwHsX3H01Bx2IrqGOp4uh0XKPSw12fitCf.k6pSOj3oQqg0.Zta'),
(12, 'yy', 'yy', '$2y$10$b9e0chryAZUPEFavqts0P.lkbFvB/3jSQAnwTa8uiY9wSQF1fk4/.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_daily_collection_report`
--

CREATE TABLE `tbl_daily_collection_report` (
  `id` int(11) NOT NULL,
  `account_number` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `or_number` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `penalty` int(255) NOT NULL,
  `SC` int(255) NOT NULL,
  `discount` int(255) NOT NULL,
  `blk_lot` int(255) NOT NULL,
  `area` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_daily_collection_report`
--

INSERT INTO `tbl_daily_collection_report` (`id`, `account_number`, `name`, `month`, `or_number`, `amount`, `penalty`, `SC`, `discount`, `blk_lot`, `area`) VALUES
(1, 123456, 'Arnold Jayson', 'JANUARY', 14523, 102, 0, 0, 0, 0, 'SILANGAN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_disconnected`
--

CREATE TABLE `tbl_disconnected` (
  `id` int(11) NOT NULL,
  `account_number_disconnected` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `consumer_status_disconnected` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `blk_lot` varchar(255) NOT NULL,
  `reading` varchar(255) NOT NULL,
  `date_disconnected` date NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` int(10) NOT NULL,
  `disconnector` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_disconnected`
--

INSERT INTO `tbl_disconnected` (`id`, `account_number_disconnected`, `name`, `consumer_status_disconnected`, `area`, `blk_lot`, `reading`, `date_disconnected`, `month`, `year`, `disconnector`, `remarks`) VALUES
(1, 123456, 'asd', 'asd', 'qwe', 'wer', 'wer', '2025-02-04', '2025-02', 0, 'asd', 'fsdf'),
(5, 234, 'random', 'DISCONNECTED', 'SILANGAN', 'q12', '13456', '2025-02-05', '2025-03', 0, 'jhai', 'asd'),
(6, 234, 'random', 'DISCONNECTED', 'SILANGAN', 'q12', '13456', '2025-02-05', '2025-03', 0, 'ryan', 'eeeeeeeeeeeeeeeeeeee'),
(7, 1324655, 'Ryan oliver', 'ACTIVE', 'silangan', '2 ', '13456', '2025-02-04', '2025-02', 0, 'jhai', 'asd'),
(8, 234, 'random', 'DISCONNECTED', 'SILANGAN', 'q12', '13456', '2025-02-05', '2025-03', 0, 'jhai', 'asd'),
(9, 1324655, 'Ryan oliver', '', 'SILANGAN', '2 ', '13456', '2025-02-06', '2025-02', 2025, 'jhai', 'asd'),
(10, 9999, 'TESTING LANG', '', 'SILANGAN', 'q12', '13456', '2025-02-07', '2025-02', 2025, 'jhai', 'asd'),
(11, 9999, 'TESTING LANG', '', 'SILANGAN', 'q12', '13456', '2025-02-07', '2025-02', 2025, 'jhai', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members_profile`
--

CREATE TABLE `tbl_members_profile` (
  `id` int(11) NOT NULL,
  `account_number` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `block` varchar(255) NOT NULL,
  `age` int(100) NOT NULL,
  `status` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contact` int(255) NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `education_attainment` varchar(255) NOT NULL,
  `family_member_1` varchar(255) NOT NULL,
  `family_member_2` varchar(255) NOT NULL,
  `family_member_3` varchar(255) NOT NULL,
  `income` varchar(255) NOT NULL,
  `cedula` varchar(255) NOT NULL,
  `clearance` varchar(255) NOT NULL,
  `meter_number` int(255) NOT NULL,
  `date_filed` date NOT NULL,
  `birthday` date NOT NULL,
  `amount` int(255) NOT NULL,
  `month_for_data` varchar(255) NOT NULL,
  `beneficiary_1` varchar(255) NOT NULL,
  `beneficiary_2` varchar(255) NOT NULL,
  `beneficiary_3` varchar(255) NOT NULL,
  `consumer_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_members_profile`
--

INSERT INTO `tbl_members_profile` (`id`, `account_number`, `name`, `area`, `block`, `age`, `status`, `gender`, `contact`, `birthplace`, `education_attainment`, `family_member_1`, `family_member_2`, `family_member_3`, `income`, `cedula`, `clearance`, `meter_number`, `date_filed`, `birthday`, `amount`, `month_for_data`, `beneficiary_1`, `beneficiary_2`, `beneficiary_3`, `consumer_status`) VALUES
(25, 1324655, 'Ryan oliver', 'silangan', '2 ', 12, 'married', 'male', 90746465, 'cale', 'asdffg', 'asd', '', '', '123', 'qwe', 'we', 1232, '2025-02-03', '2025-02-03', 213, 'jan', 'qwe', 'qwe', 'qwe', 'ACTIVE'),
(26, 9999, 'TESTING LANG', 'SILANGAN', 'q12', 323, 'asd', 'male', 2147483647, 'qe', 'hj', 'qwe', '', '', '123', 'qwe', 'wre', 1232, '2025-02-03', '2025-02-03', 123, 'jan', 'qwe', 'qwe', 'qwe', 'DISCONNECTED'),
(27, 234, 'random', 'SILANGAN', 'q12', 323, 'DISCONNECTED', 'male', 2147483647, 'qe', 'hj', 'qwe', '', '', '123', 'qwe', 'wre', 1232, '2025-02-04', '2025-02-04', 12, 'jan', 'qwe', 'qwe', 'qwe', 'DISCONNECTED'),
(28, 9999, 'TESTING LANG', 'SILANGAN', 'q12', 323, 'asd', 'male', 2147483647, 'qe', 'hj', 'qwe', '', '', '123', 'qwe', 'wre', 1232, '2025-02-03', '2025-02-03', 123, 'jan', 'qwe', 'qwe', 'qwe', 'DISCONNECTED');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_meter_replacement`
--

CREATE TABLE `tbl_meter_replacement` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `block_lot` varchar(255) NOT NULL,
  `old_reading` varchar(255) NOT NULL,
  `new_reading` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `date_filed` date NOT NULL,
  `year` int(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `mid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_meter_replacement`
--

INSERT INTO `tbl_meter_replacement` (`id`, `name`, `area`, `block_lot`, `old_reading`, `new_reading`, `serial_number`, `date_filed`, `year`, `remarks`, `mid`) VALUES
(1, 'TESTING LANG', 'SILANGAN', 'asd', '12345', '4124', '123465', '2025-02-03', 2025, 'asd', 213),
(2, 'random', 'silangan', 'asd', '12345', '4124', '123465', '2025-02-05', 2025, 'sdf', 234),
(3, 'random', 'SILANGAN', 'asd', '12345', '4124', '123465', '2025-02-13', 2025, 'asd', 123),
(4, 'random', 'KANLURAN', 'asd', '12345', '4124', '123465', '2025-02-06', 2025, 'fgh', 1234),
(5, 'iop', 'JANOPOL', 'asd', '12345', '4124', '123465', '2025-02-07', 2025, 'sample remarks', 123);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newconnection`
--

CREATE TABLE `tbl_newconnection` (
  `id` int(11) NOT NULL,
  `account_number_new_connection` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `blk_lot` varchar(255) NOT NULL,
  `meter` varchar(255) NOT NULL,
  `date_connect` date NOT NULL,
  `month` varchar(50) NOT NULL,
  `new_connect_maintenance` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_newconnection`
--

INSERT INTO `tbl_newconnection` (`id`, `account_number_new_connection`, `name`, `area`, `blk_lot`, `meter`, `date_connect`, `month`, `new_connect_maintenance`, `remarks`) VALUES
(1, 1324655, 'Ryan oliver', 'SILANGAN', '2 ', '13465879', '2025-02-07', '2025-03', 'JOHN DOE', 'asd'),
(2, 234, 'random', 'KANLURAN', 'q12', '13465879', '2025-02-06', '2025-03', 'JOHN DOE', 'asd'),
(3, 1324655, 'Ryan oliver', 'SILANGAN', '2 ', '13465879', '2025-02-06', '2025-02', 'JOHN DOE', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reading`
--

CREATE TABLE `tbl_reading` (
  `id` int(11) NOT NULL,
  `account_number` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `blk_lot` varchar(255) NOT NULL,
  `present_1` int(255) NOT NULL,
  `previous_1` int(255) NOT NULL,
  `present_2` int(255) NOT NULL,
  `previous_2` int(255) NOT NULL,
  `consumed` int(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `total_consumed` int(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `sc_discount` int(255) NOT NULL,
  `free_of_charge` varchar(255) NOT NULL,
  `discount` int(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `disc_date` date NOT NULL,
  `billing_period` date NOT NULL,
  `grand_total` int(255) NOT NULL,
  `reader_name` varchar(255) NOT NULL,
  `penalty` int(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reading`
--

INSERT INTO `tbl_reading` (`id`, `account_number`, `name`, `area`, `blk_lot`, `present_1`, `previous_1`, `present_2`, `previous_2`, `consumed`, `remarks`, `total_consumed`, `amount`, `sc_discount`, `free_of_charge`, `discount`, `month`, `category`, `due_date`, `disc_date`, `billing_period`, `grand_total`, `reader_name`, `penalty`, `payment_status`) VALUES
(20, 12345678, 'TESTING LANG', 'JANOPOL', '2 ', 0, 0, 9, 8, 1, 'asd', 9, 131.50, 7, '', 13, 'January', 'residential', '2025-02-10', '2025-02-10', '2025-02-11', 112, 'chester', 0, 'cashier'),
(21, 234, 'random', 'SILANGAN', 'q12', 0, 0, 9, 8, 1, 'asd', 9, 131.50, 7, '', 13, 'January', 'residential', '2025-02-10', '2025-02-10', '2025-02-10', 112, 'chester', 0, 'collector'),
(22, 123546, 'random', 'JANOPOL', '2 ', 0, 0, 9, 8, 1, '', 9, 131.50, 7, '', 7, 'December', 'residential', '2025-02-10', '2025-02-10', '2025-02-10', 118, 'chester', 0, 'unpaid'),
(23, 456, 'random', 'JANOPOL', '2 ', 9, 8, 0, 9, 1, 'asd', 18, 131.50, 7, '', 3, 'November', 'residential', '2025-02-10', '2025-02-10', '2025-02-10', 122, 'chester', 0, 'cashier'),
(24, 9999, 'ads', 'JANOPOL', '2 ', 0, 0, 9, 8, 1, 'sample remarks', 9, 790.50, 40, '', 0, 'January', 'commercial_a', '2025-02-11', '2025-02-10', '2025-02-11', 751, 'chester', 0, 'collector'),
(25, 456, 'wer', 'JANOPOL', '2 ', 9, 8, 0, 9, 1, 'sample remarks', 18, 131.50, 0, '', 0, 'January', 'residential', '2025-02-10', '2025-02-10', '2025-02-10', 132, 'chester', 0, 'cashier'),
(26, 234, 'random', 'JANOPOL', '2 ', 0, 0, 15, 8, 7, 'sample remarks', 15, 189.50, 0, '', 0, 'November', 'residential', '2025-02-10', '2025-02-10', '2025-02-10', 190, 'chester', 0, 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `tb_commercial_tariff`
--

CREATE TABLE `tb_commercial_tariff` (
  `id` int(11) NOT NULL,
  `category` enum('Commercial A','Commercial B') NOT NULL,
  `first` decimal(10,2) NOT NULL,
  `second` decimal(10,2) NOT NULL,
  `third` decimal(10,2) NOT NULL,
  `fourth` decimal(10,2) NOT NULL,
  `last` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_commercial_tariff`
--

INSERT INTO `tb_commercial_tariff` (`id`, `category`, `first`, `second`, `third`, `fourth`, `last`) VALUES
(1, 'Commercial A', 790.50, 60.60, 75.70, 102.20, 148.20),
(2, 'Commercial B', 650.00, 60.60, 75.70, 102.20, 148.20);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tariff`
--

CREATE TABLE `tb_tariff` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'residential',
  `first` decimal(10,2) NOT NULL,
  `second` decimal(10,2) NOT NULL,
  `third` decimal(10,2) NOT NULL,
  `fourth` decimal(10,2) NOT NULL,
  `fifth` decimal(10,2) NOT NULL,
  `sixth` decimal(10,2) NOT NULL,
  `last` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tariff`
--

INSERT INTO `tb_tariff` (`id`, `category`, `first`, `second`, `third`, `fourth`, `fifth`, `sixth`, `last`) VALUES
(1, 'residential', 131.50, 29.00, 34.80, 43.40, 56.50, 76.20, 76.20);

-- --------------------------------------------------------

--
-- Table structure for table `user_db`
--

CREATE TABLE `user_db` (
  `id` int(11) NOT NULL,
  `user_id` varchar(90) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `account_type` varchar(100) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_db`
--

INSERT INTO `user_db` (`id`, `user_id`, `email`, `password`, `firstname`, `lastname`, `middlename`, `gender`, `contact`, `address`, `account_type`, `date_created`) VALUES
(4, '285524520241009', 'bucad.eddierackiel@gmail.com', 'd3c4e147a8b290f4a8a9d1d2e3ac6681', 'Ralph', 'Medrana', 'D', 'Male', '09506543210', 'sta maria sto tomas batangas', 'user', '2024-09-23'),
(9, '490089220241009', 'robertdave@gmail.com', 'd3c4e147a8b290f4a8a9d1d2e3ac6681', 'Robert', 'Nazareth', 'D', 'Male', '09506543210', 'pangasinan', 'User', '2024-10-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_db`
--
ALTER TABLE `admin_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_active`
--
ALTER TABLE `tbl_active`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_collectors_profile`
--
ALTER TABLE `tbl_collectors_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_daily_collection_report`
--
ALTER TABLE `tbl_daily_collection_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_disconnected`
--
ALTER TABLE `tbl_disconnected`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_members_profile`
--
ALTER TABLE `tbl_members_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_meter_replacement`
--
ALTER TABLE `tbl_meter_replacement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_newconnection`
--
ALTER TABLE `tbl_newconnection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reading`
--
ALTER TABLE `tbl_reading`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_commercial_tariff`
--
ALTER TABLE `tb_commercial_tariff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tariff`
--
ALTER TABLE `tb_tariff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_db`
--
ALTER TABLE `user_db`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_db`
--
ALTER TABLE `admin_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_active`
--
ALTER TABLE `tbl_active`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_collectors_profile`
--
ALTER TABLE `tbl_collectors_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_daily_collection_report`
--
ALTER TABLE `tbl_daily_collection_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_disconnected`
--
ALTER TABLE `tbl_disconnected`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_members_profile`
--
ALTER TABLE `tbl_members_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_meter_replacement`
--
ALTER TABLE `tbl_meter_replacement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_newconnection`
--
ALTER TABLE `tbl_newconnection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_reading`
--
ALTER TABLE `tbl_reading`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_commercial_tariff`
--
ALTER TABLE `tb_commercial_tariff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_tariff`
--
ALTER TABLE `tb_tariff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_db`
--
ALTER TABLE `user_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
