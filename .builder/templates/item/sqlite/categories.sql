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
