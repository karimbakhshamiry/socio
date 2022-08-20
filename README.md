## Socio

For this project function properly, a database is needed. Create a database called 'socio', then create two table for it.
The tables are called 'posts' and 'users'  <br>

+-----------------+ <br>
| Tables_in_socio | <br>
+-----------------+ <br>
| posts           |v
| users           | <br>
+-----------------+ <br>

The description of tables are as following:

--> posts <br>
+--------------+--------------+------+-----+---------+----------------+ <br>
| Field        | Type         | Null | Key | Default | Extra          | <br>
+--------------+--------------+------+-----+---------+----------------+ <br>
| id           | int(11)      | NO   | PRI | NULL    | auto_increment | <br>
| description  | text         | NO   |     | NULL    |                | <br>
| image        | varchar(100) | YES  |     | NULL    |                | <br>
| username     | varchar(60)  | NO   |     | NULL    |                | <br>
| userFullName | varchar(100) | NO   |     | NULL    |                | <br>
+--------------+--------------+------+-----+---------+----------------+ <br>
 
--> users <br>
+----------------+--------------+------+-----+---------+----------------+ <br>
| Field          | Type         | Null | Key | Default | Extra          | <br>
+----------------+--------------+------+-----+---------+----------------+ <br>
| id             | int(11)      | NO   | PRI | NULL    | auto_increment | <br>
| name           | varchar(30)  | NO   |     | NULL    |                | <br>
| lastName       | varchar(30)  | NO   |     | NULL    |                | <br>
| username       | varchar(60)  | NO   | UNI | NULL    |                | <br>
| password       | varchar(100) | NO   |     | NULL    |                | <br>
| profilePicture | varchar(100) | YES  | UNI | NULL    |                | <br>
| coverPhoto     | varchar(100) | YES  | UNI | NULL    |                | <br>
+----------------+--------------+------+-----+---------+----------------+ <br>

Create tables using the following commands:
1. create table user (
    id int auto_increment primary key,
    name varchar(30) not null,
    lastName varchar(30) not null,
    username varchar(60) not null unique,
    password varchar(100) not null,
    profilePicture varchar(100) unique,
    coverPhoto varchar(100) unique
);

2. create table post (
    id int auto_increment primary key, 
    description text not null, 
    image varchar(100), 
    username varchar(60) not null, 
    userFullName varchar(100) not null
)

And set your local database system username and password in connection_db file.
If you have come this far and done all the steps, then you are all set.

NOTE: There are some improvments needed which will be committed as I make program is this area.
