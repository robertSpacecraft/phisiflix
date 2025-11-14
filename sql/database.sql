DELIMITER //

drop table if exists user;
//

create table user(
                     id varchar(60),
                     username varchar(30),
                     email varchar(255),
                     password varchar(255),
                     birthdate date,
                     type varchar(20)
);

alter table user add constraint pk_user primary key (id);
alter table user add constraint uk_user_email unique (email);
alter table user add constraint uk_user_username unique (username);

alter table user add constraint ck_user_usertype check (type in('ADMIN', 'EDITOR', 'REGULAR', 'ADVERTISING'));


INSERT INTO proyecto.user (id, username, email, password, birthdate, type) VALUES ('06d48842-90ff-496b-bee3-e5f1a86c9100', 'miguel', 'miguel@mail.com', '$2y$10$bzK6MIAWegEIfzZfJC9Kv.6aYSFOMamS6u3qrDTlUNVThQyFbu/w2', '1980-05-20', 'ADMIN');
INSERT INTO proyecto.user (id, username, email, password, birthdate, type) VALUES ('299da9c8-c993-4c3f-90b0-ab5940a19a43', 'Graciela', 'graciela@mail.com', '$2y$10$8k2mQQr/cAWwY9FDc0JoPO7HIYomk1pZpL3PREgdYVDNXNNcR3HAu', '1986-04-15', 'REGULAR');
INSERT INTO proyecto.user (id, username, email, password, birthdate, type) VALUES ('57341fe4-424f-406d-9b7d-9078a2f7bb8a', 'Roberto', 'roberto@mail.com', '$2y$10$.p5t4CIbRwVijUEEVIT6COaWnn0Laq78x0ERIHLyjY6ZuR03zXeWO', '1984-05-05', 'ADMIN');
INSERT INTO proyecto.user (id, username, email, password, birthdate, type) VALUES ('ede2ca7b-d4a3-4722-b172-912cbeb0d639', 'María', 'maria@mail.com', '$2y$10$SrIfmp.z.OslGtwNWzw.Q.9WXp0eZB4EvKQerOOqy3llE0q4mP3Se', '1995-08-16', 'EDITOR');


/*
Para encriptar la password y que verify funcione introduce el comando siguiente en la consola del servidor:
php -r 'echo password_hash("otrebor5555", PASSWORD_DEFAULT), PHP_EOL;'
*/

-- ==========================================================
-- RECREACIÓN COMPLETA DE TABLA PHYSIC
-- Compatible con MySQL 8.0+
-- ==========================================================

START TRANSACTION;

USE proyecto;

-- 1. Eliminar tabla existente
DROP TABLE IF EXISTS physic;

-- 2. Crear tabla con enums actualizados
CREATE TABLE physic (
                        id            VARCHAR(60)   NOT NULL,
                        nombre        VARCHAR(80)   NOT NULL,
                        apellido      VARCHAR(120)  NULL,
                        genero        VARCHAR(20)   NOT NULL,  -- PhysicGenero
                        nacionalidad  VARCHAR(80)   NOT NULL,
                        lugar_def     VARCHAR(120)  NULL,
                        descripcion   TEXT          NULL,      -- Descripción personal o carácter
                        etiqueta      VARCHAR(255)  NULL,      -- Palabras clave, separadas por coma
                        type          VARCHAR(20)   NOT NULL,  -- PhysicType
                        foto          VARCHAR(255)  NULL,
                        CONSTRAINT pk_physic PRIMARY KEY (id),
                        CONSTRAINT ck_physic_genero
                            CHECK (genero IN ('MASCULINO','FEMENINO','NO_APLICA','NOT_DEFINED')),
                        CONSTRAINT ck_physic_type
                            CHECK (type IN ('PERSONA','INSTITUCION','INSTRUMENTO','EXPERIMENTO','PUBLICACION'))
) ENGINE=InnoDB;

-- 3. Insertar registros base
INSERT INTO physic
(id, nombre, apellido, genero, nacionalidad, lugar_def, descripcion, etiqueta, type, foto)
VALUES
-- Isaac Newton
('11111111-1111-4111-8111-111111111111',
 'Isaac', 'Newton', 'MASCULINO', 'británica', 'Kensington, Londres, Reino Unido',
 'Reservado, solitario y meticuloso. Evitaba la exposición pública y volcaba su vida en el estudio y la religión.',
 'gravedad, cálculo, óptica, mecánica clásica, física, matemáticas',
 'PERSONA', 'IsaacNewton.png'),

-- Albert Einstein
('22222222-2222-4222-8222-222222222222',
 'Albert', 'Einstein', 'MASCULINO', 'alemana', 'Princeton, Nueva Jersey, Estados Unidos',
 'Carismático, rebelde e irónico, con gran sentido humanista y pacifista. Cuestionaba toda autoridad científica.',
 'relatividad, fotoeléctrico, cosmología, pacifismo, filosofía, ciencia moderna',
 'PERSONA', 'AlbertEinstein.png'),

-- Max Planck
('33333333-3333-4333-8333-333333333333',
 'Max', 'Planck', 'MASCULINO', 'alemana', 'Göttingen, Alemania',
 'Disciplinado, sereno y con profundo sentido ético. Defensor de la integridad científica y la serenidad moral.',
 'cuantos, constante de Planck, física teórica, termodinámica, mecánica cuántica',
 'PERSONA', 'MaxPlanck.png'),

-- Erwin Schrödinger
('44444444-4444-4444-8444-444444444444',
 'Erwin', 'Schrödinger', 'MASCULINO', 'austríaca', 'Viena, Austria',
 'Intelectual brillante y excéntrico, de vida poco convencional y mente inquieta. Buscaba unir ciencia y filosofía.',
 'mecánica cuántica, ecuación de Schrödinger, gato de Schrödinger, filosofía, biología cuántica',
 'PERSONA', 'ErwinSchrodinger.png'),

-- Marie Curie
('55555555-5555-4555-8555-555555555555',
 'Marie', 'Curie', 'FEMENINO', 'polaca', 'Sallanches, Francia',
 'Perseverante, reservada y humilde. Su vocación por la investigación la llevó a superar prejuicios de género en la ciencia.',
 'radiactividad, polonio, radio, Nobel, física, química',
 'PERSONA', 'MarieCurie.png'),

-- Nikola Tesla
('66666666-6666-4666-8666-666666666666',
 'Nikola', 'Tesla', 'MASCULINO', 'serbia', 'Nueva York, Estados Unidos',
 'Inventor visionario, excéntrico y perfeccionista. Su creatividad ilimitada lo llevó a vivir entre el genio y la obsesión.',
 'corriente alterna, bobina Tesla, electromagnetismo, ingeniería eléctrica, inventos',
 'PERSONA', 'NikolaTesla.png'),

('77777777-7777-4777-8777-777777777777',
 'Richard', 'Feynman', 'MASCULINO', 'estadounidense', 'Pasadena, California, Estados Unidos',
 'Físico brillante, creativo y con gran sentido del humor. Destacado divulgador científico y ganador del Premio Nobel por su trabajo en electrodinámica cuántica.',
 'electrodinámica cuántica, física teórica, divulgación científica, Premio Nobel',
 'PERSONA', 'RichardFeynman.png');



COMMIT;