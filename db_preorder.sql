/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.34-MariaDB : Database - db_preorder
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_preorder` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `db_preorder`;

/*Table structure for table `tblcategory` */

DROP TABLE IF EXISTS `tblcategory`;

CREATE TABLE `tblcategory` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblcategory` */

insert  into `tblcategory`(`id`,`name`) values (1,'Bread'),(2,'Sauce'),(3,'Sandwich Type'),(4,'Cheese'),(5,'Veggies');

/*Table structure for table `tblcustomer` */

DROP TABLE IF EXISTS `tblcustomer`;

CREATE TABLE `tblcustomer` (
  `id` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblcustomer` */

insert  into `tblcustomer`(`id`,`fname`,`lname`,`email`,`password`) values ('14001376300','Eduard','Peran','peraneduard@gmail.com','admin');

/*Table structure for table `tblitem` */

DROP TABLE IF EXISTS `tblitem`;

CREATE TABLE `tblitem` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `cat_id` int(225) NOT NULL,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`),
  CONSTRAINT `tblitem_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `tblcategory` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblitem` */

insert  into `tblitem`(`id`,`cat_id`,`name`) values (1,1,'Whole Wheat'),(3,1,'Itatian Herb'),(4,1,'Jalapeno parmesan'),(5,2,'Mayo'),(6,2,'Mustard'),(7,2,'Honey Mustard'),(8,2,'Spicy Mayo'),(9,3,'Turkey Bacon Club'),(10,3,'Oven Roasted Turkey'),(11,3,'Savory Ham'),(12,3,'Italian (Salami, Ham, Pepperoni'),(13,4,'American'),(14,4,'Swiss'),(15,4,'Pepperjack'),(16,5,'Cucumber'),(17,5,'Lettuce'),(18,5,'Peppers-Banana'),(19,5,'Peppers-Jalapino'),(20,5,'Peppers-Green and Red'),(21,5,'Pickles'),(22,5,'Spinach'),(23,5,'Tomato'),(24,5,'Olives'),(25,5,'Onions');

/*Table structure for table `tblorder` */

DROP TABLE IF EXISTS `tblorder`;

CREATE TABLE `tblorder` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `sub_id` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_id` (`sub_id`),
  CONSTRAINT `tblorder_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `tblsub` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblorder` */

insert  into `tblorder`(`id`,`sub_id`,`date`) values (24,'jrug92ol','2019-02-07');

/*Table structure for table `tblsub` */

DROP TABLE IF EXISTS `tblsub`;

CREATE TABLE `tblsub` (
  `id` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `cus_id` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cus_id` (`cus_id`),
  CONSTRAINT `tblsub_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `tblcustomer` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblsub` */

insert  into `tblsub`(`id`,`cus_id`) values ('jrug92ol','14001376300');

/*Table structure for table `tblsubitem` */

DROP TABLE IF EXISTS `tblsubitem`;

CREATE TABLE `tblsubitem` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `sub_id` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(225) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `sub_id` (`sub_id`),
  CONSTRAINT `tblsubitem_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `tblitem` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tblsubitem_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `tblsub` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tblsubitem` */

insert  into `tblsubitem`(`id`,`sub_id`,`item_id`) values (54,'jrug92ol',1),(55,'jrug92ol',5),(56,'jrug92ol',11);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
