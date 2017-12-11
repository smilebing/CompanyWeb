/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50628
Source Host           : localhost:3306
Source Database       : company

Target Server Type    : MYSQL
Target Server Version : 50628
File Encoding         : 65001

Date: 2017-12-11 19:48:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titile` text NOT NULL,
  `subtitle` text,
  `content` text,
  `createTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `author` varchar(255) DEFAULT NULL,
  `articleType` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', 'what', 'a', '<p><span style=\"font-size: 36px;\">Current Promotions</span></p><p><span style=\"font-size: 16px;\">product A&nbsp;</span><br/></p><p><span style=\"font-size: 16px;\">product B</span></p><p><span style=\"font-size: 16px;\"><img src=\"/ueditor/php/upload/image/20171023/1508767133885871.jpg\" title=\"1508767133885871.jpg\" alt=\"16358PIC4ek_1024.jpg\" width=\"325\" height=\"264\"/></span></p><p><span style=\"font-size: 16px;\"><br/></span></p><p><span style=\"font-size: 16px;\">other file</span></p><p><span style=\"font-size: 16px;\"></span></p><p style=\"line-height: 16px;\"><img src=\"http://localhost/Company/admin/ueditor/dialogs/attachment/fileTypeImages/icon_jpg.gif\"/><a style=\"font-size:12px; color:#0066cc;\" href=\"/ueditor/php/upload/file/20171023/1508767182740426.jpg\" title=\"19369522_144003250002_2.jpg\">19369522_144003250002_2.jpg</a></p><p style=\"line-height: 16px;\"><img src=\"http://localhost/Company/admin/ueditor/dialogs/attachment/fileTypeImages/icon_pdf.gif\"/><a style=\"font-size:12px; color:#0066cc;\" href=\"/ueditor/php/upload/file/20171023/1508767182637990.pdf\" title=\"spec of HA (1.8-2.2M).pdf\">spec of HA (1.8-2.2M).pdf</a></p><p style=\"line-height: 16px;\"><img src=\"http://localhost/Company/admin/ueditor/dialogs/attachment/fileTypeImages/icon_jpg.gif\"/><a style=\"font-size:12px; color:#0066cc;\" href=\"/ueditor/php/upload/file/20171023/1508767182379581.jpg\" title=\"21254676_173145455738_2.jpg\">21254676_173145455738_2.jpg</a></p><p style=\"line-height: 16px;\">这个区域是可以进行编辑的，<strong>可以随意排班样式，增加附件下载，增加图片，就像使用word一样，可以任意进行编辑。</strong></p><p style=\"line-height: 16px;\"><strong>这里可以插入</strong></p><table width=\"-201\"><tbody><tr class=\"ue-table-interlace-color-single firstRow\"><td width=\"180\" valign=\"top\" style=\"word-break: break-all; border-width: 1px; border-style: solid;\">1</td><td width=\"180\" valign=\"top\" style=\"word-break: break-all; border-width: 1px; border-style: solid;\">2</td><td width=\"180\" valign=\"top\" style=\"word-break: break-all; border-width: 1px; border-style: solid;\">3</td><td width=\"180\" valign=\"top\" style=\"word-break: break-all; border-width: 1px; border-style: solid;\">7</td></tr><tr class=\"ue-table-interlace-color-double\"><td width=\"180\" valign=\"top\" style=\"word-break: break-all; border-width: 1px; border-style: solid;\">4</td><td width=\"180\" valign=\"top\" style=\"word-break: break-all; border-width: 1px; border-style: solid;\">5</td><td width=\"180\" valign=\"top\" style=\"word-break: break-all; border-width: 1px; border-style: solid;\">6</td><td width=\"180\" valign=\"top\" style=\"word-break: break-all; border-width: 1px; border-style: solid;\">8</td></tr><tr class=\"ue-table-interlace-color-single\"><td width=\"180\" valign=\"top\" style=\"border-width: 1px; border-style: solid;\"><br/></td><td width=\"180\" valign=\"top\" style=\"border-width: 1px; border-style: solid;\"><br/></td><td width=\"180\" valign=\"top\" style=\"border-width: 1px; border-style: solid;\"><br/></td><td width=\"180\" valign=\"top\" style=\"border-width: 1px; border-style: solid;\"><br/></td></tr><tr class=\"ue-table-interlace-color-double\"><td width=\"180\" valign=\"top\" style=\"border-width: 1px; border-style: solid;\"><br/></td><td width=\"180\" valign=\"top\" style=\"border-width: 1px; border-style: solid;\"><br/></td><td width=\"180\" valign=\"top\" style=\"border-width: 1px; border-style: solid;\"><br/></td><td width=\"180\" valign=\"top\" style=\"border-width: 1px; border-style: solid;\"><br/></td></tr><tr class=\"ue-table-interlace-color-single\"><td width=\"180\" valign=\"top\" style=\"border-width: 1px; border-style: solid;\"><br/></td><td width=\"180\" valign=\"top\" style=\"border-width: 1px; border-style: solid;\"><br/></td><td width=\"180\" valign=\"top\" style=\"border-width: 1px; border-style: solid;\"><br/></td><td width=\"180\" valign=\"top\" style=\"border-width: 1px; border-style: solid;\"><br/></td></tr></tbody></table><p style=\"line-height: 16px;\"><strong>表格</strong><br/></p><p><span style=\"font-size: 16px;\"><br/></span><br/></p>', '2017-10-24 21:28:51', 'admin', 'promotions');
