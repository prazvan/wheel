-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema supermega_db_name
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema supermega_db_name
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `supermega_db_name` DEFAULT CHARACTER SET utf8 ;
USE `supermega_db_name` ;

-- -----------------------------------------------------
-- Table `supermega_db_name`.`bonuses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `supermega_db_name`.`bonuses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `type` ENUM('cash', 'spins', 'ticket') NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `supermega_db_name`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `supermega_db_name`.`users` (
  `id` INT NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` TINYTEXT NOT NULL,
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `supermega_db_name`.`user_bonuses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `supermega_db_name`.`user_bonuses` (
  `user_id` INT NOT NULL,
  `bonus_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `bonus_id`),
  INDEX `fk_users_has_bonuses_bonuses1_idx` (`bonus_id` ASC),
  INDEX `fk_users_has_bonuses_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_users_has_bonuses_users1`
  FOREIGN KEY (`user_id`)
  REFERENCES `supermega_db_name`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_bonuses_bonuses1`
  FOREIGN KEY (`bonus_id`)
  REFERENCES `supermega_db_name`.`bonuses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `supermega_db_name`.`user_exchange_history`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `supermega_db_name`.`user_exchange_history` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `from` INT NULL,
  `to` INT NULL,
  `date` DATETIME NULL,
  PRIMARY KEY (`id`, `user_id`),
  INDEX `fk_user_exchange_history_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_exchange_history_users1`
  FOREIGN KEY (`user_id`)
  REFERENCES `supermega_db_name`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
