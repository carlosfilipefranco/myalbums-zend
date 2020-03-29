set names 'utf8';

CREATE TABLE album (
   id int(11) NOT NULL auto_increment,
   artist varchar(100) NOT NULL,
   title varchar(100) NOT NULL,
   created_at datetime NOT NULL,
   updated_at datetime NULL,
   PRIMARY KEY (id)
 );
 INSERT INTO album (artist, title, created_at, updated_at)
     VALUES  ('Pearl Jam',  'Ten', '2020-03-30 13:00', null);
 INSERT INTO album (artist, title, created_at, updated_at)
     VALUES  ('Nick Cave and the Bad Seeds',  'Skeleton Tree', '2020-03-30 13:00', null);
 INSERT INTO album (artist, title, created_at, updated_at)
     VALUES  ('Nine Inch Nails',  'The Downward Spiral', '2020-03-30 13:00', null);
 INSERT INTO album (artist, title, created_at, updated_at)
     VALUES  ('Tool',  'Fear Inoculum', '2020-03-30 13:00', null);
 INSERT INTO album (artist, title, created_at, updated_at)
     VALUES  ('Radiohead',  'Ok Computer', '2020-03-30 13:00', null);