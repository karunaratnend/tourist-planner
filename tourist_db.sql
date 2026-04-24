-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2026 at 06:50 AM
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
-- Database: `tourist_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `distance` decimal(5,2) NOT NULL,
  `opening_hours` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `map_link` varchar(255) NOT NULL,
  `popularity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `category`, `description`, `distance`, `opening_hours`, `image`, `map_link`, `popularity`) VALUES
(1, 'Mount Lavinia Beach', 'Beach', 'A beautiful and popular beach located close to Moratuwa, known for its golden sand and relaxing ocean views. It is a perfect place to enjoy sunsets, take a walk along the shore, and experience the calm sea breeze. Visitors often come here for swimming, photography, and spending quality time with friends and family.', 8.00, 'Open all day', 'images/mountlavineabeach.jpg', 'https://maps.google.com/?q=Mount+Lavinia+Beach', 9),
(2, 'Dehiwala Zoological Garden', 'Wildlife', 'One of the oldest and most well-known zoos in Sri Lanka, featuring a wide variety of animals including elephants, lions, birds, and reptiles. It is a family-friendly destination that offers educational and recreational experiences, especially for children and nature lovers.', 10.00, '8:30 AM - 6:00 PM', 'images/dehiwalazoo.jpg', 'https://maps.google.com/?q=Dehiwala+Zoo', 8),
(3, 'Galle Face Green', 'Recreation', 'A famous oceanfront public park in Colombo where people gather to relax, enjoy street food, and watch the sunset. It is a lively location filled with kites, snacks, and a refreshing sea breeze, making it ideal for evening visits and social gatherings.', 17.00, 'Open all day', 'images/gallefacegreen.jpg', 'https://maps.google.com/?q=Galle+Face+Green', 10),
(4, 'Lotus Tower', 'Modern', 'The tallest structure in South Asia, offering breathtaking panoramic views of Colombo city. The tower includes observation decks, restaurants, and entertainment facilities. It is a modern attraction and a symbol of Sri Lanka’s development.', 19.00, '10:00 AM - 10:00 PM', 'images/lotustower.jpg', 'https://maps.google.com/?q=Lotus+Tower+Colombo', 9),
(5, 'Viharamahadevi Park', 'Nature', 'The largest park in Colombo, filled with greenery, walking paths, and relaxing spaces. It is a peaceful place for families, joggers, and nature lovers. The park also has children’s play areas and beautiful trees that provide shade.', 18.00, '6:00 AM - 6:00 PM', 'images/viharamahadevipark.jpg', 'https://maps.google.com/?q=Viharamahadevi+Park', 7),
(6, 'Independence Square', 'Historical', 'A historical landmark built to commemorate Sri Lanka’s independence from colonial rule. The area is peaceful and surrounded by gardens, making it a great place for walking, relaxing, and learning about the country’s history.', 17.00, 'Open all day', 'images/independencesquare.jpg', 'https://maps.google.com/?q=Independence+Square+Colombo', 8),
(7, 'Colombo National Museum', 'Cultural', 'The largest museum in Sri Lanka, showcasing important historical artifacts, royal items, and cultural exhibits. It provides visitors with deep insights into Sri Lanka’s rich heritage and history.', 18.00, '9:00 AM - 5:00 PM', 'images/nationalmuseum.jpg', 'https://maps.google.com/?q=Colombo+National+Museum', 8),
(8, 'Red Mosque', 'Religious', 'A famous mosque known for its unique red and white striped architecture. Located in Pettah, it is both a religious place and a popular tourist attraction admired for its design and cultural importance.', 20.00, 'Open during visiting hours', 'images/redmosque.jpg', 'https://maps.google.com/?q=Jami+Ul+Alfar+Mosque', 7),
(9, 'Diyatha Uyana', 'Nature', 'A beautiful park located near Diyawanna Lake, offering scenic views, walking paths, and a peaceful environment. It is popular for evening visits, street food, and relaxing by the water.', 17.00, 'Open all day', 'images/diyathauyana.jpg', 'https://maps.google.com/?q=Diyatha+Uyana', 8),
(10, 'Puppet Art Museum', 'Cultural', 'A unique cultural museum that preserves traditional Sri Lankan puppet art. Visitors can learn about local storytelling traditions and see handcrafted puppets used in performances.', 10.00, '9:00 AM - 4:00 PM', 'images/puppetartmuseum.jpg', 'https://maps.google.com/?q=Puppet+Art+Museum+Colombo', 6),
(11, 'Wax Museum Colombo', 'Entertainment', 'A museum displaying lifelike wax figures of famous international and Sri Lankan personalities. It offers a fun and interactive experience for visitors who enjoy photography and entertainment.', 15.00, '9:00 AM - 9:00 PM', 'images/waxmuseum.jpg', 'https://maps.app.goo.gl/sjexXNAWQEsm1L2a6', 7),
(13, 'Aluthkade Street Food Area', 'Food', 'A vibrant street food destination where visitors can experience a variety of Sri Lankan local foods. It is famous for its flavors, busy atmosphere, and affordable food options.', 21.00, '10:00 AM - 12:00 AM', 'images/aluthkadestreetfoodarea.jpg', 'https://maps.app.goo.gl/xbC5cyBMKnk9x7dH6', 7),
(14, 'Richmond Castle', 'Heritage', 'A historic mansion known for its unique architecture and beautiful gardens. It reflects colonial-era design and offers a glimpse into Sri Lanka’s past.', 29.00, '8:00 AM - 4:00 PM', 'images/richmondcastle.jpg', 'https://maps.app.goo.gl/EuT5jTSPgEvZX2ZeA', 7),
(15, 'ITC Ratnadipa', 'Modern Landmark', 'A modern luxury hotel and architectural landmark in Colombo. It attracts visitors due to its elegant design, high-end facilities, and scenic surroundings.', 18.00, 'Have specific hours for each venue ', 'images/itcratnadipa.jpg', 'https://maps.app.goo.gl/qtq1PCbuPyeaFUgA6', 9),
(16, 'Port City Colombo', 'Modern Development', 'A newly developed modern city area built on reclaimed land. It features wide roads, ocean views, and futuristic infrastructure, making it a popular place for walking and sightseeing.A newly developed modern city area built on reclaimed land. It features wide roads, ocean views, and futuristic infrastructure, making it a popular place for walking and sightseeing.', 20.00, 'Have specific hours for each venue', 'images/portcity.jpg', 'https://maps.app.goo.gl/QhYUHiXvFs4poafr8', 9);

