CREATE DATABASE  IF NOT EXISTS `askahgong` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `askahgong`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: askahgong
-- ------------------------------------------------------
-- Server version	5.5.24-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `action` varchar(90) DEFAULT NULL,
  `targetid` int(11) DEFAULT NULL,
  `dateandtime` datetime DEFAULT NULL,
  `private` int(11) DEFAULT '0',
  `reserved` text COMMENT 'in replyTopic, reserved=commentid\nin sendMessage, reserved=''anytext'' mean need force to use server resend instant msg\nin newItem, reserved = 1 mean havent process new item notification',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16315 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `activity_view`
--

DROP TABLE IF EXISTS `activity_view`;
/*!50001 DROP VIEW IF EXISTS `activity_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `activity_view` (
  `id` tinyint NOT NULL,
  `userid` tinyint NOT NULL,
  `action` tinyint NOT NULL,
  `targetid` tinyint NOT NULL,
  `dateandtime` tinyint NOT NULL,
  `private` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `agent_comment_reply`
--

DROP TABLE IF EXISTS `agent_comment_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agent_comment_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `dateandtime` datetime DEFAULT NULL,
  `thread_id` int(11) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `thread_idx` (`thread_id`),
  CONSTRAINT `thread` FOREIGN KEY (`thread_id`) REFERENCES `agent_comment_thread` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `agent_comment_thread`
--

DROP TABLE IF EXISTS `agent_comment_thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agent_comment_thread` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agent_id` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `dateandtime` datetime DEFAULT NULL,
  `reason_id` int(11) DEFAULT NULL,
  `content` text,
  `point` int(11) DEFAULT NULL,
  `reported` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `agent_request`
--

DROP TABLE IF EXISTS `agent_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agent_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromuserid` int(11) DEFAULT NULL,
  `targetuserid` int(11) DEFAULT NULL,
  `itemid` int(11) DEFAULT NULL,
  `dateandtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_idx` (`itemid`),
  CONSTRAINT `item` FOREIGN KEY (`itemid`) REFERENCES `item_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `residence` varchar(200) DEFAULT ' ',
  `street` varchar(200) DEFAULT '',
  `area` varchar(200) DEFAULT NULL,
  `town` varchar(200) DEFAULT NULL,
  `district` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `latitude` decimal(18,10) DEFAULT NULL,
  `longitude` decimal(18,10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `area` (`area`,`town`,`district`,`state`,`country`,`residence`,`street`),
  FULLTEXT KEY `residence` (`residence`),
  FULLTEXT KEY `street` (`street`),
  FULLTEXT KEY `area_2` (`area`),
  FULLTEXT KEY `town` (`town`),
  FULLTEXT KEY `district` (`district`),
  FULLTEXT KEY `state` (`state`),
  FULLTEXT KEY `country` (`country`)
) ENGINE=MyISAM AUTO_INCREMENT=2223 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(200) NOT NULL,
  `parentcategoryid` varchar(200) NOT NULL,
  `supportstate` int(11) DEFAULT '0' COMMENT 'if(supportstate==-1) =  "XSXIXP"\nelse if(supportstate==1) = "XIXP"\nelse if(supportstate==2) = "XP"',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_anchor`
--

DROP TABLE IF EXISTS `cms_anchor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_anchor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_content`
--

DROP TABLE IF EXISTS `cms_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anchorid` int(11) DEFAULT NULL,
  `html` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromuserid` int(11) DEFAULT NULL,
  `targetuserid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=400 DEFAULT CHARSET=latin1 COMMENT='		';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `countrycode`
--

DROP TABLE IF EXISTS `countrycode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countrycode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countrycode` varchar(50) NOT NULL,
  `countryname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=938 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `description_column`
--

DROP TABLE IF EXISTS `description_column`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `description_column` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `columnname` varchar(50) NOT NULL,
  `word` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `description_rule`
--

DROP TABLE IF EXISTS `description_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `description_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(50) NOT NULL,
  `boolean` tinyint(3) unsigned DEFAULT NULL,
  `columnname` varchar(50) DEFAULT NULL,
  `relativeposition` int(11) NOT NULL DEFAULT '0',
  `subruleid` int(11) NOT NULL DEFAULT '0',
  `targetcategoryid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dictionary`
--

DROP TABLE IF EXISTS `dictionary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dictionary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` longtext,
  `wordtype` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47509 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `discussioncategory`
--

DROP TABLE IF EXISTS `discussioncategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discussioncategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(200) DEFAULT NULL,
  `text` text,
  `datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sequence` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `discussioncomment`
--

DROP TABLE IF EXISTS `discussioncomment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discussioncomment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topicid` int(11) DEFAULT NULL,
  `comment` longtext,
  `userid` int(11) DEFAULT NULL,
  `dateandtime` datetime DEFAULT NULL,
  `hidden` int(11) DEFAULT '0',
  `helpful` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_discussioncomment_discussiontopic` (`topicid`),
  CONSTRAINT `FK_discussioncomment_discussiontopic` FOREIGN KEY (`topicid`) REFERENCES `discussiontopic` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `discussiontopic`
--

DROP TABLE IF EXISTS `discussiontopic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discussiontopic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `topictext` longtext,
  `dateandtime` datetime DEFAULT NULL,
  `topictitle` longtext,
  `viewscount` int(11) DEFAULT '0',
  `lastseen` datetime DEFAULT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `solved` int(11) DEFAULT '0',
  `good` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `category_idx` (`categoryid`),
  CONSTRAINT `category` FOREIGN KEY (`categoryid`) REFERENCES `discussioncategory` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `item_info`
--

DROP TABLE IF EXISTS `item_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(18,2) DEFAULT '0.00',
  `type` varchar(10) DEFAULT NULL,
  `name` longtext,
  `categoryid` int(11) DEFAULT NULL,
  `feature` longtext,
  `psf` decimal(18,2) DEFAULT NULL,
  `builtup` decimal(18,2) DEFAULT NULL,
  `pending` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `item_info_area`
--

DROP TABLE IF EXISTS `item_info_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_info_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` int(11) NOT NULL,
  `latitude` decimal(18,10) DEFAULT NULL,
  `longitude` decimal(18,10) DEFAULT NULL,
  `areaid` int(11) DEFAULT '0',
  `arealevel` int(11) DEFAULT '0' COMMENT '0:street,1:area,2:town,3:district,4:state,5:country',
  `user_defined_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_info_area_item_info1` (`itemid`),
  CONSTRAINT `FK_item_info_area_item_info1` FOREIGN KEY (`itemid`) REFERENCES `item_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `item_relation`
--

DROP TABLE IF EXISTS `item_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` int(11) DEFAULT NULL,
  `targetitemid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `item_rule`
--

DROP TABLE IF EXISTS `item_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(50) NOT NULL,
  `boolean` tinyint(3) unsigned DEFAULT NULL,
  `subruleid` int(11) DEFAULT NULL,
  `relativeposition` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='rules to find other possible item noun';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `landmark`
--

DROP TABLE IF EXISTS `landmark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landmark` (
  `name` varchar(100) DEFAULT NULL,
  `address` longtext,
  `town` longtext,
  `state` longtext,
  `country` longtext,
  `category` varchar(100) DEFAULT NULL,
  `newadded` tinyint(3) unsigned DEFAULT '0',
  `deleting` tinyint(3) unsigned DEFAULT '0',
  `matrixindex` int(11) DEFAULT '0',
  `latitude` decimal(18,10) DEFAULT NULL,
  `longitude` decimal(18,10) DEFAULT NULL,
  `supportstate` tinyint(3) unsigned DEFAULT '0' COMMENT '0:support 1:not valid 2:not yet support',
  `belongto` longtext,
  `distance` decimal(5,2) DEFAULT '5.00',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `realaddress` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6888 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `level_requirement`
--

DROP TABLE IF EXISTS `level_requirement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `level_requirement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) DEFAULT NULL,
  `points` double(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` longtext,
  `dateandtime` datetime DEFAULT NULL,
  `fromuserid` int(11) DEFAULT NULL,
  `touserid` int(11) DEFAULT NULL,
  `newmessage` tinyint(3) unsigned DEFAULT '1',
  `fromuserdeleted` tinyint(3) unsigned DEFAULT '0',
  `touserdeleted` tinyint(3) unsigned DEFAULT '0',
  `sms` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13843 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) DEFAULT '0' COMMENT '1:anytime\n0:working hour only\n',
  `method` int(11) DEFAULT '0' COMMENT '0:by sms\n1:by sms and webnotification\n2:by webnotification',
  `item` int(11) unsigned DEFAULT '1' COMMENT '0:any item',
  `userid` int(11) DEFAULT NULL,
  `areaid` varchar(20) DEFAULT NULL,
  `arealevel` varchar(20) DEFAULT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `pricemin` double(12,2) DEFAULT NULL,
  `pricemax` double(12,2) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=255 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notification_read`
--

DROP TABLE IF EXISTS `notification_read`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification_read` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(45) DEFAULT NULL,
  `targetid` varchar(45) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid_idx` (`userid`),
  CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `user_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `points_log`
--

DROP TABLE IF EXISTS `points_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `points_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `points_awarded` int(11) DEFAULT NULL,
  `reason_id` int(11) DEFAULT NULL,
  `reserved` varchar(260) DEFAULT NULL COMMENT 'for login count, comment_id, topic_id, item_id, facility word, area word',
  `read` int(11) DEFAULT '0',
  `current_points` int(11) DEFAULT NULL,
  `dateandtime` datetime DEFAULT NULL,
  `agent_review` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `reason_idx` (`reason_id`),
  CONSTRAINT `reason` FOREIGN KEY (`reason_id`) REFERENCES `points_reason` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `points_reason`
--

DROP TABLE IF EXISTS `points_reason`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `points_reason` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `award` int(11) DEFAULT '0',
  `agent_review` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `process_record_view`
--

DROP TABLE IF EXISTS `process_record_view`;
/*!50001 DROP VIEW IF EXISTS `process_record_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `process_record_view` (
  `id` tinyint NOT NULL,
  `text` tinyint NOT NULL,
  `userid` tinyint NOT NULL,
  `smsorweb` tinyint NOT NULL,
  `userrespond` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `waitingcode` tinyint NOT NULL,
  `serverrespond` tinyint NOT NULL,
  `dateandtime` tinyint NOT NULL,
  `serversentmessage` tinyint NOT NULL,
  `resultcontentstring` tinyint NOT NULL,
  `learncount` tinyint NOT NULL,
  `learnqueue` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `processrecord`
--

DROP TABLE IF EXISTS `processrecord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `processrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '0:sms search 1:web insert 2:sms insert',
  `text` longtext,
  `userid` int(11) DEFAULT NULL,
  `smsorweb` int(11) DEFAULT '0' COMMENT '0:sms search',
  `fromapps` int(11) DEFAULT '0',
  `userrespond` text,
  `status` int(11) DEFAULT '0' COMMENT '0:ready-to-process 1:in-processed 2:in-learning  3:ready-to-sendreply 4:waitinguserrespond 5:ended ',
  `waitingcode` int(11) DEFAULT NULL,
  `sendingcode` int(11) DEFAULT NULL,
  `serverrespond` longtext,
  `dateandtime` datetime DEFAULT NULL,
  `serversentmessage` longtext,
  `resultcontentstring` longtext,
  `learncount` int(11) DEFAULT '0',
  `learnqueue` int(11) DEFAULT '0',
  `awarded_location` int(11) DEFAULT '0',
  `awarded_facility` int(11) DEFAULT '0',
  `notified` int(11) DEFAULT '0',
  `handling` varchar(80) DEFAULT NULL,
  `server_current_message` longtext COMMENT 'different with serversentmessage = \nthis hold the latest msg sent by server, compare to serversentmessage that may not hold the latest msg when uncompleted transaction happened.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=183638 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shortlist`
--

DROP TABLE IF EXISTS `shortlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shortlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `itemid` int(11) DEFAULT NULL,
  `dateandtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sms`
--

DROP TABLE IF EXISTS `sms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` text,
  `phone` varchar(45) DEFAULT NULL,
  `dateandtime` datetime DEFAULT NULL,
  `read_or_sent` int(11) DEFAULT '0',
  `fromapps` int(11) DEFAULT '0',
  `in_or_out` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1898 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscribe`
--

DROP TABLE IF EXISTS `subscribe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `synonyms`
--

DROP TABLE IF EXISTS `synonyms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `synonyms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `convertto` longtext NOT NULL,
  `convertfrom` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=618 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `transaction_record`
--

DROP TABLE IF EXISTS `transaction_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `posttime` datetime DEFAULT NULL,
  `description` longtext,
  `convertdescription` longtext,
  `itemid` int(11) DEFAULT '0',
  `viewscounter` int(11) DEFAULT '0',
  `smsorweb` tinyint(3) unsigned DEFAULT '0',
  `modified` int(1) DEFAULT '0',
  `lastseen` datetime DEFAULT NULL,
  `removed` int(11) DEFAULT '0',
  `moved_marker` int(11) DEFAULT '0',
  `awarded` int(11) DEFAULT '0',
  `original_owner` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_transaction_record_item_info1` (`itemid`),
  CONSTRAINT `FK_transaction_record_item_info1` FOREIGN KEY (`itemid`) REFERENCES `item_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `transaction_record_view`
--

DROP TABLE IF EXISTS `transaction_record_view`;
/*!50001 DROP VIEW IF EXISTS `transaction_record_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `transaction_record_view` (
  `id` tinyint NOT NULL,
  `userid` tinyint NOT NULL,
  `posttime` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `convertdescription` tinyint NOT NULL,
  `itemid` tinyint NOT NULL,
  `viewscounter` tinyint NOT NULL,
  `smsorweb` tinyint NOT NULL,
  `modified` tinyint NOT NULL,
  `lastseen` tinyint NOT NULL,
  `removed` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `unitconversion`
--

DROP TABLE IF EXISTS `unitconversion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unitconversion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit` varchar(50) NOT NULL,
  `convertmethod` varchar(50) NOT NULL,
  `column` varchar(45) DEFAULT NULL,
  `reserved` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` longtext,
  `phone` varchar(50) DEFAULT NULL,
  `username` varchar(200) DEFAULT 'Anonymous',
  `email` varchar(200) DEFAULT NULL,
  `alternatephone` varchar(50) DEFAULT NULL,
  `contactmethod` varchar(50) DEFAULT 'Web Msg Only',
  `workingfrom` varchar(20) DEFAULT 'Any',
  `workingto` varchar(20) DEFAULT 'Any',
  `description` longtext,
  `registerdate` datetime DEFAULT NULL,
  `lastseen` datetime DEFAULT NULL,
  `remembertoken` varchar(200) DEFAULT NULL,
  `otp` varchar(45) DEFAULT '',
  `max_role_level` int(11) DEFAULT '4',
  `roleid` int(11) DEFAULT '6',
  `points` double(10,0) DEFAULT '0',
  `logincount` int(11) DEFAULT '1',
  `has_update_profile` int(11) DEFAULT '0',
  `completed_profile` int(11) DEFAULT '0',
  `last_get_login_points` date DEFAULT NULL,
  `phone_visibility` int(11) DEFAULT '1' COMMENT '0:all people can see\n1:only contacts can see\n2:nobody can see',
  `agency` varchar(200) DEFAULT NULL,
  `lastseen_shortlist` datetime DEFAULT NULL,
  `lastseen_discussion_reply` datetime DEFAULT NULL,
  `lastseen_new_item` datetime DEFAULT NULL,
  `lastseen_agent_request` datetime DEFAULT NULL,
  `lastseen_agent_review` datetime DEFAULT NULL,
  `hasloginbefore` int(11) DEFAULT '0',
  `reset_password_token` varchar(200) DEFAULT NULL,
  `verified_agent` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(45) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `web_notification_new_item`
--

DROP TABLE IF EXISTS `web_notification_new_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_notification_new_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `dateandtime` datetime DEFAULT NULL,
  `reason` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wordtype`
--

DROP TABLE IF EXISTS `wordtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wordtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` longtext NOT NULL,
  `wordtype` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'askahgong'
--
/*!50003 DROP FUNCTION IF EXISTS `add_item_points` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `add_item_points`(inputitemid int,hasfile varchar(20)) RETURNS int(11)
BEGIN
	DECLARE has_added int;
	DECLARE action_type int;
	DECLARE item_userid int;
	DECLARE has_description int;
	DECLARE has_moved_marker int;

	select userid into item_userid from askahgong.transaction_record where itemid=inputitemid;
	select awarded into has_added from askahgong.transaction_record where itemid=inputitemid;
	select info.type into action_type from askahgong.item_info info where info.id=inputitemid;
	if has_added=0 then

		if action_type = 0 then
			if hasfile = '1' then
				SELECT count(id) into has_description FROM askahgong.transaction_record WHERE description IS NOT NULL and description != '' and itemid=inputitemid;
				SELECT moved_marker into has_moved_marker FROM askahgong.transaction_record WHERE itemid=inputitemid;
					if has_description > 0 and has_moved_marker > 0 then
						call askahgong.add_points(item_userid,10,inputitemid);
						update askahgong.transaction_record set awarded=1 where itemid=inputitemid;
					end if;

			end if;
		else 
			call askahgong.add_points(item_userid,10,inputitemid);
			update askahgong.transaction_record set awarded=1 where itemid=inputitemid;
		end if;

	end if;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `ahgong_add_contact` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `ahgong_add_contact`(input_fromuserid int) RETURNS int(11)
BEGIN
	insert into 
		askahgong.contact (fromuserid,targetuserid) 
	values 
		(input_fromuserid,25);

	call askahgong.add_activity(2,input_fromuserid,25,'');
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `ahgong_send_message` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `ahgong_send_message`(input_touserid int,msg text) RETURNS int(11)
BEGIN
	
	INSERT INTO 
		askahgong.message 
		(message,touserid,fromuserid,dateandtime,sms) 
	VALUES 
		(msg,input_touserid,25,NOW(),0);

	call askahgong.add_activity(8,25,input_touserid,msg);
	

RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `checkAreaMatched` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `checkAreaMatched`(arealevel1 int,area1 varchar(255),arealevel2 int,area2 varchar(255)) RETURNS int(11)
BEGIN
DECLARE resultcount int;
DECLARE lowerlevel,higherlevel int;
DECLARE lowerlevelarea,higherlevelarea varchar(255);

if arealevel1>arealevel2 then
	SET lowerlevel=arealevel2;
	SET lowerlevelarea=area2;
	SET higherlevel=arealevel1;
	SET higherlevelarea=area1;
else
	SET lowerlevel=arealevel1;
	SET lowerlevelarea=area1;
	SET higherlevel=arealevel2;
	SET higherlevelarea=area2;

end if;

if lowerlevel=0 and higherlevel=1 then
select count(id) into resultcount from askahgong.area where residence=lowerlevelarea and street=higherlevelarea;
elseif lowerlevel=0 and higherlevel=2 then
select count(id) into resultcount from askahgong.area where residence=lowerlevelarea and area=higherlevelarea;
elseif lowerlevel=0 and higherlevel=3 then
select count(id) into resultcount from askahgong.area where residence=lowerlevelarea and town=higherlevelarea;
elseif lowerlevel=0 and higherlevel=4 then
select count(id) into resultcount from askahgong.area where residence=lowerlevelarea and district=higherlevelarea;
elseif lowerlevel=0 and higherlevel=5 then
select count(id) into resultcount from askahgong.area where residence=lowerlevelarea and state=higherlevelarea;
elseif lowerlevel=0 and higherlevel=6 then
select count(id) into resultcount from askahgong.area where residence=lowerlevelarea and country=higherlevelarea;
elseif lowerlevel=1 and higherlevel=2 then
select count(id) into resultcount from askahgong.area where street=lowerlevelarea and area=higherlevelarea;
elseif lowerlevel=1 and higherlevel=3 then
select count(id) into resultcount from askahgong.area where street=lowerlevelarea and town=higherlevelarea;
elseif lowerlevel=1 and higherlevel=4 then
select count(id) into resultcount from askahgong.area where street=lowerlevelarea and district=higherlevelarea;
elseif lowerlevel=1 and higherlevel=5 then
select count(id) into resultcount from askahgong.area where street=lowerlevelarea and state=higherlevelarea;
elseif lowerlevel=1 and higherlevel=6 then
select count(id) into resultcount from askahgong.area where street=lowerlevelarea and country=higherlevelarea;
elseif lowerlevel=2 and higherlevel=3 then
select count(id) into resultcount from askahgong.area where area=lowerlevelarea and town=higherlevelarea;
elseif lowerlevel=2 and higherlevel=4 then
select count(id) into resultcount from askahgong.area where area=lowerlevelarea and district=higherlevelarea;
elseif lowerlevel=2 and higherlevel=5 then
select count(id) into resultcount from askahgong.area where area=lowerlevelarea and state=higherlevelarea;
elseif lowerlevel=2 and higherlevel=6 then
select count(id) into resultcount from askahgong.area where area=lowerlevelarea and country=higherlevelarea;
elseif lowerlevel=3 and higherlevel=4 then
select count(id) into resultcount from askahgong.area where town=lowerlevelarea and district=higherlevelarea;
elseif lowerlevel=3 and higherlevel=5 then
select count(id) into resultcount from askahgong.area where town=lowerlevelarea and state=higherlevelarea;
elseif lowerlevel=3 and higherlevel=6 then
select count(id) into resultcount from askahgong.area where town=lowerlevelarea and country=higherlevelarea;
elseif lowerlevel=4 and higherlevel=5 then
select count(id) into resultcount from askahgong.area where district=lowerlevelarea and state=higherlevelarea;
elseif lowerlevel=4 and higherlevel=6 then
select count(id) into resultcount from askahgong.area where district=lowerlevelarea and country=higherlevelarea;
elseif lowerlevel=5 and higherlevel=6 then
select count(id) into resultcount from askahgong.area where state=lowerlevelarea and country=higherlevelarea;
elseif lowerlevel=higherlevel then
	if area1=area2 then
	SET resultcount=1;
	end if;
end if;

if resultcount>0 then
return 1;
else
return 0;
end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `checkAreaMatchedByAreaID` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `checkAreaMatchedByAreaID`(arealevel1 varchar(10),areaid1 varchar(10),arealevel2 varchar(10),areaid2 varchar(10)) RETURNS int(11)
    DETERMINISTIC
BEGIN


DECLARE areatext1 varchar(500);
DECLARE areatext2 varchar(500);
DECLARE result int;

if arealevel1='' OR areaid1='' OR arealevel2='' OR areaid2='' then
	return 0;
end if;

IF arealevel1=0 then
	select CONCAT(residence,'@',street,'@',area,'@',town,'@',district,'@',state,'@',country) into areatext1 from askahgong.area where id=areaid1;
ELSEIF arealevel1=1 then
	select CONCAT(street,'@',area,'@',town,'@',district,'@',state,'@',country) into areatext1 from askahgong.area where id=areaid1;
ELSEIF arealevel1=2 then
	select CONCAT(area,'@',town,'@',district,'@',state,'@',country) into areatext1 from askahgong.area where id=areaid1;
ELSEIF arealevel1=3 then
	select CONCAT(town,'@',district,'@',state,'@',country) into areatext1 from askahgong.area where id=areaid1;
ELSEIF arealevel1=4 then
	select CONCAT(district,'@',state,'@',country) into areatext1 from askahgong.area where id=areaid1;
ELSEIF arealevel1=5 then
	select CONCAT(state,'@',country) into areatext1 from askahgong.area where id=areaid1;
ELSEIF arealevel1=6 then
	select country into areatext1 from askahgong.area where id=areaid1;
END IF;

IF arealevel2=0 then
	select CONCAT(residence,'@',street,'@',area,'@',town,'@',district,'@',state,'@',country) into areatext2 from askahgong.area where id=areaid2;
ELSEIF arealevel2=1 then
	select CONCAT(street,'@',area,'@',town,'@',district,'@',state,'@',country) into areatext2 from askahgong.area where id=areaid2;
ELSEIF arealevel2=2 then
	select CONCAT(area,'@',town,'@',district,'@',state,'@',country) into areatext2 from askahgong.area where id=areaid2;
ELSEIF arealevel2=3 then
	select CONCAT(town,'@',district,'@',state,'@',country) into areatext2 from askahgong.area where id=areaid2;
ELSEIF arealevel2=4 then
	select CONCAT(district,'@',state,'@',country) into areatext2 from askahgong.area where id=areaid2;
ELSEIF arealevel2=5 then
	select CONCAT(state,'@',country) into areatext2 from askahgong.area where id=areaid2;
ELSEIF arealevel2=6 then
	select country into areatext2 from askahgong.area where id=areaid2;
END IF;

IF arealevel1>arealevel2 then
	SET areatext1=CONCAT('%',areatext1,'%');
	select (areatext2 LIKE areatext1) into result;

ELSE 
	SET areatext2=CONCAT('%',areatext2,'%');
	select (areatext1 LIKE areatext2) into result;

END IF;


RETURN result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `checkCannotSMS` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `checkCannotSMS`(inputuserid int,targetuserid int) RETURNS int(11)
BEGIN
	DECLARE can_see_phone int;
	DECLARE single_day_sms int;
	DECLARE in_working_hour int;
	DECLARE last_sent_violate int;
	select checkCanSeePhoneNumber(inputuserid,targetuserid) into can_see_phone;
	if can_see_phone = 0 then
		return 1;
	end if;
	
	select count(id) into single_day_sms from askahgong.message where fromuserid=inputuserid and sms=1 and DATE(dateandtime) = DATE(NOW());
	if single_day_sms>=3 then
		return 2;
	end if;
	
	select checkNowIsWithinWorkingHour(targetuserid) into in_working_hour;
	if in_working_hour=0 then
		return 3;
	end if;
	
	SELECT count(id) into last_sent_violate FROM askahgong.message WHERE sms=1 and fromuserid=inputuserid and touserid=targetuserid and dateandtime > DATE_ADD(NOW(), INTERVAL -1 HOUR);
	if last_sent_violate>0 then
		return 4;
	end if;
	
RETURN 0;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `checkCanSeePhoneNumber` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `checkCanSeePhoneNumber`(userid1 int,userid2 int) RETURNS int(11)
BEGIN
	DECLARE phonevisibility int;
	if userid1=userid2 then
	return 1;
	end if;

	select phone_visibility into phonevisibility from askahgong.user_info where id=userid2;
	
	if phonevisibility = 0 then
		return 1;
	elseif phonevisibility = 1 then
		select count(id) into phonevisibility from askahgong.contact where fromuserid=userid2 and targetuserid=userid1;
		return phonevisibility;
	elseif phonevisibility = 2 then
		return 0;
	end if;
RETURN 0;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `checkIsVerifiedAgent` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `checkIsVerifiedAgent`(userid int) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE returnRole varchar(45);
	DECLARE verified int;
	DECLARE userAgency varchar(45);
	select verified_agent into verified from askahgong.user_info where id=userid;
	select agency into userAgency from askahgong.user_info where id=userid;
	select rol.role into returnRole from askahgong.user_role rol inner join askahgong.user_info info ON info.roleid=rol.id where info.id=userid; 
	
	if returnRole = 'Agent' and verified = 1 then
		return 1;
	end if;
RETURN 0;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `checkNowIsWithinWorkingHour` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `checkNowIsWithinWorkingHour`(inputuserid int) RETURNS int(11)
BEGIN
	DECLARE user_workingfrom varchar(20);
	DECLARE user_workingto varchar(20);
	DECLARE am_pm int;
	DECLARE is_within int;
	
	SET is_within=0;
	select workingfrom into user_workingfrom from askahgong.user_info where id=inputuserid;
	select workingto into user_workingto from askahgong.user_info where id=inputuserid;
	
	if (LOWER(user_workingfrom)='any' OR LOWER(user_workingto)='any') OR (user_workingfrom=user_workingto) then
		return 1;
	end if;
	
	select LOWER(user_workingfrom) LIKE '%pm%' into am_pm;
	SET user_workingfrom=REPLACE(user_workingfrom,' ','');
	if am_pm =1  then
	SET user_workingfrom=REPLACE(user_workingfrom,'PM','');
		if user_workingfrom<>'12' then
			SET user_workingfrom=user_workingfrom+12;
		end if;
	else
	SET user_workingfrom=REPLACE(user_workingfrom,'AM','');
		if user_workingfrom='12' then
			SET user_workingfrom='00';
		end if;
	end if;
	
	SET user_workingfrom=CONCAT(user_workingfrom,':00:00');
	

	select LOWER(user_workingto) LIKE '%pm%' into am_pm;
	SET user_workingto=REPLACE(user_workingto,' ','');
	if am_pm=1 then
	SET user_workingto=REPLACE(user_workingto,'PM','');
		if user_workingto<>'12' then
			SET user_workingto=user_workingto+12;
		end if;
	
	else
	SET user_workingto=REPLACE(user_workingto,'AM','');
		if user_workingto='12' then
			SET user_workingto='00';
		end if;

	end if;
	
	SET user_workingto=CONCAT(user_workingto,':00:00');
	

	IF DATE(user_workingto)<DATE(user_workingfrom) then
		SELECT(
			SELECT DATE_FORMAT(NOW(), '%H:00:00') BETWEEN DATE(user_workingfrom) 
			AND DATE('24:00:00') OR 
			DATE_FORMAT(NOW(), '%H:00:00') BETWEEN DATE('00:00:00') 
						AND DATE(user_workingto)) into is_within;
	else 
		SELECT DATE_FORMAT(NOW(), '%H:00:00') BETWEEN DATE(user_workingfrom) 
			AND DATE(user_workingto) into is_within;
	end if;
	


RETURN is_within;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `functGetAreaByIDAndLevel` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `functGetAreaByIDAndLevel`(areaid int,arealevel int) RETURNS varchar(255) CHARSET latin1
BEGIN
DECLARE result varchar(255);


	 CASE arealevel
        WHEN  0 THEN
           select residence into result from askahgong.area where id=areaid;
        WHEN 1 THEN
		    select street into result from askahgong.area where id=areaid;
   WHEN 2 THEN
		   select area into result from askahgong.area where id=areaid;
   WHEN 3 THEN
		   select town into result from askahgong.area where id=areaid;
   WHEN 4 THEN
		   select district into result from askahgong.area where id=areaid;
   WHEN 5 THEN
		   select state into result from askahgong.area where id=areaid;
   WHEN 6 THEN
		   select country into result from askahgong.area where id=areaid;
     
    END CASE;
return result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getallcategory` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getallcategory`(GivenID INT) RETURNS varchar(1024) CHARSET latin1
    DETERMINISTIC
BEGIN

    DECLARE rv,q,queue,queue_children VARCHAR(1024);
    DECLARE queue_length,front_id,pos INT;
	DECLARE precheck INT;

    SET rv = '';
    SET queue = GivenID;
    SET queue_length = 1;

	SET precheck='';
	SELECT id into precheck from askahgong.category where id=GivenID;
	IF precheck='' THEN return precheck;
	END IF;


    WHILE queue_length > 0 DO
        SET front_id = FORMAT(queue,0);
        IF queue_length = 1 THEN
            SET queue = '';
        ELSE
            SET pos = LOCATE(',',queue) + 1;
            SET q = SUBSTR(queue,pos);
            SET queue = q;
        END IF;
        SET queue_length = queue_length - 1;

        SELECT IFNULL(qc,'') INTO queue_children
        FROM (SELECT GROUP_CONCAT(id) qc
        FROM askahgong.category WHERE (parentcategoryid = front_id and parentcategoryid <> id)) A;

        IF LENGTH(queue_children) = 0 THEN
            IF LENGTH(queue) = 0 THEN
                SET queue_length = 0;
            END IF;
        ELSE
            IF LENGTH(rv) = 0 THEN
                SET rv = queue_children;
            ELSE
                SET rv = CONCAT(rv,',',queue_children);
            END IF;
            IF LENGTH(queue) = 0 THEN
                SET queue = queue_children;
            ELSE
                SET queue = CONCAT(queue,',',queue_children);
            END IF;
            SET queue_length = LENGTH(queue) - LENGTH(REPLACE(queue,',','')) + 1;
        END IF;
    END WHILE;

    RETURN if(rv='',GivenID,CONCAT(rv,',',GivenID));

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getarealevel` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getarealevel`(word varchar(200)) RETURNS varchar(200) CHARSET latin1
BEGIN
DECLARE arealevel varchar(2);

SET arealevel='';
SET word=REPLACE(word,' ','');
if ((select count(id) from askahgong.area where REPLACE(country,' ','')=word)  > 0 )
then SET arealevel = 6;
RETURN arealevel;
end if; 
	
if ((select count(id) from askahgong.area where REPLACE(state,' ','')=word)  > 0 )
then SET arealevel = 5;
RETURN arealevel;
end if; 

if ((select count(id) from askahgong.area where REPLACE(district,' ','')=word)  > 0 )
then SET arealevel = 4;
RETURN arealevel;
end if; 

if ((select count(id) from askahgong.area where REPLACE(town,' ','')=word)  > 0 )
then SET arealevel = 3;
RETURN arealevel;
end if; 

if ((select count(id) from askahgong.area where REPLACE(area,' ','')=word)  > 0 ) 
then SET arealevel = 2;
RETURN arealevel;
end if; 

if ((select count(id) from askahgong.area where REPLACE(street,' ','')=word)  > 0 )
then SET arealevel = 1;
RETURN arealevel;
end if; 

if ((select count(id) from askahgong.area where REPLACE(residence,' ','')=word)  > 0 )
then SET arealevel = 0;
RETURN arealevel;
end if; 


RETURN arealevel;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getAreaLevelRespectiveText` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getAreaLevelRespectiveText`(areaLevel int) RETURNS varchar(100) CHARSET latin1
BEGIN
	IF areaLevel = 0 Then
		Return "residence";
	ElseIF areaLevel = 1 Then
		Return "street";
	ElseIF areaLevel = 2 Then
		Return "area";
	ElseIF areaLevel = 3 Then
		Return "town";
	ElseIF areaLevel = 4 Then
		Return "district";
	ElseIF areaLevel = 5 Then
		Return "state";
	ElseIF areaLevel = 6 Then
		Return "country";
	End IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getAreaNameByIDAndLevel` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getAreaNameByIDAndLevel`(areaid varchar(10),arealevel varchar(10)) RETURNS varchar(200) CHARSET latin1
BEGIN
DECLARE result  varchar(200);
	 CASE arealevel
        WHEN  0 THEN
           select residence into result from askahgong.area where id=areaid;
        WHEN 1 THEN
		   select street into result from askahgong.area where id=areaid;
   WHEN 2 THEN
		   select area into result from askahgong.area where id=areaid;
   WHEN 3 THEN
		   select town into result from askahgong.area where id=areaid;
   WHEN 4 THEN
		   select district into result from askahgong.area where id=areaid;
   WHEN 5 THEN
		   select state into result from askahgong.area where id=areaid;
   WHEN 6 THEN
		   select country into result from askahgong.area where id=areaid;
   ELSE
		SET result='';
     
    END CASE;
RETURN result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getClosestNextLevelPoints` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getClosestNextLevelPoints`(inputuserid int) RETURNS int(11)
BEGIN
DECLARE requiredPoints int;
	DECLARE nextLevelPoints int;
	DECLARE currentPoints int;
	select points into currentPoints from askahgong.user_info where id=inputuserid;
	select min(lvl.points) into nextLevelPoints from askahgong.level_requirement lvl where lvl.points>currentPoints;
	
	IF ISNULL(nextLevelPoints) THEN
		select min(points) into nextLevelPoints from askahgong.level_requirement;
	END IF;

RETURN nextLevelPoints;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getClosestPrevLevelPoints` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getClosestPrevLevelPoints`(inputuserid int) RETURNS int(11)
    DETERMINISTIC
BEGIN 
DECLARE prevLevelPoints int;
	DECLARE currentPoints int;
	select points into currentPoints from askahgong.user_info where id=inputuserid;
	select max(lvl.points) into prevLevelPoints from askahgong.level_requirement lvl where lvl.points<=currentPoints;
	
	IF ISNULL(prevLevelPoints) THEN
		select 0 into prevLevelPoints;
	END IF;

RETURN prevLevelPoints;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getdirectdistance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getdirectdistance`(lat1 float,lon1 float,lat2 float,lon2 float) RETURNS float
BEGIN  
  DECLARE x decimal (20,20);
  DECLARE  pi  decimal (21,20);  
  SET  pi = 3.14159265358979323846;  
  SET  x = sin( lat1 * pi/180 ) * sin( lat2 * pi/180  ) + cos(  
 lat1 *pi/180 ) * cos( lat2 * pi/180 ) * cos(  abs( (lon2 * pi/180) -  
 (lon1 *pi/180) ) );  
  SET  x = acos( x );  
  RETURN ( 1.852 * 60.0 * ((x/pi)*180) );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getisfriend` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getisfriend`(myuserid int,frienduserid int) RETURNS int(11)
BEGIN
DECLARE result int;
select count(id) into result from askahgong.contact where fromuserid=myuserid and targetuserid=frienduserid;


RETURN result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getitemarea` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getitemarea`(inputitemid INT) RETURNS longtext CHARSET latin1
    DETERMINISTIC
BEGIN
  DECLARE rv LONGTEXT;
  DECLARE done INT DEFAULT FALSE;
  DECLARE arealevel,areaid CHAR(16);
  DECLARE residence,street,area,town,district,state,country,user_defined_name VARCHAR(200);
  DECLARE cur1 CURSOR FOR SELECT s.arealevel,IFNULL(s.user_defined_name,''),a.id,IFNULL(a.residence,''),IFNULL(a.street,''),IFNULL(a.area,''),IFNULL(a.town,''),IFNULL(a.district,''),IFNULL(a.state,''),IFNULL(a.country,'') FROM askahgong.item_info_area s left join askahgong.area a ON s.areaid=a.id where s.itemid=inputitemid;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
	
	SET rv='';

  OPEN cur1;

  read_loop: LOOP
    FETCH cur1 INTO arealevel,user_defined_name,areaid,residence,street,area,town,district,state,country;
    IF done THEN
      LEAVE read_loop;
    END IF;
   case arealevel
		when '0' then SET rv=CONCAT(rv,',',IF(user_defined_name='',residence,user_defined_name),'@',street,'@',area,'|',areaid,'|',arealevel);
		when '1' then SET rv=CONCAT(rv,',',IF(user_defined_name='',street,user_defined_name),'@',area,'|',areaid,'|',arealevel);
		when '2' then SET rv=CONCAT(rv,',',IF(user_defined_name='',area,user_defined_name),'|',areaid,'|',arealevel);
		when '3' then SET rv=CONCAT(rv,',',town,'|',areaid,'|',arealevel);
		when '4' then SET rv=CONCAT(rv,',',district,'|',areaid,'|',arealevel);
		when '5' then SET rv=CONCAT(rv,',',state,'|',areaid,'|',arealevel);
		when '6' then SET rv=CONCAT(rv,',',country,'|',areaid,'|',arealevel);
	END case;
 END LOOP;

  CLOSE cur1;
	return TRIM(BOTH ',' FROM rv);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getNextLevelRequired` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getNextLevelRequired`(inputuserid int) RETURNS int(11)
BEGIN
	DECLARE requiredPoints int;
	DECLARE nextLevelPoints int;
	DECLARE currentPoints int;
	select points into currentPoints from askahgong.user_info where id=inputuserid;
	select min(lvl.points) into nextLevelPoints from askahgong.level_requirement lvl where lvl.points>currentPoints;
	SET requiredPoints=nextLevelPoints-currentPoints;
	
	IF ISNULL(requiredPoints) THEN
		select min(points) into requiredPoints from askahgong.level_requirement;
	END IF;

RETURN requiredPoints;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getPageByCommentID` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getPageByCommentID`(inputcommentid int) RETURNS int(11)
BEGIN
	DECLARE return_page int;
	DECLARE comment_topicid int;
	
	select topicid into comment_topicid from askahgong.discussioncomment where id=inputcommentid;

	select IFNULL(count(id),0) 
		into return_page 
	from 
		askahgong.discussioncomment
	where
		topicid=comment_topicid
		and id<inputcommentid;

	SET return_page=FLOOR(return_page/10)*10;


RETURN return_page;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getRealNextLevelExpNeeded` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `getRealNextLevelExpNeeded`(inputlvl int) RETURNS int(11)
    DETERMINISTIC
BEGIN
	
	DECLARE result varchar(200);
	DECLARE point1 float;
	DECLARE point2 float;
	
	select points into point2 from askahgong.level_requirement where level = inputlvl;
	select IFNULL(points,0) into point1 from askahgong.level_requirement where level = inputlvl-1;
	IF ISNULL(point1) then
		SET point1=0;
	end if;
	SET result = point2 - point1;
RETURN result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getRelatedItems` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getRelatedItems`(selectedMode varchar(10),inputitemid int) RETURNS text CHARSET latin1
    DETERMINISTIC
BEGIN

DECLARE result text;
DECLARE b_a,b_p,b_pa,s_a,s_p,s_pa varchar(20);		/*b=buy,s=sell,a=area,p=price,pa=price and area*/
DECLARE itemprice DECIMAL(18,2);
DECLARE itemareaid int;
DECLARE itemarealevel int;
DECLARE itemcategoryid varchar(200);

