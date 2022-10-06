create table tb_board_set (
	uid int(11) PRIMARY KEY auto_increment,
	table_id varchar(30),
	title varchar(50),
	write_chk varchar(10),
	read_chk varchar(10),
	reply_chk varchar(10),
	coment_chk varchar(10),
	upload_chk varchar(5),
	download_chk varchar(5),
	list_mod varchar(30),
	reg_date int(11)
);



create table tb_board_list (
	uid int(11) PRIMARY KEY auto_increment,
	userid varchar(30),
	table_id varchar(30),
	title varchar(255),
	name varchar(30),
	email varchar(100),
	passwd varchar(30),
	pwd_chk char(1),
	notice_chk char(1),
	ment text,
	data01 varchar(255),
	data02 varchar(255),
	data03 varchar(255),
	data04 varchar(255),
	data05 varchar(255),
	hit int(11),
	ip varchar(50),
	userfile01 varchar(100),
	realfile01 varchar(255),
	userfile02 varchar(100),
	realfile02 varchar(255),
	userfile03 varchar(100),
	realfile03 varchar(255),
	userfile04 varchar(100),
	realfile04 varchar(255),
	userfile05 varchar(100),
	realfile05 varchar(255),
	reg_date int(11)
);



create table tb_board_coment (
	uid int(11) PRIMARY KEY auto_increment,
	pid int(11),
	userid varchar(30),
	name varchar(30),
	pwd varchar(30),
	coment text,
	ip varchar(30),
	reg_date int(11)
);



create table tb_board_reply (
	uid int(11) PRIMARY KEY auto_increment,
	upid int(11),
	userid varchar(30),
	title varchar(255),
	name varchar(30),
	email varchar(100),
	passwd varchar(30),
	ment text,
	hit int(11),
	ip varchar(50),
	reg_date int(11)
);