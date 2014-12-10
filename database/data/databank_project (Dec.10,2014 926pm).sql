-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2014 at 02:26 PM
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
	`status`,
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
	ON databank_project.account.account_type_id = databank_project.account_type.account_type_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_acct_type`(IN `username` VARCHAR(50), IN `userpass` VARCHAR(50))
BEGIN
	SELECT account_type_id FROM databank_project.account
	WHERE acct_username = username
	AND acct_password = userpass;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_section_details`()
BEGIN
	SELECT * FROM databank_project.section;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_section_name`(IN `s_id` INT(11))
BEGIN
	SELECT label 
	FROM databank_project.section
	WHERE section_id = s_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_student_details`()
BEGIN
	SELECT * FROM `account`
	WHERE account_type_id = 3;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_student_list`()
BEGIN
	SELECT 	course.acronym,
			student.student_id,
			account.last_name,
			account.first_name,
			account.middle_name
	FROM databank_project.student
	LEFT JOIN course 
	ON course.course_id = student.course_id
	LEFT JOIN account 
	ON account.account_id = student.account_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_student_name`(IN `stud_id` VARCHAR(50))
BEGIN
	SELECT * FROM `account`
	WHERE account_id = stud_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_stud_update_data`(IN `stud_id` INT(10))
BEGIN
	SELECT 	course.acronym,
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_subject_details`()
BEGIN
	SELECT * FROM databank_project.subjects;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_teacher_list`()
BEGIN
	SELECT * FROM databank_project.account WHERE account_type_id = 2;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_teacher_name`(IN `acct_id` VARCHAR(50))
BEGIN
	SELECT * FROM databank_project.account 
	WHERE account_type_id = 2
	AND account.account_id = acct_id;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_type_id`, `id_number`, `acct_username`, `acct_password`, `last_name`, `first_name`, `middle_name`, `acct_status`, `time_created`, `time_updated`) VALUES
(1, 1, 1234, 'admin', 'admin', 'Lim', 'Lance', 'Kelvin', 0, '2013-10-25 00:00:00', '2014-12-10 17:42:31'),
(2, 2, 12345, 'teach', 'teach', 'Padao', 'John-John', 'Purgatorio', 1, '2013-10-25 00:00:00', '2014-12-10 14:17:27'),
(3, 3, 1102089, '1102089', '1234', 'Tan', 'Chin Tinn Lourence', 'Son', 1, '2014-12-09 19:53:12', '2014-12-09 19:53:12'),
(5, 3, 123456, 'teach2', 'teach2', 'Quitoriano', 'Jesryll', 'Pocholo', 0, '2014-12-09 21:19:23', '2014-12-10 17:21:07');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `class_record`
--

INSERT INTO `class_record` (`class_record_id`, `account_id`, `semester`, `school_year`, `course_id`, `section_id`, `subject_id`) VALUES
(22, 2, 2, 'SY 2014-2015', 1, 3, 1),
(23, 2, 2, 'SY 2013-2014', 1, 2, 2),
(24, 2, 1, 'SY 2013-2014', 1, 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire`
--

CREATE TABLE IF NOT EXISTS `questionnaire` (
  `questionnaire_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `grading_period_id` int(11) NOT NULL,
  `exam_schedule_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `question` varchar(400) NOT NULL,
  `date` date NOT NULL,
  `time_created` datetime NOT NULL,
  `time_updated` datetime NOT NULL,
  PRIMARY KEY (`questionnaire_id`),
  KEY `subject_id` (`subject_id`),
  KEY `grading_periods_id` (`grading_period_id`),
  KEY `status_id` (`status_id`),
  KEY `exam_schedule_id` (`exam_schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `label`) VALUES
(1, '1A'),
(2, '1B'),
(3, '1C'),
(4, '1D'),
(5, '1E');

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
  PRIMARY KEY (`student_id`),
  KEY `account_id` (`account_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `course_id`, `account_id`, `year_level`) VALUES
(5, 3, 3, 2),
(10, 1, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_label` varchar(255) NOT NULL,
  `acronym` varchar(100) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_label`, `acronym`) VALUES
(1, 'Techpreneurship', 'Techpre'),
(2, 'Filipino 1', 'Fil1'),
(3, 'English 1', 'Eng1');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  ADD CONSTRAINT `class_record_ibfk_5` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `questionnaire_ibfk_3` FOREIGN KEY (`grading_period_id`) REFERENCES `grading_period` (`grading_period_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questionnaire_ibfk_4` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questionnaire_ibfk_5` FOREIGN KEY (`exam_schedule_id`) REFERENCES `exam_schedule` (`exam_schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
