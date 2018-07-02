create database moviereviews;
create table users(email varchar(100) primary key not null, password varchar(256) not null);
create table movies(name varchar(50) primary key not null, image blob not null, description varchar(256) not null, rating float(2,1) not null, total bigint not null);
grant all on moviereviews to user@localhost identified by “user”;
GRANT ALL PRIVILEGES ON moviereviews.* to ''@'localhost';
FLUSH PRIVILEGES;