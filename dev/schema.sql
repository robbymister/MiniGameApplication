drop table appuser cascade;

create table appuser (
	userid varchar(50) primary key UNIQUE,
	password varchar(50),
	email varchar(50),
	dateOfBirth varchar(50),
	gender varchar(50),
	frogsWins integer,
	guessWins integer,
	rpsWins integer
);

insert into appuser values('auser', 'apassword', 'r', 'r', 'Male', 0, 0, 0);

