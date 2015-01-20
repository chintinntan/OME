-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2015 at 02:14 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `databank_project`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_new_account`(IN `acct_type_id` INT(10), IN `id_num` VARCHAR(50), IN `acct_user` VARCHAR(50), IN `acct_pass` VARCHAR(50), IN `lname` VARCHAR(50), IN `fname` VARCHAR(50), IN `mname` VARCHAR(50))
BEGIN
	INSERT INTO `account`
	(
	`account_type_id`,
	`id_number`,
	`acct_username`,
	`acct_password`,
	`last_name`,
	`first_name`,
	`middle_name`,
	`acct_status`,
	`time_created`,
	`time_updated`
	)
	VALUES
	(
	acct_type_id,
	id_num,
	acct_user,
	acct_pass,
	lname,
	fname,
	mname,
	1,
	Now(),
	Now()
	);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_new_class`(IN `teacher_acct_id` INT(10), IN `section` VARCHAR(50), IN `course` VARCHAR(50), IN `semester` VARCHAR(50), IN `school_year` VARCHAR(50), IN `subject_id` VARCHAR(50))
BEGIN
	INSERT INTO `class_record`
	(
	`account_id`,
	`semester`,
	`school_year`,
	`course_id`,
	`section_id`,
	`subject_id`
	)
	VALUES
	(
	teacher_acct_id,
	semester,
	school_year,
	course,
	section,
	subject_id
	);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_new_record`(IN `stud_id` INT(10), IN `cr_id` INT(10))
BEGIN
	INSERT INTO `class_student`
	(
	`student_id`,
	`class_record_id`
	)
	VALUES
	(
	stud_id,
	cr_id
	);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_new_section`(IN `section_acronym` VARCHAR(50))
BEGIN
	INSERT INTO `section`
	(
	`label`
	)
	VALUES
	(
	section_acronym
	);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_new_student`(IN `course` INT(10), IN `acct_id` INT(10), IN `yr_lvl` INT(10))
BEGIN
	INSERT INTO `student`
	(
	`course_id`,
	`account_id`,
	`year_level`
	)
	VALUES
	(
	course,
	acct_id,
	yr_lvl
	);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_question`(IN subj_id INT(10), IN period INT(10), IN questionnaire VARCHAR(400))
BEGIN
	INSERT INTO `questionnaire`
	(
	`subject_id`,
	`grading_period_id`,
	`question`,
	`time_created`,
	`time_updated`
	)
	VALUES
	(
	subj_id,
	period,
	questionnaire,
	NOW(),
	NOW()
	);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_login_details`(IN `username` VARCHAR(50), IN `userpass` VARCHAR(50))
BEGIN
	SELECT 
	account_id,
	id_number,
	acct_username,
	acct_password,
	last_name,
	first_name,
	middle_name,
	account_type.label AS acct_type
	FROM databank_project.account 
	LEFT JOIN databank_project.account_type 
	ON databank_project.account.account_type_id=databank_project.account_type.account_type_id
	WHERE acct_username = username
	AND acct_password = userpass;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_account_details`()
BEGIN
	SELECT 
	account_id,
	last_name,
	first_name,
	middle_name,
	acct_status,
	account_type.label as acct_type
	FROM databank_project.account 
	LEFT JOIN databank_project.account_type 
	ON databank_project.account.account_type_id = databank_project.account_type.account_type_id
	ORDER BY acct_type ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_acct_type`(IN `username` VARCHAR(50), IN `userpass` VARCHAR(50))
BEGIN
	SELECT account_type_id FROM databank_project.account
	WHERE acct_username = username
	AND acct_password = userpass;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_assign_details`(IN `acct_id` VARCHAR(50), IN `class_id` INT(11))
BEGIN
	SELECT 	
		class_record.class_record_id,
		class_record.school_year as school_year,
		class_record.semester as semester,
		subjects.subject_label,
		course.acronym AS course,
		section.label AS section,
		account.last_name AS lname,
		account.first_name AS fname,
		account.middle_name AS mname

	FROM databank_project.class_record 
	
	LEFT JOIN subjects ON class_record.subject_id = subjects.subject_id
	LEFT JOIN course ON class_record.course_id = course.course_id
	LEFT JOIN section ON class_record.section_id = section.section_id
	LEFT JOIN account ON class_record.account_id = account.account_id
	WHERE class_record.account_id = acct_id
	AND class_record.class_record_id = class_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_class_record`(IN `acct_id` VARCHAR(50))
BEGIN
	SELECT
		subjects.subject_id,
		subjects.subject_label,
		course.course_id,
		course.acronym AS course,
		section.label AS section,
		section.section_id AS sec_id,
		class_record.class_record_id

	FROM databank_project.class_record 
	
	LEFT JOIN subjects ON class_record.subject_id = subjects.subject_id
	LEFT JOIN course ON class_record.course_id = course.course_id
	LEFT JOIN section ON class_record.section_id = section.section_id
	LEFT JOIN account ON class_record.account_id = account.account_id
	WHERE class_record.account_id = acct_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_class_record_list`(IN subj_id INT, IN sec_id INT)
