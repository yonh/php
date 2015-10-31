create database `server_ui`;
use `server_ui`;

CREATE TABLE `vhost` (
  `id` int(11) primary key AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' comment 'website name',
  `git` varchar(100) NOT NULL DEFAULT '' comment 'git ssh url',
  `domain_name` varchar(50) NOT NULL DEFAULT '' comment 'domain name',
  `document_root` varchar(50) NOT NULL COMMENT 'deployer dir',
  `vhost_conf_file` varchar(50) NOT NULL COMMENT 'apache vhost config file'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='vhost';

