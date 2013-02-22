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

ALTER TABLE cms_acl OWNER TO mmi;

CREATE SEQUENCE cms_acl_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE cms_acl_id_seq OWNER TO mmi;

ALTER SEQUENCE cms_acl_id_seq OWNED BY cms_acl.id;

SELECT pg_catalog.setval('cms_acl_id_seq', 10, true);

CREATE TABLE cms_article (
    id integer NOT NULL,
    lang character varying(2) NOT NULL,
    title character varying(160) NOT NULL,
    uri character varying(160) NOT NULL,
    "dateAdd" timestamp without time zone,
    "dateModify" timestamp without time zone,
    text text
);

ALTER TABLE cms_article OWNER TO mmi;

CREATE SEQUENCE cms_article_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE cms_article_id_seq OWNER TO mmi;

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


ALTER TABLE cms_auth OWNER TO mmi;

CREATE SEQUENCE cms_auth_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cms_auth_id_seq OWNER TO mmi;

ALTER SEQUENCE cms_auth_id_seq OWNED BY cms_auth.id;

SELECT pg_catalog.setval('cms_auth_id_seq', 11, true);

CREATE TABLE cms_auth_role (
    id integer NOT NULL,
    cms_auth_id integer NOT NULL,
    cms_role_id integer NOT NULL
);


ALTER TABLE cms_auth_role OWNER TO mmi;

CREATE SEQUENCE cms_auth_role_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cms_auth_role_id_seq OWNER TO mmi;

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

ALTER TABLE cms_comment OWNER TO mmi;

CREATE SEQUENCE cms_comment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE cms_comment_id_seq OWNER TO mmi;

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


ALTER TABLE cms_contact OWNER TO mmi;

CREATE SEQUENCE cms_contact_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cms_contact_id_seq OWNER TO mmi;

--
-- TOC entry 2324 (class 0 OID 0)
-- Dependencies: 182
-- Name: cms_contact_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE cms_contact_id_seq OWNED BY cms_contact.id;


--
-- TOC entry 2325 (class 0 OID 0)
-- Dependencies: 182
-- Name: cms_contact_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

SELECT pg_catalog.setval('cms_contact_id_seq', 4, true);


--
-- TOC entry 181 (class 1259 OID 16561)
-- Dependencies: 7
-- Name: cms_contact_option; Type: TABLE; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE TABLE cms_contact_option (
    id integer NOT NULL,
    name character varying(64) NOT NULL
);

ALTER TABLE cms_contact_option OWNER TO mmi;

--
-- TOC entry 180 (class 1259 OID 16559)
-- Dependencies: 7 181
-- Name: cms_contact_option_id_seq; Type: SEQUENCE; Schema: mmi; Owner: mmi
--

CREATE SEQUENCE cms_contact_option_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cms_contact_option_id_seq OWNER TO mmi;

--
-- TOC entry 2326 (class 0 OID 0)
-- Dependencies: 180
-- Name: cms_contact_option_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE cms_contact_option_id_seq OWNED BY cms_contact_option.id;


--
-- TOC entry 2327 (class 0 OID 0)
-- Dependencies: 180
-- Name: cms_contact_option_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

SELECT pg_catalog.setval('cms_contact_option_id_seq', 4, true);


--
-- TOC entry 185 (class 1259 OID 16599)
-- Dependencies: 7
-- Name: cms_file; Type: TABLE; Schema: mmi; Owner: mmi; Tablespace: 
--

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


ALTER TABLE cms_file OWNER TO mmi;

--
-- TOC entry 184 (class 1259 OID 16597)
-- Dependencies: 185 7
-- Name: cms_file_id_seq; Type: SEQUENCE; Schema: mmi; Owner: mmi
--

CREATE SEQUENCE cms_file_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cms_file_id_seq OWNER TO mmi;

--
-- TOC entry 2328 (class 0 OID 0)
-- Dependencies: 184
-- Name: cms_file_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE cms_file_id_seq OWNED BY cms_file.id;


--
-- TOC entry 2329 (class 0 OID 0)
-- Dependencies: 184
-- Name: cms_file_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

SELECT pg_catalog.setval('cms_file_id_seq', 3, true);


--
-- TOC entry 176 (class 1259 OID 16491)
-- Dependencies: 2095 7
-- Name: cms_log; Type: TABLE; Schema: mmi; Owner: mmi; Tablespace: 
--

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


ALTER TABLE cms_log OWNER TO mmi;

--
-- TOC entry 175 (class 1259 OID 16489)
-- Dependencies: 176 7
-- Name: cms_log_id_seq; Type: SEQUENCE; Schema: mmi; Owner: mmi
--

CREATE SEQUENCE cms_log_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cms_log_id_seq OWNER TO mmi;

--
-- TOC entry 2330 (class 0 OID 0)
-- Dependencies: 175
-- Name: cms_log_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE cms_log_id_seq OWNED BY cms_log.id;


--
-- TOC entry 2331 (class 0 OID 0)
-- Dependencies: 175
-- Name: cms_log_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

SELECT pg_catalog.setval('cms_log_id_seq', 17, true);


--
-- TOC entry 170 (class 1259 OID 16435)
-- Dependencies: 2089 2090 2091 7
-- Name: cms_navigation; Type: TABLE; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE TABLE cms_navigation (
    id integer NOT NULL,
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
    visible smallint DEFAULT 0 NOT NULL
);


ALTER TABLE cms_navigation OWNER TO mmi;

--
-- TOC entry 169 (class 1259 OID 16433)
-- Dependencies: 7 170
-- Name: cms_navigation_id_seq; Type: SEQUENCE; Schema: mmi; Owner: mmi
--

CREATE SEQUENCE cms_navigation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cms_navigation_id_seq OWNER TO mmi;

