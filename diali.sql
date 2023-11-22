-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: db:3306
-- Thời gian đã tạo: Th10 22, 2023 lúc 10:47 AM
-- Phiên bản máy phục vụ: 5.7.43
-- Phiên bản PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `diali`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diachi`
--

CREATE TABLE `diachi` (
  `id` int(11) NOT NULL,
  `sonha` varchar(100) DEFAULT NULL,
  `tenduong` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `tenxa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `tenhuyen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `tentinh` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `diachi`
--

INSERT INTO `diachi` (`id`, `sonha`, `tenduong`, `tenxa`, `tenhuyen`, `tentinh`) VALUES
(1, NULL, 'Đường 3/2', 'Xã A', 'Huyện A', 'Tỉnh A'),
(2, '100', 'Đường 3/2', 'Xã B', 'Huyện B', 'Tỉnh B'),
(3, '200', 'Đường 3/2', 'Xã C', 'Huyện C', 'Tỉnh C'),
(4, '300', 'Đường 3/2', 'Xã D', 'Huyện D', 'Tỉnh D'),
(9, 'asdasd', 'asdasd', 'asdc', 'xzzxc', 'xzczxc'),
(10, NULL, 'asdasd', '123123', 'asdasd', 'zxczxczxczxc'),
(11, 'asdasd', 'asdasd', 'asdc', 'xzzxc', 'xzczxc'),
(12, NULL, 'Nguyễn Văn Cừ', '...', '...', '...'),
(13, NULL, 'Nguyễn Văn Cừ', '...', '...', '...'),
(14, NULL, 'Nguyễn Văn Cừ', '...', '...', '...'),
(15, NULL, 'Nguyễn Văn Cừ', '...', '...', '...'),
(16, 'asdasd', 'asdasd', '123123', 'asdc', 'zxczxczxczxc'),
(17, 'asdasd', 'asdasd', '123123', 'asdc', 'zxczxczxczxc'),
(18, 'asdasd', 'asdasd', '123123', 'asdc', 'zxczxczxczxc'),
(19, NULL, 'ádsd', 'ádád', 'ádád', 'ádád'),
(20, NULL, 'ádsd', 'ádád', 'ádád', 'ádád'),
(21, NULL, 'ádsd', 'ádád', 'ádád', 'ádád'),
(22, '123', 'asdasd', 'ád', 'ádá', 'ád');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thong_tin_chu_tro`
--

