-- MySQL Script generated by MySQL Workbench
-- Mon Mar 27 20:06:38 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema jax
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema jax
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `jax` DEFAULT CHARACTER SET utf8 ;
USE `jax` ;

-- -----------------------------------------------------
-- Table `jax`.`año_lectivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jax`.`año_lectivo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `periodo_inicio` DATE NOT NULL,
  `periodo_final` DATE NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `jax`.`entrevista_estudiante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jax`.`entrevista_estudiante` (
  `id_entrevistado` INT(11) NOT NULL AUTO_INCREMENT,
  `id_ficha` INT(6) NOT NULL,
  `ps_nombre` VARCHAR(100) NOT NULL,
  `ps_apellido` VARCHAR(100) NOT NULL,
  `ps_lugar_nacimiento` VARCHAR(100) NOT NULL,
  `ps_fecha` DATE NOT NULL,
  `ps_direccion` VARCHAR(500) NOT NULL,
  `ps_año_aplica` VARCHAR(15) NOT NULL,
  `ps_ist_procede` VARCHAR(250) NOT NULL,
  `ps_promedio` DECIMAL(10,2) NOT NULL,
  `ps_conducta` VARCHAR(1) NOT NULL,
  `ps_razon` VARCHAR(250) NOT NULL,
  `ps_razon_cambio` VARCHAR(250) NOT NULL,
  `ps_altercado` VARCHAR(500) NOT NULL,
  `ps_email` VARCHAR(50) NOT NULL,
  `ps_celular` INT(10) NOT NULL,
  `ps_cupo` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`id_entrevistado`))
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `jax`.`entrevista_ficha`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jax`.`entrevista_ficha` (
  `id_ficha` INT(11) NOT NULL AUTO_INCREMENT,
  `id_entrevista_estudiante` VARCHAR(45) NOT NULL,
  `id_entrevista_historia_familiar` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_ficha`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `jax`.`entrevista_historia_familiar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jax`.`entrevista_historia_familiar` (
  `id_ps_familiar` INT(6) NOT NULL AUTO_INCREMENT,
  `id_ficha` INT(6) NOT NULL,
  `ps_nombre_representante` VARCHAR(200) NOT NULL,
  `ps_nombre_padre` VARCHAR(200) NOT NULL,
  `ps_ocupacion_padre` VARCHAR(100) NOT NULL,
  `ps_lugar_trabajo_padre` VARCHAR(150) NOT NULL,
  `ps_nombre_madre` VARCHAR(200) NOT NULL,
  `ps_ocupacion_madre` VARCHAR(100) NOT NULL,
  `ps_lugar_trabajo_madre` VARCHAR(150) NOT NULL,
  `ps_estado_civil_representante` VARCHAR(10) NOT NULL,
  `ps_relacion_familiar` VARCHAR(9) NOT NULL,
  `ps_tiempo_con_estudiante` VARCHAR(100) NOT NULL,
  `ps_futuro_para_estudiante` VARCHAR(200) NOT NULL,
  `ps_desarrollo_academico_estudiante` VARCHAR(200) NOT NULL,
  `ps_gastos_familiar` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_ps_familiar`))
ENGINE = InnoDB
AUTO_INCREMENT = 21
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `jax`.`student_family`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jax`.`student_family` (
  `id_family` INT(11) NOT NULL AUTO_INCREMENT,
  `id_student` INT(11) NOT NULL,
  `f_apellido_padre` VARCHAR(250) NOT NULL,
  `f_nombre_padre` VARCHAR(250) NOT NULL,
  `f_edad_padre` INT(2) NOT NULL,
  `f_intruccion_padre` VARCHAR(250) NOT NULL,
  `f_profesion_padre` VARCHAR(250) NOT NULL,
  `f_lugar_trabajo_padre` VARCHAR(250) NOT NULL,
  `f_direccion_padre` VARCHAR(500) NOT NULL,
  `f_civil_padre` VARCHAR(50) NOT NULL,
  `f_ci_padre` INT(10) NOT NULL,
  `f_telf_padre` INT(10) NOT NULL,
  `f_apellido_madre` VARCHAR(250) NOT NULL,
  `f_nombre_madre` VARCHAR(250) NOT NULL,
  `f_edad_madre` INT(2) NOT NULL,
  `f_intruccion_madre` VARCHAR(250) NOT NULL,
  `f_profesion_madre` VARCHAR(250) NOT NULL,
  `f_lugar_trabajo_madre` VARCHAR(500) NOT NULL,
  `f_direccion_madre` VARCHAR(500) NOT NULL,
  `f_civil_madre` VARCHAR(50) NOT NULL,
  `f_ci_madre` INT(10) NOT NULL,
  `f_telf_madre` INT(10) NOT NULL,
  `f_num_per_familia` INT(2) NOT NULL,
  `f_economia` VARCHAR(7) NOT NULL,
  `f_convive_estudiante` VARCHAR(2) NOT NULL,
  `f_convive_nombre` VARCHAR(250) NOT NULL,
  `f_convive_apellido` VARCHAR(250) NOT NULL,
  `f_convive_edad` INT(2) NOT NULL,
  `f_convive_parentesco` VARCHAR(20) NOT NULL,
  `f_tipo_vivienda` VARCHAR(9) NOT NULL,
  `f_habitacion_niño` VARCHAR(10) NOT NULL,
  `f_nombre_habitacion_niño` VARCHAR(250) NOT NULL,
  `f_time_padres_niño` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`id_family`))
ENGINE = InnoDB
AUTO_INCREMENT = 26
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `jax`.`student_info`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jax`.`student_info` (
  `id` INT(5) NOT NULL AUTO_INCREMENT,
  `matricula` INT(6) NOT NULL,
  `cedula` VARCHAR(10) NOT NULL,
  `tipo` VARCHAR(20) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `grado_estudiantil` VARCHAR(15) NOT NULL,
  `birthdate` DATE NULL DEFAULT CURRENT_TIMESTAMP(),
  `nacionalidad` VARCHAR(50) NOT NULL,
  `sexo` VARCHAR(10) NOT NULL,
  `direccion` VARCHAR(150) NOT NULL,
  `sector` VARCHAR(50) NOT NULL,
  `photo` VARCHAR(50) NOT NULL,
  `observaciones` TEXT NOT NULL,
  `descuento` INT(3) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 141
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `jax`.`student_representante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jax`.`student_representante` (
  `id_representante` INT(11) NOT NULL AUTO_INCREMENT,
  `r_last_name` VARCHAR(250) NOT NULL,
  `r_name` VARCHAR(250) NOT NULL,
  `r_ci` INT(10) NOT NULL,
  `r_telf` INT(10) NOT NULL,
  `r_email` VARCHAR(150) NOT NULL,
  `id_estudiante` INT(5) NOT NULL,
  PRIMARY KEY (`id_representante`))
ENGINE = InnoDB
AUTO_INCREMENT = 49
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `jax`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jax`.`users` (
  `id` INT(5) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `photo` VARCHAR(50) NOT NULL,
  `status` VARCHAR(12) NOT NULL,
  `rol` VARCHAR(13) NULL DEFAULT NULL,
  `datetime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 31
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
