

DROP TABLE IF EXISTS order_statuses;
CREATE TABLE order_statuses (
    id integer primary key,
    is_default integer,
    name text,
    icon text,
    color text,
    is_closed integer
);
INSERT INTO order_statuses (is_default,name,icon,color,is_closed) VALUES (1,'New order','uk-icon-envelope','#000000',null);


DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
    id integer primary key,
    id_status integer,
    date_add integer,
    date_delivery integer,
    id_partner integer,
    id_company integer,
    customer text,
    company text,
    mrp text,
    ein text,
    phone text,
    email text,
    country text,
    city text,
    address text,
    price real,
    is_active integer,
    id_method integer,
    method text
);


DROP TABLE IF EXISTS orders_items;
CREATE TABLE orders_items (
    id integer primary key,
    id_order integer,
    id_item integer,
    product text,
    note text,
    id_unit integer,
    unit text,
    qty real,
    price real,
    date_add integer,
    is_closed integer
);

DROP TABLE IF EXISTS orders_statuses;
CREATE TABLE orders_statuses (
    id integer primary key,
    id_order integer,
    id_status integer,
    status text,
    user text,
    date_add integer
);
