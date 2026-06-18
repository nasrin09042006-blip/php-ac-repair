-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2023 at 07:00 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `acrss_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_list`
--

CREATE TABLE `book_list` (
  `id` bigint(30) NOT NULL,
  `code` varchar(50) NOT NULL,
  `fullname` text NOT NULL,
  `contact` text NOT NULL,
  `email` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_list`
--

INSERT INTO `book_list` (`id`, `code`, `fullname`, `contact`, `email`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, '', 'Mark Cooper', '09123456789', 'mcooper@mail.com', 'Sample Address', 0, '2023-04-28 10:56:47', '2023-04-28 11:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `book_services`
--

CREATE TABLE `book_services` (
  `id` bigint(30) NOT NULL,
  `book_id` bigint(30) NOT NULL,
  `service_id` bigint(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_services`
--

INSERT INTO `book_services` (`id`, `book_id`, `service_id`) VALUES
(0, 1, 1),
(0, 1, 2),
(0, 1, 1),
(0, 1, 2),
(0, 1, 1),
(0, 1, 2),
(0, 1, 1),
(0, 1, 2),
(0, 1, 1),
(0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_list`
--

CREATE TABLE `inquiry_list` (
  `id` bigint(30) NOT NULL,
  `fullname` text NOT NULL,
  `contact` text NOT NULL,
  `email` text NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiry_list`
--

INSERT INTO `inquiry_list` (`id`, `fullname`, `contact`, `email`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mark Cooper', '09123456789', 'mcooper@mail.com', 'Sample address', 1, '2023-04-28 11:25:07', '2023-04-28 11:29:02');

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

CREATE TABLE `service_list` (
  `id` bigint(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` float(12,2) NOT NULL DEFAULT 0.00,
  `image_path` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`id`, `name`, `description`, `price`, `image_path`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AC Split Type Repair', '&lt;p&gt;nasrin nasrin, consectetur adipiscing elit. Aenean nec mi vitae nisl vehicula tempus. Aliquam nec tempor dui, id condimentum est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec venenatis nulla vel tellus porta, ut pellentesque elit semper.&lt;/p&gt;\r\n&lt;p&gt;Duis finibus vel elit id posuere. Phasellus et varius orci. Nunc sollicitudin semper lectus, eu lacinia turpis dictum ac. Nulla nec felis vitae diam eleifend accumsan eget elementum orci. Maecenas vitae tristique ex, venenatis ornare sapien. Donec mattis gravida leo, ut iaculis mauris scelerisque vel.&lt;/p&gt;\r\n&lt;p&gt;Phasellus augue lectus, ultrices ac nisi ut, elementum vestibulum lorem. Curabitur leo velit, fringilla non mi quis, congue facilisis ex. Nunc hendrerit lectus in ante elementum, sit amet tempor lectus aliquet.&lt;/p&gt;', 3800.00, 'uploads/services/1.png?v=1682645421', 1, '2023-04-28 09:30:20', '0000-00-00 00:00:00'),
(2, 'AC Window Type Repair', '&lt;p&gt;Sed non lacus quis sapien cursus volutpat. Nam dignissim nulla pretium, sodales nunc vitae, iaculis nulla. Curabitur erat sapien, mattis vitae consectetur imperdiet, ultrices sed magna. Phasellus vel porttitor nisi. Maecenas ac ipsum ligula. Aliquam erat volutpat. Fusce eget urna nisl.&lt;/p&gt;\r\n&lt;p&gt;Sed ante sem, rutrum vitae elit sed, facilisis pharetra purus. Mauris dictum metus sed massa bibendum tempor. Sed quis elementum metus, ac euismod enim. Curabitur semper nisi justo, id faucibus nisi sagittis eget. Pellentesque mollis metus ut auctor pulvinar.&lt;/p&gt;\r\n&lt;p&gt;Aliquam malesuada eleifend eleifend. Curabitur pulvinar vehicula augue eu tincidunt. Aliquam accumsan metus ac eros pulvinar elementum.&lt;/p&gt;', 2500.00, 'uploads/services/2.png?v=1682646346', 1, '2023-04-28 09:45:46', '0000-00-00 00:00:00'),
(3, 'Central AC Repair', '&lt;p&gt;Donec mi mi, ullamcorper posuere leo et, faucibus ultrices sapien. Donec rhoncus sem lacinia, vestibulum metus a, blandit purus. Integer massa felis, pretium at nulla ut, tempor tempus mi. Pellentesque tincidunt sem sit amet maximus ultrices. Aliquam fringilla vitae dui vitae dapibus.&lt;/p&gt;\r\n&lt;p&gt;Cras aliquet risus eget nisi imperdiet convallis. Cras sit amet massa a nunc hendrerit suscipit. Nulla sapien ipsum, faucibus condimentum scelerisque at, facilisis ac metus. Mauris pretium lacinia dui, ac vehicula lectus scelerisque sed. Donec convallis eros enim, et finibus metus faucibus et.&lt;/p&gt;', 4500.00, 'uploads/services/3.png?v=1682646441', 1, '2023-04-28 09:47:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'AC Repair and Services System'),
(6, 'short_name',' ICY - NEST '),
(11, 'logo', 'uploads/logo.png?v=1682644082'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1682644550'),
(17, 'phone', '456-888-111'),
(18, 'mobile', '09456555112'),
(19, 'email', 'info@acrepairaservice.com'),
(20, 'address', '553 Haul Road, Mountain View, CA, 94041');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='2';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', '', 'Admin', 'admin', '$2y$10$lu9Lz9d61nsRRq5aXGOrmuik6tzhMif.AIQTmxgj4LTHf3M9hyGtW', 'uploads/avatars/1.png?v=1678760026', NULL, 1, '2021-01-20 14:02:37', '2023-04-26 16:01:02'),
(9, 'Claire', '', 'Blake', 'cblake', '$2y$10$DFEet3AmXnsVKls912SbHey87bsXauL7nannya2CjtV7m37dNZhNe', 'uploads/avatars/9.png?v=1682495668', NULL, 2, '2023-04-26 15:54:27', '2023-04-26 16:02:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_list`
--
ALTER TABLE `book_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_services`
--
ALTER TABLE `book_services`
  ADD KEY `book_id_fk` (`book_id`),
  ADD KEY `service_id_fk` (`service_id`);

--
-- Indexes for table `inquiry_list`
--
ALTER TABLE `inquiry_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_list`
--
ALTER TABLE `service_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
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
-- AUTO_INCREMENT for table `book_list`
--
ALTER TABLE `book_list`
  MODIFY `id` bigint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inquiry_list`
--
ALTER TABLE `inquiry_list`
  MODIFY `id` bigint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_list`
--
ALTER TABLE `service_list`
  MODIFY `id` bigint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_services`
--
ALTER TABLE `book_services`
  ADD CONSTRAINT `book_id_fk` FOREIGN KEY (`book_id`) REFERENCES `book_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `service_id_fk` FOREIGN KEY (`service_id`) REFERENCES `service_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;
