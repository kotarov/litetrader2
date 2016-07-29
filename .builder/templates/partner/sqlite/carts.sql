DROP TABLE IF EXISTS `partners_items`;
CREATE TABLE `partners_items` (
    id integer primary key,
    id_partner integer,
    id_item integer,
    note text,
    id_unit integer,
    qty     real,
    price   real,
    date_add integer,
    is_closed integer
);

