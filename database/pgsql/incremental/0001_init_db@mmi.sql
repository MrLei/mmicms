CREATE TABLE "DB_CHANGELOG"
(
  filename character varying(64) NOT NULL,
  md5 character(32) NOT NULL,
  CONSTRAINT "DB_CHANGELOG_pkey" PRIMARY KEY (filename)
)
WITH (
  OIDS=FALSE
);

CREATE TABLE cms_acl (
    id integer NOT NULL,
    cms_role_id integer NOT NULL,
    module character varying(32),
    controller character varying(32),
    action character varying(32),
    access character varying(8) DEFAULT 'deny'::character varying
);

CREATE SEQUENCE cms_acl_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE cms_acl_id_seq OWNED BY cms_acl.id;

SELECT pg_catalog.setval('cms_acl_id_seq', 10, true);

CREATE TABLE cms_article (
    id integer NOT NULL,
    lang character varying(2),
    title character varying(160) NOT NULL,
    uri character varying(160) NOT NULL,
    "dateAdd" timestamp without time zone,
    "dateModify" timestamp without time zone,
    text text
);

CREATE SEQUENCE cms_article_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE cms_article_id_seq OWNED BY cms_article.id;

SELECT pg_catalog.setval('cms_article_id_seq', 12, true);

CREATE TABLE cms_auth (
    id integer NOT NULL,
    lang character varying(2),
    username character varying(128) NOT NULL,
    email character varying(128) NOT NULL,
    password character varying(128),
    "lastIp" character varying(16),
    "lastLog" timestamp without time zone,
    "lastFailIp" character varying(16),
    "lastFailLog" timestamp without time zone,
    "failLogCount" integer DEFAULT 0,
    logged smallint DEFAULT 0,
    active smallint DEFAULT 0 NOT NULL
);


CREATE SEQUENCE cms_auth_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE cms_auth_id_seq OWNED BY cms_auth.id;

SELECT pg_catalog.setval('cms_auth_id_seq', 11, true);

CREATE TABLE cms_auth_role (
    id integer NOT NULL,
    cms_auth_id integer NOT NULL,
    cms_role_id integer NOT NULL
);


CREATE SEQUENCE cms_auth_role_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE cms_auth_role_id_seq OWNED BY cms_auth_role.id;

SELECT pg_catalog.setval('cms_auth_role_id_seq', 13, true);

CREATE TABLE cms_comment (
    id integer NOT NULL,
    cms_auth_id integer,
    parent_id integer DEFAULT 0,
    "dateAdd" timestamp without time zone NOT NULL,
    title character varying(128),
    text text NOT NULL,
    signature character varying(64),
    ip character varying(16),
    stars real DEFAULT 0,
    object character varying(32) NOT NULL,
    "objectId" integer NOT NULL
);

CREATE SEQUENCE cms_comment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE cms_comment_id_seq OWNED BY cms_comment.id;

SELECT pg_catalog.setval('cms_comment_id_seq', 1, false);

CREATE TABLE cms_contact (
    id integer NOT NULL,
    cms_contact_option_id integer NOT NULL,
    "dateAdd" timestamp without time zone,
    text text,
    reply text,
    cms_auth_id_reply integer,
    uri character varying(255),
    email character varying(128) NOT NULL,
    ip character varying(16),
    cms_auth_id integer,
    active smallint DEFAULT 0 NOT NULL
);


CREATE SEQUENCE cms_contact_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE cms_contact_id_seq OWNED BY cms_contact.id;


SELECT pg_catalog.setval('cms_contact_id_seq', 4, true);


CREATE TABLE cms_contact_option (
    id integer NOT NULL,
    name character varying(64) NOT NULL
);

CREATE SEQUENCE cms_contact_option_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE cms_contact_option_id_seq OWNED BY cms_contact_option.id;


SELECT pg_catalog.setval('cms_contact_option_id_seq', 4, true);


CREATE TABLE cms_file (
    id integer NOT NULL,
    class character varying(32),
    "mimeType" character varying(32),
    name character varying(45),
    original character varying(255),
    title character varying(255),
    author character varying(255),
    source character varying(255),
    size bigint,
    "dateAdd" timestamp without time zone,
    "dateModify" timestamp without time zone,
    "order" integer,
    sticky smallint,
    object character varying(32),
    "objectId" integer,
    cms_auth_id integer,
    active smallint
);


