CREATE TABLE "DB_CHANGELOG"
(
  filename TEXT PRIMARY KEY,
  md5 TEXT NOT NULL
);

CREATE TABLE cms_acl (
    id INTEGER PRIMARY KEY,
    cms_role_id integer NOT NULL,
    module character varying(32),
    controller character varying(32),
    action character varying(32),
    access TEXT 'deny',
	FOREIGN KEY(cms_role_id) REFERENCES cms_role(id)
);

CREATE INDEX cms_acl_access_idx ON cms_acl (access);
CREATE INDEX cms_acl_action_idx ON cms_acl(action);
CREATE INDEX cms_acl_controller_idx ON cms_acl (controller);
CREATE INDEX cms_acl_module_idx ON cms_acl (module);
CREATE INDEX fki_cms_acl_cms_role_id_fkey ON cms_acl (cms_role_id);

CREATE TABLE cms_article (
    id INTEGER PRIMARY KEY,
    lang character varying(2),
    title character varying(160) NOT NULL,
    uri character varying(160) NOT NULL,
    "dateAdd" DATETIME,
    "dateModify" DATETIME,
    "text" text,
	noindex smallint DEFAULT 0 NOT NULL
);

CREATE INDEX "cms_article_dateAdd_idx" ON cms_article ("dateAdd");
CREATE INDEX "cms_article_dateModify_idx" ON cms_article ("dateModify");
CREATE INDEX cms_article_lang_idx ON cms_article (lang);
CREATE INDEX cms_article_title_idx ON cms_article (title);
CREATE INDEX cms_article_uri_idx ON cms_article (uri);

CREATE TABLE cms_auth (
    id INTEGER PRIMARY KEY,
    lang character varying(2),
    username character varying(128) NOT NULL,
    email character varying(128) NOT NULL,
    password character varying(128),
    "lastIp" character varying(16),
    "lastLog" DATETIME,
    "lastFailIp" character varying(16),
    "lastFailLog" DATETIME,
    "failLogCount" integer DEFAULT 0,
    logged smallint DEFAULT 0,
    active smallint DEFAULT 0 NOT NULL
);

CREATE INDEX cms_auth_active_idx ON cms_auth (active);
CREATE INDEX cms_auth_email_idx ON cms_auth (email);
CREATE INDEX cms_auth_logged_idx ON cms_auth (logged);
CREATE INDEX cms_auth_username_idx ON cms_auth (username);

