-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2016 at 06:35 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_tis`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(5) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(50) NOT NULL,
  `student_last_name` VARCHAR(50) NOT NULL ,
  `student_status` enum('Y','N') NOT NULL DEFAULT 'N' ,
  `student_email` varchar(50) NOT NULL,
  `student_pass` varchar(100) NOT NULL,
  `tokenCode` varchar(100) NOT NULL,
    
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `student_email` (`student_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `teacher_id` int(5) NOT NULL AUTO_INCREMENT,
  `teacher_name` varchar(50) NOT NULL,
  `teacher_last_name` VARCHAR(50) NOT NULL ,
  `teacher_email` varchar(50) NOT NULL,
  `teacher_pass` varchar(255) NOT NULL,
    
  PRIMARY KEY (`teacher_id`),
  UNIQUE KEY `teacher_email` (`teacher_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(5) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(25) NOT NULL,
  `subject_description` VARCHAR(100) NOT NULL ,
    
  PRIMARY KEY (`subject_id`),
  UNIQUE KEY `subject_name` (`subject_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


--
-- Table structure for table `exams`
--
CREATE TABLE IF NOT EXISTS `exams` (
  `exam_id` int(5) NOT NULL AUTO_INCREMENT,
  `exam_name` varchar(25) NOT NULL,
  `exam_description` VARCHAR(100) NOT NULL ,
  `exam_status` VARCHAR(20) NOT NULL ,
  `subject_id` int(5) NOT NULL ,
    
  PRIMARY KEY (`exam_id`),
  UNIQUE KEY `exam_name` (`exam_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Table structure for table `student_subject`
--
CREATE TABLE IF NOT EXISTS `student_subject` (
  `relation_id` int(5) NOT NULL AUTO_INCREMENT,
  `student_id` int(5) NOT NULL,
  `subject_id` int(5) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'N' , 

  PRIMARY KEY (`relation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `student_last_name`, `student_status`, `student_email`, `student_pass`) VALUES
(1, 'juan', 'pinto', 'Y', 'juan.pinto@gmail.com', '202cb962ac59075b964b07152d234b70');

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `teacher_name`, `teacher_last_name`, `teacher_email`, `teacher_pass`) VALUES
(1, 'pedro', 'murillo', 'pedro.murillo@gmail.com', '202cb962ac59075b964b07152d234b70');


--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`, `subject_description`) VALUES
(1, 'quimica', 'quimica es una materia importante que bla bla bla');


--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`exam_id`, `exam_name`, `exam_description`, `exam_status`, `subject_id`) VALUES
(1, 'primer parcial', 'el primer parcial sera el 30 porciento de la nota total', 0, 1);







/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
