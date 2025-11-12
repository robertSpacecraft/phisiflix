-- Reconstrucción completa de BD (MySQL 8.0+)
-- Ejecutar en una sola pasada

START TRANSACTION;

-- 1) Esquema
CREATE SCHEMA IF NOT EXISTS proyecto
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_0900_ai_ci;

USE proyecto;

-- 2) Limpieza
DROP TABLE IF EXISTS physic;
DROP TABLE IF EXISTS user;

-- 3) Tablas
CREATE TABLE user (
                      id         VARCHAR(60)  NOT NULL,
                      username   VARCHAR(30)  NOT NULL,
                      email      VARCHAR(255) NOT NULL,
                      password   VARCHAR(255) NOT NULL,
                      birthdate  DATE         NULL,
                      type       VARCHAR(20)  NOT NULL,
                      CONSTRAINT pk_user PRIMARY KEY (id),
                      CONSTRAINT uk_user_email UNIQUE (email),
                      CONSTRAINT uk_user_username UNIQUE (username),
                      CONSTRAINT ck_user_usertype CHECK (type IN ('ADMIN','EDITOR','REGULAR','ADVERTISING'))
) ENGINE=InnoDB;

CREATE TABLE physic (
                        id            VARCHAR(60)   NOT NULL,
                        nombre        VARCHAR(80)   NOT NULL,
                        apellido      VARCHAR(120)  NULL,
                        genero        VARCHAR(12)   NOT NULL,  -- PhysicGenero
                        nacionalidad  VARCHAR(80)   NOT NULL,
                        lugar_def     VARCHAR(120)  NULL,
                        descripcion   TEXT          NULL,      -- rasgos personales
                        etiqueta      VARCHAR(255)  NULL,      -- tags separados por coma
                        type          VARCHAR(20)   NOT NULL,  -- PhysicType
                        foto          VARCHAR(255)  NULL,
                        CONSTRAINT pk_physic PRIMARY KEY (id),
                        CONSTRAINT ck_physic_genero CHECK (genero IN ('MALE','FEMALE','NON_BINARY','UNKNOWN')),
                        CONSTRAINT ck_physic_type   CHECK (type   IN ('PERSON','INSTITUTION'))
) ENGINE=InnoDB;

-- Índices útiles
CREATE INDEX ix_physic_apellido ON physic(apellido);
CREATE INDEX ix_physic_etiqueta ON physic(etiqueta);

-- 4) Datos iniciales

-- Usuarios
INSERT INTO user (id, username, email, password, birthdate, type) VALUES
                                                                      ('06d48842-90ff-496b-bee3-e5f1a86c9100','miguel','miguel@mail.com','$2y$10$bzK6MIAWegEIfzZfJC9Kv.6aYSFOMamS6u3qrDTlUNVThQyFbu/w2','1980-05-20','ADMIN'),
                                                                      ('299da9c8-c993-4c3f-90b0-ab5940a19a43','Graciela','graciela@mail.com','$2y$10$8k2mQQr/cAWwY9FDc0JoPO7HIYomk1pZpL3PREgdYVDNXNNcR3HAu','1986-04-15','REGULAR'),
                                                                      ('57341fe4-424f-406d-9b7d-9078a2f7bb8a','Roberto','roberto@mail.com','$2y$10$.p5t4CIbRwVijUEEVIT6COaWnn0Laq78x0ERIHLyjY6ZuR03zXeWO','1984-05-05','ADMIN'),
                                                                      ('ede2ca7b-d4a3-4722-b172-912cbeb0d639','María','maria@mail.com','$2y$10$SrIfmp.z.OslGtwNWzw.Q.9WXp0eZB4EvKQerOOqy3llE0q4mP3Se','1995-08-16','EDITOR');

-- Physic
INSERT INTO physic
(id, nombre, apellido, genero, nacionalidad, lugar_def, descripcion, etiqueta, type, foto)
VALUES
    ('11111111-1111-4111-8111-111111111111',
     'Isaac','Newton','MALE','británica','Kensington, Londres, Reino Unido',
     'Reservado, solitario y muy meticuloso; evitaba la exposición pública y volcaba su vida en el estudio y la religiosidad.',
     'gravedad, cálculo, óptica, mecánica clásica, física, matemáticas',
     'PERSON','IsaacNewton.png'),

    ('22222222-2222-4222-8222-222222222222',
     'Albert','Einstein','MALE','alemana','Princeton, Nueva Jersey, Estados Unidos',
     'Carismático, inquisitivo y humanista; espíritu rebelde, irónico, defensor de la paz y la libertad intelectual.',
     'relatividad, fotoeléctrico, cosmología, pacifismo, filosofía, ciencia moderna',
     'PERSON','AlbertEinstein.png'),

    ('33333333-3333-4333-8333-333333333333',
     'Max','Planck','MALE','alemana','Göttingen, Alemania',
     'Disciplinado, sereno y con fuerte sentido ético; modelo de integridad científica en tiempos difíciles.',
     'cuantos, constante de Planck, física teórica, termodinámica, mecánica cuántica',
     'PERSON','MaxPlanck.png'),

    ('44444444-4444-4444-8444-444444444444',
     'Erwin','Schrödinger','MALE','austríaca','Viena, Austria',
     'Brillante y excéntrico; mente inquieta, vida personal poco convencional y vocación por unir ciencia y filosofía.',
     'mecánica cuántica, ecuación de Schrödinger, gato de Schrödinger, filosofía, biología cuántica',
     'PERSON','ErwinSchrodinger.png');

COMMIT;

-- Nota: si tu MySQL < 8.0.16, los CHECK podrían ignorarse. En ese caso usa ENUM o valida en aplicación.