CREATE TABLE cms_auth_role (
    id INTEGER PRIMARY KEY,
    cms_auth_id integer NOT NULL,
    cms_role_id integer NOT NULL,
    FOREIGN KEY (cms_auth_id) REFERENCES cms_auth(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (cms_role_id) REFERENCES cms_role(id)
);

CREATE INDEX fki_cms_auth_role_cms_auth_id ON cms_auth_role (cms_auth_id);
CREATE INDEX fki_cms_auth_role_cms_role_id ON cms_auth_role (cms_role_id);

CREATE TABLE cms_comment (
    id INTEGER PRIMARY KEY,
    cms_auth_id integer,
    parent_id integer DEFAULT 0,
    "dateAdd" DATETIME NOT NULL,
    title character varying(128),
    text text NOT NULL,
    signature character varying(64),
    ip character varying(16),
    stars real DEFAULT 0,
    object character varying(32) NOT NULL,
    "objectId" integer NOT NULL,
	FOREIGN KEY (cms_auth_id) REFERENCES cms_auth(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX "cms_comment_dateAdd_idx" ON cms_comment ("dateAdd");
CREATE INDEX "cms_comment_object_objectId_idx" ON cms_comment (object, "objectId");
CREATE INDEX cms_comment_parent_id_idx ON cms_comment (parent_id);
CREATE INDEX cms_comment_stars_idx ON cms_comment (stars);
CREATE INDEX fki_cms_comment_cms_auth_id_fkey ON cms_comment (cms_auth_id);

CREATE TABLE cms_contact (
    id INTEGER PRIMARY KEY,
    cms_contact_option_id integer NOT NULL,
    "dateAdd" DATETIME,
    text text,
    reply text,
    cms_auth_id_reply integer,
    uri character varying(255),
    email character varying(128) NOT NULL,
    ip character varying(16),
    cms_auth_id integer,
    active smallint DEFAULT 0 NOT NULL,
	FOREIGN KEY (cms_contact_option_id) REFERENCES cms_contact_option(id),
	FOREIGN KEY (cms_auth_id) REFERENCES cms_auth(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (cms_auth_id_reply) REFERENCES cms_auth(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX cms_contact_active_idx ON cms_contact (active);
CREATE INDEX "cms_contact_dateAdd_idx" ON cms_contact ("dateAdd");
CREATE INDEX cms_contact_email_idx ON cms_contact (email);
CREATE INDEX cms_contact_uri_idx ON cms_contact (uri);
CREATE INDEX fki_cms_contact_cms_auth_id_fkey ON cms_contact (cms_auth_id);
CREATE INDEX fki_cms_contact_cms_auth_id_reply_fkey ON cms_contact (cms_auth_id_reply);
CREATE INDEX fki_cms_contact_cms_contact_option_id_fkey ON cms_contact (cms_contact_option_id);

CREATE TABLE cms_contact_option (
    id INTEGER PRIMARY KEY,
    name character varying(64) NOT NULL
);

CREATE TABLE cms_container_template
(
  id INTEGER PRIMARY KEY,
  name character varying(32),
  path character varying(128),
  text text
);

CREATE TABLE cms_container
(
  id INTEGER PRIMARY KEY,
  title character varying(160),
  serial text,
  uri character varying(160),
  cms_container_template_id integer,
  FOREIGN KEY (cms_container_template_id) REFERENCES cms_container_template (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX cms_container_uri_idx ON cms_container(uri);
CREATE INDEX fki_cms_container_cms_container_template ON cms_container(cms_container_template_id);

CREATE TABLE cms_container_template_placeholder
(
  id INTEGER PRIMARY KEY,
  cms_container_template_id integer NOT NULL,
  placeholder character varying(32) NOT NULL,
  name text,
  FOREIGN KEY (cms_container_template_id) REFERENCES cms_container_template (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE UNIQUE INDEX cms_container_template_placeholder_template_id_placeholder ON cms_container_template_placeholder (cms_container_template_id, placeholder);
CREATE INDEX cms_container_template_placeholde_cms_container_template_id_idx ON cms_container_template_placeholder (cms_container_template_id);

CREATE TABLE cms_container_template_placeholder_container
(
  id INTEGER PRIMARY KEY,
  cms_container_id integer NOT NULL,
  cms_container_template_placeholder_id integer NOT NULL,
  module character varying(32) NOT NULL,
  controller character varying(32) NOT NULL,
  action character varying(32) NOT NULL,
  params text,
  active boolean NOT NULL DEFAULT true,
  "marginTop" integer,
  "marginRight" integer,
  "marginBottom" integer,
  "marginLeft" integer,
  FOREIGN KEY (cms_container_template_placeholder_id) REFERENCES cms_container_template_placeholder (id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (cms_container_id) REFERENCES cms_container (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX cms_container_template_placeh_cms_container_template_placeh_idx ON cms_container_template_placeholder_container (cms_container_template_placeholder_id);
CREATE INDEX cms_container_template_placeholder_contain_cms_container_id_idx ON cms_container_template_placeholder_container (cms_container_id);

CREATE TABLE cms_file (
    id INTEGER PRIMARY KEY,
    class character varying(32),
    "mimeType" character varying(32),
    name character varying(45),
    original character varying(255),
    title character varying(255),
    author character varying(255),
    source character varying(255),
    size bigint,
    "dateAdd" DATETIME,
    "dateModify" DATETIME,
    "order" integer,
    sticky smallint,
    object character varying(32),
    "objectId" integer,
    cms_auth_id integer,
    active smallint,
	FOREIGN KEY (cms_auth_id) REFERENCES cms_auth(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX cms_file_active_idx ON cms_file (active);
CREATE INDEX cms_file_author_idx ON cms_file (author);
CREATE INDEX cms_file_class_idx ON cms_file ("class");
CREATE INDEX "cms_file_dateAdd_idx" ON cms_file ("dateAdd");
CREATE INDEX "cms_file_dateModify_idx" ON cms_file ("dateModify");
CREATE INDEX cms_file_name_idx ON cms_file ("name");
CREATE INDEX "cms_file_object_objectId_idx" ON cms_file ("object", "objectId");
CREATE INDEX cms_file_order_idx ON cms_file ("order");
CREATE INDEX cms_file_sticky_idx ON cms_file (sticky);
CREATE INDEX cms_file_title_idx ON cms_file (title);
CREATE INDEX fki_cms_file_cms_auth_id_fkey ON cms_file (cms_auth_id);

CREATE TABLE cms_log (
    id INTEGER PRIMARY KEY,
    url character varying(255),
    ip character varying(16),
    browser character varying(255),
    operation character varying(32),
    object character varying(32),
    "objectId" integer,
    data text,
    success smallint DEFAULT 0 NOT NULL,
    cms_auth_id integer,
    "dateTime" DATETIME,
	FOREIGN KEY (cms_auth_id) REFERENCES cms_auth(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX "cms_log_dateTime_idx" ON cms_log ("dateTime");
CREATE INDEX cms_log_ip_idx ON cms_log (ip);
CREATE INDEX "cms_log_objectId_idx" ON cms_log ("objectId");
CREATE INDEX cms_log_object_idx ON cms_log ("object");
CREATE INDEX cms_log_operation_idx ON cms_log ("operation");
CREATE INDEX cms_log_url_idx ON cms_log (url);
CREATE INDEX fki_cms_log_cms_auth_id_fkey ON cms_log (cms_auth_id);

CREATE TABLE cms_navigation (
    id INTEGER PRIMARY KEY,
    lang character varying(2),
    parent_id integer DEFAULT 0 NOT NULL,
    "order" integer DEFAULT 0 NOT NULL,
    module character varying(32),
    controller character varying(32),
    action character varying(32),
    params text,
    label character varying(64),
    title character varying(64),
    keywords text,
    description text,
    uri text,
	independent smallint DEFAULT 0 NOT NULL,
	nofollow smallint DEFAULT 0 NOT NULL,
	blank smallint DEFAULT 0 NOT NULL,
    visible smallint DEFAULT 0 NOT NULL,
	"dateStart" DATETIME,
	"dateEnd" DATETIME,
	active smallint DEFAULT 1 NOT NULL
);

CREATE INDEX cms_navigation_order_idx ON cms_navigation ("order");
CREATE INDEX cms_navigation_parent_id_idx ON cms_navigation (parent_id);
CREATE INDEX cms_navigation_visible_idx ON cms_navigation (visible);
CREATE INDEX "cms_navigation_dateStart_idx" ON cms_navigation ("dateStart");
CREATE INDEX "cms_navigation_dateEnd_idx" ON cms_navigation ("dateEnd");
CREATE INDEX cms_navigation_active_idx ON cms_navigation (active);

CREATE TABLE cms_role (
    id INTEGER PRIMARY KEY,
    name character varying(32) NOT NULL
);

CREATE INDEX cms_role_name_idx ON cms_role ("name");

CREATE TABLE cms_route
(
   id INTEGER PRIMARY KEY,
   pattern character varying(255),
   replace text,
   "default" text,
   "order" integer NOT NULL DEFAULT 0,
   active smallint NOT NULL DEFAULT 0
);

CREATE INDEX cms_route_active_idx ON cms_route (active);
CREATE INDEX cms_route_order_idx ON cms_route ("order");

CREATE TABLE cms_tag
(
  id INTEGER PRIMARY KEY,
  tag character varying(64) NOT NULL
);

CREATE INDEX cms_tag_tag_idx ON cms_tag ("tag");

CREATE TABLE cms_tag_link
(
  id INTEGER PRIMARY KEY,
  cms_tag_id integer NOT NULL,
  "object" character varying(32) NOT NULL,
  "objectId" integer NOT NULL,
  FOREIGN KEY (cms_tag_id) REFERENCES cms_tag(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX fki_cms_tag_link_cms_tag_id_fkey ON cms_tag_link (cms_tag_id);
CREATE INDEX cms_tag_link_object_objectId_idx ON cms_tag_link ("object", "objectId");

CREATE TABLE cms_text
(
  id INTEGER PRIMARY KEY,
  lang character varying(2),
  key character varying(32),
  content text,
  "dateModify" DATETIME
);

CREATE INDEX "cms_text_dateModify_idx" ON cms_text ("dateModify");
CREATE UNIQUE INDEX cms_text_lang_key_idx ON cms_text (lang, "key");

CREATE TABLE cron (
    id INTEGER PRIMARY KEY,
    active smallint DEFAULT 0 NOT NULL,
    minute character varying(50) NOT NULL,
    hour character varying(50) NOT NULL,
    "dayOfMonth" character varying(50) NOT NULL,
    month character varying(50) NOT NULL,
    "dayOfWeek" character varying(50) NOT NULL,
    name character varying(50) NOT NULL,
    description text,
    module character varying(32) NOT NULL,
    controller character varying(32) NOT NULL,
    action character varying(32) NOT NULL,
    "dateAdd" DATETIME,
    "dateModified" DATETIME,
    "dateLastExecute" DATETIME
);

CREATE INDEX cron_active_idx ON cron (active);

CREATE TABLE mail (
    id INTEGER PRIMARY KEY,
    mail_definition_id integer NOT NULL,
    "fromName" character varying(64),
    "to" character varying,
    "replyTo" character varying(64),
    subject character varying(200),
    message text,
    attachements text,
    type smallint DEFAULT 1 NOT NULL,
    "dateAdd" DATETIME,
    "dateSent" DATETIME,
    "dateSendAfter" DATETIME,
    active smallint DEFAULT 0 NOT NULL,
	FOREIGN KEY (mail_definition_id) REFERENCES mail_definition(id)
);

CREATE INDEX fki_mail_mail_definition_id_fkey ON mail (mail_definition_id);
CREATE INDEX mail_active_idx ON mail (active);
CREATE INDEX mail_type_idx ON mail ("type");

CREATE TABLE mail_definition (
    id INTEGER PRIMARY KEY,
    lang character varying(2) NOT NULL DEFAULT 'pl',
    mail_server_id integer NOT NULL,
    name character varying(32),
    "replyTo" character varying(64),
    "fromName" character varying(64),
    subject character varying(200),
    message text,
    html smallint DEFAULT 0 NOT NULL,
    "dateAdd" DATETIME,
    "dateModify" DATETIME,
    active smallint DEFAULT 0 NOT NULL,
	FOREIGN KEY (mail_server_id) REFERENCES mail_server(id)
);

CREATE INDEX fki_mail_definition_mail_server_id_fkey ON mail_definition (mail_server_id);
CREATE INDEX mail_definition_lang_name_idx ON mail_definition (lang, "name");

CREATE TABLE mail_server (
    id INTEGER PRIMARY KEY,
    address character varying(64) NOT NULL,
    port smallint DEFAULT 25 NOT NULL,
    username character varying(64),
    password character varying(64),
    "from" character varying(200),
    "dateAdd" DATETIME,
    "dateModify" DATETIME,
    active smallint DEFAULT 1 NOT NULL,
    ssl character varying(16) DEFAULT 'tls'
);

CREATE TABLE news (
    id INTEGER PRIMARY KEY,
    lang character varying(2),
    title character varying(255) NOT NULL,
    lead text,
    text text,
    "dateAdd" DATETIME,
    "dateModify" DATETIME,
    uri character varying(255),
	internal smallint DEFAULT 1 NOT NULL,
    visible smallint DEFAULT 1 NOT NULL
);

CREATE INDEX news_uri_idx ON news (uri);

CREATE TABLE payment (
    id INTEGER PRIMARY KEY,
    payment_config_id integer NOT NULL,
    cms_auth_id integer NOT NULL,
    text text,
    value real DEFAULT 0 NOT NULL,
    ip character varying(16),
    "sessionId" character varying(32),
    "dateAdd" DATETIME NOT NULL,
    "dateEnd" DATETIME,
    type character varying(2),
    status smallint DEFAULT 1 NOT NULL,
	FOREIGN KEY (cms_auth_id) REFERENCES cms_auth (id),
	FOREIGN KEY (payment_config_id) REFERENCES payment_config(id)
);

CREATE INDEX fki_payment_cms_auth_id_fkey ON payment (cms_auth_id);
CREATE INDEX fki_payment_payment_config_id_fkey ON payment (payment_config_id);
CREATE INDEX "payment_dateAdd_idx" ON payment ("dateAdd");
CREATE INDEX "payment_dateEnd_idx" ON payment ("dateEnd");
CREATE INDEX payment_status_idx ON payment (status);

CREATE TABLE payment_config (
    id INTEGER PRIMARY KEY,
    name character varying(32) NOT NULL,
    "shopId" integer NOT NULL,
    "transactionKey" character varying(32) NOT NULL,
    key1 character varying(32) NOT NULL,
    key2 character varying(32),
    active smallint DEFAULT 1 NOT NULL
);

CREATE UNIQUE INDEX payment_config_name_idx ON payment_config ("name");

CREATE TABLE stat
(
  id INTEGER PRIMARY KEY,
  object character varying(50) NOT NULL,
  "objectId" integer,
  "dateTime" DATETIME NOT NULL
);

CREATE TABLE stat_date
(
  id INTEGER PRIMARY KEY,
  hour smallint,
  day smallint,
  month smallint,
  year smallint,
  object character varying(32),
  "objectId" integer,
  count integer NOT NULL DEFAULT 0
);

CREATE INDEX stat_date_hour_day_month_year_idx ON stat_date ("hour", "day", "month", "year");
CREATE INDEX "stat_date_object_objectId_idx" ON stat_date ("object");

CREATE TABLE stat_label
(
  id INTEGER PRIMARY KEY,
  lang character varying(2) NOT NULL,
  object character varying(32) NOT NULL,
  label character varying(48) NOT NULL,
  description text
);

CREATE UNIQUE INDEX stat_label_lang_object_idx ON stat_label (lang, "object");

INSERT INTO cms_role (id, name) VALUES (1, 'guest');
INSERT INTO cms_role (id, name) VALUES (2, 'member');
INSERT INTO cms_role (id, name) VALUES (3, 'admin');

INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (1, 3, NULL, NULL, NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (2, 1, 'default', NULL, NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (3, 1, 'admin', 'login', NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (4, 1, 'cms', NULL, NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (5, 1, 'news', 'index', NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (6, 1, 'user', 'login', NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (7, 1, 'user', 'registration', NULL, 'allow');

INSERT INTO cms_auth (id, lang, username, email, password, "lastIp", "lastLog", "lastFailIp", "lastFailLog", "failLogCount", logged, active) VALUES (1, 'pl', 'admin', 'admin@hqsoft.pl', 'd033e22ae348aeb5660fc2140aec35850c4da997', '127.0.0.1', '2012-02-23 15:41:12', '89.231.108.27', '2011-12-20 19:42:01', 8, 0, 1);
INSERT INTO cms_auth (id, lang, username, email, password, "lastIp", "lastLog", "lastFailIp", "lastFailLog", "failLogCount", logged, active) VALUES (11, 'pl', 'test', 'test@milejko.pl', '5cb9cbee5f6421f730ecbf0bc981cee4e117181243a95512aef7576d20e547b0559da0a4d5d67252888a2e52e8589ace4a30a87716d33745f3697f80b6269576', '127.0.0.1', '2012-03-15 11:06:52', '127.0.0.1', '2012-03-15 11:04:59', 1, 0, 1);
INSERT INTO cms_auth (id, lang, username, email, password, "lastIp", "lastLog", "lastFailIp", "lastFailLog", "failLogCount", logged, active) VALUES (2, 'pl', 'mariusz', 'mariusz@milejko.pl', '7a48d2fe2f6f86430acee5b86a093c3352b9f780', '127.0.0.1', '2012-03-20 15:54:01', '127.0.0.1', '2012-03-16 13:41:49', 9, 0, 1);

INSERT INTO cms_auth_role (id, cms_auth_id, cms_role_id) VALUES (7, 2, 3);
INSERT INTO cms_auth_role (id, cms_auth_id, cms_role_id) VALUES (8, 1, 3);
INSERT INTO cms_auth_role (id, cms_auth_id, cms_role_id) VALUES (13, 11, 2);

INSERT INTO cms_contact_option (id, name) VALUES (3, 'Propozycje zmian');
INSERT INTO cms_contact_option (id, name) VALUES (1, 'Inne');

INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (12, 'pl', 4, 0, 'admin', 'index', 'index', '', 'CMS', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (13, 'pl', 12, 0, 'cms', 'adminNavigation', 'index', '', 'Struktura serwisu', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (14, 'pl', 12, 8, 'cms', 'adminLog', 'index', '', 'Log systemowy', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (15, 'pl', 13, 3, 'cms', 'adminNavigation', 'edit', 'type=simple', 'Dodaj stronę statyczną', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (17, 'pl', 13, 7, 'cms', 'adminNavigation', 'edit', 'type=cms', 'Dodaj obiekt CMS', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (18, 'pl', 13, 8, 'cms', 'adminNavigation', 'edit', 'type=link', 'Dodaj odnośnik', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (21, 'pl', 13, 5, 'cms', 'adminNavigation', 'edit', 'type=folder', 'Dodaj folder', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (22, 'pl', 12, 2, 'cms', 'adminFile', 'index', '', 'Pliki', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (24, 'pl', 12, 9, 'admin', 'errorLog', 'index', '', 'Log błędów', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (26, 'pl', 12, 6, 'cms', 'adminAcl', 'index', '', 'Uprawnienia', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (31, 'pl', 12, 4, 'cms', 'adminComment', 'index', '', 'Komentarze', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (48, 'pl', 12, 5, 'cms', 'adminAuth', 'index', '', 'Użytkownicy', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (49, 'pl', 48, 0, 'cms', 'adminAuth', 'edit', '', 'Dodaj użytkownika', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (70, 'pl', 12, 1, 'cms', 'adminArticle', 'index', '', 'Artykuły', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (71, 'pl', 70, 0, 'cms', 'adminArticle', 'edit', '', 'Dodaj artykuł', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (74, 'pl', 48, 1, 'cms', 'adminAuth', 'property', '', 'Właściwości użytkownika', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (75, 'pl', 74, 0, 'cms', 'adminAuth', 'propertyEdit', '', 'Dodaj właściwości użytkownika', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (99, 'pl', 4, 2, 'news', 'admin', 'index', '', 'Aktualności', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (100, 'pl', 99, 0, 'news', 'admin', 'edit', '', 'Dodaj artykuł', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (103, 'pl', 101, 0, 'default', 'index', 'index', '', 'Strona główna', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (104, 'pl', 101, 1, 'news', 'index', 'index', '', 'Aktualności', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (105, 'pl', 104, 0, 'news', 'index', 'display', '', 'Artykuł', NULL, '', '', NULL, 0);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (107, 'pl', 101, 4, 'user', 'registration', 'index', '', 'Rejestracja', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (110, 'pl', 12, 3, 'cms', 'adminContact', 'index', '', 'Kontakt', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (111, 'pl', 110, 3, 'cms', 'adminContact', 'subject', '', 'Tematy kontaktu', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (112, 'pl', 110, 2, 'cms', 'adminContact', 'editSubject', '', 'Dodaj temat', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (113, 'pl', 110, 1, 'cms', 'adminContact', 'edit', '', 'Odpowiedz', NULL, '', '', NULL, 0);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (114, 'pl', 110, 0, 'cms', 'adminContact', 'index', '', 'Lista zgłoszeń', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (119, 'pl', 4, 0, 'mail', 'admin', 'index', '', 'Maile', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (120, 'pl', 119, 0, 'mail', 'admin', 'send', '', 'Wyślij z kolejki', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (121, 'pl', 119, 2, 'mail', 'adminServer', 'index', '', 'Serwery', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (122, 'pl', 119, 1, 'mail', 'adminDefinition', 'index', '', 'Definicje maili', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (123, 'pl', 121, 0, 'mail', 'adminServer', 'edit', '', 'Dodaj serwer', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (124, 'pl', 122, 0, 'mail', 'adminDefinition', 'edit', '', 'Dodaj definicję', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (125, 'pl', 12, 7, 'cron', 'admin', 'index', '', 'Cron', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (126, 'pl', 125, 0, 'cron', 'admin', 'edit', '', 'Dodaj zadanie', NULL, '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (116, 'pl', 101, 5, 'cms', 'contact', 'index', '', 'Kontakt', 'Strona kontaktu', '', '', NULL, 1);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (4, 'pl', 0, 3, 'admin', 'index', 'index', '', 'Panel administracyjny', NULL, '', '', NULL, 0);
INSERT INTO cms_navigation (id, lang, parent_id, "order", module, controller, action, params, label, title, keywords, description, uri, visible) VALUES (101, 'pl', 0, 0, 'default', 'index', 'index', NULL, 'Front', NULL, NULL, NULL, NULL, 0);

INSERT INTO cron (id, active, minute, hour, "dayOfMonth", month, "dayOfWeek", name, description, module, controller, action, "dateAdd", "dateModified", "dateLastExecute") VALUES (1, 1, '*', '*', '*', '*', '*', 'Wysyłka maili', 'Wysyłanie kolejki mailowej', 'mail', 'cron', 'send', '2012-03-14 10:35:57', '2012-03-14 10:36:16', NULL);

INSERT INTO mail_server (id, address, port, username, password, "from", "dateAdd", "dateModify", active, ssl) VALUES (1, 'localhost', 25, 'local', '', '', '2012-03-14 14:31:43', '2012-03-14 14:47:01', 1, 'plain');

