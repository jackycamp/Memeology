CREATE TABLE USERS (
id int not null auto_increment,
email varchar(255),
password varchar(255),
first_name varchar(255),
last_name varchar(255),
primary key (id)
);

CREATE TABLE DESCRIPTIONS (
id int not null auto_increment,
description varchar(255),
primary key (id)
);

CREATE TABLE MEMES (
id int not null auto_increment,
name varchar(255),
user_id not null int,
path_to_file varchar(255),
description_id int,
background_information varchar(255),
origin varchar(255),
approved varchar(255),
created_at datetime,
updated_at datetime,
primary key (id),
foreign key (user_id) references USERS(id),
foreign key (description_id) references DESCRIPTIONS(id)
);

CREATE TABLE VOTES (
id int not null auto_increment,
user_id not null int,
meme_id not null int,
positive_or_negative boolean,
date_posted datetime,
primary key (id),
foreign key (user_id) references USERS(id),
foreign key (meme_id) references MEMES(id)
);

CREATE TABLE FLAGS (
id int not null auto_increment,
user_id not null int,
meme_id not null int,
admin_decision boolean,
primary key (id),
foreign key (user_id) references USERS(id),
foreign key (meme_id) references MEMES(id)
);

CREATE TABLE SIZES (
id int not null auto_increment,
description varchar(255),
primary key (id)
);

CREATE TABLE ITEMS (
id int not null auto_increment,
description varchar(255),
size_id int,
price int,
primary key (id),
foreign key (size_id) references SIZES(id)
);

primary key (id),
foreign key (meme_id) references MEMES(id)
);

CREATE TABLE USER_SHOPPING_CART (
id int not null auto_increment,
user_id not null int,
mechandise_id not null int
primary key (id),
foreign key (user_id) references USERS(id),
foreign key (item_id) references ITEMS(id)
);

CREATE TABLE USER_SHOPPING_HISTORY (
id int not null auto_increment,
user_id not null int,
mechandise_id not null int,
date_time datetime,
primary key (id),
foreign key (user_id) references USERS(id),
foreign key (item_id) references ITEMS(id)
);

