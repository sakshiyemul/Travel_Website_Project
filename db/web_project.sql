-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2025 at 12:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `dest_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `travel_date` date NOT NULL,
  `travelers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `dest_id`, `full_name`, `email`, `phone`, `travel_date`, `travelers`) VALUES
(18, 18, 'Sakshi Yemul', 'sakshiyemul1524@gmail.com', '08208424861', '2025-04-26', 4),
(19, 16, 'Dipti Berad', 'dipti23@gmail.com', '9823789834', '2025-04-15', 8),
(20, 17, 'prerana chavan', 'peru1234@gmail.com', '8756989387', '2025-04-25', 6),
(21, 21, 'Akshada Aware', 'akshu344@gmail.com', '4678993486', '2025-04-10', 2),
(22, 19, 'Siddhi Pagire', 'siddhi56@gmail.com', '7834870934', '2025-04-19', 7),
(23, 24, 'Vaishanavi Bankar', 'vaishuBankar10@gmail.com', '9837846898', '2025-04-29', 3),
(24, 26, 'Shravani Welzile', 'shravani2389@gmail.com', '7645980956', '2025-04-29', 10);

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `dest_id` int(5) NOT NULL,
  `dest_name` text NOT NULL,
  `dest_description` varchar(200) NOT NULL,
  `dest_image` varchar(200) NOT NULL,
  `dest_location` varchar(200) NOT NULL,
  `dest_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`dest_id`, `dest_name`, `dest_description`, `dest_image`, `dest_location`, `dest_price`) VALUES
(14, 'Delhi', 'Delhi – A vibrant mix of history, culture, and modern city life.', 'delhi.jpg', 'New Delhi, India', 6999),
(15, 'Gujrat', 'Gujarat – Land of temples, wildlife, and the stunning White Rann.', 'gujrat.jpg', 'Ahmedabad, Gujarat, India', 7499),
(16, 'Manali', 'Manali – A picturesque hill station with snow-capped peaks, adventure sports.', 'manali.jpg', 'Himachal Pradesh, India', 8000),
(17, 'Mumbai', 'Mumbai – The city of dreams, known for its fast-paced life, iconic landmarks.', 'mumbai.jpg', 'Maharashtra', 6500),
(18, 'Ladakh', 'Ladakh – A land of high passes, stunning landscapes, and serene monasteries.', 'ladakh.jpg', 'Jammu and Kashmir', 12000),
(19, 'karnataka', 'Karnataka – A blend of ancient ruins, lush hills, and vibrant cities, rich in heritage and nature.', 'karnataka.jpg', 'South India', 8000),
(20, 'Punjab', 'Punjab – Land of lively culture, golden fields, and heartfelt hospitality.', 'punjab.jpg', 'North India', 6500),
(21, 'jaypur', 'Jaipur – The Pink City, rich in royal palaces, vibrant bazaars, and heritage charm.', 'jaypur.jpg', 'Rajasthan,North-West India', 7200),
(22, 'Bhimashankar', 'Bhimashankar – A serene pilgrimage site nestled in the Sahyadri hills.', 'bhimashankar.jpg', 'Maharashtra,Western India', 3800),
(23, 'Rishikesh', 'Rishikesh – The yoga capital of the world, famous for spiritual retreats, Ganga aarti.', 'rishikesh.jpg', 'Uttarakhand,Northern India', 4200),
(24, 'Jammu & Kashmir', 'Jammu & Kashmir – Heaven on Earth, known for its breathtaking valleys.', 'jammu&kashmir.jpg', 'Northernmost region of India', 7500),
(26, 'Odisha', 'Odisha – A land of ancient temples, tribal culture, and serene beaches like Puri and Chandipur.', 'odisha.jpg', 'Eastern India', 5500);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(233) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `fullname`, `email`, `password`) VALUES
(7, 'Sakshi Yemul', 'sakshiyemul1524@gmail.com', '$2y$10$Lz3yu0h/XNOFd5HGnXkkUeTTZaR60Bmoq8NrWdCNuNJXgjhSvHgfi'),
(8, 'Dipti Berad', 'dipti23@gmail.com', '$2y$10$ukr3wtvQ1Kr47UAOZlDuv.iE3e0FpnOXTG6oyhG5IndCzxgM7ElH6'),
(9, 'prerana chavan', 'peru1234@gmail.com', '$2y$10$YLn9u/R/4zmLKR/whioAAuEv0.nvnBr7fzcQVluG2yl7XWTxtuwaG'),
(10, 'Akshada Aware', 'akshu344@gmail.com', '$2y$10$/0/OzirLwCRox195aJJ.cO9eeTcZPzb4pXnjmx2zPETrE9aPt6pIy'),
(11, 'Siddhi Pagire', 'siddhi56@gmail.com', '$2y$10$lqmEVNBSMbIQXOvm.F/MTuAAWGmZukS.xkmiOj.EskVXert507tsW'),
(12, 'Vaishanavi Bankar', 'vaishuBankar10@gmail.com', '$2y$10$SxrHRG.Upw.xgMemcoQDrertml7hVjAxH/L7C0hFiVv8vntt4JrSa'),
(13, 'Shravani Welzile', 'shravani2389@gmail.com', '$2y$10$elkjbUpPXhLMsMPgD5uqLuD9L2JbsRnUA5nYI6ffy2zvXSVmXn3AK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`dest_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `dest_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