CREATE SEQUENCE cms_file_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE cms_file_id_seq OWNED BY cms_file.id;

SELECT pg_catalog.setval('cms_file_id_seq', 3, true);

CREATE TABLE cms_log (
    id integer NOT NULL,
    url character varying(255),
    ip character varying(16),
    browser character varying(255),
    operation character varying(32),
    object character varying(32),
    "objectId" integer,
    data text,
    success smallint DEFAULT 0 NOT NULL,
    cms_auth_id integer,
    "dateTime" timestamp without time zone
);

CREATE SEQUENCE cms_log_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE cms_log_id_seq OWNED BY cms_log.id;

SELECT pg_catalog.setval('cms_log_id_seq', 17, true);

CREATE TABLE cms_navigation (
    id integer NOT NULL,
    lang character varying(2),
    parent_id integer DEFAULT 0 NOT NULL,
    "order" integer DEFAULT 0 NOT NULL,
    module character varying(64),
    controller character varying(64),
    action character varying(64),
    params text,
    label character varying(64),
    title character varying(64),
    keywords text,
    description text,
    uri text,
    visible smallint DEFAULT 0 NOT NULL,
	https smallint DEFAULT NULL,
	absolute smallint NOT NULL DEFAULT 0,
	independent smallint NOT NULL DEFAULT 0,
	nofollow smallint NOT NULL DEFAULT 0,
	blank smallint NOT NULL DEFAULT 0
);

CREATE SEQUENCE cms_navigation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE cms_navigation_id_seq OWNED BY cms_navigation.id;

SELECT pg_catalog.setval('cms_navigation_id_seq', 200, true);

CREATE TABLE cms_role (
    id integer NOT NULL,
    name character varying(32) NOT NULL
);


CREATE SEQUENCE cms_role_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE cms_role_id_seq OWNED BY cms_role.id;

SELECT pg_catalog.setval('cms_role_id_seq', 10, true);

CREATE TABLE cms_text
(
  id serial NOT NULL,
  lang character varying(2),
  key character varying(32),
  content text,
  "dateModify" timestamp without time zone,
  CONSTRAINT cms_text_pkey PRIMARY KEY (id )
)
WITH (
  OIDS=FALSE
);

CREATE INDEX "cms_text_dateModify_idx"
  ON cms_text
  USING btree
  ("dateModify" );

CREATE UNIQUE INDEX cms_text_lang_key_idx
  ON cms_text
  USING btree
  (lang COLLATE pg_catalog."default" , key COLLATE pg_catalog."default" );

CREATE TABLE cron (
    id integer NOT NULL,
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
    "dateAdd" timestamp without time zone,
    "dateModified" timestamp without time zone,
    "dateLastExecute" timestamp without time zone
);

CREATE SEQUENCE cron_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE cron_id_seq OWNED BY cron.id;

SELECT pg_catalog.setval('cron_id_seq', 1, true);

CREATE TABLE mail (
    id integer NOT NULL,
    mail_definition_id integer NOT NULL,
    "fromName" character varying(64),
    "to" character varying,
    "replyTo" character varying(64),
    subject character varying(200),
    message text,
    attachements text,
    type smallint DEFAULT 1 NOT NULL,
    "dateAdd" timestamp without time zone,
    "dateSent" timestamp without time zone,
    "dateSendAfter" timestamp without time zone,
    active smallint DEFAULT 0 NOT NULL
);

CREATE TABLE mail_definition (
    id integer NOT NULL,
    lang character varying(2) DEFAULT 'pl'::character varying NOT NULL,
    mail_server_id integer NOT NULL,
    name character varying(32),
    "replyTo" character varying(64),
    "fromName" character varying(64),
    subject character varying(200),
    message text,
    html smallint DEFAULT 0 NOT NULL,
    "dateAdd" timestamp without time zone,
    "dateModify" timestamp without time zone,
    active smallint DEFAULT 0 NOT NULL
);

CREATE SEQUENCE mail_definition_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE mail_definition_id_seq OWNED BY mail_definition.id;

