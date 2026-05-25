-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Bulan Mei 2026 pada 02.58
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_fraglogue`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_perfume` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id_category`, `category_name`, `description`) VALUES
(1, 'Warm & Sweet', 'Parfum dengan nuansa hangat, manis, vanilla, dan rempah oriental yang mewah.'),
(2, 'Fresh & Citrus', 'Aroma segar diekstrak dari buah sitrus, sangat cocok untuk siang hari dan energik.'),
(3, 'Woody & Earthy', 'Nuansa kayu maskulin, oud, cedarwood, memberikan impresi elegan dan dewasa.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorites`
--

CREATE TABLE `favorites` (
  `id_favorite` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_perfume` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `favorites`
--

INSERT INTO `favorites` (`id_favorite`, `id_user`, `id_perfume`) VALUES
(4, 6, 153),
(5, 6, 177),
(3, 7, 155);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Paid & Confirmed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `total_price`, `order_date`, `status`) VALUES
(1, 7, 8250000.00, '2026-05-22 17:30:17', 'Paid & Confirmed'),
(2, 6, 7050000.00, '2026-05-22 18:26:10', 'Paid & Confirmed');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id_order_item` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_perfume` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_at_purchase` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id_order_item`, `id_order`, `id_perfume`, `quantity`, `price_at_purchase`) VALUES
(1, 1, 154, 1, 6100000.00),
(2, 1, 166, 1, 2150000.00),
(3, 2, 155, 1, 3950000.00),
(4, 2, 158, 1, 3100000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perfumes`
--

CREATE TABLE `perfumes` (
  `id_perfume` int(11) NOT NULL,
  `fragella_id` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `id_category` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `main_notes` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perfumes`
--

INSERT INTO `perfumes` (`id_perfume`, `fragella_id`, `name`, `brand`, `id_category`, `price`, `main_notes`, `image_url`, `description`) VALUES
(152, 'frag-005', 'Tobacco Vanille', 'Tom Ford', 1, 4950000.00, 'Tobacco, Vanilla, Cacao, Dried Fruits', 'https://fimgs.net/images/perfume/m.1825.jpg', 'Perpaduan megah antara aroma tembakau Inggris yang aristokratik dengan kemanisan vanilla oriental yang intim.'),
(153, 'frag-006', 'Black Opium', 'Yves Saint Laurent', 1, 2450000.00, 'Coffee, Vanilla, Pear, Jasmine', 'https://fimgs.net/images/perfume/m.25325.jpg', 'Aroma adiktif berbasis kopi hitam yang sensual dipadukan dengan manisnya vanilla, memancarkan energi glamor.'),
(154, 'frag-007', 'Baccarat Rouge 540', 'Maison Francis Kurkdjian', 1, 6100000.00, 'Saffron, Jasmine, Amberwood, Cedar', 'https://fimgs.net/images/perfume/m.33519.jpg', 'Mahakarya wewangian yang sangat puitis. Berkarakter manis jernih berkat perpaduan melati, saffron, dan amberwood.'),
(155, 'frag-008', 'Angels Share', 'Kilian Paris', 1, 3950000.00, 'Cognac, Cinnamon, Tonka Bean, Oak', 'https://fimgs.net/images/perfume/m.62615.jpg', 'Terinspirasi dari warisan minuman keras suling, menghasilkan aroma kayu cognac manis kayu manis yang sangat eksklusif.'),
(156, 'frag-009', 'Lost Cherry', 'Tom Ford', 1, 5400000.00, 'Bitter Almond, Black Cherry, Plum, Rose', 'https://fimgs.net/images/perfume/m.51411.jpg', 'Perjalanan aroma penuh kejutan dari buah ceri hitam eksotis yang ranum, dilapisi manisnya likor almond.'),
(157, 'frag-010', 'Spicebomb Extreme', 'Viktor & Rolf', 1, 2100000.00, 'Black Pepper, Tobacco, Vanilla, Pimento', 'https://fimgs.net/images/perfume/m.30440.jpg', 'Ledakan rempah-rempah hangat berapi yang diredam dengan kelembutan tembakau dan vanilla bourbon intens.'),
(158, 'frag-011', 'Noir Extreme', 'Tom Ford', 1, 3100000.00, 'Cardamom, Kulfi, Amber, Sandalwood', 'https://fimgs.net/images/perfume/m.29965.jpg', 'Wewangian amber woody berhias aroma kulfi tradisional India, mendefinisikan pria yang berani tampil beda.'),
(159, 'frag-012', 'Good Girl', 'Carolina Herrera', 1, 2250000.00, 'Almond, Coffee, Tuberose, Tonka Bean', 'https://fimgs.net/images/perfume/m.39681.jpg', 'Representasi dualitas wanita modern yang elegan sekaligus misterius, berkat kehangatan tonka bean dan tuberose.'),
(160, 'frag-013', 'Ultra Male', 'Jean Paul Gaultier', 1, 1950000.00, 'Pear, Lavender, Mint, Cinnamon, Vanilla', 'https://fimgs.net/images/perfume/m.30947.jpg', 'Aroma manis buah pir jantan yang sangat memikat, menjadikannya pilihan utama untuk pesta malam hari.'),
(161, 'frag-014', 'Stronger With You Intensely', 'Emporio Armani', 1, 1850000.00, 'Chestnut, Pink Pepper, Toffee, Vanilla', 'https://fimgs.net/images/perfume/m.52845.jpg', 'Kisah cinta kontemporer yang manis, tercermin dari paduan aroma toffee karamel hangat dan kacang chestnut.'),
(162, 'frag-015', 'By the Fireplace', 'Maison Margiela', 1, 2400000.00, 'Cloves, Chestnut, Guaiac Wood, Vanilla', 'https://fimgs.net/images/perfume/m.31623.jpg', 'Menghidupkan kembali memori pagi musim dingin yang tenang di depan perapian yang hangat dan berasap.'),
(163, 'frag-016', 'Khamrah', 'Lattafa', 1, 850000.00, 'Cinnamon, Dates, Praline, Amber, Myrrh', 'https://fimgs.net/images/perfume/m.75805.jpg', 'Aroma manis timur tengah yang mewah dengan dominasi buah kurma, kayu manis, dan praline cokelat.'),
(164, 'frag-017', 'Herod', 'Parfums de Marly', 1, 4200000.00, 'Cinnamon, Pepper, Tobacco Leaf, Incense', 'https://fimgs.net/images/perfume/m.16934.jpg', 'Wewangian gourmet tembakau yang spektakuler, memberikan impresi agung, smoky, sekaligus lembut manis.'),
(165, 'frag-018', 'Hypnotic Poison', 'Dior', 1, 2350000.00, 'Coconut, Plum, Pimento, Vanilla, Almond', 'https://fimgs.net/images/perfume/m.219.jpg', 'Ramuan magis modern yang menghipnotis lewat aroma manis kelapa murni, almond pahit, dan vanilla pekat.'),
(166, 'frag-019', 'La Vie Est Belle', 'Lancome', 1, 2150000.00, 'Black Currant, Pear, Iris, Praline', 'https://fimgs.net/images/perfume/m.14982.jpg', 'Pernyataan universal tentang keindahan hidup melalui keanggunan bunga iris Prancis dan kelezatan praline.'),
(167, 'frag-020', 'Alien', 'Mugler', 1, 2450000.00, 'Jasmine, Woodsy Notes, Amber', 'https://fimgs.net/images/perfume/m.707.jpg', 'Parfum oriental woody misterius yang mendasarkan kekuatannya pada kemewahan ekstrak melati sambac matahari.'),
(168, 'frag-021', 'Scandal', 'Jean Paul Gaultier', 1, 2100000.00, 'Honey, Blood Orange, Patchouli, Gardenia', 'https://fimgs.net/images/perfume/m.45476.jpg', 'Kombinasi madu manis berlimpah yang provokatif dengan kesegaran jeruk blood orange untuk wanita bernyali.'),
(169, 'frag-022', 'Aventus', 'Creed', 2, 5900000.00, 'Pineapple, Bergamot, Birch, Musk', 'https://fimgs.net/images/perfume/m.9828.jpg', 'Simbol kesuksesan dan kekuasaan. Memadukan kesegaran buah nanas ikonis dengan sentuhan smoky kayu birch.'),
(170, 'frag-023', 'Sauvage Eau de Toilette', 'Dior', 2, 2100000.00, 'Calabrian Bergamot, Pepper, Ambroxan', 'https://fimgs.net/images/perfume/m.31861.jpg', 'Komposisi segar yang sangat radikal dan mentah. Menampilkan bergamot yang tajam di atas pondasi ambroxan raksasa.'),
(171, 'frag-024', 'Acqua Di Gio', 'Giorgio Armani', 2, 1750000.00, 'Lime, Lemon, Jasmine, Marine Notes', 'https://fimgs.net/images/perfume/m.410.jpg', 'Wewangian akuatik klasik legendaris yang menangkap kesegaran angin laut Mediterania dan sinar matahari.'),
(172, 'frag-025', 'Light Blue Intense Pour Homme', 'Dolce & Gabbana', 2, 1650000.00, 'Mandarin Orange, Frozen Grapefruit, Sea Water', 'https://fimgs.net/images/perfume/m.44034.jpg', 'Kesegaran koktail buah sitrus beku yang sangat adiktif berpadu dengan air laut asin yang maskulin.'),
(173, 'frag-026', 'Allure Homme Sport', 'Chanel', 2, 2400000.00, 'Orange, Sea Notes, Aldehydes, Cedar', 'https://fimgs.net/images/perfume/m.614.jpg', 'Kesegaran energetik yang dipadukan dengan sensualitas bersih dari aldehydes dan amber kristal.'),
(174, 'frag-027', 'Wood Sage & Sea Salt', 'Jo Malone London', 2, 2700000.00, 'Ambrette Seeds, Sea Salt, Sage, Grapefruit', 'https://fimgs.net/images/perfume/m.27352.jpg', 'Melarikan diri ke pesisir pantai Inggris yang berangin. Aroma mineral laut menyatu dengan aroma earthy dari sage.'),
(175, 'frag-028', 'Silver Mountain Water', 'Creed', 2, 5600000.00, 'Bergamot, Mandarin Orange, Green Tea, Black Currant', 'https://fimgs.net/images/perfume/m.472.jpg', 'Menangkap kemurnian aliran air pegunungan Alpen Swiss yang jernih, sejuk, dan membangkitkan semangat.'),
(176, 'frag-029', 'Neroli Portofino', 'Tom Ford', 2, 4500000.00, 'Bergamot, Mandarin Orange, Neroli, Lavender', 'https://fimgs.net/images/perfume/m.12196.jpg', 'Interpretasi modern dari cologne klasik Italia dengan minyak neroli yang bersemangat tinggi dan sitrus tajam.'),
(177, 'frag-030', 'Eros Eau de Toilette', 'Versace', 2, 1600000.00, 'Mint, Green Apple, Lemon, Tonka Bean', 'https://fimgs.net/images/perfume/m.16657.jpg', 'Manifestasi cinta dan gairah melalui kesegaran daun mint segar yang intens digabung dengan apel hijau ranum.'),
(178, 'frag-031', 'Dylan Blue Pour Homme', 'Versace', 2, 1550000.00, 'Calabrian Bergamot, Grapefruit, Fig Leaves, Papyrus', 'https://fimgs.net/images/perfume/m.39345.jpg', 'Wewangian fougere akuatik modern yang menangkap esensi pria Mediterania yang karismatik.'),
(179, 'frag-032', 'Luna Rossa Ocean', 'Prada', 2, 1900000.00, 'Bergamot, Pink Pepper, Iris, Lavender, Vetiver', 'https://fimgs.net/images/perfume/m.68611.jpg', 'Kesegaran neo-klasik yang memadukan kesegaran laut dengan keanggunan maskulin bunga iris.'),
(180, 'frag-033', 'L Eau d Issey Pour Homme', 'Issey Miyake', 2, 1450000.00, 'Yuzu, Lemon, Coriander, Blue Lotus, Vetiver', 'https://fimgs.net/images/perfume/m.721.jpg', 'Mencerminkan konsep harmoni air Jepang dengan kesegaran yuzu sitrus yang pahit dan elegan.'),
(181, 'frag-034', 'H24', 'Hermes', 2, 1950000.00, 'Clary Sage, Narcissus, Rosewood, Sclarene', 'https://fimgs.net/images/perfume/m.65523.jpg', 'Inovasi botani segar pertama dari Hermes yang memadukan sage aromatik dengan aroma metalik berteknologi tinggi.'),
(182, 'frag-035', 'Percival', 'Parfums de Marly', 2, 3950000.00, 'Lavender, Mandarin Orange, Bergamot, Violet', 'https://fimgs.net/images/perfume/m.51062.jpg', 'Sebuah parfum citrus aromatik berkelas tinggi dengan karakter proyeksi yang memukau bagi kaum jetset.'),
(183, 'frag-036', 'Cool Water Man', 'Davidoff', 2, 950000.00, 'Sea Water, Mint, Lavender, Rosemary, Sandalwood', 'https://fimgs.net/images/perfume/m.507.jpg', 'Pelopor wewangian laut modern yang sangat bersih, maskulin, dan memberikan kesegaran instan sepanjang hari.'),
(184, 'frag-037', 'Hacivat', 'Nishane', 2, 3800000.00, 'Pineapple, Grapefruit, Bergamot, Oakmoss', 'https://fimgs.net/images/perfume/m.44174.jpg', 'Aroma chypre kontemporer megah dengan nanas segar berdaya tahan luar biasa, lambang status sosial tinggi.'),
(185, 'frag-038', 'Colonia', 'Acqua Di Parma', 2, 2400000.00, 'Sicilian Citrus, Lavender, Rosemary, Light Musk', 'https://fimgs.net/images/perfume/m.1681.jpg', 'Cologne legendaris Italia yang murni, menyegarkan, dan melambangkan kemewahan abadi para bintang Hollywood kuno.'),
(186, 'frag-039', 'Oud Wood', 'Tom Ford', 3, 4500000.00, 'Agarwood (Oud), Rosewood, Cardamom, Sandalwood', 'https://fimgs.net/images/perfume/m.1826.jpg', 'Salah satu bahan paling langka dan berharga, kayu gaharu (oud), diolah secara smoky dan creamy yang misterius.'),
(187, 'frag-040', 'Santal 33', 'Le Labo', 3, 4400000.00, 'Sandalwood, Virginia Cedar, Cardamom, Leather', 'https://fimgs.net/images/perfume/m.12201.jpg', 'Wewangian kultus New York yang memadukan kayu cendana sensual dengan aroma kulit yang mentah dan adiktif.'),
(188, 'frag-041', 'Terre d Hermes Eau de Toilette', 'Hermes', 3, 1950000.00, 'Orange, Grapefruit, Flint, Vetiver, Cedar', 'https://fimgs.net/images/perfume/m.17.jpg', 'Narasi puitis yang mengeksplorasi hubungan pria dengan elemen bumi, memadukan mineral batu api dan kayu vetiver.'),
(189, 'frag-042', 'Sauvage Elixir', 'Dior', 3, 3150000.00, 'Cinnamon, Nutmeg, Cardamom, Lavender, Licorice', 'https://fimgs.net/images/perfume/m.68405.jpg', 'Konsentrasi parfum yang sangat ekstrem. Menampilkan rempah-rempah pekat yang diletakkan di atas lavender organik liar.'),
(190, 'frag-043', 'Bleu de Chanel Eau de Parfum', 'Chanel', 3, 2750000.00, 'Grapefruit, Incense, Amber, Cedarwood', 'https://fimgs.net/images/perfume/m.25967.jpg', 'Pernyataan kebebasan pria dalam aroma woody aromatik yang kaya dengan sentuhan dupa oriental yang anggun.'),
(191, 'frag-044', 'Ombre Leather', 'Tom Ford', 3, 3100000.00, 'Cardamom, Leather, Jasmine Sambac, Amber', 'https://fimgs.net/images/perfume/m.50652.jpg', 'Aroma kulit hitam premium yang intens, membangkitkan kebebasan ruang terbuka di gurun pasir barat Amerika.'),
(192, 'frag-045', 'Explorer', 'Montblanc', 3, 1450000.00, 'Bergamot, Haitian Vetiver, Indonesian Patchouli Leaf', 'https://fimgs.net/images/perfume/m.53429.jpg', 'Sebuah undangan petualangan fantastis melalui aroma vetiver Haiti berkelas dan kehangatan nilam Indonesia.'),
(193, 'frag-046', 'Cedrat Boise', 'Mancera', 3, 1900000.00, 'Sicilian Lemon, Black Currant, Woodsy Notes, Leather', 'https://fimgs.net/images/perfume/m.15211.jpg', 'Perpaduan brilian buah sitrus segar yang bertransisi menjadi karakter kayu maskulin dan kulit yang kaya.'),
(194, 'frag-047', 'Encre Noire', 'Lalique', 3, 1100000.00, 'Cypress, Haitian Vetiver, Bourbon Vetiver, Musk', 'https://fimgs.net/images/perfume/m.1834.jpg', 'Wewangian vetiver paling gelap dan gothic di dunia. Pekat seperti guratan tinta hitam di atas kertas mahal.'),
(195, 'frag-048', 'Interlude Man', 'Amouage', 3, 4600000.00, 'Oregano, Amber, Opoponax, Incense, Leather', 'https://fimgs.net/images/perfume/m.15115.jpg', 'Dikenal sebagai \"Blue Beast\". Parfum dupa dan amber raksasa timur tengah yang mendramatisasi kekacauan dan kedamaian.'),
(196, 'frag-049', 'Layton', 'Parfums de Marly', 3, 4200000.00, 'Apple, Lavender, Mandarin Orange, Violet, Vanilla', 'https://fimgs.net/images/perfume/m.40315.jpg', 'Wewangian bangsawan Versailles abad ke-18. Fougere aristokrat dengan apel renyah di atas basis kayu manis.'),
(197, 'frag-050', 'La Nuit de l Homme', 'Yves Saint Laurent', 3, 1950000.00, 'Cardamom, Bergamot, Lavender, Virginia Cedar', 'https://fimgs.net/images/perfume/m.5514.jpg', 'Aroma kapulaga hangat yang legendaris, menjadikannya senjata andalan pria untuk kencan romantis malam hari.'),
(198, 'frag-051', 'Green Irish Tweed', 'Creed', 3, 5600000.00, 'Lemon Verbena, Iris, Violet Leaf, Ambergris', 'https://fimgs.net/images/perfume/m.474.jpg', 'Menggambarkan keanggunan berjalan-jalan di pedesaan Irlandia yang hijau terhampar luas penuh embun pagi.'),
(199, 'frag-052', 'Code Parfum', 'Giorgio Armani', 3, 2200000.00, 'Bergamot, Iris, Clary Sage, Tonka Bean, Cedarwood', 'https://fimgs.net/images/perfume/m.75338.jpg', 'Menulis ulang aturan kode maskulinitas baru melalui dasar kayu cedar kokoh dilapisi kelembutan bunga iris.'),
(200, 'frag-053', 'Coach Green', 'Coach', 3, 1400000.00, 'Kiwi, Bergamot, Rosemary, Geranium, Cedar, Moss', 'https://fimgs.net/images/perfume/m.81308.jpg', 'Terinspirasi dari oasis hijau di tengah hiruk pikuk kota New York, segar di awal lalu mengunci ke aroma kayu pinus.'),
(201, 'frag-054', 'L Homme Prada', 'Prada', 3, 1850000.00, 'Neroli, Black Pepper, Iris, Amber, Patchouli', 'https://fimgs.net/images/perfume/m.39465.jpg', 'Definisi aroma bersih \"luxury clean sheet\". Perpaduan iris dan amber berkelas seperti mengenakan kemeja putih mahal.'),
(202, 'frag-055', 'Spiritueuse Double Vanille', 'Guerlain', 1, 5500000.00, 'Vanilla, Rum, Incense, Pink Pepper', 'https://fimgs.net/images/perfume/m.1012.jpg', 'Salah satu mahakarya vanilla terbaik di dunia, berpadu dengan kehangatan rum emas yang sangat aristokratik.'),
(203, 'frag-056', 'Tobacco Oud', 'Tom Ford', 1, 4800000.00, 'Tobacco, Agarwood (Oud), Whiskey, Spicy Notes', 'https://fimgs.net/images/perfume/m.21401.jpg', 'Aroma adiktif jantan yang menggabungkan tembakau Arab berharga tinggi dengan kayu gaharu dan wiski tua.'),
(204, 'frag-057', 'Feve Delicieuse', 'Dior', 1, 4600000.00, 'Tonka Bean, Caramel, Milk, Praline', 'https://fimgs.net/images/perfume/m.30164.jpg', 'Karya haute-gourmand yang mengeksplorasi tonka bean yang manis eksotis, dilapisi lelehan karamel hangat.'),
(205, 'frag-058', 'Oajan', 'Parfums de Marly', 1, 4100000.00, 'Cinnamon, Honey, Amber, Labdanum', 'https://fimgs.net/images/perfume/m.21550.jpg', 'Wewangian oriental yang membawa Anda ke dalam kemewahan istana dengan aroma kayu manis berlapis madu murni.'),
(206, 'frag-059', 'Grand Soir', 'Maison Francis Kurkdjian', 1, 3850000.00, 'Amber, Siam Benzoin, Vanilla, Tonka Bean', 'https://fimgs.net/images/perfume/m.39965.jpg', 'Menangkap keindahan malam kota Paris yang berkilau lewat kehangatan amber murni dan vanilla premium.'),
(207, 'frag-060', 'Shalimar Eau de Parfum', 'Guerlain', 1, 2300000.00, 'Citrus, Iris, Jasmine, Vanilla, Opoponax', 'https://fimgs.net/images/perfume/m.53.jpg', 'Pelopor parfum oriental dunia, terinspirasi dari kisah cinta abadi Kaisar Shah Jahan di taman Shalimar.'),
(208, 'frag-061', 'Vanilla Sex', 'Tom Ford', 1, 5600000.00, 'Bitter Almond, Vanilla Tincture, Absolute Vanilla', 'https://fimgs.net/images/perfume/m.89315.jpg', 'Eksplorasi vanilla modern yang provokatif, memadukan tincture vanilla eksklusif dengan almond pahit.'),
(209, 'frag-062', 'Jazz Club', 'Maison Margiela', 1, 2400000.00, 'Pink Pepper, Rum, Tobacco Leaf, Vanilla', 'https://fimgs.net/images/perfume/m.20541.jpg', 'Membawa atmosfer bar jazz klasik di Brooklyn melalui aroma kepulan cerutu, rum, dan alunan melodi manis.'),
(210, 'frag-063', 'Lira', 'Xerjoff', 1, 4300000.00, 'Blood Orange, Lavender, Caramel, Cinnamon', 'https://fimgs.net/images/perfume/m.11801.jpg', 'Aroma kue lemon karamel panggang yang sangat glamor dan menggoda, sebuah mahakarya dari lini Casamorati.'),
(211, 'frag-064', 'Italica', 'Xerjoff', 1, 4600000.00, 'Almond, Milk, Saffron, Toffee, Bourbon Vanilla', 'https://fimgs.net/images/perfume/m.41908.jpg', 'Kombinasi kaya dari susu hangat, saffron langka, dan toffee manis yang memberikan kehangatan tak tertandingi.'),
(212, 'frag-065', 'Naxos', 'Xerjoff', 1, 4500000.00, 'Lavender, Honey, Tobacco, Cinnamon, Vanilla', 'https://fimgs.net/images/perfume/m.30454.jpg', 'Merayakan jantung Mediterania dengan madu manis yang kaya, berpadu dengan tembakau emas yang anggun.'),
(213, 'frag-066', 'Bouquet Ideale', 'Xerjoff', 1, 4100000.00, 'Cinnamon, Nutmeg, Guaiac Wood, Vanilla, Musk', 'https://fimgs.net/images/perfume/m.11800.jpg', 'Mimpi musim gugur yang puitis, dipenuhi rempah kayu berharga dan kehangatan vanilla kental.'),
(214, 'frag-067', 'Side Effect', 'Initio Parfums Prives', 1, 4400000.00, 'Rum, Vanilla, Tobacco, Cinnamon', 'https://fimgs.net/images/perfume/m.42260.jpg', 'Aroma adiktif yang merangsang indra, memadukan rum sensual, tembakau premium, dan sedikit kayu manis.'),
(215, 'frag-068', 'Absolute Aphrodisiac', 'Initio Parfums Prives', 1, 4400000.00, 'White Flowers, Amber, Vanilla, Musk, Castoreum', 'https://fimgs.net/images/perfume/m.30990.jpg', 'Wewangian musky-vanilla yang gelap dan sensual, dirancang khusus untuk memancarkan aura daya pikat murni.'),
(216, 'frag-069', 'Psychedelic Love', 'Initio Parfums Prives', 1, 4500000.00, 'Bergamot, Rose, Myrrh, Vanilla, Heliotrope', 'https://fimgs.net/images/perfume/m.46503.jpg', 'Rahasia transedental aroma mawar merah pekat yang dipadukan dengan kemewahan getah myrrh dan vanilla.'),
(217, 'frag-070', 'Pas Ce Soir', 'BDK Parfums', 1, 3100000.00, 'Black Pepper, Ginger, Quince, Moroccan Jasmine', 'https://fimgs.net/images/perfume/m.40156.jpg', 'Wewangian chic khas wanita modern Paris dengan rasa buah quince manis berbalut kehangatan jahe pedas.'),
(218, 'frag-071', 'Rouge Smoking', 'BDK Parfums', 1, 3100000.00, 'Cherry, Pink Pepper, Black Vanilla, Tonka Bean', 'https://fimgs.net/images/perfume/m.51654.jpg', 'Terinspirasi dari gaya distrik mode Pigalle, menyajikan ceri merah manis dibalut kepekatan vanilla hitam.'),
(219, 'frag-072', 'Gris Charnel', 'BDK Parfums', 1, 3200000.00, 'Fig, Black Tea, Cardamom, Iris, Bourbon Vetiver', 'https://fimgs.net/images/perfume/m.57242.jpg', 'Kombinasi lembut buah ara dan teh hitam yang menenangkan, berpadu elegan dengan sentuhan kapulaga.'),
(220, 'frag-073', 'Changing Constance', 'Penhaligons', 1, 4200000.00, 'Pimento, Cardamom, Salted Caramel, Cashmeran', 'https://fimgs.net/images/perfume/m.51528.jpg', 'Potret wanita modern yang berani mendobrak tradisi, diwakili oleh aroma gurih dari karamel asin premium.'),
(221, 'frag-074', 'The Bewitching Yasmine', 'Penhaligons', 1, 4350000.00, 'Cardamom, Coffee, Jasmine Sambac, Incense, Laos Oud', 'https://fimgs.net/images/perfume/m.46363.jpg', 'Parfum oriental yang memikat dengan aroma misterius kopi hitam pekat, dupa, dan kemewahan kayu gaharu Laos.'),
(222, 'frag-075', 'Vanilla Powder', 'Matiere Premiere', 1, 3600000.00, 'Coconut, Vanilla Absolute, Palo Santo, White Musk', 'https://fimgs.net/images/perfume/m.84435.jpg', 'Eksplorasi kebersihan vanilla bubuk yang modern dengan sentuhan magis kayu suci Palo Santo.'),
(223, 'frag-076', 'Babycat', 'Yves Saint Laurent', 1, 5200000.00, 'Pink Pepper, Black Pepper, Suede, Vanilla, Olibanum', 'https://fimgs.net/images/perfume/m.73234.jpg', 'Parfum langka yang sangat dicari, memadukan kelembutan kulit suede dengan vanilla smoky yang misterius.'),
(224, 'frag-077', 'Tuxedo', 'Yves Saint Laurent', 1, 4500000.00, 'Violet Leaf, Bergamot, Rose, Patchouli, Ambergris', 'https://fimgs.net/images/perfume/m.32261.jpg', 'Ketajaman potongan setelan jas formal haute couture yang diwakili oleh patchouli gelap dan keanggunan ambergris.'),
(225, 'frag-078', 'Rosendo Mateu No 5', 'Rosendo Mateu', 1, 2850000.00, 'Exotic Floral Notes, Spices, Carnation, Amber, Musk', 'https://fimgs.net/images/perfume/m.44315.jpg', 'Wewangian musk amber yang magis dengan transisi aroma bunga eksotis dan bubuk rempah yang elegan.'),
(226, 'frag-079', 'Ani', 'Nishane', 1, 3400000.00, 'Ginger, Bergamot, Pink Pepper, Turkish Rose, Vanilla', 'https://fimgs.net/images/perfume/m.54784.jpg', 'Diakui sebagai salah satu parfum vanilla terbaik abad ini, dibuka dengan kesegaran jahe dan ditutup kemewahan vanilla.'),
(227, 'frag-080', 'Hundred Silent Ways', 'Nishane', 1, 3200000.00, 'Mandarin Orange, Peach, Tuberose, Jasmine, Sandalwood', 'https://fimgs.net/images/perfume/m.37845.jpg', 'Sebuah penghormatan puitis untuk cinta tanpa kata lewat aroma buah persik manis dan keanggunan melati putih.'),
(228, 'frag-081', 'Delina Exclusif', 'Parfums de Marly', 1, 4450000.00, 'Pear, Litchi, Incense, Turkish Rose, Amber', 'https://fimgs.net/images/perfume/m.48011.jpg', 'Wewangian mawar Turki termewah dengan sentuhan buah leci oriental dan kepulan asap dupa yang megah.'),
(229, 'frag-082', 'Casamorati 1888', 'Xerjoff', 1, 3950000.00, 'Coriander, Cloves, Green Pepper, Neroli, Birch', 'https://fimgs.net/images/perfume/m.21650.jpg', 'Aroma rempah vintage Italia kuno yang membawa impresi bangsawan klasik di akhir abad ke-19.'),
(230, 'frag-083', 'Choco Violet', 'Mancera', 1, 1850000.00, 'Orange, Hazelnut, Dark Chocolate, Violet, Madagascar Vanilla', 'https://fimgs.net/images/perfume/m.38465.jpg', 'Keunikan cokelat hitam pekat berpadu dengan hazelnut gurih serta kelembutan bunga violet yang anggun.'),
(231, 'frag-084', 'Instant Crush', 'Mancera', 1, 1950000.00, 'Saffron, Ginger, Sicilian Mandarin, Amberwood', 'https://fimgs.net/images/perfume/m.54523.jpg', 'Gelombang romansa instan dari manisnya saffron mewah dan kayu amberwood yang memancarkan proyeksi raksasa.'),
(232, 'frag-085', 'Roses Vanille', 'Mancera', 1, 1850000.00, 'Lemon, Water Notes, Rose, Sugar, Vanilla, White Musk', 'https://fimgs.net/images/perfume/m.15210.jpg', 'Aroma kelopak mawar yang direndam dalam sirup gula manis hangat dan kelembutan white musk bersih.'),
(233, 'frag-086', 'Ambre Nuit', 'Dior', 1, 4600000.00, 'Amber, Bergamot, Grapefruit, Turkish Rose, Pink Pepper', 'https://fimgs.net/images/perfume/m.30163.jpg', 'Pertemuan malam yang intim antara kepekatan amber hewani dengan keanggunan mawar Turki klasik.'),
(234, 'frag-087', 'Vanilla 28', 'Kayali', 1, 2100000.00, 'Jasmine, Madagascan Vanilla, Brown Sugar, Tonka Bean', 'https://fimgs.net/images/perfume/m.52615.jpg', 'Lapisan gula cokelat pekat dan vanilla Madagaskar murni yang menjadikannya pondasi layering terbaik.'),
(235, 'frag-088', 'Mefisto', 'Xerjoff', 2, 4100000.00, 'Grapefruit, Bergamot, Amalfi Lemon, Iris, Lavender', 'https://fimgs.net/images/perfume/m.11798.jpg', 'Wewangian citrus-floral Italia dengan kelembutan bunga iris bangsawan yang sangat bersih dan menyegarkan.'),
(236, 'frag-089', 'Renaissance', 'Xerjoff', 2, 4100000.00, 'Petitgrain, Mint, Mandarin Orange, Calabrian Bergamot', 'https://fimgs.net/images/perfume/m.11799.jpg', 'Ledakan aroma daun mint segar dipadu buah sitrus Calabria murni, merayakan kelahiran kembali seni Italia.'),
(237, 'frag-090', 'Torino21', 'Xerjoff', 2, 4500000.00, 'Mint, Lemon, Basil, Rosemary, Jasmine, Blackcurrant', 'https://fimgs.net/images/perfume/m.70425.jpg', 'Parfum resmi turnamen tenis ATP Finals, menghadirkan kesegaran kemangi, lemon beku, dan mint yang luar biasa energetik.'),
(238, 'frag-091', 'Torino22', 'Xerjoff', 2, 4600000.00, 'Bergamot, Saffron, Eucalyptus, Clary Sage, Guaiac Wood', 'https://fimgs.net/images/perfume/m.76815.jpg', 'Kesegaran modern dari minyak kayu eukaliptus berpadu dengan kemewahan saffron dan daun sage.'),
(239, 'frag-092', 'Uden', 'Xerjoff', 2, 4500000.00, 'Grapefruit, Lemon, Rhum, Rose, Guaiac Wood, Coffee', 'https://fimgs.net/images/perfume/m.6304.jpg', 'Kombinasi unik antara kesegaran jeruk lemon pantai dengan esensi rum mewah dan biji kopi hangat.'),
(240, 'frag-093', 'Wulong Cha', 'Nishane', 2, 3200000.00, 'Bergamot, Orange, Litsea Cubeba, Oolong Tea, Nutmeg', 'https://fimgs.net/images/perfume/m.37846.jpg', 'Aroma seduhan teh oolong Cina terbaik dengan perasan jeruk bergamot, sangat menenangkan dan tahan lama.'),
(241, 'frag-094', 'Ambra Calabria', 'Nishane', 2, 3100000.00, 'Bergamot, Galbanum, Green Leaves, Jasmine, Amber', 'https://fimgs.net/images/perfume/m.37843.jpg', 'Transisi romantis dari dedaunan hijau sitrus yang segar menuju kehangatan dasar amber yang kaya.'),
(242, 'frag-095', 'Elysium Pour Homme', 'Roja Parfums', 2, 4950000.00, 'Lemon, Bergamot, Lime, Thyme, Artemisia, Vetiver', 'https://fimgs.net/images/perfume/m.47466.jpg', 'Wewangian mewah kelas elite yang memadukan kesegaran buah sitrus ultra-premium dengan ketajaman vetiver.'),
(243, 'frag-096', 'Ocean Leather', 'Memo Paris', 2, 4100000.00, 'Mandarin Orange, Basil, Violet Leaf, Leather, Cedar', 'https://fimgs.net/images/perfume/m.61654.jpg', 'Menangkap kekuatan samudra luas, memadukan hembusan mineral laut segar dengan keanggunan kulit hitam.'),
(244, 'frag-097', 'Marfa', 'Memo Paris', 2, 4200000.00, 'Orange Blossom, Mandarin Orange, Tuberose, Agave', 'https://fimgs.net/images/perfume/m.39163.jpg', 'Terinspirasi dari kota seni di gurun Texas, menonjolkan aroma sedap malam yang segar berpadu dengan nektar agave.'),
(245, 'frag-098', 'Sailing Day', 'Maison Margiela', 2, 2400000.00, 'Sea Notes, Aldehydes, Coriander, Red Seaweed', 'https://fimgs.net/images/perfume/m.47715.jpg', 'Sensasi menyelam ke dalam laut biru yang jernih, dipenuhi kesegaran ozonik dari rumput laut merah.'),
(246, 'frag-099', 'Under the Lemon Trees', 'Maison Margiela', 2, 2400000.00, 'Kalamansi, Petitgrain, Cardamom, Green Tea, Cedar', 'https://fimgs.net/images/perfume/m.53234.jpg', 'Menghidupkan kembali memori bersantai di bawah rindangnya kebun jeruk lemon di Palermo, Sisilia.'),
(247, 'frag-100', 'Beach Walk', 'Maison Margiela', 2, 2400000.00, 'Bergamot, Pink Pepper, Coconut Milk, Ylang-Ylang', 'https://fimgs.net/images/perfume/m.15234.jpg', 'Aroma kulit hangat yang terkena sinar matahari pantai, dilapisi gurihnya susu kelapa dan kesegaran bergamot.'),
(248, 'frag-101', 'Aqua Celestia', 'Maison Francis Kurkdjian', 2, 3600000.00, 'Lime, Cool Mint, Blackcurrant, Mimosa, Musk', 'https://fimgs.net/images/perfume/m.43454.jpg', 'Pertemuan surgawi antara birunya langit dan laut, terwujud lewat jeruk nipis segar dan mint dingin.'),
(249, 'frag-102', 'Aqua Universalis', 'Maison Francis Kurkdjian', 2, 3500000.00, 'Bergamot, Amalfi Lemon, White Flowers, Light Musk', 'https://fimgs.net/images/perfume/m.6754.jpg', 'Definisi kebersihan murni, bagaikan kemeja katun putih mahal yang baru saja selesai dicuci bersih.'),
(250, 'frag-103', 'Aqua Vitae', 'Maison Francis Kurkdjian', 2, 3500000.00, 'Calabrian Lemon, Mandarin Orange, Hedione, Guaiac Wood', 'https://fimgs.net/images/perfume/m.18523.jpg', 'Air kehidupan yang menangkap kehangatan sinar matahari sore di atas kulit dengan sitrus yang berkilau.'),
(251, 'frag-104', '724 Eau de Parfum', 'Maison Francis Kurkdjian', 2, 3900000.00, 'Aldehydes, Calabrian Bergamot, Egyptian Jasmine, Musk', 'https://fimgs.net/images/perfume/m.75845.jpg', 'Energi kehidupan kota metropolitan 24 jam penuh yang diwakili oleh kesegaran aldehydes perkotaan modern.'),
(252, 'frag-105', 'Amyris Homme', 'Maison Francis Kurkdjian', 2, 3650000.00, 'Rosemary, Mandarin Orange, Amyris, Coconut, Iris', 'https://fimgs.net/images/perfume/m.15545.jpg', 'Keanggunan kasual pria urban, memadukan kesegaran jeruk mandarin dengan kelembutan kayu amyris Jamaika.'),
(253, 'frag-106', 'Greenley', 'Parfums de Marly', 2, 4100000.00, 'Sicilian Bergamot, Green Apple, Cashmeran, Cedarwood', 'https://fimgs.net/images/perfume/m.62123.jpg', 'Semburan energi dari buah apel hijau yang renyah dan segar, berpadu dengan kekokohan kayu cedar hutan.'),
(254, 'frag-107', 'Sedley', 'Parfums de Marly', 2, 4100000.00, 'Mint, Lemon, Bergamot, Rosemary, Lavender, Ambroxan', 'https://fimgs.net/images/perfume/m.56154.jpg', 'Parfum akuatik-aromatik modern berkelas tinggi yang memberikan efek kesegaran dingin bertenaga ambroxan.'),
(255, 'frag-108', 'Galloway', 'Parfums de Marly', 2, 3950000.00, 'Citrus Notes, Pepper, Iris, Orange Blossom, Musk', 'https://fimgs.net/images/perfume/m.23415.jpg', 'Wewangian citrus-clean dengan sentuhan lada putih dan kelembutan musk yang memberikan impresi bersih formal.'),
(256, 'frag-109', 'Darley', 'Parfums de Marly', 2, 3800000.00, 'Mint, Bergamot, Lemon, Cinnamon, Lavender, Amber', 'https://fimgs.net/images/perfume/m.8163.jpg', 'Citrus aromatik klasik yang beralih manis, dirancang untuk pria berwibawa tinggi yang menyukai olahraga berkuda.'),
(257, 'frag-110', 'Mandorlo di Sicilia', 'Acqua Di Parma', 2, 2300000.00, 'Green Almond, Star Anise, Orange, Mediterranean Peach', 'https://fimgs.net/images/perfume/m.22384.jpg', 'Menangkap kelembutan angin pulau Sisilia dengan aroma kacang almond hijau manis dan buah persik segar.'),
(258, 'frag-111', 'Fico di Amalfi', 'Acqua Di Parma', 2, 2200000.00, 'Grapefruit, Bergamot, Citron, Fig Nectar, Jasmine', 'https://fimgs.net/images/perfume/m.2163.jpg', 'Aroma nektar buah ara manis yang dipadukan dengan ledakan sitrus segar di sepanjang pantai Amalfi.'),
(259, 'frag-112', 'Arancia di Capri', 'Acqua Di Parma', 2, 2150000.00, 'Orange, Mandarin, Lemon, Petitgrain, Cardamom', 'https://fimgs.net/images/perfume/m.2165.jpg', 'Merayakan keasrian buah jeruk Capri yang matang di pohon, memberikan kesegaran alami yang murni.'),
(260, 'frag-113', 'Mirto di Panarea', 'Acqua Di Parma', 2, 2200000.00, 'Myrtle, Basil, Lemon, Sea Notes, Jasmine, Juniper', 'https://fimgs.net/images/perfume/m.3163.jpg', 'Kesegaran aromatik tanaman myrtle dipadu hembusan ombak mineral laut dari pulau terpencil Italia.'),
(261, 'frag-114', 'Bergamotto di Calabria', 'Acqua Di Parma', 2, 2300000.00, 'Calabrian Bergamot, Citron, Red Ginger, Cedarwood', 'https://fimgs.net/images/perfume/m.8545.jpg', 'Wewangian bergamot paling otentik dan murni, dipertegas oleh kehangatan jahe merah eksotis.'),
(262, 'frag-115', 'Lemon Line', 'Mancera', 2, 1850000.00, 'Lemon, Orange, Lavender, White Musk, Oakmoss', 'https://fimgs.net/images/perfume/m.24654.jpg', 'Aroma permen lemon mewah yang bersih, tajam menyegarkan, ditopang kekuatan white musk yang kokoh.'),
(263, 'frag-116', 'Cedrat Boise Intense', 'Mancera', 2, 2100000.00, 'Sicilian Citrus, Blackcurrant, Oud, Leather, Sandalwood', 'https://fimgs.net/images/perfume/m.72154.jpg', 'Versi lebih pekat dari sang legenda, menambahkan ekstra kayu gaharu murni dan buah sitrus Sisilia.'),
(264, 'frag-117', 'Sicily', 'Mancera', 2, 1850000.00, 'Mandarin, Peach, Pineapple, Apple, Jasmine, Ylang-Ylang', 'https://fimgs.net/images/perfume/m.41654.jpg', 'Koktail buah-buahan tropis yang sangat berair dan cerah, menangkap energi kehangatan musim panas.'),
(265, 'frag-118', 'Vibrant Leather', 'Zara', 2, 590000.00, 'Bergamot, Bamboo, Leather', 'https://fimgs.net/images/perfume/m.50345.jpg', 'Wewangian kasual segar yang memadukan kecerahan bergamot dengan kesegaran bambu hijau dan kulit ringan.'),
(266, 'frag-119', 'Club de Nuit Intense Man', 'Armaf', 2, 750000.00, 'Lemon, Pineapple, Blackcurrant, Birch, Ambergris', 'https://fimgs.net/images/perfume/m.34635.jpg', 'Parfum andalan pria dengan aroma nanas smoky legendaris yang memiliki daya sebar proyeksi luar biasa.'),
(267, 'frag-120', 'Hawas for Him', 'Rasasi', 2, 850000.00, 'Apple, Bergamot, Cinnamon, Water Notes, Cardamom', 'https://fimgs.net/images/perfume/m.36465.jpg', 'Parfum akuatik manis yang sangat populer, memadukan buah apel renyah dengan kesegaran air laut buatan.'),
(268, 'frag-121', 'Pegasus', 'Parfums de Marly', 3, 4100000.00, 'Beramot, Heliotrope, Bitter Almond, Lavender, Sandalwood', 'https://fimgs.net/images/perfume/m.11825.jpg', 'Wewangian fougere berkelas tinggi dengan dominasi almond pahit yang memberikan kesan metalik elegan.'),
(269, 'frag-122', 'Carlisle', 'Parfums de Marly', 3, 4650000.00, 'Bergamot, Mandarin, Guaiac Wood, Patchouli, Vanilla', 'https://fimgs.net/images/perfume/m.33515.jpg', 'Kegelapan kayu guaiac yang berpadu misterius dengan manisnya vanilla, menciptakan impresi karisma gelap.'),
(270, 'frag-123', 'Kalan', 'Parfums de Marly', 3, 4100000.00, 'Blood Orange, Black Pepper, Lavender, Moss, Sandalwood', 'https://fimgs.net/images/perfume/m.56515.jpg', 'Aroma bumi berlumut merah yang dibakar oleh lada hitam tajam dan kemewahan buah jeruk blood orange.'),
(271, 'frag-124', 'Haltane', 'Parfums de Marly', 3, 4550000.00, 'Clary Sage, Lavender, Saffron, Praline, Oud', 'https://fimgs.net/images/perfume/m.70154.jpg', 'Eksplorasi modern kayu gaharu (oud) berharga yang dilapisi manisnya praline cokelat aristokrat Prancis.'),
(272, 'frag-125', 'Oud Maracuja', 'Maison Crivelli', 3, 4300000.00, 'Passionfruit, Saffron, Turkish Rose, Oud, Leather', 'https://fimgs.net/images/perfume/m.82435.jpg', 'Inovasi spektakuler yang menabrakkan keasaman buah markisa segar dengan kepekatan kayu gaharu bumi.'),
(273, 'frag-126', 'African Leather', 'Memo Paris', 3, 4100000.00, 'Cardamom, Geranium, Leather, Vetiver, Oud', 'https://fimgs.net/images/perfume/m.32454.jpg', 'Petualangan di savana Afrika yang luas, terwakili oleh ketajaman kapulaga hangat dan kulit premium.'),
(274, 'frag-127', 'Irish Leather', 'Memo Paris', 3, 4100000.00, 'Juniper Berries, Green Mate, Leather, Amber', 'https://fimgs.net/images/perfume/m.18545.jpg', 'Kesegaran pagi pedesaan Irlandia yang beku lewat aroma buah juniper buah beri dan kulit yang mentah.'),
(275, 'frag-128', 'Italian Leather', 'Memo Paris', 3, 4200000.00, 'Tomato Leaf, Vanilla, Leather, Galbanum', 'https://fimgs.net/images/perfume/m.21634.jpg', 'Keunikan aroma daun tomat hijau segar berpadu manis dengan kemewahan interior kulit mobil sport Italia.'),
(276, 'frag-129', 'French Leather', 'Memo Paris', 3, 4100000.00, 'Lime, Rose, Suede, White Musk', 'https://fimgs.net/images/perfume/m.28545.jpg', 'Gaya minimalis kasual khas Prancis, menggabungkan kelopak mawar romantis dengan kelembutan kulit suede.'),
(277, 'frag-130', 'Tam Dao Eau de Parfum', 'Diptyque', 3, 2900000.00, 'Lime, Ginger, Sandalwood, Cedar, Amberwood', 'https://fimgs.net/images/perfume/m.18541.jpg', 'Meditasi spiritual di dalam hutan Asia kuno lewat aroma kayu cendana murni Goa yang menenangkan.'),
(278, 'frag-131', 'Philosykos Eau de Parfum', 'Diptyque', 3, 2900000.00, 'Fig Leaves, Fig, Coconut, Cedarwood', 'https://fimgs.net/images/perfume/m.3865.jpg', 'Wewangian buah ara terbaik di dunia, menangkap seluruh bagian pohon ara mulai dari daun hijau hingga batangnya.'),
(279, 'frag-132', 'Tempo', 'Diptyque', 3, 2850000.00, 'Bergamot, Pink Pepper, Patchouli, Maté', 'https://fimgs.net/images/perfume/m.48545.jpg', 'Sebuah penghormatan untuk budaya era 1960-an lewat kepekatan daun nilam (patchouli) earthy yang anggun.'),
(280, 'frag-133', 'Ombre Nomade', 'Louis Vuitton', 3, 6500000.00, 'Agarwood (Oud), Geranium, Raspberry, Rose, Incense', 'https://fimgs.net/images/perfume/m.49754.jpg', 'Kemewahan tanpa batas dari gurun pasir Timur Tengah, mendominasi lewat perpaduan buah raspberry dan gaharu agung.'),
(281, 'frag-134', 'Imagination', 'Louis Vuitton', 3, 4900000.00, 'Calabrian Bergamot, Citron, Black Tea, Nigerian Ginger, Ambres', 'https://fimgs.net/images/perfume/m.67515.jpg', 'Karya seni modern yang memadukan kesegaran jeruk sitrus dengan kemewahan teh hitam berbalut jahe Nigeria.'),
(282, 'frag-135', 'Nouveau Monde', 'Louis Vuitton', 3, 5100000.00, 'Agarwood (Oud), Cocoa, Saffron, Rose, Leather', 'https://fimgs.net/images/perfume/m.49755.jpg', 'Penjelajahan dunia baru lewat kejutan rasa cokelat kakao pahit yang menyatu dengan kayu gaharu hewani.'),
(283, 'frag-136', 'Orage', 'Louis Vuitton', 3, 4900000.00, 'Bergamot, Grapefruit, Iris, Hedione, Patchouli, Javanese Vetiver', 'https://fimgs.net/images/perfume/m.49756.jpg', 'Menggambarkan kekuatan badai alam melalui perpaduan bunga iris mewah dan akar vetiver Jawa yang earthy.'),
(284, 'frag-137', 'Sycomore', 'Chanel', 3, 5300000.00, 'Vetiver, Sandalwood, Aldehydes, Tobacco, Violet', 'https://fimgs.net/images/perfume/m.4215.jpg', 'Wewangian vetiver legendaris dari rumah mode Chanel, berkarakter smoky kayu kering yang sangat berkelas.'),
(285, 'frag-138', 'Coromandel', 'Chanel', 3, 5300000.00, 'Bitter Orange, Neroli, Patchouli, White Chocolate, Frankincense', 'https://fimgs.net/images/perfume/m.4214.jpg', 'Terinspirasi dari layar Coromandel Cina, menyajikan nilam pekat yang dilapisi kelezatan cokelat putih.'),
(286, 'frag-139', 'Encre Noire A L\'Extreme', 'Lalique', 3, 1350000.00, 'Elemi, Bergamot, Cypress, Incense, Vetiver, Sandalwood', 'https://fimgs.net/images/perfume/m.32452.jpg', 'Evolusi dari sang legenda gothic, menambahkan resin elemi dan kepulan dupa dupa untuk memperkuat nuansa misterius.'),
(287, 'frag-140', 'Vetiver Extraordinaire', 'Frederic Malle', 3, 4400000.00, 'Bitter Orange, Pink Pepper, Vetiver, Cedar, Oakmoss', 'https://fimgs.net/images/perfume/m.4715.jpg', 'Menggunakan dosis vetiver esensial tertinggi dalam sejarah parfum, memancarkan wibawa murni pria sejati.'),
(288, 'frag-141', 'French Lover', 'Frederic Malle', 3, 4300000.00, 'Pimento, Galbanum, Angelica, Cedar, Incense, Oakmoss', 'https://fimgs.net/images/perfume/m.4716.jpg', 'Aroma mentah hutan basah setelah hujan, didominasi kayu angelica hijau dan cedarwood jantan.'),
(289, 'frag-142', 'Musc Ravageur', 'Frederic Malle', 3, 4500000.00, 'Lavender, Bergamot, Cinnamon, Cloves, Vanilla, Musk', 'https://fimgs.net/images/perfume/m.4717.jpg', 'Parfum musk legendaris yang sensual dan provokatif, dilapisi bubuk cengkeh rempah hangat dan vanilla.'),
(290, 'frag-143', 'Santal Majuscule', 'Serge Lutens', 3, 2950000.00, 'Damask Rose, Cacao, Sandalwood', 'https://fimgs.net/images/perfume/m.15523.jpg', 'Seni memahat kayu cendana murni yang dilapisi kepekatan bubuk cokelat pahit dan mawar Damaskus.'),
(291, 'frag-144', 'Chergui', 'Serge Lutens', 3, 2850000.00, 'Tobacco Leaf, Honey, Amber, Hay, Incense, Sandalwood', 'https://fimgs.net/images/perfume/m.2763.jpg', 'Dinamai dari angin gurun Maroko yang panas, membawa kehangatan daun tembakau kering berlapis madu.'),
(292, 'frag-145', 'Ambre Sultan', 'Serge Lutens', 3, 2900000.00, 'Coriander, Sandalwood, Patchouli, Amber, Oregano', 'https://fimgs.net/images/perfume/m.2760.jpg', 'Standar emas untuk wewangian amber dunia, pekat dengan resin herbal gurun pasir Marrakech.'),
(293, 'frag-146', 'Fahrenheit Eau de Toilette', 'Dior', 3, 1950000.00, 'Lavender, Mandarin, Nutmeg, Violet Leaf, Leather', 'https://fimgs.net/images/perfume/m.218.jpg', 'Legenda maskulin yang revolusioner, memadukan keunikan daun violet berkarakter minyak bensin dengan kulit.'),
(294, 'frag-147', 'Grey Vetiver Eau de Parfum', 'Tom Ford', 3, 2950000.00, 'Grapefruit, Orange Blossom, Sage, Nutmeg, Vetiver', 'https://fimgs.net/images/perfume/m.6632.jpg', 'Pilihan utama para eksekutif muda, menampilkan vetiver yang sangat bersih, segar, dan berwibawa.'),
(295, 'frag-148', 'Costa Azzurra', 'Tom Ford', 3, 2850000.00, 'Driftwood, Seaweed, Oud, Celery Seeds, Oak, Vanilla', 'https://fimgs.net/images/perfume/m.25415.jpg', 'Pertemuan udara pantai Mediterania yang asin dengan pepohonan kayu oak tua yang basah di tepi tebing.'),
(296, 'frag-149', 'Beau de Jour', 'Tom Ford', 3, 2800000.00, 'Lavender, Rosemary, Mint, Oakmoss, Basil, Patchouli', 'https://fimgs.net/images/perfume/m.59154.jpg', 'Definisi ketampanan pria klasik salon pangkas rambut barbershop mewah lewat lavender bersih dan oakmoss.'),
(297, 'frag-150', 'Wood and Spice', 'Proraso', 3, 450000.00, 'Cumin, Saffron, Cedar, Sandalwood, Vanilla', 'https://fimgs.net/images/perfume/m.44615.jpg', 'Wewangian kayu hangat ekonomis berkarakter jantan dengan dominasi cedar dan saffron berharga.'),
(298, 'frag-151', 'Bentley For Men Intense', 'Bentley', 3, 950000.00, 'Black Pepper, Bergamot, Rum, Cinnamon, Woody Notes, Leather', 'https://fimgs.net/images/perfume/m.17634.jpg', 'Aroma super kaya berbiaya terjangkau, menyajikan sensasi kemewahan rum minuman keras, kayu, dan jaket kulit.'),
(299, 'frag-152', 'Encre Noire Sport', 'Lalique', 3, 1100000.00, 'Grapefruit, Bergamot, Water Notes, Cypress, Vetiver', 'https://fimgs.net/images/perfume/m.21415.jpg', 'Versi segar dari sang raja vetiver kegelapan, menyuntikkan mineral air laut dan perasan jeruk grapefruit.'),
(300, 'frag-153', 'Terroni', 'Orto Parisi', 3, 3400000.00, 'Smoky Notes, Earthy Notes, Woody Notes, Oud', 'https://fimgs.net/images/perfume/m.44523.jpg', 'Mahakarya yang menangkap kedalaman lava gunung berapi purba yang membakar bumi dengan aroma smoky gaharu raksasa.'),
(301, 'frag-154', 'L Homme Prada Intense', 'Prada', 3, 1950000.00, 'Iris, Amber, Leather, Patchouli, Tonka Bean', 'https://fimgs.net/images/perfume/m.45323.jpg', 'Sentuhan kemewahan maksimal yang memadukan kelembutan bunga iris kosmetik mahal dengan ketebalan kulit dan amber.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reviews`
--

CREATE TABLE `reviews` (
  `id_review` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_perfume` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`, `created_at`) VALUES
(6, 'admin', '$2y$10$pnGCMTJ/oApMtZ6rJgejJewmYzSzZIyA2wRZ.Fwa0k4m.yWSmn6U6', 'admin', '2026-05-22 16:17:16'),
(7, 'user', '$2y$10$DMJ9d4p8OZ70tXC73LX62O.d1IKUvigAc3W281Wz0frkyrarmekm6', 'user', '2026-05-22 17:17:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD UNIQUE KEY `unique_user_cart` (`id_user`,`id_perfume`),
  ADD KEY `id_perfume` (`id_perfume`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id_favorite`),
  ADD UNIQUE KEY `unique_user_perfume` (`id_user`,`id_perfume`),
  ADD KEY `id_perfume` (`id_perfume`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id_order_item`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_perfume` (`id_perfume`);

--
-- Indeks untuk tabel `perfumes`
--
ALTER TABLE `perfumes`
  ADD PRIMARY KEY (`id_perfume`),
  ADD UNIQUE KEY `fragella_id` (`fragella_id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indeks untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_perfume` (`id_perfume`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id_favorite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id_order_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `perfumes`
--
ALTER TABLE `perfumes`
  MODIFY `id_perfume` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT untuk tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_perfume`) REFERENCES `perfumes` (`id_perfume`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`id_perfume`) REFERENCES `perfumes` (`id_perfume`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`id_perfume`) REFERENCES `perfumes` (`id_perfume`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `perfumes`
--
ALTER TABLE `perfumes`
  ADD CONSTRAINT `perfumes_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`id_perfume`) REFERENCES `perfumes` (`id_perfume`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