INSERT INTO `article` VALUES ('2', 'what', 'a', '<p class=\"MsoListParagraph\" style=\"margin-left:24px;text-indent:0\"><img src=\"/ueditor/php/upload/image/20171022/1508641176365247.jpg\" title=\"1508641176365247.jpg\" alt=\"1508641176365247.jpg\" width=\"600\" height=\"230\"/><br/></p><p style=\"text-indent:28px;line-height:150%\"><br/></p><p style=\"text-indent:28px;line-height:150%\"><span style=\"font-family: Lato;\">Welcome to Suzhou MHW Chemical Co., Ltd.<br/></span></p><p style=\"text-indent:28px;line-height:150%\"><br/></p><p style=\"text-indent:28px;line-height:150%\"><span style=\"font-family: Lato;\">We are specializing in developing, marketing and distributing ingredients and products for nutraceuticals, supplements and cosmetics industries from the professional manufacturers in China.</span></p><p style=\"text-indent:28px;line-height:150%\"><br/></p><p style=\"text-indent:28px;line-height:150%\"><span style=\"font-family: Lato;\">Our company owns superb management mode, gathering a group of professional researching and marketing staff based on doctors and masters as the backbone, who have many years&#39; experience.</span></p><p style=\"text-indent:28px;line-height:150%\"><br/></p><p style=\"text-indent:28px;line-height:150%\"><span style=\"font-family: Lato;\">Our products largely are exported to America, Japan and Europe, etc., and have won praise from customers at home and abroad regarding as excellent quality and best service.</span></p><p><br/></p>', '2017-11-01 20:18:59', 'admin', 'aboutus');
INSERT INTO `article` VALUES ('3', 'what', 'a', '<p class=\"MsoListParagraph\" style=\"margin-left:24px;text-indent:0\"><span style=\"font-family: Lato; font-size: 16px;\">Suzhou MHW Chemical Co., Ltd.</span></p><p class=\"MsoListParagraph\" style=\"margin-left:24px;text-indent:0\"><span style=\"font-family: Lato; font-size: 16px;\">Address: &nbsp;No.40-1004, West Zone of TusPark, Suzhou Industrial Park, Suzhou City.</span></p><p class=\"MsoListParagraph\" style=\"margin-left:24px;text-indent:0\"><span style=\"font-family: Lato; font-size: 16px;\">Tel:86-512-62514840</span></p><p class=\"MsoListParagraph\" style=\"margin-left:24px;text-indent:0\"><span style=\"font-size: 16px; font-family: Lato;\">Fax:86-512-62514840</span></p><p class=\"MsoListParagraph\" style=\"margin-left:24px;text-indent:0\"><span style=\"font-family: Lato;\"><span style=\"font-size: 16px;\">Email</span><span style=\"font-size: 16px;\">:</span><span style=\"color: windowtext; font-size: 16px;\"><a href=\"mailto:info@mhwchem.com\">info@mhwchem.com</a></span></span></p><p class=\"MsoListParagraph\" style=\"margin-left:24px;text-indent:0\"><span style=\"font-family: Lato; font-size: 16px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><a href=\"mailto:alice.wang@mhwchem.com\" style=\"white-space: normal; text-decoration: underline; font-family: Lato; font-size: 16px;\"><span style=\"font-family: Lato; font-size: 16px;\">alice.wang@mhwchem.com</span></a></p><p class=\"MsoListParagraph\" style=\"margin-left: 24px; text-indent: 0px;\"><span style=\"font-size: 16px; font-family: Lato;\"><span style=\"font-size: 16px;\">Skype:</span><span style=\"font-family: Lato; text-decoration: underline; font-size: 18px;\"><a href=\"mailto:alice.wang@mhwchem.com\" style=\"font-family: &quot;times new roman&quot;; text-decoration: underline;\"></a><a href=\"mailto:alice.wang@mhwchem.com\" style=\"white-space: normal; font-family: Lato;\">alice.wang@mhwchem.com</a></span></span></p><p class=\"MsoListParagraph\" style=\"margin-left: 24px; text-indent: 0px;\"><span style=\"font-size: 16px; font-family: Lato;\">asdfsadf</span></p>', '2017-11-13 16:22:20', 'admin', 'contactus');
INSERT INTO `article` VALUES ('4', 'what', 'a', '<p class=\"MsoListParagraph\" style=\"margin-left:24px;text-indent:0;line-height:150%\"><span style=\"font-family:宋体\"><img src=\"/ueditor/php/upload/image/20171023/1508763048489024.jpg\" title=\"1508763048489024.jpg\" alt=\"1440141582544143.jpg\" width=\"567\" height=\"140\"/></span></p><p class=\"MsoListParagraph\" style=\"margin-left:24px;text-indent:0;line-height:150%\"><br/></p><p class=\"MsoListParagraph\" style=\"margin-left:24px;text-indent:0;line-height:150%\"><span style=\"font-size: 18px; font-family: Lato;\">MHW as a bridge between suppliers and customers.</span></p><p class=\"MsoListParagraph\" style=\"margin-left:24px;text-indent:0;line-height:150%\"><br/></p><p class=\"MsoListParagraph\" style=\"margin-left:24px;text-indent:0;line-height:150%\"><span style=\"font-family: Lato;\"><strong>Mission Statement</strong></span></p><p style=\"line-height:150%\"><span style=\"font-family: Lato;\">Our mission is to produce high quality products that meet our customer’s &nbsp;demands in an enthusiastic and efficient manner with a dedicated professional team.</span></p><p style=\"line-height:150%\"><br/></p><p class=\"MsoListParagraph\" style=\"margin-left:24px;text-indent:0;line-height:150%\"><span style=\"font-family: Lato;\"><strong>Quality Statement</strong></span></p><p style=\"line-height:150%\"><span style=\"font-family: Lato;\">High quality has always been an absolute priority at MHW Chemical. Our stringent quality control systems ensure our final products meet the high demands and expectations of our customers.</span></p><p style=\"line-height:150%\"><br/></p><p style=\"text-indent:28px;line-height:150%\"><span style=\"font-family: Lato;\"><strong>Innovation, Safety and Environment</strong></span></p><p><span style=\"font-size: 16px; font-family: Lato;\">Innovation, safety and the environment are our company unremitting pursue goal since long ago.</span></p><p><span style=\"font-size: 16px; font-family: arial, helvetica, sans-serif;\"></span><br/></p><p><br/></p>', '2017-11-01 20:18:24', 'admin', 'culture');
INSERT INTO `article` VALUES ('5', 'what', 'a', '<p style=\"margin-left: 24px;text-indent: 0;line-height: 150%\"><br/><strong><span style=\"line-height: 150%;\"><img src=\"/ueditor/php/upload/image/20171022/1508640245129566.jpg\" title=\"1508640245129566.jpg\" alt=\"1508640245129566.jpg\" width=\"600\" height=\"200\"/></span></strong><strong><br/></strong></p><p class=\"MsoListParagraph\" style=\"margin-left: 24px;white-space: normal;line-height: 24px\"><span style=\"font-family: Lato;\"><strong>Sourcing and purchasing</strong><br/></span></p><p class=\"MsoListParagraph\" style=\"margin-left: 24px;white-space: normal;line-height: 24px\"><span style=\"font-family: Lato;\">Our purchasing team has many years’ experience in raw materials, and familiar to European and America requirements about products. Hope we can cooperate with you as your reliable sourcing partner.</span></p><p class=\"MsoListParagraph\" style=\"margin-left: 24px;text-indent: 0;line-height: 150%\"><span style=\"font-family: Lato;\">We are glad to share our rich market experience and information with all customers.</span></p><p class=\"MsoListParagraph\" style=\"margin-left: 24px;text-indent: 0;line-height: 150%\"><span style=\"font-family: Lato;\"><strong><span style=\"font-family: Lato; font-size: 16px; line-height: 150%;\"><br/></span></strong></span></p><p class=\"MsoListParagraph\" style=\"margin-left: 24px;text-indent: 0;line-height: 150%\"><span style=\"font-family: Lato;\"><strong><span style=\"font-family: Lato; font-size: 16px; line-height: 150%;\"><strong style=\"white-space: normal;\"><span style=\"font-family: Lato; line-height: 24px;\">Marketing</span></strong>&nbsp;Quality</span></strong></span></p><p class=\"MsoListParagraph\" style=\"margin-left: 24px;text-indent: 0;line-height: 150%\"><span style=\"font-size: 16px; line-height: 150%; font-family: Lato;\">With years’ experience in quality control and technical support, our QC department can supply answers to some technical supports, such as certificate of analysis, certificates and relative statements. The sample will be supplied to customers according to requests</span></p><p class=\"MsoListParagraph\" style=\"margin-left: 24px;text-indent: 0;line-height: 150%\"><span style=\"font-family: Lato;\"><strong><span style=\"font-family: Lato; font-size: 16px; line-height: 150%;\"><br/></span></strong></span></p><p class=\"MsoListParagraph\" style=\"margin-left: 24px;text-indent: 0;line-height: 150%\"><span style=\"font-family: Lato;\"><strong><span style=\"font-family: Lato; font-size: 16px; line-height: 150%;\">Logistics</span></strong></span></p><p class=\"MsoListParagraph\" style=\"margin-left: 24px;text-indent: 0;line-height: 150%\"><span style=\"font-family: Lato;\">Suitable shipments for different products can be offered to you according to customer’s requests on package, label and couriers.</span></p><p><strong><br/></strong></p><p><br/></p>', '2017-11-01 20:18:02', 'admin', 'service');
INSERT INTO `article` VALUES ('6', 'what', 'a', '<p><span style=\"font-size:14px;font-family:&#39;Calibri&#39;,&#39;sans-serif&#39;\">&nbsp;&nbsp;&nbsp;&nbsp;</span></p><p><span style=\"font-family: Calibri, sans-serif; font-size: 16px;\">&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"font-size: 16px; font-family: Lato;\">Our products largely are exported to America, Japan and Europe, etc., and have won praise from customers at home and abroad regarding as excellent quality and best service.</span></span></p>', '2017-11-01 20:13:56', 'admin', 'mainProducts');
INSERT INTO `article` VALUES ('7', 'what', 'a', '<p style=\"text-indent:28px;line-height:150%\"><br/></p><p style=\"text-indent: 28px; line-height: 150%;\">We are specializing in developing, marketing and distributing ingredients and products for nutraceuticals, supplements and cosmetics industries from the professional manufacturers in China.<br/></p>', '2017-11-10 12:11:02', 'admin', 'mainAboutUs');
INSERT INTO `article` VALUES ('8', 'what', 'a', '<p><span style=\"font-family: Lato;\">&nbsp;&nbsp;&nbsp;<span style=\"font-family: Lato; color: rgb(0, 0, 0);\">&nbsp;</span></span></p><p style=\"line-height: normal;\"><span style=\"font-size: 14px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;&nbsp;<span style=\"font-size: 14px; color: rgb(0, 0, 0); font-family: Calibri;\">&nbsp;Tel: &nbsp; &nbsp; 86-512-62514840</span></span></p><p style=\"line-height: normal;\"><span style=\"font-size: 14px; color: rgb(0, 0, 0); font-family: Calibri;\">&nbsp;&nbsp;&nbsp;&nbsp;Fax: &nbsp; &nbsp; 86-512-62514840</span></p><p style=\"line-height: normal;\"><span style=\"color: rgb(0, 0, 0); font-family: Calibri;\"><span style=\"font-family: Calibri; color: rgb(127, 127, 127); font-size: 14px;\">&nbsp;&nbsp;<span style=\"font-family: Calibri; font-size: 14px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;Email: &nbsp;</span>&nbsp; </span><span style=\"font-family: Calibri; color: rgb(0, 0, 0); font-size: 14px;\">info@mhwchem.com</span><span style=\"font-family: Calibri; color: rgb(127, 127, 127); font-size: 14px;\">&nbsp;&nbsp;</span></span></p><p style=\"line-height: normal;\"><span style=\"font-size: 14px; color: rgb(0, 0, 0); font-family: Calibri;\"><span style=\"font-family: Calibri; color: rgb(127, 127, 127); font-size: 14px;\">&nbsp; &nbsp; <span style=\"font-family: Calibri; font-size: 14px; color: rgb(255, 255, 255);\">Email:</span> &nbsp;&nbsp;&nbsp;</span>alice.wang@mhwchem.com</span></p><p style=\"line-height: normal;\"><span style=\"color: rgb(0, 0, 0); font-family: Calibri;\"><span style=\"font-family: Calibri; color: rgb(127, 127, 127); font-size: 14px;\">&nbsp;&nbsp;<span style=\"font-family: Calibri; font-size: 14px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;Skype:</span> &nbsp; </span><span style=\"font-family: Calibri; color: rgb(0, 0, 0); font-size: 14px\">alice.wang@mhwchem.com</span></span></p><p><br/></p>', '2017-11-15 14:15:53', 'admin', 'mainContactUs');

