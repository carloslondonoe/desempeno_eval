-- --------------------------------------------------------
-- Host:                         192.99.42.180
-- Versión del servidor:         5.5.62-0+deb8u1 - (Debian)
-- SO del servidor:              debian-linux-gnu
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla clondono_mtbr.area
CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.area: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` (`id`, `area`, `descripcion`) VALUES
	(1, 'Dirercción Administrativa y Financiera', 'Dirercción Administrativa y Financiera'),
	(2, 'Dirección de Compras', 'Dirección de Compras'),
	(3, 'Dirección de Operaciones', 'Dirección de Operaciones'),
	(4, 'Direccción  UEN AMC/ N', 'Direccción  UEN AMC/ N'),
	(5, 'Gerencia General', 'Gerencia General');
/*!40000 ALTER TABLE `area` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cargo
CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `area` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cargo_area` (`area`),
  CONSTRAINT `FK_cargo_area` FOREIGN KEY (`area`) REFERENCES `area` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cargo: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` (`id`, `cargo`, `area`) VALUES
	(1, 'Contador', 1),
	(2, 'Coordinador de Talento Humano', 1),
	(3, 'Coordinador  TIC.', 1);
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cms_apicustom
CREATE TABLE IF NOT EXISTS `cms_apicustom` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permalink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tabel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kolom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_query_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sql_where` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `method_type` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` longtext COLLATE utf8mb4_unicode_ci,
  `responses` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cms_apicustom: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_apicustom` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_apicustom` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cms_apikey
CREATE TABLE IF NOT EXISTS `cms_apikey` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `screetkey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hit` int(11) DEFAULT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cms_apikey: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_apikey` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_apikey` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cms_dashboard
CREATE TABLE IF NOT EXISTS `cms_dashboard` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_cms_privileges` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cms_dashboard: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_dashboard` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_dashboard` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cms_email_queues
CREATE TABLE IF NOT EXISTS `cms_email_queues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `send_at` datetime DEFAULT NULL,
  `email_recipient` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_cc_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_content` text COLLATE utf8mb4_unicode_ci,
  `email_attachments` text COLLATE utf8mb4_unicode_ci,
  `is_sent` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cms_email_queues: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_email_queues` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_email_queues` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cms_email_templates
CREATE TABLE IF NOT EXISTS `cms_email_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cc_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cms_email_templates: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_email_templates` DISABLE KEYS */;
INSERT INTO `cms_email_templates` (`id`, `name`, `slug`, `subject`, `content`, `description`, `from_name`, `from_email`, `cc_email`, `created_at`, `updated_at`) VALUES
	(1, 'Email Template Forgot Password Backend', 'forgot_password_backend', NULL, '<p>Hi,</p><p>Someone requested forgot password, here is your new password : </p><p>[password]</p><p><br></p><p>--</p><p>Regards,</p><p>Admin</p>', '[password]', 'System', 'system@crudbooster.com', NULL, '2019-07-16 16:47:47', NULL),
	(2, 'Email Template Forgot Password Backend', 'forgot_password_backend', NULL, '<p>Hi,</p><p>Someone requested forgot password, here is your new password : </p><p>[password]</p><p><br></p><p>--</p><p>Regards,</p><p>Admin</p>', '[password]', 'System', 'system@crudbooster.com', NULL, '2019-07-16 16:48:11', NULL);
