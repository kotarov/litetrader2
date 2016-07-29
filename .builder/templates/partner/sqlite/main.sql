DROP TABLE IF EXISTS `partners`;
CREATE TABLE `partners` (
    id integer primary key, 
    name text, 
    surname text,
    family text, 
    ein text,
    birthday integer,
    datetime integer,
    somedate integer,
    email text, 
    password text, 
    onelogin_pass text, 
    onelogin_time integer, 
    phone text,
    mobile text,
    sip text,
    work text,
    im text,
    skype text,
    facebook text,
    twitter text,
    site text,
    country text, 
    city text, 
    address text, 
    date_add integer,
    date_logged integer,
    is_active integer,
    is_advertise integer,
    note text,
    photo_date integer,
    photo_size text,
    photo_type text,
    photo blob
); 




