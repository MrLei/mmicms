CREATE TABLE "DB_CHANGELOG" (
  "filename" character varying(64) NOT NULL,
  "md5" character(32) NOT NULL,
  CONSTRAINT "DB_CHANGELOG_pkey" PRIMARY KEY ("filename")
);

/* NEXT STATEMENT */
CREATE TABLE "cms_acl" (
    "id" integer NOT NULL,
    "cms_role_id" integer NOT NULL,
    "module" character varying(32),
    "controller" character varying(32),
    "action" character varying(32),
    "access" character varying(8) DEFAULT 'deny',
    CONSTRAINT "cms_acl_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_acl_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_acl_id_trg"
    BEFORE INSERT ON "cms_acl"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_acl_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_article" (
    "id" integer NOT NULL,
    "lang" character varying(2),
    "title" character varying(160) NOT NULL,
    "uri" character varying(160) NOT NULL,
    "dateAdd" timestamp,
    "dateModify" timestamp,
    "text" clob,
    "noindex" smallint DEFAULT 0 NOT NULL,
    CONSTRAINT "cms_article_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_article_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_article_id_trg"
    BEFORE INSERT ON "cms_article"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_article_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_auth" (
    "id" integer NOT NULL,
    "lang" character varying(2),
    "username" character varying(128) NOT NULL,
    "email" character varying(128) NOT NULL,
    "password" character varying(128),
    "lastIp" character varying(16),
    "lastLog" timestamp,
    "lastFailIp" character varying(16),
    "lastFailLog" timestamp,
    "failLogCount" integer DEFAULT 0,
    "logged" smallint DEFAULT 0,
    "active" smallint DEFAULT 0 NOT NULL,
    CONSTRAINT "cms_auth_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_auth_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_auth_id_trg"
    BEFORE INSERT ON "cms_auth"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_auth_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_auth_role" (
    "id" integer NOT NULL,
    "cms_auth_id" integer NOT NULL,
    "cms_role_id" integer NOT NULL,
    CONSTRAINT "cms_auth_role_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_auth_role_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_auth_role_id_trg"
    BEFORE INSERT ON "cms_auth_role"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_auth_role_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_comment" (
    "id" integer NOT NULL,
    "cms_auth_id" integer,
    "parent_id" integer DEFAULT 0,
    "dateAdd" timestamp NOT NULL,
    "title" character varying(128),
    "text" clob NOT NULL,
    "signature" character varying(64),
    "ip" character varying(16),
    "stars" real DEFAULT 0,
    "object" character varying(32) NOT NULL,
    "objectId" integer NOT NULL,
    CONSTRAINT "cms_comment_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_comment_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_comment_id_trg"
    BEFORE INSERT ON "cms_comment"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_comment_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_contact" (
    "id" integer NOT NULL,
    "cms_contact_option_id" integer NOT NULL,
    "dateAdd" timestamp,
    "text" clob,
    "reply" clob,
    "cms_auth_id_reply" integer,
    "uri" character varying(255),
    "name" character varying(64),
    "phone" character varying(16),
    "email" character varying(128) NOT NULL,
    "ip" character varying(16),
    "cms_auth_id" integer,
    "active" smallint DEFAULT 0 NOT NULL,
    CONSTRAINT "cms_contact_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_contact_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_contact_id_trg"
    BEFORE INSERT ON "cms_contact"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_contact_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_contact_option" (
    "id" integer NOT NULL,
    "name" character varying(64) NOT NULL,
    "sendTo" character varying(64),
    CONSTRAINT "cms_contact_option_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_contact_option_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_contact_option_id_trg"
    BEFORE INSERT ON "cms_contact_option"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_contact_option_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_file" (
    "id" integer NOT NULL,
    "class" character varying(32),
    "mimeType" character varying(32),
    "name" character varying(45),
    "original" character varying(255),
    "title" character varying(255),
    "author" character varying(255),
    "source" character varying(255),
    "size" long,
    "dateAdd" timestamp,
    "dateModify" timestamp,
    "order" integer,
    "sticky" smallint,
    "object" character varying(32),
    "objectId" integer,
    "cms_auth_id" integer,
    "active" smallint,
    CONSTRAINT "cms_file_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_file_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_file_id_trg"
    BEFORE INSERT ON "cms_file"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_file_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_log" (
    "id" integer NOT NULL,
    "url" character varying(255),
    "ip" character varying(16),
    "browser" character varying(255),
    "operation" character varying(32),
    "object" character varying(32),
    "objectId" integer,
    "data" clob,
    "success" smallint DEFAULT 0 NOT NULL,
    "cms_auth_id" integer,
    "dateTime" timestamp,
    CONSTRAINT "cms_log_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_log_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_log_id_trg"
    BEFORE INSERT ON "cms_log"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_log_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_navigation" (
    "id" integer NOT NULL,
    "lang" character varying(2),
    "parent_id" integer DEFAULT 0 NOT NULL,
    "order" integer DEFAULT 0 NOT NULL,
    "module" character varying(64),
    "controller" character varying(64),
    "action" character varying(64),
    "params" clob,
    "label" character varying(64),
    "title" character varying(64),
    "keywords" clob,
    "description" clob,
    "uri" clob,
    "visible" smallint DEFAULT 0 NOT NULL,
    "https" smallint DEFAULT NULL,
    "absolute" smallint DEFAULT 0 NOT NULL,
    "independent" smallint DEFAULT 0 NOT NULL,
    "nofollow" smallint DEFAULT 0 NOT NULL,
    "blank" smallint DEFAULT 0 NOT NULL,
    "dateStart" timestamp,
    "dateEnd" timestamp,
    "active" smallint DEFAULT 1 NOT NULL,
    CONSTRAINT "cms_navigation_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_navigation_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_navigation_id_trg"
    BEFORE INSERT ON "cms_navigation"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_navigation_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_page" (
  "id" integer NOT NULL,
  "name" character varying(32),
  "cms_navigation_id" integer NOT NULL,
  "cms_route_id" integer NOT NULL,
  "text" clob,
  "active" smallint DEFAULT 0 NOT NULL,
  "cms_auth_id" integer DEFAULT NULL,
  "dateAdd" timestamp,
  "dateModify" timestamp,
  CONSTRAINT "cms_page_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_page_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_page_id_trg"
    BEFORE INSERT ON "cms_page"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_page_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_page_widget" (
  "id" integer NOT NULL,
  "name" character varying(32),
  "module" character varying(64),
  "controller" character varying(64),
  "action" character varying(64),
  "params" clob,
  "active" smallint DEFAULT 0 NOT NULL,
  CONSTRAINT "cms_page_widget_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_page_widget_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_page_widget_id_trg"
    BEFORE INSERT ON "cms_page_widget"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_page_widget_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_role" (
    "id" integer NOT NULL,
    "name" character varying(32) NOT NULL,
    CONSTRAINT "cms_role_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_role_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_role_id_trg"
    BEFORE INSERT ON "cms_role"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_role_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_route" (
   "id" integer NOT NULL,
   "pattern" character varying(255),
   "replace" clob,
   "default" clob,
   "order" integer DEFAULT 0 NOT NULL,
   "active" smallint DEFAULT 0 NOT NULL,
   CONSTRAINT "cms_route_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_route_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_route_id_trg"
    BEFORE INSERT ON "cms_route"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_route_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_tag" (
  "id" integer NOT NULL,
  "tag" character varying(64) NOT NULL,
  CONSTRAINT "cms_tag_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_tag_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_tag_id_trg"
    BEFORE INSERT ON "cms_tag"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_tag_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_tag_link" (
  "id" integer NOT NULL,
  "cms_tag_id" integer NOT NULL,
  "object" character varying(32) NOT NULL,
  "objectId" integer NOT NULL,
  CONSTRAINT "cms_tag_link_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_tag_link_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_tag_link_id_trg"
    BEFORE INSERT ON "cms_tag_link"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_tag_link_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_text" (
  "id" integer NOT NULL,
  "lang" character varying(2),
  "key" character varying(32),
  "content" clob,
  "dateModify" timestamp,
  CONSTRAINT "cms_text_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_text_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_text_id_trg"
    BEFORE INSERT ON "cms_text"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_text_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "cms_cron" (
    "id" integer NOT NULL,
    "active" smallint DEFAULT 0 NOT NULL,
    "minute" character varying(50) NOT NULL,
    "hour" character varying(50) NOT NULL,
    "dayOfMonth" character varying(50) NOT NULL,
    "month" character varying(50) NOT NULL,
    "dayOfWeek" character varying(50) NOT NULL,
    "name" character varying(50) NOT NULL,
    "description" clob,
    "module" character varying(32) NOT NULL,
    "controller" character varying(32) NOT NULL,
    "action" character varying(32) NOT NULL,
    "dateAdd" timestamp,
    "dateModified" timestamp,
    "dateLastExecute" timestamp,
    CONSTRAINT "cms_cron_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_cron_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_cron_id_trg"
    BEFORE INSERT ON "cms_cron"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_cron_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "mail" (
    "id" integer NOT NULL,
    "mail_definition_id" integer NOT NULL,
    "fromName" character varying(64),
    "to" character varying(64),
    "replyTo" character varying(64),
    "subject" character varying(200),
    "message" clob,
    "attachements" clob,
    "type" smallint DEFAULT 1 NOT NULL,
    "dateAdd" timestamp,
    "dateSent" timestamp,
    "dateSendAfter" timestamp,
    "active" smallint DEFAULT 0 NOT NULL,
    CONSTRAINT "mail_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "mail_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "mail_id_trg"
    BEFORE INSERT ON "mail"
    FOR EACH ROW

    BEGIN
        SELECT  "mail_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "mail_definition" (
    "id" integer NOT NULL,
    "lang" character varying(2) DEFAULT 'pl',
    "mail_server_id" integer NOT NULL,
    "name" character varying(32),
    "replyTo" character varying(64),
    "fromName" character varying(64),
    "subject" character varying(200),
    "message" clob,
    "html" smallint DEFAULT 0 NOT NULL,
    "dateAdd" timestamp,
    "dateModify" timestamp,
    "active" smallint DEFAULT 0 NOT NULL,
    CONSTRAINT "mail_definition_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "mail_definition_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "mail_definition_id_trg"
    BEFORE INSERT ON "mail_definition"
    FOR EACH ROW

    BEGIN
        SELECT  "mail_definition_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "mail_server" (
    "id" integer NOT NULL,
    "address" character varying(64) NOT NULL,
    "port" smallint DEFAULT 25 NOT NULL,
    "username" character varying(64),
    "password" character varying(64),
    "from" character varying(200),
    "dateAdd" timestamp,
    "dateModify" timestamp,
    "active" smallint DEFAULT 1 NOT NULL,
    "ssl" character varying(16) DEFAULT 'tls',
    CONSTRAINT "mail_server_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "mail_server_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "mail_server_id_trg"
    BEFORE INSERT ON "mail_server"
    FOR EACH ROW

    BEGIN
        SELECT  "mail_server_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "news" (
    "id" integer NOT NULL,
    "lang" character varying(2),
    "title" character varying(255) NOT NULL,
    "lead" clob,
    "text" clob,
    "dateAdd" timestamp,
    "dateModify" timestamp,
    "uri" character varying(255),
    "internal" smallint DEFAULT 1 NOT NULL,
    "visible" smallint DEFAULT 1 NOT NULL,
    CONSTRAINT "news_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "news_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "news_id_trg"
    BEFORE INSERT ON "news"
    FOR EACH ROW

    BEGIN
        SELECT  "news_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "stat" (
    "id" integer NOT NULL,
    "object" character varying(50) NOT NULL,
    "objectId" integer,
    "dateTime" timestamp NOT NULL,
    CONSTRAINT "stat_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "stat_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "stat_id_trg"
    BEFORE INSERT ON "stat"
    FOR EACH ROW

    BEGIN
        SELECT  "stat_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "stat_date" (
    "id" integer NOT NULL,
    "hour" smallint,
    "day" smallint,
    "month" smallint,
    "year" smallint,
    "object" character varying(32),
    "objectId" integer,
    "count" integer DEFAULT 0 NOT NULL,
    CONSTRAINT "stat_date_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "stat_date_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "stat_date_id_trg"
    BEFORE INSERT ON "stat_date"
    FOR EACH ROW

    BEGIN
        SELECT  "stat_date_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
CREATE TABLE "stat_label" (
    "id" integer NOT NULL,
    "lang" character varying(2),
    "object" character varying(32) NOT NULL,
    "label" character varying(48) NOT NULL,
    "description" clob,
    CONSTRAINT "stat_label_pkey" PRIMARY KEY ("id")
);

/* NEXT STATEMENT */
CREATE SEQUENCE "stat_label_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "stat_label_id_trg"
    BEFORE INSERT ON "stat_label"
    FOR EACH ROW

    BEGIN
        SELECT  "stat_label_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/

/* NEXT STATEMENT */
INSERT INTO "cms_acl" ("id", "cms_role_id", "module", "controller", "action", "access") 
    VALUES (1, 3, NULL, NULL, NULL, 'allow');/* NEXT STATEMENT */
INSERT INTO "cms_acl" ("id", "cms_role_id", "module", "controller", "action", "access") 
    VALUES (2, 1, 'default', NULL, NULL, 'allow');/* NEXT STATEMENT */
INSERT INTO "cms_acl" ("id", "cms_role_id", "module", "controller", "action", "access")
    VALUES (3, 1, 'admin', 'login', NULL, 'allow');/* NEXT STATEMENT */
INSERT INTO "cms_acl" ("id", "cms_role_id", "module", "controller", "action", "access")
    VALUES (4, 1, 'cms', NULL, NULL, 'allow');/* NEXT STATEMENT */
INSERT INTO "cms_acl" ("id", "cms_role_id", "module", "controller", "action", "access") 
    VALUES (5, 1, 'news', 'index', NULL, 'allow');/* NEXT STATEMENT */
INSERT INTO "cms_acl" ("id", "cms_role_id", "module", "controller", "action", "access") 
    VALUES (6, 1, 'user', 'login', NULL, 'allow');/* NEXT STATEMENT */
INSERT INTO "cms_acl" ("id", "cms_role_id", "module", "controller", "action", "access") 
    VALUES (7, 1, 'user', 'registration', NULL, 'allow');/* NEXT STATEMENT */

INSERT INTO "cms_auth" ("id", "lang", "username", "email", "password", "lastIp", "lastLog", "lastFailIp", "lastFailLog", "failLogCount", "logged", "active") 
    VALUES (1, 'pl', 'admin', 'admin@milejko.pl', 'd033e22ae348aeb5660fc2140aec35850c4da997', '127.0.0.1', '2012-02-23 15:41:12', '89.231.108.27', '2011-12-20 19:42:01', 8, 0, 0);/* NEXT STATEMENT */
INSERT INTO "cms_auth" ("id", "lang", "username", "email", "password", "lastIp", "lastLog", "lastFailIp", "lastFailLog", "failLogCount", "logged", "active") 
    VALUES (2, 'pl', 'mariusz', 'mariusz@milejko.pl', '7a48d2fe2f6f86430acee5b86a093c3352b9f780', '127.0.0.1', '2012-03-20 15:54:01', '127.0.0.1', '2012-03-16 13:41:49', 9, 0, 1);/* NEXT STATEMENT */

INSERT INTO "cms_auth_role" ("id", "cms_auth_id", "cms_role_id") 
    VALUES (1, 2, 3);/* NEXT STATEMENT */
INSERT INTO "cms_auth_role" ("id", "cms_auth_id", "cms_role_id") 
    VALUES (2, 1, 3);/* NEXT STATEMENT */

INSERT INTO "cms_contact_option" ("id", "name")
    VALUES (3, 'Propozycje zmian');/* NEXT STATEMENT */
INSERT INTO "cms_contact_option" ("id", "name") 
    VALUES (1, 'Inne');/* NEXT STATEMENT */

INSERT INTO "cms_role" ("id", "name") 
    VALUES (1, 'guest');/* NEXT STATEMENT */
INSERT INTO "cms_role" ("id", "name") 
    VALUES (2, 'member');/* NEXT STATEMENT */
INSERT INTO "cms_role" ("id", "name") 
    VALUES (3, 'admin');/* NEXT STATEMENT */

INSERT INTO "cms_cron" ("id", "active", "minute", "hour", "dayOfMonth", "month", "dayOfWeek", "name", "description", "module", "controller", "action", "dateAdd", "dateModified", "dateLastExecute") 
    VALUES (1, 1, '*', '*', '*', '*', '*', 'Wysyłka maili', 'Wysyłanie kolejki mailowej', 'mail', 'cron', 'send', '2012-03-14 10:35:57', '2012-03-14 10:36:16', NULL);
/* NEXT STATEMENT */
INSERT INTO "mail_server" ("id", "address", "port", "username", "password", "from", "dateAdd", "dateModify", "active", "ssl") 
    VALUES (1, 'localhost', 25, 'local', '', '', '2012-03-14 14:31:43', '2012-03-14 14:47:01', 1, 'plain');
/* NEXT STATEMENT */
ALTER TABLE "cms_acl"
    ADD CONSTRAINT "cms_acl_cms_role_id_fkey" FOREIGN KEY ("cms_role_id") 
        REFERENCES "cms_role"("id");
/* NEXT STATEMENT */
ALTER TABLE "cms_auth_role"
    ADD CONSTRAINT "cms_auth_role_cms_auth_id" FOREIGN KEY ("cms_auth_id") 
        REFERENCES "cms_auth"("id") 
        ON DELETE CASCADE;
/* NEXT STATEMENT */
ALTER TABLE "cms_auth_role"
    ADD CONSTRAINT "cms_auth_role_cms_role_id" FOREIGN KEY ("cms_role_id") 
        REFERENCES "cms_role"("id");
/* NEXT STATEMENT */
ALTER TABLE "cms_comment"
    ADD CONSTRAINT "cms_comment_cms_auth_id_fkey" FOREIGN KEY ("cms_auth_id") 
        REFERENCES "cms_auth"("id") 
        ON DELETE SET NULL;
/* NEXT STATEMENT */
ALTER TABLE "cms_contact"
    ADD CONSTRAINT "cms_contact_cms_auth_id_fkey" FOREIGN KEY ("cms_auth_id") 
        REFERENCES "cms_auth"("id") 
        ON DELETE SET NULL;
/* NEXT STATEMENT */
ALTER TABLE "cms_contact"
    ADD CONSTRAINT "cms_cnt_cms_auth_id_reply_fkey" FOREIGN KEY ("cms_auth_id_reply") 
        REFERENCES "cms_auth"("id") 
        ON DELETE SET NULL;
/* NEXT STATEMENT */
ALTER TABLE "cms_contact"
    ADD CONSTRAINT "cms_cnt_cms_cnt_option_id_fkey" FOREIGN KEY ("cms_contact_option_id") 
        REFERENCES "cms_contact_option"("id");
/* NEXT STATEMENT */
ALTER TABLE "cms_file"
    ADD CONSTRAINT "cms_file_cms_auth_id_fkey" FOREIGN KEY ("cms_auth_id") 
        REFERENCES "cms_auth"("id") 
        ON DELETE SET NULL;
/* NEXT STATEMENT */
ALTER TABLE "cms_log"
    ADD CONSTRAINT "cms_log_cms_auth_id_fkey" FOREIGN KEY ("cms_auth_id") 
        REFERENCES "cms_auth"("id") 
        ON DELETE SET NULL;
/* NEXT STATEMENT */
ALTER TABLE "cms_page"
	ADD CONSTRAINT "cms_navigation_id" FOREIGN KEY ("cms_navigation_id")
      REFERENCES "cms_navigation"("id")
      ON DELETE CASCADE;
/* NEXT STATEMENT */
ALTER TABLE "cms_page"
	ADD CONSTRAINT "cms_route_id" FOREIGN KEY ("cms_route_id")
      REFERENCES "cms_route" ("id")
      ON DELETE CASCADE;
/* NEXT STATEMENT */
ALTER TABLE "cms_page"
	ADD CONSTRAINT "cms_auth_id" FOREIGN KEY ("cms_auth_id")
      REFERENCES "cms_auth" ("id")
      ON DELETE SET NULL;
/* NEXT STATEMENT */
ALTER TABLE "cms_tag_link"
    ADD CONSTRAINT "cms_tag_link_cms_tag_id_fkey" FOREIGN KEY ("cms_tag_id") 
        REFERENCES "cms_tag"("id") 
        ON DELETE CASCADE;
/* NEXT STATEMENT */
ALTER TABLE "mail_definition"
    ADD CONSTRAINT "mail_def_mail_server_id_fkey" FOREIGN KEY ("mail_server_id") 
        REFERENCES "mail_server"("id");
/* NEXT STATEMENT */
ALTER TABLE "mail"
    ADD CONSTRAINT "mail_mail_definition_id_fkey" FOREIGN KEY ("mail_definition_id") 
        REFERENCES "mail_definition"("id");
/* NEXT STATEMENT */
CREATE INDEX "cms_acl_access_idx" ON "cms_acl"("access");/* NEXT STATEMENT */
CREATE INDEX "cms_acl_action_idx" ON "cms_acl"("action");/* NEXT STATEMENT */
CREATE INDEX "cms_acl_controller_idx" ON "cms_acl"("controller");/* NEXT STATEMENT */
CREATE INDEX "cms_acl_module_idx" ON "cms_acl"("module");/* NEXT STATEMENT */
CREATE INDEX "cms_article_dateAdd_idx" ON "cms_article"("dateAdd");/* NEXT STATEMENT */
CREATE INDEX "cms_article_dateModify_idx" ON "cms_article"("dateModify");/* NEXT STATEMENT */
CREATE INDEX "cms_article_lang_idx" ON "cms_article"("lang");/* NEXT STATEMENT */
CREATE INDEX "cms_article_title_idx" ON "cms_article"("title");/* NEXT STATEMENT */
CREATE INDEX "cms_article_uri_idx" ON "cms_article"("uri");/* NEXT STATEMENT */
CREATE INDEX "cms_auth_active_idx" ON "cms_auth"("active");/* NEXT STATEMENT */
CREATE INDEX "cms_auth_email_idx" ON "cms_auth"("email");/* NEXT STATEMENT */
CREATE INDEX "cms_auth_logged_idx" ON "cms_auth"("logged");/* NEXT STATEMENT */
CREATE INDEX "cms_auth_username_idx" ON "cms_auth"("username");/* NEXT STATEMENT */
CREATE INDEX "cms_comment_dateAdd_idx" ON "cms_comment"("dateAdd");/* NEXT STATEMENT */
CREATE INDEX "cms_coment_object_objectId_idx" ON "cms_comment"("object", "objectId");/* NEXT STATEMENT */
CREATE INDEX "cms_comment_parent_id_idx" ON "cms_comment"("parent_id");/* NEXT STATEMENT */
CREATE INDEX "cms_comment_stars_idx" ON "cms_comment"("stars");/* NEXT STATEMENT */
CREATE INDEX "cms_contact_active_idx" ON "cms_contact"("active");/* NEXT STATEMENT */
CREATE INDEX "cms_contact_dateAdd_idx" ON "cms_contact"("dateAdd");/* NEXT STATEMENT */
CREATE INDEX "cms_contact_email_idx" ON "cms_contact"("email");/* NEXT STATEMENT */
CREATE INDEX "cms_contact_option_name_idx" ON "cms_contact_option"("name");/* NEXT STATEMENT */
CREATE INDEX "cms_contact_uri_idx" ON "cms_contact"("uri");/* NEXT STATEMENT */
CREATE INDEX "cms_file_active_idx" ON "cms_file"("active");/* NEXT STATEMENT */
CREATE INDEX "cms_file_author_idx" ON "cms_file"("author");/* NEXT STATEMENT */
CREATE INDEX "cms_file_class_idx" ON "cms_file"("class");/* NEXT STATEMENT */
CREATE INDEX "cms_file_dateAdd_idx" ON "cms_file"("dateAdd");/* NEXT STATEMENT */
CREATE INDEX "cms_file_dateModify_idx" ON "cms_file"("dateModify");/* NEXT STATEMENT */
CREATE INDEX "cms_file_name_idx" ON "cms_file"("name");/* NEXT STATEMENT */
CREATE INDEX "cms_file_object_objectId_idx" ON "cms_file"("object", "objectId");/* NEXT STATEMENT */
CREATE INDEX "cms_file_order_idx" ON "cms_file"("order");/* NEXT STATEMENT */
CREATE INDEX "cms_file_sticky_idx" ON "cms_file"("sticky");/* NEXT STATEMENT */
CREATE INDEX "cms_file_title_idx" ON "cms_file"("title");/* NEXT STATEMENT */
CREATE INDEX "cms_log_dateTime_idx" ON "cms_log"("dateTime");/* NEXT STATEMENT */
CREATE INDEX "cms_log_ip_idx" ON "cms_log"("ip");/* NEXT STATEMENT */
CREATE INDEX "cms_log_objectId_idx" ON "cms_log"("objectId");/* NEXT STATEMENT */
CREATE INDEX "cms_log_object_idx" ON "cms_log"("object");/* NEXT STATEMENT */
CREATE INDEX "cms_log_operation_idx" ON "cms_log"("operation");/* NEXT STATEMENT */
CREATE INDEX "cms_log_url_idx" ON "cms_log"("url");/* NEXT STATEMENT */
CREATE INDEX "cms_navigation_order_idx" ON "cms_navigation"("order");/* NEXT STATEMENT */
CREATE INDEX "cms_navigation_parent_id_idx" ON "cms_navigation"("parent_id");/* NEXT STATEMENT */
CREATE INDEX "cms_navigation_visible_idx" ON "cms_navigation"("visible");/* NEXT STATEMENT */
CREATE INDEX "cms_navigation_datestart_idx" ON "cms_navigation"("dateStart");/* NEXT STATEMENT */
CREATE INDEX "cms_navigation_dateend_idx" ON "cms_navigation"("dateEnd");/* NEXT STATEMENT */
CREATE INDEX "cms_navigation_active_idx" ON "cms_navigation"("active");/* NEXT STATEMENT */
CREATE INDEX "cms_role_name_idx" ON "cms_role"("name");/* NEXT STATEMENT */
CREATE INDEX "cms_route_active_idx" ON "cms_route"("active");/* NEXT STATEMENT */
CREATE INDEX "cms_route_order_idx" ON "cms_route"("order");/* NEXT STATEMENT */
CREATE INDEX "cms_tag_tag_idx" ON "cms_tag"("tag");/* NEXT STATEMENT */
CREATE INDEX "cms_tag_link_obj_objectId_idx" ON "cms_tag_link"("object", "objectId");/* NEXT STATEMENT */
CREATE INDEX "cms_text_dateModify_idx" ON "cms_text"("dateModify");/* NEXT STATEMENT */
CREATE UNIQUE INDEX "cms_text_lang_key_idx" ON "cms_text"("lang", "key");/* NEXT STATEMENT */
CREATE INDEX "cms_cron_active_idx" ON "cms_cron"("active");/* NEXT STATEMENT */
CREATE INDEX "news_uri_idx" ON "news"("uri");/* NEXT STATEMENT */

CREATE INDEX "fki_cms_acl_cms_role_id_fkey" ON "cms_acl"("cms_role_id");/* NEXT STATEMENT */
CREATE INDEX "fki_cms_auth_role_cms_auth_id" ON "cms_auth_role"("cms_auth_id");/* NEXT STATEMENT */
CREATE INDEX "fki_cms_auth_role_cms_role_id" ON "cms_auth_role"("cms_role_id");/* NEXT STATEMENT */
CREATE INDEX "fki_cms_cmnt_cms_auth_id_fkey" ON "cms_comment"("cms_auth_id");/* NEXT STATEMENT */
CREATE INDEX "fki_cms_cnt_cms_auth_id_fkey" ON "cms_contact"("cms_auth_id");/* NEXT STATEMENT */
CREATE INDEX "fki_cm_cnt_cm_ath_id_rep_fkey" ON "cms_contact"("cms_auth_id_reply");/* NEXT STATEMENT */
CREATE INDEX "fki_cm_cnt_cm_cnt_opt_id_fkey" ON "cms_contact"("cms_contact_option_id");/* NEXT STATEMENT */
CREATE INDEX "fki_cms_file_cms_auth_id_fkey" ON "cms_file"("cms_auth_id");/* NEXT STATEMENT */
CREATE INDEX "fki_cms_log_cms_auth_id_fkey" ON "cms_log"("cms_auth_id");/* NEXT STATEMENT */
CREATE INDEX "fki_cms_navigation_id_fkey" ON "cms_page"("cms_navigation_id");/* NEXT STATEMENT */
CREATE INDEX "fki_cms_route_id_fkey" ON "cms_page"("cms_route_id");/* NEXT STATEMENT */
CREATE INDEX "fki_cms_auth_id_fkey" ON "cms_page"("cms_auth_id");/* NEXT STATEMENT */
CREATE INDEX "fki_cm_tag_lnk_cms_tag_id_fkey" ON "cms_tag_link"("cms_tag_id");/* NEXT STATEMENT */
CREATE INDEX "fki_mail_def_mail_srv_id_fkey" ON "mail_definition"("mail_server_id");/* NEXT STATEMENT */
CREATE INDEX "fki_mail_mail_def_id_fkey" ON "mail"("mail_definition_id");/* NEXT STATEMENT */
CREATE INDEX "mail_active_idx" ON "mail"("active");/* NEXT STATEMENT */
CREATE INDEX "mail_definition_lang_name_idx" ON "mail_definition"("lang", "name");/* NEXT STATEMENT */
CREATE INDEX "mail_type_idx" ON "mail"("type");/* NEXT STATEMENT */
CREATE INDEX "stat_date_h_d_m_y_idx" ON "stat_date"("hour", "day", "month", "year");/* NEXT STATEMENT */
CREATE INDEX "stat_date_object_objectId_idx" ON "stat_date"("object", "objectId");/* NEXT STATEMENT */
CREATE UNIQUE INDEX "stat_label_lang_object_idx" ON "stat_label"("lang", "object");/* NEXT STATEMENT */