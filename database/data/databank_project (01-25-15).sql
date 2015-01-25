-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2015 at 04:51 PM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_choice`(IN quest_id INT(10), IN choice VARCHAR(150), IN radio INT(10))
BEGIN
	INSERT INTO `answer`
	(
	`questionnaire_id`,
	`label`,
	`correct`
	)
	VALUES
	(
	quest_id,
	choice,
	radio
	);
END$$

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
	AES_ENCRYPT(acct_pass, MD5(19911013)),
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_dup_id`(IN `ques_id` INT (10), IN `exam_sched_id` INT(10))
BEGIN
	SELECT questionnaire_id 
	FROM databank_project.exam 
	WHERE questionnaire_id = ques_id
	AND exam_schedule_id = exam_sched_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_exam_password`(IN `exam_pass` VARCHAR(50))
BEGIN
	SELECT 	exam_password
	FROM databank_project.exam_schedule
	WHERE exam_password = exam_pass;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_login_details`(IN `username` VARCHAR(50), IN `userpass` VARCHAR(50))
BEGIN
	SELECT 
	account_id,
	id_number,
	acct_username,
	CAST(AES_ENCRYPT(acct_password, MD5(19911013))AS CHAR) AS acct_password,
	last_name,
	first_name,
	middle_name,
	account_type.label AS acct_type
	FROM databank_project.account 
	LEFT JOIN databank_project.account_type 
	ON databank_project.account.account_type_id=databank_project.account_type.account_type_id
	WHERE acct_username = username
	AND acct_password = AES_ENCRYPT(userpass, MD5(19911013));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_question`(IN question_id INT(10))
BEGIN
	SELECT * FROM answer WHERE questionnaire_id=question_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_student_exam`(IN `stud_id` INT (10), IN `ex_sched_id` INT(10))
BEGIN
SELECT  student_exam_answer.student_id,
		student_exam_answer.exam_schedule_id

FROM databank_project.student_exam_answer



WHERE student_id = stud_id AND exam_schedule_id= ex_sched_id

GROUP BY student_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `count_number_of_questions`(IN `ex_sched_id` INT(10))
BEGIN
	SELECT DISTINCT answer.questionnaire_id
	FROM databank_project.student_exam_answer
	LEFT JOIN answer ON student_exam_answer.answer_id = answer.answer_id
	WHERE  student_exam_answer.exam_schedule_id = ex_sched_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_exam`(IN `account_id` INT(10), IN `exam_date` DATETIME, IN `title_exam` VARCHAR(50),IN `grade_period` INT(10),  IN `sub_id` INT(10) ,IN `pass` VARCHAR(50))
BEGIN

INSERT INTO `databank_project`.`exam_schedule`
(
`account_id`,
`exam_date`,
`title_exam`,
`grading_period_id`,
`subject_id`,
`exam_password`)
VALUES
(account_id,
exam_date,
title_exam,
grade_period,
sub_id,
pass);

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
	AND acct_password = AES_ENCRYPT(userpass, MD5(19911013));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_all_total_correct_answer`(IN `ex_sched_id` INT(10))
BEGIN
SELECT 	
		sum(answer.correct) as total_correct_answer
		FROM databank_project.student_exam_answer
		LEFT JOIN answer ON student_exam_answer.answer_id = answer.answer_id
		WHERE   student_exam_answer.exam_schedule_id = ex_sched_id;

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_choices`(IN quest_id INT(10))
BEGIN
	SELECT * FROM answer WHERE questionnaire_id = quest_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_choice_details`(IN choice_id INT(10))
BEGIN
	SELECT label FROM answer WHERE answer_id = choice_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_choice_with_check`(IN quest_id INT(10))
BEGIN
	SELECT answer_id FROM answer WHERE questionnaire_id = quest_id AND correct = 1;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_exams`(IN `acct_id` INT (10))
BEGIN
	SELECT 	title_exam,
			exam_date,
			exam_schedule_id,
			kr20
	FROM databank_project.exam_schedule
	WHERE account_id = acct_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_exam_details`(IN `ex_sched_id` INT (10))
BEGIN
SELECT 	exam_schedule.title_exam,
		exam_schedule.exam_schedule_id,
		subjects.subject_id,
		subjects.subject_label,
		exam_schedule.grading_period_id,
		grading_period.label,
		exam_schedule.exam_date

		FROM databank_project.exam_schedule

LEFT JOIN grading_period ON exam_schedule.grading_period_id = grading_period.grading_period_id
LEFT JOIN subjects ON exam_schedule.subject_id = subjects.subject_id

WHERE exam_schedule.exam_schedule_id = ex_sched_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_exam_list`()
BEGIN
SELECT 	exam_schedule.exam_schedule_id,
		subjects.subject_label,
		exam_schedule.title_exam,
		exam_schedule.exam_date,
		account.last_name,
		account.first_name,
		account.middle_name
		FROM databank_project.exam_schedule
		LEFT JOIN subjects ON exam_schedule.subject_id = subjects.subject_id
		LEFT JOIN account ON exam_schedule.account_id=account.account_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_exam_questions`(IN `subj_id` INT (10),IN `grdng_period_id` INT(10),IN `no_hard` INT,IN `no_easy` INT)
BEGIN
(SELECT questionnaire.questionnaire_id,
			questionnaire.question as question,
			grading_period.label as label,
			gpa
	FROM questionnaire
	LEFT JOIN grading_period ON questionnaire.grading_period_id=grading_period.grading_period_id
	WHERE questionnaire.subject_id=subj_id AND questionnaire.grading_period_id=grdng_period_id AND questionnaire.gpa <0.50 AND questionnaire.questionnaire_status=1
	ORDER BY RAND() limit  no_hard)
union

(SELECT 	questionnaire.questionnaire_id,
			questionnaire.question as question,
			grading_period.label as label,
			gpa
	FROM questionnaire
	LEFT JOIN grading_period ON questionnaire.grading_period_id=grading_period.grading_period_id
	WHERE questionnaire.subject_id=subj_id AND questionnaire.grading_period_id=grdng_period_id AND questionnaire.gpa >=0.50 AND questionnaire.questionnaire_status=1
	ORDER BY RAND()limit no_easy) ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_exam_schedule`(IN `acct_id` INT(10))
BEGIN
SELECT 	exam_schedule.exam_schedule_id,
		exam_schedule.title_exam,
		subjects.subject_label,
		grading_period.label,
		exam_schedule.exam_date,
		exam_schedule.kr20

FROM databank_project.exam_schedule

LEFT JOIN grading_period ON exam_schedule.grading_period_id = grading_period.grading_period_id
LEFT JOIN subjects ON exam_schedule.subject_id = subjects.subject_id

WHERE exam_schedule.account_id = acct_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_exam_title_date`(IN `exam_id` INT(10))
BEGIN
	SELECT 	exam_schedule_id,
			title_exam,
			exam_date
	FROM databank_project.exam_schedule
	WHERE exam_schedule_id = exam_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_new_questions`(IN `grd_period_id` INT(10))
BEGIN
	SELECT questionnaire.question, questionnaire.questionnaire_id 
	FROM databank_project.questionnaire
	LEFT JOIN data_bank ON questionnaire.questionnaire_id = data_bank.questionnaire_id
	LEFT JOIN grading_period ON questionnaire.grading_period_id = grading_period.grading_period_id
	WHERE data_bank.questionnaire_id IS NULL AND grading_period.grading_period_id = grd_period_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_period`()
BEGIN
	SELECT * FROM grading_period;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_questions`(IN subj_id INT(10))
BEGIN
	SELECT questionnaire_id, question FROM questionnaire WHERE subject_id = subj_id and questionnaire_status!=1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_questions_from_exam`(IN `ex_sched_id` INT(10))
BEGIN
	SELECT 	questionnaire.question,
		grading_period.label,
		data_bank.question_difficulty
	FROM databank_project.exam
	LEFT JOIN exam_schedule ON  exam.exam_schedule_id = exam_schedule.exam_schedule_id
	LEFT JOIN grading_period ON exam_schedule.grading_period_id = grading_period.grading_period_id
	LEFT JOIN questionnaire ON exam.questionnaire_id = questionnaire.questionnaire_id
	LEFT JOIN data_bank ON questionnaire.questionnaire_id = data_bank.questionnaire_id
	LEFT JOIN subjects ON exam.subject_id = subjects.subject_id
	WHERE exam.exam_schedule_id = ex_sched_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_question_input`(IN quest_id INT(10))
