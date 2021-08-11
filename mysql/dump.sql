create table employees (
    id int not null primary key auto_increment,
    name varchar(255) null default null,
    age varchar(255) null default null,
    salary varchar(255) null default null,
    department_id int null default null
);
create table departments (
    id int not null primary key auto_increment,
    name varchar(255) null default null
);

insert into employees (name, age, salary, department_id) values ('Ivan', 25, 1000, 1), ('Vasya', 25, 2000, 2);
insert into departments (name) values ('front'), ('test');