-- --------------------------------------------------------

--
-- Table structure for table `place_images`
--

CREATE TABLE `place_images` (
  `id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `place_images`
--

INSERT INTO `place_images` (`id`, `place_id`, `image_path`) VALUES
(4, 1, 'images/mountlaviniabeach1.jpg'),
(5, 1, 'images/mountlaviniabeach2.jpg'),
(6, 1, 'images/mountlaviniabeach3.jpg'),
(7, 2, 'images/dehiwalazoo1.jpg'),
(8, 2, 'images/dehiwalazoo2.jpg'),
(9, 2, 'images/dehiwalazoo3.jpg'),
(10, 3, 'images/gallefacegreen1.jpg'),
(11, 3, 'images/gallefacegreen2.jpg'),
(12, 3, 'images/gallefacegreen3.jpg'),
(13, 4, 'images/lotustower1.jpg'),
(14, 4, 'images/lotustower2.jpg'),
(15, 4, 'images/lotustower3.jpg'),
(16, 5, 'images/viharamahadevipark1.jpg'),
(17, 5, 'images/viharamahadevipark2.jpg'),
(18, 5, 'images/viharamahadevipark3.jpg'),
(19, 6, 'images/independencesquare1.jpg'),
(20, 6, 'images/independencesquare2.jpg'),
(21, 6, 'images/independencesquare3.jpg'),
(22, 7, 'images/nationalmuseum1.jpg'),
(23, 7, 'images/nationalmuseum2.jpg'),
(24, 7, 'images/nationalmuseum3.jpg'),
(25, 8, 'images/redmosque1.jpg'),
(26, 8, 'images/redmosque2.jpg'),
(27, 8, 'images/redmosque3.jpg'),
(28, 9, 'images/diyathauyana1.jpg'),
(29, 9, 'images/diyathauyana2.jpg'),
(30, 9, 'images/diyathauyana3.jpg'),
(31, 10, 'images/puppetartmuseum1.jpg'),
(32, 10, 'images/puppetartmuseum2.jpg'),
(33, 10, 'images/puppetartmuseum3.jpg'),
(34, 11, 'images/waxmuseum1.jpg'),
(35, 11, 'images/waxmuseum2.jpg'),
(36, 11, 'images/waxmuseum3.jpg'),
(37, 13, 'images/aluthkadestreetfoodarea1.jpg'),
(38, 13, 'images/aluthkadestreetfoodarea2.jpg'),
(39, 13, 'images/aluthkadestreetfoodarea3.jpg'),
(40, 14, 'images/richmondcastle1.jpg'),
(41, 14, 'images/richmondcastle2.jpg'),
(42, 14, 'images/richmondcastle3.jpg'),
(43, 15, 'images/itcratnadipa1.jpg'),
(44, 15, 'images/itcratnadipa2.jpg'),
(45, 15, 'images/itcratnadipa3.jpg'),
(46, 16, 'images/portcity1.jpg'),
(47, 16, 'images/portcity2.jpg'),
(48, 16, 'images/portcity3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `planner_items`
--

CREATE TABLE `planner_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `planner_items`
--

INSERT INTO `planner_items` (`id`, `user_id`, `place_id`) VALUES
(2, 3, 14),
(3, 3, 16),
(4, 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'user', 'user2026', 'user'),
(2, 'admin', 'admin2026', 'admin'),
(3, 'Nilmini', 'nilmini', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `place_images`
--
ALTER TABLE `place_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planner_items`
--
ALTER TABLE `planner_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `place_images`
--
ALTER TABLE `place_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `planner_items`
--
ALTER TABLE `planner_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