BEGIN
	SELECT 	account.last_name,
		account.first_name,
		account.middle_name,
		course.acronym,
		student.year_level,
		subjects.subject_label,
		section.label

	FROM databank_project.class_student
	LEFT JOIN student ON class_student.student_id=student.student_id
	LEFt JOIN account ON student.account_id = account.account_id
	LEFT JOIN class_record ON class_student.class_record_id=class_record.class_record_id
	LEFT JOIN course ON student.course_id=course.course_id
	LEFT JOIN subjects ON class_record.subject_id = subjects.subject_id
	LEFT JOIN section ON class_record.section_id = section.section_id

	WHERE class_record.subject_id = subj_id AND class_record.section_id = sec_id
	ORDER BY first_name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_course_details`()
BEGIN
	SELECT course_id, acronym FROM databank_project.course;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_course_name`(IN `c_id` INT(11))
BEGIN
	SELECT acronym 
	FROM databank_project.course
	WHERE course_id = c_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_dropdown_acct_type`()
BEGIN
	SELECT * FROM databank_project.account_type;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_period`()
BEGIN
	SELECT * FROM grading_period;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_questions`(IN subj_id INT(10))
BEGIN
	SELECT question FROM questionnaire WHERE subject_id = subj_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_section_data`()
BEGIN
	SELECT * FROM databank_project.section ORDER BY label ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_section_details`()
BEGIN
	SELECT * FROM databank_project.section ORDER BY label;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_section_name`(IN `s_id` INT(11))
BEGIN
	SELECT label 
	FROM databank_project.section
	WHERE section_id = s_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_sec_update_data`(IN `sec_id` INT(10))
BEGIN
	SELECT * FROM databank_project.section WHERE `section_id` = sec_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_student_details`()
BEGIN
	SELECT * from student left join account on student.account_id = account.account_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_student_list`()
BEGIN
	SELECT 	
			student.year_level,
			course.acronym,
			course.course_id,
			student.student_id,
			account.last_name,
			account.first_name,
			account.middle_name,
			student.student_id
			
	FROM databank_project.student
	LEFT JOIN course 
	ON course.course_id = student.course_id
	LEFT JOIN account 
	ON account.account_id = student.account_id
	ORDER BY year_level;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_student_name`(IN `stud_id` VARCHAR(50))
BEGIN
	SELECT * FROM `account`
	WHERE account_id = stud_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_stud_update_data`(IN `stud_id` INT(10))
BEGIN
	SELECT 	course.acronym,
			course.course_id,
			student.student_id,
			account.last_name,
			account.first_name,
			account.middle_name,
			student.year_level
	FROM databank_project.student
	LEFT JOIN course 
	ON course.course_id = student.course_id
	LEFT JOIN account 
	ON account.account_id = student.account_id
	WHERE student.student_id = stud_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_subject_class`(IN class_rec_id INT)
BEGIN
	SELECT last_name,first_name,middle_name,course_label, class_student.class_student_id AS stud_id 
	FROM databank_project.class_student 
	LEFT JOIN student ON class_student.student_id=student.student_id
	LEFT JOIN account ON student.account_id=account.account_id
	LEFT JOIN course ON student.course_id=course.course_id
	LEFT JOIN class_record ON class_student.class_record_id=class_record.class_record_id

	WHERE class_student.class_record_id = class_rec_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_subject_details`()
BEGIN
	SELECT * FROM databank_project.subjects ORDER BY subject_label;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_teacher_list`()
BEGIN
	SELECT * FROM databank_project.account WHERE account_type_id = 2
	ORDER BY last_name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_teacher_name`(IN `acct_id` VARCHAR(50))
BEGIN
	SELECT
		account_id AS acct_id,
		last_name AS lname,
		first_name AS fname,
		middle_name AS mname
	FROM databank_project.account 
	WHERE account_id = acct_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_teacher_subjects`(IN acct_id INT)
