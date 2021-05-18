-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.17-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela tk_solutions.alertas
CREATE TABLE IF NOT EXISTS `alertas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `contrato_id` bigint(20) DEFAULT NULL,
  `mensagem` varchar(300) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela tk_solutions.alertas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `alertas` DISABLE KEYS */;
INSERT INTO `alertas` (`id`, `contrato_id`, `mensagem`, `updated_at`, `created_at`) VALUES
	(11, 34, 'Esse é um teste de alerta', '2021-05-14 23:08:13', '2021-05-14 23:08:13');
/*!40000 ALTER TABLE `alertas` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.cliente_vendedor
CREATE TABLE IF NOT EXISTS `cliente_vendedor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendedor_id` bigint(20) NOT NULL,
  `cliente_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela tk_solutions.cliente_vendedor: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente_vendedor` DISABLE KEYS */;
INSERT INTO `cliente_vendedor` (`id`, `vendedor_id`, `cliente_id`, `created_at`, `updated_at`) VALUES
	(13, 24, 25, '2021-05-14 22:46:22', '2021-05-14 22:46:22'),
	(14, 24, 26, '2021-05-14 23:00:24', '2021-05-14 23:00:24'),
	(15, 25, 27, '2021-05-14 23:01:47', '2021-05-14 23:01:47'),
	(16, 25, 28, '2021-05-14 23:02:12', '2021-05-14 23:02:12'),
	(17, 25, 29, '2021-05-14 23:11:55', '2021-05-14 23:11:55'),
	(18, 24, 30, '2021-05-15 12:07:54', '2021-05-15 12:07:54');
/*!40000 ALTER TABLE `cliente_vendedor` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.contratos
CREATE TABLE IF NOT EXISTS `contratos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_contrato` bigint(20) DEFAULT NULL,
  `data_assinatura` date NOT NULL,
  `valor` double NOT NULL,
  `data_inicio_vigencia` date NOT NULL,
  `data_vencimento` date NOT NULL,
  `duracao_contrato` int(11) DEFAULT NULL,
  `dias_para_vencimento` int(11) DEFAULT NULL,
  `alerta` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_vendedor_id` bigint(20) unsigned DEFAULT NULL,
  `acessor_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tk_solutions.contratos: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `contratos` DISABLE KEYS */;
INSERT INTO `contratos` (`id`, `tipo_contrato`, `data_assinatura`, `valor`, `data_inicio_vigencia`, `data_vencimento`, `duracao_contrato`, `dias_para_vencimento`, `alerta`, `cliente_vendedor_id`, `acessor_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(34, 1, '2021-01-07', 20000, '2021-02-01', '2021-08-27', NULL, NULL, '', 15, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
	(35, 1, '2021-01-01', 10000, '2021-02-20', '2021-07-08', NULL, NULL, '', 15, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
	(36, 1, '2021-02-04', 8000, '2021-02-12', '2021-07-30', NULL, NULL, '', 16, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
	(37, 1, '2021-03-17', 60000, '2021-03-24', '2021-11-04', NULL, NULL, '', 16, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
	(38, 1, '2021-04-22', 5000, '2021-07-29', '2021-05-05', NULL, NULL, '', 16, 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
	(39, 1, '2021-05-13', 12345, '2021-05-14', '2021-09-01', NULL, NULL, '', 15, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(40, 1, '2021-03-06', 15000, '2021-04-30', '2021-10-04', NULL, NULL, '', 15, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(41, 1, '2021-04-09', 15000, '2021-04-01', '2021-08-25', NULL, NULL, '', 15, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);
/*!40000 ALTER TABLE `contratos` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tk_solutions.failed_jobs: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tk_solutions.migrations: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.pagamentos
CREATE TABLE IF NOT EXISTS `pagamentos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `contrato_id` bigint(20) DEFAULT NULL,
  `mes_referencia` varchar(45) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela tk_solutions.pagamentos: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `pagamentos` DISABLE KEYS */;
INSERT INTO `pagamentos` (`id`, `contrato_id`, `mes_referencia`, `valor`, `updated_at`, `created_at`) VALUES
	(7, 34, '022021', 1000, '2021-05-14 23:04:02', '2021-05-14 23:04:02'),
	(8, 34, '032021', 200, '2021-05-14 23:04:09', '2021-05-14 23:04:09'),
	(9, 34, '042021', 550, '2021-05-14 23:06:36', '2021-05-14 23:04:13'),
	(10, 35, '022021', 1234, '2021-05-14 23:09:49', '2021-05-14 23:09:49'),
	(11, 35, '032021', 1500, '2021-05-14 23:09:52', '2021-05-14 23:09:52'),
	(12, 35, '042021', 780, '2021-05-14 23:09:56', '2021-05-14 23:09:56'),
	(13, 36, '022021', 800, '2021-05-14 23:13:40', '2021-05-14 23:13:40'),
	(14, 36, '032021', 200, '2021-05-14 23:13:44', '2021-05-14 23:13:44'),
	(15, 36, '042021', 500, '2021-05-14 23:13:48', '2021-05-14 23:13:48'),
	(16, 36, '052021', 600, '2021-05-14 23:13:52', '2021-05-14 23:13:52'),
	(17, 37, '032021', 100, '2021-05-14 23:14:13', '2021-05-14 23:14:13'),
	(18, 37, '042021', 20, '2021-05-14 23:14:16', '2021-05-14 23:14:16'),
	(19, 34, '052021', 1000000, '2021-05-15 12:12:26', '2021-05-15 12:12:26');
/*!40000 ALTER TABLE `pagamentos` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tk_solutions.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tk_solutions.permissions: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'adm_access', '2021-04-21 18:04:00', '2021-04-21 18:04:00', NULL),
	(2, 'cliente_access', '2021-04-21 18:04:00', '2021-04-21 18:04:00', NULL),
	(3, 'vendedor_access', '2021-04-21 18:04:00', '2021-04-21 18:04:00', NULL),
	(4, 'acessor_access', NULL, NULL, NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `role_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  KEY `permission_role_role_id_foreign` (`role_id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tk_solutions.permission_role: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
	(2, 2),
	(3, 3),
	(1, 2),
	(1, 3),
	(1, 1),
	(4, 4),
	(3, 4);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tk_solutions.personal_access_tokens: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.rendimentos
CREATE TABLE IF NOT EXISTS `rendimentos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `contrato_id` bigint(20) DEFAULT NULL,
  `mes_referencia` varchar(45) NOT NULL,
  `valor` double DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela tk_solutions.rendimentos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `rendimentos` DISABLE KEYS */;
INSERT INTO `rendimentos` (`id`, `contrato_id`, `mes_referencia`, `valor`, `updated_at`, `created_at`) VALUES
	(15, 34, '032021', 200, '2021-05-14 23:06:55', '2021-05-14 23:06:55');
/*!40000 ALTER TABLE `rendimentos` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.replicas
CREATE TABLE IF NOT EXISTS `replicas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint(20) DEFAULT NULL,
  `responsavel` bigint(20) DEFAULT NULL,
  `mensagem` varchar(300) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela tk_solutions.replicas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `replicas` DISABLE KEYS */;
INSERT INTO `replicas` (`id`, `ticket_id`, `responsavel`, `mensagem`, `updated_at`, `created_at`) VALUES
	(16, 22, 25, 'esta é uma resposta', '2021-05-14 23:24:29', '2021-05-14 23:24:29'),
	(17, 22, 27, 'obrigado pela resposta', '2021-05-14 23:24:39', '2021-05-14 23:24:39');
/*!40000 ALTER TABLE `replicas` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tk_solutions.roles: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Administrador', '2021-04-21 15:55:56', '2021-04-21 15:55:56', NULL),
	(2, 'Cliente', '2021-04-21 15:55:56', '2021-04-21 15:55:56', NULL),
	(3, 'Vendedor', '2021-04-21 15:55:56', '2021-04-21 15:55:56', NULL),
	(4, 'Acessor', NULL, NULL, NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `role_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  KEY `role_user_role_id_foreign` (`role_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tk_solutions.role_user: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
	(3, 25),
	(2, 27),
	(2, 28),
	(4, 29),
	(1, 24),
	(1, 30);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tk_solutions.sessions: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('icgCeXWGZC0iBChF7o7537gV71HDjAcmrZjk49ue', 25, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRHdKeTVIdDBIZ3k0VEpsWU5iWXVmMjlSaUVBampXTUtJRzQzSlpWTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjU7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCQzWW5GTnZTRC5mZEFMd09ZR2lScjMubDZpVHlEZ3ZLbW1zVEZ0WnZidm5XMUp2aklHTjlYYSI7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkM1luRk52U0QuZmRBTHdPWUdpUnIzLmw2aVR5RGd2S21tc1RGdFp2YnZuVzFKdmpJR045WGEiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvY29udHJhdG9zIjt9fQ==', 1621296502);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.teams
CREATE TABLE IF NOT EXISTS `teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teams_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tk_solutions.teams: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.team_invitations
CREATE TABLE IF NOT EXISTS `team_invitations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint(20) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_invitations_team_id_email_unique` (`team_id`,`email`),
  CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tk_solutions.team_invitations: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `team_invitations` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_invitations` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.team_user
CREATE TABLE IF NOT EXISTS `team_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tk_solutions.team_user: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `team_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_user` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.tickets
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `responsavel` bigint(20) DEFAULT NULL,
  `mensagem` varchar(300) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela tk_solutions.tickets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` (`id`, `user_id`, `responsavel`, `mensagem`, `status`, `updated_at`, `created_at`) VALUES
	(22, 27, 25, 'teste é um ticket', 3, '2021-05-14 23:24:46', '2021-05-14 23:24:08');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.upload_contrato
CREATE TABLE IF NOT EXISTS `upload_contrato` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` longtext DEFAULT NULL,
  `contrato_id` bigint(20) DEFAULT NULL,
  `responsavel` bigint(20) DEFAULT NULL,
  `caminho` longtext DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela tk_solutions.upload_contrato: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `upload_contrato` DISABLE KEYS */;
INSERT INTO `upload_contrato` (`id`, `nome`, `contrato_id`, `responsavel`, `caminho`, `updated_at`, `created_at`) VALUES
	(5, 'logo_site_tk_solutions_assessoria_de_negocios_01-768x182.png', 34, 25, 'C:\\Users\\gusta\\OneDrive\\Desktop\\teste-crud\\storage\\app\\logo_site_tk_solutions_assessoria_de_negocios_01-768x182.png', '2021-05-14 20:02:55', '2021-05-14 20:02:55'),
	(6, 'logo_site_tk_solutions_assessoria_de_negocios_01-768x182.png', 34, 25, 'C:\\Users\\gusta\\OneDrive\\Desktop\\teste-crud\\storage\\app\\logo_site_tk_solutions_assessoria_de_negocios_01-768x182.png', '2021-05-14 20:08:36', '2021-05-14 20:08:36');
/*!40000 ALTER TABLE `upload_contrato` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.upload_rendimento
CREATE TABLE IF NOT EXISTS `upload_rendimento` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` longtext DEFAULT NULL,
  `rendimento_id` bigint(20) DEFAULT NULL,
  `responsavel` bigint(20) DEFAULT NULL,
  `caminho` longtext DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela tk_solutions.upload_rendimento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `upload_rendimento` DISABLE KEYS */;
/*!40000 ALTER TABLE `upload_rendimento` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.upload_replica
CREATE TABLE IF NOT EXISTS `upload_replica` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` longtext DEFAULT NULL,
  `replica_id` bigint(20) DEFAULT NULL,
  `responsavel` bigint(20) DEFAULT NULL,
  `caminho` longtext DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela tk_solutions.upload_replica: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `upload_replica` DISABLE KEYS */;
/*!40000 ALTER TABLE `upload_replica` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.upload_ticket
CREATE TABLE IF NOT EXISTS `upload_ticket` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` longtext DEFAULT NULL,
  `ticket_id` bigint(20) DEFAULT NULL,
  `responsavel` bigint(20) DEFAULT NULL,
  `caminho` longtext DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela tk_solutions.upload_ticket: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `upload_ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `upload_ticket` ENABLE KEYS */;

-- Copiando estrutura para tabela tk_solutions.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tk_solutions.users: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
	(24, 'Gustavo Ribeiro', 'gustavonori95@gmail.com', NULL, '$2y$10$v/29zjIPknAGOEWXXaM4vett3buFBLqHNv33XeIKTbgp60ZjkGgM2', NULL, NULL, NULL, 4, NULL, '2021-04-06 22:39:02', '2021-05-15 01:14:48'),
	(25, 'Daniel Ferreira', 'daniel@gmail.com', NULL, '$2y$10$3YnFNvSD.fdALwOYGiRr3.l6iTyDgvKmmsTFtZvbvnW1JvjIGN9Xa', NULL, NULL, NULL, NULL, NULL, '2021-05-14 22:46:22', '2021-05-14 22:46:22'),
	(27, 'José das Couves', 'jose@gmail.com', NULL, '$2y$10$UzjFUM9KfxyQW51u9BuTGOGirnHo3GoRubufiDOwNO25sTGKMOEYi', NULL, NULL, NULL, NULL, NULL, '2021-05-14 23:01:47', '2021-05-14 23:01:47'),
	(28, 'Marcos Henrique', 'marcos@gmail.com', NULL, '$2y$10$v1ucG4EzEQPvmqbPsSEByu8CazvLjIEvIe55bdzzdpDesHCp5Hr8y', NULL, NULL, NULL, NULL, NULL, '2021-05-14 23:02:12', '2021-05-14 23:02:12'),
	(29, 'Jorge da Silva', 'jorge@gmail.com', NULL, '$2y$10$qDjMEBlnS9RG6EyG8CWxTenl5tRhWuSqHbrU8Eb/W.KI0QIzsovvC', NULL, NULL, NULL, NULL, NULL, '2021-05-14 23:11:55', '2021-05-14 23:11:55'),
	(30, 'PAULO DA ROCHA FERREIRA NETO', 'paulorneto2007@gmail.com', NULL, '$2y$10$UXyVhhgbSSxb7FzAX7Tl9O9ydAcSf6ighgRAGMHpMJudnuCvUUa86', NULL, NULL, NULL, NULL, NULL, '2021-05-15 12:07:54', '2021-05-15 12:07:54');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
