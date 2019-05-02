/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50714
 Source Host           : localhost:3307
 Source Schema         : bike

 Target Server Type    : MySQL
 Target Server Version : 50714
 File Encoding         : 65001

 Date: 02/05/2019 13:47:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bike_admin
-- ----------------------------
DROP TABLE IF EXISTS `bike_admin`;
CREATE TABLE `bike_admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pwd` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `addtime` int(11) NOT NULL,
  `isable` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bike_admin
-- ----------------------------
INSERT INTO `bike_admin` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1429716661, 1);

-- ----------------------------
-- Table structure for bike_bbs
-- ----------------------------
DROP TABLE IF EXISTS `bike_bbs`;
CREATE TABLE `bike_bbs`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `addtime` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bike_bbs
-- ----------------------------
INSERT INTO `bike_bbs` VALUES (1, '计算机硬件板块', NULL);
INSERT INTO `bike_bbs` VALUES (2, '计算机软件板块', NULL);
INSERT INTO `bike_bbs` VALUES (3, '问答板块', NULL);

-- ----------------------------
-- Table structure for bike_category
-- ----------------------------
DROP TABLE IF EXISTS `bike_category`;
CREATE TABLE `bike_category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `parent_id` int(2) NOT NULL,
  `addtime` int(11) NULL DEFAULT NULL,
  `displayorder` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 37 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bike_category
-- ----------------------------
INSERT INTO `bike_category` VALUES (35, '滑板车', 0, 1429795724, 0);
INSERT INTO `bike_category` VALUES (34, '电动车', 0, 1429795702, 0);
INSERT INTO `bike_category` VALUES (33, '自行车', 0, 1429795681, 0);
INSERT INTO `bike_category` VALUES (36, '三轮车', 0, 1429795740, 0);

-- ----------------------------
-- Table structure for bike_commit
-- ----------------------------
DROP TABLE IF EXISTS `bike_commit`;
CREATE TABLE `bike_commit`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `addtime` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bike_commit
-- ----------------------------
INSERT INTO `bike_commit` VALUES (8, 15, 'test', '着车子不错 很喜欢 哈哈哈', 1429797641, 21);

-- ----------------------------
-- Table structure for bike_gonggao
-- ----------------------------
DROP TABLE IF EXISTS `bike_gonggao`;
CREATE TABLE `bike_gonggao`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pic` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `addtime` int(11) NOT NULL,
  `isshow` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bike_gonggao
-- ----------------------------
INSERT INTO `bike_gonggao` VALUES (12, '节日活动血拼到底~~~', '', '<p>当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的当地当地的<br /></p>', 1429800865, 1);
INSERT INTO `bike_gonggao` VALUES (11, '商品大促销啦', '', '<p>商品大促销啦商品大促销啦商品大促销啦商品大促销啦</p><p>商品大促销啦商品大促销啦商品大促销啦商品大促销啦商品大促销啦</p><p>商品大促销啦商品大促销啦商品大促销啦商品大促销啦商品大促销啦商品大促销啦</p><p>商品大促销啦商品大促销啦商品大促销啦商品大促销啦商品大促销啦商品大促销啦商品大促销啦</p><p>商品大促销啦商品大促销啦商品大促销啦商品大促销啦商品大促销啦商品大促销啦商品大促销啦商品大促销啦</p><p>商品大促销啦商品大促销啦商品大促销啦商品大促销啦商品大促销啦商品大促销啦商品大促销啦商品大促销啦商品大促销啦<br /></p>', 1429795373, 1);

