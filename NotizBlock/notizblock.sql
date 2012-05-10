DROP TABLE IF EXISTS book;
DROP TABLE IF EXISTS house;
DROP TABLE IF EXISTS bids;
DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS basicUser;

CREATE TABLE basicUser
(bUserid		varchar(15)		NOT NULL UNIQUE,
 fname			varchar(50)		NOT NULL,
 lname			varchar(50)		NOT NULL,
 username		varchar(50)		NOT NULL,
 password		varchar(15)		NOT NULL,
 dept			varchar(50)		NOT NULL,
 email			varchar(30)		NOT NULL,
 phone			varchar(10)		NOT NULL,
 dateofRegistry	date			NOT NULL,
 personalinfo	varchar(50),
 uimage			blob,
 PRIMARY KEY(bUserid));
 
INSERT INTO basicUser VALUES ('1', 'Tara', 'Brown', 'Tbee', 'resah', 'computer science', 'tarabrown@hotmail.com', '5557788', '2012/05/02', 'i am a girl', '' );
INSERT INTO basicUser VALUES ('2', 'Kevon', 'Campbell', 'vonex', 'bellev', 'physics', 'kev_bell@hotmail.com', '4448990', '2012/05/03', 'got more physics books than i can handle','');
INSERT INTO basicUser VALUES ('3', 'Latoya', 'Johnson', 'toyaJay', 'lasohn', 'computer science', 'spence@gmail.com', '5660992', '2012/05/03', 'lots of links to homes around kng', '');
INSERT INTO basicUser VALUES ('4', 'Adeline', 'Reynolds', 'addeDon', 'yellcup', 'computer science', 'adReynolds@hotmail.com', '3009876', '2012/05/03', 'Hey, i have a couple books here', '');
INSERT INTO basicUser VALUES ('5', 'Michael', 'Thomas', 'david', 'tomcat05', 'computer science', 'davidtomas@hotmail.com', '8579087', '2012/05/03', 'stricly apartments in kng', '');
INSERT INTO basicUser VALUES ('6', 'Jheanell', 'McPherson', 'jaymac', 'licia', 'computer science', 'jhinnymac@gmail.com', '4437928', '2012/05/02', 'hello world, its me!', '');
INSERT INTO basicUser VALUES ('7', 'Andrew', 'Stoddart', 'astud', 'a00a0', 'computer science', 'andrewStud@gmail.com', '5677893', '2012/05/04', 'lots of books', '');
INSERT INTO basicUser VALUES ('8', 'Vaun-Pierre', 'Wynter', 'VW', 'pierre9', 'computer science', 'levaunn@gmail.com', '7898393', '2012/05/04', 'nothing to say', '');
INSERT INTO basicUser VALUES ('9', 'Adrian', 'McPherson', 'apMac', 'sonher', 'physics', 'adrian_p@hotmail.com', '5817996', '2012/05/05', 'got tons of physics books', '');
INSERT INTO basicUser VALUES ('10', 'Michelle', 'Scarlette', 'michi', 'letter', 'physics', 'michiboo@gmail.com', '6008971', '2012/05/05', 'hey guys :)', '');
INSERT INTO basicUser VALUES ('11', 'Saeed', 'Thomas', '0j0', 'pasta', 'physics', 'ojothomas@hotmail.com', '7981234', '2012/05/05', 'got some apartment links in barbican', '');
INSERT INTO basicUser VALUES ('12', 'Paulette', 'Greene', 'pablo-etta', 'col0r2', 'computer science', 'paulette_a@yahoo.com', '9830293', '2012/05/05', 'personal info', '');
INSERT INTO basicUser VALUES ('13', 'Antoine', 'Garnette', 'leAntonio', 'seed80', 'physics', 'toinette@yahoo.com', '8575922', '2012/05/06', 'personal info', '');
INSERT INTO basicUser VALUES ('14', 'Kimone', 'Freeman', 'KimmyFree', 'elen7002', 'computer science', 'freemon0027@gmail.com', '4883567', '2012/05/06', 'personal info', '');
INSERT INTO basicUser VALUES('15', 'Christopher', 'Jaggon', 'Jragon', 'djragon00', 'computer science', 'chris_jraggon@gmail.com', '3956609' ,'2012/05/06' ,'personal info' , '');
INSERT INTO basicUser VALUES('16', 'Ezra', 'Mugisa', 'Ezra', 'yoda890', 'computer science', 'asigum_arze@gmail.com', '8999923' ,'2012/05/06' ,'H.O.D' , '');
INSERT INTO basicUser VALUES('17', 'Rashelle', 'Muir', 'RashiBoo', 'stephbee', 'physics', 'rashellerash@yahoo.com', '8997078' ,'2012/05/06' ,'1st year physics' , '');
INSERT INTO basicUser VALUES('18', 'Shane', 'Edwards', 'shaneStarr', 'temp09', 'physics', 'shanestarr@gmaill.com', '4337867' ,'2012/05/07' ,'personal info' , '');
INSERT INTO basicUser VALUES('19', 'Deandra', 'Bolton', 'chixx', '1trix89', 'computer science', 'chixxbits@hotmail.com', '7836623' ,'2012/05/07' ,'personal info' , '');
INSERT INTO basicUser VALUES('20', 'Adijah', 'Palmer', 'addiDaddy', 'vybzkartel', 'physics', 'adiAdiDaddy@yahoo.com', '9803957' ,'2012/05/07' ,'personal info' , '');
INSERT INTO basicUser VALUES('21', 'Kevon', 'Bryan', 'kevyK', 'k8t1', 'computer science', 'kevykb@hotmail.com', '7883895' ,'2012/05/07' ,'links to acqueduct gates' , '');
INSERT INTO basicUser VALUES('22', 'Roje', 'McPherson', 'rMac', 'steph89R', 'computer science', 'gangstaKing-18@hotmail.com', '5590829', '2012/05/07' ,'personal info' ,'');
INSERT INTO basicUser VALUES('23', 'Nicolette', 'Bisoon', 'Nickyboo', 'b1s00n', 'computer science', 'nicbsoon@gmail.com', '2903957' ,'2012/05/07' ,'hey guys!' , '');