select price into itemprice from askahgong.item_info where id=inputitemid;
select areaid into itemareaid from askahgong.item_info_area where itemid=inputitemid limit 1;
select arealevel into itemarealevel from askahgong.item_info_area where itemid=inputitemid limit 1;
select CONCAT(askahgong.gettopcategoryalongtheway(categoryid),",",askahgong.getallcategory(categoryid)) into itemcategoryid from askahgong.item_info where id=inputitemid;

if itemarealevel<2 then
	SET itemarealevel=2;
end if;


if selectedMode='s_p' then
	select GROUP_CONCAT(distinct info.id order by info.id desc) into result from askahgong.item_info info inner join askahgong.transaction_record trans ON trans.itemid=info.id where info.type=0 and FIND_IN_SET(info.categoryid,itemcategoryid) and info.price<=(itemprice+(itemprice*30/100)) and info.price>=(itemprice-(itemprice*30/100)) and info.id<>inputitemid and trans.removed=0;
	return result;
elseif selectedMode='b_p' then
	select GROUP_CONCAT(distinct info.id order by info.id desc) into result from askahgong.item_info info inner join askahgong.transaction_record trans ON trans.itemid=info.id  where info.type=1 and FIND_IN_SET(info.categoryid,itemcategoryid) and info.price<=(itemprice+(itemprice*30/100)) and info.price>=(itemprice-(itemprice*30/100)) and info.id<>inputitemid and trans.removed=0;
	return result;
