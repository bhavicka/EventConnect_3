-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 10:45 AM
-- Server version: 8.0.34
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nirma`
--

-- --------------------------------------------------------

--
-- Table structure for table `createevent`
--

CREATE TABLE `createevent` (
  `EventID` int NOT NULL,
  `EventName` varchar(100) NOT NULL,
  `EventDate` date NOT NULL,
  `EventTime` time NOT NULL,
  `EventLocation` varchar(255) NOT NULL,
  `Venue` varchar(255) NOT NULL,
  `TicketPrice` decimal(10,2) NOT NULL,
  `EventDescription` text NOT NULL,
  `OrganizerName` varchar(100) NOT NULL,
  `OrganizerEmail` varchar(100) NOT NULL,
  `EventCapacity` int NOT NULL,
  `RegistrationDeadline` datetime NOT NULL,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `eventImage` mediumblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `createevent`
--

INSERT INTO `createevent` (`EventID`, `EventName`, `EventDate`, `EventTime`, `EventLocation`, `Venue`, `TicketPrice`, `EventDescription`, `OrganizerName`, `OrganizerEmail`, `EventCapacity`, `RegistrationDeadline`, `CreatedAt`, `eventImage`) VALUES
(23, 'Ashwamegh', '2024-12-12', '12:12:00', 'Uttar Pradesh', 'Ayodhya', '120.00', 'Jai Shree Ram', '0', 'Mihirvyas6401@gmail.com', 898, '2026-12-12 12:12:00', '2024-04-21 05:57:47', 0x75706c6f6164732f4949542e6a7067),
(29, 'Piyush Mishra Concert', '2024-05-23', '11:00:00', 'Mumbai, Maharashtra', 'Jio Gardens, Worli', '50000.00', 'Live concert at Jio Gardens, Worli ', '0', 'hetvyas3367@gmail.com', 3500, '2024-05-01 23:00:00', '2024-04-21 07:30:46', 0x75706c6f6164732f5069797573684d69736872612e6a7067),
(31, 'The Comedy Factory Lavari', '2024-05-30', '23:00:00', 'Rajkot', 'Hemu Gadhvi Hall, Rajkot', '800.00', 'TCF Live Show', '0', 'hetvyas3367@gmail.com', 1000, '2024-05-20 23:00:00', '2024-04-21 07:33:50', 0x75706c6f6164732f5443462e6a706567);

-- --------------------------------------------------------

--
-- Table structure for table `organizers`
--

CREATE TABLE `organizers` (
  `organizer_id` int NOT NULL,
  `organization` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `location` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `organizers`
--

INSERT INTO `organizers` (`organizer_id`, `organization`, `email`, `mobile`, `location`, `password`) VALUES
(1, 'Mihir', 'mihirvyas6487@gmail.com', '7698861000', 'Virar, Mumbai', '$2y$10$g37TI/WyMC7MRkaK9usihe95o99EQAgBsr3jGtoSK4tv9coUfTP9.');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `registration_id` int NOT NULL,
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  `registration_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Organizer','User') NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `location` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `role`, `fullname`, `lastname`, `mobile`, `location`, `gender`, `username`) VALUES
(1, 'Mihirvyas6487@gmail.com', '$2y$10$GLdnXDqtRfkejk7jBhhpHu7U7tsxow84y56Tsali8iNH/tDz5j8Y2', 'Organizer', 'Mihir', 'Vyas', '9359215647', 'Rajkot', 'Male', NULL),
(2, 'joshijayc075@gmail.com', '$2y$10$uJyDme3nnZwDHKKnK9C5i.b0lOMkKqyhB0REvEaWx8bJs4BtfUdDq', 'Organizer', 'Drashti', 'Makwana', '6358830730', 'Rajkot', 'Female', 'Drashti1505');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `createevent`
--
ALTER TABLE `createevent`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `organizers`
--
ALTER TABLE `organizers`
  ADD PRIMARY KEY (`organizer_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `createevent`
--
ALTER TABLE `createevent`
  MODIFY `EventID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `organizers`
--
ALTER TABLE `organizers`
  MODIFY `organizer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `registration_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
