-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 03:53 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coralis_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT 'default.png',
  `password` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `email`, `image`, `password`, `is_active`, `created_at`) VALUES
(20, 'user1edit', 'gimpact20211@gmail.com', 'megu.jpg', '$2y$10$xLA5uidCgydgaLHAKFQ7j.ScFXf4uMvSGPALhpbCvVdOaggYwcdkO', 1, 1681219838),
(21, 'user2edit', 'gimpact20212@gmail.com', '0867c25d32b27f0fb3b58e9b99112ed0.jpg', '$2y$10$Wb1OjHOKIBOlYmkEjf.FWeqUNAJLGjkqHaHcrsHGrRaygWrdqdRCi', 1, 1681220301),
(23, 'testing2edit', 'gimpact20213@gmail.com', '245c4a2477dc0c919f49b5556782b314.png', '$2y$10$jFhO9NgE3dZLw8J6U8.bhemOoEYZkOsfbHk4lA89glLDuWOCVep36', 1, 1681221153);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(13, 'gimpact20211@gmail.com', '6/NE+evhlw0xf2sI/WK1Eq+UBxPbbM7a0FckfCjcj/w=', 1681219980),
(14, 'gimpact20211@gmail.com', 'WtQTIvAaiQfkHS7zjxKWe9HTRWw9UG5MBRcn6iyrWiw=', 1681220054),
(15, 'gimpact20211@gmail.com', 'q0KG/2CVtZs+46Ei+BiNe+k14UFYw1z6IoIDC/HFUdo=', 1681220194),
(17, 'gimpact20212@gmail.com', 'q4bJuLGHmEG6PHBys5eUXGrBdDqoi6ZuDFi1q8xSNcM=', 1681220334);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