-- ----------------------------
-- Table structure for contactus
-- ----------------------------
DROP TABLE IF EXISTS `contactus`;
CREATE TABLE `contactus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `isRead` bit(1) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contactus
-- ----------------------------
INSERT INTO `contactus` VALUES ('9', '1', '1', '1', '\0', '2017-11-01 21:24:48');
INSERT INTO `contactus` VALUES ('10', '2', '2', '2', '', '2017-11-02 10:27:23');
INSERT INTO `contactus` VALUES ('11', '3', '3', '3', '\0', '2017-11-02 10:27:56');
INSERT INTO `contactus` VALUES ('12', '4', '4', '4', '\0', '2017-11-02 10:28:00');
INSERT INTO `contactus` VALUES ('13', '5', '5', '5', '\0', '2017-11-02 10:28:05');
INSERT INTO `contactus` VALUES ('14', 'p', 'p', 'p', '\0', '2017-11-02 10:28:09');
INSERT INTO `contactus` VALUES ('15', 'o', 'o', 'o', '\0', '2017-11-02 10:28:14');
INSERT INTO `contactus` VALUES ('16', 'y', 'y', 'y', '\0', '2017-11-02 10:28:19');
INSERT INTO `contactus` VALUES ('17', 'h', 'h', 'h', '\0', '2017-11-02 10:28:24');
INSERT INTO `contactus` VALUES ('18', 't', 't', 't', '\0', '2017-11-02 10:28:28');
INSERT INTO `contactus` VALUES ('19', '[', '[', '[', '\0', '2017-11-02 10:28:32');
INSERT INTO `contactus` VALUES ('20', '9', '9', '9', '\0', '2017-11-02 10:28:37');
INSERT INTO `contactus` VALUES ('21', 'sad', 'asdf', 'asdf', '\0', '2017-11-02 10:28:48');
INSERT INTO `contactus` VALUES ('22', '1', '1', '<script>alert(\'a\')</script>', '\0', '2017-12-08 12:51:20');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `description` text,
  `productType` int(11) DEFAULT NULL,
  `imgPath` text,
  `showInIndex` bit(1) DEFAULT NULL,
  `orderNum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_ibfk_1` (`productType`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`productType`) REFERENCES `producttype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', 'zhuhe', '<p>1212212121</p>', '1', '/ueditor/php/upload/image/20171023/1508767133885871.jpg', '', null);
