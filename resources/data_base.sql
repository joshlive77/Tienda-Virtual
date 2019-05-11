CREATE DATABASE tienda_master;
USE tienda_master;

-- -----------------------------------------------------
-- Table `tienda_master`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE usuarios (
  `id` INT(255) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `apellidos` VARCHAR(255) NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `rol` VARCHAR(20) NULL,
  `imagen` VARCHAR(255) NULL,
  CONSTRAINT pk_usuario PRIMARY KEY (`id`),
  CONSTRAINT uq_email UNIQUE(email)
)ENGINE = InnoDB;

INSERT INTO usuarios VALUES(NULL,'Admin', 'Admin', 'admin@admin.com', 'contraseña', 'admin', null);

-- -----------------------------------------------------
-- Table `tienda_master`.`categorias`
-- -----------------------------------------------------
CREATE TABLE categorias (
  `id` INT(255) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  CONSTRAINT pk_categorias PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO categorias VALUES(NULL, 'Manga corta');
INSERT INTO categorias VALUES(NULL, 'Tirantes');
INSERT INTO categorias VALUES(NULL, 'Manga larga');
INSERT INTO categorias VALUES(NULL, 'Sudadera');


-- -----------------------------------------------------
-- Table `tienda_master`.`productos`
-- -----------------------------------------------------
CREATE TABLE productos (
  `id` INT(255) NOT NULL AUTO_INCREMENT,
  `categoria_id` INT(255) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` TEXT NULL,
  `precio` FLOAT(100,2) NOT NULL,
  `stock` INT(255) NOT NULL,
  `oferta` VARCHAR(2) NULL,
  `fecha` DATE NOT NULL,
  `imagen` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_categoria_id` FOREIGN KEY (`categoria_id`) REFERENCES `tienda_master`.`categorias` (`id`)
)ENGINE = InnoDB;




-- -----------------------------------------------------
-- Table `tienda_master`.`pedidos`
-- -----------------------------------------------------
CREATE TABLE pedidos (
  `id` INT(255) NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(255) NOT NULL,
  `provincia` VARCHAR(100) NOT NULL,
  `localidad` VARCHAR(100) NOT NULL,
  `direccion` VARCHAR(255) NOT NULL,
  `coste` FLOAT(200,2) NOT NULL,
  `estado` VARCHAR(20) NOT NULL,
  `fecha` DATE NULL,
  `hora` TIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `tienda_master`.`usuarios` (`id`)
)ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tienda_master`.`lineas_pedidos`
-- -----------------------------------------------------
CREATE TABLE lineas_pedidos (
  `id` INT(255) NOT NULL AUTO_INCREMENT,
  `pedido_id` INT(255) NOT NULL,
  `producto_id` INT(255) NOT NULL,
  'unidades' INT(255) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_linea_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `tienda_master`.`pedidos` (`id`),
  CONSTRAINT `fk_linea_productos`FOREIGN KEY (`producto_id`) REFERENCES `tienda_master`.`productos` (`id`)
)ENGINE = InnoDB;