SELECT pg_catalog.setval('mail_definition_id_seq', 6, true);

CREATE SEQUENCE mail_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE mail_id_seq OWNED BY mail.id;
SELECT pg_catalog.setval('mail_id_seq', 1, false);

CREATE TABLE mail_server (
    id integer NOT NULL,
    address character varying(64) NOT NULL,
    port smallint DEFAULT 25 NOT NULL,
    username character varying(64),
    password character varying(64),
    "from" character varying(200),
    "dateAdd" timestamp without time zone,
    "dateModify" timestamp without time zone,
    active smallint DEFAULT 1 NOT NULL,
    ssl character varying(16) DEFAULT 'tls'::character varying
);


CREATE SEQUENCE mail_server_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE mail_server_id_seq OWNED BY mail_server.id;


SELECT pg_catalog.setval('mail_server_id_seq', 1, true);


CREATE TABLE news (
    id integer NOT NULL,
    lang character varying(2),
    title character varying(255) NOT NULL,
    lead text,
    text text,
    "dateAdd" timestamp without time zone,
    "dateModify" timestamp without time zone,
    uri character varying(255),
	internal smallint DEFAULT 1 NOT NULL,
    visible smallint DEFAULT 1 NOT NULL
);

CREATE SEQUENCE news_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

CREATE INDEX news_uri_idx
  ON news
  USING btree
  (uri COLLATE pg_catalog."default" );

ALTER SEQUENCE news_id_seq OWNED BY news.id;

CREATE TABLE stat (
    id integer NOT NULL,
    object character varying(50) NOT NULL,
    "objectId" integer,
    "dateTime" timestamp without time zone NOT NULL
);


CREATE TABLE stat_date (
    id integer NOT NULL,
    hour smallint,
    day smallint,
    month smallint,
    year smallint,
    object character varying(32),
    "objectId" integer,
    count integer DEFAULT 0 NOT NULL
);


CREATE SEQUENCE stat_date_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE stat_date_id_seq OWNED BY stat_date.id;


SELECT pg_catalog.setval('stat_date_id_seq', 1, false);


CREATE SEQUENCE stat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE stat_id_seq OWNED BY stat.id;


SELECT pg_catalog.setval('stat_id_seq', 2, true);


CREATE TABLE stat_label (
    id integer NOT NULL,
    lang character varying(2),
    object character varying(32) NOT NULL,
    label character varying(48) NOT NULL,
    description text
);


CREATE SEQUENCE stat_label_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE stat_label_id_seq OWNED BY stat_label.id;


SELECT pg_catalog.setval('stat_label_id_seq', 1, false);


ALTER TABLE ONLY cms_acl ALTER COLUMN id SET DEFAULT nextval('cms_acl_id_seq'::regclass);

ALTER TABLE ONLY cms_article ALTER COLUMN id SET DEFAULT nextval('cms_article_id_seq'::regclass);


ALTER TABLE ONLY cms_auth ALTER COLUMN id SET DEFAULT nextval('cms_auth_id_seq'::regclass);


ALTER TABLE ONLY cms_auth_role ALTER COLUMN id SET DEFAULT nextval('cms_auth_role_id_seq'::regclass);


ALTER TABLE ONLY cms_comment ALTER COLUMN id SET DEFAULT nextval('cms_comment_id_seq'::regclass);


ALTER TABLE ONLY cms_contact ALTER COLUMN id SET DEFAULT nextval('cms_contact_id_seq'::regclass);

ALTER TABLE ONLY cms_contact_option ALTER COLUMN id SET DEFAULT nextval('cms_contact_option_id_seq'::regclass);

ALTER TABLE ONLY cms_file ALTER COLUMN id SET DEFAULT nextval('cms_file_id_seq'::regclass);

ALTER TABLE ONLY cms_log ALTER COLUMN id SET DEFAULT nextval('cms_log_id_seq'::regclass);

ALTER TABLE ONLY cms_navigation ALTER COLUMN id SET DEFAULT nextval('cms_navigation_id_seq'::regclass);

ALTER TABLE ONLY cms_role ALTER COLUMN id SET DEFAULT nextval('cms_role_id_seq'::regclass);

