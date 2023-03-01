create database if not EXISTS `popshot`;
use `popshot`;


create table entry 
(entry_id int(8),
entry_title varchar(45),
entry_content varchar(255),
constraint c1 primary key (entry_id)) ;

insert into entry values (1, 'Premier post', 'Voici notre premier post ....');
insert into entry values (2, 'Nouveautés', 'Nous avons plein de nouveautés'); 
insert into entry values (3, 'Première vidéo', 'La video de présentation de notre équipe, enfin arrivée !'); 
insert into entry values (4, 'Premier contract', 'Notre premier contract, établit avec IBM'); 
insert into entry values (5, 'Invité', 'Voici notre premier invité, il se nomme Yann, il viens du chnord ....');

select * from entry;


create table ressource 
(ressource_id int(8),
ress_type varchar(45),
ress_date date,
ress_auteur varchar(255),
adresse varchar(255),
constraint c2 primary key (ressource_id));


insert into ressource values (1, 'video' ,'2022/05/21', 'Mickaël', '\video\video1.mp4');
insert into ressource values (2, 'image' ,'2022/10/01', 'Sandy', '\img\iùage1.png');
insert into ressource values (3, 'quizz' ,'2022/06/14', 'Yann', '\quizz\wooclap.wpl');
insert into ressource values (4, 'video' ,'2022/04/12', 'Alexandre', '\video\video2.mp4');
insert into ressource values (5, 'texte' ,'2022/04/15', 'Flemming', '\txt\texte1.txt');
insert into ressource values (6, 'document' ,'2022/02/23', 'Mickaël', '\doc\word.pdf');
insert into ressource values (7, 'texte' ,'2022/08/04', 'Mickaël', '\txt\texte2.txt');
insert into ressource values (8, 'video' ,'2022/01/29', 'Alexandre', '\video\video3.mp4');

select * from ressource;

create table resofentry
(entry_id int(8),
ressource_id int(8),
constraint c3 primary key (entry_id,ressource_id),
constraint c4 foreign key (entry_id) references entry(entry_id),
constraint c5 foreign key (ressource_id) references ressource(ressource_id));


insert into resofentry values (1,2);
insert into resofentry values (1,3);
insert into resofentry values (1,4);
insert into resofentry values (2,1);
insert into resofentry values (2,7);
insert into resofentry values (3,2);
insert into resofentry values (4,3);
insert into resofentry values (4,1);
insert into resofentry values (4,6);
insert into resofentry values (5,8);
insert into resofentry values (5,2);

select * from resofentry;


create table users
(user_id int(8),
name VARCHAR(45),
lastname VARCHAR(45),
pseudo VARCHAR(45),
email VARCHAR(50),
password VARCHAR(255),
roles VARCHAR(9),
created_at TIMESTAMP,
constraint c6 primary key (user_id));

insert into users values (1, 'admin', 'admin', 'admin', 'admin@admin.fr', '','ADMIN', now());
insert into users values (2, 'superuser', 'superuser', 'superuser', 'superuser@superuser.fr', '','SUPERUSER', now());
insert into users values (3, 'user', 'user', 'user', 'user@user.fr', '','USER', now());
insert into users values (4, 'user2', 'user2', 'user2', 'user2@user.fr', '','USER', now());

select * from users;


create table resofuser
(roles VARCHAR(9),
ressource_id int(8),
acces BOOLEAN,
constraint c7 primary key (roles,ressource_id),
constraint c8 foreign key (roles) references users(roles),
constraint c9 foreign key (ressource_id) references ressource(ressource_id));


insert into resofuser values ('ADMIN', 1, true );
insert into resofuser values ('ADMIN', 2, true );
insert into resofuser values ('ADMIN', 3, true );
insert into resofuser values ('ADMIN', 4, true );
insert into resofuser values ('ADMIN', 5, true );
insert into resofuser values ('ADMIN', 6, true );
insert into resofuser values ('ADMIN', 7, true );
insert into resofuser values ('ADMIN', 8, true );
insert into resofuser values ('SUPERUSER', 3, true );

select * from resofuser;


create table comment
(comment_id INT(8),
content VARCHAR(255),
user_id int(8),
entry_id int(8),
constraint c10 primary key (comment_id),
constraint c11 foreign key (user_id) references users(user_id),
constraint c12 foreign key (entry_id) references entry(entry_id));


insert into comment values (1, 'Trés bon post !', 1 , 1);
insert into comment values (2, 'Pas compris !', 1 , 2);
insert into comment values (3, 'Un article des plus enrichissant !!', 2 , 3);
insert into comment values (4, '2eme Trés bon post !', 1 , 1);
insert into comment values (5, 'Super', 2 , 2);
insert into comment values (6, 'GG', 3 , 5);
insert into comment values (7, 'On adore', 4 , 4);

select * from comment;


create table rate
(user_id int(8),
entry_id int(8),
rate int(5),
like BOOLEAN,
constraint c13 primary key (user_id,entry_id),
constraint c14 foreign key (user_id) references users(user_id),
constraint c15 foreign key (entry_id) references entry(entry_id));

insert into rate values (1,1,5, true);
insert into rate values (1,2,3, true);
insert into rate values (1,3,0, FALSE);
insert into rate values (1,5,1, true);
insert into rate values (2,1,5, FALSE);
insert into rate values (2,3,2, true);
insert into rate values (3,1,5, true);
insert into rate values (4,1,4, true);
insert into rate values (4,2,3, FALSE);

select * from rate;
