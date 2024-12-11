-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2023 at 02:39 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `art`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artist`
--

CREATE TABLE IF NOT EXISTS `tbl_artist` (
  `artist_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_firstname` text NOT NULL,
  `artist_lastname` text NOT NULL,
  `artist_username` text NOT NULL,
  `artist_password` text NOT NULL,
  `artist_email` text NOT NULL,
  `artist_contactnumber` varchar(13) NOT NULL,
  `artist_dob` varchar(20) NOT NULL,
  `artist_city` int(11) NOT NULL,
  `artist_qrimg` text NOT NULL,
  `artist_qrcode` text NOT NULL,
  `artist_profileimage` text NOT NULL,
  `artist_idproof` text NOT NULL,
  `artist_legalname` text NOT NULL,
  `artist_streetaddress` text NOT NULL,
  `artist_state` int(11) NOT NULL,
  `artist_country` int(11) NOT NULL,
  `artist_zipcode` int(11) NOT NULL,
  `artist_about` text NOT NULL,
  `artist_education` text NOT NULL,
  `artist_googleplus` text NOT NULL,
  `artist_twitter` text NOT NULL,
  `artist_facebook` text NOT NULL,
  `artist_instagram` text NOT NULL,
  `artist_website` text NOT NULL,
  `artist_status` varchar(10) NOT NULL DEFAULT 'active',
  `artist_verification` varchar(10) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`artist_id`),
  KEY `artist_contactnumber` (`artist_contactnumber`),
  KEY `artist_contactnumber_2` (`artist_contactnumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `tbl_artist`
--

