-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2023 at 06:43 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoesence`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(100) NOT NULL,
  `admin_Name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_phoneNo` int(12) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `admin_Name`, `admin_email`, `admin_phoneNo`, `admin_password`) VALUES
(1, 'Admin 1', 'admin@mail.com', 751234567, 'c129b324aee662b04eccf68babba85851346dff9'),
(3, 'Admin 2', 'admin2@mail.com', 712345678, '7c222fb2927d828af22f592134e8932480637c0d');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_ID` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_qty` int(100) NOT NULL,
  `prouduct_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_ID`, `user_id`, `product_id`, `product_name`, `product_price`, `product_qty`, `prouduct_image`) VALUES
(33, 5, 14, 'Outdoor Sleeper', 2350, 1, 'sleeper.jpg'),
(34, 5, 5, 'SWIFT RUN 22', 3500, 1, 'p6-1.jpg'),
(35, 5, 10, 'WOSH 3.0', 10000, 1, 'p-1.webp');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `m_ID` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `sender_name` varchar(100) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `sender_phoneNo` int(10) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `message_date` date NOT NULL,
  `reply` varchar(1000) NOT NULL,
  `reply_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`m_ID`, `user_id`, `sender_name`, `sender_email`, `sender_phoneNo`, `message`, `message_date`, `reply`, `reply_time`) VALUES
