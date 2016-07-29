DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
    id integer primary key, 
    name text,
    mrp text,
    ein text,
    email text,
    phone text,
    mobile text,
    skype text,
    facebook text,
    twitter text,
    im text,
    site text,
    country text,
    city text,
    address text,
    is_advertise integer,
    note text,
    logo_size text,
    logo_date integer,
    logo blob
); 


DROP TABLE IF EXISTS `partners_companies`;
CREATE TABLE `partners_companies` (
    id_partner integer,
    id_company integer,
    positin text
); 