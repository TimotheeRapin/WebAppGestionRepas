-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema WebAppGestionRepas
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema WebAppGestionRepas
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `WebAppGestionRepas` DEFAULT CHARACTER SET utf8 ;
USE `WebAppGestionRepas` ;

-- -----------------------------------------------------
-- Table `WebAppGestionRepas`.`accounts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebAppGestionRepas`.`accounts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(50) NOT NULL,
  `lastName` VARCHAR(50) NOT NULL,
  `email` VARCHAR(254) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  `type` ENUM('User', 'Administrator') NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `UniqueUser` (`email` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebAppGestionRepas`.`signs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebAppGestionRepas`.`signs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `UniqueSign` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebAppGestionRepas`.`menus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebAppGestionRepas`.`menus` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(30) NOT NULL,
  `menuNumber` VARCHAR(25) NOT NULL,
  `accounts_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_menus_users_idx` (`accounts_id` ASC) VISIBLE,
  INDEX `UniqueMenu` (`menuNumber` ASC) VISIBLE,
  CONSTRAINT `fk_menus_users`
    FOREIGN KEY (`accounts_id`)
    REFERENCES `WebAppGestionRepas`.`accounts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebAppGestionRepas`.`articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebAppGestionRepas`.`articles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `quantity` INT NOT NULL,
  `description` VARCHAR(150) NULL,
  `unity` ENUM('g', 'kg', 'ml', 'cl', 'l', 'pce') NULL,
  PRIMARY KEY (`id`),
  INDEX `UniqueArticle` (`name` ASC, `quantity` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebAppGestionRepas`.`shopping lists`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebAppGestionRepas`.`shopping lists` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `UniqueShoppingList` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebAppGestionRepas`.`foods`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebAppGestionRepas`.`foods` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(40) NOT NULL,
  `nbPersons` INT NOT NULL,
  `time` TIME NULL,
  `difficulty` TINYINT(2) NULL,
  `instruction` VARCHAR(1000) NOT NULL,
  `type` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `UniqueFood` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebAppGestionRepas`.`ingredients`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebAppGestionRepas`.`ingredients` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `UniqueIngredient` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebAppGestionRepas`.`menus_has_foods`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebAppGestionRepas`.`menus_has_foods` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `menus_id` INT NOT NULL,
  `foods_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_menus_has_foods_foods1_idx` (`foods_id` ASC) VISIBLE,
  INDEX `fk_menus_has_foods_menus1_idx` (`menus_id` ASC) VISIBLE,
  CONSTRAINT `fk_menus_has_foods_menus1`
    FOREIGN KEY (`menus_id`)
    REFERENCES `WebAppGestionRepas`.`menus` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_menus_has_foods_foods1`
    FOREIGN KEY (`foods_id`)
    REFERENCES `WebAppGestionRepas`.`foods` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebAppGestionRepas`.`foods_has_ingredients`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebAppGestionRepas`.`foods_has_ingredients` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `foods_id` INT NOT NULL,
  `ingredients_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_foods_has_ingredients_ingredients1_idx` (`ingredients_id` ASC) VISIBLE,
  INDEX `fk_foods_has_ingredients_foods1_idx` (`foods_id` ASC) VISIBLE,
  CONSTRAINT `fk_foods_has_ingredients_foods1`
    FOREIGN KEY (`foods_id`)
    REFERENCES `WebAppGestionRepas`.`foods` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_foods_has_ingredients_ingredients1`
    FOREIGN KEY (`ingredients_id`)
    REFERENCES `WebAppGestionRepas`.`ingredients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebAppGestionRepas`.`articles_has_shopping lists`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebAppGestionRepas`.`articles_has_shopping lists` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `articles_id` INT NOT NULL,
  `shopping lists_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_articles_has_shopping lists_shopping lists1_idx` (`shopping lists_id` ASC) VISIBLE,
  INDEX `fk_articles_has_shopping lists_articles1_idx` (`articles_id` ASC) VISIBLE,
  CONSTRAINT `fk_articles_has_shopping lists_articles1`
    FOREIGN KEY (`articles_id`)
    REFERENCES `WebAppGestionRepas`.`articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_has_shopping lists_shopping lists1`
    FOREIGN KEY (`shopping lists_id`)
    REFERENCES `WebAppGestionRepas`.`shopping lists` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebAppGestionRepas`.`signs_has_articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebAppGestionRepas`.`signs_has_articles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `signs_id` INT NOT NULL,
  `articles_id` INT NOT NULL,
  `price` DECIMAL(5,2) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_signs_has_articles_articles1_idx` (`articles_id` ASC) VISIBLE,
  INDEX `fk_signs_has_articles_signs1_idx` (`signs_id` ASC) VISIBLE,
  CONSTRAINT `fk_signs_has_articles_signs1`
    FOREIGN KEY (`signs_id`)
    REFERENCES `WebAppGestionRepas`.`signs` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_signs_has_articles_articles1`
    FOREIGN KEY (`articles_id`)
    REFERENCES `WebAppGestionRepas`.`articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WebAppGestionRepas`.`ingredients_has_articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebAppGestionRepas`.`ingredients_has_articles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ingredients_id` INT NOT NULL,
  `articles_id` INT NOT NULL,
  INDEX `fk_ingredients_has_articles_articles1_idx` (`articles_id` ASC) VISIBLE,
  INDEX `fk_ingredients_has_articles_ingredients1_idx` (`ingredients_id` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_ingredients_has_articles_ingredients1`
    FOREIGN KEY (`ingredients_id`)
    REFERENCES `WebAppGestionRepas`.`ingredients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ingredients_has_articles_articles1`
    FOREIGN KEY (`articles_id`)
    REFERENCES `WebAppGestionRepas`.`articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
