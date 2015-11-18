#this is for smarthome website

#DROP DATABASE smarthome;

CREATE DATABASE IF NOT EXISTS smarthome  default character set utf8 COLLATE utf8_general_ci;
USE smarthome;


############################################################
#create users
CREATE TABLE IF NOT EXISTS user_tb(
    id          INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
    name        VARCHAR(20) NOT NULL,
    password    CHAR(32) NOT NULL COMMENT'password use md5',
    login_times INT(10) NOT NULL DEFAULT 0,
    last_login  TIMESTAMP NOT NULL DEFAULT NOW(),
    PRIMARY KEY(id)
)ENGINE=InnoDB, CHARSET='utf8';

INSERT INTO user_tb values(
  (NULL, '张三', md5('123456'), 0, now()),
  (NULL, '李四', md5('123456'), 0, now()),
  (NULL, '赵五', md5('123456'), 0, now())
  );


############################################################
CREATE TABLE IF NOT EXISTS sensor_info_tb(
	  id					    TINYINT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
    sensor_id			  TINYINT(2) UNSIGNED NOT NULL,
    sensor_board		TINYINT(2) UNSIGNED NOT NULL,
    sensor_location	TINYINT(2) UNSIGNED NOT NULL,
    senso_type			Varchar(10) NOT NULL COMMENT'sensor type: temperature, humiduty,etc',
    data_unit			  Varchar(10) NOT NULL COMMENT'sensor data unit: centigrade，percentage',
    data_precision	Decimal(10,6) NOT NULL,
    upload_interval	TIME NOT NULL,
    create_time     TIMESTAMP NOt NULL,
    last_timestamp	TIMESTAMP,
    PRIMARY KEY(id)
    )ENGINE=InnoDB, DEFAULT CHARSET=utf8;


Insert into sensor_info_tb values
	(NULL, 1, 1, 1, 'temperature', 'centigrade', 0.05, 1,now(), now()),
    (NULL, 2, 1, 1, 'humiduty',    'percentage',	1,30, now(), now());

############################################################
#create table  for sensor's data
CREATE TABLE IF NOT EXISTS sensor_data_tb(
	  id				INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    sensor_id		TINYINT(2) UNSIGNED NOT NULL,
    sensor_status	TINYINT(2) UNSIGNED NOT NULL,
    raw_data	    INT(6) NOT NULL,
    temperature		Decimal(7,4) COMMENT'sensor measured temperature',
    humidity		Decimal(7,2) COMMENT'sensor measured humidity',
    pressure	    Decimal(7,2),
    lightness		Decimal(7,2),
    distance		Decimal(10,4),
    voltage			Decimal(10,5),
    current			Decimal(10,5),
    capacitance		Decimal(10,5),
    PRIMARY KEY(id)
    )ENGINE=InnoDB, DEFAULT CHARSET=utf8;

Insert into sensor_data_tb( sensor_id, sensor_status, raw_data, temperature) values
	( 1, 1, 123, 23.0),( 1, 1, 124, 23.5),( 1, 1, 125, 24.0),( 1, 1, 123, 23.0),
    ( 1, 1, 124, 23.5),( 1, 1, 125, 24.0),( 1, 1, 125, 24.0),( 1, 1, 123, 23.0);


############################################################
Select * from smarthome.sensor_info_tb limit 10;

Select * from smarthome.sensor_data_tb limit 10;
