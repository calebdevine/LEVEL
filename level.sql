DROP DATABASE IF EXISTS `level`; 
CREATE DATABASE  IF NOT EXISTS `level`;
USE `level`;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`(
    `userId`              INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `role`                VARCHAR(255) NOT NULL DEFAULT 'costumer',
    `name`                VARCHAR(100) NOT NULL,
    `surname`             VARCHAR(100) NOT NULL,
    `idCode`              VARCHAR(100) NOT NULL,
    `email`               VARCHAR(100) NOT NULL,
    `password`            VARCHAR(255) NOT NULL,
    `phone`               VARCHAR(10) NOT NULL,
    `state`               INT(1) NOT NULL,
    `privacy`             BOOLEAN DEFAULT 0,
    `subscribed`          BOOLEAN DEFAULT 0,
    `med_certifcate`      BOOLEAN DEFAULT 0,
    `certifcate_expDate`  DATE    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `user` (`userId`, `role`,`name`, `surname`, `idCode`, `email`, `password`, `phone`, `state`) VALUES 
(1,'', 'CALEB', 'DEVINE', 'dvncbs99e21f704k', 'caleb.devine.cd@gmail.com', '$2y$10$QhHziHte4fx.rok.LXzXVeFC2IHj3s4.SLh2aXpgYVOXEuBRzWI/e', '3345393392', '1'),
(0, 'admin','Amministratore', '', '', 'levelasd@gmail.com', '$2y$10$oqDeZxymihgdEddvks7KEus32eFwaTmSy3WfVzLfNJx0og4lbjqza', '', '-1'),
(2, '','Mario', 'Rossi', 'MRORSS65A19G842R', 'mario_rossi@example.com', '$2y$10$z4qABUrStoFiwAuCn3Jw6O7VSJERbSTETpmPMQqLFThcwHhucDkPa', '3289423583', '1');

DROP TABLE IF EXISTS `course`;
CREATE TABLE course (
    `courseId` INT AUTO_INCREMENT PRIMARY KEY,
    `course_name` VARCHAR(100) NOT NULL,
    `day` VARCHAR(10),
    `start` TIME NOT NULL,
    `end` TIME NOT NULL,
    `trainer` VARCHAR(15) NOT NULL,
    `max_places`    INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `course` (`courseId`, `course_name`, `day`, `start`, `end`, `trainer`, `max_places`) VALUES
(1,"TABATA", "Lunedì", "12:00","12:45","Ludovica", 15),
(2,"TABATA", "Venerdì", "12:00","12:45","Ludovica", 15),
(3,"TOTALBODY", "Lunedì", "18:00","19:00","Ludovica", 15),
(4,"TOTALBODY", "Giovedì", "19:00","20:00","Ludovica", 15),
(5,"TOTALBODY", "Venerdì", "17:00","18:00","Ludovica", 15),
(6,"PILATES", "Giovedì", "17:00","18:00", "Alessia", 15),
(7,"PILATES", "Venerdì", "19:00","20:00", "Alessia", 15),
(8,"GAG", "Giovedì", "18:00","19:00","Ludovica", 15),
(9,"PILATES", "Martedì", "19:00","20:00", "Alessia", 15),
(10,"HIIT", "Lunedì", "19:00","20:00","Ludovica", 15);

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE reservations (
    `reservationId` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `courseId` INT NOT NULL,
    `reservation_date` DATE NOT NULL,
    `userId`    INT NOT NULL,
    FOREIGN KEY (`userId`) REFERENCES `user`(`userId`),
    FOREIGN KEY (`courseId`) REFERENCES `course`(`courseId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE subscriptions (
    `subscriptionId` INT AUTO_INCREMENT PRIMARY KEY,
    `course_name` VARCHAR(100),
    `date` DATE NOT NULL,
    `time` TIME NOT NULL,
    `userId`    INT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`userId`) REFERENCES `user`(`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;