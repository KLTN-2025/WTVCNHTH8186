-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 24, 2025 lúc 03:35 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `career_guidance_chatbot`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_logs`
--

CREATE TABLE `admin_logs` (
  `id` bigint(20) NOT NULL,
  `admin_id` bigint(20) NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_logs`
--

INSERT INTO `admin_logs` (`id`, `admin_id`, `user_name`, `action`, `description`, `ip_address`, `created_at`, `updated_at`) VALUES
(22, 1, 'Admin', 'Đăng xuất hệ thống', 'Admin (ID: 1) đã đăng xuất.', '127.0.0.1', '2025-10-11 00:23:53', '2025-10-11 00:23:53'),
(23, 1, 'Admin', 'Đăng nhập hệ thống', 'Admin (ID: 1) đã đăng nhập thành công.', '127.0.0.1', '2025-10-11 00:24:01', '2025-10-11 00:24:01'),
(24, 1, 'Admin', 'Xem danh sách ngành học', NULL, '127.0.0.1', '2025-10-11 00:25:33', '2025-10-11 00:25:33'),
(25, 1, 'Admin', 'Xem danh sách ngành học', NULL, '127.0.0.1', '2025-10-11 00:25:34', '2025-10-11 00:25:34'),
(26, 1, 'Admin', 'Mở form chỉnh sửa ngành học', 'Ngành học: Khoa học môi trường (ID: 4)', '127.0.0.1', '2025-10-11 00:25:35', '2025-10-11 00:25:35'),
(27, 1, 'Admin', 'Cập nhật ngành học', 'Ngành học \'Khoa học môi trường\' (ID: 4) đã được chỉnh sửa.', '127.0.0.1', '2025-10-11 00:25:37', '2025-10-11 00:25:37'),
(28, 1, 'Admin', 'Mở form chỉnh sửa ngành học', 'Ngành học: Khoa học môi trường (ID: 4)', '127.0.0.1', '2025-10-11 00:25:37', '2025-10-11 00:25:37'),
(29, 1, 'Admin', 'Cập nhật trường đại học', 'Thông tin trường \'Đại học Quốc gia TP. Hồ Chí Minh\' (ID: 4) đã được chỉnh sửa.', '127.0.0.1', '2025-10-11 00:29:28', '2025-10-11 00:29:28'),
(30, 1, 'Admin', 'Cập nhật trạng thái tài khoản', 'Người dùng \'Nguyễn Văn Hùng\' (ID: 6) đã bị chặn.', '127.0.0.1', '2025-10-11 00:30:46', '2025-10-11 00:30:46'),
(31, 1, 'Quản Trị Viên', 'Cập nhật hồ sơ cá nhân', 'Người dùng \'Quản Trị Viên\' (ID: 1) đã cập nhật thông tin cá nhân.', '127.0.0.1', '2025-10-11 00:38:44', '2025-10-11 00:38:44'),
(32, 1, 'Quản Trị Viên', 'Cập nhật hồ sơ cá nhân', 'Người dùng \'Quản Trị Viên\' (ID: 1) đã cập nhật thông tin cá nhân.', '127.0.0.1', '2025-10-11 00:38:49', '2025-10-11 00:38:49'),
(33, 1, 'Quản Trị Viên', 'Cập nhật hồ sơ cá nhân', 'Người dùng \'Quản Trị Viên\' (ID: 1) đã cập nhật thông tin cá nhân.', '127.0.0.1', '2025-10-11 00:39:02', '2025-10-11 00:39:02'),
(34, 1, 'Quản Trị Viên', 'Cập nhật hồ sơ cá nhân', 'Người dùng \'Quản Trị Viên\' (ID: 1) đã cập nhật thông tin cá nhân.', '127.0.0.1', '2025-10-11 00:40:18', '2025-10-11 00:40:18'),
(35, 1, 'Quản Trị Viên', 'Thêm câu hỏi khảo sát', 'ABCDE', '127.0.0.1', '2025-10-11 02:38:35', '2025-10-11 02:38:35'),
(36, 1, 'Quản Trị Viên', 'Cập nhật câu hỏi khảo sát', 'ABCDE', '127.0.0.1', '2025-10-11 02:39:09', '2025-10-11 02:39:09'),
(37, 1, 'Quản Trị Viên', 'Xóa câu hỏi khảo sát', 'ABCDE', '127.0.0.1', '2025-10-11 02:39:17', '2025-10-11 02:39:17'),
(38, 1, 'Quản Trị Viên', 'Thêm liên kết ngành–trường', 'Công nghệ thông tin – Đại học Kinh tế Quốc dân', '127.0.0.1', '2025-10-11 02:55:14', '2025-10-11 02:55:14'),
(39, 1, 'Quản Trị Viên', 'Cập nhật liên kết ngành–trường', 'Công nghệ thông tin – Đại học Quốc gia TP. Hồ Chí Minh', '127.0.0.1', '2025-10-11 02:55:39', '2025-10-11 02:55:39'),
(40, 1, 'Quản Trị Viên', 'Xóa liên kết ngành–trường', 'Công nghệ thông tin – Đại học Quốc gia TP. Hồ Chí Minh', '127.0.0.1', '2025-10-11 02:55:46', '2025-10-11 02:55:46'),
(41, 1, 'Quản Trị Viên', 'Đăng nhập hệ thống', 'Quản Trị Viên (ID: 1) đã đăng nhập thành công.', '127.0.0.1', '2025-10-11 07:22:29', '2025-10-11 07:22:29'),
(42, 1, 'Quản Trị Viên', 'Đăng nhập hệ thống', 'Quản Trị Viên (ID: 1) đã đăng nhập thành công.', '127.0.0.1', '2025-10-11 07:29:21', '2025-10-11 07:29:21'),
(43, 1, 'Quản Trị Viên', 'Đăng xuất hệ thống', 'Quản Trị Viên (ID: 1) đã đăng xuất.', '127.0.0.1', '2025-10-11 07:32:30', '2025-10-11 07:32:30'),
(44, 1, 'Quản Trị Viên', 'Đăng nhập hệ thống', 'Quản Trị Viên (ID: 1) đã đăng nhập thành công.', '127.0.0.1', '2025-10-11 07:32:43', '2025-10-11 07:32:43'),
(45, 1, 'Quản Trị Viên', 'Đăng nhập hệ thống', 'Quản Trị Viên (ID: 1) đã đăng nhập thành công.', '127.0.0.1', '2025-10-11 07:47:31', '2025-10-11 07:47:31'),
(46, 1, 'Quản Trị Viên', 'Đăng nhập hệ thống', 'Quản Trị Viên (ID: 1) đã đăng nhập thành công.', '127.0.0.1', '2025-10-20 07:34:51', '2025-10-20 07:34:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `career_paths`
--

CREATE TABLE `career_paths` (
  `id` bigint(20) NOT NULL,
  `major_id` bigint(20) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `average_salary` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `career_paths`
--

INSERT INTO `career_paths` (`id`, `major_id`, `title`, `description`, `average_salary`, `created_at`) VALUES
(1, 1, 'Lập trình viên phần mềm', 'Phát triển ứng dụng và hệ thống.', '20000000.00', '2025-10-11 04:16:15'),
(2, 1, 'Chuyên viên dữ liệu', 'Phân tích và xử lý dữ liệu lớn.', '25000000.00', '2025-10-11 04:16:15'),
(3, 2, 'Chuyên viên marketing', 'Lên chiến lược quảng cáo và thương hiệu.', '18000000.00', '2025-10-11 04:16:15'),
(4, 3, 'Bác sĩ đa khoa', 'Khám, chẩn đoán và điều trị bệnh.', '30000000.00', '2025-10-11 04:16:15'),
(5, 4, 'Chuyên viên môi trường', 'Giám sát, đánh giá và đề xuất giải pháp môi trường.', '16000000.00', '2025-10-11 04:16:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chat_logs`
--

CREATE TABLE `chat_logs` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `message` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `reply` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chat_logs`
--

INSERT INTO `chat_logs` (`id`, `user_id`, `message`, `reply`, `created_at`) VALUES
(1, 2, 'Em học giỏi Toán và thích máy tính thì nên học ngành gì?', 'Dựa trên câu trả lời của bạn, ngành Công nghệ thông tin rất phù hợp.', '2025-10-11 04:16:15'),
(2, 3, 'Em thích nói chuyện và kinh doanh, ngành nào hợp?', 'Bạn phù hợp với ngành Quản trị kinh doanh.', '2025-10-11 04:16:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `majors`
--

CREATE TABLE `majors` (
  `id` bigint(20) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `requirements` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `career_opportunities` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `majors`
--

INSERT INTO `majors` (`id`, `name`, `description`, `requirements`, `career_opportunities`, `created_at`, `updated_at`) VALUES
(1, 'Công nghệ thông tin', 'Học về phần mềm, mạng, dữ liệu và AI.', 'Tốt Toán, Logic, Tiếng Anh.', 'Lập trình viên, kỹ sư phần mềm, phân tích dữ liệu.', '2025-10-11 04:16:15', '2025-10-11 06:21:21'),
(2, 'Quản trị kinh doanh', 'Nghiên cứu về quản lý, marketing, tài chính.', 'Khả năng giao tiếp, lãnh đạo.', 'Chuyên viên kinh doanh, quản lý dự án, marketing.', '2025-10-11 04:16:15', '2025-10-11 06:21:21'),
(3, 'Y học', 'Nghiên cứu, chẩn đoán và điều trị bệnh.', 'Điểm cao, khả năng tập trung, đạo đức nghề nghiệp.', 'Bác sĩ, điều dưỡng, dược sĩ.', '2025-10-11 04:16:15', '2025-10-11 06:21:21'),
(4, 'Khoa học môi trường', 'Nghiên cứu các vấn đề môi trường và phát triển bền vững.', 'Quan tâm xã hội, kiến thức tự nhiên.', 'Nhà nghiên cứu, chuyên viên môi trường.', '2025-10-11 04:16:15', '2025-10-11 06:21:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `major_university`
--

CREATE TABLE `major_university` (
  `id` bigint(20) NOT NULL,
  `major_id` bigint(20) NOT NULL,
  `university_id` bigint(20) NOT NULL,
  `tuition_fee` decimal(10,2) DEFAULT NULL,
  `duration_years` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `major_university`
--

INSERT INTO `major_university` (`id`, `major_id`, `university_id`, `tuition_fee`, `duration_years`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '12000000.00', 4, '2025-10-11 04:16:15', '2025-10-11 09:55:12'),
(2, 1, 4, '10000000.00', 4, '2025-10-11 04:16:15', '2025-10-11 09:55:12'),
(3, 2, 2, '15000000.00', 4, '2025-10-11 04:16:15', '2025-10-11 09:55:12'),
(4, 3, 3, '20000000.00', 6, '2025-10-11 04:16:15', '2025-10-11 09:55:12'),
(5, 4, 4, '11000000.00', 4, '2025-10-11 04:16:15', '2025-10-11 09:55:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `survey_answers`
--

CREATE TABLE `survey_answers` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `question_id` bigint(20) NOT NULL,
  `answer` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `survey_answers`
--

INSERT INTO `survey_answers` (`id`, `user_id`, `question_id`, `answer`, `created_at`) VALUES
(1, 2, 1, 'Máy móc', '2025-10-11 04:16:15'),
(2, 2, 2, 'Có', '2025-10-11 04:16:15'),
(3, 2, 3, 'Toán', '2025-10-11 04:16:15'),
(4, 2, 4, 'Hà Nội', '2025-10-11 04:16:15'),
(5, 2, 5, 'Kỹ thuật', '2025-10-11 04:16:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `survey_questions`
--

CREATE TABLE `survey_questions` (
  `id` bigint(20) NOT NULL,
  `question_text` text COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('single','multiple') COLLATE utf8_unicode_ci DEFAULT 'single',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `survey_questions`
--

INSERT INTO `survey_questions` (`id`, `question_text`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Bạn thích làm việc với con người hay máy móc?', 'single', '2025-10-11 04:16:15', '2025-10-11 04:16:15'),
(2, 'Bạn có thích lập trình hoặc công nghệ không?', 'single', '2025-10-11 04:16:15', '2025-10-11 04:16:15'),
(3, 'Bạn cảm thấy mình giỏi về môn nào nhất?', 'single', '2025-10-11 04:16:15', '2025-10-11 04:16:15'),
(4, 'Bạn muốn học tại thành phố nào?', 'single', '2025-10-11 04:16:15', '2025-10-11 04:16:15'),
(5, 'Bạn thích công việc sáng tạo hay kỹ thuật?', 'single', '2025-10-11 04:16:15', '2025-10-11 04:16:15'),
(6, 'Bạn có quan tâm đến lĩnh vực kinh doanh không?', 'single', '2025-10-11 04:16:15', '2025-10-11 04:16:15'),
(7, 'Bạn có hứng thú với khoa học tự nhiên không?', 'single', '2025-10-11 04:16:15', '2025-10-11 04:16:15'),
(8, 'Bạn có khả năng giao tiếp tốt chứ?', 'single', '2025-10-11 04:16:15', '2025-10-11 04:16:15'),
(9, 'Bạn có muốn làm việc trong lĩnh vực y tế không?', 'single', '2025-10-11 04:16:15', '2025-10-11 04:16:15'),
(10, 'Bạn có quan tâm đến các ngành về môi trường và xã hội không?', 'single', '2025-10-11 04:16:15', '2025-10-11 04:16:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `survey_results`
--

CREATE TABLE `survey_results` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `suggested_major_id` bigint(20) DEFAULT NULL,
  `score` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `survey_results`
--

INSERT INTO `survey_results` (`id`, `user_id`, `suggested_major_id`, `score`, `created_at`) VALUES
(1, 2, 1, 85, '2025-10-11 04:16:15'),
(2, 3, 2, 70, '2025-10-11 04:16:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `universities`
--

CREATE TABLE `universities` (
  `id` bigint(20) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `universities`
--

INSERT INTO `universities` (`id`, `name`, `location`, `website`, `ranking`, `created_at`, `updated_at`) VALUES
(1, 'Đại học Bách Khoa Hà Nội', 'Hà Nội', 'https://www.hust.edu.vn', 1, '2025-10-11 04:16:15', '2025-10-11 06:39:07'),
(2, 'Đại học Kinh tế Quốc dân', 'Hà Nội', 'https://www.neu.edu.vn', 2, '2025-10-11 04:16:15', '2025-10-11 06:39:07'),
(3, 'Đại học Y Hà Nội', 'Hà Nội', 'https://www.hmu.edu.vn', 3, '2025-10-11 04:16:15', '2025-10-11 06:39:07'),
(4, 'Đại học Quốc gia TP. Hồ Chí Minh', 'TP.HCM', 'https://www.vnuhcm.edu.vn', 4, '2025-10-11 04:16:15', '2025-10-10 23:41:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8_unicode_ci DEFAULT 'user',
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `is_blocked`, `created_at`, `updated_at`) VALUES
(1, 'Quản Trị Viên', 'admin@gmail.com', '$2a$10$6kUO.ZHzzYKMf1H0bBrIxOONDuDOtq8vjk33xmVqk4Afy/u/E5VNa', 'admin', 0, '2025-10-11 04:16:15', '2025-10-11 00:38:44'),
(2, 'Nguyen Van A', 'a@example.com', '$2y$10$zFzYfJG6gB5UfPjjX7n6eOK5tfS5Z14/90VUp1LZf5XzphC9geWZ2', 'user', 0, '2025-10-11 04:16:15', '2025-10-11 04:16:15'),
(3, 'Tran Thi B', 'b@example.com', '$2y$10$zFzYfJG6gB5UfPjjX7n6eOK5tfS5Z14/90VUp1LZf5XzphC9geWZ2', 'user', 0, '2025-10-11 04:16:15', '2025-10-11 00:01:52'),
(5, 'Nguyễn Văn Dũng', 'nguyenvand@gmail.com', '$2y$10$CVhsKIpIhBX51fXY0mqTyeUub8bmjdW6xBSfRSw0VB1HQ86HX0C8a', 'user', 0, '2025-10-11 00:01:16', '2025-10-11 00:01:42'),
(6, 'Nguyễn Văn Hùng', 'nguyenvanh@gmail.com', '$2y$10$qJpgh3EDPgUF.3nYjX/uZeppXOyxfQYNu0zhZWKITK7OjUvdPXVi2', 'user', 1, '2025-10-11 00:04:21', '2025-10-11 00:30:46');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Chỉ mục cho bảng `career_paths`
--
ALTER TABLE `career_paths`
  ADD PRIMARY KEY (`id`),
  ADD KEY `major_id` (`major_id`);

--
-- Chỉ mục cho bảng `chat_logs`
--
ALTER TABLE `chat_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `major_university`
--
ALTER TABLE `major_university`
  ADD PRIMARY KEY (`id`),
  ADD KEY `major_id` (`major_id`),
  ADD KEY `university_id` (`university_id`);

--
-- Chỉ mục cho bảng `survey_answers`
--
ALTER TABLE `survey_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Chỉ mục cho bảng `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `survey_results`
--
ALTER TABLE `survey_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `career_paths`
--
ALTER TABLE `career_paths`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `chat_logs`
--
ALTER TABLE `chat_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `majors`
--
ALTER TABLE `majors`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `major_university`
--
ALTER TABLE `major_university`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `survey_answers`
--
ALTER TABLE `survey_answers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `survey_results`
--
ALTER TABLE `survey_results`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `universities`
--
ALTER TABLE `universities`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD CONSTRAINT `admin_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `career_paths`
--
ALTER TABLE `career_paths`
  ADD CONSTRAINT `career_paths_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `chat_logs`
--
ALTER TABLE `chat_logs`
  ADD CONSTRAINT `chat_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `major_university`
--
ALTER TABLE `major_university`
  ADD CONSTRAINT `major_university_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `major_university_ibfk_2` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `survey_answers`
--
ALTER TABLE `survey_answers`
  ADD CONSTRAINT `survey_answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `survey_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `survey_questions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `survey_results`
--
ALTER TABLE `survey_results`
  ADD CONSTRAINT `survey_results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
