-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2014 at 05:13 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_login_details`(IN `username` VARCHAR(50), IN `userpass` VARCHAR(50))
    NO SQL
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
    NO SQL
BEGIN
	SELECT 
	account_id,
	last_name,
	first_name,
	middle_name,
	account_type.label as acct_type
	FROM databank_project.account 
	LEFT JOIN databank_project.account_type 
	ON databank_project.account.account_type_id = databank_project.account_type.account_type_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_acct_type`(IN `username` VARCHAR(50), IN `userpass` VARCHAR(50))
    NO SQL
BEGIN
	SELECT account_type_id FROM databank_project.account
	WHERE acct_username = username
	AND acct_password = userpass;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_dropdown_acct_type`()
    NO SQL
BEGIN
	SELECT * FROM databank_project.account_type;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_update_details`(IN `acct_id` INT(11))
    NO SQL
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

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
`account_id` int(11) NOT NULL,
  `account_type_id` int(11) NOT NULL,
  `id_number` int(11) NOT NULL,
  `acct_username` varchar(100) NOT NULL,
  `acct_password` varchar(100) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `acct_status` tinyint(4) NOT NULL,
  `time_created` datetime NOT NULL,
  `time_updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_type_id`, `id_number`, `acct_username`, `acct_password`, `last_name`, `first_name`, `middle_name`, `acct_status`, `time_created`, `time_updated`) VALUES
(2, 1, 1234, 'admin', 'admin', 'admin', 'admin', 'admin', 1, '2014-12-08 00:00:00', '2014-12-08 00:00:00'),
(3, 1, 1423, 'teach', 'teach', 'teacher', 'teacher', 'teacher', 1, '2014-12-08 00:00:00', '2014-12-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE IF NOT EXISTS `account_type` (
`account_type_id` int(11) NOT NULL,
  `label` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`account_type_id`, `label`) VALUES
(1, 'ADMIN'),
(2, 'TEACHER');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
`answer_id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `label` varchar(150) NOT NULL,
  `correct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attempt`
--

CREATE TABLE IF NOT EXISTS `attempt` (
`attempt_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `attempt_status` tinyint(4) NOT NULL,
  `time_start` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `date_exam` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class_record`
--

CREATE TABLE IF NOT EXISTS `class_record` (
`class_record_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `semister` int(11) NOT NULL,
  `school_year` varchar(20) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
`course_id` int(11) NOT NULL,
  `course_label` varchar(255) NOT NULL,
  `acronym` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course_section`
--

CREATE TABLE IF NOT EXISTS `course_section` (
`course_section_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `class_record_id` int(11) NOT NULL,
  `acronym` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_bank`
--

CREATE TABLE IF NOT EXISTS `data_bank` (
`databank_id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
`exam_id` int(11) NOT NULL,
  `attempt_id` int(11) NOT NULL,
  `exam_schedule_id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedule`
--

CREATE TABLE IF NOT EXISTS `exam_schedule` (
  `exam_schedule_id` int(11) NOT NULL,
  `class_record_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grading_period`
--

CREATE TABLE IF NOT EXISTS `grading_period` (
`grading_period_id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire`
--

CREATE TABLE IF NOT EXISTS `questionnaire` (
`questionnaire_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `grading_period_id` int(11) NOT NULL,
  `exam_schedule_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `question` varchar(400) NOT NULL,
  `date` date NOT NULL,
  `time_created` datetime NOT NULL,
  `time_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
`result_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
`status_id` int(11) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `level`) VALUES
(1, 'ACTIVE'),
(2, 'INACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
`student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `year_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`subject_id` int(11) NOT NULL,
  `subject_label` varchar(255) NOT NULL,
  `acronym` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subs_ins`
--

CREATE TABLE IF NOT EXISTS `subs_ins` (
`subs_ins_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `acronym` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
`teacher_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
 ADD PRIMARY KEY (`account_id`), ADD KEY `account_type` (`account_type_id`);

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
 ADD PRIMARY KEY (`account_type_id`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
 ADD PRIMARY KEY (`answer_id`), ADD KEY `questionnaire_id` (`questionnaire_id`);

--
-- Indexes for table `attempt`
--
ALTER TABLE `attempt`
 ADD PRIMARY KEY (`attempt_id`), ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `class_record`
--
ALTER TABLE `class_record`
 ADD PRIMARY KEY (`class_record_id`), ADD KEY `student_id` (`student_id`), ADD KEY `teacher_id` (`teacher_id`), ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
 ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_section`
--
ALTER TABLE `course_section`
 ADD PRIMARY KEY (`course_section_id`), ADD KEY `course_id` (`course_id`,`class_record_id`), ADD KEY `class_record_id` (`class_record_id`);

--
-- Indexes for table `data_bank`
--
ALTER TABLE `data_bank`
 ADD PRIMARY KEY (`databank_id`), ADD KEY `questionnaire_id` (`result_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
 ADD PRIMARY KEY (`exam_id`), ADD KEY `attempt_id` (`attempt_id`,`exam_schedule_id`,`questionnaire_id`), ADD KEY `exam_schedule_id` (`exam_schedule_id`), ADD KEY `questionnaire_id` (`questionnaire_id`);

--
-- Indexes for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
 ADD PRIMARY KEY (`exam_schedule_id`), ADD KEY `class_record_id` (`class_record_id`);

--
-- Indexes for table `grading_period`
--
ALTER TABLE `grading_period`
 ADD PRIMARY KEY (`grading_period_id`);

--
-- Indexes for table `questionnaire`
--
ALTER TABLE `questionnaire`
 ADD PRIMARY KEY (`questionnaire_id`), ADD KEY `subject_id` (`subject_id`), ADD KEY `grading_periods_id` (`grading_period_id`), ADD KEY `status_id` (`status_id`), ADD KEY `exam_schedule_id` (`exam_schedule_id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
 ADD PRIMARY KEY (`result_id`), ADD KEY `student_id` (`student_id`,`questionnaire_id`), ADD KEY `questionnaire_id` (`questionnaire_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`student_id`), ADD KEY `account_id` (`account_id`), ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
 ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `subs_ins`
--
ALTER TABLE `subs_ins`
 ADD PRIMARY KEY (`subs_ins_id`), ADD KEY `course_id` (`teacher_id`), ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
 ADD PRIMARY KEY (`teacher_id`), ADD KEY `subject_id` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
MODIFY `account_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attempt`
--
ALTER TABLE `attempt`
MODIFY `attempt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `class_record`
--
ALTER TABLE `class_record`
MODIFY `class_record_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course_section`
--
ALTER TABLE `course_section`
MODIFY `course_section_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_bank`
--
ALTER TABLE `data_bank`
MODIFY `databank_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grading_period`
--
ALTER TABLE `grading_period`
MODIFY `grading_period_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
MODIFY `questionnaire_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subs_ins`
--
ALTER TABLE `subs_ins`
MODIFY `subs_ins_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT;
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
ADD CONSTRAINT `class_record_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `class_record_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `class_record_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_section`
--
ALTER TABLE `course_section`
ADD CONSTRAINT `course_section_ibfk_1` FOREIGN KEY (`class_record_id`) REFERENCES `class_record` (`class_record_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `course_section_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
ADD CONSTRAINT `questionnaire_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
ADD CONSTRAINT `subs_ins_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `subs_ins_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
