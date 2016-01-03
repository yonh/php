-- Current Database: `server_ui`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `server_ui` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `server_ui`;

--
-- Table structure for table `backup`
--

DROP TABLE IF EXISTS `backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT 'vhost id',
  `ctime` int(11) NOT NULL COMMENT 'create time',
  `filename` varchar(50) NOT NULL COMMENT '备份文件名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='backup record';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup`
--


DROP TABLE IF EXISTS `vhost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vhost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT 'website name',
  `git` varchar(100) NOT NULL DEFAULT '' COMMENT 'git ssh url',
  `domain_name` varchar(50) NOT NULL DEFAULT '' COMMENT 'domain name',
  `document_root` varchar(50) NOT NULL COMMENT 'deployer dir',
  `vhost_conf_file` varchar(50) NOT NULL COMMENT 'apache vhost config file',
  `is_running` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否运行中',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='vhost';
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `reject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` char(15) NOT NULL COMMENT 'ip',
  `deadline` int(11) NOT NULL COMMENT '过期时间,0为不限时',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  `state` tinyint(1) NOT NULL COMMENT '状态 1有效 0无效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='拒绝登录列表';
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `login_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` char(15) NOT NULL COMMENT 'ip',
  `uid` varchar(20) not null comment '登录uid',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  `state` tinyint(1) not null comment '0失败 1成功',
  `remark` varchar(20) comment '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='登录日志';