elseif selectedMode='s_a' then
	select GROUP_CONCAT(distinct info.id order by info.id desc) into result from askahgong.item_info info inner join askahgong.transaction_record trans ON trans.itemid=info.id  left join askahgong.item_info_area area ON info.id=area.itemid where info.type=0 and FIND_IN_SET(info.categoryid,itemcategoryid) and askahgong.checkAreaMatchedByAreaID(area.arealevel,area.areaid,itemarealevel,itemareaid)=1 and info.id<>inputitemid and trans.removed=0;
	return result;
elseif selectedMode='b_a' then
	select GROUP_CONCAT(distinct info.id order by info.id desc) into result from askahgong.item_info info inner join askahgong.transaction_record trans ON trans.itemid=info.id  left join askahgong.item_info_area area ON info.id=area.itemid where info.type=1 and FIND_IN_SET(info.categoryid,itemcategoryid) and askahgong.checkAreaMatchedByAreaID(area.arealevel,area.areaid,itemarealevel,itemareaid)=1 and info.id<>inputitemid and trans.removed=0;
	return result;
elseif selectedMode='s_pa' then
	select GROUP_CONCAT(distinct info.id order by info.id desc) into result from askahgong.item_info info inner join askahgong.transaction_record trans ON trans.itemid=info.id  left join askahgong.item_info_area area ON info.id=area.itemid where info.type=0 and FIND_IN_SET(info.categoryid,itemcategoryid) and askahgong.checkAreaMatchedByAreaID(area.arealevel,area.areaid,itemarealevel,itemareaid)=1 and info.price<=(itemprice+itemprice*30/100) and info.price>=(itemprice-itemprice*30/100) and info.id<>inputitemid and trans.removed=0;
	return result;
