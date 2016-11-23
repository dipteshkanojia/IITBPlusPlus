-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2016 at 06:42 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iitbplusplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `Resource`
--

CREATE TABLE `Resource` (
  `resourceId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userStatus` int(11) NOT NULL,
  `resourceType` enum('Lecture','Homework','Assignment') NOT NULL,
  `dateOfCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `resourcePath` varchar(500) NOT NULL,
  `accessRights` enum('R','W') NOT NULL DEFAULT 'W'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class_allocation`
--

CREATE TABLE `tbl_class_allocation` (
  `userID` int(11) NOT NULL DEFAULT '0',
  `classID` varchar(10) NOT NULL DEFAULT '',
  `userStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_class_allocation`
--

INSERT INTO `tbl_class_allocation` (`userID`, `classID`, `userStatus`) VALUES
(16, 'CS224', 1),
(16, 'CS604', 1),
(16, 'CS621', 1),
(16, 'CS699', 1),
(21, 'CS224', 1),
(21, 'CS251', 1),
(21, 'CS333', 1),
(21, 'CS347', 1),
(21, 'CS604', 1),
(21, 'CS621', 1),
(21, 'CS699', 1),
(22, 'CS699', 8),
(22, 'CS780', 8),
(23, 'CS632', 8),
(26, 'CS251', 8),
(26, 'CS740', 8),
(29, 'CS700', 8),
(33, 'CS604', 8),
(34, 'CS252', 8),
(35, 'aa', 8),
(35, 'as12', 8),
(35, 'asd112', 8),
(35, 'CS228', 8),
(38, 'asas', 8),
(38, 'CS743', 8),
(39, 'CS632', 1),
(39, 'CS740', 1),
(39, 'CS801', 1),
(40, 'CS228', 1),
(40, 'CS615', 1),
(40, 'CS620', 1),
(40, 'CS632', 1),
(41, 'CS699', 1),
(41, 'CS740', 1),
(41, 'CS743', 1),
(42, 'CS224', 1),
(42, 'CS604', 1),
(42, 'CS743', 1),
(43, 'CS224', 1),
(43, 'CS347', 1),
(43, 'CS621', 1),
(43, 'CS725', 1),
(49, 'CS699', 9),
(49, 'CS801', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courses`
--

CREATE TABLE `tbl_courses` (
  `courseID` varchar(10) NOT NULL DEFAULT '',
  `courseName` varchar(200) DEFAULT NULL,
  `courseSlot` int(11) NOT NULL,
  `instName` varchar(250) NOT NULL,
  `courseStatus` tinyint(1) NOT NULL DEFAULT '1',
  `startDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `endDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `courseTerm` enum('ODD','EVEN') NOT NULL,
  `courseDescription` varchar(3000) NOT NULL,
  `facultyID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_courses`
--

INSERT INTO `tbl_courses` (`courseID`, `courseName`, `courseSlot`, `instName`, `courseStatus`, `startDate`, `endDate`, `courseTerm`, `courseDescription`, `facultyID`) VALUES
('asas', 'asasas', 1, 'asdasd', 1, '2016-11-29 18:30:00', '2016-12-07 18:30:00', 'ODD', 'sdaasd', 38),
('asd112', 'asd', 1, 'asd', 1, '2016-11-08 18:30:00', '2016-12-02 18:30:00', 'ODD', 'asd', 35),
('CS224', 'Computer Networks', 2, '100', 1, '2016-11-21 08:19:19', '2017-04-20 18:30:00', 'EVEN', 'Internet architecture and the layering abstraction. Application layer: network application architectures and examples. Socket programming. Transport layer: transport protocol design, analysis of TCP. Network layer: addressing, routing, forwarding, interdomain routing. Router design and scheduling. QoS and resource allocation. Traffic engineering, network address translation and other practical topics. Link layer: channel access, switching, VLANs, MPLS. PHY layer basics: framing, encoding, modulation.', 34),
('CS228', 'Logic for Computer Science', 8, '100', 1, '2016-11-06 15:36:04', '2017-04-20 18:30:00', 'EVEN', '1 Propositional logic: 1.1 Declarative sentences 1.2 Natural deduction 1.2. 1 Rules for natural deduction 1.2.2 Derived rules 1.2.3 Provable equivalence 1.3 Propositional logic as a formal language 1.4 Semantics of propositional logic 1.4.1 The meaning of logical connectives 1.4.2 Soundness of propositional logic 1.4 .3 Completeness of propositional logic 1.5 Normal forms 1.5.1 Semantic equivalence, satisfiability, and validity 1.5.2 Conjunctive normal forms and validity 1.5.3 Horn clauses and satisfiability 1.6 SAT solvers 2 Predicate logic 2.1 Predicate log ic as a formal language 2.1.1 Terms 2.1.2 Formulas 2.1.3 Free and bound variables 2.1.4 Substitution 2.2 Proof theory of predicate logic 2.2.1 Natural deduction rules 2.2.2 Quantifier equivalences 2.3 Semantics of predicate logic 2.3.1 Model s 2.3.2 Semantic entailment 2.3.3 The semantics of equality 2.4 Undecidability of predicate logic 2.5 Expressiveness of predicate logic 3 Program correctness 3.1 Notion of program correctness 3.1.1 Hoare triples 3.1.2 Partial and total correctn ess 3.1.3 Program variables and logical variables 3.2 Proof calculus for partial correctness 3.2.1 Proof rules 3.2.2 Proof tableaux 3.3 Proof calculus for total correctness 3.4 Programming by contract 4 Other Applications such as Logic in databas es, Logic programming, Puzzle solving 5 Practice with Verification tools', 35),
('CS251', 'Software Systems', 1, '100', 1, '2016-07-19 18:30:00', '2016-11-03 18:30:00', 'ODD', '1. Vim/emacs HTML, CSS \r\n2. Report and presentation software: latex, beamer, drawing software (e.g. inkscape, xfig, open-office)\r\n 3. IDE (e.g. eclipse, netbeans), code reading, debugging Basic Java Java collections, interfaces\r\n4. Java threads Java GUI Introduction to documentation: e.g. doxygen/javadocs\r\n 5. Version management: SVN/Git \r\n6. Unix basics: shell, file system, permissions, process hierarchy, process monitoring, ssh, rsync \r\n7. Unix tools: e.g. awk, sed, grep, find, head, tail, tar, cut, sort\r\n 8. Bash scripting: I/O redirection, pipes \r\n9. Python programming\r\n10. Makefile, libraries and linking\r\n 11. Graph plotting software (e.g., gnuplot) \r\n12. Profiling tools (e.g., gprof, prof) \r\n13. Optional topics (may be specific to individual students302222 projects): intro to sockets, basic SQL for data storage, JDBC/pygresql A project would be included which touches upon many of the above topics, helping students see the connect across seemingly disparate topics. The project is also expected to be a significant load: 20-30 hours of work.', 26),
('CS252', 'Computer Networks Lab', 5, '100', 1, '2016-11-06 15:36:07', '2017-04-20 18:30:00', 'EVEN', 'Experiments to support study of the Internet protocol stack: (a) Understand the use of various command line tools like ping, arp, route, ifconfig, host, traceroute, dig etc. (b) Use packet sniffing tools like tcpdump, wireshark to understand various concepts: encapsulation/decapsulation; multiplexing demultiplexing, dhcp operation, IP fragmentation, ARP operation, ICMP operation, TCP operation, application protocols such as HTTP, FTP, SMTP. (c) Use ns-2/ns-3 packet simulator to study link layer protocols like sliding window, Ethernet, transport layer protocols like TCP. (d) Use network virtualizing tools like vnx/vnuml to understand concepts of bridging, spanning tree, IP address configuration and forwarding; (e) Understand the basics of socket programming using C/C++/Java.', 34),
('CS333', 'Operating Systems Lab', 5, '100', 1, '2016-07-19 18:30:00', '2016-11-03 18:30:00', 'ODD', 'Experiments for use and appreciation of operating system functions such as process management, inter-process communication, process synchronization, memory management and file systems etc. Exposure to usage of tools towards measuring and monitoring of operating systems related parameters and services. Design and implementation of operating system functionalities.', 27),
('CS347', 'Operating Systems', 6, '100', 1, '2016-11-05 15:37:25', '2016-11-03 18:30:00', 'ODD', 'Overview of operating systems: batch processing, multiprogramming, time-sharing and real time systems. Concurrent processes: communication and synchronisation. Process management, deadlocks. Main memory management: paging, segmentation, sharing of programs and data. Device management. Information management: file system, security. A case study of UNIX.', 27),
('CS604', 'Combinatorics', 4, '100', 1, '2016-11-06 15:36:09', '2017-04-20 18:30:00', 'EVEN', 'Min-max results. Dilworth"s theorem, Hall"s theorem. Menger"s theorem. Topics on tournaments. Perfect graphs. The weak perfect graph theorem. Ramsey theory. Set Systems. Sperner, Erdos-Rado and the Erdos-Ko-Rado theorems. Colex orders and the Kruskal-Katona theorem. The probabilistic method. Some sample applications of the probabilistic method. Second moment method and applications. Matroid theory. The theory of designs. Combinatorics and Algorithm design. The Lovasz-theta function and its use in designing algorithms. ', 33),
('CS615', 'Formal Specification and Verification of Programs', 5, '100', 1, '2016-11-05 15:37:28', '2016-11-03 18:30:00', 'ODD', 'Reasoning about sequential programs: Programs as (possibly infinite) state transition systems; specifying program correctness using pre- and post-conditions; partial and total correctness semantics; Hoare logic and its rules for a simple imperative sequential language; weakest pre-condition and strongest post-condition semantics; central importance of invariants in program verification. Brief introduction to lattices and the theory of abstract interpretation; some numerical abstract domains: intervals, difference bound matrices, octagons, polyhedra; computing abstract post-conditions and abstract loop invariants; refining abstractions and counterexample-guided abstraction refinement Predicate abstraction and boolean programs; converting assertion to a location reachability problem; location reachability using predicate abstraction for simple programs and for programs with (possibly recursive) function calls; discovering predicates using counterexample-guided abstraction refinement Program verification as a constraint solving problem; checking properties of bounded and unbounded executions of programs using constraint solving Shape analysis: use of separation logic and three-valued logic Reasoning about reactive systems: Introduction to temporal logics: LTL and CTL; Kripke structures as models of reactive (hardware and software) systems; LTL and CTL model checking algorithms and some applications ', 30),
('CS620', 'New Trends in Information Technology', 4, '100', 1, '2016-11-05 15:37:30', '2016-11-03 18:30:00', 'ODD', 'Prerequisties : Masters and PhD students: CS641, CS653, CS647, CS614, CS643, CS652 Course content : > Cloud Computing is generating quite a buzz with regards to architecture, design and solutions of distributed systems. This course will aim to introduce, identify and explore the research avenues and implementation issues related to Cloud-based systems. Specifically, the course will involve two parts---(i) extensive paper reading and some lectures for in-class discussions and (ii) a significant hands-on implementation project. From a background perspective there are several facets to cloud computing systems--- instantiation options, virtualization technologies, overheads of virtualization, server consolidation and capacity planning, dynamic resource provisioning, migration and dynamic placement techniques, power-aware provisioning etc. Most ofthis material will be covered and studied using readings based on published papers and in some cases from books. The instructor will introduce a topic and student/instructor talk on the topic will follow. Each topic will be an in-class discussion and will require student inputs (in terms of class participation and submission of reviews etc.). > The hands-on component of the course, aims to expose students to several implementation issues via exercises and a project. Software components of clouds include several Virtualization technologies, on-line cloud providers, cloud resource > management software and cloud simulators. In the first half of the class students will try- out a subset of these options as warm-up exercises to understand deployment and usage related issues. The second half of the course, will involve using a subset of these software resources for project involving some problem-solving and experimenting components. > > The combination of paper readings for background and research topics and implementing and testing a solution, will provide an in-depth view of the issues on the areas of Cloud Computing. > > A list of potential topics that will covered: > â€¢ Overview of Virtualization/Cloud Computing > â€¢ Virtualization Technologies and Architectures > â€¢ Measurement and Profiling of Virtualized-Applications > â€¢ Server Consolidation and Placement Policies > â€¢ Dynamic Provisioning and Resource Management > â€¢ Migration Mechanisms > â€¢ Power management in Virtualized Environments > â€¢ Implications of Resource Affinity and Interference > â€¢ Implementation Examples of Cloud Services ', 29),
('CS621', 'Artificial Intelligence', 9, '100', 1, '2016-11-05 15:37:33', '2016-11-03 18:30:00', 'ODD', 'Prerequisites: Undergraduate Course on Artificial Intelligence Knowledge Representation: The First Order Predicate Logic, Production Systems, Semantic Nets, Frames and Scripts Formalisms. Resolution in Predicate Logic, Unification, Strategies for Resolution by Refutation. Knowledge Acquisition and learning: Learning from examples and analogy, Rote learning, Neural Learning, Integrated Approach. Planning and Robotics: STRIPS, ABSTRIPS, NOAH and MOLGEN planners, preliminary ideas of distributed and real time planning, Subsumption architecture based planning. Expert Systems: fundamental blocks, case studies in various domains, concept of shells, connectionist expert systems. Introduction to Natural Language Understanding: problems of ambiguity, ellipsis and polysemy, lexicalization and parsing, Transition and Augumented Transition networks, Natural Language Interfaces. Introdution to Computer Vision: Edge detection, Point Correspondence and Stereopsis, Surface directions. Basics of Neural Networks: Perceptrons, Feedforward nets Backpropagation algorithm, preliminary understanding of unsupervised learning. ', 28),
('CS632', 'Advanced Database Management Systems', 7, '100', 1, '2016-11-06 15:36:12', '2017-04-20 18:30:00', 'EVEN', 'The course will be based primarily on research papers covering the following topics. Advanced query optimization: Volcano/Cascades framework for query optimization; multi-query optimization, materialized views and view maintenance, index and view selection, database tuning. Adaptive query processing and optimization. Query processing on RDF data. Transaction and query processing on main-memory and columnar databases. Big data management: transaction and query processing on parallel and distributed databases including issues of availability, replication, consistency, concurrency control, and recovery. Other topics, such as: data streams and stream management systems. Information retrieval and databases. Handling uncertain and precise data. Security and privacy. Crowd-sourced databases, applications of declarative querying outside of database applications. ', 23),
('CS699', 'Software Lab', 4, 'CSE', 1, '2016-11-06 15:47:06', '2016-11-30 18:30:00', 'ODD', 'Text Reference	1Online tutorials for HTML/CSS, Inkscape, OODraw2Unix Man Pages for all unix tools, Advanced Bash Scripting Guide from the Linux Documentation Project (www.tldp.org)3The Python Tutorial Online Book (http://docs.python.org/3/tutorial/index.html)4The Java Tutorials (http://docs.oracle.com/javase/tutorial/)5Latex - A document preparation system, Leslie Lamport, 2/e, Addison-Wesley, 1994\nDescription	1.Vim/emacs, HTML, CSS2.Preparing reports and presentations using latex, beamer, drawing software (e.g. inkscape, xfig, open-office), and graph plotting software (e.g., pyplot, gnuplot)3.Programming support: IDE (e.g. eclipse, netbeans), Makefile, debugging tools, profiling tools (e.g. gprof, prof), version management (SVN/Git), code review, 4.Basic Java, Java collections, interfaces5.Unix basics: shell, file system, permissions, process hierarchy, process monitoring, ssh, rsync6.Unix tools: e.g. awk, sed, grep, find, head, tail, tar, cut, sort, Bash scripting: I/O redirection, pipes7.Programming using scripting language (e.g. python)8.Lexical analysis and parsing tools (e.g. lex/yacc, flex/bison)9.Optional topics (may be specific to individual students302222 projects): intro to sockets, basic SQL for data storage, JDBC/pygresql, PHP, mobile appsA project would be included which touches upon many of the above topics, helping students see the connect across seemingly disparate topics. The project is also expected to be a significant load: 20-30 hours of work.', 22),
('CS725', 'Foundations of Machine Learning', 8, 'CSE', 1, '2016-11-06 15:47:40', '2016-11-29 18:30:00', 'ODD', 'Machine Learning basics; Fundamentals of Bayesian Learning etc.', 25),
('CS740', 'Mathematics for Visual Computing', 9, '100', 1, '2016-07-19 18:30:00', '2016-11-03 18:30:00', 'ODD', 'Multivariate Calculus: Functions (multi-variable, vector-valued) and their derivatives, Taylor series, matrix calculus, basic vector calculus 2. Optimization: unconstrained (gradient descent, Newton`s method, Levenberg-Marquardt algorithm, quasi-Newton methods), constrained (equality constraints, Lagrange multipliers) 3. Interpolation and regression: linear, polynomial, Barycentric coordinates 4. Numerical linear algebra: special matrices, matrix decompositions 5. Probability and statistics: distributions, mean, variance, covariance, bounds, likelihood function, Bayes rule, entropy, divergence, mutual information 6. Introductory projective geometry 7. Introductory differential geometry: tangent, normal, curvature 8. Numerical integration of functions and introductory numerical differential equations The implementation-based exercises will rely on C/C++ or Scilab-like intelligent-computing environments. As part of the implementation-based exercises, the students will be introduced to software tools for intelligent computing.', 26),
('CS743', 'Wireless Networks', 12, 'CSE', 1, '2016-12-31 18:30:00', '2017-04-29 18:30:00', 'EVEN', 'Description\r\nIntroduction: Motivation, History, Challenges \r\nPhysical Layer: Modulation Techniques, Antenna, Channel Models, Fading Mitigation techniques; Case-study of 802.11a PHY \r\nLink Layer: Single-hop MAC protocols (CSMA, TDMA, FDMA, OFDMA etc); Case-study of WiFi and Cellular networks; multi-hop MAC protocols \r\nNetwork Layer: Mobile IP; distributed wireless routing algorithms (AODV, DSDV, DSR, OLSR), Routing metrics \r\nTransport Layer: TCP over wireless, Transport level mobility management, multihop transport protocols \r\nApplication Layer: Mobile computing platforms (android); energy efficiency of apps \r\nFuture trends in wireless networks.\r\n \r\nReferences\r\nWireless Communications and Networks, by W. Stallings, Pearson education publishing, 2nd edition, 2009. \r\nWireless Communications: Principles and Practice by Theodore S. Rappaport, 2nd edition, Pearson, 2010. \r\nWireless Communications, by Andrea Goldsmith, 2010. \r\nRecent relevant RFCs, Internet drafts, selected research papers from relevant venues: Mobicom, MobiSys, SIGCOMM, Infocom, IEEE TMC, ACM MC2R.', 38),
('CS780', 'SOFT COMPUTING', 10, '100', 1, '2017-01-08 18:30:00', '2017-04-27 18:30:00', 'EVEN', 'KJDHSALKFNDSSXZN\r\nJSFNDSK.MDS', 22),
('CS801', 'Seminar', 0, 'CSE', 1, '2016-11-06 15:47:25', '2016-11-10 18:30:00', 'ODD', 'Seminar presentation; Literature Survey on a selected topic', 29);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE `tbl_post` (
  `postId` int(11) NOT NULL,
  `postType` enum('Q','N','I') NOT NULL DEFAULT 'N',
  `dateOfPost` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `receiver` enum('C','I','T') NOT NULL DEFAULT 'C',
  `emailTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postSummary` varchar(250) NOT NULL,
  `postContent` varchar(3000) NOT NULL,
  `replyTo` int(11) DEFAULT NULL,
  `senderId` int(11) NOT NULL,
  `senderVisibility` enum('Y','N') NOT NULL DEFAULT 'Y',
  `media` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`postId`, `postType`, `dateOfPost`, `receiver`, `emailTime`, `postSummary`, `postContent`, `replyTo`, `senderId`, `senderVisibility`, `media`) VALUES
(1, 'Q', '2016-11-20 14:14:29', 'C', '2016-11-20 14:14:29', 'Deadline Extension for submission of assignment', 'Dear Teacher , Requesting you to give some more time for this assignment as it needs more time for data collection and processing', 8, 21, 'Y', 'NULL'),
(2, 'Q', '2016-11-20 14:34:28', 'C', '2016-11-20 14:34:28', 'Date of cribs for examination', 'Dear Teacher, what is the time slot allocated for our batch for cribs of mid sem. Kindly reply for the same', 1, 16, 'Y', 'NULL'),
(3, 'Q', '2016-11-20 14:35:59', 'C', '2016-11-20 14:35:59', 'Review of grades ', 'Dear TA, I have submitted all files but given feedback for incomplete submission. Please can you mention about files to be submitted? ', 8, 21, 'Y', 'NULL'),
(4, 'Q', '2016-11-20 14:44:57', 'C', '2016-11-20 14:44:57', 'Syllabus for Examination', 'What is the syllabus for coming exam and are we allowed to get cheat sheets for the same?', 1, 21, 'Y', 'NULL'),
(5, 'Q', '2016-11-20 14:46:42', 'C', '2016-11-20 14:46:42', 'Assignment not graded', 'My assignment-2 is not graded. Please look into  it.', 2, 21, 'Y', 'NULL'),
(6, 'Q', '2016-11-20 14:48:42', 'C', '2016-11-20 14:48:42', 'Grades not given', 'sdfsfd\nsdfsd', 0, 21, 'Y', 'NULL'),
(7, 'Q', '2016-11-20 14:51:37', 'C', '2016-11-20 14:51:37', 'à¤¸à¤¸à¥à¤¦', 'à¤…à¤¸à¥à¤¦à¤¸à¥à¤¦\nà¤…à¤¸à¥à¤¦à¥à¤¸', 0, 21, 'Y', 'NULL'),
(8, 'Q', '2016-11-20 14:52:16', 'C', '2016-11-20 14:52:16', 'Group formation for CS699', 'All students have to form group of two to work upon cs699 project. Topics will listed soon. The deadline is 20 November 2016', 0, 22, 'Y', 'NULL'),
(9, 'Q', '2016-11-21 06:16:27', 'C', '2016-11-21 06:16:27', 'Group Formation', 'All are expected to form group of three for course project and the list is to be submitted to TA by friday', 0, 21, 'Y', 'NULL'),
(10, 'Q', '2016-11-21 06:25:33', 'C', '2016-11-21 06:25:33', 'Naya wala post', 'Naya post dala', 0, 21, 'Y', 'NULL'),
(11, 'Q', '2016-11-21 15:32:44', 'C', '2016-11-21 15:32:44', 'Hello', 'My name is Diptesh, and I am taking CS347 this semester/', 0, 21, 'Y', 'NULL'),
(12, 'Q', '2016-11-21 15:33:01', 'C', '2016-11-21 15:33:01', 'RE: Hello', 'I am Manasi. Hi!', 11, 16, 'Y', 'NULL'),
(13, 'Q', '2016-11-21 15:44:09', 'C', '2016-11-21 15:44:09', 'RE: Hello', 'Are we really doing this course!?', 11, 21, 'Y', 'NULL'),
(15, 'Q', '2016-11-21 18:42:44', 'C', '2016-11-21 18:42:44', 'Thread about Assignment 6', 'Assignment 6', 0, 21, 'Y', 'NULL'),
(16, 'Q', '2016-11-21 18:42:59', 'C', '2016-11-21 18:42:59', 'Topic Formal', 'Very Formal Question ?', 0, 21, 'Y', 'NULL'),
(17, 'Q', '2016-11-21 18:44:50', 'C', '2016-11-21 18:44:50', 'Another Thing about something', 'Yeah It was neended', 0, 21, 'Y', 'NULL'),
(38, 'Q', '2016-11-21 20:12:02', 'C', '2016-11-21 20:12:02', 'RE: Date of cribs for examination', 'Date has not been declared!', 2, 21, 'Y', 'NULL'),
(39, 'Q', '2016-11-21 20:13:02', 'C', '2016-11-21 20:13:02', 'RE: Syllabus for Examination', 'Everything taught!', 4, 21, 'Y', 'NULL'),
(40, 'Q', '2016-11-21 21:20:45', 'C', '2016-11-21 21:20:45', 'ABCD Question', 'New Thread post data', 0, 21, 'Y', 'NULL'),
(41, 'Q', '2016-11-21 22:56:41', 'C', '2016-11-21 22:56:41', 'RE: Another Thing about something', 'sss', 17, 21, 'Y', 'NULL'),
(42, 'Q', '2016-11-21 22:57:55', 'C', '2016-11-21 22:57:55', 'RE: RE: Another Thing about something', 'ggggg', 41, 21, 'Y', 'NULL'),
(43, 'Q', '2016-11-21 23:01:25', 'C', '2016-11-21 23:01:25', 'A brand new Thread!', 'Yo!', 0, 21, 'Y', 'NULL'),
(44, 'Q', '2016-11-22 00:18:04', 'C', '2016-11-22 00:18:04', 'First Attachment', 'File PDF containing CSS Cheat Sheet.', 0, 21, 'Y', 'uploads/44-css_cheat_sheet.pdf'),
(45, 'Q', '2016-11-22 00:47:39', 'C', '2016-11-22 00:47:39', 'RE: Another Thing about something', 'yo File upload kar!', 17, 21, 'Y', 'NULL'),
(46, 'Q', '2016-11-22 00:48:17', 'C', '2016-11-22 00:48:17', 'RE: RE: Another Thing about something', 'ek aur file', 41, 21, 'Y', 'NULL'),
(47, 'N', '2016-11-22 00:56:47', 'C', '2016-11-22 00:56:47', 'dd', 'asdasd', 0, 21, 'Y', 'NULL'),
(48, 'Q', '2016-11-22 00:59:00', 'C', '2016-11-22 00:59:00', 'RE: First Attachment', 'lol file le lo', 44, 21, 'Y', 'NULL'),
(52, 'Q', '2016-11-22 01:41:03', 'C', '2016-11-22 01:41:03', 'RE: dd', 'blah', 47, 21, 'Y', 'uploads/52-fwunixref.pdf'),
(53, 'Q', '2016-11-22 01:55:52', 'C', '2016-11-22 01:55:52', 'RE: RE: Hello', 'Use this cheet sheet for end sem!', 13, 21, 'N', 'uploads/53-HTML5_Canvas_Cheat_Sheet.pdf'),
(54, 'Q', '2016-11-22 01:58:58', 'C', '2016-11-22 01:58:58', 'RE: RE: Hello', 'Hello, I am Rushikesh, your instructor for the semester.', 12, 22, 'Y', 'NULL'),
(57, 'Q', '2016-11-22 02:23:57', 'C', '2016-11-22 02:23:57', 'RE: RE: RE: Hello', 'I also wanted to cheeet, but I do not know how to spell cheeet. ', 53, 21, 'N', 'NULL'),
(59, 'Q', '2016-11-22 02:25:48', 'C', '2016-11-22 02:25:48', 'RE: RE: RE: Hello', 'I know how to spell cheit it is written like this = cheit.', 53, 21, 'N', 'NULL'),
(60, 'Q', '2016-11-22 02:27:22', 'C', '2016-11-22 02:27:22', 'RE: RE: RE: Hello', 'I wiil catch you!', 53, 21, 'N', 'NULL'),
(61, 'Q', '2016-11-22 02:28:06', 'C', '2016-11-22 02:28:06', 'RE: RE: Hello', 'Faculty will catch you! do not be anonymous and post.', 13, 21, 'Y', 'NULL'),
(62, 'Q', '2016-11-22 02:29:02', 'C', '2016-11-22 02:29:02', 'RE: Group formation for CS699', 'We have formed a group\r\n\r\n154054002 - Diptesh\r\n154050011 - Manasi', 8, 21, 'Y', 'NULL'),
(63, 'Q', '2016-11-22 02:32:19', 'C', '2016-11-22 02:32:19', 'RE: Group formation for CS699', 'We have also formed group, but we do not tell names\r\n\r\nXYZ Guy - YZ Roll Number\r\nXXX Guy - XXX Roll\r\n\r\nYo!', 8, 21, 'Y', 'NULL'),
(70, 'Q', '2016-11-22 04:49:25', 'C', '2016-11-22 04:49:25', 'A brand new Thread!', 'sdfsd', 0, 21, 'Y', 'uploads/70-css_cheat_sheet.pdf'),
(71, 'Q', '2016-11-22 04:51:58', 'C', '2016-11-22 04:51:58', 'Another New Thread for CS224', 'Message for attachement, and some Description', 0, 21, 'Y', 'uploads/71-HTML5-Mega-Cheat-Sheet-A4-Print-ready.pdf'),
(72, 'Q', '2016-11-22 04:52:41', 'C', '2016-11-22 04:52:41', 'A Thread without attachement!', 'Yo! text as description, no attachment.', 0, 21, 'N', 'NULL'),
(73, 'Q', '2016-11-22 05:21:22', 'C', '2016-11-22 05:21:22', 'submission due for assignment5', 'submit by 10nov 2016', 0, 26, 'Y', 'NULL'),
(74, 'Q', '2016-11-22 05:22:44', 'C', '2016-11-22 05:22:44', 'dsfsf', 'dsfdsgfsdgsg', 0, 26, 'Y', 'NULL'),
(75, 'Q', '2016-11-22 05:48:27', 'C', '2016-11-22 05:48:27', 'What is the weightage for  every element of course', 'Please tell us weightage of every exam, assignment and homework of this course', 0, 16, 'Y', 'NULL'),
(76, 'Q', '2016-11-22 05:49:20', 'C', '2016-11-22 05:49:20', 'hi welcome to course cs604', 'i welcome all students for this course', 0, 16, 'Y', 'NULL'),
(77, 'Q', '2016-11-22 05:51:39', 'C', '2016-11-22 05:51:39', 'RE: hi welcome to course cs604', 'Hi ,\r\nAre you TA or a student?', 76, 16, 'N', 'NULL'),
(78, 'N', '2016-11-22 05:53:09', 'C', '2016-11-22 05:53:09', 'RE: RE: hi welcome to course cs604', 'I am student and CR for  this course', 77, 16, 'Y', 'NULL'),
(79, 'N', '2016-11-22 06:01:18', 'C', '2016-11-22 06:01:18', 'Welcome to system software', 'hello welcome to this course', 0, 26, 'Y', 'NULL'),
(80, 'N', '2016-11-22 09:26:49', 'C', '2016-11-22 09:26:49', '[Software Lab] Final Submission', 'Final Submission on 22nd November, 2016. The project should be uploaded by 24th November, 2016.', 0, 49, 'Y', 'NULL'),
(81, 'Q', '2016-11-22 09:28:55', 'C', '2016-11-22 09:28:55', 'RE: [Software Lab] Final Submission', 'xyz', 80, 49, 'Y', 'NULL'),
(82, 'Q', '2016-11-22 09:30:00', 'C', '2016-11-22 09:30:00', 'RE: [Software Lab] Final Submission', 'xyz', 80, 49, 'Y', 'NULL'),
(83, 'Q', '2016-11-22 09:30:06', 'C', '2016-11-22 09:30:06', 'RE: [Software Lab] Final Submission', 'xyz', 80, 49, 'Y', 'NULL'),
(84, 'Q', '2016-11-22 09:30:18', 'C', '2016-11-22 09:30:18', 'RE: RE: [Software Lab] Final Submission', 'asd', 83, 49, 'Y', 'NULL'),
(85, 'Q', '2016-11-22 09:30:54', 'C', '2016-11-22 09:30:54', 'RE: RE: [Software Lab] Final Submission', 'asd', 83, 49, 'Y', 'NULL'),
(86, 'Q', '2016-11-22 09:31:08', 'C', '2016-11-22 09:31:08', 'RE: RE: [Software Lab] Final Submission', 'asd', 83, 49, 'Y', 'NULL'),
(87, 'Q', '2016-11-22 12:32:47', 'C', '2016-11-22 12:32:47', 'à¤®à¥ˆ à¤†à¤ª à¤¸à¤¬à¤•à¤¾ à¤‡à¤¸ à¤•à¥‹à¤°à¥à¤¸ à¤®à¥‡à¤‚ à¤¸à¥à¤µà¤¾à¤—à¤¤ à¤•à¤°à¤¤à¥€ à¤¹à¥‚à¥¤    ', 'à¤®à¥ˆ à¤†à¤ª à¤¸à¤¬à¤•à¤¾ à¤‡à¤¸ à¤•à¥‹à¤°à¥à¤¸ à¤®à¥‡à¤‚ à¤¸à¥à¤µà¤¾à¤—à¤¤ à¤•à¤°à¤¤à¥€ à¤¹à¥‚à¥¤    ', 0, 16, 'Y', 'NULL'),
(88, 'Q', '2016-11-22 12:34:19', 'C', '2016-11-22 12:34:19', 'RE: à¤®à¥ˆ à¤†à¤ª à¤¸à¤¬à¤•à¤¾ à¤‡à¤¸ à¤•à¥‹à¤°à¥à¤¸ à¤®à¥‡à¤‚ à¤¸à¥à¤µà¤¾à¤—à¤¤ à¤•à¤°à¤¤à¥€ à¤¹à¥‚à¥¤    ', 'à¤§à¤¨à¥à¤¯à¤µà¤¾à¤¦à¥¤  à¤†à¤ªà¤•à¤¾ à¤­à¥€ à¤¹à¤¾à¤°à¥à¤¦à¤¿à¤• à¤…à¤­à¤¿à¤¨à¤¨à¥à¤¦à¤¨ à¤à¤µà¤‚ à¤¸à¥à¤µà¤¾à¤—à¤¤ à¤¹à¥ˆà¥¤  ', 87, 21, 'Y', 'NULL');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule_meeting`
--

CREATE TABLE `tbl_schedule_meeting` (
  `studentUserID` int(11) NOT NULL,
  `facultyUserID` int(11) NOT NULL,
  `meetingDate` varchar(255) DEFAULT NULL,
  `meetingTime` varchar(255) DEFAULT NULL,
  `about` varchar(500) CHARACTER SET utf32 DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_schedule_meeting`
--

INSERT INTO `tbl_schedule_meeting` (`studentUserID`, `facultyUserID`, `meetingDate`, `meetingTime`, `about`, `approved`) VALUES
(16, 24, '2016/11/24', '1:00pm', 'to see answer paper', 0),
(21, 22, '2016/11/03', '4PM', 'SL Exam', 1),
(21, 24, '2016/11/11', '4 pm', 'Requesting Seminar Topic', 0),
(21, 25, '2016/11/10', '430', '', 0),
(21, 29, '2016/11/04', 'sdf', 'sdfsd', -1),
(49, 22, '2016/11/16', '3PM', 'SL Exam', -1),
(49, 24, '2016/11/30', '4PM', 'APS', 1),
(49, 26, '2016/11/18', '10', 'Monash', 0),
(49, 27, '2016/11/09', '5PM', 'PhD Topic', 0),
(49, 29, '2016/11/30', '4PM', 'APS', 0),
(49, 30, '2016/11/05', '5PM', 'About PhD Topic', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thread`
--

CREATE TABLE `tbl_thread` (
  `threadId` int(11) NOT NULL,
  `courseID` varchar(10) NOT NULL,
  `postId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_thread`
--

INSERT INTO `tbl_thread` (`threadId`, `courseID`, `postId`) VALUES
(1, 'CS347', 7),
(2, 'CS347', 8),
(3, 'CS224', 9),
(4, 'CS224', 10),
(5, 'CS347', 11),
(7, 'CS224', 15),
(8, 'CS224', 16),
(9, 'CS224', 17),
(21, 'CS347', 40),
(22, 'CS224', 43),
(23, 'CS224', 44),
(24, 'CS224', 47),
(27, 'CS224', 70),
(28, 'CS224', 71),
(29, 'CS224', 72),
(30, 'CS251', 73),
(31, 'CS740', 74),
(32, 'CS604', 75),
(33, 'CS604', 76),
(34, 'CS251', 79),
(35, 'CS699', 80),
(36, 'CS604', 87);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userID` int(11) NOT NULL,
  `instID` varchar(15) DEFAULT NULL,
  `userName` varchar(100) NOT NULL,
  `fullName` varchar(250) DEFAULT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `instName` varchar(250) DEFAULT NULL,
  `userStatus` int(11) NOT NULL DEFAULT '0',
  `joiningDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tokenCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userID`, `instID`, `userName`, `fullName`, `userEmail`, `userPass`, `instName`, `userStatus`, `joiningDate`, `tokenCode`) VALUES
(14, 'P13273', 'meghna', 'Meghna Kanojia', 'mohan.meghnasingh@gmail.com', 'ef5d369314eb5b845bd6f520a2eaee68', 'CSE', 1, NULL, 'b6e6aab791f8ce942c143b34a0f9dbbb'),
(15, '12002020', 'aadi', 'Aditya Joshi', 'aditya.m.joshi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'IITB', 1, NULL, 'a00a467437679d33822eb91b396f347b'),
(16, '154050011', 'manasi', 'Manasi Kulkarni', 'manasi@cse.iitb.ac.in', '24b30ddfe6f27c51809dbe622fe4013d', 'IITB', 1, NULL, '6554a025c6b15f50a9cf29b768f79c52'),
(21, '154054002', 'diptesh', 'Diptesh', 'dipteshkanojia@gmail.com', '74589f769f2012d098e0314826b1bda8', 'CSE', 1, '2016-10-25 06:47:47', '6449888c265578676e1fcf0af40e4f4c'),
(22, 'I99232', 'rkj', 'Rushikesh Joshi', 'rkj@iitbplusplus.com', 'a220136e96960204f37fd8ede077f464', 'IITB', 8, '2016-10-25 12:04:32', 'fdd6859dadc56ae7931acee85c1f0886'),
(23, 'I98233', 'sudarshan', 'S. Sudarshan', 'sudharshan@iitbplus.com', 'c80cb0ee08ece5a31d2a5d49ace77097', 'IITB', 8, '2016-10-25 12:10:25', 'edc49de8317bfdaf3ba4230a7c8bebc1'),
(24, 'I92939', 'pb', 'Pushpak B', 'kdrulezz@gmail.com', '5aa1c2f33f106c1966af371fc7a31d69', 'IITB', 8, '2016-10-25 12:17:26', '2adb2d0a7721427f18dd6caa2531cf12'),
(25, 'I20230', 'ganesh', 'Ganesh Ramakrishnan', 'ganesh@cseblah.com', '277a094bea5311135bd7abd73d28a01d', 'CSE', 8, '2016-11-05 10:20:33', '27ef8f6b747aea9637a968220984bebc'),
(26, 'I90123', 'sharat', 'Sharat Chandran', 'sharat@iitbplus.com', '67b563bb0675eaef718e18128d93b1a1', 'IITB', 8, '2016-11-05 10:42:27', 'cdda56b9cd1bc4a93394724bc8b23f51'),
(27, 'I90124', 'mythili', 'Mythili Vutukuru', 'mythili@iitbplus.com', 'b852e8d09f836f9e0ba01736ccf2434a', '100', 8, '2016-11-05 10:52:59', '1e18620b9b13f3e872c894962e525ce7'),
(28, 'I90125', 'sivakumar', 'Sivakumar G', 'sivakumar@iitbplus.com', '95873400258a5179f5cb36ae664f1ef7', '100', 8, '2016-11-05 10:54:04', '3b9f580cbfe1f0fe4a04623865360728'),
(29, 'I90126', 'krithi', 'Krithi Ramamritham', 'krithi@iitbplus.com', '216727647e3eee288d3332903b34e4f4', '100', 8, '2016-11-05 10:54:48', '2cf67694ced6b1c651a054a92c60d017'),
(30, 'I90127', 'supratik', 'Supratik Chakraborty', 'supratik@iitbplus.com', '69366d76262ffc17eb7fb07e2c8e57a4', '100', 8, '2016-11-05 10:57:30', '2bfc3cab5269383dfbd1aa2040c0ed1d'),
(31, 'I90128', 'ajit', 'Ajit Rajwade', 'ajit@iitbplus.com', '5681b94cac00fc4f9267988a8163be57', '100', 8, '2016-11-05 10:58:11', '58588b358e18fbd9e61fd2e244208b62'),
(33, 'i90130', 'sundar', 'Sundar Vishwanathan', 'sundar@iitbplus.com', '345e2cdf665a448de8d1cdaedd4f21fe', '100', 8, '2016-11-05 11:02:15', 'eea343723801e5b089b751433aa7bd21'),
(34, 'i90131', 'varsha', 'Varsha Apte', 'varsha@iitbplus.com', 'da5cc2e4ea12660ffd090b38c678b25c', '100', 8, '2016-11-05 11:03:34', 'e1cd611587a55a98dedc3a57fbf95106'),
(35, 'i90132', 'krishna', 'Krishna S', 'krishna@iitbplus.com', '8854b47fc05990266cc6df7f69d1adeb', '100', 8, '2016-11-05 11:04:17', '402985096c8f4d58f11c40a232f757a2'),
(38, 'I90133', 'bhaskaran', 'Bhaskaram Raman', 'bhaskaran@iitbplus.com', '666733fc3771bda4a8437b7644793ae5', 'IITB', 8, '2016-11-05 17:25:11', '66191e248f7b06d5db5d759da9e533b5'),
(39, '154050010', 'tamali', 'Tamali B', 'tamali@iitbplus.com', 'e2b7e33ffc398df53e449654c0673d56', '100', 1, '2016-11-06 06:47:58', 'c07df5c1bfd4f81e7784e7ac2b365895'),
(40, '154050008', 'sparsha', 'Sparsha R', 'sparsha@iitbplus.com', '5139a38d4b21218921930fded068e13c', '100', 1, '2016-11-06 06:48:47', 'efe32d54fc38afd9eb80a87b6efc9988'),
(41, '154050003', 'rahul', 'Rahul B', 'rahul@iitbplus.com', '2acb7811397a5c3bea8cba57b0388b79', '100', 1, '2016-11-06 06:49:33', 'fa864b158c0af5d1455ca7a7cc1ff6ed'),
(42, '154050012', 'radhika', 'Radhika B', 'radhika@iitbplus.com', '521bb553ed0bd3a9a561c197bc654809', '100', 1, '2016-11-06 06:52:03', '9603c6dbc998b1504a9f370efa1beb9b'),
(43, '154050006', 'abhiram', 'Abhiram S', 'abhiram@iitbplus.com', 'a44f1fc0597b51dba659349568ec80fe', '100', 1, '2016-11-06 06:55:45', '8ee4ae640b86d524a645814d5f13f93b'),
(44, '153050082', 'annie', 'Annie R', 'annie@iitbplus.com', '67f55304a74162f81fc9bde55e60a710', '100', 1, '2016-11-06 06:57:01', '8505f29662e03a72c2cec74912e43dba'),
(45, '163050093', 'sejal', 'Sejal Patel', 'sejal@iitbplus.com', '2f61e0d1d0bbc149ed7327ad1f318e62', '100', 1, '2016-11-06 07:05:44', '415b394367af4aaefca29fce15adbdec'),
(46, '163050041', 'sakshi', 'Sakshi Maskara', 'sakshi@iitbplus.com', 'b73a3203047396075ccac51f92358f6e', '100', 1, '2016-11-06 07:06:28', '1d3ca0ca54e3c07e215904443c304fa4'),
(47, '163050052', 'akash', 'Akash K', 'akash@iitbplus.com', 'cb7c5f69ff356ecca55b7d08df877991', '100', 1, '2016-11-06 07:07:16', 'c83384552edd16dad54b61a53848910e'),
(48, '163050050', 'ajay', 'Ajay gupta', 'ajay@iitbplus.com', '0fe90ff7501094dbbd19de2855384add', '100', 1, '2016-11-06 07:08:08', '262477e9dff8bc53981ee4a88c99880d'),
(49, '1', 'sysad', 'Systems Administrator', 'sysad@iitbplus.com', '74589f769f2012d098e0314826b1bda8', 'IITB', 9, '2016-11-08 11:47:37', '46d81fd1242e7ec05be5aab0cea511ac');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userSettings`
--

CREATE TABLE `tbl_userSettings` (
  `userId` int(11) NOT NULL,
  `courseId` varchar(10) NOT NULL,
  `emailId` varchar(100) NOT NULL,
  `emailSendTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `profilePhoto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Resource`
--
ALTER TABLE `Resource`
  ADD PRIMARY KEY (`resourceId`,`userId`);

--
-- Indexes for table `tbl_class_allocation`
--
ALTER TABLE `tbl_class_allocation`
  ADD PRIMARY KEY (`userID`,`classID`);

--
-- Indexes for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`postId`);

--
-- Indexes for table `tbl_schedule_meeting`
--
ALTER TABLE `tbl_schedule_meeting`
  ADD PRIMARY KEY (`studentUserID`,`facultyUserID`);

--
-- Indexes for table `tbl_thread`
--
ALTER TABLE `tbl_thread`
  ADD PRIMARY KEY (`threadId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`),
  ADD UNIQUE KEY `instID` (`instID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `tbl_thread`
--
ALTER TABLE `tbl_thread`
  MODIFY `threadId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
