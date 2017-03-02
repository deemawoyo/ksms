--
--Table structure for `class`
--

DROP IF EXISTS TABLE `class`
CREATE TABLE IF NOT EXISTS `class` (
  `id` varchar(25) NOT NULL COMMENT 'Students I.D Number or Birth Entry Number',
  `form` int(1) NOT NULL COMMENT 'Current Form',
  `class` varchar(25) NOT NULL COMMENT 'Class name i.e (A,B,C,D or North,South etc)',
  `year` year(4) NOT NULL COMMENT 'Current year',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Manages School classes' AUTO_INCREMENT=;

--
--Finished table backup `class`
--

INSERT INTO `class` VALUES('bdh-11894-96', '1', 'A', '2006');
INSERT INTO `class` VALUES('bdh-11894-94', '1', 'A', '2006');

-- --------------------------------------------------------

--
--Table structure for `class_list`
--

DROP IF EXISTS TABLE `class_list`
CREATE TABLE IF NOT EXISTS `class_list` (
  `form` int(11) NOT NULL COMMENT 'Form (1 - 6)',
  `class` varchar(25) NOT NULL COMMENT 'Class Name e.g A, B or North. Only used for quick enumeration '
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='List of Classes that are available for a certain form' AUTO_INCREMENT=;

--
--Finished table backup `class_list`
--

INSERT INTO `class_list` VALUES('1', 'A');
INSERT INTO `class_list` VALUES('1', 'B');
INSERT INTO `class_list` VALUES('1', 'C');
INSERT INTO `class_list` VALUES('1', 'D');
INSERT INTO `class_list` VALUES('6', 'Arts');
INSERT INTO `class_list` VALUES('6', 'Sciences');
INSERT INTO `class_list` VALUES('6', 'Commercials');
INSERT INTO `class_list` VALUES('2', 'A');
INSERT INTO `class_list` VALUES('2', 'B');
INSERT INTO `class_list` VALUES('2', 'C');
INSERT INTO `class_list` VALUES('2', 'D');
INSERT INTO `class_list` VALUES('3', 'A');
INSERT INTO `class_list` VALUES('3', 'B');
INSERT INTO `class_list` VALUES('3', 'C');
INSERT INTO `class_list` VALUES('3', 'D');
INSERT INTO `class_list` VALUES('4', 'A');
INSERT INTO `class_list` VALUES('4', 'B');
INSERT INTO `class_list` VALUES('4', 'C');
INSERT INTO `class_list` VALUES('4', 'D');
INSERT INTO `class_list` VALUES('5', 'Arts');
INSERT INTO `class_list` VALUES('5', 'Commercials');
INSERT INTO `class_list` VALUES('5', 'Sciences');

-- --------------------------------------------------------

--
--Table structure for `config`
--

DROP IF EXISTS TABLE `config`
CREATE TABLE IF NOT EXISTS `config` (
  `id` varchar(100) NOT NULL COMMENT 'name of config to return',
  `value` text NOT NULL COMMENT 'Value of config',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Store the database configuration' AUTO_INCREMENT=;

--
--Finished table backup `config`
--


-- --------------------------------------------------------

--
--Table structure for `contact`
--

DROP IF EXISTS TABLE `contact`
CREATE TABLE IF NOT EXISTS `contact` (
  `id` varchar(25) NOT NULL COMMENT 'Students I.D Number or Birth Entry Number',
  `address` text NOT NULL COMMENT 'Home address',
  `phone` varchar(255) NOT NULL COMMENT 'Home phone number',
  `contact_address` text NOT NULL COMMENT 'Other contact address',
  `contact_phone` varchar(255) NOT NULL COMMENT 'Other contact phone number',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Student Contact details' AUTO_INCREMENT=;

--
--Finished table backup `contact`
--

INSERT INTO `contact` VALUES('bdh-11894-96', '18 Frome Avenue Thorngrove Bulawayo Zimbabwe', '0772760326', 'Somewhere upper thorngrove bulawayo zimbabwe', 'Namuzi');

-- --------------------------------------------------------

--
--Table structure for `enroll_info_form1`
--

DROP IF EXISTS TABLE `enroll_info_form1`
CREATE TABLE IF NOT EXISTS `enroll_info_form1` (
  `id` varchar(25) NOT NULL COMMENT 'Students I.D Number or Birth Entry Number',
  `total_units` int(2) NOT NULL COMMENT 'Total Units attained',
  `maths_units` int(2) NOT NULL COMMENT 'Maths units attained',
  `english_units` int(2) NOT NULL COMMENT 'English Units Attained',
  `content_units` int(2) NOT NULL COMMENT 'General Paper units attained',
  `language_units` int(2) NOT NULL COMMENT 'Language units attained',
  `primary_school` text NOT NULL COMMENT 'Primary School attended',
  `ed12_number` varchar(255) NOT NULL COMMENT 'ED12 Number used for enrollment',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Stores a student''s form 1 enrollment information' AUTO_INCREMENT=;

--
--Finished table backup `enroll_info_form1`
--


-- --------------------------------------------------------

--
--Table structure for `payment`
--

DROP IF EXISTS TABLE `payment`
CREATE TABLE IF NOT EXISTS `payment` (
  `id` varchar(25) NOT NULL COMMENT 'Students I.D Number or Birth Entry Number',
  `type` int(2) NOT NULL COMMENT 'The type which the payment was issued for i.e 1=levy, refer to table paymentlist',
  `amount` float NOT NULL COMMENT 'Amount paid',
  `receipt` varchar(100) NOT NULL COMMENT 'Receipt number',
  `for_year` year(4) NOT NULL COMMENT 'Year the payment was issued for',
  `for_term` int(1) NOT NULL COMMENT 'Term payment was issued for',
  `date_paid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date the payment was received'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Student Payment record' AUTO_INCREMENT=;

--
--Finished table backup `payment`
--

INSERT INTO `payment` VALUES('bdh-11894-96', '7', '50.5', 'ddddddddddd', '2012', '1', '2013-12-05 17:05:15');
INSERT INTO `payment` VALUES('bdh-11894-96', '9', '50', '89899', '2012', '2', '2013-12-05 17:18:22');
INSERT INTO `payment` VALUES('bdh-11894-96', '10', '20', '89889', '2012', '2', '2013-12-05 17:20:23');
INSERT INTO `payment` VALUES('bdh-11894-96', '1', '20', '8uiuj', '2012', '1', '2013-12-05 17:22:17');
INSERT INTO `payment` VALUES('bdh-11894-94', '7', '50.5', '909898', '2012', '1', '2013-12-05 17:28:28');
INSERT INTO `payment` VALUES('bdh-11894-94', '9', '50', '9090', '2012', '2', '2013-12-05 17:30:19');
INSERT INTO `payment` VALUES('bdh-11894-94', '10', '20', '89099', '2012', '2', '2013-12-05 17:31:42');
INSERT INTO `payment` VALUES('bdh-11894-94', '1', '20', 'io90oi', '2012', '1', '2013-12-05 17:32:29');
INSERT INTO `payment` VALUES('bdh-11894-96', '12', '1', 'hghghgh', '2013', '3', '2013-12-05 18:04:17');
INSERT INTO `payment` VALUES('bdh-11894-94', '11', '200', 'nnnnnnnn', '2013', '2', '2013-12-05 18:11:37');
INSERT INTO `payment` VALUES('bdh-11894-94', '12', '200', '90ioo0', '2013', '3', '2013-12-07 08:38:52');

-- --------------------------------------------------------

--
--Table structure for `payment_list`
--

DROP IF EXISTS TABLE `payment_list`
CREATE TABLE IF NOT EXISTS `payment_list` (
  `type` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Payment type id',
  `name` varchar(255) NOT NULL COMMENT 'Visible name for end user. e.g Levy',
  `amount` float NOT NULL COMMENT 'Total amount that should be paid by ever student',
  `for_year` year(4) NOT NULL COMMENT 'Year the payment is for',
  `for_term` int(1) NOT NULL COMMENT 'Term the payment is for',
  PRIMARY KEY (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='Cpntains a referencelist of all the payments a student must ' AUTO_INCREMENT=13;

--
--Finished table backup `payment_list`
--

INSERT INTO `payment_list` VALUES('1', 'Levy', '20', '2012', '1');
INSERT INTO `payment_list` VALUES('7', 'School Fees', '50.5', '2012', '1');
INSERT INTO `payment_list` VALUES('9', 'School Fees', '50', '2012', '2');
INSERT INTO `payment_list` VALUES('10', 'Levy', '20', '2012', '2');
INSERT INTO `payment_list` VALUES('11', 'Bus Fees', '200', '2013', '2');
INSERT INTO `payment_list` VALUES('12', 'Civies Day', '1', '2013', '3');

-- --------------------------------------------------------

--
--Table structure for `student`
--

DROP IF EXISTS TABLE `student`
CREATE TABLE IF NOT EXISTS `student` (
  `id` varchar(25) NOT NULL COMMENT 'Students I.D Number or Birth Entry Number',
  `firstname` varchar(100) NOT NULL COMMENT 'firstname',
  `middlename` varchar(100) NOT NULL COMMENT 'middlename',
  `lastname` varchar(100) NOT NULL COMMENT 'last name(surname)',
  `gender` char(1) NOT NULL COMMENT 'Gender(m or F)',
  `dob` date NOT NULL COMMENT 'Date of Birth',
  `year_enrolled` int(4) NOT NULL COMMENT 'Year the student was enrolled',
  `term_enrolled` int(1) NOT NULL COMMENT 'Term in which the student was enrolled',
  `is_transferred` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Hast the student transferred ?',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Baisc student records info' AUTO_INCREMENT=;

--
--Finished table backup `student`
--

INSERT INTO `student` VALUES('bdh-11894-96', 'Tracey', '', 'Mawoyo', 'F', '1992-03-05', '2006', '1', '0');
INSERT INTO `student` VALUES('bdh-11894-94', 'Delight', '', 'Mawoyo', 'F', '1995-11-27', '2010', '1', '0');

-- --------------------------------------------------------

