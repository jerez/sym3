SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `SYM3` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
SHOW WARNINGS;
USE `SYM3`;

-- -----------------------------------------------------
-- Table `SYM3`.`sys_seg_usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SYM3`.`sys_seg_usuarios` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `sys_seg_usuarios` (
  `sys_seg_usuarios_id` INT NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(12) NOT NULL ,
  `password` VARCHAR(32) NOT NULL ,
  `nombres` VARCHAR(64) NOT NULL ,
  `apellidos` VARCHAR(64) NOT NULL ,
  `email` VARCHAR(64) NOT NULL ,
  `estado` TINYINT(1) NOT NULL DEFAULT 1 ,
  `last_login` TIMESTAMP NOT NULL DEFAULT now() ,
  PRIMARY KEY (`sys_seg_usuarios_id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `SYM3`.`sys_seg_perfiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SYM3`.`sys_seg_perfiles` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `sys_seg_perfiles` (
  `sys_seg_perfiles_id` INT NOT NULL AUTO_INCREMENT ,
  `nombre_perfil` VARCHAR(45) NOT NULL ,
  `estado` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`sys_seg_perfiles_id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `SYM3`.`sys_seg_modulos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SYM3`.`sys_seg_modulos` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `sys_seg_modulos` (
  `sys_seg_modulos_id` INT NOT NULL AUTO_INCREMENT ,
  `nombre_modulo` VARCHAR(45) NOT NULL ,
  `estado` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`sys_seg_modulos_id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `SYM3`.`sys_seg_submodulos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SYM3`.`sys_seg_submodulos` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `sys_seg_submodulos` (
  `sys_seg_submodulos_id` INT NOT NULL AUTO_INCREMENT ,
  `sys_seg_modulos_id` INT NOT NULL ,
  `nombre_submodulo` VARCHAR(45) NOT NULL ,
  `estado` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`sys_seg_submodulos_id`) ,
  CONSTRAINT `fk_sys_seg_submodulos_modulos`
    FOREIGN KEY (`sys_seg_modulos_id` )
    REFERENCES `sys_seg_modulos` (`sys_seg_modulos_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE INDEX `fk_sys_seg_submodulos_modulos` ON `sys_seg_submodulos` (`sys_seg_modulos_id` ASC) ;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `SYM3`.`sys_seg_funciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SYM3`.`sys_seg_funciones` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `sys_seg_funciones` (
  `sys_seg_funciones_id` INT NOT NULL AUTO_INCREMENT ,
  `sys_seg_submodulos_id` INT NOT NULL ,
  `nombre_funcion` VARCHAR(45) NOT NULL ,
  `visible_menu` TINYINT(1) NOT NULL DEFAULT 1 ,
  `estado` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`sys_seg_funciones_id`) ,
  CONSTRAINT `fk_sys_seg_funciones_submodulos`
    FOREIGN KEY (`sys_seg_submodulos_id` )
    REFERENCES `sys_seg_submodulos` (`sys_seg_submodulos_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE INDEX `fk_sys_seg_funciones_submodulos` ON `sys_seg_funciones` (`sys_seg_submodulos_id` ASC) ;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `SYM3`.`sys_seg_recursos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SYM3`.`sys_seg_recursos` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `sys_seg_recursos` (
  `sys_seg_recursos_id` INT NOT NULL AUTO_INCREMENT ,
  `sys_seg_funciones_id` INT NOT NULL ,
  `identificador_recurso` VARCHAR(45) NOT NULL ,
  `es_principal` TINYINT(1) NOT NULL DEFAULT 0 ,
  `estado` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`sys_seg_recursos_id`) ,
  CONSTRAINT `fk_sys_seg_recursos_funciones`
    FOREIGN KEY (`sys_seg_funciones_id` )
    REFERENCES `sys_seg_funciones` (`sys_seg_funciones_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE INDEX `fk_sys_seg_recursos_funciones` ON `sys_seg_recursos` (`sys_seg_funciones_id` ASC) ;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `SYM3`.`sys_seg_usuarios_has_perfiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SYM3`.`sys_seg_usuarios_has_perfiles` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `sys_seg_usuarios_has_perfiles` (
  `sys_seg_usuarios_id` INT NOT NULL ,
  `sys_seg_perfiles_id` INT NOT NULL ,
  PRIMARY KEY (`sys_seg_usuarios_id`, `sys_seg_perfiles_id`) ,
  CONSTRAINT `fk_sys_seg_usuarios_has_perfiles`
    FOREIGN KEY (`sys_seg_usuarios_id` )
    REFERENCES `sys_seg_usuarios` (`sys_seg_usuarios_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sys_seg_perfiles_has_usuarios`
    FOREIGN KEY (`sys_seg_perfiles_id` )
    REFERENCES `sys_seg_perfiles` (`sys_seg_perfiles_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

SHOW WARNINGS;
CREATE INDEX `fk_sys_seg_usuarios_has_perfiles` ON `sys_seg_usuarios_has_perfiles` (`sys_seg_usuarios_id` ASC) ;

SHOW WARNINGS;
CREATE INDEX `fk_sys_seg_perfiles_has_usuarios` ON `sys_seg_usuarios_has_perfiles` (`sys_seg_perfiles_id` ASC) ;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `SYM3`.`sys_seg_perfiles_has_funciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SYM3`.`sys_seg_perfiles_has_funciones` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `sys_seg_perfiles_has_funciones` (
  `sys_seg_perfiles_id` INT NOT NULL ,
  `sys_seg_funciones_id` INT NOT NULL ,
  PRIMARY KEY (`sys_seg_perfiles_id`, `sys_seg_funciones_id`) ,
  CONSTRAINT `fk_sys_seg_perfiles_has_funciones`
    FOREIGN KEY (`sys_seg_perfiles_id` )
    REFERENCES `sys_seg_perfiles` (`sys_seg_perfiles_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sys_seg_funciones_has_perfiles`
    FOREIGN KEY (`sys_seg_funciones_id` )
    REFERENCES `sys_seg_funciones` (`sys_seg_funciones_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

SHOW WARNINGS;
CREATE INDEX `fk_sys_seg_perfiles_has_funciones` ON `sys_seg_perfiles_has_funciones` (`sys_seg_perfiles_id` ASC) ;

SHOW WARNINGS;
CREATE INDEX `fk_sys_seg_funciones_has_perfiles` ON `sys_seg_perfiles_has_funciones` (`sys_seg_funciones_id` ASC) ;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `SYM3`.`configuracion_melfa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SYM3`.`configuracion_melfa` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `configuracion_melfa` (
  `direccion_ip` VARCHAR(15) NOT NULL ,
  `timeout` INT NOT NULL ,
  `puerto` INT NOT NULL ,
  `configuracion_melfa_id` INT NOT NULL ,
  `desplazamiento` INT NOT NULL ,
  `velocidad` INT NOT NULL ,
  PRIMARY KEY (`configuracion_melfa_id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `SYM3`.`configuracion_sistema`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SYM3`.`configuracion_sistema` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `configuracion_sistema` (
  `email_administrador` VARCHAR(45) NOT NULL ,
  `dominio_aplicacion` VARCHAR(45) NOT NULL ,
  `direccion_ip_camara` VARCHAR(15) NOT NULL ,
  `configuracion_sistema_id` INT NOT NULL ,
  PRIMARY KEY (`configuracion_sistema_id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Placeholder table for view `SYM3`.`sys_seg_usuarios_has_recursos_view`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SYM3`.`sys_seg_usuarios_has_recursos_view` (`id` INT);
SHOW WARNINGS;

-- -----------------------------------------------------
-- Placeholder table for view `SYM3`.`sys_seg_usuarios_has_modulos_view`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SYM3`.`sys_seg_usuarios_has_modulos_view` (`id` INT);
SHOW WARNINGS;

-- -----------------------------------------------------
-- Placeholder table for view `SYM3`.`sys_seg_usuarios_has_submodulos_view`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SYM3`.`sys_seg_usuarios_has_submodulos_view` (`id` INT);
SHOW WARNINGS;

-- -----------------------------------------------------
-- Placeholder table for view `SYM3`.`sys_seg_usuarios_has_funciones_view`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SYM3`.`sys_seg_usuarios_has_funciones_view` (`id` INT);
SHOW WARNINGS;

-- -----------------------------------------------------
-- View `SYM3`.`sys_seg_usuarios_has_recursos_view`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `SYM3`.`sys_seg_usuarios_has_recursos_view` ;
SHOW WARNINGS;
DROP TABLE IF EXISTS `SYM3`.`sys_seg_usuarios_has_recursos_view`;
SHOW WARNINGS;
CREATE  OR REPLACE VIEW `SYM3`.`sys_seg_usuarios_has_recursos_view` AS
select e.sys_seg_usuarios_id,
       b.sys_seg_funciones_id,
       a.sys_seg_recursos_id,
       a.identificador_recurso,
       a.es_principal
from  sys_seg_recursos a,
      sys_seg_funciones b,
      sys_seg_perfiles_has_funciones c,
      sys_seg_perfiles d,
      sys_seg_usuarios_has_perfiles e
where a.sys_seg_funciones_id = b.sys_seg_funciones_id
  and b.sys_seg_funciones_id = c.sys_seg_funciones_id
  and c.sys_seg_perfiles_id = d.sys_seg_perfiles_id
  and d.sys_seg_perfiles_id = e.sys_seg_perfiles_id
  and a.estado=1
  and b.estado=1
  and d.estado=1;
SHOW WARNINGS;

-- -----------------------------------------------------
-- View `SYM3`.`sys_seg_usuarios_has_modulos_view`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `SYM3`.`sys_seg_usuarios_has_modulos_view` ;
SHOW WARNINGS;
DROP TABLE IF EXISTS `SYM3`.`sys_seg_usuarios_has_modulos_view`;
SHOW WARNINGS;
CREATE  OR REPLACE VIEW `SYM3`.`sys_seg_usuarios_has_modulos_view` AS
select e.sys_seg_usuarios_id,
       a.sys_seg_modulos_id,
       a.nombre_modulo
from sys_seg_modulos a
  join sys_seg_submodulos b on a.sys_seg_modulos_id = b.sys_seg_modulos_id
  join sys_seg_funciones c on b.sys_seg_submodulos_id = c.sys_seg_submodulos_id
  join sys_seg_perfiles_has_funciones d on c.sys_seg_funciones_id = d.sys_seg_funciones_id
  join sys_seg_usuarios_has_perfiles e on d.sys_seg_perfiles_id = e.sys_seg_perfiles_id
where a.estado = 1
  and b.estado = 1
  and (c.estado = 1 and c.visible_menu=1)
group by a.sys_seg_modulos_id,a.nombre_modulo;
SHOW WARNINGS;

-- -----------------------------------------------------
-- View `SYM3`.`sys_seg_usuarios_has_submodulos_view`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `SYM3`.`sys_seg_usuarios_has_submodulos_view` ;
SHOW WARNINGS;
DROP TABLE IF EXISTS `SYM3`.`sys_seg_usuarios_has_submodulos_view`;
SHOW WARNINGS;
CREATE  OR REPLACE VIEW `SYM3`.`sys_seg_usuarios_has_submodulos_view` AS
select e.sys_seg_usuarios_id,
       a.sys_seg_modulos_id,
       b.sys_seg_submodulos_id,
       b.nombre_submodulo
from sys_seg_modulos a
  join sys_seg_submodulos b on a.sys_seg_modulos_id = b.sys_seg_modulos_id
  join sys_seg_funciones c on b.sys_seg_submodulos_id = c.sys_seg_submodulos_id
  join sys_seg_perfiles_has_funciones d on c.sys_seg_funciones_id = d.sys_seg_funciones_id
  join sys_seg_usuarios_has_perfiles e on d.sys_seg_perfiles_id = e.sys_seg_perfiles_id
where a.estado = 1
  and b.estado = 1
  and (c.estado = 1 and c.visible_menu=1)
group by a.sys_seg_modulos_id,b.nombre_submodulo
;
SHOW WARNINGS;

-- -----------------------------------------------------
-- View `SYM3`.`sys_seg_usuarios_has_funciones_view`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `SYM3`.`sys_seg_usuarios_has_funciones_view` ;
SHOW WARNINGS;
DROP TABLE IF EXISTS `SYM3`.`sys_seg_usuarios_has_funciones_view`;
SHOW WARNINGS;
CREATE  OR REPLACE VIEW `SYM3`.`sys_seg_usuarios_has_funciones_view` AS
select e.sys_seg_usuarios_id,
       b.sys_seg_submodulos_id,
       c.sys_seg_funciones_id,
       c.nombre_funcion
from sys_seg_modulos a
  join sys_seg_submodulos b on a.sys_seg_modulos_id = b.sys_seg_modulos_id
  join sys_seg_funciones c on b.sys_seg_submodulos_id = c.sys_seg_submodulos_id
  join sys_seg_perfiles_has_funciones d on c.sys_seg_funciones_id = d.sys_seg_funciones_id
  join sys_seg_usuarios_has_perfiles e on d.sys_seg_perfiles_id = e.sys_seg_perfiles_id
where a.estado = 1
  and b.estado = 1
  and (c.estado = 1 and c.visible_menu=1)
group by c.sys_seg_funciones_id,c.nombre_funcion;
SHOW WARNINGS;


-- -----------------------------------------------------
-- Data for table `SYM3`.`sys_seg_usuarios`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `SYM3`;
INSERT INTO `sys_seg_usuarios` (`sys_seg_usuarios_id`, `login`, `password`, `nombres`, `apellidos`, `email`, `estado`, `last_login`) VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'Sistema', 'admin@email.com', 1, now());

COMMIT;

-- -----------------------------------------------------
-- Data for table `SYM3`.`sys_seg_perfiles`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `SYM3`;
INSERT INTO `sys_seg_perfiles` (`sys_seg_perfiles_id`, `nombre_perfil`, `estado`) VALUES (1, 'Administrador', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `SYM3`.`sys_seg_modulos`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `SYM3`;
INSERT INTO `sys_seg_modulos` (`sys_seg_modulos_id`, `nombre_modulo`, `estado`) VALUES (1, 'Sistema', 1);
INSERT INTO `sys_seg_modulos` (`sys_seg_modulos_id`, `nombre_modulo`, `estado`) VALUES (2, 'Melfa', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `SYM3`.`sys_seg_submodulos`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `SYM3`;
INSERT INTO `sys_seg_submodulos` (`sys_seg_submodulos_id`, `sys_seg_modulos_id`, `nombre_submodulo`, `estado`) VALUES (1, 1, 'Acceso Basico', 1);
INSERT INTO `sys_seg_submodulos` (`sys_seg_submodulos_id`, `sys_seg_modulos_id`, `nombre_submodulo`, `estado`) VALUES (2, 1, 'Usuarios', 1);
INSERT INTO `sys_seg_submodulos` (`sys_seg_submodulos_id`, `sys_seg_modulos_id`, `nombre_submodulo`, `estado`) VALUES (3, 1, 'Perfiles', 1);
INSERT INTO `sys_seg_submodulos` (`sys_seg_submodulos_id`, `sys_seg_modulos_id`, `nombre_submodulo`, `estado`) VALUES (4, 1, 'Navegación', 1);
INSERT INTO `sys_seg_submodulos` (`sys_seg_submodulos_id`, `sys_seg_modulos_id`, `nombre_submodulo`, `estado`) VALUES (5, 2, 'Parametrizacion', 1);
INSERT INTO `sys_seg_submodulos` (`sys_seg_submodulos_id`, `sys_seg_modulos_id`, `nombre_submodulo`, `estado`) VALUES (6, 2, 'Control', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `SYM3`.`sys_seg_funciones`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `SYM3`;
INSERT INTO `sys_seg_funciones` (`sys_seg_funciones_id`, `sys_seg_submodulos_id`, `nombre_funcion`, `visible_menu`, `estado`) VALUES (1, 1, 'Ingreso Aplicación', 0, 1);
INSERT INTO `sys_seg_funciones` (`sys_seg_funciones_id`, `sys_seg_submodulos_id`, `nombre_funcion`, `visible_menu`, `estado`) VALUES (2, 2, 'Gestion Usuarios', 1, 1);
INSERT INTO `sys_seg_funciones` (`sys_seg_funciones_id`, `sys_seg_submodulos_id`, `nombre_funcion`, `visible_menu`, `estado`) VALUES (3, 2, 'Asociar Perfiles', 0, 1);
INSERT INTO `sys_seg_funciones` (`sys_seg_funciones_id`, `sys_seg_submodulos_id`, `nombre_funcion`, `visible_menu`, `estado`) VALUES (4, 3, 'Gestion Perfiles', 1, 1);
INSERT INTO `sys_seg_funciones` (`sys_seg_funciones_id`, `sys_seg_submodulos_id`, `nombre_funcion`, `visible_menu`, `estado`) VALUES (5, 3, 'Asociar Funciones', 0, 1);
INSERT INTO `sys_seg_funciones` (`sys_seg_funciones_id`, `sys_seg_submodulos_id`, `nombre_funcion`, `visible_menu`, `estado`) VALUES (6, 4, 'Gestion Modulos', 1, 1);
INSERT INTO `sys_seg_funciones` (`sys_seg_funciones_id`, `sys_seg_submodulos_id`, `nombre_funcion`, `visible_menu`, `estado`) VALUES (7, 4, 'Gestion SubModulos', 1, 1);
INSERT INTO `sys_seg_funciones` (`sys_seg_funciones_id`, `sys_seg_submodulos_id`, `nombre_funcion`, `visible_menu`, `estado`) VALUES (8, 4, 'Gestion Funciones', 1, 1);
INSERT INTO `sys_seg_funciones` (`sys_seg_funciones_id`, `sys_seg_submodulos_id`, `nombre_funcion`, `visible_menu`, `estado`) VALUES (9, 4, 'Gestion Recursos', 1, 1);
INSERT INTO `sys_seg_funciones` (`sys_seg_funciones_id`, `sys_seg_submodulos_id`, `nombre_funcion`, `visible_menu`, `estado`) VALUES (10, 5, 'Parametros Robot', 1, 1);
INSERT INTO `sys_seg_funciones` (`sys_seg_funciones_id`, `sys_seg_submodulos_id`, `nombre_funcion`, `visible_menu`, `estado`) VALUES (11, 5, 'Parametros Sistema', 1, 1);
INSERT INTO `sys_seg_funciones` (`sys_seg_funciones_id`, `sys_seg_submodulos_id`, `nombre_funcion`, `visible_menu`, `estado`) VALUES (12, 6, 'Control Online', 1, 1);
INSERT INTO `sys_seg_funciones` (`sys_seg_funciones_id`, `sys_seg_submodulos_id`, `nombre_funcion`, `visible_menu`, `estado`) VALUES (13, 6, 'Visualizacion', 1, 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `SYM3`.`sys_seg_recursos`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `SYM3`;
INSERT INTO `sys_seg_recursos` (`sys_seg_recursos_id`, `sys_seg_funciones_id`, `identificador_recurso`, `es_principal`, `estado`) VALUES (1, 1, 'LoggedPage', 1, 1);
INSERT INTO `sys_seg_recursos` (`sys_seg_recursos_id`, `sys_seg_funciones_id`, `identificador_recurso`, `es_principal`, `estado`) VALUES (2, 2, 'Sistema.GestionUsuarios', 1, 1);
INSERT INTO `sys_seg_recursos` (`sys_seg_recursos_id`, `sys_seg_funciones_id`, `identificador_recurso`, `es_principal`, `estado`) VALUES (3, 3, 'Sistema.PerfilesUsuarios', 0, 1);
INSERT INTO `sys_seg_recursos` (`sys_seg_recursos_id`, `sys_seg_funciones_id`, `identificador_recurso`, `es_principal`, `estado`) VALUES (4, 4, 'Sistema.GestionPerfiles', 1, 1);
INSERT INTO `sys_seg_recursos` (`sys_seg_recursos_id`, `sys_seg_funciones_id`, `identificador_recurso`, `es_principal`, `estado`) VALUES (5, 5, 'Sistema.FuncionesPerfil', 0, 1);
INSERT INTO `sys_seg_recursos` (`sys_seg_recursos_id`, `sys_seg_funciones_id`, `identificador_recurso`, `es_principal`, `estado`) VALUES (6, 6, 'Sistema.GestionModulos', 1, 1);
INSERT INTO `sys_seg_recursos` (`sys_seg_recursos_id`, `sys_seg_funciones_id`, `identificador_recurso`, `es_principal`, `estado`) VALUES (7, 7, 'Sistema.GestionSubModulos', 1, 1);
INSERT INTO `sys_seg_recursos` (`sys_seg_recursos_id`, `sys_seg_funciones_id`, `identificador_recurso`, `es_principal`, `estado`) VALUES (8, 8, 'Sistema.GestionFunciones', 1, 1);
INSERT INTO `sys_seg_recursos` (`sys_seg_recursos_id`, `sys_seg_funciones_id`, `identificador_recurso`, `es_principal`, `estado`) VALUES (9, 9, 'Sistema.GestionRecursos', 1, 1);
INSERT INTO `sys_seg_recursos` (`sys_seg_recursos_id`, `sys_seg_funciones_id`, `identificador_recurso`, `es_principal`, `estado`) VALUES (10, 10, 'Melfa.ParametrosRobot', 1, 1);
INSERT INTO `sys_seg_recursos` (`sys_seg_recursos_id`, `sys_seg_funciones_id`, `identificador_recurso`, `es_principal`, `estado`) VALUES (11, 11, 'Melfa.ParametrosSistema', 0, 1);
INSERT INTO `sys_seg_recursos` (`sys_seg_recursos_id`, `sys_seg_funciones_id`, `identificador_recurso`, `es_principal`, `estado`) VALUES (12, 12, 'Melfa.ControlOnline', 0, 1);
INSERT INTO `sys_seg_recursos` (`sys_seg_recursos_id`, `sys_seg_funciones_id`, `identificador_recurso`, `es_principal`, `estado`) VALUES (13, 13, 'Melfa.VideoOnline', 1, 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `SYM3`.`sys_seg_usuarios_has_perfiles`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `SYM3`;
INSERT INTO `sys_seg_usuarios_has_perfiles` (`sys_seg_usuarios_id`, `sys_seg_perfiles_id`) VALUES (1, 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `SYM3`.`sys_seg_perfiles_has_funciones`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `SYM3`;
INSERT INTO `sys_seg_perfiles_has_funciones` (`sys_seg_perfiles_id`, `sys_seg_funciones_id`) VALUES (1, 1);
INSERT INTO `sys_seg_perfiles_has_funciones` (`sys_seg_perfiles_id`, `sys_seg_funciones_id`) VALUES (1, 2);
INSERT INTO `sys_seg_perfiles_has_funciones` (`sys_seg_perfiles_id`, `sys_seg_funciones_id`) VALUES (1, 3);
INSERT INTO `sys_seg_perfiles_has_funciones` (`sys_seg_perfiles_id`, `sys_seg_funciones_id`) VALUES (1, 4);
INSERT INTO `sys_seg_perfiles_has_funciones` (`sys_seg_perfiles_id`, `sys_seg_funciones_id`) VALUES (1, 5);
INSERT INTO `sys_seg_perfiles_has_funciones` (`sys_seg_perfiles_id`, `sys_seg_funciones_id`) VALUES (1, 6);
INSERT INTO `sys_seg_perfiles_has_funciones` (`sys_seg_perfiles_id`, `sys_seg_funciones_id`) VALUES (1, 7);
INSERT INTO `sys_seg_perfiles_has_funciones` (`sys_seg_perfiles_id`, `sys_seg_funciones_id`) VALUES (1, 8);
INSERT INTO `sys_seg_perfiles_has_funciones` (`sys_seg_perfiles_id`, `sys_seg_funciones_id`) VALUES (1, 9);
INSERT INTO `sys_seg_perfiles_has_funciones` (`sys_seg_perfiles_id`, `sys_seg_funciones_id`) VALUES (1, 10);
INSERT INTO `sys_seg_perfiles_has_funciones` (`sys_seg_perfiles_id`, `sys_seg_funciones_id`) VALUES (1, 11);
INSERT INTO `sys_seg_perfiles_has_funciones` (`sys_seg_perfiles_id`, `sys_seg_funciones_id`) VALUES (1, 12);
INSERT INTO `sys_seg_perfiles_has_funciones` (`sys_seg_perfiles_id`, `sys_seg_funciones_id`) VALUES (1, 13);

COMMIT;

-- -----------------------------------------------------
-- Data for table `SYM3`.`configuracion_melfa`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `SYM3`;
INSERT INTO `configuracion_melfa` (`direccion_ip`, `timeout`, `puerto`, `configuracion_melfa_id`, `desplazamiento`, `velocidad`) VALUES ('192.168.0.1', 7000, 10001, 1, 5, 50);

COMMIT;

-- -----------------------------------------------------
-- Data for table `SYM3`.`configuracion_sistema`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `SYM3`;
INSERT INTO `configuracion_sistema` (`email_administrador`, `dominio_aplicacion`, `direccion_ip_camara`, `configuracion_sistema_id`) VALUES ('admin@sym3.dyndns.org', 'sym3.dyndns.org', '192.168.0.115', 1);

COMMIT;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;