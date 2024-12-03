-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 09:19 PM
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
-- Database: `jobsearch`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `adm_id` int(10) NOT NULL,
  `adm_name` varchar(30) NOT NULL,
  `adm_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`adm_id`, `adm_name`, `adm_password`) VALUES
(1, 'admin', 'admin1?');

-- --------------------------------------------------------

--
-- Table structure for table `company_info`
--

CREATE TABLE `company_info` (
  `company_id` int(100) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `company_img` blob NOT NULL,
  `founder` varchar(200) NOT NULL,
  `location` varchar(255) NOT NULL,
  `facebook_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_info`
--

INSERT INTO `company_info` (`company_id`, `company_name`, `company_img`, `founder`, `location`, `facebook_link`) VALUES
(1, 'Xsphere', 0x75706c6f6164732f68617070792e6a7067, 'U Zay Ya Naung', '55street, Botahtaung Township, Yangon, Myanmar', 'https://www.facebook.com/Xsphere12/'),
(3, 'Xsphere', 0x75706c6f6164732f696d616765322e6a7067, 'U Zay Ya', 'အမှတ် ၂၉ ပထမထပ်၊ ရတနာဒီပလမ်း၊ကျိုက်က္ကဆံဘုရားလမ်း၊ သဃ်န်းကျွန်း။, Myanmar', 'https://www.facebook.com/Xsphere12/'),
(5, 'Myint Thu Kha Nadi Co., Ltd.', 0x75706c6f6164732f696d616765332e6a7067, 'public', 'No. 216, C Shwe Hnin Si School Lane, Mayangone Tsp, Yangon, Myanmar', 'http://myintthukhanadi.com'),
(6, 'Myint Thu Kha Nadi Co., Ltd.', 0x75706c6f6164732f696d616765332e6a7067, 'private', 'No. 216, C Shwe Hnin Si School Lane, Mayangone Tsp, Yangon, Myanmar', 'http://myintthukhanadi.com'),
(8, 'Dream Express Delivery', 0x75706c6f6164732f696d616765312e6a7067, 'Kaung Htet Naing', ' No (22/B) Zabuthiri (1)st (6)th Ward Thaketa, Myanmar', 'https://dreamexpressdelivery.com/'),
(9, 'Easy Online Shopping', 0x75706c6f6164732f68617070792e6a7067, 'Someone', ' No(95/C), Myayadanar Str., Dhamayone Road, (11) Ward, Hlaing Township, Yangon., Myanmar', 'https://www.facebook.com/');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(11) NOT NULL,
  `job_name` varchar(150) NOT NULL,
  `com_name` varchar(100) NOT NULL,
  `job_type` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `requirement` varchar(255) NOT NULL,
  `benefits` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `employ_mail` varchar(100) NOT NULL,
  `deadline` varchar(100) NOT NULL,
  `industry` varchar(200) NOT NULL,
  `salary` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_name`, `com_name`, `job_type`, `description`, `requirement`, `benefits`, `created_at`, `employ_mail`, `deadline`, `industry`, `salary`) VALUES
