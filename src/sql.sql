CREATE TABLE app.cd (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  artist varchar(255) NOT NULL,
  year int(11) NOT NULL,
  duration int(11) DEFAULT NULL,
  buy_date int(11) DEFAULT NULL,
  price decimal(19, 2) DEFAULT NULL,
  code varchar(255) DEFAULT NULL,
  img varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_general_ci
ROW_FORMAT = DYNAMIC;