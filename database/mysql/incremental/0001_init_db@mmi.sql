DROP TABLE IF EXISTS `DB_CHANGELOG`;
CREATE TABLE `DB_CHANGELOG` (
  `filename` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `md5` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`filename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

DROP TABLE IF EXISTS `cms_role`;
CREATE TABLE `cms_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `cms_role` (`id`, `name`) VALUES
(3,	'admin'),
(1,	'guest'),
(2,	'member');

DROP TABLE IF EXISTS `cms_acl`;
CREATE TABLE `cms_acl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_role_id` int(11) NOT NULL,
  `module` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `controller` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `action` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `access` varchar(8) COLLATE utf8_polish_ci DEFAULT 'deny',
  PRIMARY KEY (`id`),
  KEY `access` (`access`),
  KEY `action` (`action`),
  KEY `controller` (`controller`),
  KEY `module` (`module`),
  KEY `cms_role_id` (`cms_role_id`),
  CONSTRAINT `cms_acl_ibfk_1` FOREIGN KEY (`cms_role_id`) REFERENCES `cms_role` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('1', '3', NULL, NULL, NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('2', '1', 'default', NULL, NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('3', '1', 'admin', 'login', NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('4', '1', 'cms', 'form', NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('5', '1', 'artist', 'index', NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('6', '1', 'user', 'login', NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('7', '1', 'user', 'registration', NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('8', '1', 'song', 'index', NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('9', '2', 'default', NULL, NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('10', '2', 'cms', NULL, NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('11', '2', 'artist', 'index', NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('12', '2', 'song', 'index', NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('13', '2', 'user', NULL, NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('14', '1', 'cms', 'captcha', NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('15', '1', 'cms', 'contact', NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('16', '1', 'cms', 'comment', NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('17', '1', 'cms', 'file', 'index', 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('18', '2', 'cms', 'article', NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('19', '1', 'cms', 'article', NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('20', '1', 'user', 'index', NULL, 'allow');
insert into cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('21', '2', 'user', 'index', NULL, 'allow');

DROP TABLE IF EXISTS `cms_article`;
CREATE TABLE `cms_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) COLLATE utf8_polish_ci,
  `title` varchar(160) COLLATE utf8_polish_ci NOT NULL,
  `uri` varchar(160) COLLATE utf8_polish_ci NOT NULL,
  `dateAdd` datetime DEFAULT NULL,
  `dateModify` datetime DEFAULT NULL,
  `text` text COLLATE utf8_polish_ci,
  PRIMARY KEY (`id`),
  KEY `dateAdd` (`dateAdd`),
  KEY `dateModify` (`dateModify`),
  KEY `lang` (`lang`),
  KEY `title` (`title`),
  KEY `uri` (`uri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

insert into cms_article (`id`, `lang`, `title`, `uri`, `dateAdd`, `dateModify`, `text`) values ('1', 'en', 'Regulamin', 'regulamin', '2013-03-12 19:18:12', '2013-03-12 19:18:12', '<p>1). pkt 1</p>
<p>2). pkt 2</p>');
insert into cms_article (`id`, `lang`, `title`, `uri`, `dateAdd`, `dateModify`, `text`) values ('2', 'en', 'FAQ', 'faq', '2013-03-12 19:19:18', '2013-03-12 19:19:18', '<p>Q: ble</p>
<p>A: bla</p>');
insert into cms_article (`id`, `lang`, `title`, `uri`, `dateAdd`, `dateModify`, `text`) values ('3', 'en', 'Reklama', 'reklama', '2013-03-12 19:33:38', '2013-03-12 19:33:38', '<p>Kontakt reklamowy</p>');

DROP TABLE IF EXISTS `cms_auth`;
CREATE TABLE `cms_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL,
  `username` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `lastIp` varchar(16) COLLATE utf8_polish_ci DEFAULT NULL,
  `lastLog` datetime DEFAULT NULL,
  `lastFailIp` varchar(16) COLLATE utf8_polish_ci DEFAULT NULL,
  `lastFailLog` datetime DEFAULT NULL,
  `failLogCount` int(11) DEFAULT '0',
  `logged` tinyint DEFAULT '0',
  `active` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `active` (`active`),
  KEY `email` (`email`),
  KEY `logged` (`logged`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `cms_auth` (`id`, `lang`, `username`, `email`, `password`, `lastIp`, `lastLog`, `lastFailIp`, `lastFailLog`, `failLogCount`, `logged`, `active`) VALUES
(1,	'en',	'admin',	'admin@hqsoft.pl',	'd033e22ae348aeb5660fc2140aec35850c4da997',	'127.0.0.1',	'2012-02-23 15:41:12',	'89.231.108.27',	'2011-12-20 19:42:01',	8,	0,	1),
(2,	'en',	'mariusz',	'mariusz@milejko.pl',	'7a48d2fe2f6f86430acee5b86a093c3352b9f780',	'127.0.0.1',	'2012-03-20 15:54:01',	'127.0.0.1',	'2012-03-16 13:41:49',	9,	0,	1);

DROP TABLE IF EXISTS `cms_auth_role`;
CREATE TABLE `cms_auth_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_auth_id` int(11) NOT NULL,
  `cms_role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cms_auth_id` (`cms_auth_id`),
  KEY `cms_role_id` (`cms_role_id`),
  CONSTRAINT `cms_auth_role_ibfk_1` FOREIGN KEY (`cms_auth_id`) REFERENCES `cms_auth` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `cms_auth_role_ibfk_2` FOREIGN KEY (`cms_role_id`) REFERENCES `cms_role` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `cms_auth_role` (`id`, `cms_auth_id`, `cms_role_id`) VALUES
(1,	2,	3),
(2,	1,	3);

DROP TABLE IF EXISTS `cms_comment`;
CREATE TABLE `cms_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_auth_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `dateAdd` datetime NOT NULL,
  `title` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `text` text COLLATE utf8_polish_ci NOT NULL,
  `signature` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL,
  `ip` varchar(16) COLLATE utf8_polish_ci DEFAULT NULL,
  `stars` double DEFAULT '0',
  `object` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `objectId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dateAdd` (`dateAdd`),
  KEY `object` (`object`,`objectId`),
  KEY `parent_id` (`parent_id`),
  KEY `stars` (`stars`),
  KEY `cms_auth_id` (`cms_auth_id`),
  CONSTRAINT `cms_comment_ibfk_1` FOREIGN KEY (`cms_auth_id`) REFERENCES `cms_auth` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


DROP TABLE IF EXISTS `cms_contact`;
CREATE TABLE `cms_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_contact_option_id` int(11) NOT NULL,
  `dateAdd` datetime DEFAULT NULL,
  `text` text COLLATE utf8_polish_ci,
  `reply` text COLLATE utf8_polish_ci,
  `cms_auth_id_reply` int(11) DEFAULT NULL,
  `uri` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `ip` varchar(16) COLLATE utf8_polish_ci DEFAULT NULL,
  `cms_auth_id` int(11) DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `active` (`active`),
  KEY `dateAdd` (`dateAdd`),
  KEY `email` (`email`),
  KEY `uri` (`uri`),
  KEY `cms_auth_id` (`cms_auth_id`),
  KEY `cms_auth_id_reply` (`cms_auth_id_reply`),
  KEY `cms_contact_option_id` (`cms_contact_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


DROP TABLE IF EXISTS `cms_contact_option`;
CREATE TABLE `cms_contact_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `cms_contact_option` (`id`, `name`) VALUES
(1,	'Inne'),
(2,	'Propozycje zmian');

DROP TABLE IF EXISTS `cms_file`;
CREATE TABLE `cms_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `mimeType` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_polish_ci DEFAULT NULL,
  `original` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `source` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `size` bigint(20) DEFAULT NULL,
  `dateAdd` datetime DEFAULT NULL,
  `dateModify` datetime DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `sticky` tinyint DEFAULT NULL,
  `object` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `objectId` int(11) DEFAULT NULL,
  `cms_auth_id` int(11) DEFAULT NULL,
  `active` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `active` (`active`),
  KEY `author` (`author`),
  KEY `class` (`class`),
  KEY `dateAdd` (`dateAdd`),
  KEY `dateModify` (`dateModify`),
  KEY `name` (`name`),
  KEY `object` (`object`,`objectId`),
  KEY `order` (`order`),
  KEY `sticky` (`sticky`),
  KEY `title` (`title`),
  KEY `cms_auth_id` (`cms_auth_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


DROP TABLE IF EXISTS `cms_log`;
CREATE TABLE `cms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `ip` varchar(16) COLLATE utf8_polish_ci DEFAULT NULL,
  `browser` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `operation` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `object` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `objectId` int(11) DEFAULT NULL,
  `data` text COLLATE utf8_polish_ci,
  `success` tinyint NOT NULL DEFAULT '0',
  `cms_auth_id` int(11) DEFAULT NULL,
  `dateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dateTime` (`dateTime`),
  KEY `ip` (`ip`),
  KEY `objectId` (`objectId`),
  KEY `object` (`object`),
  KEY `operation` (`operation`),
  KEY `url` (`url`),
  KEY `cms_auth_id` (`cms_auth_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


DROP TABLE IF EXISTS `cms_navigation`;
CREATE TABLE `cms_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `module` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `controller` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `action` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `params` text COLLATE utf8_polish_ci,
  `label` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL,
  `title` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL,
  `keywords` text COLLATE utf8_polish_ci,
  `description` text COLLATE utf8_polish_ci,
  `uri` text COLLATE utf8_polish_ci,
  `visible` tinyint NOT NULL DEFAULT '0',
  `https` tinyint DEFAULT NULL,
  `absolute` tinyint NOT NULL DEFAULT 0,
  `independent` tinyint NOT NULL DEFAULT 0,
  `nofollow` tinyint NOT NULL DEFAULT 0,
  `blank` tinyint NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `order` (`order`),
  KEY `parent_id` (`parent_id`),
  KEY `visible` (`visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('4', 'en', '0', '3', 'admin', 'index', 'index', '', 'Panel administracyjny', NULL, '', '', NULL, '0');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('12', 'en', '4', '0', 'admin', 'index', 'index', '', 'CMS', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('13', 'en', '12', '0', 'cms', 'adminNavigation', 'index', '', 'Struktura serwisu', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('14', 'en', '12', '8', 'cms', 'adminLog', 'index', '', 'Log systemowy', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('15', 'en', '13', '3', 'cms', 'adminNavigation', 'edit', 'type=simple', 'Dodaj stronę statyczną', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('17', 'en', '13', '7', 'cms', 'adminNavigation', 'edit', 'type=cms', 'Dodaj obiekt CMS', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('18', 'en', '13', '8', 'cms', 'adminNavigation', 'edit', 'type=link', 'Dodaj odnośnik', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('21', 'en', '13', '5', 'cms', 'adminNavigation', 'edit', 'type=folder', 'Dodaj folder', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('22', 'en', '12', '2', 'cms', 'adminFile', 'index', '', 'Pliki', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('24', 'en', '12', '9', 'admin', 'errorLog', 'index', '', 'Log błędów', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('26', 'en', '12', '6', 'cms', 'adminAcl', 'index', '', 'Uprawnienia', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('31', 'en', '12', '4', 'cms', 'adminComment', 'index', '', 'Komentarze', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('48', 'en', '12', '5', 'cms', 'adminAuth', 'index', '', 'Użytkownicy', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('49', 'en', '48', '0', 'cms', 'adminAuth', 'edit', '', 'Dodaj użytkownika', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('70', 'en', '12', '1', 'cms', 'adminArticle', 'index', '', 'Artykuły', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('71', 'en', '70', '0', 'cms', 'adminArticle', 'edit', '', 'Dodaj artykuł', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('74', 'en', '48', '1', 'cms', 'adminAuth', 'property', '', 'Właściwości użytkownika', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('75', 'en', '74', '0', 'cms', 'adminAuth', 'propertyEdit', '', 'Dodaj właściwości użytkownika', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('99', 'en', '4', '2', 'news', 'admin', 'index', '', 'Aktualności', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('100', 'en', '99', '0', 'news', 'admin', 'edit', '', 'Dodaj artykuł', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('101', 'en', '0', '0', 'default', 'index', 'index', '', 'Weather Archive', 'Climatevo.com', '', '', NULL, '0');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('110', 'en', '12', '3', 'cms', 'adminContact', 'index', '', 'Kontakt', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('111', 'en', '110', '3', 'cms', 'adminContact', 'subject', '', 'Tematy kontaktu', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('112', 'en', '110', '2', 'cms', 'adminContact', 'editSubject', '', 'Dodaj temat', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('113', 'en', '110', '1', 'cms', 'adminContact', 'edit', '', 'Odpowiedz', NULL, '', '', NULL, '0');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('114', 'en', '110', '0', 'cms', 'adminContact', 'index', '', 'Lista zgłoszeń', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('119', 'en', '4', '0', 'mail', 'admin', 'index', '', 'Maile', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('120', 'en', '119', '0', 'mail', 'admin', 'send', '', 'Wyślij z kolejki', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('121', 'en', '119', '2', 'mail', 'adminServer', 'index', '', 'Serwery', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('122', 'en', '119', '1', 'mail', 'adminDefinition', 'index', '', 'Definicje maili', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('123', 'en', '121', '0', 'mail', 'adminServer', 'edit', '', 'Dodaj serwer', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('124', 'en', '122', '0', 'mail', 'adminDefinition', 'edit', '', 'Dodaj definicję', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('125', 'en', '12', '7', 'cron', 'admin', 'index', '', 'Cron', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('126', 'en', '125', '0', 'cron', 'admin', 'edit', '', 'Dodaj zadanie', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('127', 'en', '0', '0', NULL, NULL, NULL, NULL, 'Dolne menu', '', '', '', NULL, '0');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('128', 'en', '127', '1', 'cms', 'article', 'index', 'uri=regulamin', 'Regulamin', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('129', 'en', '127', '0', 'cms', 'article', 'index', 'uri=faq', 'FAQ', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('130', 'en', '127', '3', 'cms', 'contact', 'index', '', 'Kontakt', '', '', 'Skontaktuj się z nami, jeśli masz uwagi dotyczące działania serwisu Karaok.pl', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('131', 'en', '127', '2', 'cms', 'article', 'index', 'uri=reklama', 'Reklama', NULL, '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('134', 'en', '133', '0', 'song', 'index', 'display', '', 'Tekst piosenki', '', '', '', NULL, '0');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('135', 'en', '133', '1', 'artist', 'index', 'display', '', 'Piosenki artysty', '', '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('136', 'en', '4', '3', 'stat', 'admin', 'index', '', 'Statystyki', '', '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('137', 'en', '136', '0', 'stat', 'admin', 'label', '', 'Nazwy statystyk', '', '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('138', 'en', '137', '0', 'stat', 'admin', 'edit', '', 'Dodaj statystykę', '', '', '', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('139', 'en', '101', '4', 'user', 'login', 'index', '', 'Logowanie', '', '', 'Zaloguj się do swojego konta w serwisie Karaok.pl', NULL, '1');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('141', 'en', '139', '0', 'user', 'login', 'remind', '', 'Przypomnij hasło', '', '', '', NULL, '0');
insert into cms_navigation (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `visible`) values ('142', 'en', '141', '0', 'user', 'login', 'reset', '', 'Zmiana hasła', '', '', '', NULL, '0');

DROP TABLE IF EXISTS `cms_route`;
CREATE TABLE `cms_route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pattern` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `replace` text COLLATE utf8_polish_ci,
  `default` text COLLATE utf8_polish_ci,
  `order` int(11) NOT NULL DEFAULT '0',
  `active` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


DROP TABLE IF EXISTS `cms_text`;
CREATE TABLE `cms_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL,
  `key` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `content` text COLLATE utf8_polish_ci,
  `dateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


DROP TABLE IF EXISTS `cron`;
CREATE TABLE `cron` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint NOT NULL DEFAULT '0',
  `minute` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `hour` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `dayOfMonth` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `month` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `dayOfWeek` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci,
  `module` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `controller` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `action` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `dateAdd` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `dateLastExecute` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `cron` (`id`, `active`, `minute`, `hour`, `dayOfMonth`, `month`, `dayOfWeek`, `name`, `description`, `module`, `controller`, `action`, `dateAdd`, `dateModified`, `dateLastExecute`) VALUES
(1,	1,	'*',	'*',	'*',	'*',	'*',	'Wysyłka maili',	'Wysyłanie kolejki mailowej',	'mail',	'cron',	'send',	'2012-03-14 10:35:57',	'2012-03-14 10:36:16',	NULL);

DROP TABLE IF EXISTS `mail`;
CREATE TABLE `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_definition_id` int(11) NOT NULL,
  `fromName` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL,
  `to` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `replyTo` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL,
  `subject` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `message` text COLLATE utf8_polish_ci,
  `attachements` text COLLATE utf8_polish_ci,
  `type` tinyint NOT NULL DEFAULT '1',
  `dateAdd` datetime DEFAULT NULL,
  `dateSent` datetime DEFAULT NULL,
  `dateSendAfter` datetime DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mail_definition_id` (`mail_definition_id`),
  KEY `active` (`active`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


DROP TABLE IF EXISTS `mail_definition`;
CREATE TABLE `mail_definition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) COLLATE utf8_polish_ci DEFAULT 'pl',
  `mail_server_id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `replyTo` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL,
  `fromName` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL,
  `subject` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `message` text COLLATE utf8_polish_ci,
  `html` tinyint NOT NULL DEFAULT '0',
  `dateAdd` datetime DEFAULT NULL,
  `dateModify` datetime DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mail_server_id` (`mail_server_id`),
  KEY `lang` (`lang`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `mail_definition` (`id`, `lang`, `mail_server_id`, `name`, `replyTo`, `fromName`, `subject`, `message`, `html`, `dateAdd`, `dateModify`, `active`) VALUES
(1,	'pl',	1,	'reservation',	'',	'dsadasdadad',	'asdadasdasd',	'adasdasdasda',	0,	'2012-03-14 14:38:31',	'2012-03-14 14:49:18',	1),
(3,	'pl',	1,	'asasasda',	'',	'dsadasd',	'sdasdsa',	'dasdas',	0,	'2012-03-14 14:59:43',	'2012-03-14 15:04:35',	1);

DROP TABLE IF EXISTS `mail_server`;
CREATE TABLE `mail_server` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `port` tinyint NOT NULL DEFAULT '25',
  `username` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL,
  `from` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `dateAdd` datetime DEFAULT NULL,
  `dateModify` datetime DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `ssl` varchar(16) COLLATE utf8_polish_ci DEFAULT 'tls',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `mail_server` (`id`, `address`, `port`, `username`, `password`, `from`, `dateAdd`, `dateModify`, `active`, `ssl`) VALUES
(1,	'localhost',	25,	'local',	'',	'',	'2012-03-14 14:31:43',	'2012-03-14 14:47:01',	1,	'plain');

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `lead` text COLLATE utf8_polish_ci,
  `text` text COLLATE utf8_polish_ci,
  `dateAdd` datetime DEFAULT NULL,
  `dateModify` datetime DEFAULT NULL,
  `uri` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `internal` tinyint NOT NULL DEFAULT '1',
  `visible` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


DROP TABLE IF EXISTS `stat`;
CREATE TABLE `stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `objectId` int(11) DEFAULT NULL,
  `dateTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `stat` (`id`, `object`, `objectId`, `dateTime`) VALUES
(1,	'user_login',	NULL,	'2012-03-15 11:06:12'),
(2,	'user_login',	NULL,	'2012-03-15 11:06:52');

DROP TABLE IF EXISTS `stat_date`;
CREATE TABLE `stat_date` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hour` smallint(6) DEFAULT NULL,
  `day` smallint(6) DEFAULT NULL,
  `month` smallint(6) DEFAULT NULL,
  `year` smallint(6) DEFAULT NULL,
  `object` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `objectId` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `hour` (`hour`,`day`,`month`,`year`),
  KEY `object` (`object`,`objectId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


DROP TABLE IF EXISTS `stat_label`;
CREATE TABLE `stat_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) COLLATE utf8_polish_ci,
  `object` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `label` varchar(48) COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