ALTER TABLE ONLY cron ALTER COLUMN id SET DEFAULT nextval('cron_id_seq'::regclass);

ALTER TABLE ONLY mail ALTER COLUMN id SET DEFAULT nextval('mail_id_seq'::regclass);

ALTER TABLE ONLY mail_definition ALTER COLUMN id SET DEFAULT nextval('mail_definition_id_seq'::regclass);

ALTER TABLE ONLY mail_server ALTER COLUMN id SET DEFAULT nextval('mail_server_id_seq'::regclass);

ALTER TABLE ONLY news ALTER COLUMN id SET DEFAULT nextval('news_id_seq'::regclass);

ALTER TABLE ONLY payment ALTER COLUMN id SET DEFAULT nextval('payment_id_seq'::regclass);

ALTER TABLE ONLY payment_config ALTER COLUMN id SET DEFAULT nextval('payment_config_id_seq'::regclass);

ALTER TABLE ONLY stat ALTER COLUMN id SET DEFAULT nextval('stat_id_seq'::regclass);

ALTER TABLE ONLY stat_date ALTER COLUMN id SET DEFAULT nextval('stat_date_id_seq'::regclass);

ALTER TABLE ONLY stat_label ALTER COLUMN id SET DEFAULT nextval('stat_label_id_seq'::regclass);

INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (1, 3, NULL, NULL, NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (2, 1, 'default', NULL, NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (3, 1, 'admin', 'login', NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (4, 1, 'cms', NULL, NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (5, 1, 'news', 'index', NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (6, 1, 'user', 'login', NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (7, 1, 'user', 'registration', NULL, 'allow');

INSERT INTO cms_auth (id, lang, username, email, password, "lastIp", "lastLog", "lastFailIp", "lastFailLog", "failLogCount", logged, active) VALUES (1, 'pl', 'admin', 'admin@milejko.pl', 'd033e22ae348aeb5660fc2140aec35850c4da997', '127.0.0.1', '2012-02-23 15:41:12', '89.231.108.27', '2011-12-20 19:42:01', 8, 0, 0);
INSERT INTO cms_auth (id, lang, username, email, password, "lastIp", "lastLog", "lastFailIp", "lastFailLog", "failLogCount", logged, active) VALUES (2, 'pl', 'mariusz', 'mariusz@milejko.pl', '7a48d2fe2f6f86430acee5b86a093c3352b9f780', '127.0.0.1', '2012-03-20 15:54:01', '127.0.0.1', '2012-03-16 13:41:49', 9, 0, 1);

INSERT INTO cms_auth_role (id, cms_auth_id, cms_role_id) VALUES (1, 2, 3);
INSERT INTO cms_auth_role (id, cms_auth_id, cms_role_id) VALUES (2, 1, 3);

INSERT INTO cms_contact_option (id, name) VALUES (3, 'Propozycje zmian');
INSERT INTO cms_contact_option (id, name) VALUES (1, 'Inne');


INSERT INTO cms_role (id, name) VALUES (1, 'guest');
INSERT INTO cms_role (id, name) VALUES (2, 'member');
INSERT INTO cms_role (id, name) VALUES (3, 'admin');


INSERT INTO cron (id, active, minute, hour, "dayOfMonth", month, "dayOfWeek", name, description, module, controller, action, "dateAdd", "dateModified", "dateLastExecute") VALUES (1, 1, '*', '*', '*', '*', '*', 'Wysyłka maili', 'Wysyłanie kolejki mailowej', 'mail', 'cron', 'send', '2012-03-14 10:35:57', '2012-03-14 10:36:16', NULL);



INSERT INTO mail_server (id, address, port, username, password, "from", "dateAdd", "dateModify", active, ssl) VALUES (1, 'localhost', 25, 'local', '', '', '2012-03-14 14:31:43', '2012-03-14 14:47:01', 1, 'plain');


ALTER TABLE ONLY cms_acl
    ADD CONSTRAINT cms_acl_pkey PRIMARY KEY (id);


ALTER TABLE ONLY cms_article
    ADD CONSTRAINT cms_article_pkey PRIMARY KEY (id);


ALTER TABLE ONLY cms_auth
    ADD CONSTRAINT cms_auth_pkey PRIMARY KEY (id);

ALTER TABLE ONLY cms_auth_role
    ADD CONSTRAINT cms_auth_role_pkey PRIMARY KEY (id);

ALTER TABLE ONLY cms_comment
    ADD CONSTRAINT cms_comment_pkey PRIMARY KEY (id);


ALTER TABLE ONLY cms_contact_option
    ADD CONSTRAINT cms_contact_option_pkey PRIMARY KEY (id);


ALTER TABLE ONLY cms_contact
    ADD CONSTRAINT cms_contact_pkey PRIMARY KEY (id);


ALTER TABLE ONLY cms_file
    ADD CONSTRAINT cms_file_pkey PRIMARY KEY (id);


ALTER TABLE ONLY cms_log
    ADD CONSTRAINT cms_log_pkey PRIMARY KEY (id);


ALTER TABLE ONLY cms_navigation
    ADD CONSTRAINT cms_navigation_pkey PRIMARY KEY (id);


ALTER TABLE ONLY cms_role
    ADD CONSTRAINT cms_role_pkey PRIMARY KEY (id);



ALTER TABLE ONLY cron
    ADD CONSTRAINT cron_pkey PRIMARY KEY (id);



ALTER TABLE ONLY mail_definition
    ADD CONSTRAINT mail_definition_pkey PRIMARY KEY (id);



ALTER TABLE ONLY mail
    ADD CONSTRAINT mail_pkey PRIMARY KEY (id);



ALTER TABLE ONLY mail_server
    ADD CONSTRAINT mail_server_pkey PRIMARY KEY (id);



ALTER TABLE ONLY news
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);



ALTER TABLE ONLY payment_config
    ADD CONSTRAINT payment_config_pkey PRIMARY KEY (id);



ALTER TABLE ONLY payment
    ADD CONSTRAINT payment_pkey PRIMARY KEY (id);



ALTER TABLE ONLY stat_date
    ADD CONSTRAINT stat_date_pkey PRIMARY KEY (id);


ALTER TABLE ONLY stat_label
    ADD CONSTRAINT stat_label_pkey PRIMARY KEY (id);


ALTER TABLE ONLY stat
    ADD CONSTRAINT stat_pkey PRIMARY KEY (id);


CREATE INDEX cms_acl_access_idx ON cms_acl USING btree (access);



CREATE INDEX cms_acl_action_idx ON cms_acl USING btree (action);



CREATE INDEX cms_acl_controller_idx ON cms_acl USING btree (controller);


CREATE INDEX cms_acl_module_idx ON cms_acl USING btree (module);


CREATE INDEX "cms_article_dateAdd_idx" ON cms_article USING btree ("dateAdd");

CREATE INDEX "cms_article_dateModify_idx" ON cms_article USING btree ("dateModify");


CREATE INDEX cms_article_lang_idx ON cms_article USING btree (lang);

CREATE INDEX cms_article_title_idx ON cms_article USING btree (title);


CREATE INDEX cms_article_uri_idx ON cms_article USING btree (uri);


CREATE INDEX cms_auth_active_idx ON cms_auth USING btree (active);


CREATE INDEX cms_auth_email_idx ON cms_auth USING btree (email);

CREATE INDEX cms_auth_logged_idx ON cms_auth USING btree (logged);

CREATE INDEX cms_auth_username_idx ON cms_auth USING btree (username);

CREATE INDEX "cms_comment_dateAdd_idx" ON cms_comment USING btree ("dateAdd");

CREATE INDEX "cms_comment_object_objectId_idx" ON cms_comment USING btree (object, "objectId");

CREATE INDEX cms_comment_parent_id_idx ON cms_comment USING btree (parent_id);

CREATE INDEX cms_comment_stars_idx ON cms_comment USING btree (stars);

CREATE INDEX cms_contact_active_idx ON cms_contact USING btree (active);

CREATE INDEX "cms_contact_dateAdd_idx" ON cms_contact USING btree ("dateAdd");

CREATE INDEX cms_contact_email_idx ON cms_contact USING btree (email);

CREATE INDEX cms_contact_option_name_idx ON cms_contact_option USING btree (name);

CREATE INDEX cms_contact_uri_idx ON cms_contact USING btree (uri);

CREATE INDEX cms_file_active_idx ON cms_file USING btree (active);

CREATE INDEX cms_file_author_idx ON cms_file USING btree (author);

CREATE INDEX cms_file_class_idx ON cms_file USING btree (class);

CREATE INDEX "cms_file_dateAdd_idx" ON cms_file USING btree ("dateAdd");

CREATE INDEX "cms_file_dateModify_idx" ON cms_file USING btree ("dateModify");

CREATE INDEX cms_file_name_idx ON cms_file USING btree (name);

CREATE INDEX "cms_file_object_objectId_idx" ON cms_file USING btree (object, "objectId");

CREATE INDEX cms_file_order_idx ON cms_file USING btree ("order");

CREATE INDEX cms_file_sticky_idx ON cms_file USING btree (sticky);

CREATE INDEX cms_file_title_idx ON cms_file USING btree (title);

CREATE INDEX "cms_log_dateTime_idx" ON cms_log USING btree ("dateTime");

CREATE INDEX cms_log_ip_idx ON cms_log USING btree (ip);

CREATE INDEX "cms_log_objectId_idx" ON cms_log USING btree ("objectId");

CREATE INDEX cms_log_object_idx ON cms_log USING btree (object);

CREATE INDEX cms_log_operation_idx ON cms_log USING btree (operation);

CREATE INDEX cms_log_url_idx ON cms_log USING btree (url);

CREATE INDEX cms_navigation_order_idx ON cms_navigation USING btree ("order");

CREATE INDEX cms_navigation_parent_id_idx ON cms_navigation USING btree (parent_id);

CREATE INDEX cms_navigation_visible_idx ON cms_navigation USING btree (visible);

CREATE INDEX cms_role_name_idx ON cms_role USING btree (name);

CREATE INDEX cron_active_idx ON cron USING btree (active);

CREATE INDEX fki_cms_acl_cms_role_id_fkey ON cms_acl USING btree (cms_role_id);

CREATE INDEX fki_cms_auth_role_cms_auth_id ON cms_auth_role USING btree (cms_auth_id);

CREATE INDEX fki_cms_auth_role_cms_role_id ON cms_auth_role USING btree (cms_role_id);

CREATE INDEX fki_cms_comment_cms_auth_id_fkey ON cms_comment USING btree (cms_auth_id);

CREATE INDEX fki_cms_contact_cms_auth_id_fkey ON cms_contact USING btree (cms_auth_id);

CREATE INDEX fki_cms_contact_cms_auth_id_reply_fkey ON cms_contact USING btree (cms_auth_id_reply);

CREATE INDEX fki_cms_contact_cms_contact_option_id_fkey ON cms_contact USING btree (cms_contact_option_id);

CREATE INDEX fki_cms_file_cms_auth_id_fkey ON cms_file USING btree (cms_auth_id);

CREATE INDEX fki_cms_log_cms_auth_id_fkey ON cms_log USING btree (cms_auth_id);

CREATE INDEX fki_mail_definition_mail_server_id_fkey ON mail_definition USING btree (mail_server_id);

CREATE INDEX fki_mail_mail_definition_id_fkey ON mail USING btree (mail_definition_id);

CREATE INDEX fki_payment_cms_auth_id_fkey ON payment USING btree (cms_auth_id);

CREATE INDEX fki_payment_payment_config_id_fkey ON payment USING btree (payment_config_id);

CREATE INDEX mail_active_idx ON mail USING btree (active);

CREATE INDEX mail_definition_lang_name_idx ON mail_definition USING btree (lang, name);

CREATE INDEX mail_type_idx ON mail USING btree (type);

CREATE UNIQUE INDEX payment_config_name_idx ON payment_config USING btree (name);

CREATE INDEX "payment_dateAdd_idx" ON payment USING btree ("dateAdd");

CREATE INDEX "payment_dateEnd_idx" ON payment USING btree ("dateEnd");

CREATE INDEX payment_status_idx ON payment USING btree (status);

CREATE INDEX stat_date_hour_day_month_year_idx ON stat_date USING btree (hour, day, month, year);

CREATE INDEX "stat_date_object_objectId_idx" ON stat_date USING btree (object, "objectId");

CREATE UNIQUE INDEX stat_label_lang_object_idx ON stat_label USING btree (lang, object);

ALTER TABLE ONLY cms_acl
    ADD CONSTRAINT cms_acl_cms_role_id_fkey FOREIGN KEY (cms_role_id) REFERENCES cms_role(id);

ALTER TABLE ONLY cms_auth_role
    ADD CONSTRAINT cms_auth_role_cms_auth_id FOREIGN KEY (cms_auth_id) REFERENCES cms_auth(id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY cms_auth_role
    ADD CONSTRAINT cms_auth_role_cms_role_id FOREIGN KEY (cms_role_id) REFERENCES cms_role(id);

ALTER TABLE ONLY cms_comment
    ADD CONSTRAINT cms_comment_cms_auth_id_fkey FOREIGN KEY (cms_auth_id) REFERENCES cms_auth(id) ON UPDATE SET NULL ON DELETE SET NULL;

ALTER TABLE ONLY cms_contact
    ADD CONSTRAINT cms_contact_cms_auth_id_fkey FOREIGN KEY (cms_auth_id) REFERENCES cms_auth(id) ON UPDATE SET NULL ON DELETE SET NULL;

ALTER TABLE ONLY cms_contact
    ADD CONSTRAINT cms_contact_cms_auth_id_reply_fkey FOREIGN KEY (cms_auth_id_reply) REFERENCES cms_auth(id) ON UPDATE SET NULL ON DELETE SET NULL;

ALTER TABLE ONLY cms_contact
    ADD CONSTRAINT cms_contact_cms_contact_option_id_fkey FOREIGN KEY (cms_contact_option_id) REFERENCES cms_contact_option(id) ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE ONLY cms_file
    ADD CONSTRAINT cms_file_cms_auth_id_fkey FOREIGN KEY (cms_auth_id) REFERENCES cms_auth(id) ON UPDATE SET NULL ON DELETE SET NULL;

ALTER TABLE ONLY cms_log
    ADD CONSTRAINT cms_log_cms_auth_id_fkey FOREIGN KEY (cms_auth_id) REFERENCES cms_auth(id) ON UPDATE SET NULL ON DELETE SET NULL;

ALTER TABLE ONLY mail_definition
    ADD CONSTRAINT mail_definition_mail_server_id_fkey FOREIGN KEY (mail_server_id) REFERENCES mail_server(id) ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE ONLY mail
    ADD CONSTRAINT mail_mail_definition_id_fkey FOREIGN KEY (mail_definition_id) REFERENCES mail_definition(id);

ALTER TABLE ONLY payment
    ADD CONSTRAINT payment_cms_auth_id_fkey FOREIGN KEY (cms_auth_id) REFERENCES cms_auth(id);

ALTER TABLE ONLY payment
    ADD CONSTRAINT payment_payment_config_id_fkey FOREIGN KEY (payment_config_id) REFERENCES payment_config(id);

REVOKE ALL ON SEQUENCE cms_article_id_seq FROM PUBLIC;

ALTER TABLE cms_contact ADD COLUMN name character varying(64);
ALTER TABLE cms_contact ADD COLUMN phone character varying(16);
ALTER TABLE cms_contact_option ADD COLUMN "sendTo" character varying(64);

CREATE TABLE cms_route
(
   id serial NOT NULL,
   pattern character varying(255),
   replace text,
   "default" text,
   "order" integer NOT NULL DEFAULT 0,
   active smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
)
WITH (
  OIDS = FALSE
);

CREATE INDEX cms_route_active_idx
  ON cms_route
  USING btree
  (active );

CREATE INDEX cms_route_order_idx
  ON cms_route
  USING btree
  ("order" );

ALTER TABLE cms_navigation ADD COLUMN "dateStart" timestamp without time zone;
ALTER TABLE cms_navigation ADD COLUMN "dateEnd" timestamp without time zone;
ALTER TABLE cms_navigation ADD COLUMN active smallint NOT NULL DEFAULT 1;

CREATE INDEX cms_navigation_datestart_idx
  ON cms_navigation
  USING btree
  ("dateStart" );

CREATE INDEX cms_navigation_dateend_idx
  ON cms_navigation
  USING btree
  ("dateEnd" );

CREATE INDEX cms_navigation_active_idx
  ON cms_navigation
  USING btree
  ("active" );

DROP TABLE IF EXISTS cms_tag_link CASCADE;
DROP TABLE IF EXISTS cms_tag CASCADE;

CREATE TABLE cms_tag
(
  id serial NOT NULL,
  tag character varying(64) NOT NULL,
  CONSTRAINT cms_tag_pkey PRIMARY KEY (id )
)
WITH (
  OIDS=FALSE
);

CREATE INDEX cms_tag_tag_idx
  ON cms_tag
  USING btree
  ("tag");


CREATE TABLE cms_tag_link
(
  id serial NOT NULL,
  cms_tag_id integer NOT NULL,
  "object" character varying(32) NOT NULL,
  "objectId" integer NOT NULL,
  CONSTRAINT cms_tag_link_pkey PRIMARY KEY (id ),
  CONSTRAINT cms_tag_link_cms_tag_id_fkey FOREIGN KEY (cms_tag_id)
      REFERENCES cms_tag (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);

CREATE INDEX fki_cms_tag_link_cms_tag_id_fkey
  ON cms_tag_link
  USING btree
  (cms_tag_id );

CREATE INDEX cms_tag_link_object_objectId_idx
  ON cms_tag_link
  USING btree
  ("object", "objectId" );

ALTER TABLE cms_article ADD COLUMN noindex smallint NOT NULL DEFAULT 0;

-- Table: cms_container_template

-- DROP TABLE cms_container_template;

CREATE TABLE cms_container_template
(
  id serial NOT NULL,
  name character varying(32),
  path character varying(128),
  text text,
  CONSTRAINT cms_container_template_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);

-- Table: cms_container

-- DROP TABLE cms_container;

CREATE TABLE cms_container
(
  id serial NOT NULL,
  title character varying(160),
  serial text,
  uri character varying(160),
  cms_container_template_id integer,
  CONSTRAINT cms_container_pkey PRIMARY KEY (id),
  CONSTRAINT cms_container_cms_container_template FOREIGN KEY (cms_container_template_id)
      REFERENCES cms_container_template (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);

CREATE INDEX cms_container_uri_idx
  ON cms_container
  USING btree
  (uri COLLATE pg_catalog."default");


CREATE INDEX fki_cms_container_cms_container_template
  ON cms_container
  USING btree
  (cms_container_template_id);


CREATE TABLE cms_container_template_placeholder
(
  id serial NOT NULL,
  cms_container_template_id integer NOT NULL,
  placeholder character varying(32) NOT NULL,
  name text,
  CONSTRAINT cms_container_template_placeholder_pkey PRIMARY KEY (id),
  CONSTRAINT cms_container_template_placehold_cms_container_template_id_fkey FOREIGN KEY (cms_container_template_id)
      REFERENCES cms_container_template (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT cms_container_template_placeh_cms_container_template_id_pla_key UNIQUE (cms_container_template_id, placeholder)
)
WITH (
  OIDS=FALSE
);


CREATE INDEX cms_container_template_placeholde_cms_container_template_id_idx
  ON cms_container_template_placeholder
  USING btree
  (cms_container_template_id);


CREATE TABLE cms_container_template_placeholder_container
(
  id serial NOT NULL,
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
  CONSTRAINT cms_container_template_placeholder_container_pkey PRIMARY KEY (id),
  CONSTRAINT cms_container_template_placeh_cms_container_template_place_fkey FOREIGN KEY (cms_container_template_placeholder_id)
      REFERENCES cms_container_template_placeholder (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT cms_container_template_placeholder_contai_cms_container_id_fkey FOREIGN KEY (cms_container_id)
      REFERENCES cms_container (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);


CREATE INDEX cms_container_template_placeh_cms_container_template_placeh_idx
  ON cms_container_template_placeholder_container
  USING btree
  (cms_container_template_placeholder_id);


CREATE INDEX cms_container_template_placeholder_contain_cms_container_id_idx
  ON cms_container_template_placeholder_container
  USING btree
  (cms_container_id);

CREATE TABLE tutorial
(
  id serial NOT NULL,
  data character varying(128)
)
WITH (
  OIDS=FALSE
);