/*
Navicat MySQL Data Transfer

Source Server         : MyConnect
Source Server Version : 50709
Source Host           : localhost:3306
Source Database       : deliverroom

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2020-05-23 00:04:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bed
-- ----------------------------
DROP TABLE IF EXISTS `bed`;
CREATE TABLE `bed` (
  `bed_id` varchar(5) NOT NULL,
  `state` varchar(5) DEFAULT NULL,
  `rank` varchar(5) DEFAULT NULL,
  `mat_id` varchar(5) DEFAULT NULL,
  `nur_id` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`bed_id`),
  KEY `bmat_id` (`mat_id`),
  KEY `bnur_id` (`nur_id`),
  CONSTRAINT `bmat_id` FOREIGN KEY (`mat_id`) REFERENCES `maternal` (`mat_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `bnur_id` FOREIGN KEY (`nur_id`) REFERENCES `nurse` (`nur_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bed
-- ----------------------------
INSERT INTO `bed` VALUES ('01', '占用', '普通', '2001', '3001');
INSERT INTO `bed` VALUES ('02', '占用', '普通', '2002', '3002');
INSERT INTO `bed` VALUES ('03', '占用', '普通', '2007', null);
INSERT INTO `bed` VALUES ('04', '占用', '普通', '2004', '3004');
INSERT INTO `bed` VALUES ('05', '空闲', '普通', null, null);
INSERT INTO `bed` VALUES ('06', '占用', '普通', '2005', '3005');
INSERT INTO `bed` VALUES ('07', '占有', '普通', '2003', '3004');
INSERT INTO `bed` VALUES ('08', '空闲', 'VIP', null, null);
INSERT INTO `bed` VALUES ('09', '空闲', 'VIP', null, null);
INSERT INTO `bed` VALUES ('10', '空闲', 'VIP', null, null);
INSERT INTO `bed` VALUES ('11', '空闲', 'VIP', null, null);
INSERT INTO `bed` VALUES ('12', '占用', 'VIP', '2006', '3006');

-- ----------------------------
-- Table structure for doctor
-- ----------------------------
DROP TABLE IF EXISTS `doctor`;
CREATE TABLE `doctor` (
  `doc_id` varchar(20) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `age` varchar(20) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of doctor
-- ----------------------------
INSERT INTO `doctor` VALUES ('1001', '大鼠', '男', '30', '主任医师', '123456');
INSERT INTO `doctor` VALUES ('1002', '大牛', '女', '25', '副主任医师', '1231342');
INSERT INTO `doctor` VALUES ('1003', '大虎', '男', '27', '主治医师', '234234234');
INSERT INTO `doctor` VALUES ('1004', '大兔', '女', '42', '住院医师', '234234234');
INSERT INTO `doctor` VALUES ('1005', '大龙', '女', '38', '主治医师', '312313');
INSERT INTO `doctor` VALUES ('1006', '大蛇', '女', '48', '住院医师', '12313213');

-- ----------------------------
-- Table structure for maternal
-- ----------------------------
DROP TABLE IF EXISTS `maternal`;
CREATE TABLE `maternal` (
  `mat_id` varchar(20) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `age` varchar(20) DEFAULT NULL,
  `condition` varchar(20) DEFAULT NULL,
  `doc_id` varchar(20) DEFAULT NULL,
  `picture` varchar(30) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`mat_id`),
  KEY `mdoc_id` (`doc_id`),
  CONSTRAINT `mdoc_id` FOREIGN KEY (`doc_id`) REFERENCES `doctor` (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of maternal
-- ----------------------------
INSERT INTO `maternal` VALUES ('2001', '小鼠', '22', '产后观察', '1001', '1559874038timg.jpg', '2019-04-05', '123132132');
INSERT INTO `maternal` VALUES ('2002', '小牛', '30', '产后观察', '1002', '1559484963timg.jpg', '2019-12-02', '1223131');
INSERT INTO `maternal` VALUES ('2003', '小虎', '28', '转出病床', '1003', '1560220267girl.png', '2019-01-14', '12313123');
INSERT INTO `maternal` VALUES ('2004', '小兔', '21', '分娩中', '1004', '1560213907girl.png', '2019-06-12', '123131231');
INSERT INTO `maternal` VALUES ('2005', '小龙', '24', '产后观察', null, '1560218401girl.png', '2019-06-30', '12313131');
INSERT INTO `maternal` VALUES ('2006', '小蛇', '25', '分娩中', null, '1560218453girl.png', '2019-06-16', '13123131');
INSERT INTO `maternal` VALUES ('2007', '小马', '33', '分娩中', null, '1560221692girl.png', '2019-06-12', '12313123');
INSERT INTO `maternal` VALUES ('2008', '小羊', '36', null, null, null, null, '1231313');
INSERT INTO `maternal` VALUES ('2009', '小猴', '23', null, null, null, null, '131313123');
INSERT INTO `maternal` VALUES ('2010', '小鸡', '25', null, null, null, null, '12312312');
INSERT INTO `maternal` VALUES ('2011', '小狗', '38', null, null, null, null, '13212313');
INSERT INTO `maternal` VALUES ('2012', '小猪', '47', null, null, null, null, '123132231');

-- ----------------------------
-- Table structure for nurse
-- ----------------------------
DROP TABLE IF EXISTS `nurse`;
CREATE TABLE `nurse` (
  `nur_id` varchar(20) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `age` varchar(20) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`nur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of nurse
-- ----------------------------
INSERT INTO `nurse` VALUES ('3001', '中鼠', '25', '初级护士', '123456');
INSERT INTO `nurse` VALUES ('3002', '中牛', '32', '初级护师', '123456');
INSERT INTO `nurse` VALUES ('3003', '中虎', '27', '初级护师', '123456');
INSERT INTO `nurse` VALUES ('3004', '中兔', '27', '初级护士', '123456');
INSERT INTO `nurse` VALUES ('3005', '中龙', '54', '副主任护师', '123456');
INSERT INTO `nurse` VALUES ('3006', '中蛇', '53', '主任护师', '123456');
INSERT INTO `nurse` VALUES ('3007', '中马', '36', '中级护士', '123456');
INSERT INTO `nurse` VALUES ('3008', '中羊', '23', '初级护师', '123456');
INSERT INTO `nurse` VALUES ('3009', '中猴', '24', '初级护士', '123456');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password` varchar(40) CHARACTER SET utf8 NOT NULL,
  `join_date` datetime DEFAULT NULL,
  `telephone` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `gender` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `realname` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `picture` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('14', '456', '51eac6b471a284d3341d8c0c63d0f1a286262a18', '2019-05-29 21:02:51', '123', '456', 'M', '1999-02-16', '564', 'alexpic.jpg');
INSERT INTO `user` VALUES ('15', '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2019-05-29 21:09:50', '17376598653', 'vol.3@icloud.com', 'M', '1996-09-16', '898', 'belitapic.jpg');
INSERT INTO `user` VALUES ('16', '789', 'fc1200c7a7aa52109d762a9f005b149abef01479', '2019-05-29 21:11:34', '156', 'Evans.Taylor@hotmail.com', 'M', '1989-09-12', 'abr', 'nevilpic.jpg');
INSERT INTO `user` VALUES ('18', '333', '43814346e21444aaf4f70841bf7ed5ae93f55a9d', '2019-06-03 10:39:55', '17376590916', '751788824@qq.com', 'F', '1999-08-16', '568', 'belitapic.jpg');
INSERT INTO `user` VALUES ('23', 'Shaw', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2019-06-11 10:50:36', '13737268051', '751788824@qq.com', 'M', '1999-02-16', '123', 'girl.png');
INSERT INTO `user` VALUES ('24', 'Anone', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-10-14 18:42:06', null, null, null, null, null, null);