--
-- TOC entry 2332 (class 0 OID 0)
-- Dependencies: 169
-- Name: cms_navigation_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE cms_navigation_id_seq OWNED BY cms_navigation.id;


--
-- TOC entry 2333 (class 0 OID 0)
-- Dependencies: 169
-- Name: cms_navigation_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

SELECT pg_catalog.setval('cms_navigation_id_seq', 200, true);

--
-- TOC entry 165 (class 1259 OID 16403)
-- Dependencies: 7
-- Name: cms_role; Type: TABLE; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE TABLE cms_role (
    id integer NOT NULL,
    name character varying(32) NOT NULL
);


ALTER TABLE cms_role OWNER TO mmi;

--
-- TOC entry 164 (class 1259 OID 16401)
-- Dependencies: 165 7
-- Name: cms_role_id_seq; Type: SEQUENCE; Schema: mmi; Owner: mmi
--

CREATE SEQUENCE cms_role_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cms_role_id_seq OWNER TO mmi;

--
-- TOC entry 2340 (class 0 OID 0)
-- Dependencies: 164
-- Name: cms_role_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE cms_role_id_seq OWNED BY cms_role.id;


--
-- TOC entry 2341 (class 0 OID 0)
-- Dependencies: 164
-- Name: cms_role_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

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

ALTER TABLE cms_text
  OWNER TO mmi;

CREATE INDEX "cms_text_dateModify_idx"
  ON cms_text
  USING btree
  ("dateModify" );

CREATE UNIQUE INDEX cms_text_lang_key_idx
  ON cms_text
  USING btree
  (lang COLLATE pg_catalog."default" , key COLLATE pg_catalog."default" );

--
-- TOC entry 187 (class 1259 OID 16626)
-- Dependencies: 2104 7
-- Name: cron; Type: TABLE; Schema: mmi; Owner: mmi; Tablespace: 
--

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


ALTER TABLE cron OWNER TO mmi;

--
-- TOC entry 186 (class 1259 OID 16624)
-- Dependencies: 187 7
-- Name: cron_id_seq; Type: SEQUENCE; Schema: mmi; Owner: mmi
--

CREATE SEQUENCE cron_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cron_id_seq OWNER TO mmi;

--
-- TOC entry 2342 (class 0 OID 0)
-- Dependencies: 186
-- Name: cron_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE cron_id_seq OWNED BY cron.id;


--
-- TOC entry 2343 (class 0 OID 0)
-- Dependencies: 186
-- Name: cron_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

SELECT pg_catalog.setval('cron_id_seq', 1, true);


--
-- TOC entry 204 (class 1259 OID 16772)
-- Dependencies: 2126 2127 7
-- Name: mail; Type: TABLE; Schema: mmi; Owner: mmi; Tablespace: 
--

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


ALTER TABLE mail OWNER TO mmi;

--
-- TOC entry 202 (class 1259 OID 16752)
-- Dependencies: 2122 2123 2124 7
-- Name: mail_definition; Type: TABLE; Schema: mmi; Owner: mmi; Tablespace: 
--

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


ALTER TABLE mail_definition OWNER TO mmi;

--
-- TOC entry 201 (class 1259 OID 16750)
-- Dependencies: 7 202
-- Name: mail_definition_id_seq; Type: SEQUENCE; Schema: mmi; Owner: mmi
--

CREATE SEQUENCE mail_definition_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mail_definition_id_seq OWNER TO mmi;

--
-- TOC entry 2348 (class 0 OID 0)
-- Dependencies: 201
-- Name: mail_definition_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE mail_definition_id_seq OWNED BY mail_definition.id;


--
-- TOC entry 2349 (class 0 OID 0)
-- Dependencies: 201
-- Name: mail_definition_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

SELECT pg_catalog.setval('mail_definition_id_seq', 6, true);


--
-- TOC entry 203 (class 1259 OID 16770)
-- Dependencies: 204 7
-- Name: mail_id_seq; Type: SEQUENCE; Schema: mmi; Owner: mmi
--

CREATE SEQUENCE mail_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mail_id_seq OWNER TO mmi;

--
-- TOC entry 2350 (class 0 OID 0)
-- Dependencies: 203
-- Name: mail_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE mail_id_seq OWNED BY mail.id;


--
-- TOC entry 2351 (class 0 OID 0)
-- Dependencies: 203
-- Name: mail_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

SELECT pg_catalog.setval('mail_id_seq', 1, false);


--
-- TOC entry 200 (class 1259 OID 16740)
-- Dependencies: 2118 2119 2120 7
-- Name: mail_server; Type: TABLE; Schema: mmi; Owner: mmi; Tablespace: 
--

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


ALTER TABLE mail_server OWNER TO mmi;

--
-- TOC entry 199 (class 1259 OID 16738)
-- Dependencies: 7 200
-- Name: mail_server_id_seq; Type: SEQUENCE; Schema: mmi; Owner: mmi
--

CREATE SEQUENCE mail_server_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mail_server_id_seq OWNER TO mmi;

--
-- TOC entry 2352 (class 0 OID 0)
-- Dependencies: 199
-- Name: mail_server_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE mail_server_id_seq OWNED BY mail_server.id;


--
-- TOC entry 2353 (class 0 OID 0)
-- Dependencies: 199
-- Name: mail_server_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

SELECT pg_catalog.setval('mail_server_id_seq', 1, true);


--
-- TOC entry 208 (class 1259 OID 16798)
-- Dependencies: 2129 7
-- Name: news; Type: TABLE; Schema: mmi; Owner: mmi; Tablespace: 
--

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

ALTER TABLE news OWNER TO mmi;

--
-- TOC entry 207 (class 1259 OID 16796)
-- Dependencies: 208 7
-- Name: news_id_seq; Type: SEQUENCE; Schema: mmi; Owner: mmi
--

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