-- ----------------------------
-- Table structure for bike_jszc
-- ----------------------------
DROP TABLE IF EXISTS `bike_jszc`;
CREATE TABLE `bike_jszc`  (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `question` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `author` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `createtime` int(10) NOT NULL,
  `answer` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_show` tinyint(2) NULL DEFAULT 1 COMMENT '是否展示(1是0否)',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bike_jszc
-- ----------------------------
INSERT INTO `bike_jszc` VALUES (2, '为什么电脑经常死机?', '圣玻璃心 ', 1556767197, '<p><span style=\"color:#333333;font-family:&quot;pingfang sc&quot;, &quot;lantinghei sc&quot;, &quot;microsoft yahei&quot;, arial, 宋体, sans-serif, tahoma;font-size:16px;background-color:#FFFFFF;\">每种硬件有自己默认或特定的工作环境，不能随便超越它的工作权限进行设置，否则就会因为硬件达不到这个要求而死机。例如：一款内存条只能支持到DDR&nbsp;266，而在BIOS设置中却将其设为DDR&nbsp;333的规格，这样做就会因为硬件达不到要求而死机，如果就算是能在短时间内正常的工作，电子元件也会随着使用时间的增加而逐渐老化，产生的质量问题也会导致计算机频繁的“死机”。</span><br style=\"margin:20px 0px;width:705px;height:0px;color:#333333;text-transform:none;text-indent:0px;letter-spacing:normal;font-family:&quot;pingfang sc&quot;, &quot;lantinghei sc&quot;, &quot;microsoft yahei&quot;, arial, 宋体, sans-serif, tahoma;font-size:16px;font-style:normal;font-weight:400;word-spacing:0px;display:block;white-space:normal;content:&quot;&quot;;orphans:2;widows:2;background-color:#FFFFFF;font-variant-ligatures:normal;font-variant-caps:normal;-webkit-text-stroke-width:0px;text-decoration-style:initial;text-decoration-color:initial;\" /><br /></p>', 1);

-- ----------------------------
-- Table structure for bike_order
-- ----------------------------
DROP TABLE IF EXISTS `bike_order`;
CREATE TABLE `bike_order`  (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `dingdanhao` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `spc` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `slc` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `shouhuoren` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sex` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dizhi` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `youbian` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tel` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `shff` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `zfff` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `leaveword` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `time` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `xiadanren` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `zt` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `total` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 111 CHARACTER SET = gb2312 COLLATE = gb2312_chinese_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bike_order
-- ----------------------------
INSERT INTO `bike_order` VALUES (108, '20150423215457', '21@', '1@', '张三', '男', '中山大学软件学院12楼', '200200', '13212322333', 'test@145.com', '普通平邮', '网上支付', '我要大号的 ，好看的', '2015-04-23 21:54:57', 'test', '下单成功', '500');
INSERT INTO `bike_order` VALUES (109, '20150423230015', '22@', '1@', '小白', '男', '中山大学软件学院12楼', '122321', '13212322333', '111@13.com', '送货上门', '交通银行汇款', '好好 快快', '2015-04-23 23:00:15', 'test', '下单成功', '1800');
INSERT INTO `bike_order` VALUES (110, '20150510210746', '24@23@', '1@1@', '张三', '男', '中山大学软件学院12楼', '200200', '1233333333', '111@13.com', '普通平邮', '建设银行汇款', '测试', '2015-05-10 21:07:46', 'test', '下单成功', '699');

-- ----------------------------
-- Table structure for bike_product
-- ----------------------------
DROP TABLE IF EXISTS `bike_product`;
CREATE TABLE `bike_product`  (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Cat_Id` int(11) NULL DEFAULT NULL,
  `Comm_Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Comm_MarketPrice` double NULL DEFAULT NULL,
  `Comm_SellPrice` double NULL DEFAULT NULL,
  `Comm_Manufactures` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Comm_ProArea` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Comm_Reserves` int(11) NOT NULL COMMENT '库存',
  `Comm_Sellnum` int(11) NOT NULL COMMENT '销售数量 ',
  `Comm_IsRecomm` tinyint(4) NULL DEFAULT NULL,
  `Comm_IsHot` tinyint(4) NULL DEFAULT 0,
  `Comm_IsTj` tinyint(4) NULL DEFAULT 0,
  `comm_SjTime` int(11) NULL DEFAULT NULL,
  `Comm_Describe` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `Comm_Pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Comm_IsSj` tinyint(4) NULL DEFAULT NULL,
  `Admin_Id` int(11) NULL DEFAULT NULL,
  `Comm_LrTime` int(11) NULL DEFAULT NULL,
  `Comm_LookTime` int(11) NULL DEFAULT NULL,
  `Comm_Sort` int(11) NULL DEFAULT NULL,
  `Comm_Area` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Comm_GiveIntegal` int(11) NULL DEFAULT 0,
  `isshow` tinyint(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bike_product
-- ----------------------------
INSERT INTO `bike_product` VALUES (21, 33, '优贝儿童自行车双避震小飞熊童车宝宝生日礼物男女单车', 600, 500, NULL, NULL, 222, 0, 0, 1, 1, 1429795856, '<ul id=\"parameter2\" class=\"p-parameter-list\"><li title=\"优贝儿童自行车双避震小飞熊童车宝宝生日礼物男女单车 黄色 16寸\"><p>商品名称：优贝儿童自行车双避震小飞熊童车宝宝生日礼物男女单车&nbsp;黄色&nbsp;16寸</p></li><li title=\"1313061377\"><p>商品编号：1313061377</p></li><li title=\"倍爱母婴旗舰店\"><p>店铺：&nbsp;<a href=\"http://mall.jd.com/index-73059.html\" target=\"_blank\">倍爱母婴旗舰店</a></p></li><li title=\"2014-09-22 14:31:21\"><p>上架时间：2014-09-22&nbsp;14:31:21</p></li><li title=\"10.0kg\"><p>商品毛重：10.0kg</p></li><li title=\"12寸，14寸，16寸，18寸以上\"><p>尺寸：12寸，14寸，16寸，18寸以上</p></li><li title=\"钢管\"><p>车架材质：钢管</p></li><li title=\"其他\"><p>配件：其他</p></li></ul><h1><br /></h1>', '/public/Uploads/pic/5538f41072b28.jpg', NULL, 1, NULL, NULL, 0, NULL, 0, 1);
INSERT INTO `bike_product` VALUES (22, 33, '永久24速自行车26寸铝合金山地车/禧玛诺变速/锁死前叉/建大轮胎/培林花鼓', 2100, 1800, NULL, NULL, 230, 0, 1, NULL, 1, 1429796545, '<p><span style=\"font-family:&#39;microsoft yahei&#39;\"><strong><span style=\"font-size:large;color:#ff0000\">8.5&nbsp;远腾&nbsp;10月30日全新改版</span></strong></span></p><p><span style=\"font-family:&#39;microsoft yahei&#39;\"><strong><span style=\"font-size:large\"><br /></span></strong></span></p><p><span style=\"font-family:&#39;microsoft yahei&#39;\"><span style=\"font-size:large\">禧玛诺24速&nbsp;锁死前叉</span></span></p><p><br /></p><p><span style=\"font-family:&#39;microsoft yahei&#39;\"><span style=\"font-size:large\">此款是标准尺寸铝合金异型管车架，<span style=\"color:#ff0000\">比普通车架要高3CM左右</span>，165-180身高骑行更舒适，更好发力</span></span></p><p><span style=\"font-family:&#39;microsoft yahei&#39;\"><span style=\"font-size:large\"><br /></span></span></p><p><span style=\"font-family:&#39;microsoft yahei&#39;\"><strong><span style=\"font-size:large\">外国骑友TOTO曾历时20天骑友中国五大省市</span></strong></span></p><p><span style=\"font-family:&#39;microsoft yahei&#39;\"><strong><span style=\"font-size:large\"><br /></span></strong></span></p><p><span style=\"font-family:&#39;microsoft yahei&#39;\"><span style=\"font-size:large\">全新由滚珠花鼓改版为铝合金阳极金2培林花鼓，同样的骑行力气<span style=\"color:#ff0000\">，培林花鼓行驶距离更远。安静、顺滑</span></span></span></p><p><span style=\"font-family:&#39;microsoft yahei&#39;\"><span style=\"color:#ff0000\"><span style=\"font-size:large\"><br /></span></span></span></p><p><span style=\"font-family:&#39;microsoft yahei&#39;\"><span style=\"font-size:large\">全新由朝阳轮胎<span style=\"color:#ff0000\">升级为台湾建大加强筋外胎</span></span></span></p><p><span style=\"font-family:&#39;microsoft yahei&#39;\"><span style=\"color:#ff0000\"><span style=\"font-size:large\"><br /></span></span></span></p><p><span style=\"font-family:&#39;microsoft yahei&#39;\"><span style=\"font-size:large\">全新由22/32/42T小片牙盘，<span style=\"color:#ff0000\">升级为28/38/48T大片牙盘，速度更快</span></span></span></p><p><br /></p><p><br /></p><p><span style=\"font-family:&#39;microsoft yahei&#39;\"><span style=\"font-size:large\">买就送6大配件，加送车前包、副把，五分好评加送挡泥板、座套、水壶架</span></span></p><p><img src=\"/bike/ueditor/server/upload/uploadimages/6741429796541.jpg\" style=\"float:none;\" title=\"5451e54cN66ef7883.jpg\" border=\"0\" height=\"692\" hspace=\"0\" vspace=\"0\" width=\"440\" /><br /></p>', '/public/Uploads/pic/5538f6c149cb6.jpg', NULL, 1, NULL, NULL, 0, NULL, 0, 1);
INSERT INTO `bike_product` VALUES (23, 33, '永久20寸铝合金车架 7级变速 折叠自行车YE2015', 650, 509, NULL, NULL, 100, 0, 1, NULL, NULL, 1429796697, '<ul id=\"parameter2\" class=\"p-parameter-list\"><li title=\"永久YE2015\"><p>商品名称：永久YE2015</p></li><li title=\"1221049\"><p>商品编号：1221049</p></li><li title=\"永久\"><p>品牌：&nbsp;<a href=\"http://www.jd.com/pinpai/12116-19992.html\" target=\"_blank\">永久</a></p></li><li title=\"2014-09-17 16:18:29\"><p>上架时间：2014-09-17&nbsp;16:18:29</p></li><li title=\"17.5kg\"><p>商品毛重：17.5kg</p></li><li title=\"中国大陆\"><p>商品产地：中国大陆</p></li><li title=\"YE2015\"><p>货号：YE2015</p></li><li title=\"500-999\"><p>价位：500-999</p></li><li title=\"7速\"><p>速别：7速</p></li><li title=\"铝合金\"><p>车架材质：铝合金</p></li><li title=\"20英寸\"><p>轮组尺寸：20英寸</p></li><li title=\"前后V刹\"><p>制动系统：前后V刹</p></li></ul><p><img src=\"/bike/ueditor/server/upload/uploadimages/69951429796694.jpg\" style=\"float:none;\" title=\"541854abN476b38b1.jpg\" border=\"0\" height=\"497\" hspace=\"0\" vspace=\"0\" width=\"357\" /><br /></p>', '/public/Uploads/pic/5538f75924c89.jpg', NULL, 1, NULL, NULL, 0, NULL, 0, 1);
INSERT INTO `bike_product` VALUES (24, 36, '充气轮三轮车 儿童三轮车 三轮自行车 小孩三轮自行车 红色充气轮三轮车', 200, 190, NULL, NULL, 100, 0, 1, NULL, NULL, 1429796821, '<ul id=\"parameter2\" class=\"p-parameter-list\"><li title=\"充气轮三轮车 儿童三轮车 三轮自行车 小孩三轮自行车 红色充气轮三轮车\"><p>商品名称：充气轮三轮车&nbsp;儿童三轮车&nbsp;三轮自行车&nbsp;小孩三轮自行车&nbsp;红色充气轮三轮车</p></li><li title=\"1194174520\"><p>商品编号：1194174520</p></li><li title=\"浩贝佳母婴专营店\"><p>店铺：&nbsp;<a href=\"http://happyjia.jd.com\" target=\"_blank\">浩贝佳母婴专营店</a></p></li><li title=\"2015-01-06 10:06:30\"><p>上架时间：2015-01-06&nbsp;10:06:30</p></li><li title=\"7.0kg\"><p>商品毛重：7.0kg</p></li><li title=\"金属\"><p>材质：金属</p></li><li title=\"手推\"><p>功能：手推</p></li></ul><p><img src=\"/bike/ueditor/server/upload/uploadimages/66281429796818.jpg\" style=\"float:none;\" title=\"5433e535Na18255f7.jpg\" border=\"0\" hspace=\"0\" vspace=\"0\" /><br /></p>', '/public/Uploads/pic/5538f7d5af5c5.jpg', NULL, 1, NULL, NULL, 0, NULL, 0, 1);
INSERT INTO `bike_product` VALUES (25, 34, '永久折叠电动车 mini电动车 锂电电动自行车 16寸36V隐藏可锁锂电池 天空蓝', 2500, 2200, NULL, NULL, 100, 0, NULL, 1, NULL, 1429796965, '<ul id=\"parameter2\" class=\"p-parameter-list\"><li title=\"永久折叠电动车 mini电动车 锂电电动自行车 16寸36V隐藏可锁锂电池 天空蓝\"><p>商品名称：永久折叠电动车&nbsp;mini电动车&nbsp;锂电电动自行车&nbsp;16寸36V隐藏可锁锂电池&nbsp;天空蓝</p></li><li title=\"1387603936\"><p>商品编号：1387603936</p></li><li title=\"永久沃动专卖店\"><p>店铺：&nbsp;<a href=\"http://mall.jd.com/index-72295.html\" target=\"_blank\">永久沃动专卖店</a></p></li><li title=\"2015-04-14 09:55:06\"><p>上架时间：2015-04-14&nbsp;09:55:06</p></li><li title=\"16.5kg\"><p>商品毛重：16.5kg</p></li><li title=\"轻灵\"><p>货号：轻灵</p></li><li title=\"2000-2999\"><p>价位：2000-2999</p></li><li title=\"16寸\"><p>轮径：16寸</p></li><li title=\"36V\"><p>电压：36V</p></li></ul><p><img src=\"/bike/ueditor/server/upload/uploadimages/41341429796961.jpg\" style=\"float:none;\" title=\"5510ce64N7affe179.jpg\" border=\"0\" height=\"500\" hspace=\"0\" vspace=\"0\" width=\"388\" /><br /></p>', '/public/Uploads/pic/5538f865bdebc.jpg', NULL, 1, NULL, NULL, 0, NULL, 0, 1);

-- ----------------------------
-- Table structure for bike_soft
-- ----------------------------
DROP TABLE IF EXISTS `bike_soft`;
CREATE TABLE `bike_soft`  (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `softname` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `addtime` int(10) NOT NULL,
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `click` int(8) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bike_soft
-- ----------------------------
INSERT INTO `bike_soft` VALUES (2, '测试软件', 1556768652, '', 'StrokeIt.zip', 0);

-- ----------------------------
-- Table structure for bike_topic
-- ----------------------------
DROP TABLE IF EXISTS `bike_topic`;
CREATE TABLE `bike_topic`  (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `typeid` int(8) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `addtime` int(10) NULL DEFAULT NULL,
  `lastreplytime` int(10) NULL DEFAULT NULL,
  `head` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `readtimes` int(8) NULL DEFAULT NULL,
  `top` int(2) NOT NULL,
  `image` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tid` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bike_topic
-- ----------------------------
INSERT INTO `bike_topic` VALUES (1, 1, 'test', 2, '1111', '11111111111111111111', 1556766367, NULL, NULL, NULL, 0, NULL, 0);
INSERT INTO `bike_topic` VALUES (2, 1, 'test', 2, '22222222222', '22222222222222222222222222222', 1556766466, NULL, NULL, NULL, 0, NULL, 0);
INSERT INTO `bike_topic` VALUES (3, 1, 'test', 2, '33333', '33333333333333', 1556766526, NULL, NULL, NULL, 0, NULL, 0);
INSERT INTO `bike_topic` VALUES (4, 1, 'test', 2, '444', '444444444', 1556766585, NULL, NULL, NULL, 0, NULL, 0);
INSERT INTO `bike_topic` VALUES (6, 1, 'test', 2, '', '强强强强', 1556769185, NULL, NULL, NULL, 0, NULL, 1);

-- ----------------------------
-- Table structure for bike_userinfo
-- ----------------------------
DROP TABLE IF EXISTS `bike_userinfo`;
CREATE TABLE `bike_userinfo`  (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `usernc` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `truename` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pwd` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sex` tinyint(2) NULL DEFAULT 1,
  `tel` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qq` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `logintimes` int(8) NOT NULL,
  `regtime` int(8) NOT NULL,
  `lastlogintime` int(8) NOT NULL,
  `ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `yb` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `usertype` int(2) NOT NULL,
  `question` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `answer` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `truepwd` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `photo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_card` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pubtimes` int(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bike_userinfo
-- ----------------------------
INSERT INTO `bike_userinfo` VALUES (1, 'test', '李四', 'e10adc3949ba59abbe56e057f20f883e', 'test@qq.com', 1, '132456555', '', '北京', 0, 1556765861, 0, '', '', 0, '', '', '', '3', '', 0);

-- ----------------------------
-- Table structure for bike_users
-- ----------------------------
DROP TABLE IF EXISTS `bike_users`;
CREATE TABLE `bike_users`  (
  `User_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_UserName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `User_Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `User_Password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `User_Validated` tinyint(4) NULL DEFAULT 0,
  `User_Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `User_Identy` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `User_Sex` tinyint(4) NULL DEFAULT 0,
  `User_Birthdat` int(11) NULL DEFAULT NULL,
  `User_Province` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `User_City` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `User_Area` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `User_Address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `User_Mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `User_Telephone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `User_SafeQues` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `User_SafeAnswer` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `User_QQ` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `User_Grade` tinyint(4) NULL DEFAULT NULL,
  `User_Balance` double(10, 0) NULL DEFAULT NULL,
  `User_Addtime` int(11) NULL DEFAULT NULL COMMENT '注册时间 ',
  `User_Integral` int(11) NULL DEFAULT NULL,
  `User_NextLoginIp` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `User_NextLoginTime` datetime(0) NULL DEFAULT NULL,
  `User_Login` int(11) NULL DEFAULT NULL,
  `User_Locked` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`User_Id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bike_users
-- ----------------------------
INSERT INTO `bike_users` VALUES (16, 'loveshop', 'ttt@123.com', '96e79218965eb72c92a549dd5a330112', 0, NULL, NULL, NULL, -28800, '北京', '市辖区', '东城区', '', '', '', '', '', '', 0, 0, 1429800705, NULL, NULL, NULL, NULL, 0);
INSERT INTO `bike_users` VALUES (15, 'test', 'test@145.com', '96e79218965eb72c92a549dd5a330112', 0, NULL, NULL, NULL, 946656000, '北京', '市辖区', '东城区', '', '', '', '', '', '', 0, 0, 1429797185, NULL, NULL, NULL, NULL, 0);

SET FOREIGN_KEY_CHECKS = 1;
