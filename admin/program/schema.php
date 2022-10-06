drop table ks_program;
create table ks_program (
	uid int(11) PRIMARY KEY auto_increment,
	online char(1) default '1',
	package char(1) default '',
	pid int(11),
	pTitle varchar(50),
	year varchar(5),
	season varchar(50),
	cade01 varchar(50),
	period varchar(50),
	mTarget varchar(50),
	mTargetEtc varchar(50),
	periodID int(11),
	room varchar(50),
	title varchar(100),
	fitnessType varchar(50),
	tutorID int(11),
	tutor varchar(50),
	tutorNum varchar(50),
	maxNum varchar(30),
	amt varchar(30),
	oneAmt varchar(30),
	eduNum varchar(30),
	sEduHour varchar(5),
	sEduMin varchar(5),
	eEduHour varchar(5),
	eEduMin varchar(5),
	yoilList varchar(30),
	ment01 text,	
	ment02 text,
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
	upfile01 varchar(100),
	realfile01 varchar(100),
	rDate varchar(50),
	rTime int(11)
);

drop table ks_programTime;
create table ks_programTime (
	uid int(11) PRIMARY KEY auto_increment,
	pid int(11),
	yoil varchar(5),
	pNum varchar(30),
	room varchar(50),
	sEduHour varchar(5),
	sEduMin varchar(5),
	eEduHour varchar(5),
	eEduMin varchar(5),
	sOkHour varchar(5),
	sOkMin varchar(5),
	eOkHour varchar(5),
	eOkMin varchar(5),
	rDate varchar(50),
	rTime int(11)
);


alter table ks_program add column aTime02 int(11) after ment02;
alter table ks_program add column aDate02 varchar(30) after ment02;
alter table ks_program add column aTime01 int(11) after ment02;
alter table ks_program add column aDate01 varchar(30) after ment02;