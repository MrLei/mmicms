CREATE TABLE "cms_widget_picture" (
  "id" integer NOT NULL,
  "dateAdd" timestamp,
  CONSTRAINT "cms_widget_picture_pkey" PRIMARY KEY ("id")
)

/* NEXT STATEMENT */
CREATE SEQUENCE "cms_widget_picture_id_seq"
    START WITH 1
    INCREMENT BY 1
    NOMINVALUE
    NOMAXVALUE;

/* NEXT STATEMENT */
CREATE OR REPLACE TRIGGER "cms_widget_picture_id_trg"
    BEFORE INSERT ON "cms_widget_picture"
    FOR EACH ROW

    BEGIN
        SELECT  "cms_widget_picture_id_seq".NEXTVAL
        INTO    :NEW."id"
        FROM    dual;
    END;
/