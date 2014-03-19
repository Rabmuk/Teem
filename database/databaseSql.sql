CREATE TABLE users
	(
	user_id INT  NOT NULL,
	email VARCHAR(0)  NOT NULL,
	password VARCHAR(0)  NOT NULL,
	salt VARCHAR(0)  NOT NULL,
	PRIMARY KEY (user_id)
	);


CREATE TABLE groups
	(
	group_id INT  NOT NULL,
	id_owner INT  NOT NULL,
	name VARCHAR(0)  NOT NULL,
	PRIMARY KEY (group_id),
	FOREIGN KEY (id_owner) REFERENCES users (user_id)   
	);


CREATE TABLE groupMembers
	(
	id_group INT  NOT NULL,
	id_user INT  NOT NULL,
	FOREIGN KEY (id_user) REFERENCES users (user_id)   ,
	FOREIGN KEY (id_group) REFERENCES groups (group_id)   
	);


CREATE TABLE freeTime
	(
	id_user INT  NOT NULL,
	dayOfWeek INT  NOT NULL,
	startTime TIME  NOT NULL,
	endTime TIME  NOT NULL,
	FOREIGN KEY (id_user) REFERENCES users (user_id)   
	);


CREATE TABLE groupMeeting
	(
	meeting_id INT  NOT NULL,
	id_group INT  NOT NULL,
	name VARCHAR(0)  NOT NULL,
	startTime TIME  NOT NULL,
	endTime TIME  NOT NULL,
	PRIMARY KEY (meeting_id),
	FOREIGN KEY (id_group) REFERENCES groups (group_id)   
	);


CREATE TABLE agendaItems
	(
	item_id INT  NOT NULL,
	id_meeting INT  NOT NULL,
	id_user INT  NOT NULL,
	description VARCHAR(0)  ,
	allotedTime INT  ,
	PRIMARY KEY (item_id),
	FOREIGN KEY (id_meeting) REFERENCES groupMeeting (meeting_id)   ,
	FOREIGN KEY (id_user) REFERENCES users (user_id)   
	);


