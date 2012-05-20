DROP TABLE IF EXISTS book;
DROP TABLE IF EXISTS house;
DROP TABLE IF EXISTS upload;
DROP TABLE IF EXISTS bids;
DROP TABLE IF EXISTS buy;
DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS basicUser;

CREATE TABLE basicUser
(bUserid		int         NOT NULL    AUTO_INCREMENT,
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
(itemid			int				NOT NULL	AUTO_INCREMENT,
 category		varchar(15)		NOT NULL,
 keyword		varchar(30)		NOT NULL,
 rating			int				NOT NULL,
 image			varchar(50),  
 PRIMARY KEY(itemid));

INSERT INTO item VALUES ('120','house','mini-cluster','2','');
INSERT INTO item VALUES ('121','house','single room','3','');
INSERT INTO item VALUES ('122','house','room for rent','1','');
INSERT INTO item VALUES ('123','book','Circuits','2','');
INSERT INTO item VALUES ('124','book','Signals','4','');
INSERT INTO item VALUES ('125','house','room-bathroom','5','');
INSERT INTO item VALUES ('126','book','robotics','3','');
INSERT INTO item VALUES ('127','book','Circuits','4','');
INSERT INTO item VALUES ('128','book','DBMS','5','');
INSERT INTO item VALUES ('129','book','Beginner physics','3','');
INSERT INTO item VALUES ('130','house','gaza','1','');
INSERT INTO item VALUES ('131','book','quantum physics','2','');
INSERT INTO item VALUES ('132','house','gaza','3','');
INSERT INTO item VALUES ('133','house','in mona','5','');
INSERT INTO item VALUES ('134','book','robotics','2','');
INSERT INTO item VALUES ('135','book','medical physics','2','');
INSERT INTO item VALUES ('136','book','medical physics','5','');
INSERT INTO item VALUES ('137','book','JAVA','1','');
INSERT INTO item VALUES ('138','book','Android','3','');
INSERT INTO item VALUES ('139','book','Algorithms','2','');
INSERT INTO item VALUES ('140','book','Haskell','2','');
INSERT INTO item VALUES ('141','book','Embedded C','4','');
INSERT INTO item VALUES ('142','house','4 rooms','4','');
INSERT INTO item VALUES ('143','house','3 rooms','1','');
INSERT INTO item VALUES ('144','book','Virtual Machines','3','');
INSERT INTO item VALUES ('145','book','Physics','2','');
INSERT INTO item VALUES ('146','house','mini-cluster','4','');
INSERT INTO item VALUES ('147','house','single room','2','');
INSERT INTO item VALUES ('148','house','mona','5','');
INSERT INTO item VALUES ('149','house','room-bathroom','3','');
INSERT INTO item VALUES ('150','house','single room','2','');
INSERT INTO item VALUES ('151','house','2 rooms','1','');
INSERT INTO item VALUES ('152','house','3 rooms','4','');
INSERT INTO item VALUES ('153','book','Electronics','3','');
INSERT INTO item VALUES ('154','book','Networking','2','');
INSERT INTO item VALUES ('155','house','mini-cluster','5','');
  
CREATE TABLE book
(itemid			int				NOT NULL 	AUTO_INCREMENT,
 title			varchar(50)		NOT NULL,
 author			varchar(50)		NOT NULL,
 publisher		varchar(50)		NOT NULL,
 pubYear		int				NOT NULL,
 edition		varchar(20)		NOT NULL,
 subarea		varchar(20)		NOT NULL,
 cond			varchar(15)		NOT NULL,
 description	varchar(50)		NOT NULL,
 PRIMARY KEY (itemid),
 FOREIGN KEY (itemid) references item(itemid) ON UPDATE CASCADE ON DELETE CASCADE);

INSERT INTO book VALUES ('123','Circuit Analysis','P. Hall J. Button','University Press','2001','4th','Electronics','Good','Circuit analysis');
INSERT INTO book VALUES ('124','Signals and Systems','L. Hamilton','IEEE Org.','2005','2ND','Electronics','Barely Used',' the best book for signal analysis');
INSERT INTO book VALUES ('126','Embedded Robotics','Thomas Braunal','University of Western Australia','2006','2nd','Electronics','Lady Used','Mobile Robot design and application');
INSERT INTO book VALUES ('127','Engineering Circuit Analysis','Troy Martin','Springer','2010','1st','Electronics','Unused','Nodal and mesh circuits');
INSERT INTO book VALUES ('128','Database System and Concepts','T. Guy','Book Publisher','1999','1st','Computer Science','Good','Database Management Systems');
INSERT INTO book VALUES ('129','College Physics','M. Whitmarsh','McLaren','2007','3rd','Physics','Poor','best introductory college physics');
INSERT INTO book VALUES ('131','Quantum Physics','A. Einstein','Motherland','1975','1st','Physics','Poor','The first of its kind');
INSERT INTO book VALUES ('134','Microcontrollers and Robotics','L. Clarke','UWI','2012','2nd','Electronics','Good','AVR Microcontroller and robots');
INSERT INTO book VALUES ('135','Medical Physics','P. Keven','UCHOS','2009','5th','Physics','Barely Used','Medical Physics');
INSERT INTO book VALUES ('136','Medical Physics','P. Keven H. Osmo','Hait','2012','6th','Physics','Unused','Medical physics 101');
INSERT INTO book VALUES ('137','Learn Java in 20 Days','T. Beckett','University Press','2004','2nd','Computer Science','Poor','The Basics of Java programming'); 
INSERT INTO book VALUES ('138','Android Development','S .Jobs','Google Publish','2010','1st','Computer Science','Good','Droid Development');
INSERT INTO book VALUES ('139','Ez Algorithms','B. Gates','Bavarian MW','2002','3rd','Computer Science','Barely Used','Algorithms for 1st timers');
INSERT INTO book VALUES ('140','Haskell','M. Gates B. Gates','Zynga','1997','2nd','Computer Science','Poor','Haskell language');
INSERT INTO book VALUES ('141','Beginning Embedded C','E. Mann','ATMEL Publishers','2006','4th','Electronics','Good','Embedded C for beginners');
INSERT INTO book VALUES ('144','Virtual Machine Core Applications','B. Matel','Oracle','2005','6th','Computer Science','Good','all about Virtual Machine');
INSERT INTO book VALUES ('145','The Physics Bible','C. Edwards','IEEE Org.','1995','3rd','Physics','Poor','laws governing Physics');
INSERT INTO book VALUES ('153','Electronics Bible','F. Copeland','IEEE Org.','1998','2nd','Electronics','Barely Used','laws governing Electronics');
INSERT INTO book VALUES ('154','Bible of Networking','P. Pentagon','Cisco','2011','8th','Computer Science','Good','Networking principles and concepts');

CREATE TABLE house
(itemid			int				NOT NULL 	AUTO_INCREMENT,
 bedrooms		int				NOT NULL,
 bathrooms		int				NOT NULL,
 facilities 	varchar(15)		NOT NULL,
 locatedNear	varchar(20)		NOT NULL,
 description	varchar(50), 
 PRIMARY KEY (itemid),
 FOREIGN KEY (itemid) references item(itemid) ON UPDATE CASCADE ON DELETE CASCADE);

INSERT INTO house VALUES ('120','3','2','shared','Campus Flats','');
INSERT INTO house VALUES ('121','1','1','not shared','Barbican','');
INSERT INTO house VALUES ('122','1','1','not shared','Wellington','');
INSERT INTO house VALUES ('125','1','1','not shared','Mona','');
INSERT INTO house VALUES ('130','3','3','not shared','Portmore','');
INSERT INTO house VALUES ('132','4','2','shared','Portmore','');
INSERT INTO house VALUES ('133','2','2','not shared','Mona','');
INSERT INTO house VALUES ('142','4','4','not shared','Barbican','');
INSERT INTO house VALUES ('143','3','2','shared','Papine','');
INSERT INTO house VALUES ('146','5','3','shared','Campus Flats','');
INSERT INTO house VALUES ('147','1','1','not shared','Campus Flats','');
INSERT INTO house VALUES ('148','6','6','not shared','Mona','');
INSERT INTO house VALUES ('149','4','3','shared','Wellington','');
INSERT INTO house VALUES ('150','1','1','not shared','Garden Boulevard','');
INSERT INTO house VALUES ('151','2','1','shared','Hope Pastures','');
INSERT INTO house VALUES ('152','3','2','shared','Hope Pastures','');
INSERT INTO house VALUES ('155','5','3','shared','Garden Boulevard','');
 
CREATE TABLE upload
(itemid			int				NOT NULL 	AUTO_INCREMENT,
 bUserid		varchar(15)		NOT NULL,
 saleType		varchar(15)		NOT NULL,
 uploadDate		date			NOT NULL,
 uploadTime		timestamp		NOT NULL,
 PRIMARY KEY(itemid),
 FOREIGN KEY(itemid) REFERENCES item(itemid) ON UPDATE CASCADE ON DELETE CASCADE,
 FOREIGN KEY(bUserid) REFERENCES basicUser(bUserid) ON UPDATE CASCADE ON DELETE CASCADE);
 
 INSERT INTO upload VALUES('120','2','bidding','2012/06/01','09:45:30');
 INSERT INTO upload VALUES('121','1','bidding','2012/06/01','10:12:27');
 INSERT INTO upload VALUES('122','23','buy now','2012/06/01','12:38:12');
 INSERT INTO upload VALUES('123','21','buy now','2012/06/01','12:45:15');
 INSERT INTO upload VALUES('124','12','bidding','2012/06/01','13:12:11');
 INSERT INTO upload VALUES('125','5','bidding','2012/06/01','13:20:17');
 INSERT INTO upload VALUES('126','10','buy now','2012/06/01','13:32:15');
 INSERT INTO upload VALUES('127','17','bidding','2012/06/01','16:15:23');
 INSERT INTO upload VALUES('128','5','buy now','2012/06/01','17:50:45');
 INSERT INTO upload VALUES('129','3','buy now','2012/06/02','01:20:50');
 INSERT INTO upload VALUES('130','20','bidding','2012/06/03','07:23:22');
 INSERT INTO upload VALUES('131','3','buy now','2012/06/03','08:16:12');
 INSERT INTO upload VALUES('132','20','bidding','2012/06/04','09:10:00');
 INSERT INTO upload VALUES('133','15','bidding','2012/06/04','07:23:22');
 INSERT INTO upload VALUES('134','20','bidding','2012/06/04','07:23:22');
 INSERT INTO upload VALUES('135','1','bidding','2012/06/04','07:23:22');
 INSERT INTO upload VALUES('136','2','buy now','2012/06/04','07:23:22');
 INSERT INTO upload VALUES('137','5','buy now','2012/06/05','07:23:22');
 INSERT INTO upload VALUES('138','15','bidding','2012/06/05','07:23:22');
 INSERT INTO upload VALUES('139','21','bidding','2012/06/07','07:23:22');
 INSERT INTO upload VALUES('140','12','buy now','2012/06/07','07:23:22');
 INSERT INTO upload VALUES('141','12','buy now','2012/06/07','07:23:22');
 INSERT INTO upload VALUES('142','8','buy now','2012/06/08','07:23:22');
 INSERT INTO upload VALUES('143','17','bidding','2012/06/09','07:23:22');
 INSERT INTO upload VALUES('144','20','bidding','2012/06/10','07:23:22');
 INSERT INTO upload VALUES('145','23','bidding','2012/06/11','07:23:22');
 INSERT INTO upload VALUES('146','21','buy now','2012/06/12','07:23:22');
 INSERT INTO upload VALUES('147','12','buy now','2012/06/13','07:23:22');
 INSERT INTO upload VALUES('148','1','buy now','2012/06/13','07:23:22');
 INSERT INTO upload VALUES('149','3','bidding','2012/06/13','07:23:22');
 INSERT INTO upload VALUES('150','8','bidding','2012/06/13','07:23:22');
 INSERT INTO upload VALUES('151','4','bidding','2012/06/13','07:23:22');
 INSERT INTO upload VALUES('152','4','bidding','2012/06/13','07:23:22');
 INSERT INTO upload VALUES('153','15','bidding','2012/06/13','07:23:22');
 INSERT INTO upload VALUES('154','12','bidding','2012/06/14','07:23:22');
 INSERT INTO upload VALUES('155','17','buy now','2012/06/14','07:23:22');
 
CREATE TABLE bids
 (bidno			int				NOT NULL 	AUTO_INCREMENT,
  itemid		int				NOT NULL,
  bUserid		varchar(15)		NOT NULL,
  bidDate		date			NOT NULL,
  bidTime		timestamp		NOT NULL,
  bidAmount     decimal(10,2)	NOT NULL, 
  PRIMARY KEY(bidno),
  FOREIGN KEY (itemid) references item(itemid) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (bUserid) references basicUser(bUserid) ON UPDATE CASCADE ON DELETE CASCADE);

INSERT INTO bids VALUES('17','154','9','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('18','152','1','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('19','145','16','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('20','120','4','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('21','121','15','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('22','132','12','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('23','135','19','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('24','130','2','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('25','135','2','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('26','121','14','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('27','149','5','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('28','153','7','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('29','153','8','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('30','139','11','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('31','138','13','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('32','124','23','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('33','145','22','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('34','124','6','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('35','152','10','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('36','124','18','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('37','138','20','2012/06/14','07:23:22','00.00');
INSERT INTO bids VALUES('38','135','18','2012/06/14','07:23:22','00.00');  

  
CREATE TABLE buy
(purchaseid		int				NOT NULL 	AUTO_INCREMENT,
 itemid			int				NOT NULL,
 bUserid		varchar(15)		NOT NULL,
 itemPrice		decimal(10,2)	NOT NULL,
 buyDate		date			NOT NULL,
 buyTime		timestamp		NOT NULL,
 PRIMARY KEY(purchaseid),
 FOREIGN KEY(itemid) REFERENCES item(itemid) ON UPDATE CASCADE ON DELETE CASCADE,
 FOREIGN KEY(bUserid) REFERENCES basicUser(bUserid) ON UPDATE CASCADE ON DELETE CASCADE);
 
INSERT INTO buy VALUES('1001','142','9','00.00','2012/06/14','07:23:22');
INSERT INTO buy VALUES('1002','137','15','00.00','2012/06/14','07:23:22');
INSERT INTO buy VALUES('1003','122','18','00.00','2012/06/14','07:23:22');
INSERT INTO buy VALUES('1004','123','20','00.00','2012/06/14','07:23:22');
INSERT INTO buy VALUES('1006','129','17','00.00','2012/06/14','07:23:22');
INSERT INTO buy VALUES('1007','131','16','00.00','2012/06/14','07:23:22');
INSERT INTO buy VALUES('1008','140','15','00.00','2012/06/14','07:23:22');
INSERT INTO buy VALUES('1009','141','22','00.00','2012/06/14','07:23:22');
INSERT INTO buy VALUES('1010','128','11','00.00','2012/06/14','07:23:22');