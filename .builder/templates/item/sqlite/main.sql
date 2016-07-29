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

