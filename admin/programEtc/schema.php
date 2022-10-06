drop table ks_programEtc;
create table ks_programEtc (
	uid int(11) PRIMARY KEY auto_increment,
	userid varchar(50),
	name varchar(50),
	userNum varchar(50),
	tutorID varchar(50),
	tutor varchar(50),
	tutorNum varchar(50),
	title varchar(50),
	programAmt int(11),
	eDate01 varchar(30),
	eTime01 int(11),
	eDate02 varchar(30),
	eTime02 int(11),
	memo text,
	payMode varchar(30),
	payDate varchar(50),
	payTime int(11),
	payAmt int(11),
	saleAmt int(11),
	billNum varchar(50),
	cashBill varchar(30),
	payOk varchar(50),
	paynum varchar(50),
	cardName varchar(50),
	bankname varchar(50),
	depositor varchar(50),
	account varchar(50),
	va_date varchar(50),
	cash_yn varchar(50),
	cash_authno varchar(50),
	vaDate varchar(30),
	vaTime int(11),
	userip varchar(50),
	rDate varchar(50),
	rTime int(11)
);