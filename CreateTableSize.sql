CREATE TABLE  `testWineStyle`.`Size` (
`Name` VARCHAR( 3 ) NOT NULL ,
`Width` SMALLINT UNSIGNED NOT NULL ,
`Height` SMALLINT UNSIGNED NOT NULL ,
PRIMARY KEY (  `Name` )
) ENGINE = MYISAM ;

INSERT INTO Size (Name, Width, Height) VALUES ("big", 800, 600)
INSERT INTO Size (Name, Width, Height) VALUES ("med", 600, 400)
INSERT INTO Size (Name, Width, Height) VALUES ("min", 300, 200)
INSERT INTO Size (Name, Width, Height) VALUES ("mic", 101, 101)