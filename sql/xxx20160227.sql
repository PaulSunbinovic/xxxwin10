/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.5.5-10.1.8-MariaDB : Database - db_xxx
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_xxx` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_xxx`;

/*Table structure for table `tb_aa` */

DROP TABLE IF EXISTS `tb_aa`;

CREATE TABLE `tb_aa` (
  `aaid` int(2) NOT NULL AUTO_INCREMENT,
  `aanm` varchar(10) DEFAULT NULL,
  `f_aa_bbid` int(2) DEFAULT NULL,
  `aastat` int(1) DEFAULT NULL,
  PRIMARY KEY (`aaid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tb_aa` */

insert  into `tb_aa`(`aaid`,`aanm`,`f_aa_bbid`,`aastat`) values (1,'a一一',1,1),(2,'a二二',2,1),(3,'acc',2,0);

/*Table structure for table `tb_atc` */

DROP TABLE IF EXISTS `tb_atc`;

CREATE TABLE `tb_atc` (
  `atcid` int(3) NOT NULL AUTO_INCREMENT,
  `f_atc_bdid` int(5) DEFAULT NULL,
  `atctpc` varchar(50) DEFAULT NULL,
  `atcath` varchar(20) DEFAULT NULL,
  `atcaddtm` varchar(20) DEFAULT NULL,
  `atcmdftm` varchar(20) DEFAULT NULL,
  `atctp` tinyint(1) DEFAULT NULL,
  `atcps` tinyint(1) DEFAULT NULL,
  `atcanc` tinyint(1) DEFAULT NULL COMMENT '通知',
  `atcdnmc` tinyint(1) DEFAULT NULL COMMENT '动态',
  `atcctt` mediumtext,
  `atccnt` int(5) DEFAULT NULL,
  `atcnw` tinyint(1) DEFAULT NULL COMMENT '内网',
  `atczn` int(5) DEFAULT NULL COMMENT '赞',
  `atctc` int(5) DEFAULT NULL COMMENT '吐槽',
  `atcvw` tinyint(1) DEFAULT NULL,
  `atccv` varchar(100) DEFAULT NULL COMMENT '封面',
  `atcsmr` mediumtext COMMENT '摘要',
  PRIMARY KEY (`atcid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=gbk;

/*Data for the table `tb_atc` */

insert  into `tb_atc`(`atcid`,`f_atc_bdid`,`atctpc`,`atcath`,`atcaddtm`,`atcmdftm`,`atctp`,`atcps`,`atcanc`,`atcdnmc`,`atcctt`,`atccnt`,`atcnw`,`atczn`,`atctc`,`atcvw`,`atccv`,`atcsmr`) values (1,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',1211,0,11,6,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(2,11,'要努力建设','XXX','2014-10-06 09:37:17','2014-10-06 19:21:32',0,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/7851410616568.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" /><br /></p>',28,0,0,0,0,'',''),(3,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',996,0,9,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(4,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',996,0,9,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(5,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',995,0,9,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(6,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',994,0,9,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(7,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',994,0,9,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(8,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',994,0,9,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(9,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',996,0,9,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(10,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',994,0,9,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(11,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',998,0,9,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(12,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',994,0,9,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(13,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',994,0,9,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(14,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',996,0,9,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(15,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',997,0,10,5,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(16,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',994,0,9,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(17,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',999,0,9,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(18,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',998,0,10,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(19,11,'我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉我要吃鱼肉','SB','2014-10-05 10:21:12','2015-02-16 01:07:40',1,1,1,1,'<p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/42261412478297.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" />&nbsp;&nbsp;<br /></p><p>再来一张图片看看</p><p><img src=\"/base/Public/pblc/ueditor/server/upload/uploadimages/61201408796660.jpg\" hspace=\"0\" vspace=\"0\" border=\"0\" /><br /></p><p>这个是我们的学校地图<br /></p>',995,0,9,4,1,'/geek/Uploads/atc/54e0d2752f4da.JPG','这是摘要'),(20,9,'湖州人的代码','超管','2016-02-26 02:02:06','2016-02-26 02:02:06',0,0,0,0,'<p>123</p><p><img src=\"/xxx/Public/etc/ueditor/server/upload/uploadimages/92301456414584.jpg\" hspace=\"0\" border=\"0\" vspace=\"0\" /><br /></p>',16,0,0,0,0,'','');

/*Table structure for table `tb_ath` */

DROP TABLE IF EXISTS `tb_ath`;

CREATE TABLE `tb_ath` (
  `athid` int(10) NOT NULL AUTO_INCREMENT,
  `f_ath_rlid` int(10) DEFAULT NULL,
  `f_ath_mdid` int(10) DEFAULT NULL,
  `atha` tinyint(1) DEFAULT NULL,
  `athd` tinyint(1) DEFAULT NULL,
  `athm` tinyint(1) DEFAULT NULL,
  `athv` tinyint(1) DEFAULT NULL,
  `aths` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`athid`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `tb_ath` */

insert  into `tb_ath`(`athid`,`f_ath_rlid`,`f_ath_mdid`,`atha`,`athd`,`athm`,`athv`,`aths`) values (1,1,1,0,0,0,0,0),(2,1,2,0,0,0,0,0),(3,1,3,0,0,0,0,0),(4,1,4,0,0,0,0,0),(5,1,5,0,0,0,0,0),(6,1,6,0,0,0,0,0),(7,1,7,0,0,0,0,0),(8,1,9,0,0,0,0,0),(9,1,11,0,0,0,0,0),(10,1,14,0,0,0,0,0),(11,1,16,0,0,0,0,0),(12,1,17,0,0,0,0,0),(13,1,18,0,0,0,0,0),(14,1,19,0,0,0,0,0),(15,1,20,0,0,0,0,0),(16,1,21,0,0,0,0,0),(17,1,22,0,0,0,0,0),(18,1,23,0,0,0,0,0),(19,1,25,0,0,0,0,0);

/*Table structure for table `tb_bb` */

DROP TABLE IF EXISTS `tb_bb`;

CREATE TABLE `tb_bb` (
  `bbid` int(2) NOT NULL AUTO_INCREMENT,
  `bbnm` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`bbid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_bb` */

insert  into `tb_bb`(`bbid`,`bbnm`) values (1,'b一一'),(2,'b二二');

/*Table structure for table `tb_bd` */

DROP TABLE IF EXISTS `tb_bd`;

CREATE TABLE `tb_bd` (
  `bdid` int(10) NOT NULL AUTO_INCREMENT,
  `bdnm` varchar(20) DEFAULT NULL,
  `bdpid` int(10) DEFAULT NULL,
  `bdodr` int(10) DEFAULT NULL,
  PRIMARY KEY (`bdid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=gbk;

/*Data for the table `tb_bd` */

insert  into `tb_bd`(`bdid`,`bdnm`,`bdpid`,`bdodr`) values (1,'长兴县',6,3),(2,'妙西',7,2),(3,'江干区',12,1),(4,'上城区',12,2),(5,'温州',0,1),(6,'湖州',0,2),(7,'吴兴区',6,2),(8,'安吉县',6,1),(9,'龙泉街道',10,1),(10,'市辖区',7,1),(11,'爱山街道',10,2),(12,'杭州',0,5),(13,'绍兴',0,4),(14,'嘉兴',0,3);

/*Table structure for table `tb_grp` */

DROP TABLE IF EXISTS `tb_grp`;

CREATE TABLE `tb_grp` (
  `grpid` int(5) NOT NULL AUTO_INCREMENT,
  `grpnm` varchar(20) DEFAULT NULL,
  `grppid` int(5) DEFAULT NULL,
  `grpodr` int(5) DEFAULT NULL,
  PRIMARY KEY (`grpid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_grp` */

insert  into `tb_grp`(`grpid`,`grpnm`,`grppid`,`grpodr`) values (1,'dflt',0,1),(2,'测试',0,2);

/*Table structure for table `tb_lb` */

DROP TABLE IF EXISTS `tb_lb`;

CREATE TABLE `tb_lb` (
  `lbid` int(2) NOT NULL AUTO_INCREMENT,
  `lbnm` varchar(10) DEFAULT NULL,
  `lbodr` int(5) DEFAULT NULL,
  PRIMARY KEY (`lbid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_lb` */

insert  into `tb_lb`(`lbid`,`lbnm`,`lbodr`) values (1,'基础类',1),(2,'客户类',2);

/*Table structure for table `tb_md` */

DROP TABLE IF EXISTS `tb_md`;

CREATE TABLE `tb_md` (
  `mdid` int(10) NOT NULL AUTO_INCREMENT,
  `f_md_lbid` int(5) DEFAULT NULL,
  `mdmk` varchar(20) DEFAULT NULL,
  `mdnm` varchar(20) DEFAULT NULL,
  `mdodr` int(5) DEFAULT NULL,
  PRIMARY KEY (`mdid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=gbk;

/*Data for the table `tb_md` */

insert  into `tb_md`(`mdid`,`f_md_lbid`,`mdmk`,`mdnm`,`mdodr`) values (1,1,'Md','模块模块',3),(2,1,'Usr','用户模块',4),(3,1,'Rl','角色模块',6),(4,1,'Ath','权限模块',8),(5,1,'Bd','板块模块',9),(6,1,'Atc','文章模块',10),(7,1,'Sys','系统模块',11),(9,1,'Grp','团队模块',5),(11,1,'Usrrl','用户-团队-角色模块',7),(14,1,'Lb','大类别模块',2),(16,2,'Cstm','客户用户模块',1),(17,2,'Cstmgrp','客户团队模块',2),(18,2,'Cstmrl','客户角色',3),(19,2,'Cstmath','客户权限模块',4),(20,2,'Cstmusrcstmgrp','客户用户-客户团队模块',5),(21,2,'Cstmgrpcstmrl','客户团队-客户角色模块',6),(22,2,'Cstmusrcstmrl','客户用户-客户角色模块',7),(23,2,'Cstmcmt','客户评论',8),(25,1,'Aa','aa模块',1);

/*Table structure for table `tb_nd` */

DROP TABLE IF EXISTS `tb_nd`;

CREATE TABLE `tb_nd` (
  `ndid` int(5) NOT NULL AUTO_INCREMENT,
  `ndnm` varchar(10) DEFAULT NULL,
  `ndpid` int(5) DEFAULT NULL,
  `ndodr` int(5) DEFAULT NULL,
  PRIMARY KEY (`ndid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `tb_nd` */

insert  into `tb_nd`(`ndid`,`ndnm`,`ndpid`,`ndodr`) values (1,'拱墅区',2,2),(2,'杭州',3,2),(3,'浙江',0,1),(4,'下沙',5,1),(5,'江干区',2,3),(6,'金华',3,3),(7,'湖州',3,1),(8,'江苏',0,2),(9,'萧山区',2,1),(10,'西湖区',2,4);

/*Table structure for table `tb_rl` */

DROP TABLE IF EXISTS `tb_rl`;

CREATE TABLE `tb_rl` (
  `rlid` int(10) NOT NULL AUTO_INCREMENT,
  `rlnm` varchar(20) DEFAULT NULL,
  `f_rl_grpid` int(5) DEFAULT NULL,
  PRIMARY KEY (`rlid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tb_rl` */

insert  into `tb_rl`(`rlid`,`rlnm`,`f_rl_grpid`) values (1,'默认角色',1);

/*Table structure for table `tb_sys` */

DROP TABLE IF EXISTS `tb_sys`;

CREATE TABLE `tb_sys` (
  `sysid` int(2) NOT NULL AUTO_INCREMENT,
  `sysnm` varchar(20) DEFAULT NULL,
  `sysip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sysid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tb_sys` */

insert  into `tb_sys`(`sysid`,`sysnm`,`sysip`) values (1,'xxx','localhost');

/*Table structure for table `tb_tree` */

DROP TABLE IF EXISTS `tb_tree`;

CREATE TABLE `tb_tree` (
  `treeid` int(5) NOT NULL AUTO_INCREMENT,
  `treenm` varchar(10) DEFAULT NULL,
  `treepid` int(5) DEFAULT NULL,
  `treeodr` int(5) DEFAULT NULL,
  PRIMARY KEY (`treeid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `tb_tree` */

insert  into `tb_tree`(`treeid`,`treenm`,`treepid`,`treeodr`) values (1,'拱墅区',2,2),(2,'杭州',3,2),(3,'浙江',0,1),(4,'下沙',5,1),(5,'江干区',2,3),(6,'金华',3,3),(7,'湖州',3,1),(8,'江苏',0,2),(9,'萧山区',2,1),(10,'西湖区',2,4);

/*Table structure for table `tb_usr` */

DROP TABLE IF EXISTS `tb_usr`;

CREATE TABLE `tb_usr` (
  `usrid` int(5) NOT NULL AUTO_INCREMENT,
  `usrmk` tinyint(1) DEFAULT NULL,
  `usrnm` varchar(20) DEFAULT NULL,
  `usrpw` varchar(32) DEFAULT NULL,
  `usrnn` varchar(20) DEFAULT NULL,
  `usrpt` varchar(50) DEFAULT NULL,
  `usraddtm` varchar(20) DEFAULT NULL,
  `usrmdftm` varchar(20) DEFAULT NULL,
  `usrcp` varchar(20) DEFAULT NULL,
  `usrml` varchar(20) DEFAULT NULL,
  `usrps` tinyint(1) DEFAULT NULL,
  `usrvw` tinyint(1) DEFAULT NULL,
  `usrodr` int(5) DEFAULT NULL,
  PRIMARY KEY (`usrid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_usr` */

insert  into `tb_usr`(`usrid`,`usrmk`,`usrnm`,`usrpw`,`usrnn`,`usrpt`,`usraddtm`,`usrmdftm`,`usrcp`,`usrml`,`usrps`,`usrvw`,`usrodr`) values (1,1,'admin','1bbd886460827015e5d605ed44252251','超管','/xxx/Public/img/usr/default.jpg','2015-11-26 00:00:00','2016-02-26 03:02:08','13333333333','sunbinovic@163.com',1,1,1),(2,0,'test','1bbd886460827015e5d605ed44252251','测试员','/xxx/Uploads/usr/1456115109.jpg','','2016-02-22 12:02:49','15555555553','',1,1,2);

/*Table structure for table `tb_usrrl` */

DROP TABLE IF EXISTS `tb_usrrl`;

CREATE TABLE `tb_usrrl` (
  `usrrlid` int(5) NOT NULL AUTO_INCREMENT,
  `f_usrrl_usrid` int(8) DEFAULT NULL,
  `f_usrrl_rlid` int(5) DEFAULT NULL,
  PRIMARY KEY (`usrrlid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tb_usrrl` */

insert  into `tb_usrrl`(`usrrlid`,`f_usrrl_usrid`,`f_usrrl_rlid`) values (3,2,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