BEGIN
	SELECT question FROM questionnaire WHERE questionnaire_id = quest_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_quest_id`(IN `ex_id` INT(10))
BEGIN
		SELECT 	
		answer.questionnaire_id
		FROM databank_project.student_exam_answer
		LEFT JOIN answer ON student_exam_answer.answer_id = answer.answer_id
		WHERE   student_exam_answer.exam_schedule_id = ex_id
		group by answer.questionnaire_id order by student_exam_answer.student_id;	
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
	SELECT account.account_id, account_type_id, last_name, first_name, middle_name
	FROM account 
	LEFT JOIN student ON account.account_id = student.account_id
	WHERE account_type_id = 3 and student.student_id IS NULL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_student_id`(IN `acct_id` INT(10))
BEGIN
	SELECT * FROM student 
	LEFT JOIN account 
	ON student.account_id=account.account_id
	WHERE account.account_id=acct_id;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_teacher_subjects`(IN acct_id INT(10))
BEGIN
	SELECT
	class_record.subject_id, 
	subjects.subject_label,
	course.course_label 
	FROM class_record 
	LEFT JOIN course ON class_record.course_id=course.course_id
	LEFT JOIN subjects ON class_record.subject_id=subjects.subject_id
	LEFT JOIN section ON class_record.section_id=section.section_id
	WHERE class_record.account_id=acct_id
	GROUP BY subjects.subject_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_total_correct_answer`(IN `ex_sched_id` INT(10))
BEGIN
SELECT 	student_exam_answer.student_id,
		sum(answer.correct) as total_correct_answer
		FROM databank_project.student_exam_answer

LEFT JOIN answer ON student_exam_answer.answer_id = answer.answer_id

WHERE   student_exam_answer.exam_schedule_id = ex_sched_id
GROUP BY student_exam_answer.student_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_total_correct_of_question`(IN `ex_id` INT(10))
BEGIN
	SELECT 	
		sum(answer.correct) as total_correct_answer
		FROM databank_project.student_exam_answer
		LEFT JOIN answer ON student_exam_answer.answer_id = answer.answer_id
		WHERE   student_exam_answer.exam_schedule_id = ex_id
		group by answer.questionnaire_id order by answer.questionnaire_id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_update_details`(IN `acct_id` INT(11))
BEGIN
	SELECT 
	account_id,
	account.account_type_id,
	id_number,
	acct_username,
	CAST(AES_DECRYPT(acct_password, MD5(19911013))AS CHAR) AS acct_password,
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_view_exam_answers`()
BEGIN
			SELECT 		answer.questionnaire_id,
						answer.answer_id,
						answer.label AS choices,
						answer.correct
			FROM databank_project.exam
			LEFT JOIN questionnaire ON exam.questionnaire_id = questionnaire.questionnaire_id
			LEFT JOIN answer ON questionnaire.questionnaire_id = answer.questionnaire_id
			ORDER BY RAND() ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_view_exam_details`(IN `ex_sched_id` INT(10))
BEGIN
	SELECT 	exam_schedule.title_exam,
			subjects.subject_label,
			grading_period.label,
			exam_schedule.exam_password
	FROM exam
	LEFT JOIN exam_schedule ON exam.exam_schedule_id = exam_schedule.exam_schedule_id
	LEFT JOIN grading_period ON exam_schedule.grading_period_id = grading_period.grading_period_id
	LEFT JOIN subjects ON exam.subject_id = subjects.subject_id
	WHERE exam.exam_schedule_id = ex_sched_id GROUP BY exam_schedule.exam_schedule_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_view_exam_questionnaire`(IN `ex_id` INT(10))
BEGIN
		SELECT 		questionnaire.questionnaire_id,
					questionnaire.question
		FROM databank_project.exam
		LEFT JOIN questionnaire ON exam.questionnaire_id = questionnaire.questionnaire_id
		LEFT JOIN answer ON questionnaire.questionnaire_id = answer.questionnaire_id
		WHERE exam.exam_schedule_id = ex_id
		GROUP BY answer.questionnaire_id  ORDER BY RAND();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kuder_number_of_people_who_answered`(IN `ex_sched_id` INT)
BEGIN
SELECT COUNT(DISTINCT student_id) as total_students

FROM databank_project.student_exam_answer
WHERE student_exam_answer.exam_schedule_id = ex_sched_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `question_bank`(IN `subj_id` INT(10))
BEGIN
	SELECT 	questionnaire.questionnaire_id,
			questionnaire.question,
	ROUND(gpa*100) as gpa,
	subject_id
	FROM databank_project.questionnaire
	WHERE questionnaire.status_id = 1 and subject_id=subj_id;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_test`()
BEGIN
	SELECT * FROM databank_project.test;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `students_correct_answer`(IN `ex_sched_id` INT(10))
BEGIN
	SELECT	student_exam_answer.student_id ,
			answer.questionnaire_id,
			answer.correct
			FROM databank_project.student_exam_answer
	LEFT JOIN answer ON student_exam_answer.answer_id = answer.answer_id
	WHERE student_exam_answer.exam_schedule_id = ex_sched_id
	ORDER BY student_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `submit_exam_answers`(IN `stud_id` INT(10),IN `exam_sched_id` INT(10),IN `ans_id` INT(10))
BEGIN
	INSERT INTO `databank_project`.`student_exam_answer`
	(
	`student_id`,
	`exam_schedule_id`,
	`answer_id`)
	VALUES
	(
	stud_id,
	exam_sched_id,
	ans_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `submit_exam_details`(IN `ex_id` INT (10), IN `qstionnaire_id` INT(10),IN `subj_id` INT (10 ))
BEGIN
INSERT INTO `databank_project`.`exam`
(`exam_schedule_id`,
`questionnaire_id`,
`subject_id`)
VALUES
(ex_id,
qstionnaire_id,
subj_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `total_students_who_take_exam`(IN `ex_sched_id` INT(10))
BEGIN
	SELECT DISTINCT student.student_id,
				account.id_number
	FROM databank_project.student_exam_answer
	LEFT JOIN student ON student_exam_answer.student_id = student.student_id
	LEFT JOIN account ON student.account_id = account.account_id	
	WHERE student_exam_answer.exam_schedule_id = ex_sched_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_account`(IN `acct_id` INT(11), IN `acct_type` INT(11), IN `id_num` VARCHAR(50), IN `acct_user` VARCHAR(50), IN `acct_pass` VARCHAR(50), IN `lname` VARCHAR(50), IN `fname` VARCHAR(50), IN `mname` VARCHAR(50), IN `acct_status` INT(10))
BEGIN
	UPDATE databank_project.account
	SET
	`account_type_id` = acct_type,
	`id_number` = id_num,
	`acct_username` = acct_user,
	`acct_password` = AES_ENCRYPT(acct_pass, MD5(19911013)),
	`last_name` = lname,
	`first_name` = fname,
	`middle_name` = mname,
	`acct_status` = acct_status,
	`time_updated` = NOW()
	WHERE `account_id` = acct_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_choice`(IN choice_id INT(11), IN new_choice VARCHAR(150))
BEGIN
	UPDATE databank_project.answer
	SET
	`label` = new_choice
	WHERE `answer_id` = choice_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_choice_with_check`(IN choice_id INT(11), IN new_choice VARCHAR(150), IN check_val INT(10))
BEGIN
	UPDATE databank_project.answer
	SET
	`label` = new_choice,
	`correct` = check_val
	WHERE `answer_id` = choice_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_correct`(IN choice_id INT(11))
BEGIN
	UPDATE databank_project.answer
	SET
	`correct` = 0
	WHERE `answer_id` = choice_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_exam`(IN `ex_sched_id` INT(10) ,IN `ex_date` DATE, IN `title_ex` VARCHAR(50),IN `grd_period_id` INT (10),IN `subj_id` INT(10),IN `exam_pass` VARCHAR(50))
BEGIN
UPDATE `databank_project`.`exam_schedule`
SET
`exam_date` = ex_date,
`title_exam` = title_ex,
`grading_period_id` = grd_period_id,
`subject_id` = subj_id,
`exam_password` = exam_pass

