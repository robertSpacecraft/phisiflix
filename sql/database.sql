DELIMITER //

drop table if exists user;
DROP TABLE IF EXISTS physic;
DROP TABLE IF EXISTS hitos;

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

CREATE TABLE hitos (
                       id            VARCHAR(36) NOT NULL PRIMARY KEY,
                       physic_id     VARCHAR(36) NOT NULL,             -- Relación 1→N hacia physic

                       eventId       VARCHAR(255) DEFAULT NULL,
                       titulo        VARCHAR(255) NOT NULL,
                       descripcion   TEXT DEFAULT NULL,

                       year_start    INT DEFAULT NULL,
                       year_end      INT DEFAULT NULL,

                       label         VARCHAR(255) DEFAULT NULL,
                       summary       TEXT DEFAULT NULL,
                       category      VARCHAR(255) DEFAULT NULL,

                       people            JSON DEFAULT NULL,
                       tags              JSON DEFAULT NULL,
                       list_categorias   JSON DEFAULT NULL,
                       list_campos       JSON DEFAULT NULL,

                       CONSTRAINT fk_hito_physic
                           FOREIGN KEY (physic_id) REFERENCES physic(id)
                               ON DELETE CASCADE
                               ON UPDATE CASCADE
);

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Einstein' LIMIT 1),
           'event-einstein-relativity',
           'Relatividad especial',
           '',
           1905,
           1905,
           'Relatividad especial',
           'Reformula espacio y tiempo; constancia de la velocidad de la luz y equivalencia masa-energía.',
           'mecánica',
           '["Albert Einstein"]',
           '["relatividad", "espaciotiempo"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Einstein' LIMIT 1),
           'event-einstein-photoelectric',
           'Efecto fotoeléctrico',
           '',
           1905,
           1905,
           'Efecto fotoeléctrico',
           'Explica cómo la luz puede liberar electrones de metales, apoyando la naturaleza cuántica de la luz.',
           'física cuántica',
           '["Albert Einstein"]',
           '["efecto fotoeléctrico", "cuantos de luz"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Einstein' LIMIT 1),
           'event-einstein-brownian',
           'Movimiento browniano',
           '',
           1905,
           1905,
           'Movimiento browniano',
           'Demuestra la realidad de los átomos interpretando el movimiento errático de partículas en fluidos.',
           'física estadística',
           '["Albert Einstein"]',
           '["átomos", "movimiento browniano"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Einstein' LIMIT 1),
           'event-einstein-gravity',
           'Relatividad general',
           '',
           1915,
           1915,
           'Relatividad general',
           'Reformula la gravedad como curvatura del espacio-tiempo causada por la masa y la energía.',
           'gravedad',
           '["Albert Einstein"]',
           '["relatividad general", "gravedad", "espaciotiempo"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Einstein' LIMIT 1),
           'event-einstein-bose-condensation',
           'Condensado de Bose-Einstein',
           '',
           1924,
           1925,
           'Condensado de Bose-Einstein',
           'Predice un nuevo estado de la materia cuando muchas partículas bosónicas ocupan el mismo estado cuántico.',
           'física cuántica',
           '["Albert Einstein"]',
           '["condensado de Bose-Einstein", "bosones"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Einstein' LIMIT 1),
           'event-vonneg-entanglement',
           'Entrecruzamiento cuántico (EPR)',
           '',
           1935,
           1935,
           'Entrecruzamiento cuántico (EPR)',
           'Plantea el experimento EPR, cuestionando la completitud de la mecánica cuántica y anticipando el entrelazamiento.',
           'fundamentos cuánticos',
           '["Albert Einstein"]',
           '["EPR", "entrelazamiento", "no localidad"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Newton' LIMIT 1),
           'event-newton-gravity',
           'Ley de gravitación universal',
           '',
           1687,
           1687,
           'Ley de gravitación universal',
           'Formula la ley que describe la atracción gravitatoria entre masas y unifica la física celeste y terrestre.',
           'gravedad',
           '["Isaac Newton"]',
           '["gravedad", "ley de gravitación", "Principia"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Newton' LIMIT 1),
           'event-newton-opticks',
           'Óptica de Newton',
           '',
           1704,
           1704,
           'Óptica de Newton',
           'Estudia la naturaleza de la luz y el color, descomponiendo la luz blanca en su espectro.',
           'óptica',
           '["Isaac Newton"]',
           '["óptica", "espectro", "luz blanca"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Newton' LIMIT 1),
           'event-newton-opticks-1704',
           'Publicación de Opticks',
           '',
           1704,
           1704,
           'Publicación de Opticks',
           'Publica “Opticks”, obra clave sobre la naturaleza de la luz y los experimentos con prismas.',
           'óptica',
           '["Isaac Newton"]',
           '["Opticks", "prismas", "espectro"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Newton' LIMIT 1),
           'event-newton-reflector',
           'Telescopio reflector',
           '',
           1668,
           1668,
           'Telescopio reflector',
           'Construye el primer telescopio reflector práctico, utilizando espejos en lugar de lentes.',
           'instrumentación',
           '["Isaac Newton"]',
           '["telescopio", "reflector", "óptica"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Newton' LIMIT 1),
           'event-newton-spectrum',
           'Espectro de la luz blanca',
           '',
           1666,
           1666,
           'Espectro de la luz blanca',
           'Demuestra que la luz blanca se descompone en colores al pasar por un prisma, formando un espectro continuo.',
           'óptica',
           '["Isaac Newton"]',
           '["espectro", "luz blanca", "prisma"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Planck' LIMIT 1),
           'event-planck-quanta',
           'Cuantos de energía',
           '',
           1900,
           1900,
           'Cuantos de energía',
           'Introduce la idea de que la energía se intercambia en paquetes discretos (cuantos), origen de la mecánica cuántica.',
           'física cuántica',
           '["Max Planck"]',
           '["cuantos", "mecánica cuántica", "radiación del cuerpo negro"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Schrodinger' LIMIT 1),
           'event-schrodinger-equation',
           'Ecuación de Schrödinger',
           '',
           1926,
           1926,
           'Ecuación de Schrödinger',
           'Formula la ecuación fundamental que describe la evolución temporal de los estados cuánticos.',
           'física cuántica',
           '["Erwin Schrödinger"]',
           '["ecuación de Schrödinger", "mecánica ondulatoria"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Curie' LIMIT 1),
           'event-curie-radioactivity',
           'Descubrimiento de la radiactividad',
           '',
           1898,
           1898,
           'Descubrimiento de la radiactividad',
           'Aísla nuevos elementos radiactivos (polonio y radio) y desarrolla técnicas para estudiar la radiactividad.',
           'física nuclear',
           '["Marie Curie"]',
           '["radiactividad", "polonio", "radio"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Curie' LIMIT 1),
           'event-curie-nobel',
           'Premios Nobel de Marie Curie',
           '',
           1903,
           1911,
           'Premios Nobel de Marie Curie',
           'Recibe dos premios Nobel por sus trabajos en radiactividad y química del radio, siendo pionera en ambos campos.',
           'reconocimiento científico',
           '["Marie Curie"]',
           '["Premio Nobel", "radiactividad", "química"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Tesla' LIMIT 1),
           'event-tesla-ac',
           'Corriente alterna y motor de inducción',
           '',
           1887,
           1888,
           'Corriente alterna y motor de inducción',
           'Desarrolla sistemas de corriente alterna y el motor de inducción, base de la electrificación moderna.',
           'electromagnetismo',
           '["Nikola Tesla"]',
           '["corriente alterna", "motor de inducción", "electrificación"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Feynman' LIMIT 1),
           'event-quantum-electrodynamics',
           'Electrodinámica cuántica (QED)',
           '',
           1940,
           1950,
           'Electrodinámica cuántica (QED)',
           'Contribuye decisivamente a la teoría cuántica del electromagnetismo (QED), una de las teorías más precisas de la física.',
           'física cuántica',
           '["Richard Feynman"]',
           '["QED", "electrodinámica cuántica"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Feynman' LIMIT 1),
           'event-feynman-diagrams',
           'Diagramas de Feynman',
           '',
           1948,
           1948,
           'Diagramas de Feynman',
           'Introduce representaciones gráficas para los procesos de interacción de partículas, simplificando los cálculos en QED.',
           'física de partículas',
           '["Richard Feynman"]',
           '["diagramas de Feynman", "interacciones de partículas"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Feynman' LIMIT 1),
           'event-feynman-qed',
           'Formulación de QED',
           '',
           1949,
           1949,
           'Formulación de QED',
           'Publica trabajos clave que consolidan la formulación de la electrodinámica cuántica moderna.',
           'física cuántica',
           '["Richard Feynman"]',
           '["QED", "teoría cuántica de campos"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Feynman' LIMIT 1),
           'event-feynman-nobel',
           'Premio Nobel de Feynman',
           '',
           1965,
           1965,
           'Premio Nobel de Feynman',
           'Recibe el Premio Nobel de Física por sus contribuciones a la electrodinámica cuántica.',
           'reconocimiento científico',
           '["Richard Feynman"]',
           '["Premio Nobel", "QED"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Faraday' LIMIT 1),
           'event-faraday-induction',
           'Inducción electromagnética',
           '',
           1831,
           1831,
           'Inducción electromagnética',
           'Descubre que un campo magnético variable induce una corriente eléctrica, base de los generadores eléctricos.',
           'electromagnetismo',
           '["Michael Faraday"]',
           '["inducción electromagnética", "generadores eléctricos"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Faraday' LIMIT 1),
           'event-faraday-lines',
           'Líneas de campo',
           '',
           1830,
           1850,
           'Líneas de campo',
           'Introduce el concepto de líneas de campo para visualizar campos eléctricos y magnéticos.',
           'electromagnetismo',
           '["Michael Faraday"]',
           '["líneas de campo", "campo eléctrico", "campo magnético"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Faraday' LIMIT 1),
           'event-faraday-electrolysis',
           'Leyes de la electrólisis',
           '',
           1834,
           1834,
           'Leyes de la electrólisis',
           'Formula leyes cuantitativas que relacionan la cantidad de electricidad con la masa de sustancia depositada o disuelta.',
           'electroquímica',
           '["Michael Faraday"]',
           '["electrólisis", "leyes de Faraday"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Faraday' LIMIT 1),
           'event-faraday-dynamo-principle',
           'Principio de la dinamo',
           '',
           1831,
           1831,
           'Principio de la dinamo',
           'Demuestra cómo el movimiento en un campo magnético puede generar corriente, fundamento de los generadores eléctricos.',
           'electromagnetismo',
           '["Michael Faraday"]',
           '["dinamo", "generadores", "inducción"]',
           '[]',
           '[]'
       );

INSERT INTO hitos
(id, physic_id, eventId, titulo, descripcion, year_start, year_end, label, summary, category, people, tags, list_categorias, list_campos)
VALUES (
           UUID(),
           (SELECT id FROM physic WHERE apellido = 'Faraday' LIMIT 1),
           'event-faraday-rotation',
           'Rotación de Faraday',
           '',
           1845,
           1845,
           'Rotación de Faraday',
           'Observa cómo un campo magnético puede rotar el plano de polarización de la luz, vinculando luz y electromagnetismo.',
           'óptica',
           '["Michael Faraday"]',
           '["rotación de Faraday", "polarización", "electromagnetismo"]',
           '[]',
           '[]'
       );


COMMIT;