ALTER TABLE news_id_seq OWNER TO mmi;

--
-- TOC entry 2354 (class 0 OID 0)
-- Dependencies: 207
-- Name: news_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE news_id_seq OWNED BY news.id;


--
-- TOC entry 2355 (class 0 OID 0)
-- Dependencies: 207
-- Name: news_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

SELECT pg_catalog.setval('news_id_seq', 2, true);


--
-- TOC entry 218 (class 1259 OID 21634)
-- Dependencies: 2137 2138 7
-- Name: payment; Type: TABLE; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE TABLE payment (
    id integer NOT NULL,
    payment_config_id integer NOT NULL,
    cms_auth_id integer NOT NULL,
    text text,
    value real DEFAULT 0 NOT NULL,
    ip character varying(16),
    "sessionId" character varying(32),
    "dateAdd" timestamp without time zone NOT NULL,
    "dateEnd" timestamp without time zone,
    type character varying(2),
    status smallint DEFAULT 1 NOT NULL
);


ALTER TABLE payment OWNER TO mmi;

--
-- TOC entry 216 (class 1259 OID 21623)
-- Dependencies: 2135 7
-- Name: payment_config; Type: TABLE; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE TABLE payment_config (
    id integer NOT NULL,
    name character varying(32) NOT NULL,
    "shopId" integer NOT NULL,
    "transactionKey" character varying(32) NOT NULL,
    key1 character varying(32) NOT NULL,
    key2 character varying(32),
    active smallint DEFAULT 1 NOT NULL
);


ALTER TABLE payment_config OWNER TO mmi;

--
-- TOC entry 215 (class 1259 OID 21621)
-- Dependencies: 7 216
-- Name: payment_config_id_seq; Type: SEQUENCE; Schema: mmi; Owner: mmi
--

CREATE SEQUENCE payment_config_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE payment_config_id_seq OWNER TO mmi;

--
-- TOC entry 2356 (class 0 OID 0)
-- Dependencies: 215
-- Name: payment_config_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE payment_config_id_seq OWNED BY payment_config.id;


--
-- TOC entry 2357 (class 0 OID 0)
-- Dependencies: 215
-- Name: payment_config_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

SELECT pg_catalog.setval('payment_config_id_seq', 1, false);


--
-- TOC entry 217 (class 1259 OID 21632)
-- Dependencies: 7 218
-- Name: payment_id_seq; Type: SEQUENCE; Schema: mmi; Owner: mmi
--

CREATE SEQUENCE payment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE payment_id_seq OWNER TO mmi;

--
-- TOC entry 2358 (class 0 OID 0)
-- Dependencies: 217
-- Name: payment_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE payment_id_seq OWNED BY payment.id;


--
-- TOC entry 2359 (class 0 OID 0)
-- Dependencies: 217
-- Name: payment_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

SELECT pg_catalog.setval('payment_id_seq', 1, false);


--
-- TOC entry 210 (class 1259 OID 16810)
-- Dependencies: 7
-- Name: stat; Type: TABLE; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE TABLE stat (
    id integer NOT NULL,
    object character varying(50) NOT NULL,
    "objectId" integer,
    "dateTime" timestamp without time zone NOT NULL
);


ALTER TABLE stat OWNER TO mmi;

--
-- TOC entry 212 (class 1259 OID 20227)
-- Dependencies: 2132 7
-- Name: stat_date; Type: TABLE; Schema: mmi; Owner: mmi; Tablespace: 
--

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


ALTER TABLE stat_date OWNER TO mmi;

--
-- TOC entry 211 (class 1259 OID 20225)
-- Dependencies: 7 212
-- Name: stat_date_id_seq; Type: SEQUENCE; Schema: mmi; Owner: mmi
--

CREATE SEQUENCE stat_date_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE stat_date_id_seq OWNER TO mmi;

--
-- TOC entry 2360 (class 0 OID 0)
-- Dependencies: 211
-- Name: stat_date_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE stat_date_id_seq OWNED BY stat_date.id;


--
-- TOC entry 2361 (class 0 OID 0)
-- Dependencies: 211
-- Name: stat_date_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

SELECT pg_catalog.setval('stat_date_id_seq', 1, false);


--
-- TOC entry 209 (class 1259 OID 16808)
-- Dependencies: 210 7
-- Name: stat_id_seq; Type: SEQUENCE; Schema: mmi; Owner: mmi
--

CREATE SEQUENCE stat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE stat_id_seq OWNER TO mmi;

--
-- TOC entry 2362 (class 0 OID 0)
-- Dependencies: 209
-- Name: stat_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE stat_id_seq OWNED BY stat.id;


--
-- TOC entry 2363 (class 0 OID 0)
-- Dependencies: 209
-- Name: stat_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

SELECT pg_catalog.setval('stat_id_seq', 2, true);


--
-- TOC entry 214 (class 1259 OID 20238)
-- Dependencies: 7
-- Name: stat_label; Type: TABLE; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE TABLE stat_label (
    id integer NOT NULL,
    lang character varying(2) NOT NULL,
    object character varying(32) NOT NULL,
    label character varying(48) NOT NULL,
    description text
);


ALTER TABLE stat_label OWNER TO mmi;

--
-- TOC entry 213 (class 1259 OID 20236)
-- Dependencies: 7 214
-- Name: stat_label_id_seq; Type: SEQUENCE; Schema: mmi; Owner: mmi
--

CREATE SEQUENCE stat_label_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE stat_label_id_seq OWNER TO mmi;

--
-- TOC entry 2364 (class 0 OID 0)
-- Dependencies: 213
-- Name: stat_label_id_seq; Type: SEQUENCE OWNED BY; Schema: mmi; Owner: mmi
--

ALTER SEQUENCE stat_label_id_seq OWNED BY stat_label.id;


