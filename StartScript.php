<?php
require 'config/db.php';
/* ТАБЛИЦА EMPLOYEES*/
$sql =
'DROP TABLE IF EXISTS main.departments;
DROP TABLE IF EXISTS main.projects;
DROP TABLE IF EXISTS main.employees;
DROP TABLE IF EXISTS main.reports;


CREATE TABLE main.departments (
	id serial NOT NULL primary key,
	name varchar NOT NULL,
	created_at timestamp NOT NULL DEFAULT now(),
	updated_at timestamp NULL DEFAULT now(),
	is_delete int default 0
);

CREATE TABLE main.projects (
	id serial NOT NULL primary key ,
	name varchar NOT NULL,
	created_at timestamp NOT NULL DEFAULT now(),
	updated_at timestamp NULL DEFAULT now(),
	is_delete int default 0
);


CREATE TABLE main.employees (
	id serial NOT NULL primary key,
	name varchar NOT NULL,
	surname varchar NULL,
	gender varchar NULL,
	birthday date NOT NULL,
	gross int,
	created_at timestamp NOT NULL DEFAULT now(),
	updated_at timestamp NULL DEFAULT now(),
	department_id int,
	project_id int,
	is_delete int default 0,
	CONSTRAINT fk_department_employees
      FOREIGN KEY(department_id)
	  REFERENCES main.departments(id)
	  ON DELETE SET NULL,
	CONSTRAINT fk_projects_employees
      FOREIGN KEY(project_id)
	  REFERENCES main.projects(id)
	  ON DELETE SET NULL
);

INSERT INTO main.departments
("name")
values (\'depname1\'),(\'depname2\'),(\'depname3\');

INSERT INTO main.projects
("name")
values (\'projectname1\'),(\'projectname2\'),(\'projectname3\');


INSERT INTO main.employees
("name", surname, gender, birthday, gross, department_id, project_id)
values
(\'name1\', \'surname1\', \'мужской\', \'1993.02.01\', 100, 1, 2),
(\'name2\', \'surname2\', \'женский\', \'1993.03.01\', 120, 2, 2),
(\'name3\', \'surname3\', \'мужской\', \'1993.04.01\', 130, 3, 1),
(\'name4\', \'surname4\', \'мужской\', \'1993.04.01\', 140, 1, 1),
(\'name5\', \'surname5\', \'мужской\', \'1993.04.01\', 150, 2, 3),
(\'name6\', \'surname6\', \'мужской\', \'1993.02.01\', 160, 3, 3),
(\'name7\', \'surname7\', \'женский\', \'1993.03.01\', 170, 1, 2),
(\'name8\', \'surname8\', \'мужской\', \'1993.04.01\', 180, 2, 1),
(\'name9\', \'surname9\', \'мужской\', \'1993.04.01\', 190, 3, 2),
(\'name10\', \'surname10\', \'мужской\', \'1993.04.01\', 200, 1, 1);';

$query = $pdo->exec($sql);

