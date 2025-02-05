-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2025 at 08:14 AM
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
  `billing_month` varchar(50) NOT NULL,
  `maintenance` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_active`
--

INSERT INTO `tbl_active` (`id`, `account_number_active`, `name`, `consumer_status_active`, `area`, `blk_lot`, `reading`, `date_reconnected`, `billing_month`, `maintenance`, `remarks`) VALUES
(1, 12345, 'asd', 'asd', 'area ', 'qew2', 'qwe', '2025-02-04', 'march', 'sdf', 'sdf'),
(2, 9999, 'TESTING LANG', 'DISCONNECTED', 'SILANGAN', 'q12', '13456', '2025-02-05', '2025-03-01', 'john doe', 'asd'),
(3, 1324655, 'Ryan oliver', 'ACTIVE', 'silangan', '2 ', '13456', '2025-02-05', '2025-03-01', 'john doe', 'asd'),
(4, 1324655, 'Ryan oliver', 'ACTIVE', 'silangan', '2 ', '13456', '2025-02-05', '2025-03-01', 'john doe', 'asd');

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
(1, 'ryan oliver', 'ryansgeh', 'rehsuyrg3'),
(2, 'asd', 'asd', 'asd'),
(3, 'yuo', 'uois', 'jklj'),
(4, '', '', '');

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
  `billing_month` varchar(50) NOT NULL,
  `disconnector` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_disconnected`
--

INSERT INTO `tbl_disconnected` (`id`, `account_number_disconnected`, `name`, `consumer_status_disconnected`, `area`, `blk_lot`, `reading`, `date_disconnected`, `billing_month`, `disconnector`, `remarks`) VALUES
(1, 123456, 'asd', 'asd', 'qwe', 'wer', 'wer', '2025-02-04', '2025-02', 'asd', 'fsdf'),
(2, 234, 'random', 'DISCONNECTED', 'SILANGAN', 'q12', '13456', '2025-02-04', '0000-00', 'jhai', 'sample'),
(3, 9999, 'TESTING LANG', 'DISCONNECTED', 'SILANGAN', 'q12', '13456', '2025-02-05', '0000-00', 'jhai', 'asd'),
(4, 1324655, 'Ryan oliver', 'ACTIVE', 'silangan', '2 ', '13456', '2025-02-05', '0000-00', 'jhai', 'asd'),
(5, 234, 'random', 'DISCONNECTED', 'SILANGAN', 'q12', '13456', '2025-02-05', '2025-03', 'jhai', 'asd'),
(6, 234, 'random', 'DISCONNECTED', 'SILANGAN', 'q12', '13456', '2025-02-05', '2025-03', 'ryan', 'eeeeeeeeeeeeeeeeeeee'),
(7, 1324655, 'Ryan oliver', 'ACTIVE', 'silangan', '2 ', '13456', '2025-02-04', '2025-02', 'jhai', 'asd');

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
(26, 9999, 'TESTING LANG', 'SILANGAN', 'q12', 323, 'asd', 'male', 2147483647, 'qe', 'hj', 'qwe', '', '', '123', 'qwe', 'wre', 1232, '2025-02-03', '2025-02-03', 123, 'jan', 'qwe', 'qwe', 'qwe', 'ACTIVE'),
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
(1, 'TESTING LANG', 'SILANGAN', 'asd', '12345', '4124', '123465', '2025-02-03', 2025, 'asd', 213);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_collectors_profile`
--
ALTER TABLE `tbl_collectors_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_disconnected`
--
ALTER TABLE `tbl_disconnected`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_members_profile`
--
ALTER TABLE `tbl_members_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_meter_replacement`
--
ALTER TABLE `tbl_meter_replacement`
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