INSERT INTO `tbl_artist` (`artist_id`, `artist_firstname`, `artist_lastname`, `artist_username`, `artist_password`, `artist_email`, `artist_contactnumber`, `artist_dob`, `artist_city`, `artist_qrimg`, `artist_qrcode`, `artist_profileimage`, `artist_idproof`, `artist_legalname`, `artist_streetaddress`, `artist_state`, `artist_country`, `artist_zipcode`, `artist_about`, `artist_education`, `artist_googleplus`, `artist_twitter`, `artist_facebook`, `artist_instagram`, `artist_website`, `artist_status`, `artist_verification`) VALUES
(11, 'Drashti ', 'Italiya', 'D_italiya', '123456789', 'devitaliya7@gmail.com', '8780563978', '29/01/2000', 1, '', '', './arts_files/Artist/D_italiya/Profile-Image/b76cbab8-a1.jpeg', '', '', '', 0, 0, 395004, '', '', '', '', '', '', '', 'active', 'approved'),
(12, 'Gopi', 'Kalathiya', 'gop090909', 'Gop090909', 'gopikalathiya091@gmail.com', '8866762282', '', 3, '', '', './arts_files/Artist/gop090909/Profile-Image/4ca9cf60-a8.jpeg', '', '', '', 1, 1, 657654, '', '', '', '', '', '', '', 'active', 'approved'),
(23, 'Visha', 'Kanani', 'visha09', 'Visha0909', 'visha091@gmail.com', '8866762281', '', 0, '', '', './arts_files/Artist/visha09/Profile-Image/bcc9135d-l3.jpeg', '', '', '', 0, 0, 395009, '', '', '', '', '', '', '', 'active', 'approved'),
(24, 'dev', 'italiya', 'dev_italiya', 'dev123', 'devitaliya7@gmail.com', '9898765654', '05/05/2002', 0, '', '', './arts_files/Artist/dev_italiya/Profile-Image/fcf79a41-n5.jpg', '', '', 'katargam', 0, 0, 395005, '', '', '', '', '', '', '', 'active', 'approved'),
(25, 'Meera', 'Patel', 'm_ptl', 'Meera123', 'meeraptl34@gmail.com', '9980765467', '', 0, '', '', './arts_files/Artist/m_ptl/Profile-Image/26e74a03-sc1.jpg', '', '', '', 0, 0, 395004, '                                                                                                                                    ', '                                                                                                                                    ', '', '', '', '', '', 'active', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artistrating`
--

CREATE TABLE IF NOT EXISTS `tbl_artistrating` (
  `artistrating_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_username` text NOT NULL,
  `artist_id` int(11) NOT NULL,
  `artistrating_ratings` double NOT NULL,
  PRIMARY KEY (`artistrating_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_artistrating`
--

INSERT INTO `tbl_artistrating` (`artistrating_id`, `customer_username`, `artist_id`, `artistrating_ratings`) VALUES
(1, 'nkakadiya', 12, 5),
(2, 'N_kalathiya', 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artsgallery`
--

CREATE TABLE IF NOT EXISTS `tbl_artsgallery` (
  `artgallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `file` text NOT NULL,
  `name` text NOT NULL,
  `status` varchar(8) NOT NULL,
  PRIMARY KEY (`artgallery_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_artsgallery`
--

INSERT INTO `tbl_artsgallery` (`artgallery_id`, `file`, `name`, `status`) VALUES
(1, './arts_files/Arts_Gallery/5095a4f1-7c03f8b0e9a44f8304c189ebb55b57e7.jpg', 'peace', 'active'),
(2, './arts_files/Arts_Gallery/277bc3bc-540888b67215d6d59d4929c2266e2b0c.jpg', 'nature\r\n', 'active'),
(3, './arts_files/Arts_Gallery/e1c26467-Modern-Art-HD-Wallpaper-Free-amazing-colorful-artworks-best-arts-ever-historical-images-cool-paints-widescreen-art-wallpapers-for-windows-2406x1504.jpg', 'tree', 'active'),
(4, './arts_files/Arts_Gallery/1f456bfc-Nature-Yellow-flower-in-vally-91745800.jpg', 'flower', 'active'),
(6, './arts_files/Arts_Gallery/0ef401a3-a6.jpeg', 'peace', 'active'),
(14, './arts_files/Arts_Gallery/e9abaadb-sc3.jpg', 'wodden art', 'active'),
(16, './arts_files/Arts_Gallery/8cdc68dc-c2.jpg', 'ceramic', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artsrating`
--

CREATE TABLE IF NOT EXISTS `tbl_artsrating` (
  `artsrating_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_username` text NOT NULL,
  `shop_id` int(11) NOT NULL,
  `artsrating_ratings` double NOT NULL,
  PRIMARY KEY (`artsrating_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_artsrating`
--

INSERT INTO `tbl_artsrating` (`artsrating_id`, `customer_username`, `shop_id`, `artsrating_ratings`) VALUES
(1, 'jason007', 1, 4),
(2, 'nkakadiya', 4, 5),
(3, 'N_kalathiya', 1, 5),
(4, 'N_kalathiya', 10, 5),
(5, 'N_kalathiya', 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `cart_status` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `shop_id`, `customer_id`, `qty`, `price`, `cart_status`) VALUES
(32, 26, 2, 1, 3500, 1),
(33, 21, 2, 1, 5000, 1),
(34, 1, 3, 1, 2000, 1),
(35, 17, 3, 1, 8000, 1),
(36, 18, 2, 2, 8000, 1),
(37, 20, 2, 1, 3000, 1),
(38, 29, 3, 1, 500, 1),
(39, 23, 1, 1, 2500, 1),
(40, 24, 2, 1, 4500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `category_image` text NOT NULL,
  `category_status` varchar(8) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_image`, `category_status`) VALUES
(1, 'Painting', './arts_files/Arts_Category/0c7fac27-artistic-hd-wallpaper-1.jpg', 'active'),
(2, 'Photography', './arts_files/Arts_Category/88ab1bd8-wp1813229.jpg', 'active'),
(3, 'Sculpture', './arts_files/Arts_Category/1bcb5f45-Birdman.jpg', 'active'),
(12, 'craft', './arts_files/Arts_Category/8b58c747-craft.jpg', 'active'),
(13, 'ceramics', './arts_files/Arts_Category/2de32e13-c2.jpg', 'deactive'),
(14, 'digital art', './arts_files/Arts_Category/0f2c750c-n5.jpg', 'active'),
(15, 'print making', './arts_files/Arts_Category/b427a0ed-printmaking.jpeg', 'active'),
(16, 'print', './arts_files/Arts_Category/626cfaa3-a8.jpeg', 'deactive'),
(17, 'draw', './arts_files/Arts_Category/19cb2504-a5.jpeg', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE IF NOT EXISTS `tbl_city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(20) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_status` varchar(8) NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`city_id`, `city_name`, `state_id`, `city_status`) VALUES
(1, 'Ahemdabad', 1, 'deactive'),
(2, 'Vadodara', 1, 'active'),
(3, 'Rajkot', 1, 'active'),
(4, 'Mumbai', 2, 'active'),
(5, 'Amritsar', 3, 'active'),
(6, 'Jaipur', 4, 'active'),
(7, 'Udaipur', 4, 'active'),
(8, 'surat', 1, 'active'),
(10, 'Bhavnagar', 1, 'active'),
(11, 'Kutch', 1, 'active'),
(12, 'Navda', 1, 'active'),
(14, 'Vapi', 1, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE IF NOT EXISTS `tbl_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `body` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `date` varchar(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `name`, `email`, `body`, `status`, `date`) VALUES
(3, 'visha virani', 'vvirani123@gmail.com', 'can you start your business out of stat???', 1, '06-03-2023'),
(4, 'shree virani', 'shree1234@gmail.com', 'your website is very help full for me \r\n', 1, '06-03-2023'),
(5, 'ISHA VACHHANI', 'ivac123@gmail.com', 'hello', 0, '09-03-2023'),
(7, 'drashti italiya', 'ditaliya@gmail.com', 'can you give me information about your website', 0, '09-03-2023'),
(8, 'nupoor kalathiya', 'nkalathiya12@gmail.com', 'hey!!!!', 0, '09-03-2023'),
(9, 'gopi  kalathiya ', 'gkalathiya@gmail.com', 'hello!!! can you send my order out of  stat', 0, '09-03-2023'),
(10, 'sonali bendre', 'sbendre@gmail.com', 'your website is very helpfull for me \r\n', 0, '09-03-2023'),
(11, 'mosam patel', 'mpatel12@gmail.com', 'your website  is helpfull !!!!', 0, '09-03-2023'),
(12, 'sonal patel', 'spatel34@gmail.com', 'how are you???', 0, '09-03-2023'),
(13, 'isha patel', 'ishavachhani7@gmail.com', 'can i regestration on your website as artist', 0, '09-03-2023'),
(14, 'bansi patel', 'bansipatel37@gmail.com', 'hello !!', 0, '09-03-2023'),
(15, 'meera patel', 'meeraptl34@gmail.com', 'hello i m meera ', 1, '09-03-2023'),
(16, 'meera patel', 'meeraptl34@gmail.com', 'hello i m meera ', 1, '09-03-2023'),
(17, 'Payal Pumbhadiya', 'ishavachhani7@gmail.com', 'give me reply only...................!!!!!!!!', 1, '09-04-2023');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE IF NOT EXISTS `tbl_country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(20) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_country`
--

INSERT INTO `tbl_country` (`country_id`, `country_name`) VALUES
(1, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_firstname` text NOT NULL,
  `customer_lastname` text NOT NULL,
  `customer_username` text NOT NULL,
  `customer_password` text NOT NULL,
  `customer_emailid` text NOT NULL,
  `customer_contactnumber` varchar(13) NOT NULL,
  `customer_favorites` text NOT NULL,
  `customer_profileimage` text NOT NULL,
  `customer_status` varchar(8) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `customer_firstname`, `customer_lastname`, `customer_username`, `customer_password`, `customer_emailid`, `customer_contactnumber`, `customer_favorites`, `customer_profileimage`, `customer_status`) VALUES
(1, 'Nupoor ', 'Kalathiya', 'N_kalathiya', 'nupoor123', 'nupoor17@gmail.com', '9990099900', '', './arts_files/Customer/N_kalathiya/Profile-Image/ea5e175f-a5.jpeg', 'active'),
(2, 'Noor', 'Kakadiya', 'nkakadiya', 'nknk0101', 'noor091@gmail.com', '8866762283', '', './arts_files/Customer/nkalathiyaa/Profile-Image/e7b49eb5-photo_6152198428982097692_y (1).jpg', 'active'),
(3, 'Shree', 'Virani', 'sh_virani', 'shree123', 'shree1234@gmail.com', '9876543298', '', './arts_files/Customer/sh_virani/Profile-Image/12572ed5-l1.jpeg', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shop`
--

CREATE TABLE IF NOT EXISTS `tbl_shop` (
  `shop_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) NOT NULL,
  `arttitle` text NOT NULL,
  `artfile` text NOT NULL,
  `artcategory` text NOT NULL,
  `artsubject` text NOT NULL,
  `yearofcreation` varchar(4) NOT NULL,
  `available_copies` int(11) NOT NULL,
  `artmediums` text NOT NULL,
  `artmaterials` text NOT NULL,
  `artstyles` text NOT NULL,
  `artkeywords` text NOT NULL,
  `height` double NOT NULL,
  `width` double NOT NULL,
  `description` text NOT NULL,
  `zipcode` int(11) NOT NULL,
  `streetaddress` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `price` double NOT NULL,
  `shipcost` double NOT NULL,
  `date` varchar(12) NOT NULL,
  `time` varchar(12) NOT NULL,
  PRIMARY KEY (`shop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tbl_shop`
--

INSERT INTO `tbl_shop` (`shop_id`, `artist_id`, `arttitle`, `artfile`, `artcategory`, `artsubject`, `yearofcreation`, `available_copies`, `artmediums`, `artmaterials`, `artstyles`, `artkeywords`, `height`, `width`, `description`, `zipcode`, `streetaddress`, `city`, `state`, `country`, `price`, `shipcost`, `date`, `time`) VALUES
(1, 11, 'Work', './arts_files/Artist/hussain007/Shop/Work/c3e92268-9e6238698f069bc67354945255de1364.jpg', 'Painting', 'Body', '2015', 3, 'Brush,Paint', 'Canvas', 'Abstract', 'Abstract,Canvas,Painting', 40, 48, '<p>Collectors tend to appreciate works more if they know the &ldquo;story&rdquo; behind them, so be sure to write<br />informative artwork descriptions. Great descriptions not only provide useful information<br />(e.g. physical texture, whether hanging hardware is included, quality of materials),</p>', 100100, 'A.k Road', 'Ahemdabad', 'Gujarat', 'India', 2000, 100, '05-05-2018', '11:01 am'),
(17, 11, 'ceramic', './arts_files/Artist/D_italiya/Shop/ceramic/be1c0855-ceramics.jpeg', 'Ceramics', 'Interior', '2022', 2, 'Brush', 'Clay', 'Abstract', 'Pottery', 50, 30, 'this the great picture of a goddess named mata rani', 395009, '1003, Shilp Appt, Makanji Park, Adajan', 'Surat', 'Gujarat', 'India', 8000, 200, '08-04-2023', '8:41 am'),
(18, 11, 'flower', './arts_files/Artist/D_italiya/Shop/flower/3ea1c2ec-n2.jpg', 'Painting', 'Flower', '2022', 3, 'Brush', 'Cenvas', 'Abstract,canvas,painting', 'Flower Port', 30, 30, 'the great picture of sunset Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit, blanditiis accusamus magnam nam excepturi eligendi velit culpa ea quasi voluptate animi, quod cum vel quaerat voluptatem itaque ducimus nostrum! Ab id eius ex sed!', 395009, '1003, Shilp Appt, Makanji Park, Adajan', 'Surat', 'Gujarat', 'India', 8000, 200, '08-04-2023', '8:46 am'),
(19, 11, 'Goddess with liion', './arts_files/Artist/D_italiya/Shop/Goddess with liion/2e45d6f3-a7.jpeg', 'Painting', 'Animal', '2017', 2, 'Brush', 'Cenvas', 'Abstract,canvas,painting', 'Mata Rani', 45, 45, 'this the great picture of a goddess named mata rani ,A mother goddess having various roles and manifestations, especially as Durga, Lakshmi, and Sarasvati, the female counterparts to the male gods of the Trimurti.', 395004, '87,nandanvan Soc, Causeway Road', 'Surat', 'Gujarat', 'India', 4000, 100, '08-04-2023', '8:48 am'),
(20, 11, 'thread art', './arts_files/Artist/D_italiya/Shop/thread art/c82edc41-cr3.jpg', 'Craft', 'Interior', '2017', 4, 'Needle', 'Thread', 'Thread Wall Piece', 'Thread Wall Piece', 20, 20, 'this the great picture of a goddess named  ,A mother goddess having various roles and manifestations, especially as Durga, Lakshmi, and Sarasvati, the female counterparts to the male gods of the Trimurti.', 395004, '87,nandanvan Soc, Causeway Road', 'Surat', 'Gujarat', 'India', 3000, 100, '08-04-2023', '8:51 am'),
(21, 24, 'eyes face', './arts_files/Artist/dev_italiya/Shop/eyes face/5c8aa83f-a2.jpeg', 'Painting', 'Girl', '2015', 3, 'Brush,paint', 'Cenvas', 'Abstract,canvas,painting', 'Eyes', 30, 30, 'the great picture of sunset Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit, blanditiis accusamus magnam nam excepturi eligendi velit culpa ea quasi voluptate animi, quod cum vel quaerat voluptatem itaque ducimus nostrum! Ab id eius ex sed!', 395009, '1003, Shilp Appt, Makanji Park, Adajan', 'Surat', 'Gujarat', 'India', 5000, 100, '08-04-2023', '8:54 am'),
(22, 24, 'bird', './arts_files/Artist/dev_italiya/Shop/bird/7e34aef5-mcgill-library-y4PqRPqSako-unsplash.jpg', 'Painting', 'Animal', '2021', 3, 'Brush', 'Canvas', 'Abstract,canvas,painting', 'Bird', 25, 25, 'the great picture of sunset Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit, blanditiis accusamus magnam nam excepturi eligendi velit culpa ea quasi voluptate animi, quod cum vel quaerat voluptatem itaque ducimus nostrum! Ab id eius ex sed!', 395004, '87,nandanvan Soc, Causeway Road', 'Surat', 'Gujarat', 'India', 4000, 150, '08-04-2023', '8:56 am'),
(23, 24, 'war', './arts_files/Artist/dev_italiya/Shop/war/20960425-adrianna-geo-1rBg5YSi00c-unsplash (1).jpg', 'Digital Art', 'Abstract', '2016', 5, 'Brush', 'Cenvas', 'Painting', 'War', 20, 20, 'the great picture of sunset Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit, blanditiis accusamus magnam nam excepturi eligendi velit culpa ea quasi voluptate animi, quod cum vel quaerat voluptatem itaque ducimus nostrum! Ab id eius ex sed!', 395003, 'Katargam', 'Surat', 'Gujarat', 'India', 2500, 100, '08-04-2023', '8:58 am'),
(24, 24, 'girl', './arts_files/Artist/dev_italiya/Shop/girl/e52c518f-digital.jpg', 'Digital Art', 'Girl', '2018', 5, 'Hand,paint', 'Cenvas', 'Abstract', 'Beautifull Girl', 30, 30, 'this the great picture of a goddess named mata rani ,A mother goddess having various roles and manifestations, especially as Durga, Lakshmi, and Sarasvati, the female counterparts to the male gods of the Trimurti.', 395004, 'Katargam', 'Surat', 'Gujarat', 'India', 4500, 100, '08-04-2023', '9:01 am'),
(25, 25, 'shell', './arts_files/Artist/m_ptl/Shop/shell/4a96edcc-cr4.jpg', 'Craft', 'Interior', '2022', 4, 'Knife', 'Shell', 'Wall Piece', 'Shell Wall Piece', 20, 20, 'this the great picture of a goddess named  ,A mother goddess having various roles and manifestations, especially as Durga, Lakshmi, and Sarasvati, the female counterparts to the male gods of the Trimurti.', 395004, '87,nandanvan Soc, Causeway Road', 'Surat', 'Gujarat', 'India', 5000, 150, '08-04-2023', '9:06 am'),
(26, 11, 'barbie doll', './arts_files/Artist/D_italiya/Shop/barbie doll/e3ee73bd-n1.jpg', 'Painting', 'Girl', '2022', 2, 'Brush', 'Cenvas', 'Abstract,canvas,painting', 'Barbie Doll,beautifull Girl', 45, 45, 'this the great picture of a goddess named mata rani ,A mother goddess having various roles and manifestations, especially as Durga, Lakshmi, and Sarasvati, the female counterparts to the male gods of the Trimurti.', 395009, '1003, Shilp Appt, Makanji Park, Adajan', 'Surat', 'Gujarat', 'India', 3500, 100, '08-04-2023', '9:11 am'),
(27, 25, 'wooden art', './arts_files/Artist/m_ptl/Shop/wooden art/0cf2984d-sc3.jpg', 'Craft', 'Interior', '2022', 4, 'Needle', 'Wooden', 'Decoration,wall Piece', 'Wall Piece', 30, 30, 'this the great picture of a goddess named  ,A mother goddess having various roles and manifestations, especially as Durga, Lakshmi, and Sarasvati, the female counterparts to the male gods of the Trimurti.', 395004, '87,nandanvan Soc, Causeway Road', 'Surat', 'Gujarat', 'India', 3550, 100, '08-04-2023', '9:20 am'),
(28, 11, 'beautiful nature', './arts_files/Artist/D_italiya/Shop/beautiful nature/a2c27ece-a8.jpeg', 'Photography', 'Flower', '1999', 3, 'Canvas,brush', 'Thread', 'Painting,wall Piece', 'Nature,beautiful', 40, 35, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', 395009, '1003, Shilp Appt, Makanji Park, Adajan', 'Surat', 'Gujarat', 'India', 2000, 300, '08-04-2023', '11:02 am'),
(29, 25, 'Best from waste', './arts_files/Artist/m_ptl/Shop/Best from waste/6484e588-cr1.jpg', 'Craft', 'Architecture', '2021', 6, 'Hand', 'Stick,glue', 'Pen Stand', 'Pen Stand,stick,Best From Waste,stand,pen', 20, 15, 'this is very rare creation that is pen stand of sticks. It is one of the Best of waste creation from the candy sticks which can be very useful for stand the pens......', 395009, '1003, Shilp Appt, Makanji Park, Adajan', 'Surat', 'Gujarat', 'India', 500, 100, '18-04-2023', '11:45 pm'),
(30, 25, 'Scripts design', './arts_files/Artist/m_ptl/Shop/Scripts design/2050fa23-craft.jpg', 'Craft', 'Flower', '2018', 3, 'Hand', 'Scripts,paper Script', 'Flower,abstract', 'Scripts,hand Made,paper Scripts,flower', 10, 15, 'This is the best hand made creation .It is made up of paper scripts which is very trending.....', 395004, '10, Shreejivan Nagar, Dabholi Char Rasta', 'Surat', 'Gujarat', 'India', 200, 50, '25-04-2023', '11:34 pm');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shoporder`
--

CREATE TABLE IF NOT EXISTS `tbl_shoporder` (
  `shoporder_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `shop_emailid` text NOT NULL,
  `shop_contactnumber` text NOT NULL,
  `shop_streetaddress` text NOT NULL,
  `shop_city` text NOT NULL,
  `shop_state` text NOT NULL,
  `shop_country` text NOT NULL,
  `shop_zipcode` int(11) NOT NULL,
  `shop_amount` text NOT NULL,
  `shop_paymentmode` text NOT NULL,
  `shop_paymentstatus` text NOT NULL,
  `shop_orderstatus` text NOT NULL,
  `shop_date` text NOT NULL,
  `shop_time` text NOT NULL,
  PRIMARY KEY (`shoporder_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_shoporder`
--

INSERT INTO `tbl_shoporder` (`shoporder_id`, `cart_id`, `shop_emailid`, `shop_contactnumber`, `shop_streetaddress`, `shop_city`, `shop_state`, `shop_country`, `shop_zipcode`, `shop_amount`, `shop_paymentmode`, `shop_paymentstatus`, `shop_orderstatus`, `shop_date`, `shop_time`) VALUES
(7, 32, 'gopikalathiya091@gmail.com', '8866762282', '1003, shilp appt, makanji park, Adajan', 'surat', 'Gujarat', 'India', 395009, '3600', 'OnlinePay', 'Done', 'Pending', '10-04-2023', '12:44 am'),
(8, 33, 'gopikalathiya091@gmail.com', '8866762282', '1003, shilp appt, makanji park, Adajan', 'surat', 'Gujarat', 'India', 395009, '5100', 'OnlinePay', 'Done', 'Processing', '10-04-2023', '12:44 am'),
(9, 34, 'shree34@gmail.com', '9537002376', '87,nandanvan soc, causeway road', 'surat', 'Gujarat', 'India', 395004, '0', 'OnlinePay', 'Done', 'Pickedup', '10-04-2023', '1:02 am'),
(10, 35, 'shree34@gmail.com', '9537002376', '87,nandanvan soc, causeway road', 'surat', 'Gujarat', 'India', 395004, '0', 'OnlinePay', 'Done', 'Pending', '10-04-2023', '1:02 am'),
(11, 36, 'gopikalathiya091@gmail.com', '08866762282', '1003, shilp appt, makanji park, adajan', 'surat', 'Gujarat', 'India', 395009, '0', 'OnlinePay', 'Done', 'Dispatched', '10-04-2023', '1:04 pm'),
(12, 37, 'gopikalathiya091@gmail.com', '08866762282', '1003, shilp appt, makanji park, adajan', 'surat', 'Gujarat', 'India', 395009, '0', 'OnlinePay', 'Done', 'Cancelled', '10-04-2023', '1:04 pm'),
(13, 38, 'shree981@gmail.com', '8866764567', '1010, shilpii appt, makai bridge near, nanpura', 'surat', 'Gujarat', 'India', 395006, '0', 'OnlinePay', 'Done', 'Cancelled', '18-04-2023', '11:51 pm'),
(14, 39, 'nupoorkalathiya01@gmail.com', '8866762281', '10, shreeji nagar -2 ,katargam', 'surat', 'Gujarat', 'India', 395004, '0', 'OnlinePay', 'Done', 'Cancelled', '20-04-2023', '9:26 pm'),
(15, 40, 'nkakadiya34@gmail.com', '9537002377', '34, vrindavan soc, ved', 'surat', 'Gujarat', 'India', 395003, '0', 'OnlinePay', 'Done', 'Pending', '25-04-2023', '11:58 pm');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE IF NOT EXISTS `tbl_state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`state_id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`state_id`, `state_name`, `country_id`) VALUES
(1, 'Gujarat', 1),
(2, 'Maharashtra', 1),
(3, 'Punjab', 1),
(4, 'Rajasthan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE IF NOT EXISTS `tbl_subcategory` (
  `subcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `subcategory_name` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_status` text NOT NULL,
  PRIMARY KEY (`subcategory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcategory_id`, `subcategory_name`, `category_id`, `subcategory_status`) VALUES
(1, 'Black and White photography', 2, 'active'),
(2, 'charcoal', 6, 'active'),
(3, 'simple', 6, 'active'),
(4, 'Relief Sculpture ', 3, 'active'),
(5, 'Sculpture in the Round', 7, 'active'),
(6, 'abstract', 1, 'active'),
(7, 'oil painting', 1, 'active'),
(8, 'acrylic Painting', 1, 'active'),
(9, 'Water color', 1, 'active'),
(10, 'Gouache', 1, 'active'),
(11, 'pastel painting', 1, 'active'),
(12, 'Encaustic', 1, 'active'),
(13, 'oil on canvas', 1, 'active'),
(14, 'Glass Painting', 1, 'active'),
(15, 'Realistic Painting', 1, 'active'),
(16, 'carved sculpture', 3, 'active'),
(17, 'cast sculpture', 3, 'active'),
(18, 'Additive sculpture', 3, 'active'),
(19, 'Subtraction Sculpture', 1, 'active'),
(20, 'Assembled Sculpture', 1, 'active'),
(21, 'Modeled Sculpture', 1, 'active'),
(22, 'Installation Sculptures', 1, 'active'),
(23, 'kinetic Sculptures', 3, 'active'),
(24, 'wild photography', 2, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE IF NOT EXISTS `tbl_subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(30) NOT NULL,
  `subject_status` varchar(8) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`subject_id`, `subject_name`, `subject_status`) VALUES
(1, 'Abstract', 'active'),
(2, 'Animal', 'active'),
(3, 'Architecture', 'active'),
(4, 'Body', 'active'),
(5, 'Bike', 'active'),
(6, 'Car', 'deactive'),
(7, 'Nature', 'deactive'),
(8, 'Education', 'active'),
(9, 'Interior', 'active'),
(10, 'flower', 'active'),
(11, 'girl', 'active'),
(12, 'boy', 'active'),
(14, 'RadheShyam', 'active');
