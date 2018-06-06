CREATE DATABASE tp
  WITH OWNER = postgres
       ENCODING = 'UTF8'
       TABLESPACE = pg_default
       LC_COLLATE = 'es_AR.UTF-8'
       LC_CTYPE = 'es_AR.UTF-8'
       CONNECTION LIMIT = -1;


CREATE TABLE public.usuarios
(
  id integer NOT NULL,
  nombre name,
  psw character varying,
  CONSTRAINT usuarios_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.usuarios
  OWNER TO postgres;

CREATE TABLE public.pelis_que_vio
(
  id_peli integer NOT NULL,
  id_usuario integer,
  CONSTRAINT pelis_que_vio_pkey PRIMARY KEY (id_peli),
  CONSTRAINT pelis_que_vio_id_usuario_fkey FOREIGN KEY (id_usuario)
      REFERENCES public.usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.pelis_que_vio
  OWNER TO postgres;