BEGIN
	SELECT
	subjects.subject_id, 
	subjects.subject_label,
	course.course_label 
	FROM class_record 
	LEFT JOIN course ON class_record.course_id=course.course_id
	LEFT JOIN subjects ON class_record.subject_id=subjects.subject_id
	LEFT JOIN section ON class_record.section_id=section.section_id
	WHERE class_record.account_id=acct_id
	GROUP BY subjects.subject_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_update_details`(IN `acct_id` INT(11))
BEGIN
	SELECT 
	account_id,
	id_number,
	acct_username,
	acct_password,
	last_name,
	first_name,
	middle_name,
	account_type.label as acct_type,
	acct_status
	FROM databank_project.account 
	LEFT JOIN databank_project.account_type 
	ON databank_project.account.account_type_id = databank_project.account_type.account_type_id
	WHERE account_id = acct_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `register_student`(IN stud_id INT, IN class_rec_id INT)
BEGIN
	INSERT INTO `databank_project`.`class_student`
	(
	`student_id`,
	`class_record_id`
	)
VALUES
	(
	stud_id,
	class_rec_id
	);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `remove_student`(IN stud_id INT)
BEGIN
	DELETE FROM class_student WHERE class_student_id = stud_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_stud_details`(IN stud_id INT)
BEGIN
	SELECT 	
			student.year_level,
			course.acronym,
			course.course_id,
			student.student_id,
			account.last_name,
			account.first_name,
			account.middle_name,
			student.student_id
			
	FROM databank_project.student
	LEFT JOIN course 
	ON course.course_id = student.course_id
	LEFT JOIN account 
	ON account.account_id = student.account_id
	WHERE student.student_id = stud_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_account`(IN `acct_id` INT(11), IN `acct_type` INT(11), IN `id_num` VARCHAR(50), IN `acct_user` VARCHAR(50), IN `acct_pass` VARCHAR(50), IN `lname` VARCHAR(50), IN `fname` VARCHAR(50), IN `mname` VARCHAR(50), IN `acct_status` INT(10))
BEGIN
	UPDATE databank_project.account
	SET
	`account_type_id` = acct_type,
	`id_number` = id_num,
	`acct_username` = acct_user,
	`acct_password` = acct_pass,
	`last_name` = lname,
	`first_name` = fname,
	`middle_name` = mname,
	`acct_status` = acct_status,
	`time_updated` = NOW()
	WHERE `account_id` = acct_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_section`(IN `sec_id` INT(11), IN `sec_name` VARCHAR(50))
BEGIN
	UPDATE databank_project.section
	SET
	`label` = sec_name
	WHERE `section_id` = sec_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_stud_data`(IN `course` INT(11), IN `stud_id` INT(11), IN `yr_lvl` INT(11))
BEGIN
	UPDATE databank_project.student
	SET
	`course_id` = course,
	`year_level` = yr_lvl
	WHERE `student_id` = stud_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_type_id` int(11) NOT NULL,
  `id_number` int(11) NOT NULL,
  `acct_username` varchar(50) NOT NULL,
  `acct_password` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `acct_status` tinyint(4) NOT NULL,
  `time_created` datetime NOT NULL,
  `time_updated` datetime NOT NULL,
  PRIMARY KEY (`account_id`),
  KEY `account_type` (`account_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_type_id`, `id_number`, `acct_username`, `acct_password`, `last_name`, `first_name`, `middle_name`, `acct_status`, `time_created`, `time_updated`) VALUES