--
-- TOC entry 2365 (class 0 OID 0)
-- Dependencies: 213
-- Name: stat_label_id_seq; Type: SEQUENCE SET; Schema: mmi; Owner: mmi
--

SELECT pg_catalog.setval('stat_label_id_seq', 1, false);


--
-- TOC entry 2081 (class 2604 OID 16392)
-- Dependencies: 162 163 163
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY cms_acl ALTER COLUMN id SET DEFAULT nextval('cms_acl_id_seq'::regclass);


--
-- TOC entry 2093 (class 2604 OID 16480)
-- Dependencies: 174 173 174
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY cms_article ALTER COLUMN id SET DEFAULT nextval('cms_article_id_seq'::regclass);


--
-- TOC entry 2084 (class 2604 OID 16420)
-- Dependencies: 166 167 167
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY cms_auth ALTER COLUMN id SET DEFAULT nextval('cms_auth_id_seq'::regclass);


--
-- TOC entry 2092 (class 2604 OID 16455)
-- Dependencies: 171 172 172
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY cms_auth_role ALTER COLUMN id SET DEFAULT nextval('cms_auth_role_id_seq'::regclass);


--
-- TOC entry 2096 (class 2604 OID 16543)
-- Dependencies: 179 178 179
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY cms_comment ALTER COLUMN id SET DEFAULT nextval('cms_comment_id_seq'::regclass);


--
-- TOC entry 2100 (class 2604 OID 16572)
-- Dependencies: 182 183 183
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY cms_contact ALTER COLUMN id SET DEFAULT nextval('cms_contact_id_seq'::regclass);


--
-- TOC entry 2099 (class 2604 OID 16564)
-- Dependencies: 180 181 181
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY cms_contact_option ALTER COLUMN id SET DEFAULT nextval('cms_contact_option_id_seq'::regclass);


--
-- TOC entry 2102 (class 2604 OID 16602)
-- Dependencies: 185 184 185
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY cms_file ALTER COLUMN id SET DEFAULT nextval('cms_file_id_seq'::regclass);


--
-- TOC entry 2094 (class 2604 OID 16494)
-- Dependencies: 175 176 176
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY cms_log ALTER COLUMN id SET DEFAULT nextval('cms_log_id_seq'::regclass);


--
-- TOC entry 2088 (class 2604 OID 16438)
-- Dependencies: 169 170 170
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY cms_navigation ALTER COLUMN id SET DEFAULT nextval('cms_navigation_id_seq'::regclass);


--
-- TOC entry 2083 (class 2604 OID 16406)
-- Dependencies: 165 164 165
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY cms_role ALTER COLUMN id SET DEFAULT nextval('cms_role_id_seq'::regclass);


--
-- TOC entry 2103 (class 2604 OID 16629)
-- Dependencies: 186 187 187
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY cron ALTER COLUMN id SET DEFAULT nextval('cron_id_seq'::regclass);


--
-- TOC entry 2125 (class 2604 OID 16775)
-- Dependencies: 203 204 204
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY mail ALTER COLUMN id SET DEFAULT nextval('mail_id_seq'::regclass);


--
-- TOC entry 2121 (class 2604 OID 16755)
-- Dependencies: 201 202 202
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY mail_definition ALTER COLUMN id SET DEFAULT nextval('mail_definition_id_seq'::regclass);


--
-- TOC entry 2117 (class 2604 OID 16743)
-- Dependencies: 200 199 200
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY mail_server ALTER COLUMN id SET DEFAULT nextval('mail_server_id_seq'::regclass);


--
-- TOC entry 2128 (class 2604 OID 16801)
-- Dependencies: 208 207 208
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY news ALTER COLUMN id SET DEFAULT nextval('news_id_seq'::regclass);


--
-- TOC entry 2136 (class 2604 OID 21637)
-- Dependencies: 218 217 218
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY payment ALTER COLUMN id SET DEFAULT nextval('payment_id_seq'::regclass);


--
-- TOC entry 2134 (class 2604 OID 21626)
-- Dependencies: 215 216 216
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY payment_config ALTER COLUMN id SET DEFAULT nextval('payment_config_id_seq'::regclass);


--
-- TOC entry 2130 (class 2604 OID 16813)
-- Dependencies: 210 209 210
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY stat ALTER COLUMN id SET DEFAULT nextval('stat_id_seq'::regclass);


--
-- TOC entry 2131 (class 2604 OID 20230)
-- Dependencies: 211 212 212
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY stat_date ALTER COLUMN id SET DEFAULT nextval('stat_date_id_seq'::regclass);


--
-- TOC entry 2133 (class 2604 OID 20241)
-- Dependencies: 213 214 214
-- Name: id; Type: DEFAULT; Schema: mmi; Owner: mmi
--

ALTER TABLE ONLY stat_label ALTER COLUMN id SET DEFAULT nextval('stat_label_id_seq'::regclass);


--
-- TOC entry 2285 (class 0 OID 16389)
-- Dependencies: 163
-- Data for Name: cms_acl; Type: TABLE DATA; Schema: mmi; Owner: mmi
--

INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (1, 3, NULL, NULL, NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (2, 1, 'default', NULL, NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (3, 1, 'admin', 'login', NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (4, 1, 'cms', NULL, NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (5, 1, 'news', 'index', NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (6, 1, 'user', 'login', NULL, 'allow');
INSERT INTO cms_acl (id, cms_role_id, module, controller, action, access) VALUES (7, 1, 'user', 'registration', NULL, 'allow');


--
-- TOC entry 2290 (class 0 OID 16477)
-- Dependencies: 174
-- Data for Name: cms_article; Type: TABLE DATA; Schema: mmi; Owner: mmi
--



--
-- TOC entry 2287 (class 0 OID 16417)
-- Dependencies: 167
-- Data for Name: cms_auth; Type: TABLE DATA; Schema: mmi; Owner: mmi
--

INSERT INTO cms_auth (id, lang, username, email, password, "lastIp", "lastLog", "lastFailIp", "lastFailLog", "failLogCount", logged, active) VALUES (1, 'pl', 'admin', 'admin@hqsoft.pl', 'd033e22ae348aeb5660fc2140aec35850c4da997', '127.0.0.1', '2012-02-23 15:41:12', '89.231.108.27', '2011-12-20 19:42:01', 8, 0, 1);
INSERT INTO cms_auth (id, lang, username, email, password, "lastIp", "lastLog", "lastFailIp", "lastFailLog", "failLogCount", logged, active) VALUES (11, 'pl', 'test', 'test@milejko.pl', '5cb9cbee5f6421f730ecbf0bc981cee4e117181243a95512aef7576d20e547b0559da0a4d5d67252888a2e52e8589ace4a30a87716d33745f3697f80b6269576', '127.0.0.1', '2012-03-15 11:06:52', '127.0.0.1', '2012-03-15 11:04:59', 1, 0, 1);
INSERT INTO cms_auth (id, lang, username, email, password, "lastIp", "lastLog", "lastFailIp", "lastFailLog", "failLogCount", logged, active) VALUES (2, 'pl', 'mariusz', 'mariusz@milejko.pl', '7a48d2fe2f6f86430acee5b86a093c3352b9f780', '127.0.0.1', '2012-03-20 15:54:01', '127.0.0.1', '2012-03-16 13:41:49', 9, 0, 1);


--
-- TOC entry 2289 (class 0 OID 16452)
-- Dependencies: 172
-- Data for Name: cms_auth_role; Type: TABLE DATA; Schema: mmi; Owner: mmi
--

INSERT INTO cms_auth_role (id, cms_auth_id, cms_role_id) VALUES (7, 2, 3);
INSERT INTO cms_auth_role (id, cms_auth_id, cms_role_id) VALUES (8, 1, 3);
INSERT INTO cms_auth_role (id, cms_auth_id, cms_role_id) VALUES (13, 11, 2);

--
-- TOC entry 2293 (class 0 OID 16561)
-- Dependencies: 181
-- Data for Name: cms_contact_option; Type: TABLE DATA; Schema: mmi; Owner: mmi
--

INSERT INTO cms_contact_option (id, name) VALUES (3, 'Propozycje zmian');
INSERT INTO cms_contact_option (id, name) VALUES (1, 'Inne');

--
-- TOC entry 2288 (class 0 OID 16435)
-- Dependencies: 170
-- Data for Name: cms_navigation; Type: TABLE DATA; Schema: mmi; Owner: mmi
--

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


--
-- TOC entry 2286 (class 0 OID 16403)
-- Dependencies: 165
-- Data for Name: cms_role; Type: TABLE DATA; Schema: mmi; Owner: mmi
--

INSERT INTO cms_role (id, name) VALUES (1, 'guest');
INSERT INTO cms_role (id, name) VALUES (2, 'member');
INSERT INTO cms_role (id, name) VALUES (3, 'admin');


--
-- TOC entry 2296 (class 0 OID 16626)
-- Dependencies: 187
-- Data for Name: cron; Type: TABLE DATA; Schema: mmi; Owner: mmi
--

INSERT INTO cron (id, active, minute, hour, "dayOfMonth", month, "dayOfWeek", name, description, module, controller, action, "dateAdd", "dateModified", "dateLastExecute") VALUES (1, 1, '*', '*', '*', '*', '*', 'Wysyłka maili', 'Wysyłanie kolejki mailowej', 'mail', 'cron', 'send', '2012-03-14 10:35:57', '2012-03-14 10:36:16', NULL);


--
-- TOC entry 2304 (class 0 OID 16772)
-- Dependencies: 204
-- Data for Name: mail; Type: TABLE DATA; Schema: mmi; Owner: mmi
--



--
-- TOC entry 2302 (class 0 OID 16740)
-- Dependencies: 200
-- Data for Name: mail_server; Type: TABLE DATA; Schema: mmi; Owner: mmi
--

INSERT INTO mail_server (id, address, port, username, password, "from", "dateAdd", "dateModify", active, ssl) VALUES (1, 'localhost', 25, 'local', '', '', '2012-03-14 14:31:43', '2012-03-14 14:47:01', 1, 'plain');


--
-- TOC entry 2305 (class 0 OID 16798)
-- Dependencies: 208
-- Data for Name: news; Type: TABLE DATA; Schema: mmi; Owner: mmi
--



--
-- TOC entry 2310 (class 0 OID 21634)
-- Dependencies: 218
-- Data for Name: payment; Type: TABLE DATA; Schema: mmi; Owner: mmi
--



--
-- TOC entry 2309 (class 0 OID 21623)
-- Dependencies: 216
-- Data for Name: payment_config; Type: TABLE DATA; Schema: mmi; Owner: mmi
--



--
-- TOC entry 2306 (class 0 OID 16810)
-- Dependencies: 210
-- Data for Name: stat; Type: TABLE DATA; Schema: mmi; Owner: mmi
--

INSERT INTO stat (id, object, "objectId", "dateTime") VALUES (1, 'user_login', NULL, '2012-03-15 11:06:12');
INSERT INTO stat (id, object, "objectId", "dateTime") VALUES (2, 'user_login', NULL, '2012-03-15 11:06:52');


--
-- TOC entry 2307 (class 0 OID 20227)
-- Dependencies: 212
-- Data for Name: stat_date; Type: TABLE DATA; Schema: mmi; Owner: mmi
--



--
-- TOC entry 2308 (class 0 OID 20238)
-- Dependencies: 214
-- Data for Name: stat_label; Type: TABLE DATA; Schema: mmi; Owner: mmi
--



--
-- TOC entry 2144 (class 2606 OID 16469)
-- Dependencies: 163 163
-- Name: cms_acl_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY cms_acl
    ADD CONSTRAINT cms_acl_pkey PRIMARY KEY (id);


--
-- TOC entry 2168 (class 2606 OID 16485)
-- Dependencies: 174 174
-- Name: cms_article_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY cms_article
    ADD CONSTRAINT cms_article_pkey PRIMARY KEY (id);


--
-- TOC entry 2153 (class 2606 OID 16424)
-- Dependencies: 167 167
-- Name: cms_auth_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY cms_auth
    ADD CONSTRAINT cms_auth_pkey PRIMARY KEY (id);


--
-- TOC entry 2161 (class 2606 OID 16457)
-- Dependencies: 172 172
-- Name: cms_auth_role_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY cms_auth_role
    ADD CONSTRAINT cms_auth_role_pkey PRIMARY KEY (id);


--
-- TOC entry 2184 (class 2606 OID 16550)
-- Dependencies: 179 179
-- Name: cms_comment_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY cms_comment
    ADD CONSTRAINT cms_comment_pkey PRIMARY KEY (id);


--
-- TOC entry 2189 (class 2606 OID 16566)
-- Dependencies: 181 181
-- Name: cms_contact_option_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY cms_contact_option
    ADD CONSTRAINT cms_contact_option_pkey PRIMARY KEY (id);


--
-- TOC entry 2194 (class 2606 OID 16578)
-- Dependencies: 183 183
-- Name: cms_contact_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY cms_contact
    ADD CONSTRAINT cms_contact_pkey PRIMARY KEY (id);


--
-- TOC entry 2208 (class 2606 OID 16607)
-- Dependencies: 185 185
-- Name: cms_file_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY cms_file
    ADD CONSTRAINT cms_file_pkey PRIMARY KEY (id);


--
-- TOC entry 2177 (class 2606 OID 16500)
-- Dependencies: 176 176
-- Name: cms_log_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY cms_log
    ADD CONSTRAINT cms_log_pkey PRIMARY KEY (id);


--
-- TOC entry 2158 (class 2606 OID 16446)
-- Dependencies: 170 170
-- Name: cms_navigation_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY cms_navigation
    ADD CONSTRAINT cms_navigation_pkey PRIMARY KEY (id);


--
-- TOC entry 2148 (class 2606 OID 16408)
-- Dependencies: 165 165
-- Name: cms_role_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY cms_role
    ADD CONSTRAINT cms_role_pkey PRIMARY KEY (id);


--
-- TOC entry 2214 (class 2606 OID 16635)
-- Dependencies: 187 187
-- Name: cron_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY cron
    ADD CONSTRAINT cron_pkey PRIMARY KEY (id);


--
-- TOC entry 2243 (class 2606 OID 16763)
-- Dependencies: 202 202
-- Name: mail_definition_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY mail_definition
    ADD CONSTRAINT mail_definition_pkey PRIMARY KEY (id);


--
-- TOC entry 2247 (class 2606 OID 16782)
-- Dependencies: 204 204
-- Name: mail_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY mail
    ADD CONSTRAINT mail_pkey PRIMARY KEY (id);


--
-- TOC entry 2239 (class 2606 OID 16748)
-- Dependencies: 200 200
-- Name: mail_server_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY mail_server
    ADD CONSTRAINT mail_server_pkey PRIMARY KEY (id);


--
-- TOC entry 2250 (class 2606 OID 16807)
-- Dependencies: 208 208
-- Name: news_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY news
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);


--
-- TOC entry 2262 (class 2606 OID 21629)
-- Dependencies: 216 216
-- Name: payment_config_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY payment_config
    ADD CONSTRAINT payment_config_pkey PRIMARY KEY (id);


--
-- TOC entry 2268 (class 2606 OID 21644)
-- Dependencies: 218 218
-- Name: payment_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY payment
    ADD CONSTRAINT payment_pkey PRIMARY KEY (id);


--
-- TOC entry 2256 (class 2606 OID 20233)
-- Dependencies: 212 212
-- Name: stat_date_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY stat_date
    ADD CONSTRAINT stat_date_pkey PRIMARY KEY (id);


--
-- TOC entry 2259 (class 2606 OID 20246)
-- Dependencies: 214 214
-- Name: stat_label_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY stat_label
    ADD CONSTRAINT stat_label_pkey PRIMARY KEY (id);


--
-- TOC entry 2252 (class 2606 OID 16815)
-- Dependencies: 210 210
-- Name: stat_pkey; Type: CONSTRAINT; Schema: mmi; Owner: mmi; Tablespace: 
--

ALTER TABLE ONLY stat
    ADD CONSTRAINT stat_pkey PRIMARY KEY (id);


--
-- TOC entry 2139 (class 1259 OID 16688)
-- Dependencies: 163
-- Name: cms_acl_access_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_acl_access_idx ON cms_acl USING btree (access);


--
-- TOC entry 2140 (class 1259 OID 16687)
-- Dependencies: 163
-- Name: cms_acl_action_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_acl_action_idx ON cms_acl USING btree (action);


--
-- TOC entry 2141 (class 1259 OID 16686)
-- Dependencies: 163
-- Name: cms_acl_controller_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_acl_controller_idx ON cms_acl USING btree (controller);


--
-- TOC entry 2142 (class 1259 OID 16685)
-- Dependencies: 163
-- Name: cms_acl_module_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_acl_module_idx ON cms_acl USING btree (module);


--
-- TOC entry 2164 (class 1259 OID 16690)
-- Dependencies: 174
-- Name: cms_article_dateAdd_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX "cms_article_dateAdd_idx" ON cms_article USING btree ("dateAdd");


--
-- TOC entry 2165 (class 1259 OID 16691)
-- Dependencies: 174
-- Name: cms_article_dateModify_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX "cms_article_dateModify_idx" ON cms_article USING btree ("dateModify");


--
-- TOC entry 2166 (class 1259 OID 16487)
-- Dependencies: 174
-- Name: cms_article_lang_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_article_lang_idx ON cms_article USING btree (lang);


--
-- TOC entry 2169 (class 1259 OID 16689)
-- Dependencies: 174
-- Name: cms_article_title_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_article_title_idx ON cms_article USING btree (title);


--
-- TOC entry 2170 (class 1259 OID 16486)
-- Dependencies: 174
-- Name: cms_article_uri_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_article_uri_idx ON cms_article USING btree (uri);


--
-- TOC entry 2149 (class 1259 OID 16426)
-- Dependencies: 167
-- Name: cms_auth_active_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_auth_active_idx ON cms_auth USING btree (active);


--
-- TOC entry 2150 (class 1259 OID 16428)
-- Dependencies: 167
-- Name: cms_auth_email_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_auth_email_idx ON cms_auth USING btree (email);


--
-- TOC entry 2151 (class 1259 OID 16693)
-- Dependencies: 167
-- Name: cms_auth_logged_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_auth_logged_idx ON cms_auth USING btree (logged);


--
-- TOC entry 2154 (class 1259 OID 16427)
-- Dependencies: 167
-- Name: cms_auth_username_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_auth_username_idx ON cms_auth USING btree (username);


--
-- TOC entry 2180 (class 1259 OID 16557)
-- Dependencies: 179
-- Name: cms_comment_dateAdd_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX "cms_comment_dateAdd_idx" ON cms_comment USING btree ("dateAdd");


--
-- TOC entry 2181 (class 1259 OID 16556)
-- Dependencies: 179 179
-- Name: cms_comment_object_objectId_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX "cms_comment_object_objectId_idx" ON cms_comment USING btree (object, "objectId");


--
-- TOC entry 2182 (class 1259 OID 16694)
-- Dependencies: 179
-- Name: cms_comment_parent_id_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_comment_parent_id_idx ON cms_comment USING btree (parent_id);


--
-- TOC entry 2185 (class 1259 OID 16558)
-- Dependencies: 179
-- Name: cms_comment_stars_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_comment_stars_idx ON cms_comment USING btree (stars);


--
-- TOC entry 2190 (class 1259 OID 16594)
-- Dependencies: 183
-- Name: cms_contact_active_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_contact_active_idx ON cms_contact USING btree (active);


--
-- TOC entry 2191 (class 1259 OID 16596)
-- Dependencies: 183
-- Name: cms_contact_dateAdd_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX "cms_contact_dateAdd_idx" ON cms_contact USING btree ("dateAdd");


--
-- TOC entry 2192 (class 1259 OID 16595)
-- Dependencies: 183
-- Name: cms_contact_email_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_contact_email_idx ON cms_contact USING btree (email);


--
-- TOC entry 2187 (class 1259 OID 16697)
-- Dependencies: 181
-- Name: cms_contact_option_name_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_contact_option_name_idx ON cms_contact_option USING btree (name);


--
-- TOC entry 2195 (class 1259 OID 16696)
-- Dependencies: 183
-- Name: cms_contact_uri_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_contact_uri_idx ON cms_contact USING btree (uri);


--
-- TOC entry 2199 (class 1259 OID 16614)
-- Dependencies: 185
-- Name: cms_file_active_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_file_active_idx ON cms_file USING btree (active);


--
-- TOC entry 2200 (class 1259 OID 16621)
-- Dependencies: 185
-- Name: cms_file_author_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_file_author_idx ON cms_file USING btree (author);


--
-- TOC entry 2201 (class 1259 OID 16618)
-- Dependencies: 185
-- Name: cms_file_class_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_file_class_idx ON cms_file USING btree (class);


--
-- TOC entry 2202 (class 1259 OID 16622)
-- Dependencies: 185
-- Name: cms_file_dateAdd_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX "cms_file_dateAdd_idx" ON cms_file USING btree ("dateAdd");


--
-- TOC entry 2203 (class 1259 OID 16623)
-- Dependencies: 185
-- Name: cms_file_dateModify_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX "cms_file_dateModify_idx" ON cms_file USING btree ("dateModify");


--
-- TOC entry 2204 (class 1259 OID 16619)
-- Dependencies: 185
-- Name: cms_file_name_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_file_name_idx ON cms_file USING btree (name);


--
-- TOC entry 2205 (class 1259 OID 16615)
-- Dependencies: 185 185
-- Name: cms_file_object_objectId_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX "cms_file_object_objectId_idx" ON cms_file USING btree (object, "objectId");


--
-- TOC entry 2206 (class 1259 OID 16617)
-- Dependencies: 185
-- Name: cms_file_order_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_file_order_idx ON cms_file USING btree ("order");


--
-- TOC entry 2209 (class 1259 OID 16616)
-- Dependencies: 185
-- Name: cms_file_sticky_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_file_sticky_idx ON cms_file USING btree (sticky);


--
-- TOC entry 2210 (class 1259 OID 16620)
-- Dependencies: 185
-- Name: cms_file_title_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_file_title_idx ON cms_file USING btree (title);


--
-- TOC entry 2171 (class 1259 OID 16533)
-- Dependencies: 176
-- Name: cms_log_dateTime_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX "cms_log_dateTime_idx" ON cms_log USING btree ("dateTime");


--
-- TOC entry 2172 (class 1259 OID 16529)
-- Dependencies: 176
-- Name: cms_log_ip_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_log_ip_idx ON cms_log USING btree (ip);


--
-- TOC entry 2173 (class 1259 OID 16532)
-- Dependencies: 176
-- Name: cms_log_objectId_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX "cms_log_objectId_idx" ON cms_log USING btree ("objectId");


--
-- TOC entry 2174 (class 1259 OID 16531)
-- Dependencies: 176
-- Name: cms_log_object_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_log_object_idx ON cms_log USING btree (object);


--
-- TOC entry 2175 (class 1259 OID 16530)
-- Dependencies: 176
-- Name: cms_log_operation_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_log_operation_idx ON cms_log USING btree (operation);


--
-- TOC entry 2178 (class 1259 OID 16528)
-- Dependencies: 176
-- Name: cms_log_url_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_log_url_idx ON cms_log USING btree (url);


--
-- TOC entry 2155 (class 1259 OID 16448)
-- Dependencies: 170
-- Name: cms_navigation_order_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_navigation_order_idx ON cms_navigation USING btree ("order");


--
-- TOC entry 2156 (class 1259 OID 16447)
-- Dependencies: 170
-- Name: cms_navigation_parent_id_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_navigation_parent_id_idx ON cms_navigation USING btree (parent_id);


--
-- TOC entry 2159 (class 1259 OID 16449)
-- Dependencies: 170
-- Name: cms_navigation_visible_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_navigation_visible_idx ON cms_navigation USING btree (visible);


--
-- TOC entry 2146 (class 1259 OID 16698)
-- Dependencies: 165
-- Name: cms_role_name_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cms_role_name_idx ON cms_role USING btree (name);


--
-- TOC entry 2212 (class 1259 OID 16699)
-- Dependencies: 187
-- Name: cron_active_idx; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX cron_active_idx ON cron USING btree (active);


--
-- TOC entry 2145 (class 1259 OID 21660)
-- Dependencies: 163
-- Name: fki_cms_acl_cms_role_id_fkey; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX fki_cms_acl_cms_role_id_fkey ON cms_acl USING btree (cms_role_id);


--
-- TOC entry 2162 (class 1259 OID 21661)
-- Dependencies: 172
-- Name: fki_cms_auth_role_cms_auth_id; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX fki_cms_auth_role_cms_auth_id ON cms_auth_role USING btree (cms_auth_id);


--
-- TOC entry 2163 (class 1259 OID 21662)
-- Dependencies: 172
-- Name: fki_cms_auth_role_cms_role_id; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX fki_cms_auth_role_cms_role_id ON cms_auth_role USING btree (cms_role_id);


--
-- TOC entry 2186 (class 1259 OID 21663)
-- Dependencies: 179
-- Name: fki_cms_comment_cms_auth_id_fkey; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX fki_cms_comment_cms_auth_id_fkey ON cms_comment USING btree (cms_auth_id);


--
-- TOC entry 2196 (class 1259 OID 21664)
-- Dependencies: 183
-- Name: fki_cms_contact_cms_auth_id_fkey; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX fki_cms_contact_cms_auth_id_fkey ON cms_contact USING btree (cms_auth_id);


--
-- TOC entry 2197 (class 1259 OID 21665)
-- Dependencies: 183
-- Name: fki_cms_contact_cms_auth_id_reply_fkey; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX fki_cms_contact_cms_auth_id_reply_fkey ON cms_contact USING btree (cms_auth_id_reply);


--
-- TOC entry 2198 (class 1259 OID 21666)
-- Dependencies: 183
-- Name: fki_cms_contact_cms_contact_option_id_fkey; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX fki_cms_contact_cms_contact_option_id_fkey ON cms_contact USING btree (cms_contact_option_id);


--
-- TOC entry 2211 (class 1259 OID 21667)
-- Dependencies: 185
-- Name: fki_cms_file_cms_auth_id_fkey; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX fki_cms_file_cms_auth_id_fkey ON cms_file USING btree (cms_auth_id);


--
-- TOC entry 2179 (class 1259 OID 21668)
-- Dependencies: 176
-- Name: fki_cms_log_cms_auth_id_fkey; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX fki_cms_log_cms_auth_id_fkey ON cms_log USING btree (cms_auth_id);


--
-- TOC entry 2240 (class 1259 OID 21679)
-- Dependencies: 202
-- Name: fki_mail_definition_mail_server_id_fkey; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

CREATE INDEX fki_mail_definition_mail_server_id_fkey ON mail_definition USING btree (mail_server_id);


--
-- TOC entry 2244 (class 1259 OID 21678)
-- Dependencies: 204
-- Name: fki_mail_mail_definition_id_fkey; Type: INDEX; Schema: mmi; Owner: mmi; Tablespace: 
--

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
REVOKE ALL ON SEQUENCE cms_article_id_seq FROM mmi;
GRANT ALL ON SEQUENCE cms_article_id_seq TO mmi;

ALTER TABLE cms_contact ADD COLUMN name character varying(64);
ALTER TABLE cms_contact ADD COLUMN phone character varying(16);
ALTER TABLE cms_contact_option ADD COLUMN "sendTo" character varying(64);
ALTER TABLE cms_contact_option OWNER TO mmi;

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

ALTER TABLE cms_navigation ADD COLUMN independent smallint NOT NULL DEFAULT 0;
ALTER TABLE cms_navigation ADD COLUMN nofollow smallint NOT NULL DEFAULT 0;
ALTER TABLE cms_navigation ADD COLUMN blank smallint NOT NULL DEFAULT 0;

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
ALTER TABLE cms_tag
  OWNER TO mmi;


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
ALTER TABLE cms_tag_link
  OWNER TO mmi;

CREATE INDEX fki_cms_tag_link_cms_tag_id_fkey
  ON cms_tag_link
  USING btree
  (cms_tag_id );

CREATE INDEX cms_tag_link_object_objectId_idx
  ON cms_tag_link
  USING btree
  ("object", "objectId" );
