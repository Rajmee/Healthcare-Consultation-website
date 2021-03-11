-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2021 at 03:41 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_rest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(6, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin@gmail.com', '', '2018-04-09 07:36:18'),
(8, 'abc888', '6d0361d5777656072438f6e314a852bc', 'abc@gmail.com', 'QX5ZMN', '2018-04-13 18:12:30'),
(9, 'rajme', 'e10adc3949ba59abbe56e057f20f883e', 'rajme@gmaiil.com', 'QMZR92', '2020-12-21 22:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `admin_codes`
--

CREATE TABLE `admin_codes` (
  `id` int(222) NOT NULL,
  `codes` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_codes`
--

INSERT INTO `admin_codes` (`id`, `codes`) VALUES
(1, 'QX5ZMN'),
(2, 'QFE6ZM'),
(3, 'QMZR92'),
(4, 'QPGIOV'),
(5, 'QSTE52'),
(6, 'QMTZ2J');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_list`
--

CREATE TABLE `appointment_list` (
  `id` int(222) NOT NULL,
  `patient_id` int(222) NOT NULL,
  `doc_name` varchar(222) CHARACTER SET latin1 NOT NULL,
  `doc_id` int(11) NOT NULL,
  `times` int(222) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `schedule` datetime DEFAULT NULL,
  `status` varchar(222) CHARACTER SET latin1 DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_remark`
--

CREATE TABLE `appointment_remark` (
  `id` int(11) NOT NULL,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET latin1 NOT NULL,
  `remark` mediumtext CHARACTER SET latin1 NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `img` varchar(222) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dep_cat`
--

CREATE TABLE `dep_cat` (
  `dep_id` int(222) NOT NULL,
  `title` varchar(222) CHARACTER SET latin1 NOT NULL,
  `descr` varchar(222) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `img` varchar(222) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dep_cat`
--

INSERT INTO `dep_cat` (`dep_id`, `title`, `descr`, `img`) VALUES
(3, 'Cardiology', 'Cardiology is the study and treatment of disorders of the heart and the blood vessels.', '5fc6c72f4cd54.jpg'),
(4, 'Gynecologist', 'Gynecologists are doctors.', '5fc6c31dcc11c.jpg'),
(6, 'Neorologist', 'Neurology is a branch of medicine dealing with disorders of the nervous system.', '5fc6c6e3193a5.png'),
(7, 'Medicine', 'Medicine is the science and practice of establishing the diagnosis, prognosis, treatment, and prevention of disease.', '5fc6c797d059d.jpg'),
(8, 'Dentist', 'A dentist, also known as a dental surgeon, is a surgeon who specializes in dentistry, the diagnosis, prevention, and treatment of diseases and conditions ', '5fc6c7e01b6be.jpg'),
(9, 'Orthopedist', 'An orthopedic surgeon, a physician who corrects congenital or functional abnormalities of the bones with surgery, casting, and bracing.', '5fe127a361f55.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `d_id` int(222) NOT NULL,
  `rs_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `slogan` varchar(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`d_id`, `rs_id`, `title`, `slogan`, `price`, `img`) VALUES
(20, 54, 'Sugatrol 100mg 10pcs', 'Generic : Acarbose 100 mg  Company : Pacific Pharmaceuticals Ltd.', '240.00', '5fc6e8091e91d.jpg'),
(21, 55, 'Napa 500mg', 'Napa Extra Tablet is used to treat painful conditions such as headache including migraine, ', '50.00', '600e89f8523d9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `doclist`
--

CREATE TABLE `doclist` (
  `doc_id` int(11) NOT NULL,
  `dep_id` int(222) NOT NULL,
  `username` varchar(222) CHARACTER SET latin1 NOT NULL,
  `title` varchar(222) CHARACTER SET latin1 NOT NULL,
  `info` varchar(222) CHARACTER SET latin1 NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `img` varchar(222) CHARACTER SET latin1 NOT NULL,
  `password` varchar(222) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doclist`
--

INSERT INTO `doclist` (`doc_id`, `dep_id`, `username`, `title`, `info`, `fee`, `img`, `password`) VALUES
(10, 4, 'lucky', 'Dr. Halima', 'She is the best', '650.00', '5ff394a115cbe.jpg', 'e10adc3949ba59abbe56e057f20f883e'),
(11, 3, 'johny', 'Dr. Johny', 'He is the best', '400.00', '5ff4aebc6fe31.jpg', 'e10adc3949ba59abbe56e057f20f883e'),
(12, 4, 'sansa', 'Dr. Sansa', 'She is the best', '650.00', '5ff4aed5e8e21.jpg', 'e10adc3949ba59abbe56e057f20f883e'),
(13, 6, 'john', 'Dr. John', 'He is the best', '450.00', '5ff4aef3c8c25.jpg', 'e10adc3949ba59abbe56e057f20f883e'),
(14, 7, 'lue', 'Dr. Lue', 'He is the best', '400.00', '5ff4af1bed6be.jpg', 'e10adc3949ba59abbe56e057f20f883e'),
(15, 8, 'kaung', 'Dr. Kaung', 'She is the best', '450.00', '5ff4b00c9c319.jpg', 'e10adc3949ba59abbe56e057f20f883e'),
(16, 9, 'tomas', 'Dr. Tomas', 'He is the best', '650.00', '5ff4b029292e4.jpg', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_schedule`
--

CREATE TABLE `doctors_schedule` (
  `id` int(30) NOT NULL,
  `doc_id` int(222) NOT NULL,
  `day` varchar(20) NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors_schedule`
--

INSERT INTO `doctors_schedule` (`id`, `doc_id`, `day`, `time_from`, `time_to`) VALUES
(1, 10, 'Monday', '10:00:00', '17:00:00'),
(2, 10, 'Wednesday', '10:00:00', '17:00:00'),
(3, 11, 'Sunday', '10:00:00', '17:00:00'),
(4, 11, 'Wednesday', '11:00:00', '18:00:00'),
(5, 12, 'Monday', '10:00:00', '17:00:00'),
(6, 12, 'Wednesday', '11:00:00', '18:00:00'),
(7, 13, 'Sunday', '10:00:00', '14:36:48'),
(8, 13, 'Wednesday', '11:00:00', '18:00:00'),
(9, 14, 'Sunday', '10:00:00', '17:00:00'),
(10, 14, 'Monday', '11:00:00', '18:00:00'),
(11, 15, 'Monday', '10:00:00', '17:00:00'),
(12, 15, 'Wednesday', '11:00:00', '18:00:00'),
(13, 16, 'Sunday', '10:00:00', '14:36:48'),
(14, 16, 'Tuesday', '11:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(222) NOT NULL,
  `u_id` int(222) DEFAULT NULL,
  `status` varchar(222) DEFAULT NULL,
  `trans_date` varchar(222) DEFAULT NULL,
  `trans_id` varchar(222) DEFAULT NULL,
  `val_id` int(222) DEFAULT NULL,
  `amount` varchar(222) DEFAULT NULL,
  `card_type` varchar(222) DEFAULT NULL,
  `user_phone` varchar(222) DEFAULT NULL,
  `remark` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `u_id`, `status`, `trans_date`, `trans_id`, `val_id`, `amount`, `card_type`, `user_phone`, `remark`) VALUES
(7, 0, 'VALID', '2021-01-26 20:43:12', 'SSLCZ_TEST_6010298f7144e', 2147483647, '240.00', 'BKASH-BKash', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE `remark` (
  `id` int(11) NOT NULL,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `rs_id` int(222) NOT NULL,
  `c_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `url` varchar(222) NOT NULL,
  `o_hr` varchar(222) NOT NULL,
  `c_hr` varchar(222) NOT NULL,
  `o_days` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`rs_id`, `c_id`, `title`, `email`, `phone`, `url`, `o_hr`, `c_hr`, `o_days`, `address`, `image`, `date`) VALUES
(54, 18, 'Medishop', 'rasel@gmail.com', '123456789', 'www.medishop.com', '9am', '7pm', '24hr-x7', '  Dhaka, Bangladesh  ', '5fc6e8379c35a.jpg', '2020-12-02 01:04:55'),
(55, 17, 'Medicare', 'sharif@gmail.com', '123456789', 'www.medicare.com', '10am', '6pm', 'mon-tue', ' dhaka ', '5fc6e85eaad20.jpg', '2020-12-02 01:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `res_category`
--

CREATE TABLE `res_category` (
  `c_id` int(222) NOT NULL,
  `c_name` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `status` int(222) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`) VALUES
(35, 'rajme', 'Omar Sharif', 'Rajme', 'rajme@gmail.com', '01850017691', 'e10adc3949ba59abbe56e057f20f883e', 'bansree', 1, '2021-01-25 10:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

CREATE TABLE `users_orders` (
  `o_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `title`, `quantity`, `price`, `status`, `date`) VALUES
(51, 33, 'Sugatrol 100mg 10pcs', 4, '960.00', NULL, '2021-01-16 00:28:13'),
(52, 33, 'Sugatrol 100mg 10pcs', 4, '960.00', NULL, '2021-01-16 00:49:23'),
(53, 33, 'Sugatrol 100mg 10pcs', 4, '960.00', NULL, '2021-01-16 00:51:35'),
(54, 33, 'Sugatrol 100mg 10pcs', 1, '240.00', NULL, '2021-01-21 19:16:34'),
(55, 33, 'Sugatrol 100mg 10pcs', 1, '240.00', NULL, '2021-01-21 19:17:08'),
(56, 35, 'Sugatrol 100mg 10pcs', 1, '240.00', NULL, '2021-01-26 14:39:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `admin_codes`
--
ALTER TABLE `admin_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_list`
--
ALTER TABLE `appointment_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_remark`
--
ALTER TABLE `appointment_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dep_cat`
--
ALTER TABLE `dep_cat`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `doclist`
--
ALTER TABLE `doclist`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `doctors_schedule`
--
ALTER TABLE `doctors_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remark`
--
ALTER TABLE `remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`rs_id`);

--
-- Indexes for table `res_category`
--
ALTER TABLE `res_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admin_codes`
--
ALTER TABLE `admin_codes`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `appointment_list`
--
ALTER TABLE `appointment_list`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `appointment_remark`
--
ALTER TABLE `appointment_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `dep_cat`
--
ALTER TABLE `dep_cat`
  MODIFY `dep_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `d_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `doclist`
--
ALTER TABLE `doclist`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `doctors_schedule`
--
ALTER TABLE `doctors_schedule`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `remark`
--
ALTER TABLE `remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `rs_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `res_category`
--
ALTER TABLE `res_category`
  MODIFY `c_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users_orders`
--
ALTER TABLE `users_orders`
  MODIFY `o_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
