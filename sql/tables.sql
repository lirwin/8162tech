CREATE TABLE `lirwin_8162tech`.`employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `middleName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) NOT NULL,
  `jobId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_employee_job` (`jobId`),
  CONSTRAINT `FK_employee_job` FOREIGN KEY (`jobId`) REFERENCES `job` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `lirwin_8162tech`.`job` (
  `id` int(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `rate` DECIMAL(7,2) NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `lirwin_8162tech`.`project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `leaderId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_project_employee` (`leaderId`),
  CONSTRAINT `FK_project_employee` FOREIGN KEY (`leaderId`) REFERENCES `employee` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  
CREATE TABLE `lirwin_8162tech`.`projHours` (
  `empId` INT NOT NULL ,
  `projId` INT NOT NULL ,
  `hours` DECIMAL(5,1) NOT NULL ,
  PRIMARY KEY (`empId`, `projId`),
  KEY `FK_projHours_project` (`projId`),
  CONSTRAINT `FK_projHours_employee` FOREIGN KEY (`empId`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_projHours_project` FOREIGN KEY (`projId`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  
INSERT INTO `lirwin_8162tech`.`job` (`id`, `name`, `rate`) VALUES 
('1', 'Database Designer', '105.00'),
('2', 'Systems Analyst', '96.75'),
('3', 'Electrical Engineer', '84.50'),
('4', 'Programmer', '35.75'),
('5', 'Clerical Support', '26.87'),
('6', 'DSS Analyst', '45.95'),
('7', 'Applications Designer', '48.10'),
('8', 'General Support', '18.36');

INSERT INTO `lirwin_8162tech`.`employee` (`id`, `firstName`,`middleName`, `lastName`,`jobId`) VALUES 
('101', 'John', 'G.', 'News', '1'),
('102', 'David', 'H.', 'Senior', '2'),
('103', 'June', 'E.', 'Arbough', '3'),
('104', 'Anne', 'K.', 'Ramoras', '2'),
('105', 'Alice', 'K.', 'Johnson', '1'),
('106', 'William', '',  'Smithfield', '4'),
('107', 'Maria', 'D.', 'Alonzo', '4'),
('108', 'Ralph', 'B.', 'Washington', '2'),
('111', 'Geoff', 'B.', 'Wabash', '5'),
('112', 'Darlene', 'M.', 'Smithson', '6'),
('113', 'Delbert', 'K.', 'Joenbrood', '7'),
('114', 'Annelise', '', 'Jones', '7'),
('115', 'Travis', 'B.', 'Bawangi', '2'),
('118', 'James', 'J.', 'Frommer', '8');

INSERT INTO `lirwin_8162tech`.`project` (`id`, `name`, `leaderId`) VALUES 
('1', 'Evergreen', '105'),
('2', 'Amber Wave', '104'),
('3', 'Rolling Tide', '113'),
('4', 'Starflight', '101');

INSERT INTO `lirwin_8162tech`.`projHours` (`empId`, `projId`, `hours`) VALUES 
('101', '1', '19.4'),
('102', '1', '23.8'),
('103', '1', '23.8'),
('105', '1', '35.7'),
('106', '1', '12.6'),
('104', '2', '32.4'),
('112', '2', '44.0'),
('114', '2', '24.6'),
('118', '2', '45.3'),
('105', '3', '64.7'),
('104', '3', '48.4'),
('113', '3', '23.6'),
('111', '3', '22.0'),
('106', '3', '12.8'),
('107', '4', '24.6'),
('115', '4', '45.8'),
('101', '4', '56.3'),
('114', '4', '33.1'),
('108', '4', '23.6'),
('118', '4', '30.5'),
('112', '4', '41.4');
