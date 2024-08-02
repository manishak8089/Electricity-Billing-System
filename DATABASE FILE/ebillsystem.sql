-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2021 at 07:33 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: ebillsystem
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=root@localhost PROCEDURE unitstoamount (IN units INT(14), OUT result INT(14))  BEGIN
   
    DECLARE a INT(14) DEFAULT 0;
    DECLARE b INT(14) DEFAULT 0;
    DECLARE c INT(14) DEFAULT 0;

    SELECT twohundred FROM unitsRate INTO a ;
    SELECT fivehundred FROM unitsRate INTO b ;
    SELECT thousand FROM unitsRate INTO c  ;

    IF units<200
    then
        SELECT a*units INTO result;
    
    ELSEIF units<500
    then
        SELECT (a*200)+(b*(units-200)) INTO result;
    ELSEIF units > 500
    then
        SELECT (a*200)+(b*(300))+(c*(units-500)) INTO result;
    END IF;

END$$

--
-- Functions
--
CREATE DEFINER=root@localhost FUNCTION curdate1 () RETURNS INT(11) BEGIN
    DECLARE x INT;
    SET x = DAYOFMONTH(CURDATE());
    IF (x=1)
    THEN
        RETURN 1;
    ELSE
        RETURN 0;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table admin
--

CREATE TABLE user_deletion_log (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    deletion_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE admin (
  id int(14) NOT NULL,
  name varchar(40) NOT NULL,
  email varchar(40) NOT NULL,
  pass varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table admin
--

INSERT INTO admin (id, name, email, pass) VALUES
(1, 'Administrator One', 'admin@gmail.com', 'Password@123'),
(2, 'Administrator Two', 'admin2@gmail.com', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table bill
--

CREATE TABLE bill (
  id int(14) NOT NULL,
  aid int(14) NOT NULL,
  uid int(14) NOT NULL,
  units int(10) NOT NULL,
  amount decimal(10,2) NOT NULL,
  status varchar(10) NOT NULL,
  bdate date NOT NULL,
  ddate date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table bill
--

INSERT INTO bill (id, aid, uid, units, amount, status, bdate, ddate) VALUES
(17, 1, 108, 210, '450.00', 'PROCESSED', '2024-01-06', '2024-02-05'),
(18, 1, 101, 61, '122.00', 'PENDING', '2023-12-20', '2024-01-19'),
(19, 1, 102, 78, '156.00', 'PENDING', '2023-12-15', '2024-01-14'),
(20, 1, 103, 70, '140.00', 'PROCESSED', '2024-01-10', '2024-02-09'),
(21, 1, 104, 98, '196.00', 'PENDING', '2024-01-10', '2024-02-09'),
(22, 1, 109, 55, '110.00', 'PENDING', '2024-01-12', '2024-02-11'),
(23, 1, 111, 89, '178.00', 'PROCESSED', '2024-02-03', '2024-03-09'),
(24, 1, 107, 103, '206.00', 'PENDING', '2024-02-19', '2024-03-19');

-- --------------------------------------------------------

--
-- Table structure for table complaint
--

CREATE TABLE complaint (
  id int(14) NOT NULL,
  uid int(14) NOT NULL,
  aid int(14) NOT NULL,
  complaint varchar(140) NOT NULL,
  status varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table complaint
--

INSERT INTO complaint (id, uid, aid, complaint, status) VALUES
(1, 1, 1, 'Transaction Not Processed', 'PROCESSED'),
(2, 1, 1, 'Transaction Not Processed', 'PROCESSED'),
(3, 2, 1, 'Previous Complaint Not Processed', 'PROCESSED'),
(4, 2, 1, 'Transaction Not Processed', 'PROCESSED'),
(5, 2, 2, 'Transaction Not Processed', 'PROCESSED'),
(6, 1, 1, 'Bill Not Correct', 'PROCESSED'),
(7, 3, 1, 'Bill Not Correct', 'PROCESSED'),
(8, 3, 2, 'Transaction Not Processed', 'PROCESSED'),
(9, 4, 2, 'Transaction Not Processed', 'PROCESSED'),
(10, 4, 1, 'Bill Not Correct', 'PROCESSED'),
(11, 5, 2, 'Bill Generated Late', 'PROCESSED'),
(12, 1, 2, 'Bill Generated Late', 'NOT PROCESSED'),
(13, 11, 1, 'Bill Generated Late', 'PROCESSED');

-- --------------------------------------------------------

--
-- Table structure for table transaction
--

CREATE TABLE transaction (
  id int(14) NOT NULL,
  bid int(14) NOT NULL,
  payable decimal(10,2) NOT NULL,
  pdate date DEFAULT NULL,
  status varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table transaction
--

INSERT INTO transaction (id, bid, payable, pdate, status) VALUES
(17, 17, '450.00', '2024-03-21', 'PROCESSED'),
(18, 18, '122.00', NULL, 'PENDING'),
(19, 19, '156.00', NULL, 'PENDING'),
(20, 20, '140.00', '2024-02-21', 'PROCESSED'),
(21, 21, '196.00', NULL, 'PENDING'),
(22, 22, '110.00', NULL, 'PENDING'),
(23, 23, '178.00','2024-03-11', 'PROCESSED'),
(24, 24, '206.00', NULL, 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table unitsrate
--

CREATE TABLE unitsrate (
  sno int(1) DEFAULT NULL,
  twohundred int(14) NOT NULL,
  fivehundred int(14) NOT NULL,
  thousand int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table unitsrate
--

INSERT INTO unitsrate (sno, twohundred, fivehundred, thousand) VALUES
(1, 2, 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table user
--

CREATE TABLE user (
  id int(14) NOT NULL,
  board_id int(10) NOT NULL,
  name varchar(40) NOT NULL,
  email varchar(40) NOT NULL,
  phone varchar(255) NOT NULL,
  pass varchar(20) NOT NULL,
  address varchar(100) NOT NULL,
  board_name varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table user
--

INSERT INTO user (id,board_id, name, email, phone, pass, address,board_name) VALUES
(101,1001, 'Neha KM\n', 'neha123@gmail.com', '7450002145', '1234', 'Bantwala,Mangalore','MESCOM'),
(102,2045, 'John James', 'johnj234@gmail.com', '7854547855', '1234', 'Kasaragod,Kerala','KSEB'),
(103,4026, 'Ishitha H Abner', 'ishitha56@gmail.com', '7012569980', 'password', 'Bengalore Ocello Street','KPCL'),
(104,7045, 'Ameer Nayar', 'ameernayar@gmail.com', '7012458888', 'password', 'Nasik,Mumbai','MSEB'),
(105,5907, 'Benjamin ', 'benjamin@gmail.com', '7012565800', 'password', ' Shakthi nagar,Rajasthan','RRVUN'),
(106,1001, 'Sinchana Shetty', 'sinchanashetty@gmail.com', '7896541000', 'password', ' Stewart Street,Mangalore','MESCOM'),
(107,2045, 'Jonathan ', 'jonathan@gmail.com', '70145850025', 'password', 'Kanaturu,Kodagu','KSEB'),
(108,2045, 'Lakshmi Rai', 'lakshmi@gmail.com', '7012545555', 'password', ' Ralph Street,Mysore','KSEB'),
(109,2045, 'James Williams', 'williams@gmail.com', '7696969855', 'password', ' St. Marks Road,Kerala','KSEB'),
(110,5907, 'Christine Moore', 'moore@gmail.com', '7896500010', 'password', 'Jaipur','RRVUN'),
(111,1001, 'Anusha Bhat', 'anushab123@gmail.com', '7412580020', 'password', 'Puttur,Mangalore','MESCOM');
--
-- Indexes for dumped tables
--
CREATE TABLE board (
  board_id int(10) NOT NULL,
  board_name varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
INSERT INTO board (board_id,board_name) VALUES(1001,'MESCOM'),(2045,'KSEB'),(4026,'KPCL'),(7045,'MSEB'),(5907,'RRVUN');
-- Indexes for table admin
--
ALTER TABLE admin
  ADD PRIMARY KEY (id);

--
-- Indexes for table bill
--
ALTER TABLE bill
  ADD PRIMARY KEY (id),
  ADD KEY aid (aid),
  ADD KEY uid (uid);

--
-- Indexes for table complaint
--
ALTER TABLE complaint
  ADD PRIMARY KEY (id),
  ADD KEY aid (aid),
  ADD KEY uid (uid);

--
-- Indexes for table transaction
--
ALTER TABLE transaction
  ADD PRIMARY KEY (id),
  ADD KEY bid (bid);

--
-- Indexes for table user
--
ALTER TABLE user
  ADD PRIMARY KEY (id);

ALTER TABLE board
  ADD PRIMARY KEY (board_id,board_name);
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table admin
--
ALTER TABLE admin
  MODIFY id int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table bill
--
ALTER TABLE bill
  MODIFY id int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table complaint
--
ALTER TABLE complaint
  MODIFY id int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table transaction
--
ALTER TABLE transaction
  MODIFY id int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table user
--
ALTER TABLE user
  MODIFY id int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table bill
--
ALTER TABLE bill
  ADD CONSTRAINT bill_ibfk_1 FOREIGN KEY (aid) REFERENCES admin (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT bill_ibfk_2 FOREIGN KEY (uid) REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table complaint
--
ALTER TABLE complaint
ADD  CONSTRAINT complaint_ibfk_1 FOREIGN KEY (aid) REFERENCES admin (id) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT complaint_ibfk_2 FOREIGN KEY (uid) REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table transaction
--
ALTER TABLE transaction
  ADD CONSTRAINT transaction_ibfk_1 FOREIGN KEY (bid) REFERENCES bill (id) ON DELETE CASCADE ON UPDATE CASCADE;
  
  ALTER TABLE user
  ADD CONSTRAINT user_ibfk_1 FOREIGN KEY (board_id) REFERENCES board (board_id) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT user_ibfk_2 FOREIGN KEY (board_name) REFERENCES board (board_name) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;