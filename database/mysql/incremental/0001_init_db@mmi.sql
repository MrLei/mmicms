CREATE TABLE `DB_CHANGELOG` (
  `filename` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `md5` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`filename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

CREATE TABLE `cms_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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

CREATE TABLE `cms_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL,
  `title` varchar(160) COLLATE utf8_polish_ci NOT NULL,
  `uri` varchar(160) COLLATE utf8_polish_ci NOT NULL,
  `dateAdd` datetime DEFAULT NULL,
  `dateModify` datetime DEFAULT NULL,
  `text` text COLLATE utf8_polish_ci,
  `noindex` TINYINT DEFAULT 0 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dateAdd` (`dateAdd`),
  KEY `dateModify` (`dateModify`),
  KEY `lang` (`lang`),
  KEY `title` (`title`),
  KEY `uri` (`uri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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

CREATE TABLE `cms_container_template`
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32),
  `path` varchar(128),
  `text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

CREATE TABLE cms_container
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` character varying(160),
  `serial` text,
  `uri` character varying(160),
  `cms_container_template_id` int(11),
  PRIMARY KEY (`id`),
  CONSTRAINT `cms_container_ibfk_1` FOREIGN KEY (cms_container_template_id) REFERENCES cms_container_template (id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

CREATE TABLE cms_container_template_placeholder
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_container_template_id` int(11) NOT NULL,
  `placeholder` varchar(32) NOT NULL,
  `name` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cms_container_template_id_placeholder` (`cms_container_template_id`,`placeholder`),
  CONSTRAINT `cms_container_template_placeholder_ibfk_1` FOREIGN KEY (cms_container_template_id) REFERENCES cms_container_template (id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

CREATE TABLE cms_container_template_placeholder_container
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_container_id` int(11) NOT NULL,
  `cms_container_template_placeholder_id` int(11) NOT NULL,
  `module` varchar(32) NOT NULL,
  `controller` varchar(32) NOT NULL,
  `action` varchar(32) NOT NULL,
  `params` text,
  `active` boolean NOT NULL DEFAULT true,
  `marginTop` integer,
  `marginRight` integer,
  `marginBottom` integer,
  `marginLeft` integer,
  PRIMARY KEY (`id`),
  CONSTRAINT `cms_container_template_placeholder_container_ibfk_1` FOREIGN KEY (cms_container_template_placeholder_id) REFERENCES cms_container_template_placeholder (id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `cms_container_template_placeholder_container_ibfk_2` FOREIGN KEY (cms_container_id) REFERENCES cms_container (id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

CREATE TABLE cms_tag
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  tag varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag` (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

CREATE TABLE cms_tag_link
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  cms_tag_id int(11) NOT NULL,
  `object` varchar(32) NOT NULL,
  `objectId` integer NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `cms_tag_link_ibfk_1` FOREIGN KEY (cms_tag_id) REFERENCES cms_tag(id) ON UPDATE CASCADE ON DELETE CASCADE,
  KEY `object_object_id` (`object`,	`objectId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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

CREATE TABLE `cms_contact_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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
  `dateStart` DATETIME,
  `dateEnd` DATETIME,
  `active` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `order` (`order`),
  KEY `parent_id` (`parent_id`),
  KEY `visible` (`visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

CREATE TABLE `cms_route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pattern` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `replace` text COLLATE utf8_polish_ci,
  `default` text COLLATE utf8_polish_ci,
  `order` int(11) NOT NULL DEFAULT '0',
  `active` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

CREATE TABLE `cms_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL,
  `key` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `content` text COLLATE utf8_polish_ci,
  `dateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cms_text_lang_key` (`lang`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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

CREATE TABLE `mail_definition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL,
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

CREATE TABLE `stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `objectId` int(11) DEFAULT NULL,
  `dateTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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

CREATE TABLE `stat_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL,
  `object` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `label` varchar(48) COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `cms_role` (`id`, `name`) VALUES
(1,	'guest'),
(2,	'member'),
(3,	'admin');

INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('1', '3', NULL, NULL, NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('2', '1', 'default', NULL, NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('3', '1', 'admin', 'login', NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('4', '1', 'cms', 'form', NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('5', '1', 'artist', 'index', NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('6', '1', 'user', 'login', NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('7', '1', 'user', 'registration', NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('8', '1', 'song', 'index', NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('9', '2', 'default', NULL, NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('10', '2', 'cms', NULL, NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('11', '2', 'artist', 'index', NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('12', '2', 'song', 'index', NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('13', '2', 'user', NULL, NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('14', '1', 'cms', 'captcha', NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('15', '1', 'cms', 'contact', NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('16', '1', 'cms', 'comment', NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('17', '1', 'cms', 'file', 'index', 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('18', '2', 'cms', 'article', NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('19', '1', 'cms', 'article', NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('20', '1', 'user', 'index', NULL, 'allow');
INSERT INTO cms_acl (`id`, `cms_role_id`, `module`, `controller`, `action`, `access`) values ('21', '2', 'user', 'index', NULL, 'allow');

INSERT INTO `cms_auth` (`id`, `lang`, `username`, `email`, `password`, `lastIp`, `lastLog`, `lastFailIp`, `lastFailLog`, `failLogCount`, `logged`, `active`) VALUES
(1,	'pl',	'admin',	'admin@milejko.pl',	'd033e22ae348aeb5660fc2140aec35850c4da997',	'127.0.0.1',	'2012-02-23 15:41:12',	'89.231.108.27',	'2011-12-20 19:42:01',	8,	0,	0),
(2,	'pl',	'mariusz',	'mariusz@milejko.pl',	'7a48d2fe2f6f86430acee5b86a093c3352b9f780',	'127.0.0.1',	'2012-03-20 15:54:01',	'127.0.0.1',	'2012-03-16 13:41:49',	9,	0,	1);

INSERT INTO `cms_auth_role` (`id`, `cms_auth_id`, `cms_role_id`) VALUES
(1,	2,	3),
(2,	1,	3);

INSERT INTO `cms_contact_option` (`id`, `name`) VALUES
(1,	'Inne'),
(2,	'Propozycje zmian');

INSERT INTO `cms_article` (`id`, `lang`, `title`, `uri`, `dateAdd`, `dateModify`, `text`, `noindex`) VALUES (1,	NULL,	'Hello admin',	'hello-admin',	'2014-03-20 12:06:56',	'2014-03-20 12:33:47',	'<h4>Witaj!</h4>
<p>To jest panel administracyjny systemu DEMO, pozwalający na zarządzanie treścią stron. Podłączone moduły umożliwiają dodawanie aktualności, artykułów (typu regulamin), zarządzanie strukturą menu i wiele innych, które zostaną krótko omówione w tym artykule.</p>
<p><strong>Górna sekcja została podzielona na 3 obszary:</strong></p>
<ol>
<li>Czarny pasek operacji - zawiera stałą ilość opcji: link do strony głównej panelu administracyjnego, podgląd strony frontowej, zmianę hasła i zamknięcie sesji.</li>
<li>Pasek "okruszków" - ułatwiają nawigację (np. cofnięcie do poprzedniej sekcji), oraz informują o obecnej pozycji w nawigacji.</li>
<li>Menu CMS - zawiera kompletną nawigację po panelu administracyjnym.</li>
<li>Okno robocze - pozwala na operację na danym module (wybranym z menu nawigacyjnego), pojawią się w nim np.: formularze, tabele, raporty i listy artykułów. </li>
</ol>
<h4>Przegląd modułów CMS</h4>
<ol>
<li>Aktualności - ten moduł zawiera dwa widoki: listę i szczegóły, umożliwia tworzenie treści za pomocą edytora WYSIWYG</li>
<li>Artykuły - jeden widok: artykuł, umożliwia tworzenie treści typu regulamin, polityka prywatności itp. (za pomocą WYSIWYG)</li>
<li>CMS<ol style="list-style-type: lower-alpha;`>
<li>Cron - harmonogram zadań, np. wysyłka newslettera, obliczanie statystyk itp.</li>
<li>Komentarze - agreguje komentarze użytkowników ze wszystkich modułów (np. aktualności)</li>
<li>Kontakt - zapytania zadane przez użytkowników w formularzu kontaktowym</li>
<li>Logi (systemowe i błędów) - pozwalają monitorować aplikację</li>
<li>Menu serwisu - umożliwia zarządzanie menu (zarówno frontu jak i panelu administracyjnego)</li>
<li>Pliki - agreguje pliki dodane we wszystkich modułach (np. zdjęcia w aktualnościach, awatary użytkowników itp.)</li>
<li>Strony CMS - umożliwia utworzenie szablonów (layoutów), a następnie stron opartych o te szablony, złożonych z dowolnych komponentów CMS</li>
<li>Teksty stałe - zarządzanie tekstami stałymi frontu aplikacji (np. tekst w stopce)</li>
</ol></li>
<li>Statystyki - pozwala monitorować wybrane zachowania użytkowników</li>
<li>System mailowy - odpowiada za wysyłkę e-maili do użytkowników</li>
<li>Użytkownicy - zarządzanie bazą zarejestrowanych użytkowników (oraz administratorów)<ol style="list-style-type: lower-alpha;">
<li>Uprawnienia - umożliwia nadawanie i odbieranie uprawnień wybranym rolom (ACL)</li>
</ol></li>
</ol>',	'0');

INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (4,	NULL,	'0',	3,	NULL,	NULL,	NULL,	'',	'Panel administracyjny',	'',	'',	'',	NULL,	'0',	'0',	'0',	'0',	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (12,	NULL,	4,	2,	'admin',	'index',	'index',	'',	'CMS',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (13,	NULL,	12,	5,	'cms',	'adminNavigation',	'index',	'',	'Menu serwisu',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (14,	NULL,	12,	4,	'cms',	'adminLog',	'index',	'',	'Log systemowy',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (15,	NULL,	13,	3,	'cms',	'adminNavigation',	'edit',	'type=simple',	'Dodaj artykuł',	'',	'',	'',	NULL,	'0',	'0',	'0',	'0',	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (17,	NULL,	13,	7,	'cms',	'adminNavigation',	'edit',	'type=cms',	'Dodaj obiekt CMS',	'',	'',	'',	NULL,	'0',	'0',	'0',	'0',	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (18,	NULL,	13,	8,	'cms',	'adminNavigation',	'edit',	'type=link',	'Dodaj odnośnik',	'',	'',	'',	NULL,	'0',	'0',	'0',	'0',	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (21,	NULL,	13,	5,	'cms',	'adminNavigation',	'edit',	'type=folder',	'Dodaj folder',	'',	'',	'',	NULL,	'0',	'0',	'0',	'0',	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (22,	NULL,	12,	6,	'cms',	'adminFile',	'index',	'',	'Pliki',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (24,	NULL,	12,	3,	'admin',	'errorLog',	'index',	'',	'Log błędów',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (26,	NULL,	48,	9,	'cms',	'adminAcl',	'index',	'',	'Uprawnienia',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (31,	NULL,	12,	1,	'cms',	'adminComment',	'index',	'',	'Komentarze',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (48,	NULL,	4,	5,	'cms',	'adminAuth',	'index',	'',	'Użytkownicy',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (49,	NULL,	48,	'0',	'cms',	'adminAuth',	'edit',	'',	'Dodaj',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (70,	NULL,	4,	1,	'cms',	'adminArticle',	'index',	'',	'Artykuły',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (71,	NULL,	70,	'0',	'cms',	'adminArticle',	'edit',	'',	'Dodaj',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (99,	NULL,	4,	'0',	'news',	'admin',	'index',	'',	'Aktualności',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (100,	NULL,	99,	'0',	'news',	'admin',	'edit',	'',	'Dodaj',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (101,	NULL,	'0',	'0',	NULL,	NULL,	NULL,	'',	'Górne menu',	'Demo',	'',	'',	NULL,	'0',	'0',	'0',	'0',	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (103,	NULL,	101,	'0',	'default',	'index',	'index',	'',	'Strona główna',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (104,	NULL,	101,	1,	'news',	'index',	'index',	'',	'Aktualności',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (105,	NULL,	104,	'0',	'news',	'index',	'display',	'',	'Artykuł',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	'0',	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (107,	NULL,	101,	4,	'user',	'registration',	'index',	'',	'Rejestracja',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (110,	NULL,	12,	2,	'cms',	'adminContact',	'index',	'',	'Kontakt',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (111,	NULL,	110,	'0',	'cms',	'adminContact',	'subject',	'',	'Tematy',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (112,	NULL,	111,	2,	'cms',	'adminContact',	'editSubject',	'',	'Dodaj',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (113,	NULL,	110,	1,	'cms',	'adminContact',	'edit',	'',	'Odpowiedz',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	'0',	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (116,	NULL,	101,	5,	'cms',	'contact',	'index',	'',	'Kontakt',	'Strona kontaktu',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (119,	NULL,	4,	4,	'mail',	'admin',	'index',	'',	'System mailowy',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (120,	NULL,	119,	'0',	'mail',	'admin',	'send',	'',	'Wyślij z kolejki',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (121,	NULL,	119,	2,	'mail',	'adminServer',	'index',	'',	'Serwery',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (122,	NULL,	119,	1,	'mail',	'adminDefinition',	'index',	'',	'Szablony',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (123,	NULL,	121,	'0',	'mail',	'adminServer',	'edit',	'',	'Dodaj',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (124,	NULL,	122,	'0',	'mail',	'adminDefinition',	'edit',	'',	'Dodaj',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (125,	NULL,	12,	'0',	'cron',	'admin',	'index',	'',	'Cron',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (126,	NULL,	125,	'0',	'cron',	'admin',	'edit',	'',	'Dodaj zadanie',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (127,	NULL,	12,	8,	'cms',	'adminContainer',	'index',	'',	'Strony CMS',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (128,	NULL,	127,	'0',	'cms',	'adminContainer',	'edit',	'',	'Dodaj',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (129,	NULL,	127,	1,	'cms',	'adminContainerTemplate',	'index',	'',	'Szablony',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (130,	NULL,	129,	'0',	'cms',	'adminContainerTemplate',	'edit',	'',	'Dodaj',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (131,	NULL,	129,	1,	'cms',	'adminContainerTemplatePlaceholder',	'edit',	'',	'Dodaj placeholder',	'',	'',	'',	NULL,	'0',	'0',	'0',	'0',	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (132,	NULL,	127,	2,	'cms',	'adminContainerTemplatePlaceholderContainer',	'edit',	'',	'Ustaw placeholder',	'',	'',	'',	NULL,	'0',	'0',	'0',	'0',	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (133,	NULL,	'0',	'0',	NULL,	NULL,	NULL,	NULL,	'Dolne menu',	'',	'',	'',	NULL,	'0',	'0',	'0',	'0',	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (134,	NULL,	133,	'0',	'cms',	'article',	'index',	'uri=regulamin',	'Regulamin serwisu',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (135,	NULL,	133,	1,	'cms',	'article',	'index',	'uri=strona-z-obrazkami',	'Strona z obrazkami',	NULL,	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (136,	NULL,	12,	9,	'cms',	'adminText',	'index',	'',	'Teksty stałe',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (137,	NULL,	13,	9,	'cms',	'adminNavigation',	'edit',	'type=container',	'Dodaj stronę CMS',	'',	'',	'',	NULL,	'0',	'0',	'0',	'0',	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (138,	NULL,	136,	'0',	'cms',	'adminText',	'edit',	'',	'Dodaj',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (139,	NULL,	4,	3,	'stat',	'admin',	'index',	'',	'Statystyki',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (140,	NULL,	139,	'0',	'stat',	'admin',	'label',	'',	'Nazwy',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (141,	NULL,	140,	'0',	'stat',	'admin',	'edit',	'',	'Dodaj',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (142,	NULL,	4,	6,	'cms',	'admin',	'password',	'',	'Zmiana hasła',	'',	'',	'',	NULL,	'0',	'0',	'0',	'0',	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (143,	NULL,	133,	2,	'cms',	'container',	'display',	'uri=witajcie',	'Przykładowa strona CMS',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (144,	NULL,	12,	7,	'cms',	'adminRoute',	'index',	'',	'Routing',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);
INSERT INTO `cms_navigation` (`id`, `lang`, `parent_id`, `order`, `module`, `controller`, `action`, `params`, `label`, `title`, `keywords`, `description`, `uri`, `independent`, `nofollow`, `blank`, `visible`, `dateStart`, `dateEnd`, `active`) VALUES (145,	NULL,	144,	'0',	'cms',	'adminRoute',	'edit',	'',	'Dodaj',	'',	'',	'',	NULL,	'0',	'0',	'0',	1,	NULL,	NULL,	1);

INSERT INTO `cms_text` (`id`, `lang`, `key`, `content`, `dateModify`) VALUES (1,	NULL,	'footer-copyright',	'© 2011-2014 Powered by MMi CMS',	'2014-03-19 16:59:43');

INSERT INTO `cron` (`id`, `active`, `minute`, `hour`, `dayOfMonth`, `month`, `dayOfWeek`, `name`, `description`, `module`, `controller`, `action`, `dateAdd`, `dateModified`, `dateLastExecute`) VALUES (1,	1,	'*',	'*',	'*',	'*',	'*',	'Wysyłka maili',	'Wysyła maile z kolejki',	'mail',	'cron',	'send',	'2012-03-14 10:35:57',	'2014-03-21 21:31:02',	'2014-03-21 21:31:02');
INSERT INTO `cron` (`id`, `active`, `minute`, `hour`, `dayOfMonth`, `month`, `dayOfWeek`, `name`, `description`, `module`, `controller`, `action`, `dateAdd`, `dateModified`, `dateLastExecute`) VALUES (2,	1,	'*',	'*',	'*',	'*',	'*',	'Agregator statystyk',	'Zlicza statystyki z serwisu',	'stat',	'cron',	'agregate',	'2014-03-20 09:48:29',	'2014-03-21 21:31:02',	'2014-03-21 21:31:02');
INSERT INTO `cron` (`id`, `active`, `minute`, `hour`, `dayOfMonth`, `month`, `dayOfWeek`, `name`, `description`, `module`, `controller`, `action`, `dateAdd`, `dateModified`, `dateLastExecute`) VALUES (3,	1,	'30',	'4',	'1',	'*/2',	'*',	'Czyszczenie logów',	'Czyści archiwalne logi aplikacji',	'cms',	'cron',	'clean',	'2014-03-20 09:49:37',	'2014-03-20 09:49:37',	NULL);

INSERT INTO `mail_server` (`id`, `address`, `port`, `username`, `password`, `from`, `dateAdd`, `dateModify`, `active`, `ssl`) VALUES
(1,	'localhost',	25,	'local',	'',	'',	'2012-03-14 14:31:43',	'2012-03-14 14:47:01',	1,	'plain');
