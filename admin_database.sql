use webb;

Create table if not exists Admin_user (
id		int auto_increment primary key,
username varchar(50),
user_password varchar(50),
fullname	varchar(100)
);

select * from Admin_user;
drop table Admin_user;