(2, 0, 'Rameez', 'ram@mail.com', 741234567, 'Hello How are you ', '2023-06-25', 'Hello', '2023-06-30'),
(5, 0, 'Rameez', 'ram@mail.com', 741234567, 'How many days take to receive product?', '2023-06-30', ' 10 days Sir', '2023-06-30'),
(6, 0, 'Rameez', 'ram2@mail.com', 712345678, 'Hiii Tesing', '2023-07-02', '', '0000-00-00'),
(7, 8, 'Rameez', 'ram2@mail.com', 712345600, 'Hi testing\r\n', '2023-07-02', 'Hi test success', '2023-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_ID` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_Name` varchar(255) NOT NULL,
  `phone_No` int(12) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `deleivery_status` varchar(100) NOT NULL,
  `estimated_delivery` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_ID`, `user_id`, `user_Name`, `phone_No`, `user_email`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `deleivery_status`, `estimated_delivery`) VALUES
(1, 6, 'Rameezz', 111234567, 'rameez@mail.com', '63, Uyan, Dewan, 12345', 'Air 1 (10000 x 1) - WIDE GOLF SHOES (1 x 1) - ', 11000, '2023-06-25', 'Complete', 'Dropped off', '2023-07-05'),
(2, 5, 'Rameez ', 2147483647, 'roy1@mail.com', '63, Uyanwatta, Dewanagala, 0000000', 'SWIFT RUN 22 (3500 x 1) - RUN 4.0 (5500 x 1) - ', 3850, '2023-06-28', 'Complete', 'Dropped off', '2023-07-08'),
(4, 5, 'Rameez ', 2147483647, 'roy1@mail.com', '63, Uyanwatta, Dewanagala, 0000000', 'HIKER COLD.RDY HIKING BOOTS (5500 x 1),  WOSH 3.0 (10000 x 1),  ', 6050, '2023-06-28', 'Complete', 'Dropped off', '2023-07-08'),
(11, 7, 'Rameez', 761234567, 'ram@mail.com', '63, Uyanwatta, Dewanagla, 71527', 'SWIFT RUN 22 (3500 x 2),  WOSH 3.0 (10000 x 1),  ', 7000, '2023-06-30', 'Complete', 'Shipped', '2023-07-10'),
(18, 8, 'Rameez2', 711234567, 'ram2@mail.com', '63, Mawanella , Uyanwatta, 12333', 'WOSH 3.0 (10000 x 1),  ', 11000, '2023-07-02', 'Complete', '', '2023-07-12'),
(19, 8, 'Rameez2', 711234567, 'ram2@mail.com', '63, Mawanella , Uyanwatta, 12333', 'SWIFT RUN 22 (3500 x 3),  HIKER COLD.RDY HIKING BOOTS (5500 x 1),  ', 17600, '2023-07-02', 'Complete', '', '2023-07-12'),
(20, 8, 'Rameez2', 711234567, 'ram2@mail.com', '63, Mawanella , Uyanwatta, 12333', 'HIKER COLD.RDY HIKING BOOTS (5500 x 1),  RUN 4.0 (5500 x 3),  ', 24200, '2023-07-02', 'Complete', 'Shipped', '2023-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pID` int(100) NOT NULL,
  `pName` varchar(255) NOT NULL,
  `pBrand` varchar(100) NOT NULL,
  `pPrice` int(100) NOT NULL,
  `pSize` int(10) NOT NULL,
  `pTargetGroup` varchar(100) NOT NULL,
  `pCategory` varchar(100) NOT NULL,
  `pDescription` varchar(1000) NOT NULL,
  `pImage1` varchar(100) NOT NULL,
  `pImage2` varchar(100) NOT NULL,
  `pImage3` varchar(100) NOT NULL,
  `pImage4` varchar(100) NOT NULL,
  `pImage5` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pID`, `pName`, `pBrand`, `pPrice`, `pSize`, `pTargetGroup`, `pCategory`, `pDescription`, `pImage1`, `pImage2`, `pImage3`, `pImage4`, `pImage5`) VALUES
(4, 'FORUM MID SHOES', 'Adidas', 4000, 7, 'Men', 'Sneakers', 'FORUM MID SHOES\r\nLUXE MID-CUT TRAINERS WITH HOOPS DNA.\r\nLet&#39;s take a moment to honour an icon. Is it the gravity-defying B-ball legend from the &#39;80s? Or perhaps the status shoe that adorned the feet of rappers? Both, in fact. The adidas Forum shoes have dominated the hardwood and the streets, and they&#39;re back in a mid top version to take your moves to the next level. Slip into the unmistakable style, now in luxurious coated leather, and flaunt that pure class', 'p4 -1.jpg', 'p4 -2.jpg', 'p4 -3.jpg', 'p4 -4.jpg', 'p4 -5.jpg'),
(5, 'SWIFT RUN 22', 'Adidas', 3500, 5, 'Kids', 'Running', 'SWIFT RUN 22 SHOES\r\nCOMFY AND STYLISH RUNNERS MADE IN PART WITH RECYCLED MATERIALS.\r\nRemember the first pair of shoes you fell in love with? Relive the memory every day in these juniors&#39; adidas Swift Run 22 Shoes. Rooted in running but designed for the daily grind, these trainers keep you comfortable with a supportive knit mesh upper and a cushioned EVA midsole. Oh, and they look good too. Win win. Made with a series of recycled materials, this upper features at least 50% recycled content. This product represents just one of our solutions to help end plastic waste.', 'p6-1.jpg', 'p6-2.jpg', 'p6-3.jpg', 'p6-4.jpg', 'p6-5.jpg'),
(6, 'HIKER COLD.RDY HIKING BOOTS', 'Adidas', 5500, 6, 'Women', 'Running', 'TERREX FREE HIKER COLD.RDY HIKING BOOTS\r\nWATERPROOF, INSULATED HIKING BOOTS MADE IN PART WITH RECYCLED CONTENT.\r\nThere&#39;s no such thing as too cold and wet when you have these women&#39;s Terrex Free Hiker COLD.RDY Hiking Boots on your feet. Part lightweight hiker and part winter boot, they combine the foot-hugging comfort of an adidas PRIMEKNIT upper with the energised feel of BOOST in a durable and rugged yet light design. GORE-TEX Duratherm seals out snow, slush and water to keep your feet dry as you navigate snowy trails or muddy terrain. COLD.RDY offers low-profile insulation with heat-sealing warmth for comfy feet. An internal frame adds the support you need to move across rough terrain with confidence, and the Continental™ Rubber outsole brings traction to wet and icy ground.', 'p5-1.jpg', 'p5-2.jpg', 'p5-3.jpg', 'p5-4.jpg', 'p5-5.jpg'),
(10, 'WOSH 3.0', 'Nike', 10000, 9, 'Men', 'Running', 'Lace up for a run through the park or a walk to the coffee shop in these versatile adidas running shoes. They feel good from the minute you step in, thanks to the cushy Cloudfoam midsole. The textile upper feels comfy and breathable, and the rubber outsole gives you plenty of grip for a confident stride. Made with a series of recycled materials, this upper features at least 50% recycled content. This product represents just one of our solutions to help end plastic waste.', 'p-1.webp', 'p-3.webp', 'p-2.webp', 'p-4.webp', 'p5.webp'),
(11, 'RUNFALCON 3.0 SHOES', 'Adidas', 4999, 6, 'Men', 'Running', 'Lace up for a run through the park or a walk to the coffee shop in these versatile adidas running shoes. They feel good from the minute you step in, thanks to the cushy Cloudfoam midsole. The textile upper feels comfy and breathable, and the rubber outsole gives you plenty of grip for a confident stride. Made with a series of recycled materials, this upper features at least 50% recycled content. This product represents just one of our solutions to help end plastic waste.', 'p11-1.jpg', 'p10-4.jpg', 'p10-5.jpg', 'p10-2.jpg', 'p10-3.jpg'),
(12, 'RUN 4.0', 'Adidas', 5500, 7, 'Men', 'Running', 'Lace up for a run through the park or a walk to the coffee shop in these versatile adidas running shoes. They feel good from the minute you step in, thanks to the cushy Cloudfoam midsole. The textile upper feels comfy and breathable, and the rubber outsole gives you plenty of grip for a confident stride. Made with a series of recycled materials, this upper features at least 50% recycled content. This product represents just one of our solutions to help end plastic waste.', 'p12-1.jpg', 'p12-4.jpg', 'p12-5.jpg', 'p12-2.jpg', 'p12-3.jpg'),
(13, 'Shower Sleeper 1.0', 'Adidas', 2000, 6, 'Men', 'Casual', 'Lace up for a run through the park or a walk to the coffee shop in these versatile adidas running shoes. They feel good from the minute you step in, thanks to the cushy Cloudfoam midsole. The textile upper feels comfy and breathable, and the rubber outsole gives you plenty of grip for a confident stride. Made with a series of recycled materials, this upper features at least 50% recycled content. This product represents just one of our solutions to help end plastic waste.', 'chaple.jpg', 'chaple2.jpg', 'chaple3.jpg', 'chaple4.jpg', 'chaple5.jpg'),
(14, 'Outdoor Sleeper', 'Adidas', 2350, 9, 'Men', 'Casual', 'Channel new levels of speed and power in shoes designed for Zion and built for ballers at any level. An adjustable strap up top helps lock your foot in place while a firm midsole supports high-paced play. A wider outsole provides extra stability—perfect for playing on outdoor courts. And the Zion 2 has more Air cushioning than its predecessor, so you&#39;ll get into the clouds easier and land softer.', 'sleeper.jpg', 'sleeper (2).jpg', 'sleeper (4).jpg', 'sleeper (1).jpg', 'sleeper (3).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_ID` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `p_id` int(100) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `review` varchar(255) NOT NULL,
  `rate` int(10) NOT NULL,
  `placed_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_ID`, `user_id`, `p_id`, `user_name`, `review`, `rate`, `placed_on`) VALUES
