-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2017 at 12:33 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lj_charts_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `analyte`
--

CREATE TABLE `analyte` (
  `an_id` int(5) NOT NULL,
  `an_name` varchar(45) NOT NULL COMMENT 'Name of the analyte.',
  `an_nits` varchar(15) NOT NULL COMMENT 'Units of Measurement.',
  `an_HighControl` varchar(45) DEFAULT NULL COMMENT 'High-level ControlMatrial.',
  `an_NormalControl` varchar(45) DEFAULT NULL COMMENT 'Normal level ControlMaterial.',
  `an_LowControl` varchar(45) DEFAULT NULL COMMENT 'Low-level ControlMaterial.',
  `usr_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `controlmaterial`
--

CREATE TABLE `controlmaterial` (
  `cm_id` int(5) NOT NULL,
  `cm_name` varchar(45) NOT NULL COMMENT 'The name of the ControlMaterial',
  `cm_units` varchar(15) NOT NULL COMMENT 'The units of measurement, inherited from the analyte.',
  `cm_lot_number` varchar(15) DEFAULT NULL COMMENT 'Batch number for purchased ControlMaterial.',
  `cm_level` varchar(6) DEFAULT NULL COMMENT 'The level of control: high, normal, or low.',
  `cm_mean` double(4,2) DEFAULT NULL COMMENT 'The mean of the Data field.',
  `cm_sd` double(4,2) DEFAULT NULL COMMENT 'Standard deviation of the Data field.',
  `cm_data` text COMMENT 'The list of actual run results, in order of generation/run.',
  `cm_data_points` int(4) DEFAULT NULL COMMENT 'The number of runs',
  `Plus3SD` double(4,2) DEFAULT NULL COMMENT '(Mean)+3(Standard deviation)',
  `Plus2SD` double(4,2) DEFAULT NULL COMMENT '(Mean)+2(Standard deviation)',
  `Plus1SD` double(4,2) DEFAULT NULL COMMENT '(Mean)+1(Standard deviation)',
  `Minus1SD` double(4,2) DEFAULT NULL COMMENT '(Mean)-1(Standard deviation)',
  `Minus2SD` double(4,2) DEFAULT NULL COMMENT '(Mean)-2(Standard deviation)',
  `Minus3SD` double(4,2) DEFAULT NULL COMMENT '(Mean)-3(Standard deviation)',
  `cm_status` binary(1) DEFAULT '1',
  `usr_id` int(5) NOT NULL,
  `an_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `controlmaterialresult`
--

CREATE TABLE `controlmaterialresult` (
  `cmr_id` int(5) NOT NULL,
  `cmr_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'The server time on submission.\n',
  `cmr_value` double NOT NULL COMMENT 'The value of a run.',
  `cmr_instrument` varchar(25) DEFAULT NULL COMMENT 'The instrument/machine used.',
  `cmr_assay_method` varchar(25) DEFAULT NULL,
  `cmr_temperature` double DEFAULT NULL,
  `cm_id` int(5) NOT NULL,
  `an_id` int(5) NOT NULL,
  `usr_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `usr_id` int(5) NOT NULL,
  `usr_first_name` varchar(25) NOT NULL,
  `usr_last_name` varchar(25) DEFAULT NULL,
  `usr_username` varchar(25) NOT NULL,
  `usr_email` varchar(45) NOT NULL,
  `usr_role` varchar(5) NOT NULL DEFAULT 'staff',
  `usr_password` varchar(60) NOT NULL,
  `usr_profile_image` varchar(45) NOT NULL DEFAULT 'default.png' COMMENT 'Profile picture.',
  `usr_status` binary(1) NOT NULL DEFAULT '1',
  `usr_access_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`usr_id`, `usr_first_name`, `usr_last_name`, `usr_username`, `usr_email`, `usr_role`, `usr_password`, `usr_profile_image`, `usr_status`, `usr_access_time`) VALUES
(1, 'Alois', 'Odhiambo', 'alois', 'alois.odhiambo@strathmore.edu', 'Manag', '$2y$10$glKtPr3Ngse1kV3n2ZRsqOciQ4szSDzE4xRkJIJjeKr7V1YKLF54S', 'default.png', 0x31, '2017-08-18 20:43:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analyte`
--
ALTER TABLE `analyte`
  ADD PRIMARY KEY (`an_id`,`usr_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`an_id`),
  ADD KEY `fk_Analyte_User_idx` (`usr_id`);

--
-- Indexes for table `controlmaterial`
--
ALTER TABLE `controlmaterial`
  ADD PRIMARY KEY (`cm_id`,`usr_id`,`an_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`cm_id`),
  ADD KEY `fk_ControlMaterial_User1_idx` (`usr_id`),
  ADD KEY `fk_ControlMaterial_Analyte1_idx` (`an_id`);

--
-- Indexes for table `controlmaterialresult`
--
ALTER TABLE `controlmaterialresult`
  ADD PRIMARY KEY (`cmr_id`,`cm_id`,`an_id`,`usr_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`cmr_id`),
  ADD KEY `fk_ControlMaterialResult_ControlMaterial1_idx` (`cm_id`,`an_id`),
  ADD KEY `fk_ControlMaterialResult_User1_idx` (`usr_id`),
  ADD KEY `fk_ControlMaterialResult_ControlMaterial2` (`an_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`usr_id`),
  ADD UNIQUE KEY `usr_id_UNIQUE` (`usr_id`),
  ADD UNIQUE KEY `usr_username_UNIQUE` (`usr_username`),
  ADD UNIQUE KEY `usr_email_UNIQUE` (`usr_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analyte`
--
ALTER TABLE `analyte`
  MODIFY `an_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `controlmaterial`
--
ALTER TABLE `controlmaterial`
  MODIFY `cm_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `controlmaterialresult`
--
ALTER TABLE `controlmaterialresult`
  MODIFY `cmr_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `usr_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `analyte`
--
ALTER TABLE `analyte`
  ADD CONSTRAINT `fk_Analyte_User` FOREIGN KEY (`usr_id`) REFERENCES `user` (`usr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `controlmaterial`
--
ALTER TABLE `controlmaterial`
  ADD CONSTRAINT `fk_ControlMaterial_Analyte1` FOREIGN KEY (`an_id`) REFERENCES `analyte` (`an_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ControlMaterial_User1` FOREIGN KEY (`usr_id`) REFERENCES `user` (`usr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `controlmaterialresult`
--
ALTER TABLE `controlmaterialresult`
  ADD CONSTRAINT `fk_ControlMaterialResult_ControlMaterial1` FOREIGN KEY (`cm_id`) REFERENCES `controlmaterial` (`cm_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ControlMaterialResult_ControlMaterial2` FOREIGN KEY (`an_id`) REFERENCES `controlmaterial` (`an_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ControlMaterialResult_User1` FOREIGN KEY (`usr_id`) REFERENCES `controlmaterial` (`usr_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