WHERE `exam_schedule_id` = ex_sched_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_kr`(IN `kr` FLOAT(10), IN `ex_sched_id` INT(10))
BEGIN
	UPDATE databank_project.exam_schedule
	SET
	`kr20` = kr
	WHERE `exam_schedule_id` = ex_sched_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_question`(IN quest_id INT(11), IN period INT(10), IN question VARCHAR(400))
BEGIN
	UPDATE databank_project.questionnaire
	SET
	`grading_period_id` = period,
	`question` = question
	WHERE `questionnaire_id` = quest_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_questionnaire_difficulty`(IN `total_q` FLOAT(10), IN `ques_id` INT(10))
BEGIN
	UPDATE databank_project.questionnaire
	SET
	`gpa` = total_q,
	`questionnaire_status`=1
	WHERE `questionnaire_id` = ques_id;
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
  `id_number` varchar(50) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_type_id`, `id_number`, `acct_username`, `acct_password`, `last_name`, `first_name`, `middle_name`, `acct_status`, `time_created`, `time_updated`) VALUES
(14, 1, '1102089', 'admin', 'MM¹Ä\0fè‘Ëý‘ôøk', 'TAN', 'CHIN TINN LOURENCE', 'SON', 1, '2015-01-21 10:45:00', '2015-01-21 11:48:00'),
(27, 2, '0901300', '0901300', 'üž\0åÁq|ŒÂå¬ýC', 'WABINGA', 'KAREN JOY', 'SANTANDER', 1, '2015-01-21 11:53:02', '2015-01-21 11:53:02'),
(28, 2, '1200976', '1200976', 'ûŠBD¤zUã=òú€P\Zã', 'JUNTILLA', 'JEFFORD', 'CUA', 1, '2015-01-21 11:53:38', '2015-01-21 11:53:38'),
(29, 2, '1000017', '1000017', '†¤ßãò¿¥}íò_¤’Rû', 'CAHILOG', 'DONABEL', 'ECUBEN', 1, '2015-01-21 11:54:05', '2015-01-21 11:54:05'),
(30, 2, '1001032', '1001032', '9Ê%_8ÇÏkÎUÚØ“"', 'AVELLANO', 'BEJAY', 'PAGAR', 1, '2015-01-21 11:54:34', '2015-01-21 11:54:34'),
(31, 2, '1000556', '1000556', '…N—ö?5–Ê•Û¬0ñÕ', 'ROM', 'MICHELLE', 'RICA', 1, '2015-01-21 11:54:55', '2015-01-21 11:54:55'),
(32, 3, '1000889', '1000889', 'Ü‰íÏt´•²;øÛ[ò ', 'BALOT', 'HAZEL', 'PODUNAS', 1, '2015-01-21 11:55:18', '2015-01-21 11:55:18'),
(33, 3, '1101703', '1101703', '"Î—sr™§ñ¯3IlÅÄ', 'ESCALANTE', 'MAREY QUEEN', 'FACTURA', 1, '2015-01-21 11:55:41', '2015-01-21 11:55:41'),
(34, 3, '1300027', '1300027', '“{¯•Ã*£­Ìtâ¢¤', 'CASTEL', 'AYESSA KAYE', 'MONTENEGRO', 1, '2015-01-21 11:56:04', '2015-01-21 11:56:04'),
(35, 3, '1000228', '1000228', '¡Þ÷–Œù7¶—ú×zÝs”¢', 'FESTIN', 'CAROLYN JOY', 'PALANCA', 1, '2015-01-21 11:56:26', '2015-01-21 11:56:26'),
(36, 3, '1001151', '1001151', 'Ê2fîqí¬Å*É4¿ö', 'MATALAM', 'JANICA ANN', 'SAMAL', 1, '2015-01-21 11:57:03', '2015-01-24 18:36:37'),
(37, 3, '1000209', '1000209', '‡ÜX"‚§"êŽFFTäD', 'FABIANA', 'JOVIL', 'GUIMALAN', 1, '2015-01-21 16:47:03', '2015-01-21 16:47:03'),
(38, 3, '1000375', '1000375', '©Ê{7¸Àq§Í3ó!ò­¿', 'BABA', 'KARISSA JANNA', 'CERVO', 1, '2015-01-21 16:47:51', '2015-01-21 16:47:51'),
(39, 3, '1000047', '1000047', '1l9;>·cÇ4<á•=/pä', 'VILLALOBOS', 'NICY', 'CODILAN', 1, '2015-01-21 16:48:23', '2015-01-21 16:48:23'),
(40, 3, '1301107', 'Lorenz Jay', 'òÏ6Wl7\ZÔ©“×nr', 'BATANGON', 'LORENZ JAY', 'PACUDAN', 1, '2015-01-21 16:51:32', '2015-01-21 16:51:32'),
(41, 3, '1301551', '1301551', 'ärI€Pxü¥v—qŠQH½', 'SOCORRO', 'JEIYH', 'RECOPUERTO', 1, '2015-01-21 16:52:01', '2015-01-21 16:52:01'),
(42, 3, '1102104', '1102104', '0,ösãdW0`GÖ', 'REGISTOS', 'RIZZA', 'CADINAS', 1, '2015-01-21 16:52:30', '2015-01-21 16:52:30'),
(43, 3, '1000612', '1000612', 'ÆÅ&ËÆgýc%só', 'MASAMAYOR', 'ZOISA', 'GARCIA', 1, '2015-01-21 16:52:54', '2015-01-21 16:52:54'),
(44, 3, '1300162', '1300162', 'º‰Þ|@s³Îé«áÃ¡', 'VALLETE', 'SHIELA MAE', 'VENTURADO', 1, '2015-01-21 16:53:30', '2015-01-21 16:53:30'),
(45, 3, '1300020', '1300020', 'ø7¾Èz²eÜ„$Ý', 'ALMIRANTE', 'KRYSTIL', 'MALLO', 1, '2015-01-21 16:53:57', '2015-01-21 16:53:57'),
(46, 3, '1000437', '1000437', 'Ó¸›—ekÙ¡8òxáþ', 'DAGUNAN', 'JANINE', 'TANDING', 1, '2015-01-21 16:54:21', '2015-01-21 16:54:21'),
(47, 3, '1000126', '1000126', 'ÀŠ†µËí¥\ZR“Œú’eò', 'RUELO', 'GLYKA CLARENCE', 'ESTRELLADA', 1, '2015-01-21 16:54:53', '2015-01-21 16:54:53'),
(48, 3, '1000317', '1000317', '«/Èn¢|P:Gà×\ZÕ*', 'SALARDA', 'DELFA FE', 'M.', 1, '2015-01-21 16:55:23', '2015-01-21 16:55:23'),
(49, 3, '1000874', '1000874', ';J ÉŸ \\ÈÓŸž', 'GUMISAD', 'REI JOYCE', 'GUMISAD', 1, '2015-01-21 16:55:56', '2015-01-21 16:55:56'),
(50, 3, '1000434', '1000434', 'Æ1Êîýb!ÀrŽÒ%', 'ALBENTO', 'EUNICIA GAYE', 'ALBENTO', 1, '2015-01-21 16:56:16', '2015-01-21 16:56:16'),
(51, 3, '1000251', '1000251', '˜qÊs©›^ÆLYÉ‰ýàè', 'MEDEL', 'ROCEL JANE', 'ROCEL JANE', 1, '2015-01-21 16:56:39', '2015-01-21 16:56:39'),
(52, 3, '1000643', '1000643', ']´†£Ðû0d@ÏÌÝ’©', 'MAGALLANES', 'MIKHAELA ANGELICA', 'DEOCAMPO', 1, '2015-01-21 16:57:02', '2015-01-21 16:57:02'),
(53, 3, '1101616', '1101616', 'k´Tlbå“x[H%ŸD', 'LYNDE', 'LYNDE', 'LYNDE', 1, '2015-01-21 16:58:03', '2015-01-21 16:58:03'),
(54, 3, '1001486', '1001486', '™G\ZyÓ2í§|¹öES', 'PENELOPE', 'PENELOPE', 'PENELOPE', 1, '2015-01-21 16:58:18', '2015-01-21 16:58:18'),
(55, 3, '1300114', '1300114', '½6æŽ¬¡‹öNE{=ÚéÚ\\', 'ISSER HAREL', 'ISSER HAREL', 'ISSER HAREL', 1, '2015-01-21 16:58:45', '2015-01-21 16:58:45'),
(56, 3, '1300517', '1300517', 'sâf¯ªjo~äi±bH¬ƒ', 'KURT CEDRIC', 'KURT CEDRIC', 'KURT CEDRIC', 1, '2015-01-21 16:59:13', '2015-01-21 16:59:13'),
(57, 3, '1300140', '1300140', 'Ó}X´‚™·Äëá&¢‘é\n', 'NOLI JHON', 'NOLI JHON', 'NOLI JHON', 1, '2015-01-21 17:00:03', '2015-01-21 17:00:03'),
(58, 3, '1300091', '1300091', 'ƒ¿ˆ¡2Æ¬g,Àn\0Xv„', 'ELAH', 'ELAH', 'ELAH', 1, '2015-01-21 17:00:45', '2015-01-21 17:00:45'),
(59, 3, '1300554', '1300554', '€g‘ð˜æ%µ\ZZñRgµ', 'ELNA JOYCE', 'ELNA JOYCE', 'ELNA JOYCE', 1, '2015-01-21 17:01:02', '2015-01-21 17:01:02'),
(60, 3, '1000783', '1000783', 'j‹JˆYÛ@ÊO,hƒa`Î', 'ELTON JOHN', 'ELTON JOHN', 'ELTON JOHN', 1, '2015-01-21 17:01:19', '2015-01-21 17:01:19'),
(61, 3, '1300345', '1300345', '‚y£ë—E9k&¢qQÊAÆ', 'EMEE', 'EMEE', 'EMEE', 1, '2015-01-21 17:01:36', '2015-01-21 17:01:36'),
(62, 3, '1300345', '1300345', '‚y£ë—E9k&¢qQÊAÆ', 'EMEE', 'EMEE', 'EMEE', 1, '2015-01-21 17:02:53', '2015-01-21 17:02:53'),
(63, 3, '1000977', '1000977', 'Æˆø_²ÂÊs¸;“#cu', 'EMELYN', 'EMELYN', 'EMELYN', 1, '2015-01-21 17:03:11', '2015-01-21 17:03:11'),
(64, 3, '1000376', '1000376', '^L\\ß=§†B±ö¿Ö', 'EMMA CONCEPCION', 'EMMA CONCEPCION', 'EMMA CONCEPCION', 1, '2015-01-21 17:03:33', '2015-01-21 17:03:33'),
(65, 3, '1000376', '1000376', '^L\\ß=§†B±ö¿Ö', 'EMMA CONCEPCION', 'EMMA CONCEPCION', 'EMMA CONCEPCION', 1, '2015-01-21 17:05:44', '2015-01-21 17:05:44'),
(66, 3, '1300594', '1300594', 'y³ @†ªE¹É\r®CúC', 'EMMANUEL CHRISTIAN', 'EMMANUEL CHRISTIAN', 'EMMANUEL CHRISTIAN', 1, '2015-01-21 17:06:03', '2015-01-21 17:06:03'),
(67, 3, '1101508', '1101508', 'O<îKrÈB/M{í…Å†u', 'EREKA DYAN', 'EREKA DYAN', 'EREKA DYAN', 1, '2015-01-21 17:06:45', '2015-01-21 17:06:45'),
(68, 3, '1300623', '1300623', 'ÉuÎùEÖ36dû±/AÍu', 'ERIKA LEONORA', 'ERIKA LEONORA', 'ERIKA LEONORA', 1, '2015-01-21 17:07:08', '2015-01-21 17:07:08'),
(69, 3, '1000837', '1000837', 'z¦•òˆ÷+fïÖBà', 'ERIKA MURIEL', 'ERIKA MURIEL', 'ERIKA MURIEL', 1, '2015-01-21 17:07:34', '2015-01-21 17:07:34'),
(70, 3, '1001856', '1001856', '+\ny©©ß©&T>pË@', 'ERMA MARIE', 'ERMA MARIE', 'ERMA MARIE', 1, '2015-01-21 17:07:51', '2015-01-21 17:07:51'),
(71, 3, '1300673', '1300673', 'éßž¥†ÌíÞŒ©hûÌ¡`5', 'ERROL KIM', 'ERROL KIM', 'ERROL KIM', 1, '2015-01-21 17:08:09', '2015-01-21 17:08:09'),
(72, 3, '1300101', '1300101', '«[¾{”Œ‡ïò8ÆdÂ', 'ERVIN MICHAEL', 'ERVIN MICHAEL', 'ERVIN MICHAEL', 1, '2015-01-21 17:08:26', '2015-01-21 17:08:26'),
(73, 3, '1301248', '1301248', '—ÐYÙ‰ÕõŽœáÖQ', 'JOHN DAVE', 'JOHN DAVE', 'JOHN DAVE', 1, '2015-01-21 17:12:38', '2015-01-21 17:12:38'),
(74, 3, '1300041', '1300041', 'Pô*=À=B¸©€ù7', 'AUDREY', 'AUDREY', 'AUDREY', 1, '2015-01-21 17:12:58', '2015-01-21 17:12:58'),
(75, 3, '1301334', '1301334', '‚jn5ÑFÝ^Ué/”Bh', 'SHAYNE', 'SHAYNE', 'SHAYNE', 1, '2015-01-21 17:13:21', '2015-01-21 17:13:21'),
(76, 3, '1300693', '1300693', '¯‰P7\\‚%²Ä™ð#''¸', 'MARIA CHIFFA', 'MARIA CHIFFA', 'MARIA CHIFFA', 1, '2015-01-21 17:13:39', '2015-01-21 17:13:39'),
(77, 3, '1300692', '1300692', 'Ûà51&^ì¸œ$hñXÇ\n]', 'KATHLEEN JOYCE', 'KATHLEEN JOYCE', 'KATHLEEN JOYCE', 1, '2015-01-21 17:24:22', '2015-01-21 17:24:22'),
(78, 3, '1101448', '1101448', '+ah_Öª<ü²ì{DéúC', 'IRENE', 'IRENE', 'IRENE', 1, '2015-01-21 17:24:39', '2015-01-21 17:24:39'),
(79, 3, '1100422', '1100422', '‚Kø[æû%xìVwãî¸ÈD', 'ALYSSA FAYE', 'ALYSSA FAYE', 'ALYSSA FAYE', 1, '2015-01-21 17:24:59', '2015-01-21 17:24:59'),
(80, 3, '1301313', '1301313', 'qÛÃ]ø«¤U”„Òt2z', 'LOIS BERNARD', 'LOIS BERNARD', 'LOIS BERNARD', 1, '2015-01-21 17:25:16', '2015-01-21 17:25:16'),
(81, 3, '1300026', '1300026', '9°?@JÔšJÞ…›Íéÿ¢3', 'JASON', 'JASON', 'JASON', 1, '2015-01-21 17:25:33', '2015-01-21 17:25:33'),
(82, 3, '1300792', '1300792', 'ê	WT!á™KmÖ', 'ALWINN JAN', 'ALWINN JAN', 'ALWINN JAN', 1, '2015-01-21 17:25:51', '2015-01-21 17:25:51'),
(83, 3, '1300969', '1300969', 'ÇŽíuÔ£©ln$qêŒ©­', 'DAVE', 'DAVE', 'DAVE', 1, '2015-01-21 17:26:08', '2015-01-21 17:26:08'),
(84, 2, '1300925', '1300925', 'Dìþ7vÕ¡­…JAYm¤é', 'REGALADO', 'JOHN ERIC PAOLO', 'REGALADO', 1, '2015-01-21 17:32:36', '2015-01-21 17:32:36'),
(85, 2, '1300531', '1300531', '·^ºÂ/Sþe·''~arí', 'MAGAN', 'REGGIE', 'REGGIE', 1, '2015-01-21 17:32:57', '2015-01-21 17:32:57'),
(86, 2, '1300887', '1300887', '‹Xe±÷”µ«®WG	', 'HANNAH MICHAELA', 'HANNAH MICHAELA', 'HANNAH MICHAELA', 1, '2015-01-21 17:33:13', '2015-01-21 17:33:13'),
(87, 2, '1300766', '1300766', 'øjðœÝrW\\’ë»ûþ', 'ALIPIS', 'CREAM ROSE', 'CREAM ROSE', 1, '2015-01-21 17:33:32', '2015-01-21 17:33:32'),
(88, 2, '1300837', '1300837', '¢´i&]<¯}â\r¯r}£×', 'DANDO', 'CEFERINO', 'CEFERINO', 1, '2015-01-21 17:33:56', '2015-01-21 17:33:56'),
(89, 2, '0800949', '0800949', 'ÿòAÔ4áÎüò%’ŸôíÁ', 'TISCHER', 'LOTHAR', 'LOTHAR', 1, '2015-01-21 17:34:17', '2015-01-21 17:34:17'),
(90, 2, '1300196', '1300196', '‚µ6\n"ÝžŸ4yÈ$FÄ¬ª', 'AYING', 'QUEENESSE', 'S', 1, '2015-01-21 17:34:40', '2015-01-21 17:34:40'),
(91, 2, '1301458', '1301458', '´±ÇÏí¥[pã§e±Šâé', 'CRESNOVEM JEE', 'CRESNOVEM JEE', 'CRESNOVEM JEE', 1, '2015-01-21 17:34:57', '2015-01-21 17:34:57'),
(92, 2, '1300240', '1300240', 'v6øþ§ß6eFêºþ¯FŽ', 'SISMAR', 'KATHLEEN JOY', 'KATHLEEN JOY', 1, '2015-01-21 17:35:21', '2015-01-21 17:35:21'),
(93, 2, '1300241', '1300241', 'b&–³$ifôU\0^Ë"=', 'JUMAO-AS', 'HANNAH ELLIZE', 'JUMAO-AS', 1, '2015-01-21 17:35:39', '2015-01-21 17:35:39'),
(94, 2, '1300967', '1300967', '»o?¿H''\0åRyÑ~kŠ}', 'KO', 'ALFRED', 'ALFRED', 1, '2015-01-21 17:35:59', '2015-01-21 17:35:59'),
(95, 2, '1301161', '1301161', '(Q}ÀtÒ5qÄÌ÷-±ÎÞ', 'EROMON', 'RACHEL ANN', 'RACHEL ANN', 1, '2015-01-21 17:36:31', '2015-01-21 17:36:31'),
(96, 2, '1300001', 'teach', 'xH¶ä5Ocßs—°˜“#', 'BEN', 'CI', 'BEN', 1, '2015-01-24 17:19:05', '2015-01-24 17:19:05'),
(97, 3, '0900870', 'student', '`­E0–ýÊŽS‹Ò@ýàp', 'LIM', 'LANCE KELVIN', 'FOLLANTE', 1, '2015-01-24 17:44:04', '2015-01-24 17:45:30'),
(98, 3, '1001491', '1001491', '%6¸ <?ÀSoNŒË‰', 'QUITORIANO', 'JESSRYLL', 'PACHECO', 1, '2015-01-24 18:21:46', '2015-01-24 18:21:46'),
(99, 3, '1001887', '1001887', 'J.ÚV¦ÕMó;ÊÖÛ', 'SEVILLA', 'MIGUEL ANGELO', 'YAP', 1, '2015-01-24 18:27:07', '2015-01-24 18:27:07'),
(100, 3, '1102090', '1102090', 'ÄHæªŽL³N5ÏÊ‡ã', 'SON', 'CHIN', 'TAN', 1, '2015-01-24 18:31:34', '2015-01-24 18:32:00'),
(101, 3, '0801107', '0801107', '&èGÞSdÆ^Ì²}2ŸÈ', 'PURGATORIO', 'JOHN - JOHN', 'ADORABLE', 1, '2015-01-24 21:14:59', '2015-01-24 21:14:59');

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
  `correct` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`answer_id`),
  KEY `questionnaire_id` (`questionnaire_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=196 ;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `questionnaire_id`, `label`, `correct`) VALUES
(76, 11, 'hardwared', 0),
(77, 11, 'computer', 1),
(78, 11, 'operating system', 0),
(79, 11, 'software', 0),
(80, 16, 'input unit', 0),
(81, 16, 'secondary storage unit', 0),
(82, 16, 'output unit', 0),
(83, 16, 'secondary processing unit', 1),
(84, 17, 'Olive', 0),
(85, 17, 'Oak', 1),
(86, 17, 'Pine', 0),
(87, 17, 'Pear', 0),
(88, 18, 'Machine Language', 0),
(89, 18, 'Assembler Language', 1),
(90, 18, 'High-Level Language', 0),
(91, 18, 'Assembly Language', 0),
(92, 19, 'assembly language to high-level language', 0),
(93, 19, 'assembly language to machine language', 0),
(94, 19, 'high-level language to assembly language', 0),
(95, 19, 'high-level language to machine language', 1),
(96, 20, 'COBOL', 0),
(97, 20, 'PASCAL', 1),
(98, 20, 'BCPL', 0),
(99, 20, 'FORTRAN', 0),
(100, 21, 'Dennis Ritchie', 1),
(101, 21, 'Martin Richards', 0),
(102, 21, 'Ken Thompson', 0),
(103, 21, 'Steve Jobs', 0),
(104, 22, 'load', 0),
(105, 22, 'execute', 0),
(106, 22, 'link', 1),
(107, 22, 'compile', 0),
(108, 23, 'Common Business Oriented Language', 1),
(109, 23, 'Common Business Operational Language', 0),
(110, 23, 'Computer Business Oriented Language', 0),
(111, 23, 'Computer Business Operational Language', 0),
(112, 24, 'Compiler', 0),
(113, 24, 'Editor', 1),
(114, 24, 'Assembler', 0),
(115, 24, 'Interpreter', 0),
(116, 25, 'Infinite Repetition', 0),
(117, 25, 'Definite Repetition', 1),
(118, 25, 'Finite Repetition', 0),
(119, 25, 'Indefinite Repetition', 0),
(120, 26, 'pause', 0),
(121, 26, 'return', 0),
(122, 26, 'break', 0),
(123, 26, 'continue', 1),
(124, 27, '1', 0),
(125, 27, '2', 1),
(126, 27, '3', 0),
(127, 27, '4', 0),
(128, 28, 'Infinite Repetition', 0),
(129, 28, 'Definite Repetition', 0),
(130, 28, 'Finite Repetition', 0),
(131, 28, 'Indefinite Repetition', 1),
(132, 29, 'pause', 0),
(133, 29, 'return', 0),
(134, 29, 'break', 1),
(135, 29, 'continue', 0),
(136, 30, 'If and only If both the simple conditions are True', 0),
(137, 30, 'As long as one of the simple conditions is False', 0),
(138, 30, 'If and only if both the simple conditions are False', 1),
(139, 30, 'None of the above ', 0),
(140, 31, 'The value of the variable changes after the original value has been used', 0),
(141, 31, 'The value of the variable changes before the original value has been used', 1),
(142, 31, 'The value of the variable changes while the original value has been used', 0),
(143, 31, 'None of the above     ', 0),
(144, 32, 'for(a=b; a=c; a++)', 0),
(145, 32, 'for(a=b+1, b<=c; a++)', 0),
(146, 32, 'for(a=b; a<=c; a++)', 1),
(147, 32, 'for(a=b+1; a<=b, a++) ', 0),
(148, 33, 'If and only if both the simple conditions are True', 1),
(149, 33, 'As long as one of the simple conditions is True', 0),
(150, 33, 'If both the simple conditions are False', 0),
(151, 33, 'None of the above ', 0),
(152, 34, '2 4 6 8 10', 1),
(153, 34, '1 3 5 7 9', 0),
(154, 34, '1 2 3 4 5 6 7 8 9', 0),
(155, 34, '1 2 3 4 5 6 7 8 9 10', 0),
(156, 35, 'The sum of 2 4 6 8 10 is 30', 0),
(157, 35, 'The sum 1 3 5 7 9 is 25', 0),
(158, 35, 'The sum of 1 2 3 4 5 is 15', 1),
(159, 35, 'The sum of 6 7 8 9 10 is 40', 0),
(160, 36, '1 2 3 4 5 – 1 2 3', 0),
(161, 36, '1 2 3 – 1 2 3', 0),
(162, 36, '1 2 3 – 1 2 3 4', 0),
(163, 36, '1 2 3 4 – 1 2 ', 1),
(164, 37, '0 24689', 0),
(165, 37, '013569', 0),
(166, 37, '035912', 0),
(167, 37, '036912 ', 1),
(168, 38, 'Factorial of 5 is 75', 0),
(169, 38, 'Factorial of 5 is 120', 1),
(170, 38, 'Factorial of 5 is 100', 0),
(171, 38, 'Factorial of 5 is 50 ', 0),
(172, 39, '4 5 6 7 8 ', 0),
(173, 39, '3 4 5 6 7 8 9', 1),
(174, 39, '3 4 5 6 7 8', 0),
(175, 39, '4 5 6 7 8 9 ', 0),
(176, 40, 'hardware', 1),
(177, 40, 'computer', 0),
(178, 40, 'operating system', 0),
(179, 40, 'software', 0),
(180, 41, 'input unit', 0),
(181, 41, 'secondary storage unit', 0),
(182, 41, 'output unit', 0),
(183, 41, 'secondary processing unit', 1),
(184, 42, 'olive', 0),
(185, 42, 'oak', 1),
(186, 42, 'pine', 0),
(187, 42, 'pear', 0),
(188, 43, 'Machine language', 0),
(189, 43, 'Assembler language', 1),
(190, 43, 'High-level language', 0),
(191, 43, 'Assembly language', 0),
(192, 44, 'Assembly language to high-level language', 0),
(193, 44, 'Assembly language to machine language', 0),
(194, 44, 'High-level language to assembly language', 0),
(195, 44, 'High-level language to machine language', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `class_record`
--

INSERT INTO `class_record` (`class_record_id`, `account_id`, `semester`, `school_year`, `course_id`, `section_id`, `subject_id`) VALUES
(56, 87, 1, '2004-2005', 1, 1, 5),
(57, 30, 2, '2004-2005', 1, 2, 6),
(58, 90, 1, '2004-2005', 2, 10, 4),
(59, 28, 1, '2004-2005', 2, 6, 10),
(60, 96, 2, 'SY 2014-2015', 1, 8, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `class_student`
--

INSERT INTO `class_student` (`class_student_id`, `class_record_id`, `student_id`) VALUES
(1, 60, 18),
(2, 60, 66),
(3, 60, 67),
(4, 60, 68),
(5, 60, 69),
(6, 60, 70);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_label` varchar(255) NOT NULL,
  `acronym` varchar(100) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_label`, `acronym`) VALUES
(1, 'Bachelor of Science in Information Technology', 'BSIT'),
(2, 'Bachelor of Science in Computer Science', 'BSCS'),
(3, 'Bachelor of Sciece in Information Science', 'BSIS'),
(4, 'Bachelor of Science in Accountancy', 'BSA'),
(5, 'Bachelor of Science in Business Administration Major in Financial Management', 'BSBAFM'),
(6, 'Bachelor of Science in Business Administration Major in Marketing Management', 'BSBAMM'),
(7, 'Bachelor of Science in Business Administration', 'BSBA'),
(8, 'Bachelor of Science in Entreprenuership', 'BSE'),
(9, 'Bachelor of Science in Education', 'BSED'),
(10, 'Bachelor in Elementary Education', 'BEE'),
(11, 'Bachelor of Science in Pharmacy', 'BSPH'),
(12, 'Bachelor of Science in Chemistry', 'BSC'),
(13, 'Bachelor of Science in Nutrition and Dietetics', 'BSND'),
(14, 'Bachelor of Science in Hotel Management', 'BSHRM'),
(15, 'Bachelor of Music', 'BM'),
(16, 'Bachelor of Arts Major in Psychology', 'BAMP'),
(17, 'Bachelor of Arts Major in Communication Arts', 'BAMCA'),
(18, 'Bachelor of Arts Major in English', 'BAME'),
(19, 'Bachelor of Arts Major in Philosophy', 'BAMP'),
(20, 'Bachelor of Science in Computer Engineering', 'BSCE'),
(21, 'Bachelor of Science in Electronics and Communication Engineering', 'BSECE'),
(22, 'Bachelor of Science in Civil Engineering', 'BSCivE'),
(23, 'Bachelor of Science in Nursing', 'BSN'),
(24, 'Bachelor of Medical Laboratory Science', 'BMLS'),
(25, 'Bachelor of Science in Medical Technology', 'BSMT'),
(26, 'Bachelor of Science in Clinical Pharmacy', 'BSClinPh'),
(27, 'Bachelor of Science in Information Technology Major in Computer Networks', 'BSITCN'),
(28, 'Bachelor of Science in Information Technology Major in Software Engineering', 'BSITSE'),
(29, 'Bachelor of Science in Information Technology Major in Multimedia', 'BSITMM'),
(30, 'Bachelor of Science in Accounting Technology', 'BSAccTech'),
(31, 'Bachelor of Science in Secondary Education', 'BSSecEd');

-- --------------------------------------------------------

--
-- Table structure for table `data_bank`
--

CREATE TABLE IF NOT EXISTS `data_bank` (
  `databank_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `question_difficulty` float NOT NULL,
  PRIMARY KEY (`databank_id`),
  KEY `questionnaire_id_2` (`questionnaire_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `data_bank`
--

INSERT INTO `data_bank` (`databank_id`, `date`, `questionnaire_id`, `question_difficulty`) VALUES
(1, '0000-00-00', 1, 0.9),
(2, '0000-00-00', 3, 0.91),
(3, '0000-00-00', 4, 0.23),
(4, '0000-00-00', 5, 0.92),
(5, '0000-00-00', 11, 0.23),
(6, '0000-00-00', 16, 0.92),
(7, '0000-00-00', 17, 0.22),
(8, '0000-00-00', 18, 0.32),
(9, '0000-00-00', 19, 0.98);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_schedule_id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`exam_id`),
  KEY `attempt_id` (`exam_schedule_id`,`questionnaire_id`),
  KEY `exam_schedule_id` (`exam_schedule_id`),
  KEY `questionnaire_id` (`questionnaire_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=190 ;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `exam_schedule_id`, `questionnaire_id`, `subject_id`) VALUES
(180, 2, 18, 5),
(181, 2, 17, 5),
(182, 2, 19, 5),
(183, 2, 16, 5),
(184, 2, 23, 5),
(185, 7, 44, 6),
(186, 7, 43, 6),
(187, 7, 42, 6),
(188, 7, 41, 6),
(189, 7, 40, 6);

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedule`
--

CREATE TABLE IF NOT EXISTS `exam_schedule` (
  `exam_schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `exam_date` date NOT NULL,
  `title_exam` varchar(100) NOT NULL,
  `grading_period_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `exam_password` varchar(50) NOT NULL,
  `kr20` float NOT NULL,
  PRIMARY KEY (`exam_schedule_id`),
  KEY `class_record_id` (`account_id`),
  KEY `subject_id` (`subject_id`),
  KEY `grading_period_id` (`grading_period_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `exam_schedule`
--

INSERT INTO `exam_schedule` (`exam_schedule_id`, `account_id`, `exam_date`, `title_exam`, `grading_period_id`, `subject_id`, `exam_password`, `kr20`) VALUES
(2, 87, '2014-01-22', 'Prelim Exam', 1, 5, 'prelim', 0),
(5, 87, '2014-01-21', 'Midterm Exam', 1, 38, 'midterm', 0),
(6, 87, '2014-01-22', 'Final Exam', 3, 32, 'finals', 0),
(7, 96, '2015-01-25', 'CPROG 2 PRELIM EXAM', 1, 6, 'ciben', 0.625);

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
  `gpa` float NOT NULL,
  `questionnaire_status` int(11) NOT NULL,
  PRIMARY KEY (`questionnaire_id`),
  KEY `subject_id` (`subject_id`),
  KEY `grading_periods_id` (`grading_period_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `questionnaire`
--

INSERT INTO `questionnaire` (`questionnaire_id`, `subject_id`, `grading_period_id`, `status_id`, `question`, `time_created`, `time_updated`, `gpa`, `questionnaire_status`) VALUES
(1, 1, 1, 1, 'Hello World1!', '2015-01-20 03:07:47', '2015-01-20 03:07:47', 0, 0),
(3, 1, 2, 1, 'Hello World2!', '2015-01-20 03:09:57', '2015-01-20 03:09:57', 0, 0),
(4, 1, 3, 1, 'Hello World3!', '2015-01-20 03:33:34', '2015-01-20 03:33:34', 0, 0),
(5, 1, 1, 1, 'Hello World4!', '2015-01-20 03:35:27', '2015-01-20 03:35:27', 0, 0),
(11, 5, 1, 1, '______ is a device that is capable of performing computations and making logical decisions at speeds billions of times faster than the human being can.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(16, 5, 1, 1, 'A computer has six logical units. Which of the following is not part of the six?', '2015-01-21 22:20:37', '2015-01-21 22:20:37', 0, 0),
(17, 5, 1, 1, 'The programming language Java was originally called _________.', '2015-01-21 22:21:51', '2015-01-21 22:21:51', 0, 0),
(18, 5, 1, 1, 'The following are the classes of programming languages except', '2015-01-21 22:23:16', '2015-01-21 22:23:16', 0, 0),
(19, 5, 1, 1, 'A compiler is a program that translates ______________.', '2015-01-21 22:28:05', '2015-01-21 22:28:05', 0, 0),
(20, 5, 1, 1, 'Wirth developed this language for teaching structured programming.', '2015-01-21 22:29:16', '2015-01-21 22:29:16', 0, 0),
(21, 5, 1, 1, 'He was the creator of C language.', '2015-01-21 22:30:10', '2015-01-21 22:30:10', 0, 0),
(22, 5, 1, 1, 'It is the fourth phase of the execution of C programs.', '2015-01-21 22:31:03', '2015-01-21 22:31:03', 0, 0),
(23, 5, 1, 1, 'COBOL stands for', '2015-01-21 22:31:49', '2015-01-21 22:31:49', 0, 0),
(24, 5, 1, 1, 'It allows programmers to type-in their codes into the computer', '2015-01-21 22:32:45', '2015-01-21 22:32:45', 0, 0),
(25, 5, 2, 1, '______ is another term for counter-controlled repetition. In this kind of repetition, it is known in advanced the number of times the loop will be executed.', '2015-01-21 22:34:54', '2015-01-21 22:34:54', 0, 0),
(26, 5, 2, 1, 'The ______ statement skips the remaining code in the loop body and proceeds to the next iteration.', '2015-01-21 22:36:40', '2015-01-21 22:36:40', 0, 0),
(27, 5, 2, 1, 'In performing repetitions, programmers may choose from how many possible ways? ', '2015-01-21 22:37:32', '2015-01-21 22:37:32', 0, 0),
(28, 5, 2, 1, '______ is another term for sentinel-controlled repetition. In this kind of repetition, it is not known in advanced the number of times the loop will be executed.', '2015-01-21 22:38:31', '2015-01-21 22:38:31', 0, 0),
(29, 5, 2, 1, 'When used in for, while, do...while or switch statements, the ______ statement skips the remaining part of that statement.', '2015-01-21 22:40:15', '2015-01-21 22:40:15', 0, 0),
(30, 5, 2, 1, 'When can you say that a complex condition which uses an OR (||) logical operator is false?', '2015-01-21 22:41:09', '2015-01-21 22:41:09', 0, 0),
(31, 5, 2, 1, 'Which of these statements is the appropriate description of post-incrementation?  ', '2015-01-21 22:42:14', '2015-01-21 22:42:14', 0, 0),
(32, 5, 2, 1, 'Which is the correct syntax for a for repetition statement?      ', '2015-01-21 22:43:24', '2015-01-21 22:43:24', 0, 0),
(33, 5, 2, 1, 'When can you say that a complex condition which uses an AND (&&) logical  operator is true?', '2015-01-21 22:44:29', '2015-01-21 22:44:29', 0, 0),
(34, 5, 2, 1, 'What will be the output of the code snippet below?\r\n\r\nint a=1;\r\nwhile (a<=10)\r\n{\r\n    a+=1;\r\n    printf("%d ",a*1);\r\n    ++a;\r\n}\r\n', '2015-01-21 22:46:04', '2015-01-21 22:46:04', 0, 0),
(35, 5, 2, 1, 'What will be the output of the code snippet below?\r\n\r\nint b=0;\r\n\r\nprintf("the sum of ");\r\n\r\nfor (int a=1;a<6;a++)\r\n{\r\n    printf("%d ",a);\r\n    b=b+a;\r\n}\r\nprintf("is %d",b);\r\n', '2015-01-21 22:48:43', '2015-01-21 22:48:43', 0, 0),
(36, 5, 2, 1, 'What will be the output of the code snippet below?\r\n\r\nint i = 0;\r\n\r\ndo{\r\n   printf("%d ", i+1);\r\n   i++;\r\n  }while(i <= 3);\r\n\r\nprintf(" - ");\r\n\r\ni = 0;\r\ndo{\r\n   printf("%d ", ++i);\r\n  }while(i+1 < 3);\r\n', '2015-01-21 22:49:36', '2015-01-21 22:49:36', 0, 0),
(37, 5, 2, 1, 'What will be the output of the code snippet below?\r\n\r\nwhile(a<15)\r\n{\r\n    int b = 3;\r\n    printf("%d", a);\r\n    a+=b;\r\n}\r\n', '2015-01-21 22:50:36', '2015-01-21 22:50:36', 0, 0),
(38, 5, 2, 1, 'What will be the output of the code snippet below?\r\n\r\nint number = 5;\r\nint factorial=1;     \r\n\r\nint temp = number;\r\nwhile(number>0)\r\n{ \r\n    factorial=factorial*number;\r\n    --number;\r\n}    \r\nprintf("Factorial of %d is %d", temp, factorial);\r\n', '2015-01-21 22:51:52', '2015-01-21 22:51:52', 0, 0),
(39, 5, 2, 1, 'What will be the output of the code snippet below?\r\n\r\n i=3, n=9;\r\ndo \r\n{ \r\n  printf("%d ",i); \r\n  sum=sum+i; \r\n  i++; \r\n  } \r\nwhile(i<=n);\r\n', '2015-01-21 22:52:44', '2015-01-21 22:52:44', 0, 0),
(40, 6, 1, 1, '______ is a device that is capable of performing computations and making logical decisions at speeds billions of times faster than the human being can.', '2015-01-24 17:28:15', '2015-01-24 17:28:15', 0.2, 1),
(41, 6, 1, 1, 'A computer has six logical units. Which of the following is not part of the six?', '2015-01-24 17:28:41', '2015-01-24 17:28:41', 0, 1),
(42, 6, 1, 1, 'The programming language Java was originally called _________.', '2015-01-24 17:29:07', '2015-01-24 17:29:07', 0.2, 1),
(43, 6, 1, 1, 'The following are the classes of programming languages except', '2015-01-24 17:30:37', '2015-01-24 17:30:37', 0.8, 1),
(44, 6, 1, 1, 'A compiler is a program that translates ______________.', '2015-01-24 17:31:23', '2015-01-24 17:31:23', 0.6, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `course_id`, `account_id`, `year_level`, `class_record_id`) VALUES
(13, 3, 32, 4, 0),
(15, 2, 33, 1, 0),
(16, 1, 34, 2, 0),
(17, 1, 35, 4, 0),
(18, 1, 36, 2, 0),
(19, 1, 37, 1, 0),
(20, 1, 38, 1, 0),
(21, 2, 39, 1, 0),
(22, 1, 40, 1, 0),
(23, 1, 41, 1, 0),
(24, 1, 42, 1, 0),
(25, 1, 43, 1, 0),
(26, 1, 44, 1, 0),
(27, 1, 45, 1, 0),
(28, 1, 46, 1, 0),
(29, 1, 47, 1, 0),
(30, 1, 48, 1, 0),
(31, 2, 49, 2, 0),
(32, 2, 50, 2, 0),
(33, 2, 51, 2, 0),
(34, 2, 52, 2, 0),
(35, 2, 53, 2, 0),
(36, 2, 54, 2, 0),
(37, 2, 55, 2, 0),
(38, 2, 56, 3, 0),
(39, 3, 57, 3, 0),
(40, 3, 58, 3, 0),
(41, 3, 59, 3, 0),
(42, 3, 60, 3, 0),
(43, 3, 61, 3, 0),
(44, 3, 62, 4, 0),
(45, 3, 63, 3, 0),
(46, 3, 64, 3, 0),
(47, 2, 65, 4, 0),
(48, 2, 66, 3, 0),
(49, 2, 67, 1, 0),
(50, 3, 68, 2, 0),
(51, 2, 69, 1, 0),
(52, 1, 70, 3, 0),
(53, 2, 71, 4, 0),
(54, 3, 72, 4, 0),
(55, 3, 73, 4, 0),
(56, 3, 74, 4, 0),
(57, 2, 75, 4, 0),
(58, 2, 76, 3, 0),
(59, 2, 77, 4, 0),
(60, 2, 78, 3, 0),
(61, 2, 79, 1, 0),
(62, 2, 80, 3, 0),
(63, 2, 81, 3, 0),
(64, 3, 82, 4, 0),
(65, 2, 83, 3, 0),
(66, 1, 97, 2, 0),
(67, 1, 98, 4, 0),
(68, 1, 99, 4, 0),
(69, 1, 100, 2, 0),
(70, 1, 101, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_exam_answer`
--

CREATE TABLE IF NOT EXISTS `student_exam_answer` (
  `student_exam_answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `exam_schedule_id` int(11) NOT NULL,
  PRIMARY KEY (`student_exam_answer_id`),
  KEY `fk_student_exam_answer_student1_idx` (`student_id`),
  KEY `fk_student_exam_answer_answer1_idx` (`answer_id`),
  KEY `exam_schedule_id` (`exam_schedule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `student_exam_answer`
--

INSERT INTO `student_exam_answer` (`student_exam_answer_id`, `student_id`, `answer_id`, `exam_schedule_id`) VALUES
(90, 67, 185, 7),
(91, 67, 182, 7),
(92, 67, 191, 7),
(93, 67, 177, 7),
(94, 67, 193, 7),
(95, 66, 195, 7),
(96, 66, 185, 7),
(97, 66, 181, 7),
(98, 66, 178, 7),
(99, 66, 189, 7),
(100, 70, 192, 7),
(101, 70, 176, 7),
(102, 70, 184, 7),
(103, 70, 181, 7),
(104, 70, 188, 7),
(105, 68, 185, 7),
(106, 68, 177, 7),
(107, 68, 188, 7),
(108, 68, 195, 7),
(109, 68, 181, 7),
(110, 69, 195, 7),
(111, 69, 191, 7),
(112, 69, 179, 7),
(113, 69, 182, 7),
(114, 69, 185, 7);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_label` varchar(255) NOT NULL,
  `acronym` varchar(100) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_label`, `acronym`) VALUES
(1, 'Techpreneurship', 'Techpre'),
(2, 'Komunikasyon sa Akademikong Filipino', 'FIL1'),
(3, 'Communication Skills', 'ENGL1'),
(4, 'Discrete Math', 'Math311'),
(5, 'Computer Programming 1', 'CPROG1-121'),
(6, 'Computer Programming 2', 'CPROG2-211'),
(7, 'General Psychology', 'Psy1'),
(8, 'Introduction to Theology / Basic Catechesis', 'THEO1'),
(9, 'Introduction to Scriptures', 'THEO2'),
(10, 'Christology', 'THEO3'),
(11, 'Computer Fundamentals', 'CFUND-111'),
(12, 'Computer Applications', 'CAPP-112'),
(13, 'College Algebra', 'MATH1'),
(14, 'Computer Hardware & Software Technology', 'CHST-122'),
(15, 'Plane Trigonometry', 'MATH2'),
(16, 'Study and Thinking Skills', 'ENGL2'),
(17, 'Pagbasa at Pagsulat Tungo sa Pananaliksik', 'FIL2'),
(18, 'Digital Circuits', 'DIGCIR-131'),
(19, 'Computer Organization & Architecture', 'CORG-132'),
(20, 'Object Oriented Programming', 'ITSE Elect1'),
(21, 'Computer Graphics Applications', 'ITMMElect2'),
(22, 'Basic Accounting', 'TACC1-213'),
(23, 'Writing in the Discipline', 'ENGL3'),
(24, 'General Physics 1', 'Phys1A'),
(25, 'Calculus w/ Analytic Geometry', 'MATH2A'),
(26, 'Computer Networks 1', 'CNW1-212'),
(27, 'Operating System', 'OS-214'),
(28, 'Basic Accounting', 'TMMElect1'),
(29, 'Church and Sacraments', 'THEO4'),
(30, 'Speech and Communication', 'ENGL4'),
(31, 'General Physics 2', 'Phys1B'),
(32, 'Computer Networks 2', 'CNW2-221'),
(33, 'Data Structures and Algorithms', 'DSTA-222'),
(34, 'Intermediate Accounting & Accounting', 'ITACC2-223'),
(35, 'Web Development 1', 'F Elect 1'),
(36, 'IT Research Methods', 'IT Elect2'),
(37, 'Web Development 2', 'ITSE Elect3'),
(38, 'Computer Networks 3', 'CNW3-312'),
(39, 'Web Development 2', 'ITNWElect3'),
(40, 'Introduction to Humanities', 'HUMAN1'),
(41, 'Computer Systems Security', 'FElect 1'),
(42, 'SAP Computer System Security', 'FElect2'),
(43, 'Christian Morality', 'THEO5'),
(44, 'Discrete Mathematics', 'Math311'),
(45, 'Digital Animation', 'DIGAN-311'),
(46, 'Database Management System 1', 'DBMS1-311'),
(47, 'Systems Analysis and Design', 'SAD-313'),
(48, 'Computer Graphics Application', 'ITMMElect3'),
(49, 'SAP Business 1', 'FElect 2'),
(50, 'World Literature', 'LIT2'),
(51, 'Probability & Statistics', 'Math322'),
(52, 'Society and Culture (with Family Planning)', 'SOCIO1'),
(53, 'Basic Economics (with Taxation & Agrarian', 'ECON1'),
(54, 'Software Engineering', 'SE-324'),
(55, 'Project Management', 'PM-322'),
(56, 'Computer Game Design & Development', 'CGAME-321'),
(57, 'SAP Business 2', 'ITMMElect 4'),
(58, 'Computer Systems Security', 'CSSEC-324'),
(59, 'Database Management System 2', 'DBMS2-321'),
(60, 'SAP Business 2', 'ITSE Elect4'),
(61, 'IT Project 1', 'ITPROJ1-411'),
(62, 'Logic', 'PHILO1'),
(63, 'Philippine History and Public Service', 'HIST1'),
(64, 'Politics and Governance (with Philippine', 'POLSCI'),
(65, 'Life and Works of Rizal', 'RIZAL'),
(66, 'IT Project 2', 'ITPROJ2-421'),
(67, 'Technopreneurship', 'TECHPRE-422'),
(68, 'Professional Ethics and Values Education', 'ETH-423'),
(69, 'XML and Web Services', 'FElect 3 (SE)'),
(70, 'Web Development 2', 'FElect 3'),
(71, 'Internet Server Management', 'FElect 3 (CN)'),
(72, 'Digital Video, Audio Editing & Production', 'FElect 3 (MM)');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `subs_ins`
--

INSERT INTO `subs_ins` (`subs_ins_id`, `teacher_id`, `subject_id`, `acronym`) VALUES
(1, 4, 5, 'Cprog1');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`teacher_id`),
  KEY `subject_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `account_id`) VALUES
(4, 87);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `idtest` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`idtest`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`idtest`, `value`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(20, 0),
(21, 1),
(22, 1),
(23, 0),
(24, 1),
(25, 1),
(26, 1);

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
  ADD CONSTRAINT `data_bank_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaire` (`questionnaire_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_2` FOREIGN KEY (`exam_schedule_id`) REFERENCES `exam_schedule` (`exam_schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_ibfk_3` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaire` (`questionnaire_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_ibfk_4` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD CONSTRAINT `exam_schedule_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_schedule_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_schedule_ibfk_3` FOREIGN KEY (`grading_period_id`) REFERENCES `grading_period` (`grading_period_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `student_exam_answer`
--
ALTER TABLE `student_exam_answer`
  ADD CONSTRAINT `student_exam_answer_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_exam_answer_ibfk_3` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`answer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_exam_answer_ibfk_4` FOREIGN KEY (`exam_schedule_id`) REFERENCES `exam_schedule` (`exam_schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