(2, 1, 5, 'Rameez', 'Very comfortable', 3, '2023-06-30'),
(3, 1, 5, 'Rameez', 'Very comfortable', 5, '2023-06-30'),
(4, 1, 6, 'Rameez', 'Very comfortable', 4, '2023-06-30'),
(5, 1, 4, 'Rameez', 'Confertable to wear', 5, '2023-06-30'),
(6, 6, 6, 'Rameezz', 'Very Durable, I can Wear all-day ', 4, '2023-06-30'),
(7, 8, 13, 'Rameez2', 'Nice', 5, '2023-07-02'),
(8, 8, 12, 'Rameez2', 'Very confertable', 4, '2023-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uID` int(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userAddress` varchar(265) NOT NULL,
  `userPhoneNo` int(10) NOT NULL,
  `userPassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uID`, `userName`, `userEmail`, `userAddress`, `userPhoneNo`, `userPassword`) VALUES
(4, 'Rameez', 'abcd@gmail.com', '63/2,, Uyanwatta,, Deawangala., 71527', 751234567, '1fd3e2d48590185306853b5f5c11d6e1eac35d07'),
(6, 'Rameezz', 'rameez@mail.com', '63, Uyan, Dewan, 12345', 111234567, '5199a765103c8ebac8f43464bfa6a2107eac1176'),
(7, 'Rameez', 'ram@mail.com', '63, Uyanwatta, Dewanagla, 71527', 761234567, '7c222fb2927d828af22f592134e8932480637c0d'),
(8, 'Rameez Muhammadh', 'rameez2@mail.com', '63, Mawanella , Uyanwatta, 12333', 711234567, '7c222fb2927d828af22f592134e8932480637c0d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`m_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`),
  ADD UNIQUE KEY `userPhoneNo` (`userPhoneNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `m_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
