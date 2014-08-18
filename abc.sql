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

-- Dump completed on 2014-08-18 16:32:32
