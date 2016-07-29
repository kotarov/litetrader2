

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