INSERT INTO `product` VALUES ('6', '4', '4', '1', null, null, null);
INSERT INTO `product` VALUES ('7', '5', '5', '1', null, null, null);
INSERT INTO `product` VALUES ('8', '6', '6', '1', null, null, null);
INSERT INTO `product` VALUES ('9', '7', '7', '1', null, null, null);
INSERT INTO `product` VALUES ('10', '112', '1212', '1', '', null, null);
INSERT INTO `product` VALUES ('11', 'wqer', '<p>33232asd</p><p>asd</p>', '1', '/ueditor/php/upload/image/20171022/1508677550954691.jpg', '', null);
INSERT INTO `product` VALUES ('12', 'adsf', '<p>ads</p>', '1', '/ueditor/php/upload/image/20171022/1508677550954691.jpg', '', '2');
INSERT INTO `product` VALUES ('13', '测试显示这个长度可能有那么一点点的长，不', '<p>去玩儿群翁人如其文二</p>', '1', '/ueditor/php/upload/image/20171023/1508767133885871.jpg', '', '1');
INSERT INTO `product` VALUES ('16', '111222', '<p>sadfsdfsdf</p>', '1', '/ueditor/php/upload/image/20171022/1508677550954691.jpg', '\0', '0');

-- ----------------------------
-- Table structure for producttype
-- ----------------------------
DROP TABLE IF EXISTS `producttype`;
CREATE TABLE `producttype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `orderNum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of producttype
-- ----------------------------
INSERT INTO `producttype` VALUES ('1', 'Joint health', null);
INSERT INTO `producttype` VALUES ('2', 'Nutraceuticals', null);
INSERT INTO `producttype` VALUES ('3', 'Cosmetic ingredients', null);
INSERT INTO `producttype` VALUES ('4', 'Medical Devices', null);
INSERT INTO `producttype` VALUES ('5', 'Sports Health', null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', '1', '1');
