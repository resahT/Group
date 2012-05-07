DROP TABLE IF EXISTS book;
DROP TABLE IF EXISTS house;
DROP TABLE IF EXISTS basicUser;
DROP TABLE IF EXISTS item;

CREATE TABLE basicUser
(bUserid		varchar(15)		NOT NULL UNIQUE,
 fname			varchar(20)		NOT NULL,
 lname			varchar(20)		NOT NULL,
 email			varchar(30)		NOT NULL,
 phone			varchar(10)		NOT NULL,
 dateofRegistry	date			NOT NULL,
 personalinfo	varchar(50),
 PRIMARY KEY(bUserid));

CREATE TABLE item
(itemid			int				NOT NULL AUTO_INCREMENT,
 category		varchar(15)		NOT NULL,
 uploadTime		timestamp		NOT NULL,
 saleType		varchar(15)		NOT NULL,
 image			blob,
 PRIMARY KEY(itemid));

CREATE TABLE book
(itemid			int				NOT NULL AUTO_INCREMENT,
 bUserid		varchar(15)		NOT NULL,
 title			varchar(50)		NOT NULL,
 author			varchar(50)		NOT NULL,
 publisher		varchar(20),
 pubDate		date,
 edition		varchar(20)		NOT NULL,
 subarea		varchar(15)		NOT NULL,
 cond			varchar(15)		NOT NULL,
 price			decimal(10,2)	NOT NULL,
 PRIMARY KEY (itemid, bUserid),
 FOREIGN KEY (itemid) references item(itemid) ON UPDATE CASCADE ON DELETE CASCADE,
 FOREIGN KEY (bUserid) references basicUser(bUserid) ON UPDATE CASCADE ON DELETE CASCADE);

CREATE TABLE house
(itemid			int				NOT NULL AUTO_INCREMENT,
 bUserid		varchar(15)		NOT NULL,
 bedrooms		int,
 bathrooms		int,
 facilities 	varchar(15)		NOT NULL,
 price			decimal(10,2)	NOT NULL,
 locatedNear	varchar(30)		NOT NULL,	
 PRIMARY KEY (itemid, bUserid),
 FOREIGN KEY (itemid) references item(itemid) ON UPDATE CASCADE ON DELETE CASCADE,
 FOREIGN KEY (bUSerid) references basicUser(bUserid) ON UPDATE CASCADE ON DELETE CASCADE);