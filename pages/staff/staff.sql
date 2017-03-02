-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 14, 2008 at 02:37 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `staff`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `branch`
-- 

CREATE TABLE `branch` (
  `branchID` int(11) NOT NULL auto_increment,
  `branchName` varchar(60) NOT NULL,
  `branchCode` text character set latin1 NOT NULL,
  `branchLocation` varchar(200) NOT NULL,
  `Telephone` text character set latin1 NOT NULL,
  `Fax` text character set latin1 NOT NULL,
  `email` text character set latin1 NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY  (`branchID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- 
-- Dumping data for table `branch`
-- 

INSERT INTO `branch` VALUES (12, 'BRANCH01', '010', 'PHNOM PENH', '85523222222', '85523222221', 'virak', 1);
INSERT INTO `branch` VALUES (13, 'BRANCH02', '020', 'SEIM REAP', '85563222222', '85563222221', 'virak', 1);
INSERT INTO `branch` VALUES (14, 'BRANCH03', '030', 'Kompong Som', '85563333333', '85563333331', 'virak', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `department`
-- 

CREATE TABLE `department` (
  `departmentID` int(11) NOT NULL auto_increment,
  `branchID` int(11) NOT NULL,
  `departmentName` varchar(180) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY  (`departmentID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

-- 
-- Dumping data for table `department`
-- 

INSERT INTO `department` VALUES (30, 12, 'Department02', 1);
INSERT INTO `department` VALUES (29, 12, 'Department01', 1);
INSERT INTO `department` VALUES (31, 13, 'Department01', 1);
INSERT INTO `department` VALUES (32, 14, 'Department01', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `staffinfo`
-- 

CREATE TABLE `staffinfo` (
  `staffID` int(11) NOT NULL auto_increment,
  `branchID` int(11) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `fName` varchar(30) NOT NULL,
  `lName` varchar(40) NOT NULL,
  `sex` varchar(5) NOT NULL,
  `dob` varchar(30) NOT NULL,
  `dobLocation` varchar(200) NOT NULL,
  `position` varchar(50) NOT NULL,
  `section` varchar(30) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` text character set latin1 NOT NULL,
  `email` text character set latin1 NOT NULL,
  `extension` int(11) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `dateJoined` text character set latin1 NOT NULL,
  `jobdescription` longtext character set latin1 NOT NULL,
  `degree` varchar(100) NOT NULL,
  `major` varchar(150) NOT NULL,
  `staffNumber` varchar(20) NOT NULL,
  PRIMARY KEY  (`staffID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

-- 
-- Dumping data for table `staffinfo`
-- 

INSERT INTO `staffinfo` VALUES (50, 14, 32, 'virak2', 'virak2', 'Male', '16/07/2008', 'test', 'Deputy General Manager', 'Business Development', 'test', '5855', 'virak@test.com', 85, '225d423bfa7b004a5e93582622cb437c.jpg', '09/07/2008', '', 'High School', 'Economic', '0555');
INSERT INTO `staffinfo` VALUES (48, 12, 29, 'virak', 'virak', 'Male', '17/07/2008', 'test', 'Officer', 'IT', 'test', '85512491979', 'virak@test.com', 207, 'f113efeae5bed55f1efacb2178f2eefa.jpg', '09/07/2008', '', 'Master', 'Information Technology', '0111');
INSERT INTO `staffinfo` VALUES (49, 13, 31, 'virak1', 'virak1', 'Male', '25/07/2008', 'test', 'Branch Manager', 'Business Development', 'test', '85523666666', 'virak@test.com', 205, 'a6dc0e19b6d8a60ccb19c14b91ad46ed.jpg', '02/07/2008', '', 'Phd', 'Business Administration', '0112');