CREATE TABLE item
(itemid			int			NOT NULL AUTO_INCREMENT,
 bUserid		varchar(15)		NOT NULL,
 category		varchar(15)		NOT NULL,
 uploadTime		timestamp		NOT NULL,
 saleType		varchar(15)		NOT NULL,
 keyword		varchar(20)		NOT NULL,
 image			varchar(50), /* use path to image than save the image */  
 PRIMARY KEY(itemid, bUserid),
 FOREIGN KEY(bUserid) references basicUser(bUserid) ON UPDATE CASCADE ON DELETE CASCADE);
 

 
CREATE TABLE book
(itemid			int				NOT NULL AUTO_INCREMENT,
 title			varchar(50)		NOT NULL,
 author			varchar(50)		NOT NULL,
 publisher		varchar(20),
 pubDate		date,
 edition		varchar(20)		NOT NULL,
 subarea		varchar(15)		NOT NULL,
 cond			varchar(15)		NOT NULL,
 saleType               varchar(10)     NOT NULL,
 price			decimal(10,2)	NOT NULL,
 description	varchar(30)		NOT NULL,
 PRIMARY KEY (itemid),
 FOREIGN KEY (itemid) references item(itemid) ON UPDATE CASCADE ON DELETE CASCADE);

 

 

CREATE TABLE house
(itemid			int				NOT NULL AUTO_INCREMENT,
 bedrooms		int,
 bathrooms		int,
 facilities 	varchar(15)		NOT NULL,
 price			decimal(10,2)	NOT NULL,
 locatedNear	varchar(20)		NOT NULL,
 description	varchar(30)		NOT NULL, 
 PRIMARY KEY (itemid),
 FOREIGN KEY (itemid) references item(itemid) ON UPDATE CASCADE ON DELETE CASCADE);
 
 

 
 CREATE TABLE bids
 (itemid		int				NOT NULL AUTO_INCREMENT,
  bUserid		varchar(15)		NOT NULL,
  bidDate		date,
  bidTime		timestamp,
  bidAmount             int,
  PRIMARY KEY(itemid, bUserid),
  FOREIGN KEY (itemid) references item(itemid) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (bUserid) references basicUser(bUserid) ON UPDATE CASCADE ON DELETE CASCADE);

 
