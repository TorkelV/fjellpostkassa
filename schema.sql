PGDMP     .                	    v        	   guestbook    11.0    11.0     	           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            
           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false                       1262    16393 	   guestbook    DATABASE     �   CREATE DATABASE guestbook WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';
    DROP DATABASE guestbook;
             postgres    false                       0    0    DATABASE guestbook    ACL     -   GRANT ALL ON DATABASE guestbook TO "Torkel";
                  postgres    false    2828            �            1259    16426    visits    TABLE     �   CREATE TABLE public.visits (
    id bigint NOT NULL,
    m_id character varying,
    u_id character varying,
    "time" character varying
);
    DROP TABLE public.visits;
       public         postgres    false            �            1259    16424    visits_id_seq    SEQUENCE     v   CREATE SEQUENCE public.visits_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.visits_id_seq;
       public       postgres    false    201                       0    0    visits_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.visits_id_seq OWNED BY public.visits.id;
            public       postgres    false    200            �
           2604    16429 	   visits id    DEFAULT     f   ALTER TABLE ONLY public.visits ALTER COLUMN id SET DEFAULT nextval('public.visits_id_seq'::regclass);
 8   ALTER TABLE public.visits ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    201    200    201                      0    16426    visits 
   TABLE DATA               8   COPY public.visits (id, m_id, u_id, "time") FROM stdin;
    public       postgres    false    201   �
                  0    0    visits_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.visits_id_seq', 1, false);
            public       postgres    false    200            �
           2606    16434    visits visits_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.visits
    ADD CONSTRAINT visits_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.visits DROP CONSTRAINT visits_pkey;
       public         postgres    false    201                  x������ � �     