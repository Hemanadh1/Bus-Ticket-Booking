-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2024 at 08:03 PM
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
-- Database: `bus_ticket_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bookings`
--

CREATE TABLE `Bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Bookings`
--

INSERT INTO `Bookings` (`booking_id`, `user_id`, `schedule_id`, `booking_date`, `status`) VALUES
(1, 4, 2, '2024-06-25', 'ok'),
(2, 4, 2, '2024-06-25', 'ok'),
(14, 4, 2, '2024-07-13', 'ok'),
(16, 6, 3, '2024-07-14', 'ok'),
(17, 4, 1, '2024-07-14', 'ok'),
(18, 6, 5, '2024-07-14', 'ok'),
(23, 6, 5, '2024-07-15', 'ok'),
(24, 8, 3, '2024-07-15', 'ok'),
(25, 4, 3, '2024-07-15', 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `Buses`
--

CREATE TABLE `Buses` (
  `bus_id` int(11) NOT NULL,
  `bus_number` varchar(50) DEFAULT NULL,
  `bus_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Buses`
--

INSERT INTO `Buses` (`bus_id`, `bus_number`, `bus_type`) VALUES
(1, 'AB1000', 'AC'),
(2, 'AB1001', 'AC'),
(3, 'AB1002', 'AC'),
(4, 'AB1003', 'AC'),
(5, 'AB1004', 'AC'),
(6, 'AB1005', 'AC'),
(7, 'AB1006', 'AC'),
(8, 'AB1007', 'AC'),
(9, 'AB1008', 'AC'),
(10, 'AB1009', 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `Passengers`
--

CREATE TABLE `Passengers` (
  `Passenger_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `seat_number` varchar(10) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Passengers`
--

INSERT INTO `Passengers` (`Passenger_id`, `booking_id`, `seat_number`, `name`, `gender`, `age`) VALUES
(1, 1, '10', 'preetham', 'male', 18),
(2, 2, '12', 'rohan', 'male', 14),
(25, 14, '17', 'raja', 'male', 26),
(26, 14, '18', 'rana', 'male', 45),
(27, 16, '15', 'amit', 'male', 18),
(28, 16, '16', 'arjun', 'male', 19),
(29, 17, '17', 'rutwik', 'male', 20),
(30, 18, '11', 'Leo Das', 'male', 35),
(31, 18, '12', 'Harold Das', 'male', 55),
(40, 23, '13', 'rutwik', 'male', 19),
(41, 24, '9', 'karthik', 'male', 19),
(42, 24, '10', 'rutwik', 'male', 20),
(43, 24, '12', 'eswar', 'male', 19),
(44, 25, '21', 'siddharth', 'male', 22),
(45, 25, '22', 'satwik', 'male', 21);

-- --------------------------------------------------------

--
-- Table structure for table `Routes`
--

CREATE TABLE `Routes` (
  `route_id` int(11) NOT NULL,
  `origin` varchar(100) DEFAULT NULL,
  `destination` varchar(100) DEFAULT NULL,
  `distance` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Routes`
--

INSERT INTO `Routes` (`route_id`, `origin`, `destination`, `distance`) VALUES
(1, 'hyderabad', 'vizag', 650.00),
(2, 'vizag', 'hyderabad', 650.00),
(3, 'hyderabad', 'chennai', 635.00),
(4, 'chennai', 'hyderabad', 635.00),
(5, 'vizag', 'chennai', 800.00),
(6, 'chennai', 'vizag', 800.00);

-- --------------------------------------------------------

--
-- Table structure for table `Schedules`
--

CREATE TABLE `Schedules` (
  `schedule_id` int(11) NOT NULL,
  `bus_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Schedules`
--

INSERT INTO `Schedules` (`schedule_id`, `bus_id`, `route_id`, `departure_time`, `arrival_time`, `date`) VALUES
(1, 1, 2, '22:00:00', '13:00:00', '2024-06-25'),
(2, 4, 2, '21:15:00', '11:00:00', '2024-06-25'),
(3, 7, 2, '21:45:00', '11:30:00', '2024-06-25'),
(4, 10, 2, '23:05:00', '12:50:00', '2024-06-25'),
(5, 6, 3, '21:30:00', '10:45:00', '2024-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `user_name`, `password`, `email`) VALUES
(4, 'ukn', '$2y$10$qYijsqiP.Kt02b9JHyqxKu0PEEAvyvWhOpiNk0LRn0B4rVA7mwm1.', 'ukn@gmail.com'),
(6, 'Rutwik_B', '$2y$10$zu8QElJPJ3GnpiYx3bkbrefr6mRbT1HE7VNN3Nhoz4a9HxRcYz/p.', 'rutwi163@gmail.com'),
(7, 'eswar', '$2y$10$Lux08KsGtaf32zvbYdObx.wD1EkrH9WNW1j/1XZNTI55zq6SfjZPy', 'abc@gmail.com'),
(8, 'karthik_K', '$2y$10$JELJYizFP/KmIUpuwSxjN.yBbJWx/vBto0P6e2U.WWwU4LwtNewBS', 'karthik123@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indexes for table `Buses`
--
ALTER TABLE `Buses`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `Passengers`
--
ALTER TABLE `Passengers`
  ADD PRIMARY KEY (`Passenger_id`),
  ADD UNIQUE KEY `seat_number_booking` (`seat_number`,`booking_id`),
  ADD KEY `Passengers_ibfk_1` (`booking_id`);

--
-- Indexes for table `Routes`
--
ALTER TABLE `Routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `Schedules`
--
ALTER TABLE `Schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Bookings`
--
ALTER TABLE `Bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `Buses`
--
ALTER TABLE `Buses`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Passengers`
--
ALTER TABLE `Passengers`
  MODIFY `Passenger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `Routes`
--
ALTER TABLE `Routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Schedules`
--
ALTER TABLE `Schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD CONSTRAINT `Bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `Bookings_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `Schedules` (`schedule_id`);

--
-- Constraints for table `Passengers`
--
ALTER TABLE `Passengers`
  ADD CONSTRAINT `Passengers_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `Bookings` (`booking_id`);

--
-- Constraints for table `Schedules`
--
ALTER TABLE `Schedules`
  ADD CONSTRAINT `Schedules_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `Buses` (`bus_id`),
  ADD CONSTRAINT `Schedules_ibfk_2` FOREIGN KEY (`route_id`) REFERENCES `Routes` (`route_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
