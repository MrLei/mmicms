-- Table: tutorial_form_test

-- DROP TABLE tutorial_form_test;

CREATE TABLE tutorial_form_test
(
  id serial NOT NULL,
  data character varying(128)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tutorial_form_test
  OWNER TO mmi;