elseif selectedMode='b_pa' then
	select GROUP_CONCAT(distinct info.id order by info.id desc) into result from askahgong.item_info info inner join askahgong.transaction_record trans ON trans.itemid=info.id  left join askahgong.item_info_area area ON info.id=area.itemid where info.type=1 and FIND_IN_SET(info.categoryid,itemcategoryid) and askahgong.checkAreaMatchedByAreaID(area.arealevel,area.areaid,itemarealevel,itemareaid)=1 and info.price<=(itemprice+itemprice*30/100) and info.price>=(itemprice-itemprice*30/100) and info.id<>inputitemid and trans.removed=0;
	return result;
end if;

select count(distinct info.id) into s_p from askahgong.item_info info inner join askahgong.transaction_record trans ON trans.itemid=info.id  where info.type=0 and FIND_IN_SET(info.categoryid,itemcategoryid) and info.price<=(itemprice+(itemprice*30/100)) and info.price>=(itemprice-(itemprice*30/100)) and info.id<>inputitemid and trans.removed=0 and info.pending=0;
select count(distinct info.id) into b_p from askahgong.item_info info inner join askahgong.transaction_record trans ON trans.itemid=info.id  where info.type=1 and FIND_IN_SET(info.categoryid,itemcategoryid) and info.price<=(itemprice+(itemprice*30/100)) and info.price>=(itemprice-(itemprice*30/100)) and info.id<>inputitemid and trans.removed=0 and info.pending=0;
select count(distinct info.id) into s_a from askahgong.item_info info inner join askahgong.transaction_record trans ON trans.itemid=info.id  left join askahgong.item_info_area area ON info.id=area.itemid where info.type=0 and FIND_IN_SET(info.categoryid,itemcategoryid) and askahgong.checkAreaMatchedByAreaID(area.arealevel,area.areaid,itemarealevel,itemareaid)=1 and info.id<>inputitemid and trans.removed=0 and info.pending=0;
select count(distinct info.id) into b_a from askahgong.item_info info inner join askahgong.transaction_record trans ON trans.itemid=info.id  left join askahgong.item_info_area area ON info.id=area.itemid where info.type=1 and FIND_IN_SET(info.categoryid,itemcategoryid) and askahgong.checkAreaMatchedByAreaID(area.arealevel,area.areaid,itemarealevel,itemareaid)=1 and info.id<>inputitemid and trans.removed=0 and info.pending=0;
select count(distinct info.id) into s_pa from askahgong.item_info info inner join askahgong.transaction_record trans ON trans.itemid=info.id  left join askahgong.item_info_area area ON info.id=area.itemid where info.type=0 and FIND_IN_SET(info.categoryid,itemcategoryid) and askahgong.checkAreaMatchedByAreaID(area.arealevel,area.areaid,itemarealevel,itemareaid)=1 and info.price<=(itemprice+itemprice*30/100) and info.price>=(itemprice-itemprice*30/100) and info.id<>inputitemid and trans.removed=0 and info.pending=0;
select count(distinct info.id) into b_pa from askahgong.item_info info inner join askahgong.transaction_record trans ON trans.itemid=info.id  left join askahgong.item_info_area area ON info.id=area.itemid where info.type=1 and FIND_IN_SET(info.categoryid,itemcategoryid) and askahgong.checkAreaMatchedByAreaID(area.arealevel,area.areaid,itemarealevel,itemareaid)=1 and info.price<=(itemprice+itemprice*30/100) and info.price>=(itemprice-itemprice*30/100) and info.id<>inputitemid and trans.removed=0 and info.pending=0;

SET result=CONCAT(b_a,',',b_p,',',s_a,',',s_p,',',b_pa,',',s_pa);


RETURN result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getsubrootid` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getsubrootid`(GivenID int) RETURNS int(11)
BEGIN
    DECLARE rv VARCHAR(1024);
    DECLARE ch VARCHAR(20);
	DECLARE rootID VARCHAR(20);
	DECLARE precheck INT;

    SET rv = '';
    SET ch = GivenID;

	
	SET precheck='';
	SELECT id into precheck from askahgong.category where id=GivenID;
	IF precheck='' THEN return precheck;
	END IF;
		


    myloop:WHILE CONVERT(ch,SIGNED INT) > 0 DO
		
        SELECT IF(parentcategoryid=id,concat(id,',!'),parentcategoryid) INTO ch FROM
        (SELECT parentcategoryid,id FROM askahgong.category WHERE id = ch) A;
		
		select id into rootID FROM askahgong.category where id=ch and word LIKE '%subroot%';
		IF rootID<>'' then
			leave myloop;
		 end if;
		IF ch='' OR ch=GivenID OR FIND_IN_SET('!',ch) > 0 then
			leave myloop;
		end if;
		 
    END WHILE;
	
	return rootID;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `gettopcategory` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `gettopcategory`(GivenID int) RETURNS int(11)
BEGIN
    DECLARE rv VARCHAR(1024);
    DECLARE ch VARCHAR(20);
	DECLARE precheck INT;

    SET rv = '';
    SET ch = GivenID;

	
	SET precheck='';
	SELECT id into precheck from askahgong.category where id=GivenID;
	IF precheck='' THEN return precheck;
	END IF;
		


    WHILE CONVERT(ch,SIGNED INT) > 0 DO
        SELECT IF(parentcategoryid=id,concat(id,',!'),parentcategoryid) INTO ch FROM
        (SELECT parentcategoryid,id FROM askahgong.category WHERE id = ch) A;
        IF FIND_IN_SET('!',ch) > 0 THEN
            SET rv = REPLACE(ch,',!','');
			SET ch = -1;
         END IF;
    END WHILE;
	
	return rv;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `gettopcategoryalongtheway` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `gettopcategoryalongtheway`(GivenID INT) RETURNS varchar(1024) CHARSET latin1
    DETERMINISTIC
BEGIN
   DECLARE rv VARCHAR(1024);
    DECLARE cm CHAR(1);
    DECLARE ch INT;
	DECLARE precheck INT;

    SET rv = '';
    SET cm = '';
    SET ch = GivenID;

	SET precheck='';
	SELECT id into precheck from askahgong.category where id=GivenID;
	IF precheck='' THEN return precheck;
	END IF;


    WHILE ch > 0 DO
        SELECT IF(parentcategoryid=id,-1,parentcategoryid) INTO ch FROM
        (SELECT parentcategoryid,id FROM askahgong.category WHERE id = ch) A;
        IF ch > 0 THEN
            SET rv = CONCAT(rv,cm,ch);
            SET cm = ',';
        END IF;
    END WHILE;
	
	return if(rv='',GivenID,CONCAT(GivenID,cm,rv));

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getUserCurrentRealExpPoints` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `getUserCurrentRealExpPoints`(inputuserid int) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE user_level int;
	DECLARE point1 float;
	DECLARE point2 float;
	DECLARE result float;
	select askahgong.getUserLevel(inputuserid) into user_level;
	select points into point2 from user_info where id=inputuserid;
	select IFNULL(points,0) into point1 from askahgong.level_requirement where level = user_level-1;
	IF ISNULL(point1) then
		SET point1=0;
	end if;
	SET result = point2 - point1;
	
RETURN result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getUserLevel` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getUserLevel`(inputuserid int) RETURNS int(11)
    DETERMINISTIC
BEGIN 
	DECLARE returnLevel int;
	select max(level) into returnLevel from level_requirement lvl where lvl.points<=(select points from askahgong.user_info where id=inputuserid);

	IF ISNULL(returnlevel) then
		SET returnlevel=1;
	ELSE
		SET returnlevel=returnlevel+1;
	end if;
RETURN returnLevel;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getUserPostingCount` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `getUserPostingCount`(inputuserid int) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE result int;
	SELECT count(trans.id) into result from askahgong.transaction_record trans 
		INNER JOIN askahgong.item_info info 
		ON trans.itemid=info.id where trans.userid=inputuserid and trans.removed=0 and info.pending=0;
RETURN result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getUserRole` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getUserRole`(userid int,original int) RETURNS varchar(45) CHARSET latin1
    DETERMINISTIC
BEGIN
	DECLARE returnRole varchar(45);
	DECLARE verified int;
	DECLARE userAgency varchar(45);
	select verified_agent into verified from askahgong.user_info where id=userid;
	select agency into userAgency from askahgong.user_info where id=userid;
	select rol.role into returnRole from askahgong.user_role rol inner join askahgong.user_info info ON info.roleid=rol.id where info.id=userid; 
	
	if original = 0 then
		if verified <= 0 and returnRole = 'Agent' then
			SET returnRole = 'Common User';
		end if;

		if verified =1 and returnRole = 'Agent' and (ISNULL(userAgency) or userAgency='') then
			SET returnRole = 'Part Time Agent';
		end if;
	end if;

