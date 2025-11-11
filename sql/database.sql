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