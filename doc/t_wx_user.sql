-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: 112.74.19.227:3306
-- Generation Time: 2016-02-29 19:26:05
-- 服务器版本： 5.6.23-log
-- PHP Version: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aladdin`
--

-- --------------------------------------------------------

--
-- 表的结构 `t_wx_user`
--

CREATE TABLE IF NOT EXISTS `t_wx_user` (
  `ID` int(11) NOT NULL,
  `mqID` char(32) NOT NULL COMMENT '统一用户id',
  `openid` char(32) NOT NULL COMMENT '微信openid',
  `nickname` varchar(256) NOT NULL COMMENT '微信昵称',
  `sex` tinyint(3) NOT NULL DEFAULT '0' COMMENT '性别',
  `language` char(20) NOT NULL COMMENT '语言',
  `city` varchar(64) NOT NULL COMMENT '城市',
  `province` varchar(64) NOT NULL COMMENT '省',
  `country` varchar(64) NOT NULL COMMENT '区',
  `headimgurl` varchar(500) NOT NULL COMMENT '头像url',
  `subscribeTime` int(11) NOT NULL COMMENT 'subscribeTime',
  `unionid` char(32) NOT NULL COMMENT '微信unionid',
  `remark` varchar(625) NOT NULL COMMENT '备注',
  `subscribe` tinyint(3) DEFAULT '-1' COMMENT 'subscribe',
  `groupid` int(10) NOT NULL COMMENT 'groupid',
  `privilege` text COMMENT 'privilege',
  `addTime` datetime DEFAULT NULL COMMENT '添加时间',
  `updateTime` datetime DEFAULT NULL COMMENT 'update_time',
  `qrTicket` varchar(1000) DEFAULT NULL COMMENT 'qrTicket',
  `qrExpireSeconds` int(10) DEFAULT NULL COMMENT 'qrExpireSeconds',
  `qrCreateTime` int(11) DEFAULT NULL COMMENT 'qrCreateTime'
) ENGINE=InnoDB AUTO_INCREMENT=1064 DEFAULT CHARSET=utf8 COMMENT='微信用户表,记录用户中微信的一些信息';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_wx_user`
--
ALTER TABLE `t_wx_user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `wx_user_openid_index` (`openid`),
  ADD UNIQUE KEY `wx_user_unionid_index` (`unionid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_wx_user`
--
ALTER TABLE `t_wx_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1064;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