(1, 1, 1234, 'admin', 'admin', 'LIM', 'LANCE', 'KELVIN', 0, '2013-10-25 00:00:00', '2014-12-13 14:30:40'),
(2, 2, 12345, 'teach', 'teach', 'PADAO', 'JOHN-JOHN', 'PURGATORIO', 1, '2013-10-25 00:00:00', '2014-12-13 14:31:03'),
(3, 3, 1102089, '1102089', '1234', 'TAN', 'CHIN TINN LOURENCE', 'SON', 1, '2014-12-09 19:53:12', '2014-12-13 14:31:19'),
(5, 3, 123456, 'teach2', 'teach2', 'QUITORIANO', 'JESRYLL', 'POCHOLO', 0, '2014-12-09 21:19:23', '2014-12-13 14:31:31'),
(6, 3, 900123, 'pets', 'pets', 'MIJARES', 'PETS', 'PETS', 0, '2014-12-10 21:47:13', '2014-12-13 14:31:43'),
(7, 3, 91234, 'zeus', 'zeus', 'KITOR', 'ZEUS', 'ROSHAN', 1, '2014-12-10 21:51:08', '2014-12-13 14:31:57'),
(8, 3, 98773, 'qtongs', 'qtongs', 'SETONGS', 'QUITONGS', 'BETONGS', 1, '2014-12-10 21:52:00', '2014-12-13 14:32:11'),
(9, 2, 912312, 'one', 'one123', 'JUANSPEDRO', 'JUANS', 'PEDRO', 1, '2014-12-10 21:53:43', '2014-12-13 14:32:31'),
(10, 2, 98763, 'kitors', 'kitors', 'QUITOR', 'KITORSTYLE', 'STYLE', 0, '2014-12-10 21:54:11', '2014-12-13 14:32:42'),
(11, 2, 912312, 'sevilla', 'padao', 'SEVILLA', 'JOHN', 'MIGUEL', 1, '2014-12-10 21:55:15', '2014-12-13 14:32:52'),
(12, 2, 93821, 'world', 'world', 'TWO', 'WORLD', 'WAR', 1, '2014-12-10 21:55:47', '2014-12-13 14:33:03'),
(13, 1, 9876, 'chin', 'chin', 'SON', 'CHIN LOURENCE', 'TINN', 1, '2014-12-10 22:05:59', '2014-12-13 14:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE IF NOT EXISTS `account_type` (
  `account_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`account_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`account_type_id`, `label`) VALUES