/*!40000 ALTER TABLE `cms_email_templates` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cms_logs
CREATE TABLE IF NOT EXISTS `cms_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `useragent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_cms_users` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cms_logs: ~112 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_logs` DISABLE KEYS */;
INSERT INTO `cms_logs` (`id`, `ipaddress`, `useragent`, `url`, `description`, `id_cms_users`, `created_at`, `updated_at`) VALUES
	(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/login', 'admin@crudbooster.com login with IP Address ::1', 1, '2019-07-16 17:12:13', NULL),
	(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/area/add-save', 'Add New Data 1 at Areas', 1, '2019-07-16 17:15:08', NULL),
	(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/area/delete/1', 'Delete data 1 at Áreas', 1, '2019-07-16 17:17:14', NULL),
	(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/area/add-save', 'Añadir nueva información 1 en Áreas', 1, '2019-07-16 17:21:01', NULL),
	(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/cargo/add-save', 'Añadir nueva información 1 en Cargos', 1, '2019-07-16 17:22:42', NULL),
	(6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/cms_users/edit-save/1', 'Actualizar información Carlos en Empleados', 1, '2019-07-16 17:59:33', NULL),
	(7, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/menu_management/add-save', 'Añadir nueva información Usuarios en Menu Management', 1, '2019-07-16 20:36:27', NULL),
	(8, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/menu_management/add-save', 'Añadir nueva información Evaluaciones en Menu Management', 1, '2019-07-16 21:03:05', NULL),
	(9, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/1', 'Actualizar información Areas en Menu Management', 1, '2019-07-16 21:05:33', NULL),
	(10, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/2', 'Actualizar información Cargos en Menu Management', 1, '2019-07-16 21:05:57', NULL),
	(11, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/3', 'Actualizar información Empleados en Menu Management', 1, '2019-07-16 21:06:28', NULL),
	(12, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/4', 'Actualizar información Competencias en Menu Management', 1, '2019-07-16 21:07:59', NULL),
	(13, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/4', 'Actualizar información Competencias en Menu Management', 1, '2019-07-16 21:08:13', NULL),
	(14, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/5', 'Actualizar información Comportamientos en Menu Management', 1, '2019-07-16 21:08:29', NULL),
	(15, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/6', 'Actualizar información Crear evaluaciones en Menu Management', 1, '2019-07-16 21:08:47', NULL),
	(16, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/statistic_builder/add-save', 'Añadir nueva información administrador en Statistic Builder', 1, '2019-07-16 21:34:44', NULL),
	(17, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/statistic_builder/add-save', 'Añadir nueva información cordinador en Statistic Builder', 1, '2019-07-16 21:34:56', NULL),
	(18, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/statistic_builder/add-save', 'Añadir nueva información colaborador en Statistic Builder', 1, '2019-07-16 21:35:05', NULL),
	(19, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/statistic_builder/add-save', 'Añadir nueva información general en Statistic Builder', 1, '2019-07-16 21:39:41', NULL),
	(20, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/statistic_builder/add-save', 'Añadir nueva información general en Statistic Builder', 1, '2019-07-16 21:43:44', NULL),
	(21, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/menu_management/add-save', 'Añadir nueva información Inicio en Menu Management', 1, '2019-07-16 21:46:25', NULL),
	(22, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/menu_management/add-save', 'Añadir nueva información Progreso en Menu Management', 1, '2019-07-16 22:29:40', NULL),
	(23, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/logout', 'admin@crudbooster.com se desconectó', 1, '2019-07-16 22:40:24', NULL),
	(24, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 1, '2019-07-16 22:40:45', NULL),
	(25, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/logout', 'admin@crudbooster.com se desconectó', 1, '2019-07-16 22:42:58', NULL),
	(26, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 1, '2019-07-16 22:43:17', NULL),
	(27, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/add-save', 'Añadir nueva información Usuarios en Menu Management', 1, '2019-07-16 22:45:23', NULL),
	(28, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/16', 'Actualizar información Empleados en Menu Management', 1, '2019-07-16 22:46:15', NULL),
	(29, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/cms_users/add-save', 'Añadir nueva información Administrador en Empleados', 1, '2019-07-16 22:47:17', NULL),
	(30, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 2, '2019-07-16 22:47:49', NULL),
	(31, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/logout', 'admanistrador@dfv.com se desconectó', 2, '2019-07-16 22:48:40', NULL),
	(32, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 2, '2019-07-16 22:48:47', NULL),
	(33, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/logout', 'admanistrador@dfv.com se desconectó', 2, '2019-07-16 22:52:12', NULL),
	(34, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 2, '2019-07-16 22:52:19', NULL),
	(35, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/logout', 'admanistrador@dfv.com se desconectó', 2, '2019-07-16 22:52:38', NULL),
	(36, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 2, '2019-07-16 22:52:47', NULL),
	(37, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/add-save', 'Añadir nueva información Evaluaciones en Menu Management', 1, '2019-07-16 22:54:48', NULL),
	(38, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/11', 'Actualizar información Áreas en Menu Management', 1, '2019-07-16 22:56:49', NULL),
	(39, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/12', 'Actualizar información Cargos en Menu Management', 1, '2019-07-16 22:57:07', NULL),
	(40, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/13', 'Actualizar información Competencias en Menu Management', 1, '2019-07-16 22:57:48', NULL),
	(41, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/14', 'Actualizar información Comportamientos en Menu Management', 1, '2019-07-16 22:58:03', NULL),
	(42, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/15', 'Actualizar información Crear evaluaciones en Menu Management', 1, '2019-07-16 22:58:35', NULL),
	(43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/10', 'Actualizar información Progreso en Menu Management', 1, '2019-07-16 23:03:20', NULL),
	(44, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/logout', 'admanistrador@dfv.com se desconectó', 2, '2019-07-16 23:03:49', NULL),
	(45, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 2, '2019-07-16 23:03:59', NULL),
	(46, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/10', 'Actualizar información Progreso en Menu Management', 1, '2019-07-16 23:04:34', NULL),
	(47, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 2, '2019-07-16 23:04:46', NULL),
	(48, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/10', 'Actualizar información Progreso en Menu Management', 1, '2019-07-16 23:07:18', NULL),
	(49, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/delete/9', 'Eliminar información Inicio en Menu Management', 1, '2019-07-16 23:11:30', NULL),
	(50, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/10', 'Actualizar información Progreso en Menu Management', 1, '2019-07-16 23:13:16', NULL),
	(51, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/logout', 'admanistrador@dfv.com se desconectó', 2, '2019-07-16 23:13:34', NULL),
	(52, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 2, '2019-07-16 23:13:42', NULL),
	(53, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/cms_users/add-save', 'Añadir nueva información Empleado en Empleados', 2, '2019-07-16 23:14:40', NULL),
	(54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/logout', 'admanistrador@dfv.com se desconectó', 2, '2019-07-16 23:14:50', NULL),
	(55, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 3, '2019-07-16 23:14:58', NULL),
	(56, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/logout', '12345@123.com se desconectó', 3, '2019-07-16 23:15:18', NULL),
	(57, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 2, '2019-07-16 23:17:00', NULL),
	(58, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/cms_users/edit-save/3', 'Actualizar información Empleado en Empleados', 2, '2019-07-16 23:19:50', NULL),
	(59, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/add-save', 'Añadir nueva información Progreso en Menu Management', 1, '2019-07-16 23:45:59', NULL),
	(60, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/10', 'Actualizar información Progreso en Menu Management', 1, '2019-07-16 23:46:38', NULL),
	(61, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/20', 'Actualizar información Progreso en Menu Management', 1, '2019-07-16 23:47:26', NULL),
	(62, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/add-save', 'Añadir nueva información Evaluaciones realizadas en Menu Management', 1, '2019-07-16 23:48:38', NULL),
	(63, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/delete/21', 'Eliminar información Evaluaciones realizadas en Menu Management', 1, '2019-07-16 23:50:03', NULL),
	(64, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/add-save', 'Añadir nueva información Evaluaciones realizadas en Menu Management', 1, '2019-07-16 23:50:48', NULL),
	(65, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/add-save', 'Añadir nueva información Evaluaciones Faltantes en Menu Management', 1, '2019-07-16 23:51:42', NULL),
	(66, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/add-save', 'Añadir nueva información Evaluaciones socializadas en Menu Management', 1, '2019-07-16 23:52:20', NULL),
	(67, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/add-save', 'Añadir nueva información Reportes en Menu Management', 1, '2019-07-16 23:54:26', NULL),
	(68, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/logout', 'admanistrador@dfv.com se desconectó', 2, '2019-07-16 23:55:13', NULL),
	(69, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 2, '2019-07-16 23:55:37', NULL),
	(70, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/menu_management/edit-save/10', 'Actualizar información Progreso en Menu Management', 1, '2019-07-16 23:56:01', NULL),
	(71, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 2, '2019-07-16 23:56:13', NULL),
	(72, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/competencia/add-save', 'Añadir nueva información 1 en Competencias', 2, '2019-07-17 00:19:42', NULL),
	(73, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 1 en Comportamientos', 2, '2019-07-17 00:20:20', NULL),
	(74, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 2 en Comportamientos', 2, '2019-07-17 00:21:57', NULL),
	(75, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 3 en Comportamientos', 2, '2019-07-17 00:23:19', NULL),
	(76, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 4 en Comportamientos', 2, '2019-07-17 00:23:36', NULL),
	(77, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 5 en Comportamientos', 2, '2019-07-17 00:23:53', NULL),
	(78, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 6 en Comportamientos', 2, '2019-07-17 00:24:05', NULL),
	(79, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 7 en Comportamientos', 2, '2019-07-17 00:24:20', NULL),
	(80, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/competencia/add-save', 'Añadir nueva información 2 en Competencias', 2, '2019-07-17 00:25:36', NULL),
	(81, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/competencia/add-save', 'Añadir nueva información 3 en Competencias', 2, '2019-07-17 00:26:16', NULL),
	(82, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 8 en Comportamientos', 2, '2019-07-17 00:26:48', NULL),
	(83, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 9 en Comportamientos', 2, '2019-07-17 00:26:59', NULL),
	(84, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 10 en Comportamientos', 2, '2019-07-17 00:27:09', NULL),
	(85, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 11 en Comportamientos', 2, '2019-07-17 00:27:18', NULL),
	(86, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 12 en Comportamientos', 2, '2019-07-17 00:27:30', NULL),
	(87, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 13 en Comportamientos', 2, '2019-07-17 00:27:57', NULL),
	(88, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 14 en Comportamientos', 2, '2019-07-17 00:28:07', NULL),
	(89, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 15 en Comportamientos', 2, '2019-07-17 00:28:16', NULL),
	(90, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 16 en Comportamientos', 2, '2019-07-17 00:28:25', NULL),
	(91, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 17 en Comportamientos', 2, '2019-07-17 00:28:39', NULL),
	(92, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/evaluacion/add-save', 'Añadir nueva información 1 en Crear evaluaciones', 2, '2019-07-17 00:32:05', NULL),
	(93, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 'http://localhost/motobordaeval/public/admin/evaluacion/edit-save/1', 'Actualizar información  en Crear evaluaciones', 2, '2019-07-17 00:32:45', NULL),
	(94, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 1, '2019-07-18 18:40:27', NULL),
	(95, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/competencia/add-save', 'Añadir nueva información 4 en Competencias', 1, '2019-07-18 19:14:48', NULL),
	(96, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 18 en Comportamientos', 1, '2019-07-18 19:17:22', NULL),
	(97, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/comportamiento/delete/18', 'Eliminar información 18 en Comportamientos', 1, '2019-07-18 19:18:41', NULL),
	(98, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/competencia/delete/4', 'Eliminar información 4 en Competencias', 1, '2019-07-18 19:18:48', NULL),
	(99, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/competencia/add-save', 'Añadir nueva información 4 en Competencias', 1, '2019-07-18 19:25:52', NULL),
	(100, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 18 en Comportamientos', 1, '2019-07-18 19:26:22', NULL),
	(101, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/comportamiento/add-save', 'Añadir nueva información 19 en Comportamientos', 1, '2019-07-18 19:26:26', NULL),
	(102, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 2, '2019-07-18 19:44:01', NULL),
	(103, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/area/edit-save/1', 'Actualizar información  en Áreas', 2, '2019-07-18 19:54:28', NULL),
	(104, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/area/add-save', 'Añadir nueva información 2 en Áreas', 2, '2019-07-18 19:54:52', NULL),
	(105, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/area/add-save', 'Añadir nueva información 3 en Áreas', 2, '2019-07-18 19:56:37', NULL),
	(106, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/area/add-save', 'Añadir nueva información 4 en Áreas', 2, '2019-07-18 19:57:00', NULL),
	(107, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/area/add-save', 'Añadir nueva información 5 en Áreas', 2, '2019-07-18 19:57:18', NULL),
	(108, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/cargo/edit-save/1', 'Actualizar información  en Cargos', 2, '2019-07-18 19:59:25', NULL),
	(109, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/cargo/add-save', 'Añadir nueva información 2 en Cargos', 2, '2019-07-18 20:04:40', NULL),
	(110, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/cargo/delete/2', 'Eliminar información 2 en Cargos', 2, '2019-07-18 20:07:19', NULL),
	(111, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/cargo/add-save', 'Añadir nueva información 2 en Cargos', 2, '2019-07-18 20:09:09', NULL),
	(112, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/cargo/add-save', 'Añadir nueva información 3 en Cargos', 2, '2019-07-18 20:09:27', NULL),
	(113, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/competencia/delete/4', 'Eliminar información 4 en Competencias', 2, '2019-07-18 21:06:54', NULL),
	(114, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/competencia/delete/4', 'Eliminar información 4 en Competencias', 2, '2019-07-18 21:07:32', NULL),
	(115, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/cms_users/edit-save/2', 'Actualizar información Administrador en Empleados', 2, '2019-07-18 21:41:36', NULL),
	(116, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/logout', 'admanistrador@dfv.com se desconectó', 2, '2019-07-18 22:23:17', NULL),
	(117, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/login', ':Login con Email desde la Dirección IP ::1', 2, '2019-07-18 22:23:44', NULL),
	(118, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/menu_management/delete/26', 'Eliminar información Users en Menu Management', 1, '2019-07-18 22:24:15', NULL),
	(119, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/menu_management/delete/25', 'Eliminar información Perfiles por cargo en Menu Management', 1, '2019-07-18 22:24:32', NULL),
	(120, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/perfiles/add-save', 'Añadir nueva información 1 en Perfiles por cargo', 2, '2019-07-18 22:25:53', NULL),
	(121, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/evaluacion/delete/1', 'Eliminar información 1 en Crear evaluaciones', 2, '2019-07-18 23:00:52', NULL),
	(122, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/evaluacion/add-save', 'Añadir nueva información 1 en Crear evaluaciones', 2, '2019-07-18 23:08:02', NULL),
	(123, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://localhost/motobordaeval/public/admin/evaluacion/add-save', 'Añadir nueva información 2 en Crear evaluaciones', 2, '2019-07-19 00:04:42', NULL),
	(124, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/login', ':Login con Email desde la Dirección IP 179.14.16.108', 2, '2019-07-19 02:53:34', NULL),
	(125, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/logout', 'admanistrador@dfv.com se desconectó', 2, '2019-07-19 02:55:34', NULL),
	(126, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/login', ':Login con Email desde la Dirección IP 179.14.16.108', 2, '2019-07-19 03:21:04', NULL),
	(127, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/logout', 'admanistrador@dfv.com se desconectó', 2, '2019-07-19 03:23:33', NULL),
	(128, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/login', ':Login con Email desde la Dirección IP 179.14.16.108', 1, '2019-07-19 03:26:15', NULL),
	(129, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/login', ':Login con Email desde la Dirección IP 179.14.16.108', 2, '2019-07-19 03:27:02', NULL),
	(130, '179.14.16.108', 'Mozilla/5.0 (Linux; Android 8.1.0; SM-J710MN) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.143 Mobile Safari/537.36', 'http://carloslondono.com.co/motoborda/admin/login', ':Login con Email desde la Dirección IP 179.14.16.108', 2, '2019-07-19 03:49:30', NULL),
	(131, '66.249.88.29', 'Mozilla/5.0 (Linux; Android 8.1.0; SM-J710MN) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.143 Mobile Safari/537.36', 'http://carloslondono.com.co/motoborda/admin/logout', 'admin@admin.com se desconectó', 2, '2019-07-19 03:51:17', NULL),
	(132, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/dudas/add-save', 'Añadir nueva información 1 en Inquietudes', 1, '2019-07-19 04:11:11', NULL),
	(133, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/dudas/add-save', 'Añadir nueva información 2 en Inquietudes', 1, '2019-07-19 04:15:01', NULL),
	(134, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/dudas/add-save', 'Añadir nueva información 3 en Inquietudes', 1, '2019-07-19 04:16:50', NULL),
	(135, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/dudas/add-save', 'Añadir nueva información 4 en Inquietudes', 1, '2019-07-19 04:19:07', NULL),
	(136, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/dudas/add-save', 'Añadir nueva información 5 en Inquietudes', 1, '2019-07-19 04:25:07', NULL),
	(137, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/dudas/edit-save/5', 'Actualizar información  en Inquietudes', 1, '2019-07-19 04:27:23', NULL),
	(138, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/dudas/edit-save/5', 'Actualizar información  en Inquietudes', 1, '2019-07-19 04:27:56', NULL),
	(139, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/dudas', 'Intentar ver :name en Inquietudes', 2, '2019-07-19 04:36:23', NULL),
	(140, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/dudas', 'Intentar ver :name en Inquietudes', 2, '2019-07-19 04:36:28', NULL),
	(141, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/dudas', 'Intentar ver :name en Inquietudes', 2, '2019-07-19 04:36:48', NULL),
	(142, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/menu_management/edit-save/25', 'Actualizar información Inquietudes en Menu Management', 1, '2019-07-19 04:37:48', NULL),
	(143, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/dudas', 'Intentar ver :name en Inquietudes', 2, '2019-07-19 04:37:56', NULL),
	(144, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/dudas', 'Intentar ver :name en Inquietudes', 2, '2019-07-19 04:38:00', NULL),
	(145, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/menu_management/edit-save/27', 'Actualizar información Inquietudes en Menu Management', 1, '2019-07-19 04:38:31', NULL),
	(146, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/dudas', 'Intentar ver :name en Inquietudes', 2, '2019-07-19 04:38:48', NULL),
	(147, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/dudas', 'Intentar ver :name en Inquietudes', 2, '2019-07-19 04:39:06', NULL),
	(148, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/logout', 'admin@admin.com se desconectó', 2, '2019-07-19 04:39:14', NULL),
	(149, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/login', ':Login con Email desde la Dirección IP 179.14.16.108', 2, '2019-07-19 04:39:27', NULL),
	(150, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/logout', 'admin@admin.com se desconectó', 2, '2019-07-19 04:41:07', NULL),
	(151, '179.14.16.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', 'http://carloslondono.com.co/motoborda/admin/login', ':Login con Email desde la Dirección IP 179.14.16.108', 2, '2019-07-19 04:41:18', NULL);
/*!40000 ALTER TABLE `cms_logs` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cms_menus
CREATE TABLE IF NOT EXISTS `cms_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'url',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_dashboard` tinyint(1) NOT NULL DEFAULT '0',
  `id_cms_privileges` int(11) DEFAULT NULL,
  `sorting` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cms_menus: ~22 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_menus` DISABLE KEYS */;
INSERT INTO `cms_menus` (`id`, `name`, `type`, `path`, `color`, `icon`, `parent_id`, `is_active`, `is_dashboard`, `id_cms_privileges`, `sorting`, `created_at`, `updated_at`) VALUES
	(1, 'Areas', 'Route', 'AdminAreaControllerGetIndex', 'normal', 'fa fa-arrow-circle-o-down', 7, 1, 0, 1, 1, '2019-07-16 17:13:11', '2019-07-16 21:05:33'),
	(2, 'Cargos', 'Route', 'AdminCargoControllerGetIndex', 'normal', 'fa fa-arrow-circle-o-up', 7, 1, 0, 1, 2, '2019-07-16 17:18:55', '2019-07-16 21:05:57'),
	(3, 'Empleados', 'Route', 'AdminCmsUsers1ControllerGetIndex', 'normal', 'fa fa-group', 7, 1, 0, 1, 3, '2019-07-16 17:41:47', '2019-07-16 21:06:28'),
	(4, 'Competencias', 'Route', 'AdminCompetenciaControllerGetIndex', 'normal', 'fa fa-star-o', 8, 1, 0, 1, 1, '2019-07-16 18:59:19', '2019-07-16 21:08:13'),
	(5, 'Comportamientos', 'Route', 'AdminComportamientoControllerGetIndex', 'normal', 'fa fa-check', 8, 1, 0, 1, 2, '2019-07-16 19:03:34', '2019-07-16 21:08:29'),
	(6, 'Crear evaluaciones', 'Route', 'AdminEvaluacionControllerGetIndex', 'normal', 'fa fa-share-square-o', 8, 1, 0, 1, 3, '2019-07-16 20:09:27', '2019-07-16 21:08:47'),
	(7, 'Usuarios', 'URL', '/', 'normal', 'fa fa-users', 0, 1, 0, 1, 3, '2019-07-16 20:36:27', NULL),
	(8, 'Evaluaciones', 'URL', '/', 'normal', 'fa fa-list-alt', 0, 1, 0, 1, 4, '2019-07-16 21:03:05', NULL),
	(10, 'Progreso', 'Statistic', 'statistic_builder/show/administrador', 'normal', 'fa fa-product-hunt', 0, 1, 1, 4, 1, '2019-07-16 22:29:40', '2019-07-16 23:56:01'),
	(11, 'Áreas', 'Route', 'AdminAreaControllerGetIndex', 'normal', 'fa fa-arrow-circle-o-down', 18, 1, 0, 4, 1, '2019-07-16 22:36:26', '2019-07-16 22:56:49'),
	(12, 'Cargos', 'Route', 'AdminCargoControllerGetIndex', 'normal', 'fa fa-arrow-circle-o-up', 18, 1, 0, 4, 2, '2019-07-16 22:36:26', '2019-07-16 22:57:07'),
	(13, 'Competencias', 'Route', 'AdminCompetenciaControllerGetIndex', 'normal', 'fa fa-star-o', 19, 1, 0, 4, 1, '2019-07-16 22:36:26', '2019-07-16 22:57:48'),
	(14, 'Comportamientos', 'Route', 'AdminComportamientoControllerGetIndex', 'normal', 'fa fa-check', 19, 1, 0, 4, 2, '2019-07-16 22:36:26', '2019-07-16 22:58:03'),
	(15, 'Crear evaluaciones', 'Route', 'AdminEvaluacionControllerGetIndex', 'normal', 'fa fa-share-square-o', 19, 1, 0, 4, 3, '2019-07-16 22:36:26', '2019-07-16 22:58:35'),
	(16, 'Empleados', 'Route', 'AdminCmsUsers1ControllerGetIndex', 'normal', 'fa fa-group', 18, 1, 0, 4, 3, '2019-07-16 22:36:26', '2019-07-16 22:46:15'),
	(18, 'Usuarios', 'URL', '/', 'normal', 'fa fa-group', 0, 1, 0, 4, 4, '2019-07-16 22:45:23', NULL),
	(19, 'Evaluaciones', 'URL', '/', 'normal', 'fa fa-list-alt', 0, 1, 0, 4, 5, '2019-07-16 22:54:47', NULL),
	(20, 'Progreso', 'URL', '/', 'normal', 'fa fa-product-hunt', 0, 1, 0, 4, 3, '2019-07-16 23:45:59', '2019-07-16 23:47:26'),
	(21, 'Evaluaciones realizadas', 'URL', '/', 'normal', 'fa fa-share-square-o', 20, 1, 0, 4, 3, '2019-07-16 23:50:48', NULL),
	(22, 'Evaluaciones faltantes', 'URL', '/', 'normal', 'fa fa-xing-square', 20, 1, 0, 4, 2, '2019-07-16 23:51:42', NULL),
	(23, 'Evaluaciones socializadas', 'URL', '/', 'normal', 'fa fa-road', 20, 1, 0, 4, 1, '2019-07-16 23:52:20', NULL),
	(24, 'Reportes', 'URL', '/', 'normal', 'fa fa-th', 0, 1, 0, 4, 2, '2019-07-16 23:54:26', NULL),
	(25, 'Temas varios', 'Module', 'dudas', 'normal', 'fa fa-arrow-circle-o-up', 0, 1, 0, 1, 6, '2019-07-19 04:02:04', '2019-07-19 04:37:48'),
	(27, 'Temas varios', 'Module', 'dudas', 'normal', 'fa fa-arrow-circle-o-up', 0, 1, 0, 4, 6, '2019-07-19 04:34:42', '2019-07-19 04:38:31'),
	(28, 'Perfiles por cargo', 'Route', 'AdminPerfilesControllerGetIndex', 'normal', 'fa fa-glass', 0, 0, 0, 4, 2, '2019-07-19 04:34:42', NULL),
	(29, 'Users', 'Route', 'AdminCmsUsersControllerGetIndex', 'normal', 'fa fa-users', 0, 0, 0, 4, 1, '2019-07-19 04:34:42', NULL);
/*!40000 ALTER TABLE `cms_menus` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cms_moduls
CREATE TABLE IF NOT EXISTS `cms_moduls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_protected` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cms_moduls: ~18 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_moduls` DISABLE KEYS */;
INSERT INTO `cms_moduls` (`id`, `name`, `icon`, `path`, `table_name`, `controller`, `is_protected`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Notifications', 'fa fa-cog', 'notifications', 'cms_notifications', 'NotificationsController', 1, 1, '2019-07-16 16:47:46', NULL),
	(2, 'Privileges', 'fa fa-cog', 'privileges', 'cms_privileges', 'PrivilegesController', 1, 1, '2019-07-16 16:47:46', NULL),
	(3, 'Privileges Roles', 'fa fa-cog', 'privileges_roles', 'cms_privileges_roles', 'PrivilegesRolesController', 1, 1, '2019-07-16 16:47:46', NULL),
	(4, 'Users', 'fa fa-users', 'users', 'cms_users', 'AdminCmsUsersController', 0, 1, '2019-07-16 16:47:46', NULL),
	(5, 'Settings', 'fa fa-cog', 'settings', 'cms_settings', 'SettingsController', 1, 1, '2019-07-16 16:47:46', NULL),
	(6, 'Module Generator', 'fa fa-database', 'module_generator', 'cms_moduls', 'ModulsController', 1, 1, '2019-07-16 16:47:46', NULL),
	(7, 'Menu Management', 'fa fa-bars', 'menu_management', 'cms_menus', 'MenusController', 1, 1, '2019-07-16 16:47:46', NULL),
	(8, 'Email Template', 'fa fa-envelope-o', 'email_templates', 'cms_email_templates', 'EmailTemplatesController', 1, 1, '2019-07-16 16:47:46', NULL),
	(9, 'Statistic Builder', 'fa fa-dashboard', 'statistic_builder', 'cms_statistics', 'StatisticBuilderController', 1, 1, '2019-07-16 16:47:46', NULL),
	(10, 'API Generator', 'fa fa-cloud-download', 'api_generator', '', 'ApiCustomController', 1, 1, '2019-07-16 16:47:46', NULL),
	(11, 'Logs', 'fa fa-flag-o', 'logs', 'cms_logs', 'LogsController', 1, 1, '2019-07-16 16:47:46', NULL),
	(12, 'Áreas', 'fa fa-glass', 'area', 'area', 'AdminAreaController', 0, 0, '2019-07-16 17:13:11', NULL),
	(13, 'Cargos', 'fa fa-glass', 'cargo', 'cargo', 'AdminCargoController', 0, 0, '2019-07-16 17:18:55', NULL),
	(14, 'Empleados', 'fa fa-glass', 'cms_users', 'cms_users', 'AdminCmsUsers1Controller', 0, 0, '2019-07-16 17:41:47', NULL),
	(15, 'Competencias', 'fa fa-glass', 'competencia', 'competencia', 'AdminCompetenciaController', 0, 0, '2019-07-16 18:59:18', NULL),
	(16, 'Comportamientos', 'fa fa-glass', 'comportamiento', 'comportamiento', 'AdminComportamientoController', 0, 0, '2019-07-16 19:03:34', NULL),
	(17, 'Crear evaluaciones', 'fa fa-glass', 'evaluacion', 'evaluacion', 'AdminEvaluacionController', 0, 0, '2019-07-16 20:09:27', NULL),
	(18, 'Perfiles por cargo', 'fa fa-glass', 'perfiles', 'perfiles', 'AdminPerfilesController', 0, 0, '2019-07-18 22:09:03', NULL),
	(19, 'Temas varios', 'fa fa-question-circle', 'dudas', 'dudas', 'AdminDudasController', 0, 0, '2019-07-19 04:02:04', NULL);
/*!40000 ALTER TABLE `cms_moduls` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cms_notifications
CREATE TABLE IF NOT EXISTS `cms_notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cms_users` int(11) DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cms_notifications: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_notifications` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cms_privileges
CREATE TABLE IF NOT EXISTS `cms_privileges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_superadmin` tinyint(1) DEFAULT NULL,
  `theme_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cms_privileges: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_privileges` DISABLE KEYS */;
INSERT INTO `cms_privileges` (`id`, `name`, `is_superadmin`, `theme_color`, `created_at`, `updated_at`) VALUES
	(1, 'Super Administrator', 1, 'skin-red', '2019-07-16 16:47:46', NULL),
	(2, 'colaborador', 0, 'skin-red', NULL, NULL),
	(3, 'jefe', 0, 'skin-red', NULL, NULL),
	(4, 'administrador', 0, 'skin-red', NULL, NULL);
/*!40000 ALTER TABLE `cms_privileges` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cms_privileges_roles
CREATE TABLE IF NOT EXISTS `cms_privileges_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_visible` tinyint(1) DEFAULT NULL,
  `is_create` tinyint(1) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `is_edit` tinyint(1) DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT NULL,
  `id_cms_privileges` int(11) DEFAULT NULL,
  `id_cms_moduls` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cms_privileges_roles: ~26 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_privileges_roles` DISABLE KEYS */;
INSERT INTO `cms_privileges_roles` (`id`, `is_visible`, `is_create`, `is_read`, `is_edit`, `is_delete`, `id_cms_privileges`, `id_cms_moduls`, `created_at`, `updated_at`) VALUES
	(1, 1, 0, 0, 0, 0, 1, 1, '2019-07-16 16:47:46', NULL),
	(2, 1, 1, 1, 1, 1, 1, 2, '2019-07-16 16:47:46', NULL),
	(3, 0, 1, 1, 1, 1, 1, 3, '2019-07-16 16:47:46', NULL),
	(4, 1, 1, 1, 1, 1, 1, 4, '2019-07-16 16:47:46', NULL),
	(5, 1, 1, 1, 1, 1, 1, 5, '2019-07-16 16:47:46', NULL),
	(6, 1, 1, 1, 1, 1, 1, 6, '2019-07-16 16:47:46', NULL),
	(7, 1, 1, 1, 1, 1, 1, 7, '2019-07-16 16:47:46', NULL),
	(8, 1, 1, 1, 1, 1, 1, 8, '2019-07-16 16:47:46', NULL),
	(9, 1, 1, 1, 1, 1, 1, 9, '2019-07-16 16:47:46', NULL),
	(10, 1, 1, 1, 1, 1, 1, 10, '2019-07-16 16:47:46', NULL),
	(11, 1, 0, 1, 0, 1, 1, 11, '2019-07-16 16:47:46', NULL),
	(12, 1, 1, 1, 1, 1, 1, 12, NULL, NULL),
	(13, 1, 1, 1, 1, 1, 1, 13, NULL, NULL),
	(14, 1, 1, 1, 1, 1, 1, 14, NULL, NULL),
	(15, 1, 1, 1, 1, 1, 1, 15, NULL, NULL),
	(16, 1, 1, 1, 1, 1, 1, 16, NULL, NULL),
	(17, 1, 1, 1, 1, 1, 1, 17, NULL, NULL),
	(18, 1, 1, 1, 1, 1, 4, 12, NULL, NULL),
	(19, 1, 1, 1, 1, 1, 4, 13, NULL, NULL),
	(20, 1, 1, 1, 1, 1, 4, 15, NULL, NULL),
	(21, 1, 1, 1, 1, 1, 4, 16, NULL, NULL),
	(22, 1, 1, 1, 1, 1, 4, 17, NULL, NULL),
	(23, 1, 1, 1, 1, 1, 4, 14, NULL, NULL),
	(24, 1, 1, 1, 1, 1, 4, 4, NULL, NULL),
	(25, 1, 1, 1, 1, 1, 1, 18, NULL, NULL),
	(26, 1, 1, 1, 1, 1, 4, 18, NULL, NULL),
	(27, 1, 1, 1, 1, 1, 1, 19, NULL, NULL),
	(28, 1, 1, 1, 1, 1, 4, 19, NULL, NULL);
/*!40000 ALTER TABLE `cms_privileges_roles` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cms_settings
CREATE TABLE IF NOT EXISTS `cms_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `content_input_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dataenum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `helper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group_setting` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cms_settings: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_settings` DISABLE KEYS */;
INSERT INTO `cms_settings` (`id`, `name`, `content`, `content_input_type`, `dataenum`, `helper`, `created_at`, `updated_at`, `group_setting`, `label`) VALUES
	(1, 'login_background_color', NULL, 'text', NULL, 'Input hexacode', '2019-07-16 16:47:46', NULL, 'Login Register Style', 'Login Background Color'),
	(2, 'login_font_color', NULL, 'text', NULL, 'Input hexacode', '2019-07-16 16:47:46', NULL, 'Login Register Style', 'Login Font Color'),
	(3, 'login_background_image', NULL, 'upload_image', NULL, NULL, '2019-07-16 16:47:46', NULL, 'Login Register Style', 'Login Background Image'),
	(4, 'email_sender', 'support@crudbooster.com', 'text', NULL, NULL, '2019-07-16 16:47:46', NULL, 'Email Setting', 'Email Sender'),
	(5, 'smtp_driver', 'mail', 'select', 'smtp,mail,sendmail', NULL, '2019-07-16 16:47:46', NULL, 'Email Setting', 'Mail Driver'),
	(6, 'smtp_host', '', 'text', NULL, NULL, '2019-07-16 16:47:46', NULL, 'Email Setting', 'SMTP Host'),
	(7, 'smtp_port', '25', 'text', NULL, 'default 25', '2019-07-16 16:47:46', NULL, 'Email Setting', 'SMTP Port'),
	(8, 'smtp_username', '', 'text', NULL, NULL, '2019-07-16 16:47:46', NULL, 'Email Setting', 'SMTP Username'),
	(9, 'smtp_password', '', 'text', NULL, NULL, '2019-07-16 16:47:46', NULL, 'Email Setting', 'SMTP Password'),
	(10, 'appname', 'Sistema evaluación Motoborda', 'text', NULL, NULL, '2019-07-16 16:47:46', NULL, 'Application Setting', 'Application Name'),
	(11, 'default_paper_size', 'Legal', 'text', NULL, 'Paper size, ex : A4, Legal, etc', '2019-07-16 16:47:46', NULL, 'Application Setting', 'Default Paper Print Size'),
	(12, 'logo', NULL, 'upload_image', NULL, NULL, '2019-07-16 16:47:46', NULL, 'Application Setting', 'Logo'),
	(13, 'favicon', NULL, 'upload_image', NULL, NULL, '2019-07-16 16:47:46', NULL, 'Application Setting', 'Favicon'),
	(14, 'api_debug_mode', 'true', 'select', 'true,false', NULL, '2019-07-16 16:47:46', NULL, 'Application Setting', 'API Debug Mode'),
	(15, 'google_api_key', NULL, 'text', NULL, NULL, '2019-07-16 16:47:46', NULL, 'Application Setting', 'Google API Key'),
	(16, 'google_fcm_key', NULL, 'text', NULL, NULL, '2019-07-16 16:47:46', NULL, 'Application Setting', 'Google FCM Key');
/*!40000 ALTER TABLE `cms_settings` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cms_statistics
CREATE TABLE IF NOT EXISTS `cms_statistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cms_statistics: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_statistics` DISABLE KEYS */;
INSERT INTO `cms_statistics` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'administrador', 'administrador', '2019-07-16 21:34:44', NULL),
	(2, 'cordinador', 'cordinador', '2019-07-16 21:34:56', NULL),
	(3, 'colaborador', 'colaborador', '2019-07-16 21:35:05', NULL),
	(4, 'general', 'general', '2019-07-16 21:43:44', NULL);
/*!40000 ALTER TABLE `cms_statistics` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cms_statistic_components
CREATE TABLE IF NOT EXISTS `cms_statistic_components` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cms_statistics` int(11) DEFAULT NULL,
  `componentID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_name` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sorting` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `config` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cms_statistic_components: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_statistic_components` DISABLE KEYS */;
INSERT INTO `cms_statistic_components` (`id`, `id_cms_statistics`, `componentID`, `component_name`, `area_name`, `sorting`, `name`, `config`, `created_at`, `updated_at`) VALUES
	(2, 4, '860f07f6d45480bb4e332e6d1122e812', 'panelcustom', NULL, 0, 'Untitled', NULL, '2019-07-16 21:41:36', NULL),
	(3, 4, '20d877aee9fad751b1889c1c59f810b1', 'panelarea', 'area5', 0, NULL, '{"name":"Sistema de evaluaci\\u00f3n de motoborda","content":"Sistema de evaluaci\\u00f3n de motoborda 2019"}', '2019-07-16 21:46:57', NULL),
	(4, 1, '5296909f2e293ccd07be19bfc1abea73', 'smallbox', 'area2', 0, NULL, '{"name":"Evaluaciones realizadas","icon":"ion-monitor","color":"bg-green","link":"\\/motoborda\\/admin\\/cms_users?m=16","sql":"SELECT \\r\\ndistinct(r.idevaluacion)\\r\\n FROM \\r\\nevaluacion AS e \\r\\nINNER JOIN resultados AS r ON e.id = r.idevaluacion"}', '2019-07-16 22:11:03', NULL),
	(5, 1, 'b8aa3b30a2b6c06fd6f8a113c2da3878', 'smallbox', 'area3', 0, NULL, '{"name":"Evaluaciones Faltantes","icon":"ion-outlet","color":"bg-red","link":"\\/motoborda\\/admin\\/cms_users?m=16","sql":"SELECT \\r\\nCOUNT(r.idevaluacion)\\r\\n FROM \\r\\nevaluacion AS e \\r\\nINNER JOIN resultados AS r ON e.id = r.idevaluacion"}', '2019-07-16 22:12:46', NULL),
	(6, 1, '960848f188252915504362ecbf294222', 'smallbox', 'area1', 0, NULL, '{"name":"Empleados","icon":"ion-android-friends","color":"bg-aqua","link":"\\/motoborda\\/admin\\/cms_users?m=16","sql":"SELECT \\r\\nCOUNT(id)\\r\\n FROM \\r\\ncms_users\\r\\nWHERE\\r\\nid_cms_privileges <> 1"}', '2019-07-16 22:15:40', NULL),
	(7, 1, '7f23edf06bcfa79e3ff50e297634912b', 'smallbox', 'area4', 0, NULL, '{"name":"Evaluaciones socializadas","icon":"ion-bag","color":"bg-yellow","link":"\\/motoborda\\/admin\\/cms_users?m=16","sql":"SELECT \\r\\nCOUNT(r.idevaluacion)\\r\\n FROM \\r\\nevaluacion AS e \\r\\nINNER JOIN resultados AS r ON e.id = r.idevaluacion"}', '2019-07-16 22:17:40', NULL),
	(8, 1, 'f8e3f74f467ebe8b5b59395235068c02', 'chartbar', 'area5', 0, NULL, '{"name":"Evaluaciones por area","sql":"SELECT \\r\\nCOUNT(DISTINCT(r.idevaluacion)) AS  \'value\',\\r\\nc.cargo AS \'label\'\\r\\n FROM \\r\\ncargo AS c\\r\\nINNER JOIN evaluacion AS e ON c.id = e.idcargo\\r\\nLEFT JOIN resultados AS r ON e.id = r.idevaluacion","area_name":"Cargos","goals":"100"}', '2019-07-16 22:23:40', NULL);
/*!40000 ALTER TABLE `cms_statistic_components` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.cms_users
CREATE TABLE IF NOT EXISTS `cms_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documento` bigint(20) DEFAULT NULL,
  `cargoid` int(11) DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_cms_privileges` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cms_users_cargo` (`cargoid`),
  CONSTRAINT `FK_cms_users_cargo` FOREIGN KEY (`cargoid`) REFERENCES `cargo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.cms_users: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_users` DISABLE KEYS */;
INSERT INTO `cms_users` (`id`, `name`, `apellido`, `documento`, `cargoid`, `photo`, `email`, `password`, `id_cms_privileges`, `created_at`, `updated_at`, `status`) VALUES
	(1, 'Carlos', 'Londoño', 71217813, 1, NULL, 'admin@crudbooster.com', '$2y$10$IqPFJB8pCuj31eCnHFMFx.gDDrhhsBF4fXmhS8K8vDC6mmXvbUyJS', 1, '2019-07-16 16:47:46', '2019-07-16 17:59:33', 'Activo'),
	(2, 'Administrador', 'Administrador Ing', 1020405062, 1, NULL, 'admin@admin.com', '$2y$10$LHvzZmlvMxv5Xj0me6edmeITsaOAoDlNL8y1Ouq/YAbNk8R5POfum', 4, '2019-07-16 22:47:17', '2019-07-18 21:41:36', 'Activo'),
	(3, 'Empleado', 'Empleado', 123456, 1, NULL, '12345@123.com', '$2y$10$wuRpvb4QJr8IXLB.1pgIKOj0j8UpkNaEPiAHZ9ytYgnQoHxf7xLr6', 2, '2019-07-16 23:14:40', '2019-07-16 23:19:50', 'Vacaciones');
/*!40000 ALTER TABLE `cms_users` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.competencia
CREATE TABLE IF NOT EXISTS `competencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `competencia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.competencia: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `competencia` DISABLE KEYS */;
INSERT INTO `competencia` (`id`, `competencia`, `descripcion`, `valor`) VALUES
	(1, 'Liderazgo', 'Capacidad para generar compromiso y lograr el respaldo de sus superiores con vista a enfrentar con éxito los desafíos de la organizacion.Capacidad para asegurar una adecuada conducción de personas, desarrollar el talento, lograr y mantener un clima organizacional, armónico y desafiante. ', 17),
	(2, 'Trabajo en Equipo', 'Capacidad para colaborar con los demás, formar parte de un grupo y trabajar con otras áreas de la organización, con el propósito de alcanzar, en conjunto, la estrategia organizacional, subordinar los intereses personales a los objetivos grupales. Implica tener expectativas positivas respecto a los demás, comprender a los otros, y generar y mantener un buen clima de trabajo.', 17),
	(3, 'INNOVACION', 'Capacidad para idear soluciones nuevas y diferentes dirigidas a resolver problemas o mejorar situaciones que se presenten bien sea en el puesto de trabajo o en  la organización en general.', 17);
/*!40000 ALTER TABLE `competencia` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.comportamiento
CREATE TABLE IF NOT EXISTS `comportamiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comportamiento` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `idcompetencia` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comportamiento_competencia` (`idcompetencia`),
  CONSTRAINT `FK_comportamiento_competencia` FOREIGN KEY (`idcompetencia`) REFERENCES `competencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.comportamiento: ~17 rows (aproximadamente)
/*!40000 ALTER TABLE `comportamiento` DISABLE KEYS */;
INSERT INTO `comportamiento` (`id`, `comportamiento`, `idcompetencia`) VALUES
	(1, 'Define roles (si aplica), tiene claras las  actividades que debe realizar en el día y como desempeñarlas de la mejor forma.', 1),
	(2, 'Se asegura de  tener  todo lo necesario para tener un buen desempeño: Recursos, herramientas, formatos e información.', 1),
	(3, 'Impulsa a sus compañeros a realizar actividades grupales para lograr objetivos comunes y comunica los resultados obtenidos.', 1),
	(4, 'Entusiasma a los demás con sus propuestas, consigue que los demás participen de sus objetivos, responsabilidades, políticas y criterios.', 1),
	(5, 'Retroalimenta a sus compañeros de trabajo en busca del cumplimiento de las metas.', 1),
	(6, 'Tiene  carisma, genera en el equipo una atmosfera de entusiasmo y compromiso con la misión de la organización.', 1),
	(7, 'Reconoce públicamente el mérito de los miembros del grupo que trabajan bien.', 1),
	(8, 'Participa en las acciones del equipo  ejecutando lo que le corresponde.', 2),
	(9, 'Comparte información y mantiene al resto de los miembros informados sobre los temas de interés.', 2),
	(10, 'En su relación con los miembros del equipo respeta sus opiniones y valora los diferentes aportes y las contribuciones de los mismos.', 2),
	(11, 'Tiene una actitud abierta a aprender de los demás (incluyendo subordinados y pares).', 2),
	(12, 'Propicia  un buen clima y espíritu de colaboración en el grupo resolviendo los conflictos que se dan dentro del equipo.', 2),
	(13, 'Presenta soluciones novedosas y originales aplicables tanto a su puesto como a la organización.', 3),
	(14, 'Es un referente en la organización   por presentar soluciones innovadoras y creativas a situaciones diversas, añadiendo valor.', 3),
	(15, 'Presenta soluciones a problemas relacionados con su puesto de trabajo o clientes internos y externos.', 3),
	(16, 'Convierte las debilidades y/o amenazas en oportunidades de mejora.', 3),
	(17, 'Se anticipa a las diferentes situaciones que puedan presentarse y propone acciones que mitiguen los posibles riesgos asociados.', 3);
/*!40000 ALTER TABLE `comportamiento` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.dudas
CREATE TABLE IF NOT EXISTS `dudas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duda` varchar(50) DEFAULT NULL,
  `descripcion` text,
  `usuarioduda` varchar(50) DEFAULT NULL,
  `fechaduda` date DEFAULT NULL,
  `respuesta` text NOT NULL,
  `responde` varchar(50) NOT NULL DEFAULT '',
  `fecharespuesta` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla clondono_mtbr.dudas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `dudas` DISABLE KEYS */;
INSERT INTO `dudas` (`id`, `duda`, `descripcion`, `usuarioduda`, `fechaduda`, `respuesta`, `responde`, `fecharespuesta`) VALUES
	(1, 'Como se identifica quien evalua a quien', 'el proceso de evaluacion se da por cargos, entonces en que momento se identificca quien evalua, o si es posible identificarlo mediante una identificación, en el perfil diferente al cargo y que identifique su grupo de trabajo.\r\nSe tiene como opciones:\r\n1. Cargo-colaborador\r\n2. Cargo - colaborador - evaluador\r\n3. Area - cargo - evaluador\r\n4. Cargo - jefe - colaborador', 'Carlos Londoño', '2019-07-12', '', '', '0000-00-00'),
	(2, 'Evaluaciones son por cargos ?', 'Las evaluaciones por cargo nos plantean que se puede generar una evaluación generica y otra por cargo. \r\nLas genericas son generadas por la app con las competencias inciales\r\nLas especiales o por cargo se deben de generar y aplicar solo por los usuarios que le correspondan', 'Carlos Londoño', '2019-07-15', '', '', '0000-00-00'),
	(3, 'Estados de empleados', 'Exiten estados para empleados que esten en vaciones, incapacidades, retirados o otros, para asi generar un estado de inactividad a ese usuario cuando llegue el ciclo de evaluacion', 'Carlos Londoño', '2019-07-15', '', '', '0000-00-00'),
	(4, 'Perfiles o H.V', 'Los perfiles para el cargo estan generados atendiendo la ficha tecnica, es posible generar una hoja de vida para el usuario, si es asi se requiere establecer la informacón para adjuntar o se puede generar un campo para adjuntar hoja de vida en formato pdf.', 'Carlos Londoño', '2019-07-15', '', '', '0000-00-00'),
	(5, 'Publicación avance 01', 'Se genera ambiente de trabajo con las siguientes especificaicones\r\n1. Motor BD mysql / Ambiente apache php 5.6 y 7.0\r\n2. Lenguaje PHP Framework Laravel\r\n3. Ruta de pruebas carloslondono.com.co/motoborda', 'Carlos Londoño', '2019-07-12', 'Datos de acceso a la aplicación\r\nusuario: admin@admin.com\r\npasswd: 123456', 'OVH - vps', '2019-07-12');
/*!40000 ALTER TABLE `dudas` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.evaluacion
CREATE TABLE IF NOT EXISTS `evaluacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `idcargo` int(11) NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `competecia_a` int(11) NOT NULL,
  `competecia_b` int(11) NOT NULL,
  `competecia_c` int(11) NOT NULL,
  `competecia_d` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_evaluacion_competencia` (`competecia_a`),
  KEY `FK_evaluacion_competencia_2` (`competecia_b`),
  KEY `FK_evaluacion_competencia_3` (`competecia_c`),
  KEY `FK_evaluacion_cargo` (`idcargo`),
  CONSTRAINT `FK_evaluacion_cargo` FOREIGN KEY (`idcargo`) REFERENCES `cargo` (`id`),
  CONSTRAINT `FK_evaluacion_competencia` FOREIGN KEY (`competecia_a`) REFERENCES `competencia` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_evaluacion_competencia_2` FOREIGN KEY (`competecia_b`) REFERENCES `competencia` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_evaluacion_competencia_3` FOREIGN KEY (`competecia_c`) REFERENCES `competencia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.evaluacion: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
INSERT INTO `evaluacion` (`id`, `titulo`, `idcargo`, `descripcion`, `fecha`, `codigo`, `competecia_a`, `competecia_b`, `competecia_c`, `competecia_d`) VALUES
	(1, 'deddd', 1, 'ddddd', '2019-07-16', 'sdsdsd', 3, 1, 2, 0),
	(2, 'aaaa', 3, 'aaaaa', '2019-07-01', 'ti2019', 3, 1, 2, 0);
/*!40000 ALTER TABLE `evaluacion` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.mejorar
CREATE TABLE IF NOT EXISTS `mejorar` (
  `id` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `idjefe` int(11) DEFAULT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  `idevaluacion` int(11) DEFAULT NULL,
  `situacionpresentada` text COLLATE utf8mb4_unicode_ci,
  `aspectomejorar` text COLLATE utf8mb4_unicode_ci,
  `acciontomar` text COLLATE utf8mb4_unicode_ci,
  `fechaseguimiento` date DEFAULT NULL,
  `fechaelaboracion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.mejorar: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mejorar` DISABLE KEYS */;
/*!40000 ALTER TABLE `mejorar` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.migrations: ~22 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2016_08_07_145904_add_table_cms_apicustom', 1),
	(2, '2016_08_07_150834_add_table_cms_dashboard', 1),
	(3, '2016_08_07_151210_add_table_cms_logs', 1),
	(4, '2016_08_07_152014_add_table_cms_privileges', 1),
	(5, '2016_08_07_152214_add_table_cms_privileges_roles', 1),
	(6, '2016_08_07_152320_add_table_cms_settings', 1),
	(7, '2016_08_07_152421_add_table_cms_users', 1),
	(8, '2016_08_07_154624_add_table_cms_moduls', 1),
	(9, '2016_08_17_225409_add_status_cms_users', 1),
	(10, '2016_08_20_125418_add_table_cms_notifications', 1),
	(11, '2016_09_04_033706_add_table_cms_email_queues', 1),
	(12, '2016_09_16_035347_add_group_setting', 1),
	(13, '2016_09_16_045425_add_label_setting', 1),
	(14, '2016_09_17_104728_create_nullable_cms_apicustom', 1),
	(15, '2016_10_01_141740_add_method_type_apicustom', 1),
	(16, '2016_10_01_141846_add_parameters_apicustom', 1),
	(17, '2016_10_01_141934_add_responses_apicustom', 1),
	(18, '2016_10_01_144826_add_table_apikey', 1),
	(19, '2016_11_14_141657_create_cms_menus', 1),
	(20, '2016_11_15_132350_create_cms_email_templates', 1),
	(21, '2016_11_15_190410_create_cms_statistics', 1),
	(22, '2016_11_17_102740_create_cms_statistic_components', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.perfiles
CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcargo` int(11) NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `elaboro` int(11) DEFAULT NULL,
  `revisior` int(11) DEFAULT NULL,
  `aprobo` int(11) DEFAULT NULL,
  `requisitos` text COLLATE utf8mb4_unicode_ci,
  `formacion` text COLLATE utf8mb4_unicode_ci,
  `autoridad` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `FK_perfiles_cargo` (`idcargo`),
  KEY `FK_perfiles_cargo_2` (`elaboro`),
  KEY `FK_perfiles_cargo_3` (`revisior`),
  KEY `FK_perfiles_cargo_4` (`aprobo`),
  CONSTRAINT `FK_perfiles_cargo` FOREIGN KEY (`idcargo`) REFERENCES `cargo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_perfiles_cargo_2` FOREIGN KEY (`elaboro`) REFERENCES `cargo` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_perfiles_cargo_3` FOREIGN KEY (`revisior`) REFERENCES `cargo` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_perfiles_cargo_4` FOREIGN KEY (`aprobo`) REFERENCES `cargo` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Corresponde al perfil del cargo';

-- Volcando datos para la tabla clondono_mtbr.perfiles: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` (`id`, `idcargo`, `codigo`, `fecha`, `elaboro`, `revisior`, `aprobo`, `requisitos`, `formacion`, `autoridad`) VALUES
	(1, 1, 'CON2019', '2019-07-10', 2, 2, 2, '<p>Ninguno<br></p>', '<p>Ninguno<br></p>', '<p>Ninguno<br></p>');
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;

-- Volcando estructura para tabla clondono_mtbr.resultados
CREATE TABLE IF NOT EXISTS `resultados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idevaluacion` int(11) NOT NULL DEFAULT '0',
  `idusuario` int(10) NOT NULL,
  `idcomportamiento` int(11) NOT NULL,
  `valor` int(2) NOT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sin Observación',
  `fecharealizacion` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_resultados_evaluacion` (`idevaluacion`),
  KEY `FK_resultados_comportamiento` (`idcomportamiento`),
  CONSTRAINT `FK_resultados_comportamiento` FOREIGN KEY (`idcomportamiento`) REFERENCES `comportamiento` (`id`),
  CONSTRAINT `FK_resultados_evaluacion` FOREIGN KEY (`idevaluacion`) REFERENCES `evaluacion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla clondono_mtbr.resultados: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `resultados` DISABLE KEYS */;
INSERT INTO `resultados` (`id`, `idevaluacion`, `idusuario`, `idcomportamiento`, `valor`, `observacion`, `fecharealizacion`) VALUES
	(1, 1, 3, 16, 1, 'Sin Observación', '2019-07-18'),
	(2, 1, 3, 9, 1, 'Sin Observación', '2019-07-18');
/*!40000 ALTER TABLE `resultados` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