RETURN returnRole;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getUserStatus` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `getUserStatus`(userid int) RETURNS int(11)
BEGIN
DECLARE diff int;
SELECT TIMESTAMPDIFF(SECOND, IFNULL(lastseen,NOW() - INTERVAL 1 DAY), NOW()) INTO diff from askahgong.user_info where id=userid;

if (diff>30)
then return 0;
else
return 1;
end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `SPLIT_STR` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `SPLIT_STR`(
  x VARCHAR(255),
  delim VARCHAR(12),
  pos INT
) RETURNS varchar(255) CHARSET latin1
RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(x, delim, pos),
       LENGTH(SUBSTRING_INDEX(x, delim, pos -1)) + 1),
       delim, '') ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `add_activity` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `add_activity`(action_number int,inputuserid int,inputtargetid int,inputreserved text)
BEGIN

DECLARE action_text varchar(20);


CASE action_number
    WHEN 0 THEN SET action_text='newItem';
    WHEN 1 THEN SET action_text='editItem';
	WHEN 2 THEN SET action_text='addContact';
	WHEN 3 THEN SET action_text='addShortlist';
	WHEN 4 THEN SET action_text='addTopic';
	WHEN 5 THEN SET action_text='replyTopic';
	WHEN 6 THEN SET action_text='updateProfile';
	WHEN 7 THEN SET action_text='updateSettings';
	WHEN 8 THEN SET action_text='sendMessage';
	WHEN 9 THEN SET action_text='deleteItem';
	WHEN 10 THEN SET action_text='register';
	WHEN 11 THEN SET action_text='checkNotification';
	WHEN 12 THEN SET action_text='logout';
	WHEN 13 THEN SET action_text='agentRequest';
	WHEN 14 THEN SET action_text='acceptAgent';
	WHEN 15 THEN SET action_text='agentReview';
	WHEN 16 THEN SET action_text='agentReviewReply';

END CASE;

DELETE from askahgong.activity 
		where 
			action=action_text 
		and 
			targetid=inputtargetid 
		and 
			userid=inputuserid
		and
			dateandtime >= DATE_ADD( NOW(), INTERVAL -10 MINUTE )
		and 
			(action='updateProfile' OR action='updateSettings' OR action='addContact' OR action='editItem' OR action='addShortlist');
	
INSERT INTO 
	askahgong.activity (userid,action,targetid,dateandtime,private,reserved)
VALUES
	(inputuserid,action_text,inputtargetid,NOW(),0,inputreserved);				

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `add_points` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `add_points`(inputuserid int,type varchar(30),input_reserved varchar(200))
proc_label:BEGIN
	DECLARE new_points int;
	DECLARE firstlogin_new_points int;
	DECLARE has_completed_profile int;
	DECLARE has_login_before int;
	DECLARE login_count int;
	DECLARE last_time_login_date varchar(25);
	DECLARE date_diff int;
	DECLARE currentpoints int;
	DECLARE award int;
	DECLARE reserved_value varchar(200);
	DECLARE is_agent_review int;
	DECLARE max_agent_review_id int;
	DECLARE final_points int;

	SET new_points=0;
	SET currentpoints=0;
	SET firstlogin_new_points=0;
	SET login_count=0;
	SET award=0;
	SET reserved_value=input_reserved;
	select points into currentpoints from askahgong.user_info where id=inputuserid;
    select IFNULL(reason.award,0) into award from askahgong.points_reason reason where id=type;
	select IFNULL(agent_review,0) into is_agent_review from askahgong.points_reason reason where id=type;

	IF type='1' then
		select last_get_login_points into last_time_login_date from askahgong.user_info where id=inputuserid;
		if ISNULL(last_time_login_date) then
			SET date_diff=1;
			
		else 
			SELECT DATEDIFF(NOW(),last_time_login_date) into date_diff;
		end if;
		update askahgong.user_info set last_get_login_points = DATE(NOW()) where id=inputuserid;
		
		if date_diff>1 then 
			update askahgong.user_info set logincount = 1 where id=inputuserid;
		end if;
		if date_diff<>0 then
			select logincount into login_count from askahgong.user_info where id=inputuserid;
			SET new_points=award*login_count;
			SET reserved_value=login_count;
			if login_count=7 then 
				update askahgong.user_info set logincount = 1 where id=inputuserid;
			else 
				update askahgong.user_info set logincount = login_count+1 where id=inputuserid;
			end if;
		end if;
		
		select hasloginbefore into has_login_before from askahgong.user_info where id=inputuserid;
		if has_login_before=0 then
			select reason.award into firstlogin_new_points from askahgong.points_reason reason where id=2;
			update askahgong.user_info set hasloginbefore = 1 where id=inputuserid;
		end if;

	elseif type='6' then
		select completed_profile into has_completed_profile from askahgong.user_info where id=inputuserid;
		if has_completed_profile=0 then
			SET new_points=award;	
			update askahgong.user_info set completed_profile = 1 where id=inputuserid;
		end if;
	else 
		IF type = 'REVOKED' then
			SET new_points=(-input_reserved);	
			SET is_agent_review = 1;
		else
			SET new_points=award;	
		end if;
		
		
	END IF;

	IF firstlogin_new_points<>0 then
		update askahgong.user_info set points = points+firstlogin_new_points where id=inputuserid;
		insert into askahgong.points_log (userid,points_awarded,reason_id,reserved,current_points,dateandtime) values (inputuserid,firstlogin_new_points,2,0,currentpoints,NOW());
		SET currentpoints=currentpoints+firstlogin_new_points;
	end if;

	IF new_points<>0 then
		update askahgong.user_info set points = points+new_points where id=inputuserid;

		if is_agent_review = 1 or type = 'REVOKED' then
			
			select IFNULL(max(lg.id),0) into max_agent_review_id from askahgong.points_log lg where lg.userid=inputuserid and lg.agent_review=1 and lg.read=0;
			if type = 'REVOKED' then
				SET reserved_value = '2';
				select id into type from askahgong.points_reason where title='REVOKED';
			else
				if new_points>0 then
					SET reserved_value = '0';
				else
					SET reserved_value = '1';
				end if;
			end if;

			if max_agent_review_id <> 0 then
				
				update askahgong.points_log set current_points=current_points+new_points where id > max_agent_review_id;
				update askahgong.points_log set points_awarded=points_awarded+new_points,reserved=CONCAT(reserved,',',reserved_value) where id = max_agent_review_id;
				LEAVE proc_label;

			end if;
		end if;
		
		insert into askahgong.points_log (userid,points_awarded,reason_id,reserved,current_points,dateandtime,agent_review) values (inputuserid,new_points,type,reserved_value,currentpoints,NOW(),is_agent_review);
		
	end if;
	
	

	select points into final_points from askahgong.user_info where id=inputuserid;
	if final_points < 0 then	
		update askahgong.user_info set points = 0 where id=inputuserid;
	end if;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cleanUp` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cleanUp`()
BEGIN
	delete from user_info where id<>25;
	delete from web_notification_new_item;
	delete from sms;
	delete from shortlist;
	delete from processrecord;
	delete from points_log;
	delete from notification;
	delete from notification_read;
	delete from message;
	delete from discussiontopic;
	delete from discussioncomment;
	delete from contact;
	delete from activity;
	delete from item_info;
	delete from item_info_area;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getAllArea` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getAllArea`()
BEGIN
	

	select residence as result,id as dbid,0 as arealevel,CONCAT(street,',',area,',',town,',',district,',',state,',',country) as extra,ar.* from askahgong.area ar where residence IS NOT NULL group by residence,street
	UNION 
	select street as result,id as dbid,1 as arealevel,CONCAT(area,',',town,',',district,',',state,',',country) as extra,ar.* from askahgong.area ar group by street,area
	UNION 
	select area as result,id as dbid,2 as arealevel,CONCAT(town,',',district,',',state,',',country) as extra,ar.* from askahgong.area ar group by area,town 
	UNION 
	select town as result,id as dbid,3 as arealevel,CONCAT(district,',',state,',',country) as extra,ar.* from askahgong.area ar group by town,district
	UNION 
	select district as result,id as dbid,4 as arealevel,CONCAT(state,',',country) as extra,ar.* from askahgong.area ar group by district,state
	UNION 
	select state as result,id as dbid,5 as arealevel,country as extra,ar.* from askahgong.area ar group by state,country
	UNION 
	select country as result,id as dbid,6 as arealevel,'' as extra,ar.* from askahgong.area ar group by country ; 
	


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getAllFacility` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getAllFacility`()
BEGIN
	DECLARE facilityID INTEGER;
	DECLARE facilityIDList text;
	DECLARE concatquery text;

	select id into facilityID from askahgong.category where word LIKE 'facility%';
	select getallcategory(facilityID) into facilityIDList;
	 

	SET concatquery=CONCAT('select word from askahgong.category where id IN (',facilityIDList,') and supportstate=0 order by word asc');



	SET @sql_text = concatquery;
	PREPARE stmt FROM @sql_text;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getAllNotifications` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getAllNotifications`(
						in inputuserid int,
						type varchar(200),
						getcounter int,
						getnew int,
						startitem int,
						limititem int,
						discardpart varchar(20),
						splitcounter int)
PROC:BEGIN

DECLARE concatquery text;
DECLARE concatquery1 text;
DECLARE concatquery2 text;
DECLARE concatquery3 text;
DECLARE concatquery4 text;
DECLARE concatquery5 text;
DECLARE concatquery6 text;
DECLARE havecomma int;
DECLARE lastseen_discussion_reply varchar(100);
DECLARE lastseen_new_item varchar(100);
DECLARE lastseen_agent_request varchar(100);
DECLARE lastseen_agent_review varchar(100);
DECLARE discard_part1 int;
DECLARE discard_part2 int;
DECLARE discard_part3 int;
DECLARE discard_part4 int;
DECLARE discard_part5 int;
DECLARE discard_part6 int;

select discardpart LIKE '%1%' into discard_part1;
select discardpart LIKE '%2%' into discard_part2;
select discardpart LIKE '%3%' into discard_part3;
select discardpart LIKE '%4%' into discard_part4;
select discardpart LIKE '%5%' into discard_part5;
select discardpart LIKE '%6%' into discard_part6;


if type<>'' then
select type LIKE '%,%' into havecomma;
	if havecomma>0 then
		SELECT REPLACE(type, ',', '" OR t.action="') into type;
		SET type=concat(' (t.action="',type,'") ');
	else
		SET type=concat(' (t.action="',type,'") ');
	end if;
end if;

SET concatquery='';

if discard_part1<=0 then
SET concatquery1="select user.id as userid,'replyYourTopic' as action,topic.id as targetid,
				cmt.dateandtime,
				user.username,askahgong.getUserStatus(user.id) as isonline,
				topic.topictitle as resulttext,
				cmt.comment as resulttext2,
				(select count(distinct userid) from askahgong.discussioncomment where topicid=topic.id and userid<>inputuserid and id>IFNULL((select max(id) from askahgong.discussioncomment where userid=inputuserid and topicid=topic.id),0))
				as unreadcount,
				cmt.id
				as lastcommentid,
				getPageByCommentID(cmt.id)
				as lastcommentpage,
				(select count(id) from askahgong.notification_read notf where notf.targetid=lastcommentid and notf.action='replyYourTopic' and userid=inputuserid) 
				as hasread
				from askahgong.discussioncomment cmt inner join
				(
					  SELECT MAX(id) AS max_commentid 
					  FROM askahgong.discussioncomment
					  where userid<>inputuserid and hidden=0
					  GROUP BY topicid
				)t 
				ON 
				t.max_commentid=cmt.id
				left join askahgong.discussiontopic topic
				ON
				topic.id=cmt.topicid
				left join askahgong.user_info user 
				ON cmt.userid=user.id	
				where 
				topic.userid=inputuserid and cmt.dateandtime>lastseen_discussion_reply";
SET concatquery=concatquery1;
end if;

if discard_part2<=0 then
    if concatquery<>'' then
		SET concatquery=CONCAT(concatquery," UNION ");
	end if; 
		SET concatquery2="/*someone reply my comment topic,return how many unread reply from unique user*/
		select user.id as userid,'replyTopic' as action,topic.id as targetid,
		cmt.dateandtime,
		user.username,askahgong.getUserStatus(user.id) as isonline,
		topic.topictitle as resulttext,
		cmt.comment as resulttext2,
		(select count(distinct userid) from askahgong.discussioncomment where topicid=topic.id and userid<>inputuserid and id>(select max(id) from askahgong.discussioncomment where userid=inputuserid and topicid=topic.id))
		as unreadcount,
		cmt.id
		as lastcommentid,
		getPageByCommentID(cmt.id)
		as lastcommentpage,
		(select count(id) from askahgong.notification_read notf where notf.targetid=lastcommentid and notf.action='replyTopic' and userid=inputuserid) 
		as hasread
		from askahgong.discussioncomment cmt inner join
		(
			  SELECT MAX(id) AS max_commentid 
			  FROM askahgong.discussioncomment cmt2
			  where userid<>inputuserid and hidden=0 and cmt2.id>(select MIN(id) from askahgong.discussioncomment cmt3 where cmt3.topicid=cmt2.topicid and cmt3.userid=inputuserid)
			  GROUP BY topicid
		)t 
		ON 
		t.max_commentid=cmt.id
		left join askahgong.discussiontopic topic
		ON
		topic.id=cmt.topicid
		left join askahgong.user_info user 
		ON cmt.userid=user.id	
		where 
		topic.userid<>inputuserid
		and topicid IN (select distinct topicid from askahgong.discussioncomment where userid=inputuserid)
		and cmt.dateandtime>lastseen_discussion_reply";

		SET concatquery=CONCAT(concatquery,concatquery2);
	
end if;

if discard_part3<=0 then
    if concatquery<>'' then
		SET concatquery=CONCAT(concatquery," UNION ");
	end if;
		SET concatquery3="/*someone add new item*/
		select avt2.userid,avt2.action,avt2.targetid,avt2.dateandtime,
		user.username,askahgong.getUserStatus(user.id) as isonline,
		web.reason as resulttext,
		'' as resulttext2,
		1 as unreadcount,
		avt2.targetid as lastcommentid,
		'0' as lastcommentpage,
		(select count(id) from askahgong.notification_read notf where notf.targetid=lastcommentid and notf.action=avt2.action and userid=inputuserid) 
		as hasread
		from askahgong.activity avt2
		left join askahgong.user_info user ON avt2.userid=user.id
		left join askahgong.web_notification_new_item web ON web.itemid=avt2.targetid
		where avt2.action ='newItem' and web.userid=inputuserid and avt2.dateandtime>lastseen_new_item";
	
		SET concatquery=CONCAT(concatquery,concatquery3);
	

end if;


if discard_part4<=0 then
    if concatquery<>'' then
		SET concatquery=CONCAT(concatquery," UNION ");
	end if;
		SET concatquery4="/*agent request for pending item*/
		select avt2.userid,avt2.action,avt2.targetid,avt2.dateandtime,
		user.username,askahgong.getUserStatus(user.id) as isonline,
		'' as resulttext,
		'' as resulttext2,
		(select IFNULL(count(req.id),0) from askahgong.agent_request req where req.itemid=avt2.targetid and req.targetuserid=inputuserid) as unreadcount,
		'0' as lastcommentid,
		'0' as lastcommentpage,
		(select count(id) from askahgong.notification_read notf where notf.targetid=avt2.targetid and notf.action=avt2.action and userid=inputuserid) 
		as hasread
		from askahgong.activity avt2
		left join askahgong.agent_request req ON avt2.reserved = req.id
		left join askahgong.user_info user ON req.fromuserid=user.id
		where avt2.action ='agentRequest' and (req.targetuserid=inputuserid)
		and avt2.userid<>inputuserid 
		and avt2.dateandtime>lastseen_agent_request
		GROUP BY avt2.targetid
		";
	
		SET concatquery=CONCAT(concatquery,concatquery4);
end if;


if discard_part5<=0 then
    if concatquery<>'' then
		SET concatquery=CONCAT(concatquery," UNION ");
	end if;
		SET concatquery5="/*agent request accepted*/
		select avt2.userid,avt2.action,avt2.targetid,avt2.dateandtime,
		user.username,askahgong.getUserStatus(user.id) as isonline,
		'' as resulttext,
		'' as resulttext2,
		0 as unreadcount,
		'0' as lastcommentid,
		'0' as lastcommentpage,
		(select count(id) from askahgong.notification_read notf where notf.targetid=avt2.targetid and notf.action=avt2.action and userid=inputuserid) 
		as hasread
		from askahgong.activity avt2
		left join askahgong.agent_request req ON avt2.reserved = req.id
		left join askahgong.user_info user ON avt2.userid=user.id
		where avt2.action ='acceptAgent' and (req.fromuserid=inputuserid OR req.targetuserid=inputuserid)
		and avt2.userid<>inputuserid 
		and avt2.dateandtime>lastseen_agent_request";
	
		SET concatquery=CONCAT(concatquery,concatquery5);
end if;


if discard_part6<=0 then
    if concatquery<>'' then
		SET concatquery=CONCAT(concatquery," UNION ");
	end if;
		SET concatquery6="/*agent review notification*/
		select avt2.userid,avt2.action,avt2.targetid,avt2.dateandtime,
		user.username,askahgong.getUserStatus(user.id) as isonline,
		thread.content as resulttext,
		thread.point as resulttext2,
		0 as unreadcount,
		thread.id as lastcommentid,
		(select CONVERT(COUNT(id), CHAR) from askahgong.agent_comment_thread where id>thread.id and agent_id=thread.agent_id) as lastcommentpage,
		(select count(id) from askahgong.notification_read notf where notf.targetid=avt2.targetid and notf.action=avt2.action and userid=inputuserid) 
		as hasread
		from askahgong.activity avt2
		left join askahgong.agent_comment_thread thread ON avt2.targetid = thread.id
		left join askahgong.user_info user ON avt2.userid=user.id
		where avt2.action ='agentReview' and thread.agent_id=inputuserid 
		and avt2.dateandtime>lastseen_agent_review
		UNION
		select avt2.userid,avt2.action,avt2.targetid,reply.dateandtime,
		user.username,askahgong.getUserStatus(user.id) as isonline,
		reply.content as resulttext,
		thread.agent_id as resulttext2,
		0 as unreadcount,
		thread.id as lastcommentid,
		(select CONVERT(COUNT(id), CHAR) from askahgong.agent_comment_thread where id>thread.id and agent_id=thread.agent_id) as lastcommentpage,
		(select count(id) from askahgong.notification_read notf where notf.targetid=avt2.targetid and notf.action=avt2.action and userid=inputuserid) 
		as hasread
		from askahgong.activity avt2
		left join askahgong.agent_comment_reply reply ON avt2.targetid = reply.id
		inner join
			(
				  SELECT MAX(id) AS max_commentid 
				  FROM askahgong.agent_comment_reply
				  where userid<>inputuserid
				  GROUP BY thread_id
			)t 
			ON 
			t.max_commentid=reply.id
		left join askahgong.user_info user ON avt2.userid=user.id
		left join askahgong.agent_comment_thread thread ON reply.thread_id = thread.id
		where avt2.action ='agentReviewReply' and 
		(
			(select count(id) from askahgong.agent_comment_reply reply2 where reply2.userid=inputuserid and reply2.id<reply.id) > 0
			OR
			thread.agent_id=inputuserid
		)
		and avt2.userid<>inputuserid
		and avt2.dateandtime>lastseen_agent_review
		GROUP BY reply.thread_id";
	
		SET concatquery=CONCAT(concatquery,concatquery6);
end if;


select replace(concatquery,'inputuserid',inputuserid) into concatquery;
select replace(concatquery1,'inputuserid',inputuserid) into concatquery1;
select replace(concatquery2,'inputuserid',inputuserid) into concatquery2;
select replace(concatquery3,'inputuserid',inputuserid) into concatquery3;
select replace(concatquery4,'inputuserid',inputuserid) into concatquery4;
select replace(concatquery5,'inputuserid',inputuserid) into concatquery5;
select replace(concatquery6,'inputuserid',inputuserid) into concatquery6;

select IFNULL(info.lastseen_discussion_reply,'1999-01-01 20:00:00') into lastseen_discussion_reply from askahgong.user_info info where id=inputuserid;
select IFNULL(info.lastseen_new_item,'1999-01-01 20:00:00') into lastseen_new_item from askahgong.user_info info where id=inputuserid;
select IFNULL(info.lastseen_agent_request,'1999-01-01 20:00:00') into lastseen_agent_request from askahgong.user_info info where id=inputuserid;
select IFNULL(info.lastseen_agent_review,'1999-01-01 20:00:00') into lastseen_agent_review from askahgong.user_info info where id=inputuserid;


if getnew=0 then
	SET lastseen_discussion_reply=concat('<"',lastseen_discussion_reply,'"');
	SET lastseen_new_item=concat('<"',lastseen_new_item,'"');
	SET lastseen_agent_request=concat('<"',lastseen_agent_request,'"');
	SET lastseen_agent_review=concat('<"',lastseen_agent_review,'"');
	select replace(concatquery,'>lastseen_discussion_reply',lastseen_discussion_reply) into concatquery;
	select replace(concatquery,'>lastseen_new_item',lastseen_new_item) into concatquery;
	select replace(concatquery,'>lastseen_agent_request',lastseen_agent_request) into concatquery;
	select replace(concatquery,'>lastseen_agent_review',lastseen_agent_review) into concatquery;

	select replace(concatquery1,'>lastseen_discussion_reply',lastseen_discussion_reply) into concatquery1;
	select replace(concatquery1,'>lastseen_new_item',lastseen_new_item) into concatquery1;
	select replace(concatquery1,'>lastseen_agent_request',lastseen_agent_request) into concatquery1;
	select replace(concatquery1,'>lastseen_agent_review',lastseen_agent_review) into concatquery1;

	select replace(concatquery2,'>lastseen_discussion_reply',lastseen_discussion_reply) into concatquery2;
	select replace(concatquery2,'>lastseen_new_item',lastseen_new_item) into concatquery2;
	select replace(concatquery2,'>lastseen_agent_request',lastseen_agent_request) into concatquery2;
	select replace(concatquery2,'>lastseen_agent_review',lastseen_agent_review) into concatquery2;

	select replace(concatquery3,'>lastseen_discussion_reply',lastseen_discussion_reply) into concatquery3;
	select replace(concatquery3,'>lastseen_new_item',lastseen_new_item) into concatquery3;
	select replace(concatquery3,'>lastseen_agent_request',lastseen_agent_request) into concatquery3;
	select replace(concatquery3,'>lastseen_agent_review',lastseen_agent_review) into concatquery3;

	select replace(concatquery4,'>lastseen_discussion_reply',lastseen_discussion_reply) into concatquery4;
	select replace(concatquery4,'>lastseen_new_item',lastseen_new_item) into concatquery4;
	select replace(concatquery4,'>lastseen_agent_request',lastseen_agent_request) into concatquery4;
	select replace(concatquery4,'>lastseen_agent_review',lastseen_agent_review) into concatquery4;

	select replace(concatquery5,'>lastseen_discussion_reply',lastseen_discussion_reply) into concatquery5;
	select replace(concatquery5,'>lastseen_new_item',lastseen_new_item) into concatquery5;
	select replace(concatquery5,'>lastseen_agent_request',lastseen_agent_request) into concatquery5;
	select replace(concatquery5,'>lastseen_agent_review',lastseen_agent_review) into concatquery5;

	select replace(concatquery6,'>lastseen_discussion_reply',lastseen_discussion_reply) into concatquery6;
	select replace(concatquery6,'>lastseen_new_item',lastseen_new_item) into concatquery6;
	select replace(concatquery6,'>lastseen_agent_request',lastseen_agent_request) into concatquery6;
	select replace(concatquery6,'>lastseen_agent_review',lastseen_agent_review) into concatquery6;

else
	SET lastseen_discussion_reply=concat('"',lastseen_discussion_reply,'"');
	SET lastseen_new_item=concat('"',lastseen_new_item,'"');
	SET lastseen_agent_request=concat('"',lastseen_agent_request,'"');
	SET lastseen_agent_review=concat('"',lastseen_agent_review,'"');
	
	select replace(concatquery,'lastseen_discussion_reply',lastseen_discussion_reply) into concatquery;
	select replace(concatquery,'lastseen_new_item',lastseen_new_item) into concatquery;
	select replace(concatquery,'lastseen_agent_request',lastseen_agent_request) into concatquery;
	select replace(concatquery,'lastseen_agent_review',lastseen_agent_review) into concatquery;
	select replace(concatquery1,'lastseen_discussion_reply',lastseen_discussion_reply) into concatquery1;
	select replace(concatquery1,'lastseen_new_item',lastseen_new_item) into concatquery1;
	select replace(concatquery1,'lastseen_agent_request',lastseen_agent_request) into concatquery1;
	select replace(concatquery1,'lastseen_agent_review',lastseen_agent_review) into concatquery1;
	select replace(concatquery2,'lastseen_discussion_reply',lastseen_discussion_reply) into concatquery2;
	select replace(concatquery2,'lastseen_new_item',lastseen_new_item) into concatquery2;
	select replace(concatquery2,'lastseen_agent_request',lastseen_agent_request) into concatquery2;
	select replace(concatquery2,'lastseen_agent_review',lastseen_agent_review) into concatquery2;
	select replace(concatquery3,'lastseen_discussion_reply',lastseen_discussion_reply) into concatquery3;
	select replace(concatquery3,'lastseen_new_item',lastseen_new_item) into concatquery3;
	select replace(concatquery3,'lastseen_agent_request',lastseen_agent_request) into concatquery3;
	select replace(concatquery3,'lastseen_agent_review',lastseen_agent_review) into concatquery3;

	select replace(concatquery4,'lastseen_discussion_reply',lastseen_discussion_reply) into concatquery4;
	select replace(concatquery4,'lastseen_new_item',lastseen_new_item) into concatquery4;
	select replace(concatquery4,'lastseen_agent_request',lastseen_agent_request) into concatquery4;
	select replace(concatquery4,'lastseen_agent_review',lastseen_agent_review) into concatquery4;
	select replace(concatquery5,'lastseen_discussion_reply',lastseen_discussion_reply) into concatquery5;
	select replace(concatquery5,'lastseen_new_item',lastseen_new_item) into concatquery5;
	select replace(concatquery5,'lastseen_agent_request',lastseen_agent_request) into concatquery5;
	select replace(concatquery5,'lastseen_agent_review',lastseen_agent_review) into concatquery5;

	select replace(concatquery6,'lastseen_discussion_reply',lastseen_discussion_reply) into concatquery6;
	select replace(concatquery6,'lastseen_new_item',lastseen_new_item) into concatquery6;
	select replace(concatquery6,'lastseen_agent_request',lastseen_agent_request) into concatquery6;
	select replace(concatquery6,'lastseen_agent_review',lastseen_agent_review) into concatquery6;

end if;



if getcounter>0 then
	if (splitcounter)>0 then
		SET concatquery='SELECT ';
		SET concatquery=CONCAT(concatquery,'(select count(t.userid) from (',concatquery1,')t) as replyyourtopic');
		SET concatquery=CONCAT(concatquery,',','(select count(t.userid) from (',concatquery2,')t) as replytopic');
		SET concatquery=CONCAT(concatquery,',','(select count(t.userid) from (',concatquery3,')t) as newitem');
		SET concatquery=CONCAT(concatquery,',','(select count(t.userid) from (',concatquery4,')t) as agentRequest');
		SET concatquery=CONCAT(concatquery,',','(select count(t.userid) from (',concatquery5,')t) as acceptAgent');
		SET concatquery=CONCAT(concatquery,',','(select count(t.userid) from (',concatquery6,')t) as agentReview');
	else
		SET concatquery=CONCAT('select count(t.userid) from (',concatquery,')t');
		if type<>'' then
		SET concatquery=CONCAT(concatquery," where ",type);
		end if;
	end if;
else
	
	SET concatquery=CONCAT('select * from (',concatquery,')t');
	
	if type='' then
		SET concatquery=CONCAT(concatquery," order by t.dateandtime desc LIMIT ",startitem,",", limititem);
	else 
		SET concatquery=CONCAT(concatquery," where ",type," order by t.dateandtime desc LIMIT ",startitem,",", limititem);
	end if;	

	

end if;

SET @sql_text = concatquery;
PREPARE stmt FROM @sql_text;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getAreaByIDAndLevel` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getAreaByIDAndLevel`(areaid int,arealevel int)
BEGIN
	 CASE arealevel
        WHEN  0 THEN
           select residence as result,CONCAT(street,',',area,',',town,',',district,',',state,',',country) as extra,0 as arealevel from askahgong.area where id=areaid;
        WHEN 1 THEN
		   select street as result,CONCAT(area,',',town,',',district,',',state,',',country) as extra,1 as arealevel from askahgong.area where id=areaid;
   WHEN 2 THEN
		   select area as result,CONCAT(town,',',district,',',state,',',country) as extra,2 as arealevel from askahgong.area where id=areaid;
   WHEN 3 THEN
		   select town as result,CONCAT(district,',',state,',',country) as extra,3 as arealevel from askahgong.area where id=areaid;
   WHEN 4 THEN
		   select district as result,CONCAT(state,',',country) as extra,4 as arealevel from askahgong.area where id=areaid;
   WHEN 5 THEN
		   select state as result,country as extra,5 as arealevel from askahgong.area where id=areaid;
   WHEN 6 THEN
		   select country as result,'' as extra,6 as arealevel from askahgong.area where id=areaid;
  
     
    END CASE;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getAreaByQuery` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getAreaByQuery`(IN areaquery varchar(255),IN maxarealevel integer)
BEGIN
	 
	SET areaquery=CONCAT('%',REPLACE(REPLACE(areaquery,' ',''),'''',''),'%');

	 select * from (
	 select id,residence as result,latitude,longitude,CONCAT_WS(', ',street,area,town,district,state,country) as extra,0 as arealevel from askahgong.area where (REPLACE(CONCAT_WS(',',street,area,town,district,state,country),' ','') LIKE areaquery) OR (REPLACE(residence,' ','') LIKE areaquery) 
	  UNION
	 select id,street as result,latitude,longitude,CONCAT_WS(', ',area,town,district,state,country) as extra,1 as arealevel from askahgong.area where (REPLACE(CONCAT_WS(',',area,town,district,state,country),' ','') LIKE areaquery) OR (REPLACE(street,' ','') LIKE areaquery) 
      UNION
	 select id,area as result,latitude,longitude,CONCAT_WS(', ',town,district,state,country) as extra,2 as arealevel from askahgong.area where (REPLACE(CONCAT_WS(',',town,district,state,country),' ','') LIKE areaquery) OR (REPLACE(area,' ','') LIKE areaquery) 
      UNION
	 select id,town as result,latitude,longitude,CONCAT_WS(', ',district,state,country) as extra,3 as arealevel from askahgong.area where (REPLACE(CONCAT_WS(',',district,state,country),' ','') LIKE areaquery) OR (REPLACE(town,' ','') LIKE areaquery) 
      UNION
	 select id,district as result,latitude,longitude,CONCAT_WS(', ',state,country) as extra,4 as arealevel from askahgong.area where (REPLACE(CONCAT_WS(',',state,country),' ','') LIKE areaquery) OR (REPLACE(district,' ','') LIKE areaquery) 
      UNION
	 select id,state as result,latitude,longitude,country as extra,5 as arealevel from askahgong.area where (REPLACE(CONCAT_WS(',',state,country),' ','') LIKE areaquery) OR (REPLACE(state,' ','') LIKE areaquery) 
	  UNION
	 select id,country as result,latitude,longitude,'' as extra,6 as arealevel from askahgong.area where (REPLACE(country,' ','') LIKE areaquery)) as abc where arealevel<=maxarealevel and result is not null and latitude is not null and result<>'' GROUP BY result,extra ORDER BY arealevel desc,LENGTH(result) asc limit 90;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getCategoryChildWordByParentWord` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getCategoryChildWordByParentWord`(givenWord varchar(200))
BEGIN
DECLARE wordcategoryid int;
Set wordcategoryid = 0;
select id into wordcategoryid from askahgong.category where word=givenWord;
select word from askahgong.category where find_in_set(id,askahgong.getallcategory(wordcategoryid)) and id<>wordcategoryid and supportstate=0;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getEssentialItemAttribute` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getEssentialItemAttribute`(inputitemid int)
BEGIN
	select info.builtup,info.price,
		   info.feature,info.categoryid,
		   info.name,
		   info.type as action,
           area.arealevel,
           area.areaid 
		from 
			askahgong.item_info info 
		left join 
			askahgong.item_info_area area 
		ON 
			area.itemid=info.id 
		where 
			info.id=inputitemid;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getItemLastSeenAndUpdate` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getItemLastSeenAndUpdate`(inputitemid int)
BEGIN


select IFNULL(lastseen,'2010-01-01 10:00:00') as user_lastseen from askahgong.transaction_record where itemid=inputitemid;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getItems` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getItems`(processid int,startitem int,limititem int,myuserid int,orderby varchar(20),showpending int,getitemid text)
proc:BEGIN
DECLARE itemidstring text;
DECLARE itemstoselect text;
DECLARE itemid varchar(30);
DECLARE startindex int;
DECLARE concatquery text;
DECLARE concatshortlistquery text;
DECLARE orderbyconcat varchar(200);
DECLARE counter int;
DECLARE concatpendingquery text;
DECLARE itemcount int;

if orderby='' and processid=0 and getitemid='' then
  LEAVE proc;
end if;


if getitemid='0' then
	if processid<>0 then
		select serverrespond into itemidstring from askahgong.processrecord where id=processid;
		select IFNULL(userid,0) into myuserid from askahgong.processrecord where id=processid;
	else
		if orderby='popular' then
			select GROUP_CONCAT(info.id order by trans.viewscounter desc) into itemidstring from askahgong.item_info info,askahgong.transaction_record trans where info.id=trans.itemid and trans.removed=0;
		elseif orderby='friends' then
			select GROUP_CONCAT(info.id order by trans.posttime desc) into itemidstring from askahgong.item_info info,askahgong.transaction_record trans where info.id=trans.itemid and trans.removed=0 and trans.userid IN (select targetuserid from askahgong.contact where fromuserid=myuserid);
		elseif orderby='shortlist' then
			select GROUP_CONCAT(info.id order by trans.posttime desc) into itemidstring from askahgong.item_info info,askahgong.transaction_record trans where info.id=trans.itemid and trans.itemid IN (select short.itemid from askahgong.shortlist short where short.userid=myuserid);
		else
			select GROUP_CONCAT(info.id order by trans.posttime desc) into itemidstring from askahgong.item_info info,askahgong.transaction_record trans where info.id=trans.itemid and trans.userid=myuserid and trans.removed=0;
		end if;
	end if;
else 
	SET itemidstring=getitemid;

end if;


if itemidstring is null or itemidstring='' then
  SET itemidstring=0;
end if;




SET itemstoselect = itemidstring;

SELECT (LENGTH(itemstoselect) - LENGTH(REPLACE(itemstoselect, ',', '')) + 1 ) into itemcount;

if itemstoselect='' then
SET itemstoselect='0';
SET limititem=1;
SET itemcount=1;
end if;




SET concatquery=' ORDER BY CASE info.id '; 
SET counter=1;
doloop:while itemcount>0 DO

select askahgong.SPLIT_STR(itemstoselect,',',counter) into itemid;

if itemid='' then
leave doloop;
else 
SET concatquery=CONCAT(concatquery,' WHEN ',itemid,' THEN ',counter);
end if;
SET itemcount=itemcount-1;
SET counter=counter+1;
end while;
SET concatquery=CONCAT(concatquery,' END');

SET concatshortlistquery=CONCAT('(select count(short.id) from askahgong.shortlist short where short.itemid=info.id and short.userid=',myuserid,')as isshortlist');

if showpending = 1 then
	SET concatpendingquery = '';
else
	SET concatpendingquery = ' and info.pending<>1';
end if;

SET concatquery=CONCAT('select info.*,area.*,',concatshortlistquery,',if(pending=1,(select count(request1.id) as num from askahgong.agent_request request1 where request1.itemid=info.id and request1.targetuserid=',myuserid,'),0) as owner_agent_request,if(pending=1,(select count(request1.id) as num from askahgong.agent_request request1 where request1.itemid=info.id and request1.fromuserid=',myuserid,'),0) as my_agent_request,if(pending=1,(select count(request1.id) as num from askahgong.agent_request request1 left join askahgong.transaction_record trans1 ON request1.itemid=trans1.itemid where request1.fromuserid<>trans1.userid and request1.itemid=info.id),0) as request_count,cat.word,trans.description,trans.moved_marker,trans.smsorweb,trans.posttime,trans.viewscounter,trans.removed,trans.moved_marker,userinfo2.id as original_ownerid,userinfo2.username as original_ownerusername,userinfo.id as userid,userinfo.phone,userinfo.username,userinfo.email,askahgong.getUserStatus(userinfo.id) as isonline,askahgong.checkCanSeePhoneNumber(',myuserid,',userinfo.id) as canseephone,askahgong.getisfriend(',myuserid,',userinfo.id) as isfriend,askahgong.getitemarea(info.id) as areaname,(select group_concat(latitude) from askahgong.item_info_area where itemid=info.id) as latitude,(select group_concat(longitude) from askahgong.item_info_area where itemid=info.id) as longitude from askahgong.item_info info left join askahgong.item_info_area area ON info.id=area.itemid inner join askahgong.category cat ON info.categoryid=cat.id inner join askahgong.transaction_record trans ON trans.itemid=info.id inner join askahgong.user_info userinfo ON trans.userid=userinfo.id left join askahgong.user_info userinfo2 ON trans.original_owner=userinfo2.id where info.id IN (',itemstoselect,') ',concatpendingquery,' group by info.id',concatquery,' LIMIT ',limititem,' OFFSET ',startitem);


	SET @sql_text = concatquery;
	PREPARE stmt FROM @sql_text;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;







END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getMyActivity` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getMyActivity`(lastid int,returnlimit int,myuserid int)
BEGIN

	if lastid=0 then
		select (max(id)+1) into lastid from askahgong.activity;
	end if;

	select activity.*,activity.result as noedit_result, con.username from (
	
		select acvt.*,CONCAT(user.id,'(%2)',user.username,'(%2)',info.type,'(%2)',cat.word,'(%2)',getitemarea(info.id)) as result from askahgong.activity acvt inner join askahgong.item_info info ON acvt.targetid=info.id inner join askahgong.category cat ON cat.id=info.categoryid inner join askahgong.transaction_record trans ON trans.itemid=info.id inner join askahgong.user_info user ON trans.userid=user.id where (trans.userid=myuserid OR trans.userid IN (select targetuserid from askahgong.contact where fromuserid=myuserid)) and acvt.action='newItem'
		UNION
		select acvt.*,CONCAT(user.id,'(%2)',user.username,'(%2)',info.type,'(%2)',cat.word,'(%2)',getitemarea(info.id)) as result from askahgong.activity acvt inner join askahgong.item_info info ON acvt.targetid=info.id inner join askahgong.category cat ON cat.id=info.categoryid inner join askahgong.transaction_record trans ON trans.itemid=info.id inner join askahgong.user_info user ON trans.userid=user.id where (acvt.userid=myuserid) and acvt.action='addShortlist'
		UNION
		select acvt.*,CONCAT(user.id,'(%2)',user.username,'(%2)',info.type,'(%2)',cat.word,'(%2)',getitemarea(info.id)) as result from askahgong.activity acvt inner join askahgong.item_info info ON acvt.targetid=info.id inner join askahgong.category cat ON cat.id=info.categoryid inner join askahgong.transaction_record trans ON trans.itemid=info.id inner join askahgong.user_info user ON trans.userid=user.id where (trans.userid=myuserid OR info.id IN (select itemid from askahgong.shortlist where userid=myuserid)) and (acvt.action='editItem' OR acvt.action='deleteItem')
		UNION
		select acvt.*,user2.username as result from askahgong.activity acvt inner join askahgong.user_info user ON acvt.userid=user.id inner join askahgong.user_info user2 ON acvt.targetid=user2.id where acvt.action='addContact' and acvt.userid=myuserid
		UNION
		select acvt.*,user2.username as result from askahgong.activity acvt inner join askahgong.user_info user ON acvt.userid=user.id inner join askahgong.user_info user2 ON acvt.targetid=user2.id where acvt.action='addContact' and acvt.targetid=myuserid
		UNION
		select acvt.*,topictitle as result from askahgong.activity acvt inner join askahgong.discussiontopic topic ON acvt.targetid=topic.id where (topic.userid=myuserid OR topic.userid IN (select targetuserid from askahgong.contact where fromuserid=myuserid)) and acvt.action='addTopic'
		UNION
		select acvt.*,topictitle as result from askahgong.activity acvt inner join askahgong.discussiontopic topic ON acvt.targetid=topic.id where ((topic.userid<>myuserid and acvt.userid=myuserid)) and acvt.action='replyTopic'
		UNION
		select acvt.*,topictitle as result from askahgong.activity acvt inner join askahgong.discussiontopic topic ON acvt.targetid=topic.id where ((topic.userid=myuserid and acvt.userid=myuserid)) and acvt.action='replyYourTopic'
		UNION
		select acvt.*,user.username as result from askahgong.activity acvt inner join askahgong.user_info user ON acvt.targetid=user.id where (user.id=myuserid OR user.id IN (select targetuserid from askahgong.contact where fromuserid=myuserid)) and acvt.action='updateProfile'
		UNION
		select acvt.*,user.username as result from askahgong.activity acvt inner join askahgong.user_info user ON acvt.targetid=user.id where user.id=myuserid and acvt.action='updateSettings'
		UNION
		select t.id,t.userid,t.action,t.targetid,t.dateandtime,t.private,t.reserved,if(t.userid=myuserid,(select concat(id,'(%2)',username) from askahgong.user_info where id=t.targetid),(select concat(id,'(%2)',username) from askahgong.user_info where id=t.userid)) as result from (select acvt.*,IF(acvt.userid>acvt.targetid,concat(acvt.targetid,',',acvt.userid),concat(acvt.userid,',',acvt.targetid)) as concatid from askahgong.activity acvt where (acvt.userid=myuserid or acvt.targetid=myuserid) and acvt.action='sendMessage' order by dateandtime asc)t group by concatid
		UNION
		select acvt.*,user.username as result from askahgong.activity acvt inner join askahgong.user_info user ON acvt.userid=user.id where acvt.action='register' and acvt.userid=myuserid
		UNION
		select acvt.*,CONCAT(info.id,'(%2)',info.username,'(%2)',info2.id,'(%2)',info2.username,'(%2)',(select CONVERT(COUNT(id), CHAR) from askahgong.agent_comment_thread where id>thread.id and agent_id=thread.agent_id)) as result from askahgong.activity acvt inner join askahgong.agent_comment_thread thread ON acvt.targetid=thread.id inner join askahgong.user_info info ON thread.userid=info.id inner join askahgong.user_info info2 ON thread.agent_id=info2.id where acvt.action='agentReview' and (acvt.userid=myuserid OR thread.agent_id=myuserid)


	) as activity inner join askahgong.user_info con ON activity.userid=con.id
      where activity.id<lastid and activity.dateandtime>=(select registerdate from askahgong.user_info where id=myuserid)  
	  ORDER BY activity.id desc LIMIT returnlimit;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getNewUserActions` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getNewUserActions`(lastavtid int,lastnewitemnotfid int)
BEGIN
	
	
	/*someone reply topic owner*/
	select avt.id,avt.action as type,
	topic.userid as useridlist,
	topic.id as textresult,
	topic.id as numberresult,
	avt.userid as userid
	from askahgong.activity avt
	inner join askahgong.discussiontopic topic ON avt.targetid=topic.id
	where avt.action='replyTopic'
	and avt.id>lastavtid
	UNION
	/*someone reply topic commenter*/
	select avt.id,avt.action as type,
	group_concat(cmt.userid) as useridlist,
	topic.id as textresult,
	topic.id as numberresult,
	avt.userid as userid
	from askahgong.activity avt
	inner join askahgong.discussiontopic topic ON avt.targetid=topic.id
	inner join askahgong.discussioncomment cmt ON cmt.topicid=topic.id
	where avt.action='replyTopic' and cmt.dateandtime<=avt.dateandtime
	and avt.id>lastavtid
	GROUP BY cmt.userid
	UNION
	/*someone edit/remove item*/
	select avt.id,avt.action as type,
	group_concat(short.userid) as useridlist,
	short.itemid as textresult,
	short.itemid as numberresult,
	avt.userid as userid
	from askahgong.activity avt 
	inner join askahgong.shortlist short ON avt.targetid=short.itemid
	where (avt.action='deleteItem' OR avt.action='editItem')
    and avt.id>lastavtid and short.dateandtime<avt.dateandtime
	GROUP BY short.userid
	UNION
	/*new agent request/agent request accepted*/
	select avt.id,avt.action as type,
	IF(avt.userid=req.fromuserid,req.targetuserid,req.fromuserid) as useridlist,
	'' as textresult,
	avt.targetid as numberresult,
	avt.userid as userid
	from askahgong.activity avt
	left join askahgong.agent_request req ON avt.reserved=req.id
	where (avt.action='agentRequest' OR avt.action='acceptAgent')
	and avt.id>lastavtid
	UNION
	/*new agent review*/
	select avt.id,avt.action as type,
	thread.agent_id as useridlist,
	thread.content as textresult,
	avt.targetid as numberresult,
	avt.userid as userid
	from askahgong.activity avt
	left join askahgong.agent_comment_thread thread ON avt.targetid=thread.id
	where avt.action='agentReview'
	and avt.id>lastavtid
	UNION
	/*agent review reply*/
	select avt.id,avt.action as type,
	IF(avt.userid=thread.agent_id,(select id from askahgong.agent_comment_reply where userid<>thread.agent_id LIMIT 1),thread.agent_id) as useridlist,
	reply.content as textresult,
	avt.targetid as numberresult,
	avt.userid as userid
	from askahgong.activity avt
	left join askahgong.agent_comment_reply reply ON avt.targetid=reply.id
	left join askahgong.agent_comment_thread thread ON reply.thread_id=thread.id
	where avt.action='agentReviewReply'
	and avt.id>lastavtid
	UNION
	/*someone check notification*/
	select avt.id,avt.action as type,
	avt.userid as useridlist,
	'' as textresult,
	'0' as numberresult,
	avt.userid as userid
	from askahgong.activity avt
	where avt.action='checkNotification'
	and avt.id>lastavtid
	UNION
	/*someone logout*/
	select avt.id,avt.action as type,
	avt.userid as useridlist,
	'' as textresult,
	'0' as numberresult,
	avt.userid as userid
	from askahgong.activity avt
	where avt.action='logout'
	and avt.id>lastavtid
	UNION
	/*new item added need to notify user*/
	select web.id,'newItem' as type,
	web.userid as useridlist,
	'' as textresult,
	web.itemid as numberresult,
	'0' as userid
	from askahgong.web_notification_new_item web
	where web.id>lastnewitemnotfid
	UNION
	/*force send ahgong message using web server*/
	select avt.id,avt.action as type,
	avt.targetid as useridlist,
	info.username as textresult,
	'0' as numberresult,
	avt.userid as userid
	from askahgong.activity avt
	inner join askahgong.user_info info
	ON avt.userid=info.id
	where avt.action='sendMessage'
	and avt.reserved IS NOT NULL and avt.reserved!='';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getNotYetProcessedItem` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getNotYetProcessedItem`()
BEGIN

	select targetid from askahgong.activity where action='newItem' and (ISNULL(reserved) OR reserved=0);
	update askahgong.activity set reserved=1 where action='newItem' and (ISNULL(reserved) OR reserved=0);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getPastConversationList` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getPastConversationList`(IN inputuserid int)
BEGIN
	
	select *,askahgong.getUserStatus(targetuserid) as isonline from(
		select t.id,t.message,t.targetuserid,t.fromuserid as lastmessageowner,
		IFNULL(
				(
				select count(newmessage) from askahgong.message where fromuserid=t.targetuserid
				and touserid=inputuserid and newmessage<>0),
			  0) as newmessage,
			user.username 
			from(
			SELECT msg.* ,touserid as targetuserid
				FROM (
					SELECT max(id) as id
								 FROM askahgong.message
								WHERE fromuserid=inputuserid
								GROUP BY touserid
				)t1
				inner join askahgong.message msg
				 ON msg.id=t1.id 
			UNION
			SELECT msg.* ,fromuserid as targetuserid
			FROM (
				SELECT max(id) as id
							 FROM askahgong.message
							WHERE touserid=inputuserid
							GROUP BY fromuserid
				)t1
				INNER JOIN askahgong.message msg
				ON msg.id = t1.id order by id desc
			)t inner join askahgong.user_info user ON t.targetuserid=user.id group by t.targetuserid 
	)z order by z.newmessage desc,z.id desc;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getPeopleActivity` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getPeopleActivity`(lastid int,returnlimit int,myuserid int,otherpeopleid int)
BEGIN

	if lastid=0 then
		select (max(id)+1) into lastid from askahgong.activity;
	end if;

	select activity.*,activity.result as noedit_result, con.username from (
	
		select acvt.*,CONCAT(user.id,'(%2)',user.username,'(%2)',info.type,'(%2)',cat.word,'(%2)',getitemarea(info.id)) as result from askahgong.activity acvt inner join askahgong.item_info info ON acvt.targetid=info.id inner join askahgong.category cat ON cat.id=info.categoryid inner join askahgong.transaction_record trans ON trans.itemid=info.id inner join askahgong.user_info user ON trans.userid=user.id where trans.userid=otherpeopleid and ((acvt.action='newItem' and trans.removed=0) OR acvt.action='editItem' OR acvt.action='deleteItem') and (acvt.userid=otherpeopleid or acvt.userid=myuserid)
		UNION
		select acvt.*,topictitle as result from askahgong.activity acvt inner join askahgong.discussiontopic topic ON acvt.targetid=topic.id where topic.userid=otherpeopleid and acvt.action='addTopic'
		UNION
		select acvt.*,topictitle as result from askahgong.activity acvt inner join askahgong.discussiontopic topic ON acvt.targetid=topic.id where ((topic.userid=myuserid and acvt.userid=otherpeopleid) OR (topic.userid=otherpeopleid and acvt.userid=myuserid)) and acvt.action='replyTopic'
		UNION
		select acvt.*,user2.username as result from askahgong.activity acvt inner join askahgong.user_info user ON acvt.userid=user.id inner join askahgong.user_info user2 ON acvt.targetid=user2.id and ((acvt.targetid=myuserid and acvt.userid=otherpeopleid) OR (acvt.targetid=otherpeopleid and acvt.userid=myuserid)) where acvt.action='addContact'
		UNION
		select acvt.*,user.username as result from askahgong.activity acvt inner join askahgong.user_info user ON acvt.targetid=user.id where (user.id=otherpeopleid) and acvt.action='updateProfile'
		UNION
		select t.id,t.userid,t.action,t.targetid,t.dateandtime,t.private,t.reserved,if(t.userid=myuserid,(select concat(id,'(%2)',username) from askahgong.user_info where id=t.targetid),(select concat(id,'(%2)',username) from askahgong.user_info where id=t.userid)) as result from (select acvt.*,IF(acvt.userid>acvt.targetid,concat(acvt.targetid,',',acvt.userid),concat(acvt.userid,',',acvt.targetid)) as concatid from askahgong.activity acvt where ((acvt.userid=myuserid and acvt.targetid=otherpeopleid) OR (acvt.userid=otherpeopleid and acvt.targetid=myuserid)) and acvt.action='sendMessage' order by dateandtime desc)t group by concatid
		UNION
		select acvt.*,user.username as result from askahgong.activity acvt inner join askahgong.user_info user ON acvt.userid=user.id where acvt.action='register' and acvt.userid=otherpeopleid
		UNION
		select acvt.*,CONCAT(info.id,'(%2)',info.username,'(%2)',info2.id,'(%2)',info2.username,'(%2)',(select CONVERT(COUNT(id), CHAR) from askahgong.agent_comment_thread where id>thread.id and agent_id=thread.agent_id)) as result from askahgong.activity acvt inner join askahgong.agent_comment_thread thread ON acvt.targetid=thread.id inner join askahgong.user_info info ON thread.userid=info.id inner join askahgong.user_info info2 ON thread.agent_id=info2.id where acvt.action='agentReview' and acvt.userid=otherpeopleid


	) as activity inner join askahgong.user_info con ON activity.userid=con.id where activity.id<lastid ORDER BY activity.id desc LIMIT returnlimit;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getSingleItemFullData` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `getSingleItemFullData`(inputitemid int)
