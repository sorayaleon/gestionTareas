CREATE DATABASE IF NOT EXISTS gestionTareas;
USE gestionTareas;

CREATE TABLE IF NOT EXISTS users(
id              int(255) auto_increment not null,
rol             varchar(50),
nombre          varchar(100),
apellidos       varchar(300),
email           varchar(255),
password        varchar(255),
created_at      datetime,
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'ROLE_USER', 'Soraya', 'León', 'soraya@soraya.com', '12345', CURTIME());
INSERT INTO users VALUES(NULL, 'ROLE_USER', 'Pepe', 'Pérez', 'pepe@pepe.com', '12345', CURTIME());
INSERT INTO users VALUES(NULL, 'ROLE_USER', 'Carlos', 'Ruz', 'carlos@carlos.com', '12345', CURTIME());

CREATE TABLE IF NOT EXISTS tareas(
id              int(255) auto_increment not null,
user_id         int(255) not null,
titulo          varchar(255),
contenido       text,
prioridad       varchar(20),
horas           int(100),
created_at      datetime,
CONSTRAINT pk_tareas PRIMARY KEY(id),
CONSTRAINT pk_tareas_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO tareas VALUES(NULL, 1, 'Tarea 1', 'Revisar proyecto Symfony', 'baja', 8, CURTIME());
INSERT INTO tareas VALUES(NULL, 1, 'Tarea 2', 'Reunión con cliente', 'alta', 2, CURTIME());
INSERT INTO tareas VALUES(NULL, 1, 'Tarea 3', 'Planificar presupuestos', 'media', 3, CURTIME());