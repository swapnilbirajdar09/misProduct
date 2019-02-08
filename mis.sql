-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2019 at 06:19 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mis`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_tab`
--

CREATE TABLE `company_tab` (
  `company_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `added_date` date NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_tab`
--

INSERT INTO `company_tab` (`company_id`, `name`, `logo`, `added_date`, `modified_date`, `status`) VALUES
(1, 'Bizmo Technology', '', '2019-02-07', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `features_tab`
--

CREATE TABLE `features_tab` (
  `feature_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `feature_name` varchar(255) NOT NULL,
  `feature_info` varchar(255) NOT NULL,
  `roles_assigned` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `package_tab`
--

CREATE TABLE `package_tab` (
  `package_id` int(11) NOT NULL,
  `package_title` varchar(255) NOT NULL,
  `package_price` double NOT NULL,
  `package_period` varchar(255) NOT NULL,
  `package_benefits` varchar(255) NOT NULL,
  `package_validity` varchar(255) NOT NULL,
  `package_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_tab`
--

INSERT INTO `package_tab` (`package_id`, `package_title`, `package_price`, `package_period`, `package_benefits`, `package_validity`, `package_status`) VALUES
(1, 'FREE', 0, 'Monthly', '', '6', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_tab`
--

CREATE TABLE `project_tab` (
  `project_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_description` varchar(255) NOT NULL,
  `project_cost` float NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `assigned_user` text NOT NULL,
  `profit_margin` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role_tab`
--

CREATE TABLE `role_tab` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_tab`
--

INSERT INTO `role_tab` (`role_id`, `role_name`, `status`) VALUES
(1, 'Super_admin', 1),
(2, 'Company_admin', 1),
(3, 'Employee', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_tab`
--

CREATE TABLE `subscription_tab` (
  `sub_id` int(11) NOT NULL,
  `sub_package` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userdetails_tab`
--

CREATE TABLE `userdetails_tab` (
  `user_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `expiry_date` datetime NOT NULL,
  `package_purchased` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails_tab`
--

INSERT INTO `userdetails_tab` (`user_details_id`, `user_id`, `company_id`, `fname`, `lname`, `phone`, `address`, `postal_code`, `modified_date`, `expiry_date`, `package_purchased`) VALUES
(1, 1, 1, 'Swapnil', 'Birajdar', 8793590809, 'Datta Nagar, Ambegaon, pune.', 411046, '0000-00-00 00:00:00', '2019-08-07 00:00:00', 'FREE');

-- --------------------------------------------------------

--
-- Table structure for table `user_tab`
--

CREATE TABLE `user_tab` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tab`
--

INSERT INTO `user_tab` (`user_id`, `role_id`, `role`, `user_email`, `user_name`, `password`, `created_date`, `status`) VALUES
(1, 1, 'Super_admin', 'swapnil.bizmotech@gmail.com', 'swapnil', 'c3dhcG5pbDEyMzQ=', '2019-02-07 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_tab`
--
ALTER TABLE `company_tab`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `features_tab`
--
ALTER TABLE `features_tab`
  ADD PRIMARY KEY (`feature_id`),
  ADD KEY `subscription_id` (`sub_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `package_tab`
--
ALTER TABLE `package_tab`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `project_tab`
--
ALTER TABLE `project_tab`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `role_tab`
--
ALTER TABLE `role_tab`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `subscription_tab`
--
ALTER TABLE `subscription_tab`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `userdetails_tab`
--
ALTER TABLE `userdetails_tab`
  ADD PRIMARY KEY (`user_details_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `company_id_2` (`company_id`),
  ADD KEY `user_id_3` (`user_id`);

--
-- Indexes for table `user_tab`
--
ALTER TABLE `user_tab`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `priority_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_tab`
--
ALTER TABLE `company_tab`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `features_tab`
--
ALTER TABLE `features_tab`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `package_tab`
--
ALTER TABLE `package_tab`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `role_tab`
--
ALTER TABLE `role_tab`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subscription_tab`
--
ALTER TABLE `subscription_tab`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `userdetails_tab`
--
ALTER TABLE `userdetails_tab`
  MODIFY `user_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_tab`
--
ALTER TABLE `user_tab`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `features_tab`
--
ALTER TABLE `features_tab`
  ADD CONSTRAINT `features_tab_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subscription_tab` (`sub_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_tab`
--
ALTER TABLE `project_tab`
  ADD CONSTRAINT `project_tab_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company_tab` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userdetails_tab`
--
ALTER TABLE `userdetails_tab`
  ADD CONSTRAINT `userdetails_tab_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company_tab` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userdetails_tab_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_tab` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_tab`
--
ALTER TABLE `user_tab`
  ADD CONSTRAINT `user_tab_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role_tab` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