CREATE TABLE `thong_tin_chu_tro` (
  `id` int(11) NOT NULL,
  `hoten` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `gioitinh` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `SDT` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `thong_tin_chu_tro`
--

INSERT INTO `thong_tin_chu_tro` (`id`, `hoten`, `gioitinh`, `SDT`) VALUES
(1, 'Nguyễn Văn A', 'Nam', '0372554141'),
(3, 'NGYEN VAN D 2', 'Nữ', '123456789'),
(4, 'Nguyễn Tấn Tài', 'Nam', '0123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thong_tin_khu_tro`
--

CREATE TABLE `thong_tin_khu_tro` (
  `id` int(11) NOT NULL,
  `hoten` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `toadoGPS` varchar(100) NOT NULL,
  `loaiphong` int(11) NOT NULL,
  `id_diachi` int(11) DEFAULT NULL,
  `id_tinhtrang` int(11) DEFAULT '3',
  `id_chutro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `thong_tin_khu_tro`
--

INSERT INTO `thong_tin_khu_tro` (`id`, `hoten`, `toadoGPS`, `loaiphong`, `id_diachi`, `id_tinhtrang`, `id_chutro`) VALUES
(8, 'asdasd 2', '10.034781083629046,105.77143350888034', 2, 9, 4, 1),
(10, 'KKK', '10.032668135128208,105.76281951221452', 2, 18, 3, 3),
(11, 'nhà trọ Trần Văn Hoài', '10.02563191725014,105.77176641808225', 2, 22, 3, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thong_tin_loai_phong`
--

CREATE TABLE `thong_tin_loai_phong` (
  `id` int(11) NOT NULL,
  `tenloai` varchar(500) NOT NULL,
  `songuoio` int(11) DEFAULT '0',
  `dientich` varchar(30) NOT NULL,
  `giathue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `thong_tin_loai_phong`
--

INSERT INTO `thong_tin_loai_phong` (`id`, `tenloai`, `songuoio`, `dientich`, `giathue`) VALUES
(1, 'vip', 10, '200m2', 10000000),
(2, 'normal', 2, '50m2', 2000000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thong_tin_truong_dai_hoc`
--

CREATE TABLE `thong_tin_truong_dai_hoc` (
  `id` int(11) NOT NULL,
  `tentruong` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `toadoGPS` varchar(100) NOT NULL,
  `id_diachi` int(11) DEFAULT NULL,
  `icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `thong_tin_truong_dai_hoc`
--

INSERT INTO `thong_tin_truong_dai_hoc` (`id`, `tentruong`, `toadoGPS`, `id_diachi`, `icon`) VALUES
(1, 'Truong dai hoc can tho 2', '10.029938, 105.768433', 1, 'data:image/jpeg;base64,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'),
(2, 'Truong dai hoc tay Do', '9.998779, 105.759965', 2, ''),
(12, 'asdasdasd 2', '10.034495836386432,105.77200113614754', 10, ''),
(13, 'Trường đại học Y dược Cần Thơ', '10.035298753908982,105.75364773879946', 15, ''),
(14, 'My School', '10.033555575177804,105.76837954258052', 21, 'data:image/jpeg;base64,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');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinh_trang`
--

CREATE TABLE `tinh_trang` (
  `id` int(11) NOT NULL,
  `ten` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tinh_trang`
--

INSERT INTO `tinh_trang` (`id`, `ten`) VALUES
(3, 'Đang trống'),
(4, 'Đã có người ở'),
(5, 'Đã có người đặt thuê');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `diachi`
--
ALTER TABLE `diachi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thong_tin_chu_tro`
--
ALTER TABLE `thong_tin_chu_tro`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thong_tin_khu_tro`
--
ALTER TABLE `thong_tin_khu_tro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loaiphong` (`loaiphong`),
  ADD KEY `id_diachi` (`id_diachi`),
  ADD KEY `fk_sdkj` (`id_tinhtrang`),
  ADD KEY `fk_sfkjkfj` (`id_chutro`);

--
-- Chỉ mục cho bảng `thong_tin_loai_phong`
--
ALTER TABLE `thong_tin_loai_phong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thong_tin_truong_dai_hoc`
--
ALTER TABLE `thong_tin_truong_dai_hoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_diachi` (`id_diachi`);

--
-- Chỉ mục cho bảng `tinh_trang`
--
ALTER TABLE `tinh_trang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `diachi`
--
ALTER TABLE `diachi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `thong_tin_chu_tro`
--
ALTER TABLE `thong_tin_chu_tro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `thong_tin_khu_tro`
--
ALTER TABLE `thong_tin_khu_tro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `thong_tin_loai_phong`
--
ALTER TABLE `thong_tin_loai_phong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `thong_tin_truong_dai_hoc`
--
ALTER TABLE `thong_tin_truong_dai_hoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tinh_trang`
--
ALTER TABLE `tinh_trang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `thong_tin_khu_tro`
--
ALTER TABLE `thong_tin_khu_tro`
  ADD CONSTRAINT `fk_sdkj` FOREIGN KEY (`id_tinhtrang`) REFERENCES `tinh_trang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_sfkjkfj` FOREIGN KEY (`id_chutro`) REFERENCES `thong_tin_chu_tro` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `thong_tin_khu_tro_ibfk_1` FOREIGN KEY (`loaiphong`) REFERENCES `thong_tin_loai_phong` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `thong_tin_khu_tro_ibfk_2` FOREIGN KEY (`id_diachi`) REFERENCES `diachi` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `thong_tin_truong_dai_hoc`
--
ALTER TABLE `thong_tin_truong_dai_hoc`
  ADD CONSTRAINT `thong_tin_truong_dai_hoc_ibfk_1` FOREIGN KEY (`id_diachi`) REFERENCES `diachi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
