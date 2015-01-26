-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2015 at 03:34 PM
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_acct_dup`(IN `id_num` INT(10))
BEGIN
	SELECT account_id 
	FROM databank_project.account
	WHERE id_number = id_num;
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
	WHERE account_id = acct_id and kr20 != 0;
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
	SELECT question, questionnaire_id 
	FROM databank_project.questionnaire 
	WHERE questionnaire_status = 0;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_student_exam_result`(IN `stud_id` INT(10), IN `ex_sched_id` INT(10))
BEGIN
	SELECT student_exam_answer.student_id,
		student_exam_answer.answer_id,
		student_exam_answer.exam_schedule_id,
		answer.label,
		questionnaire.questionnaire_id,
		questionnaire.question,
		answer.correct
	FROM databank_project.student_exam_answer
	LEFT JOIN answer ON student_exam_answer.answer_id  = answer.answer_id
	LEFT JOIN questionnaire ON answer.questionnaire_id = questionnaire.questionnaire_id
	LEFT JOIN exam_schedule ON student_exam_answer.exam_schedule_id = exam_schedule.exam_schedule_id
	WHERE student_exam_answer.student_id = stud_id AND student_exam_answer.exam_schedule_id = ex_sched_id
	ORDER BY questionnaire.questionnaire_id;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_student_score`(IN `stud_id` INT(10), IN `ex_sched_id` INT(10))
BEGIN
	SELECT count(answer.correct) AS correct
	FROM databank_project.student_exam_answer
	LEFT JOIN answer ON student_exam_answer.answer_id  = answer.answer_id
	LEFT JOIN questionnaire ON answer.questionnaire_id = questionnaire.questionnaire_id
	LEFT JOIN exam_schedule ON student_exam_answer.exam_schedule_id = exam_schedule.exam_schedule_id
	WHERE student_exam_answer.student_id = stud_id AND student_exam_answer.exam_schedule_id = ex_sched_id
	ORDER BY questionnaire.questionnaire_id;
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
		answer.questionnaire_id,
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_view_exam_answers`(IN `ex_id` INT(10))
BEGIN
		SELECT 		answer.questionnaire_id,
					answer.answer_id,
					answer.label AS choices,
					answer.correct
		FROM databank_project.exam
		LEFT JOIN questionnaire ON exam.questionnaire_id = questionnaire.questionnaire_id
		LEFT JOIN answer ON questionnaire.questionnaire_id = answer.questionnaire_id
		WHERE exam.exam_schedule_id = ex_id
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
	SELECT DISTINCT student_id
	FROM databank_project.student_exam_answer
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=117 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_type_id`, `id_number`, `acct_username`, `acct_password`, `last_name`, `first_name`, `middle_name`, `acct_status`, `time_created`, `time_updated`) VALUES
(14, 1, '1102089', 'admin', 'MM¹Ä\0fè‘Ëý‘ôøk', 'TAN', 'CHIN TINN LOURENCE', 'SON', 1, '2015-01-21 10:45:00', '2015-01-21 11:48:00'),
(102, 3, '0900870', '0900870', 'T¢ÒË‡;ŠÍ&-q<°~É', 'LIM', 'LANCE KELVIN', 'FOLLANTE', 1, '2015-01-25 23:58:26', '2015-01-25 23:58:26'),
(103, 2, '091234', 'teach', 'xH¶ä5Ocßs—°˜“#', 'BEN', 'CI', 'BEN', 1, '2015-01-26 00:00:39', '2015-01-26 00:00:39'),
(104, 3, '1001491', '1001491', '%6¸ <?ÀSoNŒË‰', 'QUITORIANO', 'JESSRYLL', 'PACHECO', 1, '2015-01-26 00:03:22', '2015-01-26 00:03:22'),
(105, 3, '0801107', '0801107', '&èGÞSdÆ^Ì²}2ŸÈ', 'PURGATORIO', 'JOHN - JOHN', 'ADORABLE', 1, '2015-01-26 00:06:34', '2015-01-26 00:06:34'),
(107, 3, '0912345', 'student5', 'êTûU£ïJ9NÓÈ •', 'STUDENT5', 'STUDENT5', 'STUDENT5', 1, '2015-01-26 00:10:47', '2015-01-26 00:10:47'),
(108, 3, 'student6', 'student6', 'ãxõT«-ÉlV‚ÀÑ›.Å', 'STUDENT6', 'STUDENT6', 'STUDENT6', 1, '2015-01-26 00:11:08', '2015-01-26 00:11:08'),
(109, 3, 'student7', 'student7', 'ÃË(ÎTÆÒÝ×t E÷', 'STUDENT7', 'STUDENT7', 'STUDENT7', 1, '2015-01-26 00:11:26', '2015-01-26 00:11:26'),
(110, 3, 'student8', 'student8', '8à•æõ¡™ëø°<nÃ±', 'STUDENT8', 'STUDENT8', 'STUDENT8', 1, '2015-01-26 00:11:50', '2015-01-26 00:11:50'),
(111, 3, 'student9', 'student9', '½¡6n¦©H$=êD·ê', 'STUDENT9', 'STUDENT9', 'STUDENT9', 1, '2015-01-26 00:12:24', '2015-01-26 00:12:24'),
(113, 3, 'student10', 'student10', 'tS/äØÄ] +Ì?C''', 'STUDENT10', 'STUDENT10', 'STUDENT10', 1, '2015-01-26 00:13:08', '2015-01-26 00:13:08'),
(114, 3, 'student11', 'student11', 'ƒ/5IÚ™ü\\°ã M?³', 'STUDENT11', 'STUDENT11', 'STUDENT11', 1, '2015-01-26 00:13:25', '2015-01-26 00:13:25'),
(115, 3, 'student12', 'student12', 'ÉŠÒUÎÁ‘Õ:@ây÷§Ë', 'STUDENT12', 'STUDENT12', 'STUDENT12', 1, '2015-01-26 00:13:41', '2015-01-26 00:13:41');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=240 ;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `questionnaire_id`, `label`, `correct`) VALUES
(196, 45, 'input unit', 0),
(197, 45, 'secondary storage unit', 0),
(198, 45, 'secondary processing unit', 1),
(199, 45, 'c. output unit', 0),
(200, 46, 'Olive', 0),
(201, 46, 'Oak', 1),
(202, 46, 'Pine', 0),
(203, 46, 'Pear', 0),
(204, 47, 'Machine Language', 0),
(205, 47, 'Assembler Language', 1),
(206, 47, 'High-Level Language', 0),
(207, 47, 'Assembly language', 0),
(208, 48, 'assembly language to high-level language', 0),
(209, 48, 'assembly language to machine language', 0),
(210, 48, 'high-level language to assembly language', 0),
(211, 48, 'high-level language to machine language', 1),
(212, 49, 'COBOL', 0),
(213, 49, 'PASCAL', 1),
(214, 49, 'BCPL', 0),
(215, 49, 'FORTRAN', 0),
(216, 50, 'Dennis Ritchie', 1),
(217, 50, 'Martin Richards', 0),
(218, 50, 'Ken Thompson', 0),
(219, 50, 'Steve Jobs', 0),
(220, 51, 'load', 0),
(221, 51, 'execute', 0),
(222, 51, 'link', 1),
(223, 51, 'compile ', 0),
(224, 52, 'Common Business Oriented Language', 1),
(225, 52, 'Common Business Operational Language', 0),
(226, 52, 'Computer Business Oriented Language', 0),
(227, 52, 'Computer Business Operational Language', 0),
(228, 53, 'Compiler', 0),
(229, 53, 'Editor', 1),
(230, 53, 'Assembler', 0),
(231, 53, 'Interpreter', 0),
(232, 54, 'perhaps', 0),
(233, 54, 'yes', 1),
(234, 54, 'no', 0),
(235, 54, 'maybe', 0),
(236, 55, 'IBM personal computer was used in most businesses today  ', 0),
(237, 55, 'IBM personal computer was introduced in business and industry a long time ago ', 0),
(238, 55, 'IBM personal computer made personal computing legitimate in business and industry', 1),
(239, 55, 'IBM personal computer was the first commercial computer', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `class_record`
--

INSERT INTO `class_record` (`class_record_id`, `account_id`, `semester`, `school_year`, `course_id`, `section_id`, `subject_id`) VALUES
(61, 103, 1, '2014-2015', 1, 13, 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `class_student`
--

INSERT INTO `class_student` (`class_student_id`, `class_record_id`, `student_id`) VALUES
(7, 61, 71),
(18, 61, 72),
(17, 61, 73),
(15, 61, 75),
(14, 61, 76),
(13, 61, 77),
(12, 61, 78),
(11, 61, 79),
(10, 61, 80),
(9, 61, 81),
(19, 61, 82);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=304 ;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `exam_schedule_id`, `questionnaire_id`, `subject_id`) VALUES
(190, 8, 45, 5),
(191, 8, 46, 5),
(192, 8, 47, 5),
(193, 8, 48, 5),
(194, 8, 49, 5),
(195, 8, 50, 5),
(196, 8, 51, 5),
(197, 8, 52, 5),
(198, 8, 53, 5),
(199, 8, 54, 5),
(200, 8, 55, 5),
(288, 12, 45, 5),
(289, 12, 52, 5),
(290, 12, 51, 5),
(291, 12, 53, 5),
(292, 12, 50, 5),
(293, 12, 46, 5),
(294, 13, 55, 5),
(295, 13, 49, 5),
(296, 13, 51, 5),
(297, 13, 53, 5),
(298, 13, 54, 5),
(299, 13, 46, 5),
(300, 13, 50, 5),
(301, 13, 48, 5),
(302, 13, 47, 5),
(303, 13, 45, 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `exam_schedule`
--

INSERT INTO `exam_schedule` (`exam_schedule_id`, `account_id`, `exam_date`, `title_exam`, `grading_period_id`, `subject_id`, `exam_password`, `kr20`) VALUES
(8, 103, '0000-00-00', 'CPROG', 1, 5, '12345', 0.657566),
(12, 103, '2015-01-26', 'TEST', 1, 5, '12345', 0),
(13, 103, '2015-01-27', 'testing Exam', 1, 5, '12345', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `questionnaire`
--

INSERT INTO `questionnaire` (`questionnaire_id`, `subject_id`, `grading_period_id`, `status_id`, `question`, `time_created`, `time_updated`, `gpa`, `questionnaire_status`) VALUES
(45, 5, 1, 1, 'A computer has six logical units. Which of the following is not part of the six?', '2015-01-26 00:32:11', '2015-01-26 00:32:11', 0.636364, 1),
(46, 5, 1, 1, '  The programming language Java was originally called _________.', '2015-01-26 00:32:48', '2015-01-26 00:32:48', 0.545455, 1),
(47, 5, 1, 1, 'The following are the classes of programming languages except', '2015-01-26 00:37:06', '2015-01-26 00:37:06', 0.545455, 1),
(48, 5, 1, 1, 'A compiler is a program that translates ______________.', '2015-01-26 00:37:52', '2015-01-26 00:37:52', 0.545455, 1),
(49, 5, 1, 1, 'Wirth developed this language for teaching structured programming.', '2015-01-26 00:38:15', '2015-01-26 00:38:15', 0.363636, 1),
(50, 5, 1, 1, 'He was the creator of C language.', '2015-01-26 00:38:37', '2015-01-26 00:38:37', 0.727273, 1),
(51, 5, 1, 1, 'It is the fourth phase of the execution of C programs. ', '2015-01-26 00:38:57', '2015-01-26 00:38:57', 0.636364, 1),
(52, 5, 1, 1, 'COBOL stands for', '2015-01-26 00:39:21', '2015-01-26 00:39:21', 0.545455, 1),
(53, 5, 1, 1, 'It allows programmers to type-in their codes into the computer ', '2015-01-26 00:39:40', '2015-01-26 00:39:40', 0.545455, 1),
(54, 5, 1, 1, 'Today, does personal computing still exist', '2015-01-26 00:40:09', '2015-01-26 00:40:09', 0.818182, 1),
(55, 5, 1, 1, 'How did IBM personal computer contributed to the business and industry? ', '2015-01-26 00:40:31', '2015-01-26 00:40:31', 0.363636, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `course_id`, `account_id`, `year_level`, `class_record_id`) VALUES
(71, 1, 102, 4, 0),
(72, 1, 104, 4, 0),
(73, 1, 105, 4, 0),
(75, 1, 107, 4, 0),
(76, 1, 108, 4, 0),
(77, 1, 109, 4, 0),
(78, 1, 110, 4, 0),
(79, 1, 111, 4, 0),
(80, 1, 113, 4, 0),
(81, 1, 114, 4, 0),
(82, 1, 115, 4, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=247 ;

--
-- Dumping data for table `student_exam_answer`
--

INSERT INTO `student_exam_answer` (`student_exam_answer_id`, `student_id`, `answer_id`, `exam_schedule_id`) VALUES
(115, 71, 233, 8),
(116, 71, 213, 8),
(117, 71, 198, 8),
(118, 71, 205, 8),
(119, 71, 224, 8),
(120, 71, 211, 8),
(121, 71, 229, 8),
(122, 71, 222, 8),
(123, 71, 238, 8),
(124, 71, 201, 8),
(125, 71, 216, 8),
(126, 75, 211, 8),
(127, 75, 213, 8),
(128, 75, 200, 8),
(129, 75, 238, 8),
(130, 75, 216, 8),
(131, 75, 198, 8),
(132, 75, 233, 8),
(133, 75, 224, 8),
(134, 75, 222, 8),
(135, 75, 229, 8),
(136, 75, 204, 8),
(137, 73, 224, 8),
(138, 73, 218, 8),
(139, 73, 238, 8),
(140, 73, 233, 8),
(141, 73, 213, 8),
(142, 73, 231, 8),
(143, 73, 211, 8),
(144, 73, 205, 8),
(145, 73, 222, 8),
(146, 73, 201, 8),
(147, 73, 196, 8),
(148, 76, 237, 8),
(149, 76, 200, 8),
(150, 76, 229, 8),
(151, 76, 205, 8),
(152, 76, 215, 8),
(153, 76, 233, 8),
(154, 76, 198, 8),
(155, 76, 224, 8),
(156, 76, 216, 8),
(157, 76, 222, 8),
(158, 76, 210, 8),
(159, 77, 205, 8),
(160, 77, 213, 8),
(161, 77, 235, 8),
(162, 77, 228, 8),
(163, 77, 217, 8),
(164, 77, 223, 8),
(165, 77, 211, 8),
(166, 77, 238, 8),
(167, 77, 224, 8),
(168, 77, 200, 8),
(169, 77, 198, 8),
(170, 78, 203, 8),
(171, 78, 227, 8),
(172, 78, 205, 8),
(173, 78, 199, 8),
(174, 78, 234, 8),
(175, 78, 238, 8),
(176, 78, 211, 8),
(177, 78, 229, 8),
(178, 78, 213, 8),
(179, 78, 222, 8),
(180, 78, 219, 8),
(181, 79, 226, 8),
(182, 79, 237, 8),
(183, 79, 220, 8),
(184, 79, 200, 8),
(185, 79, 205, 8),
(186, 79, 234, 8),
(187, 79, 219, 8),
(188, 79, 213, 8),
(189, 79, 198, 8),
(190, 79, 229, 8),
(191, 79, 211, 8),
(192, 72, 221, 8),
(193, 72, 201, 8),
(194, 72, 236, 8),
(195, 72, 206, 8),
(196, 72, 217, 8),
(197, 72, 224, 8),
(198, 72, 230, 8),
(199, 72, 211, 8),
(200, 72, 234, 8),
(201, 72, 213, 8),
(202, 72, 198, 8),
(203, 80, 202, 8),
(204, 80, 198, 8),
(205, 80, 216, 8),
(206, 80, 222, 8),
(207, 80, 209, 8),
(208, 80, 229, 8),
(209, 80, 204, 8),
(210, 80, 232, 8),
(211, 80, 214, 8),
(212, 80, 239, 8),
(213, 80, 225, 8),
(214, 81, 230, 8),
(215, 81, 233, 8),
(216, 81, 223, 8),
(217, 81, 213, 8),
(218, 81, 238, 8),
(219, 81, 219, 8),
(220, 81, 196, 8),
(221, 81, 203, 8),
(222, 81, 206, 8),
(223, 81, 227, 8),
(224, 81, 208, 8),
(225, 82, 210, 8),
(226, 82, 228, 8),
(227, 82, 227, 8),
(228, 82, 196, 8),
(229, 82, 206, 8),
(230, 82, 219, 8),
(231, 82, 201, 8),
(232, 82, 220, 8),
(233, 82, 233, 8),
(234, 82, 239, 8),
(235, 82, 213, 8);

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
