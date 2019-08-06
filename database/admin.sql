-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host:     Database: my-shop.test
-- ------------------------------------------------------
-- Server version	5.7.26

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
-- Dumping data for table `admin_menu`
--

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,0,1,'首页','fa-bar-chart','/',NULL,NULL,'2019-07-23 21:45:21'),(2,0,9,'系统管理','fa-tasks',NULL,NULL,NULL,'2019-08-05 06:46:34'),(3,2,10,'管理员','fa-users','auth/users',NULL,NULL,'2019-08-05 06:46:34'),(4,2,11,'角色','fa-user','auth/roles',NULL,NULL,'2019-08-05 06:46:34'),(5,2,12,'权限','fa-ban','auth/permissions',NULL,NULL,'2019-08-05 06:46:34'),(6,2,13,'菜单管理','fa-bars','auth/menu',NULL,NULL,'2019-08-05 06:46:34'),(7,2,14,'日志','fa-history','auth/logs',NULL,NULL,'2019-08-05 06:46:34'),(8,0,2,'用户管理','fa-users','/users',NULL,'2019-07-23 22:09:30','2019-07-23 22:09:39'),(9,0,3,'商品管理','fa-product-hunt','/products',NULL,'2019-07-24 00:15:45','2019-07-24 00:15:49'),(10,9,5,'sku 分类','fa-bars','/product-sku-attributes',NULL,'2019-07-24 01:37:35','2019-07-24 19:26:13'),(11,9,4,'普通商品','fa-product-hunt','/products',NULL,'2019-07-24 01:38:26','2019-07-24 01:38:34'),(12,9,6,'单品管理','fa-cubes','/product-skus',NULL,'2019-07-24 19:25:56','2019-08-01 07:33:49'),(13,0,8,'订单管理','fa-rmb','/orders',NULL,'2019-08-01 07:33:43','2019-08-06 02:37:30'),(14,0,7,'优惠券','fa-cc-jcb','/coupon_codes',NULL,'2019-08-05 06:46:27','2019-08-05 06:46:34');
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_permissions`
--

LOCK TABLES `admin_permissions` WRITE;
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` VALUES (1,'All permission','*','','*',NULL,NULL),(2,'Dashboard','dashboard','GET','/',NULL,NULL),(3,'Login','auth.login','','/auth/login\r\n/auth/logout',NULL,NULL),(4,'User setting','auth.setting','GET,PUT','/auth/setting',NULL,NULL),(5,'Auth management','auth.management','','/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs',NULL,NULL),(6,'用户管理','users','','/users*','2019-07-23 22:11:49','2019-07-23 22:11:49'),(7,'商品管理','products','','/products*','2019-08-06 02:38:14','2019-08-06 02:38:14'),(8,'优惠券管理','coupon_codes','','/coupon_codes*','2019-08-06 02:39:11','2019-08-06 02:39:11'),(9,'订单管理','orders','','/orders*','2019-08-06 02:39:42','2019-08-06 02:39:42');
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_menu`
--

LOCK TABLES `admin_role_menu` WRITE;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` VALUES (1,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_permissions`
--

LOCK TABLES `admin_role_permissions` WRITE;
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
INSERT INTO `admin_role_permissions` VALUES (1,1,NULL,NULL),(2,2,NULL,NULL),(2,3,NULL,NULL),(2,4,NULL,NULL),(2,6,NULL,NULL),(2,7,NULL,NULL),(2,8,NULL,NULL),(2,9,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_users`
--

LOCK TABLES `admin_role_users` WRITE;
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` VALUES (1,1,NULL,NULL),(2,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_roles`
--

LOCK TABLES `admin_roles` WRITE;
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` VALUES (1,'Administrator','administrator','2019-07-23 21:40:49','2019-07-23 21:40:49'),(2,'运营','operate','2019-07-23 22:12:59','2019-07-23 22:12:59');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_user_permissions`
--

LOCK TABLES `admin_user_permissions` WRITE;
/*!40000 ALTER TABLE `admin_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'admin','$2y$10$v5IzsNn.yDpcyn4cco7OX.V0f0w1h3Zt8o6L/4wq7deyju3Q3A7De','Administrator',NULL,'h6jsAt6IJqYsgR8xr3l4fM4bt0JPMOlG6loL2Gusf7E2ZNpVCqZqICUVcWgR','2019-07-23 21:40:49','2019-07-23 21:40:49'),(2,'operate','$2y$10$F1NagIsj1vFtiv9UwTf9dek5ChNxXH27s1xVE5qlYLp737dIfebBy','运营',NULL,'4M47cG1oDa5uH6sh8q31E7QebA2j3FMlcwlVoSehenkVq7kB8dTi3gxhJvXU','2019-07-23 22:16:28','2019-07-23 22:16:28');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-06 11:22:34