(1, 'ADMIN'),
(2, 'TEACHER'),
(3, 'STUDENT');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `questionnaire_id` int(11) NOT NULL,
  `label` varchar(150) NOT NULL,
  `correct` int(11) NOT NULL,
  PRIMARY KEY (`answer_id`),
  KEY `questionnaire_id` (`questionnaire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attempt`
--

CREATE TABLE IF NOT EXISTS `attempt` (
  `attempt_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `attempt_status` tinyint(4) NOT NULL,
  `time_start` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `date_exam` datetime NOT NULL,
  PRIMARY KEY (`attempt_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `class_record`
--

CREATE TABLE IF NOT EXISTS `class_record` (
  `class_record_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `school_year` varchar(20) NOT NULL,
  `course_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`class_record_id`),
  KEY `teacher_id` (`account_id`),
  KEY `course_id` (`course_id`),
  KEY `section_id` (`section_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `class_record`
--

INSERT INTO `class_record` (`class_record_id`, `account_id`, `semester`, `school_year`, `course_id`, `section_id`, `subject_id`) VALUES
(39, 2, 1, 'SY 2013-2014', 1, 1, 1),
(41, 2, 1, 'SY 2013-2014', 1, 2, 1),
(42, 3, 1, 'SY 2013-2014', 1, 1, 1),
(43, 2, 2, 'SY 2013-2014', 1, 1, 5),
(44, 2, 2, 'SY 2013-2014', 1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `class_student`
--

CREATE TABLE IF NOT EXISTS `class_student` (
  `class_student_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_record_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`class_student_id`),
  KEY `class_record_id` (`class_record_id`,`student_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `class_student`
--

INSERT INTO `class_student` (`class_student_id`, `class_record_id`, `student_id`) VALUES
(21, 39, 5),
(24, 39, 10),
(23, 39, 11),
(22, 39, 12),
(27, 41, 5),
(20, 41, 11),
(26, 43, 5);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_label` varchar(255) NOT NULL,
  `acronym` varchar(100) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_label`, `acronym`) VALUES
(1, 'Bachelor of Science in Information Technology', 'BSIT'),
(2, 'Bachelor of Science in Computer Science', 'BSCS'),
(3, 'Bachelor of Sciece in Information Science', 'BSIS');

-- --------------------------------------------------------

--
-- Table structure for table `data_bank`
--

CREATE TABLE IF NOT EXISTS `data_bank` (
  `databank_id` int(11) NOT NULL AUTO_INCREMENT,
  `result_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`databank_id`),
  KEY `questionnaire_id` (`result_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `attempt_id` int(11) NOT NULL,
  `exam_schedule_id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`exam_id`),
  KEY `attempt_id` (`attempt_id`,`exam_schedule_id`,`questionnaire_id`),
  KEY `exam_schedule_id` (`exam_schedule_id`),
  KEY `questionnaire_id` (`questionnaire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedule`
--

CREATE TABLE IF NOT EXISTS `exam_schedule` (
  `exam_schedule_id` int(11) NOT NULL,
  `class_record_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`exam_schedule_id`),
  KEY `class_record_id` (`class_record_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grading_period`
--

CREATE TABLE IF NOT EXISTS `grading_period` (
  `grading_period_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  PRIMARY KEY (`grading_period_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `grading_period`
--

INSERT INTO `grading_period` (`grading_period_id`, `label`) VALUES
(1, 'Prelims'),
(2, 'Midterms'),
(3, 'Finals');

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire`
--

CREATE TABLE IF NOT EXISTS `questionnaire` (
  `questionnaire_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `grading_period_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `question` varchar(400) NOT NULL,
  `time_created` datetime NOT NULL,
  `time_updated` datetime NOT NULL,
  PRIMARY KEY (`questionnaire_id`),
  KEY `subject_id` (`subject_id`),
  KEY `grading_periods_id` (`grading_period_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `questionnaire`
--

INSERT INTO `questionnaire` (`questionnaire_id`, `subject_id`, `grading_period_id`, `status_id`, `question`, `time_created`, `time_updated`) VALUES
(1, 1, 1, 1, 'Hello World!', '2015-01-20 03:07:47', '2015-01-20 03:07:47'),
(3, 1, 2, 1, 'Hello World2!', '2015-01-20 03:09:57', '2015-01-20 03:09:57'),
(4, 1, 3, 1, 'Hello World3!', '2015-01-20 03:33:34', '2015-01-20 03:33:34'),
(5, 1, 1, 1, 'Hello World4!', '2015-01-20 03:35:27', '2015-01-20 03:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`result_id`),
  KEY `student_id` (`student_id`,`questionnaire_id`),
  KEY `questionnaire_id` (`questionnaire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `label`) VALUES
(1, '1A'),
(2, '1B'),
(3, '1C'),
(4, '1D'),
(5, '1E'),
(6, '2A'),
(7, '2B'),
(8, '2C'),
(9, '2D'),
(10, '3A'),
(11, '3B'),
(12, '3C'),
(13, '3D');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(20) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `year_level` int(11) NOT NULL,
  `class_record_id` int(11) NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `account_id` (`account_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `course_id`, `account_id`, `year_level`, `class_record_id`) VALUES
(5, 3, 3, 1, 0),
(10, 1, 5, 4, 0),
(11, 1, 6, 2, 0),
(12, 2, 7, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_label` varchar(255) NOT NULL,
  `acronym` varchar(100) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_label`, `acronym`) VALUES
(1, 'Techpreneurship', 'Techpre'),
(2, 'Filipino 1', 'Fil1'),
(3, 'English 1', 'Eng1'),
(4, 'Discrete Math', 'Math311'),
(5, 'Computer Programming 1', 'Cprog1'),
(6, 'Computer Programming 2', 'Cprog2'),
(7, 'Psychology', 'Psych1'),
(8, 'Religious Studies 1', 'RS1'),
(9, 'Religious Studies 2', 'RS2'),
(10, 'Religious Studies 3', 'RS3');

-- --------------------------------------------------------

--
-- Table structure for table `subs_ins`
--

CREATE TABLE IF NOT EXISTS `subs_ins` (
  `subs_ins_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `acronym` varchar(20) NOT NULL,
  PRIMARY KEY (`subs_ins_id`),
  KEY `course_id` (`teacher_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`teacher_id`),
  KEY `subject_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `account_id`) VALUES
(1, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`account_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaire` (`questionnaire_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attempt`
--
ALTER TABLE `attempt`
  ADD CONSTRAINT `attempt_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_record`
--
ALTER TABLE `class_record`
  ADD CONSTRAINT `class_record_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_record_ibfk_4` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_record_ibfk_5` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_record_ibfk_6` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_student`
--
ALTER TABLE `class_student`
  ADD CONSTRAINT `class_student_ibfk_1` FOREIGN KEY (`class_record_id`) REFERENCES `class_record` (`class_record_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_student_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_bank`
--
ALTER TABLE `data_bank`
  ADD CONSTRAINT `data_bank_ibfk_1` FOREIGN KEY (`result_id`) REFERENCES `result` (`result_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`attempt_id`) REFERENCES `attempt` (`attempt_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_ibfk_2` FOREIGN KEY (`exam_schedule_id`) REFERENCES `exam_schedule` (`exam_schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_ibfk_3` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaire` (`questionnaire_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD CONSTRAINT `exam_schedule_ibfk_1` FOREIGN KEY (`class_record_id`) REFERENCES `class_record` (`class_record_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD CONSTRAINT `questionnaire_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questionnaire_ibfk_3` FOREIGN KEY (`grading_period_id`) REFERENCES `grading_period` (`grading_period_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaire` (`questionnaire_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subs_ins`
--
ALTER TABLE `subs_ins`
  ADD CONSTRAINT `subs_ins_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subs_ins_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
