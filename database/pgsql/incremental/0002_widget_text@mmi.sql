CREATE TABLE cms_widget_text
(
  id serial NOT NULL,
  data text,
  CONSTRAINT cms_widget_text_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);