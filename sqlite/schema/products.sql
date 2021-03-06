DROP TABLE IF EXISTS items;
CREATE TABLE items (
    id integer primary key, 
    title text,
    description text,
    content text,
    
    id_category integer,
    tags text,
    id_owner integer,
    owner text,
    id_owner_company integer,
    owner_company text,
    
    date_avaible integer,
    date_add integer,
    
    price text,
    qty text,
    id_unit integer,
    unit text,
    reference text,
    
    is_visible integer,
    is_avaible integer,
    is_active integer,
    is_advertise integer,
    
    url_rewrite text
    
);

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
    id integer primary key, 
    id_item integer,
    name text,
    type text,
    size text,
    is_cover integer,
    date_add integer,
    full blob,
    thumb blob,
    small blob
); 

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
    id integer primary key,
    id_parent integer,
    title text,
    subtitle text,
    tags text,
    is_visible integer,
    position integer,
    
    depth integer,
    depth_html text,
    parents text,
    children text,
    url_rewrite text,
    list_order integer,
    
    date_image integer,
    image_type text,
    image_size text,
    image blob,
    thumb blob
);


DROP TABLE IF EXISTS units;
CREATE TABLE units (
    id integer primary key,
    name text,
    abbreviation text,
    position integer,
    is_default integer
);
INSERT INTO units (is_default,abbreviation,name,position) VALUES 
    (1,   'nb','Number',    1), 
    (null,'kg','Kilogram',  1), 
    (null,'gr','Gram',      1), 
    (null,'m' ,'Meter',     1), 
    (null,'cm','Cantimeter',1),
    (null,'km','Kilometer', 1), 
    (null,'m2','Square meter',1), 
    (null,'m3','Cubic meter',1);