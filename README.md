## Socio

For this project function properly, a database is needed. Create a database called 'socio', then create two table for it.
The tables are called 'posts' and 'users' 

+-----------------+
| Tables_in_socio |
+-----------------+
| posts           |
| users           |
+-----------------+

The description of tables are as following:

--> posts
+--------------+--------------+------+-----+---------+----------------+
| Field        | Type         | Null | Key | Default | Extra          |
+--------------+--------------+------+-----+---------+----------------+
| id           | int(11)      | NO   | PRI | NULL    | auto_increment |
| description  | text         | NO   |     | NULL    |                |
| image        | varchar(100) | YES  |     | NULL    |                |
| username     | varchar(60)  | NO   |     | NULL    |                |
| userFullName | varchar(100) | NO   |     | NULL    |                |
+--------------+--------------+------+-----+---------+----------------+

--> users
+----------------+--------------+------+-----+---------+----------------+<br>
| Field          | Type         | Null | Key | Default | Extra          |
+----------------+--------------+------+-----+---------+----------------+
| id             | int(11)      | NO   | PRI | NULL    | auto_increment |
| name           | varchar(30)  | NO   |     | NULL    |                |
| lastName       | varchar(30)  | NO   |     | NULL    |                |
| username       | varchar(60)  | NO   | UNI | NULL    |                |
| password       | varchar(100) | NO   |     | NULL    |                |
| profilePicture | varchar(100) | YES  | UNI | NULL    |                |
| coverPhoto     | varchar(100) | YES  | UNI | NULL    |                |
+----------------+--------------+------+-----+---------+----------------+

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