(1, 'Narrator', 'Easy Online Shopping', 'Part Time', 'Online Shop Video ကြော်ငြာများကိုနောက်ခံစကားပြောပေးနိုင်ရမည်။\r\n- အသံပိုင်းဆိုင်ရာအတွေ့အကြုံရှိသူဦးစားပေးမည်။\r\n- ကြော်ငြာတစ်ခုချင်းစီရဲ့ အသံအယူအတိမ်းကို တည်ငြိမ်ပေါ်လွင်အောင်ပြောနိုင်ပြီး ကိုယ်ပိုင် creation ရှိရမည်။', 'ဘွဲ့ရ (သို့) ကျောင်းကိစ္စ ကင်းရှင်းသူဖြစ်ရမည်။\r\n- Team Work ဖြင့်နွေးထွေးစွာ လုပ်ကိုင်နိုင်သူ၊ စကားပြောပြေပြစ်ပြီး လူမှုဆက်ဆံရေးကောင်းမွန်သူဖြစ်ရမည်။\r\n- Computer ကျွမ်းကျင်သူဖြစ်ရမည်။\r\n- ရုံးချိန် ( 9:00AM to 6:00PM )\r\n- တပတ်တစ်ရက်အလှည့်ကျ နားရက်ရှိသည်။\r\n', '', '2024-01-16 05:12:52', 'mm@gmail.com', 'FEb4.2024', 'General', 'Negotiate'),
(2, 'Digital Marketer', 'Easy Online Shopping', 'Freelance', ' Upload regularly content writing for company Facebook page, social media posts and so on.\r\n- Daily post on social media & conducting promotion activities.\r\n- Monitor Facebook page & reply to chat box and comment.\r\n- Campaign Creative, Boosting and page m', 'ဘွဲ့ရ (သို့) ကျောင်း/သင်တန်းကိစ္စ ကင်းရှင်းသူဖြစ်ရမည်။ Marketing နှင့် ပတ်သတ်သော Diploma / Certificate ရရှိထားသူဦးစားပေးလျှောက်ထားနိုင်ပါသည်။\r\n- Digital Marketing အတွေ့အကြုံ အနည်းဆုံး (၁) နှစ် ရှိရပါမည်။\r\n- Team Work ဖြင့်နွေးထွေးစွာလုပ်ကိုင်နိုင်သူ၊ စကား', '--', '2024-01-15 01:37:55', 'mm@gmail.com', 'Jan25.2024', 'IT', 'MMK 200000-400000'),
(3, 'Student Affair Officer', 'Mahar Euphoria Education Centre', 'Full Time', 'Assist teachers with lesson preparation, classroom management, and the implementation of educational activities.\r\n• Provide one-on-one or small group support to students who may require additional assistance.\r\n• Help maintain a positive and inclusive lear', 'Bachelor\'s degree in education, a related field, or equivalent experience.\r\n• Previous experience in an educational setting is preferred.\r\n• Excellent communication skills and the ability to work effectively in a team.\r\n• Strong organizational skills and ', ' Competitive salary commensurate with qualifications and experience.\r\n• Professional development opportunities.\r\n• A supportive and collaborative work environment.\r\n• Opportunities to engage with a di', '2024-01-15 01:38:08', 'meec@gmail.com', 'Jan30.2024', 'Teaching', 'MMK 200000-300000'),
(4, 'Marketing Representatives', 'KOS Marketing Enterprises', 'Full Time', 'ရန်ကုန်မြို့တွင်း ကျွမ်းကျင်စွာသွားလာနိုင်ရမည်။\r\nအရောင်းပိုင်းဆိုင်ရာ အတွေ့အကြုံ ရှိသူဦးစားပေးမည်။\r\nလက်ကား၊ လက်လီ ဆုိင်သစ်များရှာနိုင်ရမည်။\r\nဖိနပ် လုပ်ငန်းတွင် လုပ်ကိုင်ဘူးသူဦးစားပေးမည်။\r\nအရောင်းမန်နေဂျာမှ သက်မှတ်သော Target ပြည့်မှီအောင်ကြိုးစားနိုင်ရမည်။', 'ပညာအရည်အချင်း အထက်တန်း ရှိရမည်။\r\nကွန်ပျူတာ အခြေခံ သုံးတက်ရမည်။\r\nအရောင်းပညာများ လေ့လာဘူးသူ ဦးစားပေးမည်။', 'လစာ +​ ဖုန်းဘေ +​ သွားလာစရိတ် + ဘောနပ်စ်', '2024-01-15 01:38:22', 'kos@gmail.com', 'Feb3.2024', 'General', 'MMK 400000-500000'),
(5, 'Sales Rider', 'KOS Marketing Enterprises', 'Full Time', '🚴🏻နေ့တိုင်း ရုံးတက်စရာ မလိုတဲ့ Sales Rider အလုပ်အကိုင် အခွင့်အလမ်း\r\n\r\n\r\n▶︎ ရန်ကုန်မြို့အတွင်း မိမိနေထိုင်သည့်မြို့နယ် အတွင်း ကျွမ်းကျင်စွာသွားလာနိုင်သူဖြစ်ရမည်။\r\n\r\n▶︎ ရေသန့်လုပ်ငန်း/ F&B အတွေ့အကြုံရှိသူ ဦးစားပေးမည်။​\r\n\r\n▶︎ လစာ ၂ သိန်း နှင့် ကော်မရှင်', '▶︎ အရောင်းအတွေ့အကြုံ ရှိသူဦးစားပေးမည်။\r\n\r\n▶︎ စနေနေ့တိုင်း ရုံးတက်ပေးရမည်။\r\n\r\n▶︎ ကိုယ်ပိုင်စက်ဘီးရှိရမည်။​\r\n\r\n▶︎ သက်မှတ်ထားသော လစဉ် အရောင်း Target ပြည့်မှီအောင်ကြိုးစားနိုင်ရမည်။', 'အလုပ်ချိန် မနက် ၉ နာရီမှ ညနေ ၅ နာရီ (တနင်္ဂနွေပိတ်) \r\n\r\nရုံးတည်နေရာ - အင်းစိန်၊​ စော်ဘွားကြီးကုန်း \r\n\r\nမြို့နယ်တစ်မြို့နယ်တွင် 3ဦးသာ ခန့်မှာဖြစ်သည့်အတွက် စိတ်ဝင်စားသူများ အောက်ပါ Viber 09 421000 546 ', '2024-01-17 00:58:21', 'kos@gmail.com', 'jan30.2024', 'General', 'Negotiate'),
(7, 'Senior Graphic Designer/ Video Editor Position', 'Myint Thu Kha Nadi Co., Ltd.', 'Full Time', ' Create Design for the social media posting and product packaging\r\n• Create motion design & Video Edition\r\n• Draw design by creative ideas according to the management guidelines\r\n• Photo and video taking of the products and promotion items for design purp', 'Minimum 3 years of experience as a Graphic Designer or Similar Role\r\n• Knowledge of Adobe range of products: Photoshop, Illustrator, Premier, After Effects\r\nProfessional mastery of video and audio editing software and program.\r\n• Proficiency in branding, ', 'Working Hours             : 9:00 AM to 5:00 PM (Current Situation)\r\n\r\nWorking Days               : Monday to Friday\r\n\r\nOff Days                       : Saturday, Sunday & Public Holidays\r\n\r\nApply Emai', '2024-01-15 01:52:13', 'mtkn@gmail.com', 'Feb4.2024', 'IT', 'MMK 400000- 500000'),
(8, 'Senior Graphic Designer/ Video Editor Position', 'Myint Thu Kha Nadi Co., Ltd.', 'Full Time', ' Create Design for the social media posting and product packaging\r\n• Create motion design & Video Edition\r\n• Draw design by creative ideas according to the management guidelines\r\n• Photo and video taking of the products and promotion items for design purp', 'Minimum 3 years of experience as a Graphic Designer or Similar Role\r\n• Knowledge of Adobe range of products: Photoshop, Illustrator, Premier, After Effects\r\nProfessional mastery of video and audio editing software and program.\r\n• Proficiency in branding, ', 'Working Hours             : 9:00 AM to 5:00 PM (Current Situation)\r\n\r\nWorking Days               : Monday to Friday\r\n\r\nOff Days                       : Saturday, Sunday & Public Holidays\r\n\r\nApply Emai', '2024-01-15 01:52:58', 'mtkn@gmail.com', 'Feb4.2024', 'IT', 'MMK 400000- 500000'),
(11, 'IT Assistant', 'Xsphere', 'Part Time', '---', 'Any graduated with certificate or diploma in related field.\r\n• Must have 1 year and above experience in related field but freshers can also apply.\r\n• Must have good communication and teamwork skills.\r\n• To assist to IT Associate .\r\n• Office Outlook / Emai', 'Benefits - Meal Allowance, Attendance Allowance.\r\n\r\n\r\n\r\nProvide- Uniform and Ferry.                                           \r\n\r\n\r\n\r\nOffice Hours - 9:00AM to 5:30 PM\r\n\r\n\r\n\r\nOff day - every Wednesday ', '2024-01-15 02:04:06', 'xsphere@gmail.com', 'Feb20.2024', 'IT', 'MMK 400000- 500000'),
(12, 'Web developer', 'IT Tech', 'Full Time', 'dkfjlsd;afjdlkfjieijfskldjflsafoijfkl;asfdjklsfjfeifjkkdl', 'fjl;afdkfjdeifjsdkfjlsadhfdklfjeiofjeelk', 'fdsalkfjdlkasfjeifakdfjkldfl', '2024-01-17 06:42:58', 'ittech@gmail.com', 'Feb20.2024', 'IT', 'Negotiate');

-- --------------------------------------------------------

--
-- Table structure for table `user_register`
--

CREATE TABLE `user_register` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(59) NOT NULL,
  `password` varchar(20) NOT NULL,
  `profile` blob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `aboutyourself` varchar(255) NOT NULL,
  `certificate` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_register`
--

INSERT INTO `user_register` (`user_id`, `username`, `phone`, `email`, `password`, `profile`, `created_at`, `aboutyourself`, `certificate`) VALUES
(1, 'Nyi Ma', '4545655', 'nyi@gmail.com', 'nyima123', 0x696d616765332e6a7067, '2024-01-17 01:08:00', 'I am passionate about my work. ... I am ambitious and driven. ... I am highly organised. ... I am a people person. ... I am a natural leader. ... I am result oriented. ... I am an excellent communicator.I am the best.', 0x70726f66696c65732f53637265656e73686f74202837292e706e67);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_info`
--
ALTER TABLE `company_info`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `company_id` (`company_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`),
  ADD UNIQUE KEY `job_id` (`job_id`);

--
-- Indexes for table `user_register`
--
ALTER TABLE `user_register`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_info`
--
ALTER TABLE `company_info`
  MODIFY `company_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_register`
--
ALTER TABLE `user_register`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
