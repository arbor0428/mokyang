drop table ks_programPeriod;
create table ks_programPeriod (
	uid int(11) PRIMARY KEY auto_increment,
	year varchar(5),
	season varchar(50),
	cade01 varchar(50),
	title varchar(100),
	aDate01 varchar(30),
	aTime01 int(11),
	aDate02 varchar(30),
	aTime02 int(11),
	oDate01 varchar(30),
	oTime01 int(11),
	oDate02 varchar(30),
	oTime02 int(11),
	eDate01 varchar(30),
	eTime01 int(11),
	eDate02 varchar(30),
	eTime02 int(11),
	cDate01 varchar(30),
	cTime01 int(11),
	rDate varchar(50),
	rTime int(11)
);

alter table ks_programPeriod add column aTime02 int(11) after title;
alter table ks_programPeriod add column aDate02 varchar(30) after title;
alter table ks_programPeriod add column aTime01 int(11) after title;
alter table ks_programPeriod add column aDate01 varchar(30) after title;