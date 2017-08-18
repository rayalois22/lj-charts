-- MySQL Script generated by MySQL Workbench
-- 08/18/17 15:11:16
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- -----------------------------------------------------
-- Schema lj_charts_db
-- -----------------------------------------------------
-- Database schema for the lj-charts web application.
DROP SCHEMA IF EXISTS `lj_charts_db` ;

-- -----------------------------------------------------
-- Schema lj_charts_db
--
-- Database schema for the lj-charts web application.
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `lj_charts_db` DEFAULT CHARACTER SET utf8 ;
USE `lj_charts_db` ;

-- -----------------------------------------------------
-- Table `User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `User` ;

CREATE TABLE IF NOT EXISTS `User` (
  `usr_id` INT NOT NULL,
  `usr_first_name` VARCHAR(25) NOT NULL,
  `usr_last_name` VARCHAR(25) NULL,
  `usr_username` VARCHAR(25) NOT NULL,
  `usr_email` VARCHAR(45) NOT NULL,
  `usr_role` VARCHAR(5) NOT NULL DEFAULT 'staff',
  `usr_password` VARCHAR(60) NOT NULL,
  `usr_profile_image` VARCHAR(45) NOT NULL DEFAULT 'default.png' COMMENT 'Profile picture.',
  `usr_status` BINARY(1) NOT NULL DEFAULT 1,
  `usr_access_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`usr_id`),
  UNIQUE INDEX `usr_id_UNIQUE` (`usr_id` ASC),
  UNIQUE INDEX `usr_username_UNIQUE` (`usr_username` ASC),
  UNIQUE INDEX `usr_email_UNIQUE` (`usr_email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Analyte`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Analyte` ;

CREATE TABLE IF NOT EXISTS `Analyte` (
  `an_id` INT(5) NOT NULL,
  `an_name` VARCHAR(45) NOT NULL COMMENT 'Name of the analyte.',
  `an_nits` VARCHAR(15) NOT NULL COMMENT 'Units of Measurement.',
  `an_HighControl` VARCHAR(45) NULL COMMENT 'High-level ControlMatrial.',
  `an_NormalControl` VARCHAR(45) NULL COMMENT 'Normal level ControlMaterial.',
  `an_LowControl` VARCHAR(45) NULL COMMENT 'Low-level ControlMaterial.',
  `usr_id` INT(5) NOT NULL,
  PRIMARY KEY (`an_id`, `usr_id`),
  UNIQUE INDEX `id_UNIQUE` (`an_id` ASC),
  INDEX `fk_Analyte_User_idx` (`usr_id` ASC),
  CONSTRAINT `fk_Analyte_User`
    FOREIGN KEY (`usr_id`)
    REFERENCES `User` (`usr_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ControlMaterial`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ControlMaterial` ;

CREATE TABLE IF NOT EXISTS `ControlMaterial` (
  `cm_id` INT(5) NOT NULL,
  `cm_name` VARCHAR(45) NOT NULL COMMENT 'The name of the ControlMaterial',
  `cm_units` VARCHAR(15) NOT NULL COMMENT 'The units of measurement, inherited from the analyte.',
  `cm_lot_number` VARCHAR(15) NULL COMMENT 'Batch number for purchased ControlMaterial.',
  `cm_level` VARCHAR(6) NULL COMMENT 'The level of control: high, normal, or low.',
  `cm_mean` DOUBLE(4,2) NULL COMMENT 'The mean of the Data field.',
  `cm_sd` DOUBLE(4,2) NULL COMMENT 'Standard deviation of the Data field.',
  `cm_data` TEXT NULL COMMENT 'The list of actual run results, in order of generation/run.',
  `cm_data_points` INT(4) NULL COMMENT 'The number of runs',
  `Plus3SD` DOUBLE(4,2) NULL COMMENT '(Mean)+3(Standard deviation)',
  `Plus2SD` DOUBLE(4,2) NULL COMMENT '(Mean)+2(Standard deviation)',
  `Plus1SD` DOUBLE(4,2) NULL COMMENT '(Mean)+1(Standard deviation)',
  `Minus1SD` DOUBLE(4,2) NULL COMMENT '(Mean)-1(Standard deviation)',
  `Minus2SD` DOUBLE(4,2) NULL COMMENT '(Mean)-2(Standard deviation)',
  `Minus3SD` DOUBLE(4,2) NULL COMMENT '(Mean)-3(Standard deviation)',
  `cm_status` BINARY(1) NULL DEFAULT 1,
  `usr_id` INT(5) NOT NULL,
  `an_id` INT(5) NOT NULL,
  PRIMARY KEY (`cm_id`, `usr_id`, `an_id`),
  UNIQUE INDEX `id_UNIQUE` (`cm_id` ASC),
  INDEX `fk_ControlMaterial_User1_idx` (`usr_id` ASC),
  INDEX `fk_ControlMaterial_Analyte1_idx` (`an_id` ASC),
  CONSTRAINT `fk_ControlMaterial_User1`
    FOREIGN KEY (`usr_id`)
    REFERENCES `User` (`usr_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ControlMaterial_Analyte1`
    FOREIGN KEY (`an_id`)
    REFERENCES `Analyte` (`an_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ControlMaterialResult`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ControlMaterialResult` ;

CREATE TABLE IF NOT EXISTS `ControlMaterialResult` (
  `cmr_id` INT(5) NOT NULL,
  `cmr_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'The server time on submission.\n',
  `cmr_value` DOUBLE NOT NULL COMMENT 'The value of a run.',
  `cmr_instrument` VARCHAR(25) NULL COMMENT 'The instrument/machine used.',
  `cmr_assay_method` VARCHAR(25) NULL,
  `cmr_temperature` DOUBLE NULL,
  `cm_id` INT(5) NOT NULL,
  `an_id` INT(5) NOT NULL,
  `usr_id` INT(5) NOT NULL,
  PRIMARY KEY (`cmr_id`, `cm_id`, `an_id`, `usr_id`),
  UNIQUE INDEX `id_UNIQUE` (`cmr_id` ASC),
  INDEX `fk_ControlMaterialResult_ControlMaterial1_idx` (`cm_id` ASC, `an_id` ASC),
  INDEX `fk_ControlMaterialResult_User1_idx` (`usr_id` ASC),
  CONSTRAINT `fk_ControlMaterialResult_ControlMaterial1`
    FOREIGN KEY (`cm_id`)
    REFERENCES `ControlMaterial` (`cm_id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ControlMaterialResult_ControlMaterial2`
    FOREIGN KEY (`an_id`)
    REFERENCES `ControlMaterial` (`an_id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ControlMaterialResult_User1`
    FOREIGN KEY (`usr_id`)
    REFERENCES `ControlMaterial` (`usr_id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;