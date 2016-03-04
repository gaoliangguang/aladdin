/*业务配置记录表  2016-2-24*/
CREATE TABLE IF NOT EXISTS `t_config_common` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(20) NOT NULL COMMENT '标签名字(前缀可使用控制器名称),json格式',
  `config` varchar(255) NOT NULL,
  `update` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_LABEL` (`label`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='业务自定义配置';