BEGIN
select info.*,prop.nearby as nearbyprop,prop.facility as facilityprop,cat.word,
trans.description,trans.smsorweb,trans.posttime,trans.viewscounter,userinfo.id as userid,
userinfo.phone,userinfo.username,askahgong.getUserStatus(userinfo.id) as isonline,askahgong.getitemarea(info.id) as areaname,
(select GROUP_CONCAT(facts.fact SEPARATOR '(%2)') from askahgong.randomfacts facts where facts.itemid=info.id and facts.userprovide='1') as randomfacts,
marks.facilityjson,marks.areajson,marks.areacoordinatesjson,marks.bonusjson,marks.areacategory,(IFNULL(marks.areamarks,-1)) as areamarks,(IFNULL(marks.facilitymarks,-1)) as facilitymarks,IFNULL(marks.bonusmarks,-1) as bonusmarks,FORMAT((IFNULL(marks.facilitymarks,-10000)*prop.facility)+(IFNULL(marks.areamarks,-10000)*prop.nearby),0)as totalmarks,
(select group_concat(latitude) from askahgong.item_info_area where itemid=info.id) as latitude,(select group_concat(longitude) from askahgong.item_info_area where itemid=info.id) as longitude from askahgong.item_info info inner join askahgong.category cat ON info.categoryid=cat.id inner join askahgong.transaction_record trans ON trans.itemid=info.id 
inner join askahgong.user_info userinfo ON trans.userid=userinfo.id left join askahgong.itemmarks marks ON marks.itemid=info.id left join askahgong.marksproportion prop ON prop.type='1' where info.id=inputitemid;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_unread_points` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `get_unread_points`(points_id int)
BEGIN
	SELECT t.*,
		   IF(lvl.level-1=0,1,lvl.level) as level,
		   askahgong.getRealNextLevelExpNeeded(lvl.level) as noedit_nextlevelpoints,
		   t.current_points - IFNULL(lvl3.points,0) as noedit_current_points
	from(
	SELECT 
		log.*,
		reason.title,
		CONCAT(topic.id,'(%2)',cmt.id,'(%2)',(select getPageByCommentID(cmt.id)),'(%2)',topic.topictitle) as extra
	FROM 
		askahgong.points_log log
	LEFT JOIN
		askahgong.points_reason reason
	ON
		log.reason_id=reason.id
	LEFT JOIN
		askahgong.discussioncomment cmt
	ON 	
		log.reserved=cmt.id
	LEFT JOIN
		askahgong.discussiontopic topic
	ON 	
		topic.id=cmt.topicid
	where 
		log.read=0 and log.id=points_id and (log.reason_id=4 OR log.reason_id=5)
	UNION
	
	SELECT 
		log.*,
		reason.title,
		CONCAT(topic.id,'(%2)',topic.topictitle) as extra
	FROM 
		askahgong.points_log log
	LEFT JOIN
		askahgong.points_reason reason
	ON
		log.reason_id=reason.id
	LEFT JOIN
		askahgong.discussiontopic topic
	ON 	
		log.reserved=topic.id
	where 
		log.read=0 and log.id=points_id and (log.reason_id=9)
	UNION

	SELECT 
		log.*,
		reason.title,
		'' as extra
	FROM 
		askahgong.points_log log
	LEFT JOIN
		askahgong.points_reason reason
	ON
		log.reason_id=reason.id
	WHERE 
		log.read=0 and log.id=points_id and (log.reason_id<>9 and log.reason_id<>4 and log.reason_id<>5)
	)t
	LEFT JOIN 
		askahgong.level_requirement lvl
	ON lvl.points=(select min(points) from askahgong.level_requirement where points>t.current_points)
	LEFT JOIN 
		askahgong.level_requirement lvl3
	ON lvl3.level=lvl.level-1;

	
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_distance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `update_distance`()
BEGIN
	update askahgong.landmark set distance='4' where category='Academic Center';
	update askahgong.landmark set distance='5' where category='Bank';
	update askahgong.landmark set distance='4' where category='Big Entertainment Center';
	update askahgong.landmark set distance='6' where category='Big Shopping Mall';
	update askahgong.landmark set distance='5' where category='Bill Payment';
	update askahgong.landmark set distance='1.5' where category='Bus Station';
	update askahgong.landmark set distance='8' where category='Bus Terminal';
	update askahgong.landmark set distance='4' where category='Church';
	update askahgong.landmark set distance='4' where category='Clinic';
	update askahgong.landmark set distance='5' where category='College';
	update askahgong.landmark set distance='2' where category='Convenience Store';
	update askahgong.landmark set distance='10' where category='Custom';
	update askahgong.landmark set distance='15' where category='Custom 2';
	update askahgong.landmark set distance='5' where category='Dental';
	update askahgong.landmark set distance='5' where category='Fast Food';
	update askahgong.landmark set distance='3' where category='Food Place';
	update askahgong.landmark set distance='6' where category='Golf Club Resort';
	update askahgong.landmark set distance='5' where category='Government Agency';
	update askahgong.landmark set distance='4' where category='Gym and Fitness Center';
	update askahgong.landmark set distance='7' where category='Highway';
	update askahgong.landmark set distance='8' where category='Hospital';
	update askahgong.landmark set distance='4' where category='Kindergarten';
	update askahgong.landmark set distance='4' where category='Kuil';
	update askahgong.landmark set distance='5' where category='Library';
	update askahgong.landmark set distance='5' where category='Luxury Hotel';
	update askahgong.landmark set distance='4' where category='Market';
	update askahgong.landmark set distance='5' where category='Medium Shopping Mall';
	update askahgong.landmark set distance='4' where category='Mosque';
	update askahgong.landmark set distance='5' where category='Other Government Agency';
	update askahgong.landmark set distance='6' where category='Petrol Station';
	update askahgong.landmark set distance='5' where category='Pharmacy';
	update askahgong.landmark set distance='5' where category='Police and Fire Station';
	update askahgong.landmark set distance='5' where category='Post Office';
	update askahgong.landmark set distance='5' where category='Railway Terminal';
	update askahgong.landmark set distance='4' where category='School';
	update askahgong.landmark set distance='4' where category='Small Entertainment Center';
	update askahgong.landmark set distance='4' where category='Small Shopping Mall';
	update askahgong.landmark set distance='4' where category='Spa and Massage';
	update askahgong.landmark set distance='5' where category='Sport Facility';
	update askahgong.landmark set distance='5' where category='Sport Complex';	
	update askahgong.landmark set distance='4' where category='TCM';
	update askahgong.landmark set distance='4' where category='Temple';
	update askahgong.landmark set distance='8' where category='Tourist Location';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `activity_view`
--

/*!50001 DROP TABLE IF EXISTS `activity_view`*/;
/*!50001 DROP VIEW IF EXISTS `activity_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `activity_view` AS select `activity`.`id` AS `id`,`activity`.`userid` AS `userid`,`activity`.`action` AS `action`,`activity`.`targetid` AS `targetid`,`activity`.`dateandtime` AS `dateandtime`,`activity`.`private` AS `private` from `activity` order by `activity`.`id` desc limit 30 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `process_record_view`
--

