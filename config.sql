drop database if exists n0taja00;
create database n0taja00;

create table customer (
    firstname char(50),
    lastname char(50),
	username varchar(50) primary key,
	password varchar(150) not null
);

create table info (
	username varchar(50),
	phonenum varchar(50),
    height varchar(50),
	weight varchar(50),
	foreign key (username) references customer(username)
);