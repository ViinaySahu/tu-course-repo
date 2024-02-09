-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 11:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_course_repo`
--
CREATE DATABASE IF NOT EXISTS `new_course_repo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `new_course_repo`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` varchar(250) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `OTP` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `password`, `OTP`) VALUES
('admin1234@test.com', '$2y$10$Oc15uLSrgMZh5kKe4sk0xerd4GLILXvfjo7CX1VdJq4KEqIbTmBSi', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `complete_syllabus_view`
-- (See below for the actual view)
--
CREATE TABLE `complete_syllabus_view` (
`syllabus_id` int(11)
,`version_number` int(11)
,`effective_date` date
,`approved_by` varchar(250)
,`approval_num` varchar(250)
,`course_id` int(11)
,`course_code` varchar(10)
,`course_name` varchar(255)
,`corequisite` varchar(255)
,`l` int(11)
,`t` int(11)
,`p` int(11)
,`abstract` text
,`curr_syllabus_id` int(10)
,`department_id` int(11)
,`course_content` text
,`course_outcome` text
,`lw_num` int(11)
,`lab_work_description` text
,`rb_name` varchar(250)
,`rb_author` varchar(250)
,`rb_press` varchar(250)
,`tb_name` varchar(250)
,`tb_author` varchar(250)
,`tb_press` varchar(250)
);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `corequisite` varchar(255) DEFAULT NULL,
  `l` int(11) DEFAULT NULL,
  `t` int(11) DEFAULT NULL,
  `p` int(11) DEFAULT NULL,
  `abstract` text DEFAULT NULL,
  `curr_syllabus_id` int(10) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_code`, `course_name`, `corequisite`, `l`, `t`, `p`, `abstract`, `curr_syllabus_id`, `department_id`) VALUES