/*!50001 DROP TABLE IF EXISTS `process_record_view`*/;
/*!50001 DROP VIEW IF EXISTS `process_record_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `process_record_view` AS select `processrecord`.`id` AS `id`,`processrecord`.`text` AS `text`,`processrecord`.`userid` AS `userid`,`processrecord`.`smsorweb` AS `smsorweb`,`processrecord`.`userrespond` AS `userrespond`,`processrecord`.`status` AS `status`,`processrecord`.`waitingcode` AS `waitingcode`,`processrecord`.`serverrespond` AS `serverrespond`,`processrecord`.`dateandtime` AS `dateandtime`,`processrecord`.`serversentmessage` AS `serversentmessage`,`processrecord`.`resultcontentstring` AS `resultcontentstring`,`processrecord`.`learncount` AS `learncount`,`processrecord`.`learnqueue` AS `learnqueue` from `processrecord` order by `processrecord`.`id` desc limit 50 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `transaction_record_view`
--

/*!50001 DROP TABLE IF EXISTS `transaction_record_view`*/;
/*!50001 DROP VIEW IF EXISTS `transaction_record_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `transaction_record_view` AS select `transaction_record`.`id` AS `id`,`transaction_record`.`userid` AS `userid`,`transaction_record`.`posttime` AS `posttime`,`transaction_record`.`description` AS `description`,`transaction_record`.`convertdescription` AS `convertdescription`,`transaction_record`.`itemid` AS `itemid`,`transaction_record`.`viewscounter` AS `viewscounter`,`transaction_record`.`smsorweb` AS `smsorweb`,`transaction_record`.`modified` AS `modified`,`transaction_record`.`lastseen` AS `lastseen`,`transaction_record`.`removed` AS `removed` from `transaction_record` order by `transaction_record`.`id` desc limit 50 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-08-18 16:41:20
