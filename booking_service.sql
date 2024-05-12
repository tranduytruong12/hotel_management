-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 09, 2024 lúc 04:41 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `booking_service`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `birthday` date NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `role` tinyint(1) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `name`, `email`, `phoneNumber`, `birthday`, `avatar`, `role`, `userName`, `password`) VALUES
(1, 'Trung Nghia', 'nghia.admin@gmail.com', '0123456789', '0000-00-00', '', 1, 'admin', '12345');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `apartment`
--

CREATE TABLE `apartment` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `description` varchar(1000) NOT NULL,
  `apartment_img` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `apartment`
--

INSERT INTO `apartment` (`id`, `name`, `address`, `description`, `apartment_img`, `status`, `category_id`) VALUES
(1, 'Palace Sài Gòn', 'Viet Nam', 'Lưu trú tại Palace Hotel Saigon là một lựa chọn đúng đắn khi quý khách đến thăm Bến Nghé.\r\n\r\nkhách sạn sở hữu vị trí đắc địa cách sân bay Sân bay Tân Sơn Nhất 6,93 km.\r\n\r\nkhách sạn nằm cách Saigon Waterbus Station 0,38 km.\r\n\r\nkhách sạn này rất dễ tìm bởi vị trí đắc địa, nằm gần với nhiều tiện ích công cộng.', 'https://www.hoteljob.vn/files/Anh-HTJ-Hong/mau-tam-trang%20tri-giuong-khach-san-dep-nhat-19.jpg', 1, 1),
(2, 'My Villa Airport Hotels', 'ssss', 'My Villa Airport Hotel toạ lạc tại khu vực / thành phố Phường 2.\r\n\r\nkhách sạn sở hữu vị trí đắc địa cách sân bay Sân bay Tân Sơn Nhất 1,54 km.\r\n\r\nkhách sạn nằm cách Saigon Railway Station 3,38 km.\r\n\r\nCó rất nhiều điểm tham quan lân cận như Vườn thú Đại Nam ở khoảng cách 26,65 km, và Cu Chi Tunnels ở khoảng cách 43,14 km.', 'https://miro.medium.com/v2/resize:fit:1200/0*_yh2rAdNEcoWPX_e.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `apartment_has_room`
--

CREATE TABLE `apartment_has_room` (
  `apartment_id` int(10) NOT NULL,
  `room_id` int(10) NOT NULL,
  `price` varchar(20) NOT NULL,
  `image` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `apartment_has_room`
--

INSERT INTO `apartment_has_room` (`apartment_id`, `room_id`, `price`, `image`) VALUES
(1, 1, '1000000', 'https://www.hoteljob.vn/files/Anh-HTJ-Hong/mau-tam-trang%20tri-giuong-khach-san-dep-nhat-19.jpg'),
(1, 2, '2000000', 'http://www.palacesaigon.com/wp-content/uploads/sites/27/2016/06/2024-family-suite-view-1.jpg'),
(1, 3, '10000000', 'https://www.hoteljob.vn/files/Anh-HTJ-Hong/tieu-chi-can-co-trong-thiet-ke-phong-khach-san-1.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `apartment_img`
--

CREATE TABLE `apartment_img` (
  `apartment_id` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `apartment_img`
--

INSERT INTO `apartment_img` (`apartment_id`, `id`, `image`) VALUES
(1, 1, 'https://ik.imagekit.io/tvlk/apr-asset/Ixf4aptF5N2Qdfmh4fGGYhTN274kJXuNMkUAzpL5HuD9jzSxIGG5kZNhhHY-p7'),
(1, 2, 'https://ik.imagekit.io/tvlk/apr-asset/Ixf4aptF5N2Qdfmh4fGGYhTN274kJXuNMkUAzpL5HuD9jzSxIGG5kZNhhHY-p7');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `catagory_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `catagory_name`, `location_id`) VALUES
(1, 'Deluxe', 1),
(2, 'Luxury', 1),
(3, 'Premium', 1),
(18, 'Luxury', 2),
(19, 'Premium', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `location`
--

CREATE TABLE `location` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(1, 'Hồ Chí Minh'),
(2, 'Hà Nội'),
(3, 'Đà Lạt'),
(4, 'Đà Nẵng'),
(5, 'Nha Trang');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(10) NOT NULL,
  `order_date` date NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `total_price` varchar(20) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `is_cart` tinyint(1) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_date`, `fullname`, `phone_number`, `address`, `total_price`, `customer_id`, `is_cart`, `status`) VALUES
(1, '2024-05-03', 'Trần Duy Trường', '0387693816', 'Bình Phước, Việt Nam', '1000000', 1, 0, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_has_room`
--

CREATE TABLE `order_has_room` (
  `id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `room_id` int(10) NOT NULL,
  `apartment_id` int(10) NOT NULL,
  `room_count` int(10) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_has_room`
--

INSERT INTO `order_has_room` (`id`, `order_id`, `room_id`, `apartment_id`, `room_count`, `date`, `status`) VALUES
(1, 1, 1, 1, 1, '2024-05-04', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rating`
--

CREATE TABLE `rating` (
  `id` int(10) NOT NULL,
  `rating_star` int(10) NOT NULL,
  `apartment_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `rating`
--

INSERT INTO `rating` (`id`, `rating_star`, `apartment_id`, `user_id`) VALUES
(1, 5, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_typ`
--

CREATE TABLE `room_typ` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room_typ`
--

INSERT INTO `room_typ` (`id`, `name`) VALUES
(1, 'Phòng 2 người - 1 giường đôi'),
(2, 'Phòng 4 người - 2 giường đôi'),
(3, 'Phòng 2 người - 2 giường đơn\r\n');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `apartment_has_room`
--
ALTER TABLE `apartment_has_room`
  ADD PRIMARY KEY (`apartment_id`,`room_id`),
  ADD KEY `apartment_room_1` (`room_id`);

--
-- Chỉ mục cho bảng `apartment_img`
--
ALTER TABLE `apartment_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apartment_img` (`apartment_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_has_room`
--
ALTER TABLE `order_has_room`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_user` (`user_id`),
  ADD KEY `rating_apartment` (`apartment_id`);

--
-- Chỉ mục cho bảng `room_typ`
--
ALTER TABLE `room_typ`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `apartment`
--
ALTER TABLE `apartment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `apartment_img`
--
ALTER TABLE `apartment_img`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `location`
--
ALTER TABLE `location`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `order_has_room`
--
ALTER TABLE `order_has_room`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `room_typ`
--
ALTER TABLE `room_typ`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `apartment_has_room`
--
ALTER TABLE `apartment_has_room`
  ADD CONSTRAINT `apartment_room` FOREIGN KEY (`apartment_id`) REFERENCES `apartment` (`id`),
  ADD CONSTRAINT `apartment_room_1` FOREIGN KEY (`room_id`) REFERENCES `room_typ` (`id`);

--
-- Các ràng buộc cho bảng `apartment_img`
--
ALTER TABLE `apartment_img`
  ADD CONSTRAINT `apartment_img` FOREIGN KEY (`apartment_id`) REFERENCES `apartment` (`id`);

--
-- Các ràng buộc cho bảng `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_apartment` FOREIGN KEY (`apartment_id`) REFERENCES `apartment` (`id`),
  ADD CONSTRAINT `rating_user` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