(1, 'CO103', 'Introductory Computing ', '', 2, 1, 0, '', NULL, 1),
(2, 'CS405', 'Discrete Mathematics ', '', 2, 1, 0, '', NULL, 1),
(3, 'CS416', 'OO programming & Data Structures Lab.', 'CS412 Data Structures ', 0, 1, 1, '', NULL, 1),
(4, 'CS413', 'Database Management Systems', '', 3, 0, 0, '', NULL, 1),
(5, 'CS407', 'Introductory Computing ', '', 2, 1, 0, '', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_contents`
--

CREATE TABLE `course_contents` (
  `id` int(11) NOT NULL,
  `syllabus_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_contents`
--

INSERT INTO `course_contents` (`id`, `syllabus_id`, `description`) VALUES
(3, 1, 'Computer Fundamentals: History, Generations, Classification of Computers; Organization of a Computer; Concept of Programming and Programming Languages.'),
(4, 1, 'Introduction to Programming: Concept of Algorithm, Flow Chart, Pseudocode, Illustrative problem-solving Examples.'),
(5, 1, 'Features of a Programming Language: Character Set, Identifiers, Keywords, Data Types, Variables, Declarations, Operators & Expressions;'),
(6, 1, 'Statements: Assignment, Input/Output; Flow Control- Conditionals and Branching; Iteration; Functions, Function Types, Scope Rule; Recursion;'),
(7, 1, 'Arrays, Pointers, Structures. (A programming language like C/C++ shall be used as a basis language. The same language is to be used for the laboratory).'),
(8, 2, 'Set. Relation and functions: \r\n- Set, relations, equivalence relations; mappings-one-one and on to ; \r\n- Definition of an algebraic structure; \r\n- Introduction to groups, subgroups, normal subgroups, isomorphism, homeomorphism; \r\nautomorphism of groups; semigroups, monoids, rings, vector space.'),
(9, 2, 'Logic: \r\n- Logic operators, Truth table, Normal forms \r\n- Theory of inference and deduction. \r\n- Mathematical induction. \r\n- Predicate calculus; predicates and quantifiers. \r\n- Boolean algebra. \r\n- Lattice. \r\n'),
(10, 2, 'Combinatorics: \r\n- Basic counting techniques. \r\n- Recurrence relations and their solutions. \r\n- Generating functions. \r\n'),
(11, 2, 'Modular Arithmetic: \r\n- Congruence modulo, Fermat s Theorem, Euler s Theorem, Multiplicative Inverse, \r\nReminder Theorem, FFT, Discrete Logarithm. '),
(12, 3, ' Introduction to Object-oriented programming using C++\r\nObject, Class, Encapsulation, Abstraction, Inheritance, Polymorphism, Inheritance, Operator:\r\noverloading, Generic programming concept using template '),
(13, 3, 'Programming Laboratory using Data Structures:\r\nProgramming assignments on the implementations of data structures – list, stack, queues, trees, \r\nsets, graph and their applications, Implementations of various sorting and searching techniques.'),
(14, 4, 'Introduction & Overview: Concept of database, Characteristics of database, Advantages, data \r\nindependence, redundancy Control; Database architecture - ANSI model.'),
(15, 4, 'Modelling of real-world situation (data models): ER model, EER model'),
(16, 4, 'Relational data model: relational model concepts, relational algebra and calculus, SQL, ER/EER \r\nto relational model mapping,'),
(17, 4, 'Functional dependencies and normalization: functional dependencies, normal forms, \r\ndecomposition, multi-valued functional dependency, and higher normal forms '),
(18, 4, 'Database Indexing and hashing: B-Tree, B+ Tree, static and dynamic hashing'),
(19, 4, 'Database Transaction concepts, query evaluation overview, security, and recovery'),
(20, 4, 'Distributed Database \r\nBrief introduction to emerging database applications (like Hadoop, NoSQL etc.)'),
(21, 5, 'asdff');

-- --------------------------------------------------------

--
-- Table structure for table `course_outcomes`
--

CREATE TABLE `course_outcomes` (
  `id` int(11) NOT NULL,
  `syllabus_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_outcomes`
--

INSERT INTO `course_outcomes` (`id`, `syllabus_id`, `description`) VALUES
(1, 1, 'Formulate program requirements. '),
(2, 1, 'Develop efficient algorithm for solving real life problem.'),
(3, 1, 'Implement the algorithm using C programming language. '),
(4, 1, 'Build sets of test data to validate the correctness of the program.'),
(5, 2, 'Get sound understanding of the concepts of mathematical logic, sets, relations, recurrence relations, functions, graphs, trees.'),
(6, 2, 'Ability to construct and verify the correctness of mathematical arguments.'),
(7, 2, 'Ability to solve problems involving recurrence relations and generating functions. '),
(8, 2, 'Get sound grip on the operations on discrete structures such as sets, functions, relations.'),
(9, 2, 'Ability to use graphs and trees as problem solving tools '),
(15, 3, 'Understand different programming paradigms, their advantages and disadvantages. '),
(16, 3, 'Understanding of the basic OO principles and their application in the design and implementation of different OO computing solutions. '),
(17, 3, 'Write C++ programs by choosing appropriate data structures to solve a problem.'),
(18, 3, 'Master the standard data structure library of C++ programming language'),
(19, 3, 'Develop skills in implementations and applications of data structures and different sorting and searching techniques.'),
(20, 4, 'Clear understanding of the concepts of database systems, their advantages, and applications.'),
(21, 4, 'Ability to carry out the conceptual modelling of the data for a given application.'),
(22, 4, 'Ability to evaluate functional dependencies in the data and model the data in a suitable normal form for a relational database.'),
(23, 4, 'Ability to carry out the database design using appropriate database model and to write optimized queries.'),
(24, 4, 'Familiarity with the database modelling techniques for emerging application areas'),
(25, 5, 'to gain understanding of fundamental of introductory computing');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_alias` varchar(50) DEFAULT NULL,
  `department_name` varchar(100) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_alias`, `department_name`, `school_id`) VALUES
(1, 'CSE', 'Computer Science and Engineering', 1),
(2, 'CVL', 'Civil Engineering', 1),
(3, 'ECE', 'Electrical Engineering', 1),
(4, 'ENE', 'Energy', 1),
(5, 'FET', 'Food Engineering & Technology', 1),
(6, 'MEC', 'Mechanical Engineering', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lab_work`
--

CREATE TABLE `lab_work` (
  `id` int(11) NOT NULL,
  `syllabus_id` int(11) DEFAULT NULL,
  `lw_num` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table`
--

CREATE TABLE `pdf_table` (
  `pdf_id` int(11) NOT NULL,
  `pdf_data` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `program_alias` varchar(50) DEFAULT NULL,
  `program_name` varchar(100) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `Min_duration` varchar(10) DEFAULT NULL,
  `Max_duration` varchar(10) DEFAULT NULL,
  `Intro_year` date DEFAULT NULL,
  `Credit_req` int(10) DEFAULT NULL,
  `Max_intake` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `program_alias`, `program_name`, `department_id`, `Min_duration`, `Max_duration`, `Intro_year`, `Credit_req`, `Max_intake`) VALUES
(6, 'CSM', 'Master of Computer Application', 1, '2 Year', '4 Year', '1996-01-01', 75, 80),
(7, 'CSB', 'B.Tech. in Computer Science & Engineering', 1, '4 Year', '6 Year', '2014-06-05', 160, 60),
(8, 'CSE', 'M.Tech. in Computer Science', 1, '2 Year', '4 Year', '2019-06-05', 68, 18),
(9, 'CSI', 'M.Tech. in Information Technology', 1, '2 Year', '4 Year', '1997-06-05', 68, 28),
(10, 'CSP', 'Ph.D.(Computer Science & Engineering)', 1, '2 Year', '8 Year', '1996-06-05', 100, 25);

-- --------------------------------------------------------

--
-- Table structure for table `reference_books`
--

CREATE TABLE `reference_books` (
  `id` int(11) NOT NULL,
  `syllabus_id` int(11) DEFAULT NULL,
  `rb_name` varchar(250) DEFAULT NULL,
  `rb_author` varchar(250) DEFAULT NULL,
  `rb_press` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reference_books`
--

INSERT INTO `reference_books` (`id`, `syllabus_id`, `rb_name`, `rb_author`, `rb_press`) VALUES
(1, 1, 'The Elements of Programming Style', 'Kerningham', 'B. W'),
(2, 1, 'Techniques of Program Structures and Design', 'Yourdon', 'E'),
(3, 1, 'Theory and Problems of Computers and Programming', 'Schied', 'F. S'),
(4, 1, 'The C Programming Language', 'Kerningham & Ritchie', 'E'),
(5, 1, 'Introduction to Discrete Mathematics.', 'Liu, C. L', 'McGraw Hill Education (India) PrivateLimited (2008) '),
(6, 1, 'Discrete Mathematical Structures', 'Trembley, Manohar', 'McGraw Hill Education (India) Private Limited (2 February 2001) '),
(7, 4, 'Database Management Systems, 3rd Edition', 'Raghu Ramakrishnan, Johannes Gehrke', 'McGraw Hill, 2014'),
(8, 4, 'An Introduction to Database Systems, 8th Edition', 'C.J, Pearson', ''),
(9, 4, 'Fundamentals of Database Systems', 'Leon & Leon', 'Tata McGraw Hil, 2008'),
(10, 4, 'SQL & NoSQL Databases', 'Meier, Andreas and Kaufmann, Michael', 'Springer 2019'),
(11, 4, 'Getting Started with NoSQL', 'Gaurav Vaish', 'Packt Publishing, March 2013');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `school_id` int(11) NOT NULL,
  `school_alias` varchar(50) DEFAULT NULL,
  `school_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`school_id`, `school_alias`, `school_name`) VALUES
(1, 'SOE', 'School of Engineering'),
(2, 'SOM', 'Management Sciences'),
(3, 'SOS', 'Science'),
(4, 'HSS', 'Humanities & Social Sciences');

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `syllabus_id` int(11) NOT NULL,
  `version_number` int(11) NOT NULL,
  `effective_date` date NOT NULL,
  `approved_by` varchar(250) DEFAULT NULL,
  `approval_num` varchar(250) DEFAULT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`syllabus_id`, `version_number`, `effective_date`, `approved_by`, `approval_num`, `course_id`) VALUES
(1, 1, '2018-06-12', 'IITG', '2023/12/18/445', 1),
(2, 1, '2002-06-19', 'Two Faculties from IIT', '2002/12/18/445', 2),
(3, 1, '2012-06-20', 'Two Faculties', '2002/12/18/446', 3),
(4, 1, '2017-06-14', 'Faculties from DU', '2002/12/18/459', 4),
(5, 1, '2020-06-10', 'Two Faculties', '2002/12/18/445', 5);

-- --------------------------------------------------------

--
-- Table structure for table `textbooks`
--

CREATE TABLE `textbooks` (
  `id` int(11) NOT NULL,
  `syllabus_id` int(11) DEFAULT NULL,
  `tb_name` varchar(250) DEFAULT NULL,
  `tb_author` varchar(250) DEFAULT NULL,
  `tb_press` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `textbooks`
--

INSERT INTO `textbooks` (`id`, `syllabus_id`, `tb_name`, `tb_author`, `tb_press`) VALUES
(1, 1, 'Programming in C', 'Balaguruswamy', 'V'),
(2, 1, 'Let us C', 'Kanetkar Y', 'V'),
(3, 1, 'Programming in C', 'Gotfreid', 'McGrawHill'),
(4, 1, 'Fundamentals of Computers', 'Rajaram', 'V'),
(5, 2, ' Discrete Mathematics and Its Applications', 'Kenneth H. Rosen', 'Mcgraw-Hill College; 6th edition (January 5, 2006)'),
(6, 3, 'Data Structures, Algorithms and Applications in C++ (2nd Edition)', 'Satraj Sahni', 'University Press'),
(7, 3, 'C++ PrimerPai G A V, “Data Structures and Algorithms: Concepts,  Techniques and Applications', 'Lipman', ' 2ndEdn, Tata McGraw-Hill, 2008'),
(8, 4, 'Fundamentals of Database Systems, Sixth(2011)/Seventh(2017)Edition', 'ELMASRI and  NAVATHE, Pearson', ''),
(9, 4, 'Database Systems Concepts, Sixth (2010)/Seventh(2019) Edition', 'A. SILBERSCHATZ,  H. F. KORTH, S SUDARSHAN', 'McGraw Hill');

-- --------------------------------------------------------

--
-- Structure for view `complete_syllabus_view`
--
DROP TABLE IF EXISTS `complete_syllabus_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `complete_syllabus_view`  AS SELECT `s`.`syllabus_id` AS `syllabus_id`, `s`.`version_number` AS `version_number`, `s`.`effective_date` AS `effective_date`, `s`.`approved_by` AS `approved_by`, `s`.`approval_num` AS `approval_num`, `s`.`course_id` AS `course_id`, `c`.`course_code` AS `course_code`, `c`.`course_name` AS `course_name`, `c`.`corequisite` AS `corequisite`, `c`.`l` AS `l`, `c`.`t` AS `t`, `c`.`p` AS `p`, `c`.`abstract` AS `abstract`, `c`.`curr_syllabus_id` AS `curr_syllabus_id`, `c`.`department_id` AS `department_id`, `cc`.`description` AS `course_content`, `co`.`description` AS `course_outcome`, `lb`.`lw_num` AS `lw_num`, `lb`.`description` AS `lab_work_description`, `rb`.`rb_name` AS `rb_name`, `rb`.`rb_author` AS `rb_author`, `rb`.`rb_press` AS `rb_press`, `tb`.`tb_name` AS `tb_name`, `tb`.`tb_author` AS `tb_author`, `tb`.`tb_press` AS `tb_press` FROM ((((((`syllabus` `s` join `course` `c` on(`s`.`course_id` = `c`.`course_id`)) left join `course_contents` `cc` on(`s`.`syllabus_id` = `cc`.`syllabus_id`)) left join `course_outcomes` `co` on(`s`.`syllabus_id` = `co`.`syllabus_id`)) left join `lab_work` `lb` on(`s`.`syllabus_id` = `lb`.`syllabus_id`)) left join `reference_books` `rb` on(`s`.`syllabus_id` = `rb`.`syllabus_id`)) left join `textbooks` `tb` on(`s`.`syllabus_id` = `tb`.`syllabus_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_code` (`course_code`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `course_contents`
--
ALTER TABLE `course_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `syllabus_id` (`syllabus_id`);

--
-- Indexes for table `course_outcomes`
--
ALTER TABLE `course_outcomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `syllabus_id` (`syllabus_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `lab_work`
--
ALTER TABLE `lab_work`
  ADD PRIMARY KEY (`id`),
  ADD KEY `syllabus_id` (`syllabus_id`);

--
-- Indexes for table `pdf_table`
--
ALTER TABLE `pdf_table`
  ADD PRIMARY KEY (`pdf_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`program_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `reference_books`
--
ALTER TABLE `reference_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `syllabus_id` (`syllabus_id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD PRIMARY KEY (`syllabus_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `textbooks`
--
ALTER TABLE `textbooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `syllabus_id` (`syllabus_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_contents`
--
ALTER TABLE `course_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `course_outcomes`
--
ALTER TABLE `course_outcomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lab_work`
--
ALTER TABLE `lab_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pdf_table`
--
ALTER TABLE `pdf_table`
  MODIFY `pdf_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reference_books`
--
ALTER TABLE `reference_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `syllabus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `textbooks`
--
ALTER TABLE `textbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `course_contents`
--
ALTER TABLE `course_contents`
  ADD CONSTRAINT `course_contents_ibfk_1` FOREIGN KEY (`syllabus_id`) REFERENCES `syllabus` (`syllabus_id`);

--
-- Constraints for table `course_outcomes`
--
ALTER TABLE `course_outcomes`
  ADD CONSTRAINT `course_outcomes_ibfk_1` FOREIGN KEY (`syllabus_id`) REFERENCES `syllabus` (`syllabus_id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`school_id`);

--
-- Constraints for table `lab_work`
--
ALTER TABLE `lab_work`
  ADD CONSTRAINT `lab_work_ibfk_1` FOREIGN KEY (`syllabus_id`) REFERENCES `syllabus` (`syllabus_id`);

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `program_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `reference_books`
--
ALTER TABLE `reference_books`
  ADD CONSTRAINT `reference_books_ibfk_1` FOREIGN KEY (`syllabus_id`) REFERENCES `syllabus` (`syllabus_id`);

--
-- Constraints for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD CONSTRAINT `syllabus_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `textbooks`
--
ALTER TABLE `textbooks`
  ADD CONSTRAINT `textbooks_ibfk_1` FOREIGN KEY (`syllabus_id`) REFERENCES `syllabus` (`syllabus_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
