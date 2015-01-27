CREATE TABLE cms_widget_picture
(
  id serial NOT NULL,
  "dateAdd" timestamp without time zone,
  CONSTRAINT cms_widget_picture_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);