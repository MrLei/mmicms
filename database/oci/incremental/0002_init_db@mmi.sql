CREATE TABLE "cms_widget_text" (
  "id" integer NOT NULL,
  "data" clob,
  CONSTRAINT "cms_widget_text_pkey" PRIMARY KEY ("id")
)

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_widget_text_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_widget_text_id_trg"
    BEFORE INSERT ON "cms_widget_text"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_widget_text_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/