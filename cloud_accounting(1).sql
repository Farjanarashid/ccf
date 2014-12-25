-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2014 at 02:43 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cloud_accounting`
--
CREATE DATABASE IF NOT EXISTS `cloud_accounting` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cloud_accounting`;

-- --------------------------------------------------------

--
-- Table structure for table `accountgroup`
--

CREATE TABLE IF NOT EXISTS `accountgroup` (
  `accountGroupId` int(50) NOT NULL,
  `accountGroupName` varchar(200) DEFAULT NULL,
  `groupUnder` varchar(200) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `defaultOrNot` tinyint(1) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  UNIQUE KEY `companyId_accountGroupId` (`accountGroupId`,`companyId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accountgroup`
--

INSERT INTO `accountgroup` (`accountGroupId`, `accountGroupName`, `groupUnder`, `description`, `defaultOrNot`, `companyId`) VALUES
(1, 'Primary', '1', NULL, 1, 1),
(1, 'Primary', '1', 'For Co.2', 1, 2),
(2, 'Liability', '1', NULL, 1, 1),
(2, 'Liability', '1', 'For Co.2', 1, 2),
(3, 'Asset', '1', NULL, 1, 1),
(3, 'Asset', '1', 'For Co.2', 1, 2),
(4, 'Income', '1', NULL, 1, 1),
(4, 'Income', '1', 'For Co.2', 1, 2),
(5, 'Expense', '1', NULL, 1, 1),
(5, 'Expense', '1', 'For Co.2', 1, 2),
(6, 'Current Asset', '3', NULL, 1, 1),
(6, 'Current Asset', '3', 'For Co.2', 1, 2),
(7, 'Account Payable', '14', '', 1, 1),
(7, 'Account Payable', '14', 'For Co.2', 1, 2),
(8, 'Account Receivable', '6', NULL, 1, 1),
(8, 'Account Receivable', '6', 'For Co.2', 1, 2),
(9, 'Bank Account', '6', NULL, 1, 1),
(9, 'Bank Account', '6', 'For Co.2', 1, 2),
(10, 'Capital Account', '2', NULL, 1, 1),
(10, 'Capital Account', '2', 'For Co.2', 1, 2),
(11, 'Cash In Hand', '6', NULL, 1, 1),
(11, 'Cash In Hand', '6', 'For Co.2', 1, 2),
(12, 'Chits or Funds', '6', NULL, 1, 1),
(12, 'Chits or Funds', '6', 'For Co.2', 1, 2),
(13, 'Farmer', '6', NULL, 1, 1),
(13, 'Farmer', '6', 'For Co.2', 1, 2),
(14, 'Current Liability', '2', NULL, 1, 1),
(14, 'Current Liability', '2', 'For Co.2', 1, 2),
(16, 'Direct Expense', '5', NULL, 1, 1),
(16, 'Direct Expense', '5', 'For Co.2', 1, 2),
(17, 'Direct Income', '4', NULL, 1, 1),
(17, 'Direct Income', '4', 'For Co.2', 1, 2),
(18, 'Duties & Tax', '14', NULL, 1, 1),
(18, 'Duties & Tax', '14', 'For Co.2', 1, 2),
(19, 'Fixed Asset', '3', NULL, 1, 1),
(19, 'Fixed Asset', '3', 'For Co.2', 1, 2),
(20, 'Indirect Expense', '5', NULL, 1, 1),
(20, 'Indirect Expense', '5', 'For Co.2', 1, 2),
(21, 'Indirect Income', '4', NULL, 1, 1),
(21, 'Indirect Income', '4', 'For Co.2', 1, 2),
(22, 'Investment', '3', NULL, 1, 1),
(22, 'Investment', '3', 'For Co.2', 1, 2),
(23, 'Loans & liability', '2', NULL, 1, 1),
(23, 'Loans & liability', '2', 'For Co.2', 1, 2),
(24, 'Miscellaneous Expense', '5', NULL, 1, 1),
(24, 'Miscellaneous Expense', '5', 'For Co.2', 1, 2),
(25, 'Purchase Account', '5', NULL, 1, 1),
(25, 'Purchase Account', '5', 'For Co.2', 1, 2),
(26, 'Sales Account', '4', NULL, 1, 1),
(26, 'Sales Account', '4', 'For Co.2', 1, 2),
(27, 'Supplier', '14', NULL, 1, 1),
(27, 'Supplier', '14', 'For Co.2', 1, 2),
(28, 'Customer', '6', NULL, 1, 1),
(28, 'Customer', '6', 'For Co.2', 1, 2),
(29, 'Service', '4', NULL, 1, 1),
(29, 'Service', '4', 'For Co.2', 1, 2),
(30, 'Employee', '20', NULL, 1, 1),
(30, 'Employee', '20', 'For Co.2', 1, 2),
(31, 'Insurance Sale', '3', NULL, 1, 1),
(31, 'Insurance Sale', '3', 'For Co.2', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `accountledger`
--

CREATE TABLE IF NOT EXISTS `accountledger` (
  `ledgerId` int(50) NOT NULL AUTO_INCREMENT,
  `acccountLedgerName` varchar(250) DEFAULT NULL,
  `accountGroupId` varchar(50) NOT NULL,
  `openingBalance` decimal(18,2) DEFAULT NULL,
  `debitOrCredit` tinyint(1) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `defaultOrNot` tinyint(1) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `phoneNo` varchar(250) DEFAULT NULL,
  `emailId` varchar(250) DEFAULT NULL,
  `creditPeriod` int(11) DEFAULT NULL,
  `billByBill` tinyint(1) DEFAULT NULL,
  `mobileNo` varchar(250) DEFAULT NULL,
  `fax` varchar(250) DEFAULT NULL,
  `tin` varchar(250) DEFAULT NULL,
  `cst` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  UNIQUE KEY `companyId_ledgerId` (`ledgerId`,`companyId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `accountledger`
--

INSERT INTO `accountledger` (`ledgerId`, `acccountLedgerName`, `accountGroupId`, `openingBalance`, `debitOrCredit`, `description`, `defaultOrNot`, `address`, `phoneNo`, `emailId`, `creditPeriod`, `billByBill`, `mobileNo`, `fax`, `tin`, `cst`, `companyId`) VALUES
(1, 'Purchase Account', '25', '0.00', 1, NULL, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1),
(1, 'Purchase Account', '25', '0.00', 1, 'For Co.2', 1, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 2),
(2, 'Cash Account', '11', '500000.00', 1, NULL, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1),
(2, 'Cash Account', '11', '0.00', 1, 'For Co.2', 1, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 2),
(3, 'Sales Account', '26', '0.00', 1, NULL, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1),
(3, 'Sales Account', '26', '0.00', 1, 'For Co.2', 1, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 2),
(4, 'Credit card Bank charge', '20', '0.00', 1, NULL, 1, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1),
(4, 'Credit card Bank charge', '20', '0.00', 1, 'For Co.2', 1, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 2),
(51, 'Customer-1', '28', '75000.00', 1, 'Test Customer-1 with Opening Balance 75,000 Tk.', 0, 'House# 20, Road# 15, Adabar, Shyamoli, Dhaka', '', 'customer1@gmail.com', NULL, 1, '0171123456', NULL, NULL, NULL, 1),
(52, 'Customer-2', '28', '0.00', 1, 'Test Customer-2 with zero Opening Balance', 0, '32, Green Road, Dhaka', '', 'customer2@gmail.com', NULL, 1, '01846523143', NULL, NULL, NULL, 1),
(53, 'Customer-3', '28', '0.00', 0, 'Test Customer-3 with null information', 0, '', '', '', NULL, 1, '', NULL, NULL, NULL, 1),
(54, 'Customer-4', '28', '0.00', 1, 'Test Customer-4 with Phone number', 0, '82, Bijoy Sharoni', '0264545619', 'customer4@gmail.com', NULL, 1, '0194761346', NULL, NULL, NULL, 1),
(55, 'Supplier-1', '27', '0.00', 1, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1),
(56, 'Supplier-2', '27', '0.00', 1, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1),
(57, 'Supplier-3', '27', '12570.00', 0, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1),
(58, 'Farmer-1', '13', '0.00', 1, '', 0, '', '', '', 0, 1, '', '', '', '', 1),
(59, 'Farmer-2', '13', '7000.00', 1, '', 0, '', '', '', 0, 1, '', '', '', '', 1),
(60, 'Farmer-3', '13', '8500.00', 1, '', 0, 'Mymansing', '', '', 0, 1, '0167435646', '', '', '', 1),
(62, 'Co.2-Supplier-1', '27', '0.00', 1, 'For Co.2', 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 2),
(63, 'Co.2-Supplier-2', '27', '1200.00', 0, 'For Co.2', 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 2),
(64, 'Co2-Customer-1', '28', '0.00', 1, 'For Co.2', 0, '', '', '', NULL, 1, '', NULL, NULL, NULL, 2),
(65, 'Co.2-Customer-2', '28', '0.00', 1, 'For Co.2', 0, '', '', '', NULL, 1, '', NULL, NULL, NULL, 2),
(66, 'customer-5', '28', '111.00', 0, '', 0, 'dhaka', '', '', NULL, 1, '', NULL, NULL, NULL, 1),
(68, 'customer-7', '28', '0.00', 1, '', 0, '', '', '', NULL, 1, '', NULL, NULL, NULL, 1),
(70, 'customer-10', '28', '0.00', 1, '', 0, '', '', '', NULL, 1, '', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `companyId` int(50) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `pincode` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `drugLicense` varchar(50) DEFAULT NULL,
  `tinNumber` varchar(50) DEFAULT NULL,
  `cstNumber` varchar(50) DEFAULT NULL,
  `currency` varchar(50) DEFAULT NULL,
  `currentDate` datetime DEFAULT NULL,
  `logo` blob,
  PRIMARY KEY (`companyId`),
  UNIQUE KEY `companyName` (`companyName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyId`, `companyName`, `address`, `country`, `state`, `city`, `pincode`, `fax`, `email`, `website`, `drugLicense`, `tinNumber`, `cstNumber`, `currency`, `currentDate`, `logo`) VALUES
(1, 'Confidence Chick & Feed', 'Mohammod Mia Complex, Anam Nahar, Sandwip, Chittagong.', 'Bangladesh', NULL, 'Chittagong', '1300', NULL, 'confidence.sandwipbd@gmail.com', '', NULL, NULL, NULL, 'BDT', '2014-01-20 00:27:19', NULL),
(2, 'Hauqe Foods', 'Mohammadpur', 'Bangladesh', NULL, 'Dhaka', '1207', NULL, 'info@hauqefood.com', NULL, 'BDS-58414', '56416546513231', NULL, 'BDT', '2014-11-28 02:56:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companypath`
--

CREATE TABLE IF NOT EXISTS `companypath` (
  `companyId` int(50) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(250) NOT NULL,
  `path` varchar(250) DEFAULT NULL,
  `defaultOrNot` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`companyId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contradetails`
--

CREATE TABLE IF NOT EXISTS `contradetails` (
  `contraDetailsId` int(50) NOT NULL AUTO_INCREMENT,
  `contraMasterId` varchar(50) DEFAULT NULL,
  `ledgerId` varchar(50) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `chequeNo` varchar(250) DEFAULT NULL,
  `chequeDate` datetime DEFAULT NULL,
  `extraDate` datetime DEFAULT NULL,
  `extra1` varchar(250) DEFAULT NULL,
  `extra2` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`contraDetailsId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contramaster`
--

CREATE TABLE IF NOT EXISTS `contramaster` (
  `contraMasterId` int(50) NOT NULL AUTO_INCREMENT,
  `voucherNo` varchar(50) DEFAULT NULL,
  `suffixPrefixId` varchar(50) DEFAULT NULL,
  `contraNo` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `ledgerId` varchar(50) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  `narration` varchar(250) DEFAULT NULL,
  `optional` tinyint(1) DEFAULT NULL,
  `userId` varchar(50) DEFAULT NULL,
  `branchId` varchar(50) DEFAULT NULL,
  `extraDate` datetime DEFAULT NULL,
  `extra1` varchar(250) DEFAULT NULL,
  `extra2` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`contraMasterId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) NOT NULL,
  `country_code` varchar(15) NOT NULL,
  `currency` varchar(15) NOT NULL,
  `currency_rate` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `country_code`, `currency`, `currency_rate`) VALUES
(4, 'Bangladesh', '880', 'BDT', '78'),
(3, 'India', '91', 'INR', '60'),
(2, 'Pakistan', '92', 'PKR', '99'),
(1, 'Canada', '1', 'CAD', '1'),
(6, 'Afghanistan', '93', 'AFA', '58'),
(7, 'Albania', '355', 'ALL', '104'),
(8, 'Australia', '61', 'AUD', '1'),
(9, 'Austria', '43', 'ATS', '10'),
(10, 'Belgium', '32', 'BEF', '29'),
(11, 'Bermuda', '1441', 'BMD', '1'),
(12, 'Bhutan', '975', 'BTN', '60'),
(13, 'Brazil', '55', 'BRL', '2'),
(14, 'Cambodia', '855', 'KHR', '4060'),
(15, 'Chile', '56', 'CLP', '549'),
(16, 'China', '86', 'CNY', '6'),
(17, 'Egypt', '20', 'EGP', '7'),
(18, 'Finland', '358', 'EUR', '1'),
(19, 'France', '33', 'FRF', '5'),
(20, 'Germany', '49', 'DEM', '2'),
(21, 'Ghana', '233', 'GHS', '3'),
(22, 'Greece', '30', 'GRD', '248'),
(23, 'Greenland', '299', 'DKK', '6'),
(24, 'Hong Kong', '852', 'HKD', '8'),
(25, 'Indonesia', '62', 'IDR', '11534'),
(26, 'Iran', '98', 'IRR', '25574'),
(27, 'Iraq', '964', 'IQD', '1167'),
(28, 'Ireland', '353', 'EUR', '1'),
(29, 'Italy', '39', 'ITL', '1410'),
(30, 'Japan', '81', 'JPY', '102'),
(31, 'Libya', '218', 'LYD', '2'),
(32, 'Malaysia', '60', 'MYR', '3'),
(33, 'Maldives', '960', 'MVR', '16'),
(34, 'Myanmar', '95', 'MMK', '978'),
(35, 'Namibia', '264', 'NAD', '10'),
(36, 'Nepal', '977', 'NPR', '97'),
(37, 'Netherlands', '31', '', ''),
(38, 'New Zealand', '64', 'NZD', '1'),
(39, 'North Korea', '850', 'KPW', '135'),
(40, 'Norway', '47', 'NOK', '6'),
(41, 'Oman', '968', 'OMR', '1'),
(43, 'Poland', '48', '', ''),
(44, 'Russia', '7', 'RUB', '34'),
(45, 'Singapore', '65', 'SGD', '1'),
(46, 'Somalia', '252', 'SOS', '1021'),
(47, 'South Africa', '27', 'ZAR', '10'),
(48, 'South Korea', '82', 'KRW', '1023'),
(49, 'Sri Lanka', '94', 'LKR', '130'),
(50, 'Spain', '34', 'ESP', '121'),
(51, 'Sudan', '249', 'SDG', '6'),
(52, 'Swaziland', '268', 'SZL', '10'),
(53, 'Sweden', '46', 'SEK', '7'),
(54, 'Syria', '963', 'SYP', '148'),
(55, 'Taiwan', '886', 'TWD', '30'),
(56, 'Uganda', '256', 'UGX', '2553'),
(57, 'United Kingdom', '44', 'GBP', '1'),
(58, 'United States', '1', 'USD', '1'),
(59, 'Vietnam', '84', 'VND', '21138'),
(60, 'Yemen', '967', 'YER', '215');

-- --------------------------------------------------------

--
-- Table structure for table `damagestcokmaster`
--

CREATE TABLE IF NOT EXISTS `damagestcokmaster` (
  `damageStockMasterId` int(50) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`damageStockMasterId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `damagestockdetails`
--

CREATE TABLE IF NOT EXISTS `damagestockdetails` (
  `damageStockDetailsId` int(50) NOT NULL AUTO_INCREMENT,
  `damageStockMasterId` varchar(50) DEFAULT NULL,
  `productBatchId` varchar(50) DEFAULT NULL,
  `qty` decimal(18,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `unitId` varchar(50) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`damageStockDetailsId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `finacialyear`
--

CREATE TABLE IF NOT EXISTS `finacialyear` (
  `finacialYearId` int(50) NOT NULL AUTO_INCREMENT,
  `fromDate` datetime DEFAULT NULL,
  `toDate` datetime DEFAULT NULL,
  `activeOrNot` tinyint(1) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`finacialYearId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `finacialyear`
--

INSERT INTO `finacialyear` (`finacialYearId`, `fromDate`, `toDate`, `activeOrNot`, `companyId`) VALUES
(1, '2013-01-01 00:00:00', '2013-12-31 23:59:59', 0, 1),
(2, '2014-01-01 00:00:00', '2014-12-31 23:59:59', 1, 1),
(3, '2014-01-01 00:00:00', '2014-12-31 23:59:59', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `genericname`
--

CREATE TABLE IF NOT EXISTS `genericname` (
  `genericNameId` int(50) NOT NULL AUTO_INCREMENT,
  `genericName` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`genericNameId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `genericnamenew`
--

CREATE TABLE IF NOT EXISTS `genericnamenew` (
  `genericNameId` int(50) NOT NULL AUTO_INCREMENT,
  `genericName` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`genericNameId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `instantsalestockposting`
--

CREATE TABLE IF NOT EXISTS `instantsalestockposting` (
  `instantStockPostingId` int(50) NOT NULL AUTO_INCREMENT,
  `voucherNumber` varchar(50) DEFAULT NULL,
  `productBatchId` varchar(50) DEFAULT NULL,
  `inwardQuantity` decimal(18,2) DEFAULT NULL,
  `outwardQuantity` decimal(18,2) DEFAULT NULL,
  `voucherType` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`instantStockPostingId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE IF NOT EXISTS `insurance` (
  `insuranceId` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`insuranceId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoicestatus`
--

CREATE TABLE IF NOT EXISTS `invoicestatus` (
  `invoiceStatusId` int(5) NOT NULL AUTO_INCREMENT,
  `Description` varchar(50) DEFAULT '0',
  PRIMARY KEY (`invoiceStatusId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `invoicestatus`
--

INSERT INTO `invoicestatus` (`invoiceStatusId`, `Description`) VALUES
(1, 'Paid'),
(2, 'Part Paid'),
(3, 'Unpaid'),
(4, 'Void');

-- --------------------------------------------------------

--
-- Table structure for table `journaldetails`
--

CREATE TABLE IF NOT EXISTS `journaldetails` (
  `journalDetailsId` int(50) NOT NULL AUTO_INCREMENT,
  `journalMasterId` varchar(50) DEFAULT NULL,
  `ledgerId` varchar(50) DEFAULT NULL,
  `debit` decimal(18,2) DEFAULT NULL,
  `credit` decimal(18,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`journalDetailsId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `journalmaster`
--

CREATE TABLE IF NOT EXISTS `journalmaster` (
  `journalMasterId` int(50) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`journalMasterId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ledgerposting`
--

CREATE TABLE IF NOT EXISTS `ledgerposting` (
  `ledgerPostingId` int(50) NOT NULL AUTO_INCREMENT,
  `voucherNumber` varchar(50) DEFAULT NULL,
  `ledgerId` varchar(50) DEFAULT NULL,
  `voucherType` varchar(50) DEFAULT NULL,
  `debit` decimal(18,2) DEFAULT NULL,
  `credit` decimal(18,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`ledgerPostingId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ledgerposting`
--

INSERT INTO `ledgerposting` (`ledgerPostingId`, `voucherNumber`, `ledgerId`, `voucherType`, `debit`, `credit`, `description`, `date`, `companyId`) VALUES
(3, '2', '57', 'Sales Invoice', '900.00', '0.00', 'By Sales', '2014-12-22 00:00:00', 1),
(4, '2', '3', 'Sales Invoice', '0.00', '900.00', 'By Sales', '2014-12-22 00:00:00', 1),
(5, '3', '2', 'Sales Invoice', '800.00', '0.00', 'By Sales', '2014-12-22 00:00:00', 1),
(6, '3', '3', 'Sales Invoice', '0.00', '800.00', 'By Sales', '2014-12-22 00:00:00', 1),
(11, '2', '57', 'Sales Invoice', '900.00', '0.00', 'By Sales', '2014-12-22 00:00:00', 1),
(12, '2', '3', 'Sales Invoice', '0.00', '900.00', 'By Sales', '2014-12-22 00:00:00', 1),
(13, '3', '2', 'Sales Invoice', '800.00', '0.00', 'By Sales', '2014-12-22 00:00:00', 1),
(14, '3', '3', 'Sales Invoice', '0.00', '800.00', 'By Sales', '2014-12-22 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE IF NOT EXISTS `manufacturer` (
  `manufactureId` int(50) NOT NULL AUTO_INCREMENT,
  `manufactureName` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`manufactureId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`manufactureId`, `manufactureName`, `address`, `phone`, `email`, `description`, `companyId`) VALUES
(1, 'Provita Chicks', 'Dhaka', '', '', '', 1),
(2, 'Provita Feed', 'Dhaka', '', 'info@provita.com', '', 1),
(3, 'ACI Feed', 'Dhaka', '', '', '', 1),
(4, 'Co.2-Manufacturer-1', '', '', '', '', 2),
(5, 'Co.2-Manufacturer-2', '', '', '', '', 2),
(7, 'Kazi Farms', '', '', '', '', 1),
(8, 'Nahar Chicks', '', '', '', '', 1),
(9, 'Reneta', '', '', '', '', 1),
(10, 'NA', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `partybalance`
--

CREATE TABLE IF NOT EXISTS `partybalance` (
  `balanceId` int(50) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `ledgerId` varchar(50) DEFAULT NULL,
  `voucherType` varchar(50) DEFAULT NULL,
  `voucherNo` varchar(50) DEFAULT NULL,
  `againstVoucherType` varchar(50) DEFAULT NULL,
  `againstvoucherNo` varchar(50) DEFAULT NULL,
  `referenceType` varchar(250) DEFAULT NULL,
  `debit` decimal(18,2) DEFAULT NULL,
  `credit` decimal(18,2) DEFAULT NULL,
  `optional` tinyint(1) DEFAULT NULL,
  `creditPeriod` int(11) DEFAULT NULL,
  `branchId` varchar(50) DEFAULT NULL,
  `extraDate` datetime DEFAULT NULL,
  `extra1` varchar(250) DEFAULT NULL,
  `extra2` varchar(250) DEFAULT NULL,
  `currecyConversionId` varchar(50) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`balanceId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `partybalance`
--

INSERT INTO `partybalance` (`balanceId`, `date`, `ledgerId`, `voucherType`, `voucherNo`, `againstVoucherType`, `againstvoucherNo`, `referenceType`, `debit`, `credit`, `optional`, `creditPeriod`, `branchId`, `extraDate`, `extra1`, `extra2`, `currecyConversionId`, `companyId`) VALUES
(1, '2014-12-22 00:00:00', '57', 'Sales  Invoice', '2', 'NA', 'NA', 'New', '900.00', '0.00', 0, 22, '1', '0000-00-00 00:00:00', NULL, NULL, '1', 1),
(2, '2014-11-25 00:00:00', '56', 'Purchase Invoice', '3', 'NA', 'NA', 'New', '0.00', '6200.00', 0, 0, '1', '2014-11-26 13:16:05', NULL, NULL, '1', 1),
(3, '2014-12-22 00:00:00', '57', 'Sales  Invoice', '2', 'NA', 'NA', 'New', '900.00', '0.00', 0, 22, '1', '0000-00-00 00:00:00', NULL, NULL, '1', 1),
(5, '2014-12-22 00:00:00', '57', 'Sales  Invoice', '2', 'NA', 'NA', 'New', '900.00', '0.00', 0, 22, '1', '0000-00-00 00:00:00', NULL, NULL, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paymentdetails`
--

CREATE TABLE IF NOT EXISTS `paymentdetails` (
  `paymentDetailsId` int(50) NOT NULL AUTO_INCREMENT,
  `paymentMasterId` varchar(50) DEFAULT NULL,
  `ledgerId` varchar(50) DEFAULT NULL,
  `voucherNumber` varchar(50) DEFAULT NULL,
  `voucherType` varchar(50) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `chequeNumber` varchar(50) DEFAULT NULL,
  `chequeDate` datetime DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`paymentDetailsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `paymentdetails`
--

INSERT INTO `paymentdetails` (`paymentDetailsId`, `paymentMasterId`, `ledgerId`, `voucherNumber`, `voucherType`, `amount`, `chequeNumber`, `chequeDate`, `description`, `companyId`) VALUES
(1, '1', '56', NULL, NULL, '10000.00', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `paymentmaster`
--

CREATE TABLE IF NOT EXISTS `paymentmaster` (
  `paymentMasterId` int(50) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `ledgerId` varchar(50) DEFAULT NULL,
  `paymentMode` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`paymentMasterId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `paymentmaster`
--

INSERT INTO `paymentmaster` (`paymentMasterId`, `date`, `ledgerId`, `paymentMode`, `description`, `companyId`) VALUES
(1, '2014-12-02 11:38:20', '2', 'By Cash', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pricelist`
--

CREATE TABLE IF NOT EXISTS `pricelist` (
  `priceListId` int(50) NOT NULL AUTO_INCREMENT,
  `applicableFrom` datetime DEFAULT NULL,
  `productCode` varchar(50) DEFAULT NULL,
  `pricingLevelId` varchar(50) DEFAULT NULL,
  `quantity` decimal(18,2) DEFAULT NULL,
  `rate` decimal(18,2) DEFAULT NULL,
  `unitId` varchar(50) DEFAULT NULL,
  `branchId` varchar(50) DEFAULT NULL,
  `extraDate` datetime DEFAULT NULL,
  `extra1` varchar(250) DEFAULT NULL,
  `extra2` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`priceListId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pricinglevel`
--

CREATE TABLE IF NOT EXISTS `pricinglevel` (
  `pricingLevelId` int(50) NOT NULL AUTO_INCREMENT,
  `pricingLevelName` varchar(250) DEFAULT NULL,
  `narration` varchar(250) DEFAULT NULL,
  `branchId` varchar(50) DEFAULT NULL,
  `extraDate` datetime DEFAULT NULL,
  `extra1` varchar(250) DEFAULT NULL,
  `extra2` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`pricingLevelId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `productId` int(50) NOT NULL AUTO_INCREMENT,
  `productName` varchar(250) DEFAULT NULL,
  `productGroupId` varchar(50) DEFAULT NULL,
  `manufactureId` varchar(50) DEFAULT NULL,
  `shelfId` varchar(50) DEFAULT NULL,
  `genericNameId` varchar(50) DEFAULT NULL,
  `stockMinimumLevel` decimal(18,2) DEFAULT NULL,
  `stockMaximumLevel` decimal(18,2) DEFAULT NULL,
  `medicineFor` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `unitId` varchar(50) DEFAULT NULL,
  `partNo` varchar(250) DEFAULT NULL,
  `multipleUnit` tinyint(1) DEFAULT NULL,
  `ministryOfHealth` tinyint(1) DEFAULT NULL,
  `tax` decimal(18,2) DEFAULT NULL,
  `taxType` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `productName`, `productGroupId`, `manufactureId`, `shelfId`, `genericNameId`, `stockMinimumLevel`, `stockMaximumLevel`, `medicineFor`, `description`, `unitId`, `partNo`, `multipleUnit`, `ministryOfHealth`, `tax`, `taxType`, `companyId`) VALUES
(1, 'Ready Stock', '9', '10', NULL, NULL, '0.00', '0.00', NULL, '', '9', NULL, NULL, NULL, '0.00', '1', 1),
(2, 'Provita Chicks', '6', '1', NULL, NULL, '0.00', '0.00', NULL, '', '9', NULL, NULL, NULL, '0.00', '1', 1),
(3, 'Kazi Chicks', '6', '7', NULL, NULL, '0.00', '0.00', NULL, '', '9', NULL, NULL, NULL, '0.00', '1', 1),
(4, 'Nahar Chicks', '6', '8', NULL, NULL, '0.00', '0.00', NULL, '', '9', NULL, NULL, NULL, '0.00', '1', 1),
(5, 'Provita Broiler Starter', '7', '2', NULL, NULL, '0.00', '0.00', NULL, '', '11', NULL, NULL, NULL, '0.00', '1', 1),
(6, 'Provita Broiler Grower', '7', '2', NULL, NULL, '0.00', '0.00', NULL, '', '11', NULL, NULL, NULL, '0.00', '1', 1),
(7, 'Provita Sale’s Center Feed', '7', '2', NULL, NULL, '0.00', '0.00', NULL, '', '6', NULL, NULL, NULL, '0.00', '1', 1),
(8, 'Rena-C premix', '8', '9', NULL, NULL, '0.00', '0.00', NULL, '', '12', NULL, NULL, NULL, '0.00', '1', 1),
(9, 'Doxivet', '8', '9', NULL, NULL, '0.00', '0.00', NULL, '', '12', NULL, NULL, NULL, '0.00', '1', 1),
(10, 'Lisovit', '8', '9', NULL, NULL, '0.00', '0.00', NULL, '', '12', NULL, NULL, NULL, '0.00', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `productbatch`
--

CREATE TABLE IF NOT EXISTS `productbatch` (
  `productBatchId` int(50) NOT NULL AUTO_INCREMENT,
  `productId` varchar(50) DEFAULT NULL,
  `batchName` varchar(50) DEFAULT NULL,
  `expiryDate` datetime DEFAULT NULL,
  `purchaseRate` decimal(18,2) DEFAULT NULL,
  `salesRate` decimal(18,2) DEFAULT NULL,
  `MRP` decimal(18,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`productBatchId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `productbatch`
--

INSERT INTO `productbatch` (`productBatchId`, `productId`, `batchName`, `expiryDate`, `purchaseRate`, `salesRate`, `MRP`, `description`, `companyId`) VALUES
(1, '2', NULL, NULL, '32.00', '37.00', '0.00', NULL, 1),
(2, '3', NULL, NULL, '32.00', '37.00', '0.00', NULL, 1),
(3, '4', NULL, NULL, '32.00', '37.00', '0.00', NULL, 1),
(4, '5', NULL, NULL, '2025.00', '2400.00', '0.00', NULL, 1),
(5, '6', NULL, NULL, '2025.00', '2400.00', '0.00', NULL, 1),
(6, '7', NULL, NULL, '620.00', '750.00', '0.00', NULL, 1),
(7, '8', NULL, NULL, '178.00', '200.00', '0.00', NULL, 1),
(8, '9', NULL, NULL, '148.00', '167.00', '0.00', NULL, 1),
(9, '10', NULL, NULL, '500.00', '540.00', '0.00', NULL, 1),
(10, '11', NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productgroup`
--

CREATE TABLE IF NOT EXISTS `productgroup` (
  `productGroupId` int(50) NOT NULL AUTO_INCREMENT,
  `productGroupName` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`productGroupId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `productgroup`
--

INSERT INTO `productgroup` (`productGroupId`, `productGroupName`, `description`, `companyId`) VALUES
(1, 'Chicks', 'Chicks', 0),
(2, 'Feed', 'Feed', 0),
(3, 'Medicine', 'Medicine', 0),
(4, 'Pencil', 'Co2-ProductGroup-1', 2),
(5, 'Rice', 'Co2-ProductGroup-2', 2),
(6, 'Chicks', 'Chicks', 1),
(7, 'Feed', 'Feed for Chicken and Fish Projects', 1),
(8, 'Medicine', 'Medicine for Chicken and Fish Projects', 1),
(9, 'Chicken', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetails`
--

CREATE TABLE IF NOT EXISTS `purchasedetails` (
  `purchaseDetailsId` int(50) NOT NULL AUTO_INCREMENT,
  `purchaseMasterId` varchar(50) DEFAULT NULL,
  `productBatchId` varchar(50) DEFAULT NULL,
  `rate` decimal(18,2) DEFAULT NULL,
  `discount` decimal(18,2) DEFAULT '0.00',
  `qty` decimal(18,2) DEFAULT NULL,
  `freeQty` decimal(18,2) DEFAULT '0.00',
  `taxPercentage` decimal(18,2) DEFAULT '0.00',
  `taxIncludedOrNot` tinyint(1) DEFAULT '0',
  `description` varchar(250) DEFAULT '1',
  `userRate` decimal(18,2) DEFAULT '0.00',
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`purchaseDetailsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `purchasedetails`
--

INSERT INTO `purchasedetails` (`purchaseDetailsId`, `purchaseMasterId`, `productBatchId`, `rate`, `discount`, `qty`, `freeQty`, `taxPercentage`, `taxIncludedOrNot`, `description`, `userRate`, `companyId`) VALUES
(1, '1', '1', '32.00', '0.00', '200.00', '0.00', '0.00', 1, '1', '0.00', 1),
(2, '1', '4', '2025.00', '0.00', '2.00', '0.00', '0.00', 1, '1', '0.00', 1),
(3, '1', '5', '2025.00', '0.00', '3.00', '0.00', '0.00', 1, '1', '0.00', 1),
(4, '1', '6', '620.00', '0.00', '5.00', '0.00', '0.00', 1, '1', '0.00', 1),
(5, '1', '7', '178.00', '0.00', '10.00', '0.00', '0.00', 1, '1', '0.00', 1),
(6, '1', '8', '148.00', '0.00', '10.00', '0.00', '0.00', 1, '1', '0.00', 1),
(7, '1', '9', '500.00', '0.00', '10.00', '0.00', '0.00', 1, '1', '0.00', 1),
(8, '2', '4', '2025.00', '0.00', '10.00', '0.00', '0.00', 0, '1', '0.00', 1),
(9, '3', '6', '620.00', '0.00', '10.00', '0.00', '0.00', 0, '1', '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchasemaster`
--

CREATE TABLE IF NOT EXISTS `purchasemaster` (
  `purchaseMasterId` int(50) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `ledgerId` varchar(50) DEFAULT NULL,
  `dueDays` int(11) DEFAULT NULL,
  `purchaseInvoiceNo` varchar(50) DEFAULT NULL,
  `billDiscount` decimal(18,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `additionalCost` decimal(18,2) DEFAULT NULL,
  `vendorId` varchar(50) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `invoiceStatusId` int(5) NOT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`purchaseMasterId`),
  UNIQUE KEY `companyId_purchaseInvoiceNo` (`purchaseInvoiceNo`,`companyId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `purchasemaster`
--

INSERT INTO `purchasemaster` (`purchaseMasterId`, `date`, `ledgerId`, `dueDays`, `purchaseInvoiceNo`, `billDiscount`, `description`, `additionalCost`, `vendorId`, `amount`, `invoiceStatusId`, `companyId`) VALUES
(1, '2014-11-01 15:22:06', '2', NULL, '5466465', NULL, NULL, NULL, NULL, '27885.00', 1, 1),
(2, '2014-11-20 00:00:00', '56', 20, '6214786', '0.00', NULL, '0.00', '0', '20250.00', 2, 1),
(3, '2014-11-25 00:00:00', '56', 20, '6312456', '0.00', NULL, '0.00', '0', '6200.00', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchasereturndetails`
--

CREATE TABLE IF NOT EXISTS `purchasereturndetails` (
  `purchaseReturnDetailsId` int(50) NOT NULL AUTO_INCREMENT,
  `purchaseReturnMasterId` varchar(50) DEFAULT NULL,
  `purchaseDetailsId` varchar(50) DEFAULT NULL,
  `returnedQty` decimal(18,2) DEFAULT NULL,
  `returnedFreeQty` decimal(18,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`purchaseReturnDetailsId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchasereturnmaster`
--

CREATE TABLE IF NOT EXISTS `purchasereturnmaster` (
  `purchaseReturnMasterId` int(50) NOT NULL AUTO_INCREMENT,
  `purchaseMasterId` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`purchaseReturnMasterId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `receiptdetails`
--

CREATE TABLE IF NOT EXISTS `receiptdetails` (
  `receiptDetailsId` int(50) NOT NULL AUTO_INCREMENT,
  `receiptMasterId` varchar(50) DEFAULT NULL,
  `ledgerId` varchar(50) DEFAULT NULL,
  `voucherNumber` varchar(50) DEFAULT NULL,
  `voucherType` varchar(50) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `chequeNumber` varchar(50) DEFAULT NULL,
  `chequeDate` datetime DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`receiptDetailsId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `receiptmaster`
--

CREATE TABLE IF NOT EXISTS `receiptmaster` (
  `receiptMasterId` int(50) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `ledgerId` varchar(50) DEFAULT NULL,
  `receiptMode` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`receiptMasterId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE IF NOT EXISTS `reminder` (
  `reminderId` int(50) NOT NULL AUTO_INCREMENT,
  `currentDate` datetime DEFAULT NULL,
  `reminderDate` datetime DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`reminderId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salesdetails`
--

CREATE TABLE IF NOT EXISTS `salesdetails` (
  `salesDetailsId` int(50) NOT NULL AUTO_INCREMENT,
  `salesMasterId` varchar(50) DEFAULT NULL,
  `productBatchId` varchar(50) DEFAULT NULL,
  `rate` decimal(18,2) DEFAULT NULL,
  `MRP` decimal(18,2) DEFAULT NULL,
  `qty` decimal(18,2) DEFAULT NULL,
  `freeQty` decimal(18,2) DEFAULT NULL,
  `discount` decimal(18,2) DEFAULT NULL,
  `directSaleOrNot` tinyint(1) DEFAULT NULL,
  `taxIncludedOrNot` varchar(250) DEFAULT NULL,
  `taxPercentage` decimal(18,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `unitId` varchar(50) DEFAULT NULL,
  `userRate` decimal(18,2) DEFAULT NULL,
  `taxAmount` decimal(18,2) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`salesDetailsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `salesdetails`
--

INSERT INTO `salesdetails` (`salesDetailsId`, `salesMasterId`, `productBatchId`, `rate`, `MRP`, `qty`, `freeQty`, `discount`, `directSaleOrNot`, `taxIncludedOrNot`, `taxPercentage`, `description`, `unitId`, `userRate`, `taxAmount`, `companyId`) VALUES
(2, '2', '5', '2400.00', NULL, '2.00', NULL, '10.00', NULL, '1', '0.00', NULL, '11', NULL, NULL, 1),
(3, '2', '6', '750.00', NULL, '5.00', NULL, '4.00', NULL, '1', '0.00', NULL, '6', NULL, NULL, 1),
(4, '3', NULL, '0.00', NULL, '0.00', NULL, '0.00', NULL, '1', '0.00', NULL, '0', NULL, NULL, 1),
(5, '3', '4', '2400.00', NULL, '2.00', NULL, '0.00', NULL, '1', '0.00', NULL, '11', NULL, NULL, 1),
(6, '3', '7', '200.00', NULL, '10.00', NULL, '0.00', NULL, '1', '0.00', NULL, '12', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE IF NOT EXISTS `salesman` (
  `salesManId` int(50) NOT NULL AUTO_INCREMENT,
  `salesManName` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `pinCode` varchar(50) DEFAULT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `dateOfBirth` datetime DEFAULT NULL,
  `dateOfJoining` datetime DEFAULT NULL,
  `dateOfTermination` datetime DEFAULT NULL,
  `qualification` varchar(250) DEFAULT NULL,
  `activeOrNot` tinyint(1) DEFAULT NULL,
  `ledgerId` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`salesManId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salesmaster`
--

CREATE TABLE IF NOT EXISTS `salesmaster` (
  `salesMasterId` int(50) NOT NULL AUTO_INCREMENT,
  `salesInvoiceNo` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `ledgerId` varchar(50) DEFAULT NULL,
  `doctorId` varchar(50) DEFAULT NULL,
  `salesManId` varchar(50) DEFAULT NULL,
  `patientId` varchar(50) DEFAULT NULL,
  `billDiscount` decimal(18,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `voucherNo` varchar(50) DEFAULT NULL,
  `suffixPrefixId` varchar(50) DEFAULT NULL,
  `cardTypeId` varchar(50) DEFAULT NULL,
  `discountPer` decimal(18,2) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL,
  `insuranceNo` varchar(250) DEFAULT NULL,
  `creditPeriod` int(11) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `bank` varchar(250) DEFAULT NULL,
  `bankCharges` decimal(18,2) DEFAULT NULL,
  `cardName` varchar(250) DEFAULT NULL,
  `pricingLevelId` varchar(50) DEFAULT NULL,
  `LRNo` varchar(250) DEFAULT NULL,
  `carrierBy` varchar(250) DEFAULT NULL,
  `orderNo` varchar(250) DEFAULT NULL,
  `deliveryNo` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`salesMasterId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `salesmaster`
--

INSERT INTO `salesmaster` (`salesMasterId`, `salesInvoiceNo`, `date`, `ledgerId`, `doctorId`, `salesManId`, `patientId`, `billDiscount`, `description`, `voucherNo`, `suffixPrefixId`, `cardTypeId`, `discountPer`, `type`, `status`, `insuranceNo`, `creditPeriod`, `amount`, `bank`, `bankCharges`, `cardName`, `pricingLevelId`, `LRNo`, `carrierBy`, `orderNo`, `deliveryNo`, `companyId`) VALUES
(2, '2', '2014-12-22 00:00:00', '57', '0', '1', '1', '20.00', 'Credit', 'SalesMasterId', 'NA', NULL, '0.00', 'Sales', '3', NULL, 22, '900.00', NULL, '0.00', NULL, '1', NULL, NULL, '22', NULL, 1),
(3, '3', '2014-12-22 00:00:00', '2', '0', '1', '1', '0.00', 'Cash', 'SalesMasterId', 'NA', NULL, '0.00', 'Sales', '1', NULL, 0, '800.00', NULL, '0.00', NULL, '1', NULL, NULL, '11', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salesquotation`
--

CREATE TABLE IF NOT EXISTS `salesquotation` (
  `salesQuotationId` decimal(18,2) NOT NULL,
  `voucherNumber` varchar(250) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`salesQuotationId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesreturndetails`
--

CREATE TABLE IF NOT EXISTS `salesreturndetails` (
  `salesReturnDetailsId` int(50) NOT NULL AUTO_INCREMENT,
  `salesReturnMasterId` varchar(50) DEFAULT NULL,
  `salesDetailsId` varchar(50) DEFAULT NULL,
  `returnedQty` decimal(18,2) DEFAULT NULL,
  `returnedFreeQty` decimal(18,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`salesReturnDetailsId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salesreturnmaster`
--

CREATE TABLE IF NOT EXISTS `salesreturnmaster` (
  `salesReturnMasterId` int(50) NOT NULL AUTO_INCREMENT,
  `salesMasterId` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`salesReturnMasterId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `settingsId` int(50) NOT NULL AUTO_INCREMENT,
  `automaticProductIdGeneration` tinyint(1) DEFAULT NULL,
  `negativeStockAlertStatus` varchar(50) DEFAULT NULL,
  `expiryProductTransactionStatus` varchar(50) DEFAULT NULL,
  `expiryReminderWithin` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `expiryReminderNeeded` tinyint(1) DEFAULT NULL,
  `lowStockAlertStatus` tinyint(1) DEFAULT NULL,
  `negativeCashTransaction` varchar(250) DEFAULT NULL,
  `bankChargeByCustomerOrCompany` varchar(250) DEFAULT NULL,
  `bankChargeAmount` decimal(18,2) DEFAULT NULL,
  `backUpPath` varchar(250) DEFAULT NULL,
  `tax` tinyint(1) DEFAULT NULL,
  `discount` tinyint(1) DEFAULT NULL,
  `doctor` tinyint(1) DEFAULT NULL,
  `patient` tinyint(1) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`settingsId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shelf`
--

CREATE TABLE IF NOT EXISTS `shelf` (
  `shelfId` int(50) NOT NULL AUTO_INCREMENT,
  `shelfName` varchar(250) DEFAULT NULL,
  `shelfDescription` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`shelfId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stockdetails`
--

CREATE TABLE IF NOT EXISTS `stockdetails` (
  `stockDetailsId` int(50) NOT NULL AUTO_INCREMENT,
  `stockMasterId` varchar(50) DEFAULT NULL,
  `productBatchId` varchar(50) DEFAULT NULL,
  `qty` decimal(18,2) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `rate` decimal(18,2) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`stockDetailsId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stockmaster`
--

CREATE TABLE IF NOT EXISTS `stockmaster` (
  `stockMasterId` int(50) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`stockMasterId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stockposting`
--

CREATE TABLE IF NOT EXISTS `stockposting` (
  `serialNumber` int(50) NOT NULL AUTO_INCREMENT,
  `voucherNumber` varchar(50) DEFAULT NULL,
  `productBatchId` varchar(50) DEFAULT NULL,
  `inwardQuantity` decimal(18,2) DEFAULT NULL,
  `outwardQuantity` decimal(18,2) DEFAULT NULL,
  `voucherType` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `unitId` varchar(50) DEFAULT NULL,
  `rate` decimal(18,2) DEFAULT NULL,
  `defaultInwardQuantity` decimal(18,2) DEFAULT NULL,
  `defaultOutwardQuantity` decimal(18,2) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`serialNumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `stockposting`
--

INSERT INTO `stockposting` (`serialNumber`, `voucherNumber`, `productBatchId`, `inwardQuantity`, `outwardQuantity`, `voucherType`, `description`, `date`, `unitId`, `rate`, `defaultInwardQuantity`, `defaultOutwardQuantity`, `companyId`) VALUES
(8, '2', '4', '10.00', '0.00', 'Purchase Invoice', NULL, '2014-11-20 00:00:00', '11', '2025.00', '10.00', '0.00', 1),
(9, '3', '6', '10.00', '0.00', 'Purchase Invoice', NULL, '2014-11-25 00:00:00', '6', '620.00', '10.00', '0.00', 1),
(11, '2', '5', '0.00', '2.00', 'Sales  Invoice', NULL, '2014-12-22 00:00:00', '11', '2400.00', '0.00', '2.00', 1),
(12, '2', '6', '0.00', '5.00', 'Sales  Invoice', NULL, '2014-12-22 00:00:00', '6', '750.00', '0.00', '5.00', 1),
(13, '3', NULL, '0.00', '0.00', 'Sales  Invoice', NULL, '2014-12-22 00:00:00', '0', '0.00', '0.00', '0.00', 1),
(14, '3', '4', '0.00', '2.00', 'Sales  Invoice', NULL, '2014-12-22 00:00:00', '11', '2400.00', '0.00', '2.00', 1),
(15, '3', '7', '0.00', '10.00', 'Sales  Invoice', NULL, '2014-12-22 00:00:00', '12', '200.00', '0.00', '10.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `suffixprefix`
--

CREATE TABLE IF NOT EXISTS `suffixprefix` (
  `suffixPrefixId` int(50) NOT NULL AUTO_INCREMENT,
  `branchId` varchar(50) DEFAULT NULL,
  `suffix` varchar(250) DEFAULT NULL,
  `prefix` varchar(250) DEFAULT NULL,
  `startIndex` int(11) DEFAULT NULL,
  `voucherType` varchar(250) DEFAULT NULL,
  `extraDate` datetime DEFAULT NULL,
  `extra1` varchar(250) DEFAULT NULL,
  `extra2` varchar(250) DEFAULT NULL,
  `yearId` varchar(50) DEFAULT NULL,
  `suffixEquipment` varchar(250) DEFAULT NULL,
  `prefixEquipment` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`suffixPrefixId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE IF NOT EXISTS `temp` (
  `purchaseMasterId` int(50) DEFAULT NULL,
  `Voucher Date` varchar(8000) DEFAULT NULL,
  `A/C Ledger` varchar(250) DEFAULT NULL,
  `Bill Amount` decimal(24,2) DEFAULT NULL,
  `Paid Amount` decimal(24,2) DEFAULT NULL,
  `Balance` decimal(38,2) DEFAULT NULL,
  `Due Date` varchar(8000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE IF NOT EXISTS `unit` (
  `unitId` int(50) NOT NULL AUTO_INCREMENT,
  `unitName` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`unitId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unitId`, `unitName`, `description`, `companyId`) VALUES
(1, '1 KG', '', 1),
(2, '2 KG', '2000 Gram', 1),
(3, '5 KG', '', 1),
(4, '250 gm', '', 1),
(5, '500 gm', '1/2 KG', 1),
(6, '25 KG', '', 1),
(7, '500 gm', 'Co.2-500gm', 2),
(8, '25 KG', 'Co.2-25KG', 2),
(9, '1 Pcs', '', 1),
(10, '700 ml', '', 1),
(11, '50 KG', '', 1),
(12, '100 gm', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unitconversion`
--

CREATE TABLE IF NOT EXISTS `unitconversion` (
  `unitConversionId` int(50) NOT NULL AUTO_INCREMENT,
  `productCode` varchar(50) DEFAULT NULL,
  `unitId` varchar(50) DEFAULT NULL,
  `conversionRate` decimal(24,8) DEFAULT NULL,
  `extraDate` datetime DEFAULT NULL,
  `extra1` varchar(250) DEFAULT NULL,
  `extra2` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`unitConversionId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(50) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `activeOrNot` tinyint(1) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `password`, `activeOrNot`, `description`, `companyId`) VALUES
(1, 'admin', 'admin', 1, 'Administrator', 1),
(2, 'user', 'pass', 1, 'Admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `userprivilege`
--

CREATE TABLE IF NOT EXISTS `userprivilege` (
  `privilegeId` int(50) NOT NULL AUTO_INCREMENT,
  `userId` varchar(50) DEFAULT NULL,
  `formName` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`privilegeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `vendorId` int(50) NOT NULL AUTO_INCREMENT,
  `vendorName` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `pinCode` varchar(50) DEFAULT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `emailId` varchar(50) DEFAULT NULL,
  `mobileNumber` varchar(50) DEFAULT NULL,
  `ledgerId` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `companyId` int(50) NOT NULL,
  PRIMARY KEY (`vendorId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorId`, `vendorName`, `address`, `country`, `state`, `pinCode`, `phoneNumber`, `emailId`, `mobileNumber`, `ledgerId`, `description`, `companyId`) VALUES
(1, 'Supplier-1', 'Bangla Bazar, Dhaka', 'Bangladesh', NULL, NULL, '', '', '', '55', '', 1),
(2, 'Supplier-2', '72, Lakshmi Bazar, Dhaka', 'Bangladesh', NULL, NULL, '028456456', 'supplier2@gmail.com', '', '56', '', 1),
(3, 'Supplier-3', 'Nahar Garden, Green Road, Dhaka', 'Bangladesh', NULL, NULL, ' 88027912346', 'supplier3@gmail.com', ' 8801680139091', '57', 'Supplier-3 with Credit balance of 12570 Tk.', 1),
(4, 'Co.2-Supplier-1', '', 'Bangladesh', NULL, NULL, '', '', '', '62', 'For Co.2', 2),
(5, 'Co.2-Supplier-2', 'New Elephant Road', 'Bangladesh', NULL, NULL, '', '', '', '63', 'For Co.2', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
