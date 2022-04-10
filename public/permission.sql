/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 80027
 Source Host           : localhost:3306
 Source Schema         : permission

 Target Server Type    : MySQL
 Target Server Version : 80027
 File Encoding         : 65001

 Date: 10/04/2022 17:59:31
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sys_dict
-- ----------------------------
DROP TABLE IF EXISTS `sys_dict`;
CREATE TABLE `sys_dict` (
  `id` mediumint NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '字典名称',
  `cache_key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '固定值,用于缓存使用',
  `item` json DEFAULT NULL COMMENT '字典项',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cache_key` (`cache_key`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='后台字典表';

-- ----------------------------
-- Records of sys_dict
-- ----------------------------
BEGIN;
INSERT INTO `sys_dict` VALUES (1, '文章分类', 'aaa', '{}');
INSERT INTO `sys_dict` VALUES (3, '字典33', '22', '0');
INSERT INTO `sys_dict` VALUES (4, '11111', '33', '0');
INSERT INTO `sys_dict` VALUES (5, '币种', '44', '0');
INSERT INTO `sys_dict` VALUES (6, 'market', '66', '0');
INSERT INTO `sys_dict` VALUES (7, '测试字典', '55', '0');
INSERT INTO `sys_dict` VALUES (8, 'project1', '77', '0');
INSERT INTO `sys_dict` VALUES (9, 'project2', '88', '0');
INSERT INTO `sys_dict` VALUES (10, 'dd', '99', '0');
INSERT INTO `sys_dict` VALUES (14, '文章分类1', 'article_audit2', '{\"1\": \"字典项1\", \"2\": \"字典项2\"}');
INSERT INTO `sys_dict` VALUES (15, '文章分类', 'article_category', '{\"1\": \"字典项3\", \"2\": \"字典项4\"}');
INSERT INTO `sys_dict` VALUES (16, '新分类', 'new', '0');
INSERT INTO `sys_dict` VALUES (17, '新分类3', 'new1', '0');
INSERT INTO `sys_dict` VALUES (18, '配置中心', 'config', '0');
INSERT INTO `sys_dict` VALUES (19, '新分类222vf', 'new1fds', '1');
INSERT INTO `sys_dict` VALUES (20, '文章分类2fd', 'categoryff', '0');
INSERT INTO `sys_dict` VALUES (22, '新分类11', 'new2', NULL);
INSERT INTO `sys_dict` VALUES (23, '文章分类2', 'aaaa', NULL);
INSERT INTO `sys_dict` VALUES (24, '111', '2222', '{\"1\": \"字典项11\", \"2\": \"字典项22\"}');
INSERT INTO `sys_dict` VALUES (25, '1111', '333', '{\"1\": \"字典项1\", \"2\": \"字典项2\"}');
COMMIT;

-- ----------------------------
-- Table structure for sys_permission
-- ----------------------------
DROP TABLE IF EXISTS `sys_permission`;
CREATE TABLE `sys_permission` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `pid` int NOT NULL DEFAULT '0' COMMENT '父级菜单id',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `sort` smallint NOT NULL DEFAULT '0' COMMENT '菜单排序',
  `url` varchar(200) NOT NULL DEFAULT '' COMMENT '接口api地址',
  `redirect` varchar(50) NOT NULL DEFAULT '' COMMENT '前端路由',
  `component` varchar(50) NOT NULL DEFAULT '' COMMENT '前端路由的component',
  `icon` varchar(30) NOT NULL DEFAULT '' COMMENT '图标',
  `menu` tinyint NOT NULL DEFAULT '1' COMMENT '是否菜单 0、否 1、是',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '状态,0、未启用 1正常',
  PRIMARY KEY (`id`),
  KEY `segment` (`url`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='后台菜单表';

-- ----------------------------
-- Records of sys_permission
-- ----------------------------
BEGIN;
INSERT INTO `sys_permission` VALUES (1, 0, '首页顶级', 10, 'index', '/dashboard', 'index', 'form', 0, 1);
INSERT INTO `sys_permission` VALUES (3, 0, '权限管理', 3, '', '/Role/RoleIndex', 'Role', 'table', 1, 1);
INSERT INTO `sys_permission` VALUES (4, 3, '菜单列表', 0, 'menus', '/Role/RoleIndex', 'menus', '', 1, 1);
INSERT INTO `sys_permission` VALUES (5, 4, '添加菜单', 0, 'menu/add', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (6, 4, '获取菜单详情', 0, 'menu/detail', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (7, 4, '修改菜单', 0, 'menu/edit', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (8, 4, '删除菜单', 0, 'menu/delete', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (9, 3, '角色列表', 0, 'role/get', '/Role/Roles', 'Roles', '', 1, 1);
INSERT INTO `sys_permission` VALUES (10, 9, '添加角色', 0, 'role/add', '/Role/add', '/Role/add', 'form', 0, 1);
INSERT INTO `sys_permission` VALUES (11, 9, '修改角色', 0, 'role/edit', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (12, 9, '删除角色', 0, 'role/delete', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (13, 9, '获取角色详情', 0, 'role/detail', '', '', 'form', 0, 1);
INSERT INTO `sys_permission` VALUES (14, 3, '后台用户列表', 0, 'account/get', '/Role/Administrator', 'Administrator', '', 1, 1);
INSERT INTO `sys_permission` VALUES (15, 14, '新增用户', 0, 'account/add', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (16, 14, '获取用户详情', 0, 'account/detail', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (17, 14, '编辑用户', 0, 'account/edit', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (18, 14, '删除用户', 0, 'account/delete', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (19, 14, '修改密码', 0, 'account/alterPassword', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (20, 14, '重置密码', 0, 'account/resetPassword', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (21, 0, '字典管理', 0, '', 'dict', 'dict', 'dict', 1, 1);
INSERT INTO `sys_permission` VALUES (22, 21, '添加字典', 0, 'dict/add', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (23, 21, '删除指定字典', 0, 'dict/delete', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (24, 21, '编辑字典', 0, 'dict/edit', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (25, 21, '获取指定字典', 0, 'dict/detail', '', '', '', 0, 1);
INSERT INTO `sys_permission` VALUES (26, 21, '编辑字典项', 0, 'dict/item', '', '', '', 1, 1);
COMMIT;

-- ----------------------------
-- Table structure for sys_role
-- ----------------------------
DROP TABLE IF EXISTS `sys_role`;
CREATE TABLE `sys_role` (
  `id` smallint NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '角色名',
  `permission_ids` json DEFAULT NULL COMMENT '菜单id列表',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '状态 -1禁用,1启用',
  `create_time` int NOT NULL DEFAULT '0',
  `update_time` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='管理员角色表';

-- ----------------------------
-- Records of sys_role
-- ----------------------------
BEGIN;
INSERT INTO `sys_role` VALUES (1, '新测试', '[1, 2, 3, 4, 5, 6, 17]', 1, 1583924248, 1635314635);
INSERT INTO `sys_role` VALUES (2, 'test', '[1, 2, 3, 4, 9, 13, 14, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26]', 1, 1583924248, 1583993899);
INSERT INTO `sys_role` VALUES (5, '新测试1111', 'null', 0, 1626766884, 1626766884);
INSERT INTO `sys_role` VALUES (6, '新测试11111', 'null', 1, 1626766945, 1626766945);
INSERT INTO `sys_role` VALUES (8, '333333', 'null', 1, 1627440936, 1627440936);
COMMIT;

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `realname` varchar(10) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `avatar` varchar(200) NOT NULL DEFAULT '',
  `create_time` int NOT NULL DEFAULT '0' COMMENT '创建时间',
  `role_ids` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0' COMMENT '角色id,多角色用逗号分隔',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '状态,-1、已删除、1为正常,0为锁定',
  `update_time` int NOT NULL DEFAULT '0' COMMENT '更新时间',
  `admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1超级管理员,0否',
  `delete_time` int NOT NULL DEFAULT '0' COMMENT '软删除',
  PRIMARY KEY (`id`),
  KEY `role_ids` (`role_ids`),
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='管理员表';

-- ----------------------------
-- Records of sys_user
-- ----------------------------
BEGIN;
INSERT INTO `sys_user` VALUES (1, 'admin', '157c7fcd51b16e99fe437ecc4ac2dbbf', '超级管理员', '2.jpg', 1580977735, '1', 1, 1648559378, 1, 0);
INSERT INTO `sys_user` VALUES (4, 'xilin2', '59ba753d5b4559a5f31dc45adf4dd419', '', '213.png', 1583547847, '1,2', 1, 0, 0, 0);
INSERT INTO `sys_user` VALUES (14, 'xilin1', 'f8f407490605d5fb6a645840ab7dd1a0', '陈明', '3.jpg', 1638437157, '1', 1, 1638437157, 0, 0);
INSERT INTO `sys_user` VALUES (15, 'aaaaa', 'f8f407490605d5fb6a645840ab7dd1a0', '陈明', '3.jpg', 1642646698, '1', 1, 1642646698, 0, 0);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
