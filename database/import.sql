-- MySQL dump 10.13  Distrib 5.7.15, for Linux (x86_64)
--
-- Host: %    Database: eugene
-- ------------------------------------------------------
-- Server version	5.7.13-0ubuntu0.16.04.2

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
-- Dumping routines for database 'eugene'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_category_create` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;

USE sql6139973;

DELIMITER ;;
CREATE DEFINER=`sql6139973`@`%` PROCEDURE `sp_category_create`(
	IN p_industry_id INT,
	IN p_name VARCHAR(255),
	OUT alert_message TEXT,
	OUT return_id INT
)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		SET alert_message = "SQL EXCEPTION ERROR; Procedure Name : sp_category_create";
	END;

	#DECLARE EXIT HANDLER FOR SQLWARNING
	#BEGIN
  #SET alert_message = "SQL WARNING; Procedure Name : sp_category_create";
	#END;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET alert_message = "SQL CONTINUE HANDLER; Procedure Name : sp_category_create";

	SET @category_id = NULL;

	SELECT id INTO @category_id FROM job_categories WHERE name = p_name AND job_industries_id = p_industry_id LIMIT 1;

	IF @category_id IS NULL THEN

		INSERT INTO job_categories(name,job_industries_id) VALUES(p_name,p_industry_id);

		SET alert_message = "Success";

		SET return_id = LAST_INSERT_ID();

	ELSE

		SET alert_message = "Duplicate";

		SET return_id = 0;		

	END IF;
		
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_category_update` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`sql6139973`@`%` PROCEDURE `sp_category_update`(
	IN p_category_id INT,
	IN p_industry_id INT,
	IN p_name VARCHAR(255),
	OUT alert_message TEXT,
	OUT return_id INT
)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		SET alert_message = "SQL EXCEPTION ERROR; Procedure Name : sp_category_update";
	END;

	#DECLARE EXIT HANDLER FOR SQLWARNING
	#BEGIN
	#	SET alert_message = "SQL WARNING; Procedure Name : sp_category_update";
	#END;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET alert_message = "SQL CONTINUE HANDLER; Procedure Name : sp_category_update";

	SET @category_id = NULL;

	SELECT id INTO @category_id FROM job_categories WHERE name = p_name AND job_industries_id = p_industry_id AND id != p_category_id LIMIT 1;

	IF @category_id IS NULL THEN

		UPDATE job_categories SET name = p_name, job_industries_id = p_industry_id WHERE id = p_category_id;

		SET alert_message = "Success";

		SET return_id = p_category_id;

	ELSE

		SET alert_message = "Duplicate";

		SET return_id = 0;		

	END IF;
		
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_create_user` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`sql6139973`@`%` PROCEDURE `sp_create_user`(
	
	IN p_role_name VARCHAR(255),
	IN p_first_name VARCHAR(255),
	IN p_last_name VARCHAR(255),
	IN p_email VARCHAR(255),
	IN p_password VARCHAR(255),
	OUT alert_message TEXT,
	OUT return_id INT
)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		SET alert_message = "SQL EXCEPTION ERROR; Procedure Name : sp_create_user";
	END;

	#DECLARE EXIT HANDLER FOR SQLWARNING
	#BEGIN
	#	SET alert_message = "SQL WARNING; Procedure Name : sp_create_user";
	#END;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET alert_message = "SQL CONTINUE HANDLER; Procedure Name : sp_create_user";

	SET @user_id = NULL;	

	SELECT id INTO @user_id FROM `users` WHERE `username` = p_email LIMIT 1;

	IF @user_id IS NULL THEN

		INSERT INTO users(`username`,`password`,`user_states_id`) VALUES(p_email,md5(p_password),(SELECT `id` FROM `user_states` WHERE `name` = 'Pending Activation'));

		SET @user_id = LAST_INSERT_ID();

		INSERT INTO user_profiles(`first_name`, `last_name`, `users_id`) VALUES(p_first_name,p_last_name,@user_id);	

		INSERT INTO user_roles(`users_id`,`roles_id`) VALUES(@user_id, (SELECT id FROM `roles` WHERE `name` = p_role_name));

		SET alert_message = "Success";

		SET return_id = @user_id;

	ELSE

		SET alert_message = "Duplicate";

		SET return_id = 0;		

	END IF;
		
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_create_vacancy` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`sql6139973`@`%` PROCEDURE `sp_create_vacancy`(
	
	IN p_users_id INT,
	IN p_job_categories_id INT,
	IN p_cities_id INT,
	IN p_company VARCHAR(255),
	IN p_title VARCHAR(255),
	IN p_description TEXT,
	IN p_salary VARCHAR(255),
	IN p_address VARCHAR(255),
	OUT alert_message TEXT,
	OUT return_id INT
)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		SET alert_message = "SQL EXCEPTION ERROR; Procedure Name : sp_create_vacancy";
	END;

	#DECLARE EXIT HANDLER FOR SQLWARNING
	#BEGIN
	#	SET alert_message = "SQL WARNING; Procedure Name : sp_create_vacancy";
	#END;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET alert_message = "SQL CONTINUE HANDLER; Procedure Name : sp_create_vacancy";

	INSERT INTO `vacancies`(
		`users_id`,
		`vacancy_states_id`,
		`job_categories_id`,
		`cities_id`,
		`address`,
		`company`,
		`title`,
		`description`,
		`salary`
	) VALUES(
		p_users_id,
		(SELECT id FROM `vacancy_states` WHERE `name` = 'Pending Approval' LIMIT 1),
		p_job_categories_id,
		p_cities_id,
		p_address,
		p_company,
		p_title,
		p_description,
		p_salary
	);

	SET alert_message = "Success";

	SET return_id = LAST_INSERT_ID();
		
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_industry_create` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`sql6139973`@`%` PROCEDURE `sp_industry_create`(
	IN p_name VARCHAR(255),
	OUT alert_message TEXT,
	OUT return_id INT
)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		SET alert_message = "SQL EXCEPTION ERROR; Procedure Name : sp_industry_create";
	END;

	#DECLARE EXIT HANDLER FOR SQLWARNING
	#BEGIN
	#	SET alert_message = "SQL WARNING; Procedure Name : sp_industry_create";
	#END;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET alert_message = "SQL CONTINUE HANDLER; Procedure Name : sp_industry_create";

	SET @industry_id = NULL;

	SELECT id INTO @industry_id FROM job_industries WHERE name = p_name LIMIT 1;

	IF @industry_id IS NULL THEN

		INSERT INTO job_industries(name) VALUES(p_name);

		SET alert_message = "Success";

		SET return_id = LAST_INSERT_ID();

	ELSE

		SET alert_message = "Duplicate";

		SET return_id = 0;		

	END IF;
		
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_industry_update` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`sql6139973`@`%` PROCEDURE `sp_industry_update`(
	IN p_id INT,
	IN p_name VARCHAR(255),
	OUT alert_message TEXT,
	OUT return_id INT
)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		SET alert_message = "SQL EXCEPTION ERROR; Procedure Name : sp_industry_update";
	END;

	#DECLARE EXIT HANDLER FOR SQLWARNING
	#BEGIN
	#	SET alert_message = "SQL WARNING; Procedure Name : sp_industry_update";
	#END;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET alert_message = "SQL CONTINUE HANDLER; Procedure Name : sp_industry_update";

	SET @industry_id = NULL;

	SELECT id INTO @industry_id FROM job_industries WHERE name = p_name AND id != p_id LIMIT 1;

	IF @industry_id IS NULL THEN

		UPDATE job_industries SET name = p_name WHERE id = p_id LIMIT 1;

		SET alert_message = "Success";

		SET return_id = p_id;

	ELSE

		SET alert_message = "Duplicate";

		SET return_id = 0;		

	END IF;
		
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_insert` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`sql6139973`@`%` PROCEDURE `sp_insert`(
	IN tbl VARCHAR(255),
	IN tbl_fields TEXT,
	IN tbl_fields_value TEXT,
	OUT return_id INT,
	OUT result TEXT)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		SET result = CONCAT_WS(' ', "SQL EXCEPTION ERROR; sp_dynamic_insert:", @insert_stmt);
	END;

	#DECLARE EXIT HANDLER FOR SQLWARNING
	#BEGIN
	#	SET result = CONCAT_WS(' ', "SQL WARNING; sp_dynamic_insert:", @insert_stmt);
	#END;

	DECLARE CONTINUE HANDlER FOR SQLSTATE '23000'
	BEGIN
		SET result = 'Duplicate key in index';
	END;

	SET @insert_stmt = CONCAT("INSERT INTO ", tbl," (", tbl_fields,") VALUES (", tbl_fields_value,");");
	PREPARE stmt FROM @insert_stmt;
	EXECUTE stmt;

	SET return_id = LAST_INSERT_ID();
	SET result = "success";
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_create` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`sql6139973`@`%` PROCEDURE `sp_user_create`(
	
	IN p_role_name VARCHAR(255),
	IN p_first_name VARCHAR(255),
	IN p_last_name VARCHAR(255),
	IN p_email VARCHAR(255),
	IN p_password VARCHAR(255),
	IN p_user_state VARCHAR(255),
	OUT alert_message TEXT,
	OUT return_id INT
)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		SET alert_message = "SQL EXCEPTION ERROR; Procedure Name : sp_user_create";
	END;

	#DECLARE EXIT HANDLER FOR SQLWARNING
	#BEGIN
	#	SET alert_message = "SQL WARNING; Procedure Name : sp_user_create";
	#END;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET alert_message = "SQL CONTINUE HANDLER; Procedure Name : sp_user_create";

	SET @user_id = NULL;	

	SELECT id INTO @user_id FROM `users` WHERE `username` = p_email LIMIT 1;

	IF @user_id IS NULL THEN

		INSERT INTO users(`username`,`password`,`user_states_id`) VALUES(p_email,md5(p_password),(SELECT `id` FROM `user_states` WHERE `name` = p_user_state));

		SET @user_id = LAST_INSERT_ID();

		INSERT INTO user_profiles(`first_name`, `last_name`, `users_id`) VALUES(p_first_name,p_last_name,@user_id);	

		INSERT INTO user_roles(`users_id`,`roles_id`) VALUES(@user_id, (SELECT id FROM `roles` WHERE `name` = p_role_name));

		SET alert_message = "Success";

		SET return_id = @user_id;

	ELSE

		SET alert_message = "Duplicate";

		SET return_id = 0;		

	END IF;
		
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_update` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`sql6139973`@`%` PROCEDURE `sp_user_update`(
	IN p_user_id INT,
	IN p_role_name VARCHAR(255),
	IN p_first_name VARCHAR(255),
	IN p_last_name VARCHAR(255),
	IN p_email VARCHAR(255),
	IN p_password VARCHAR(255),
	IN p_user_state VARCHAR(255),
	OUT alert_message TEXT,
	OUT return_id INT
)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		SET alert_message = "SQL EXCEPTION ERROR; Procedure Name : sp_user_update";
	END;

	#DECLARE EXIT HANDLER FOR SQLWARNING
	#BEGIN
	#	SET alert_message = "SQL WARNING; Procedure Name : sp_user_update";
	#END;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET alert_message = "SQL CONTINUE HANDLER; Procedure Name : sp_user_update";

	SET @user_id = NULL;	

	SELECT id INTO @user_id FROM `users` WHERE `username` = p_email AND id != p_user_id LIMIT 1;

	IF @user_id IS NULL THEN
		IF p_password != '' THEN
			UPDATE users
			SET 
				`username` = p_email,
				`password` = md5(p_password),
				`user_states_id` = (SELECT `id` FROM `user_states` WHERE `name` = p_user_state)
			WHERE id = p_user_id 
			LIMIT 1;
		ELSE
			UPDATE users
			SET 
				`username` = p_email,				
				`user_states_id` = (SELECT `id` FROM `user_states` WHERE `name` = p_user_state)
			WHERE id = p_user_id 
			LIMIT 1;
		END IF;

		UPDATE user_profiles
		SET
			`first_name` = p_first_name,
			`last_name` = p_last_name
		WHERE users_id = p_user_id
		LIMIT 1;

		UPDATE user_roles
		SET `roles_id` = (SELECT id FROM `roles` WHERE `name` = p_role_name)
		WHERE users_id = p_user_id
		LIMIT 1;
				
		SET alert_message = "Success";

		SET return_id = p_user_id;

	ELSE

		SET alert_message = "Duplicate";

		SET return_id = 0;		

	END IF;
		
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_vacancy_create` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`sql6139973`@`%` PROCEDURE `sp_vacancy_create`(
	
	IN p_users_id INT,
	IN p_job_categories_id INT,
	IN p_cities_id INT,
	IN p_company VARCHAR(255),
	IN p_title VARCHAR(255),
	IN p_description TEXT,
	IN p_salary VARCHAR(255),
	IN p_address VARCHAR(255),
	OUT alert_message TEXT,
	OUT return_id INT
)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		SET alert_message = "SQL EXCEPTION ERROR; Procedure Name : sp_create_vacancy";
	END;

	#DECLARE EXIT HANDLER FOR SQLWARNING
	#BEGIN
	#	SET alert_message = "SQL WARNING; Procedure Name : sp_create_vacancy";
	#END;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET alert_message = "SQL CONTINUE HANDLER; Procedure Name : sp_create_vacancy";

	INSERT INTO `vacancies`(
		`users_id`,
		`vacancy_states_id`,
		`job_categories_id`,
		`cities_id`,
		`address`,
		`company`,
		`title`,
		`description`,
		`salary`
	) VALUES(
		p_users_id,
		(SELECT id FROM `vacancy_states` WHERE `name` = 'Pending Approval' LIMIT 1),
		p_job_categories_id,
		p_cities_id,
		p_address,
		p_company,
		p_title,
		p_description,
		p_salary
	);

	SET alert_message = "Success";

	SET return_id = LAST_INSERT_ID();
		
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-13 11:07:32
