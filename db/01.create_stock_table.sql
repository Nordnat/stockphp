IF NOT EXISTS (CREATE TABLE `stocks` (
  `id` int(11)E NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL UNIQUE,
  `type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;)

CREATE INDEX `stock` ON `stocks` (`name`)

INSERT INTO stocks (name, price, producer, quantity, serial)
VALUES
  ('rama','5670.00','RamaCar',20,1231232,'lifo'),
  ('koło','356.68','Bridgestone',5,256874628,'fifo'),
  ('hamulce','50.40','BracesCom',10,87287534,'lifo'),
  ('kierownica','570.30','StearWheel',4,62536525,'fifo'),
  ('opony','144.00','Firestore',6,365672536,'lifo'),
  ('felgi 15\'','5670.00','Felgson',12,83542283,'lifo'),
  ('alternator','570.30','Alts',10,432355727,'fifo'),
  ('lusterka','70.00','BlackMirror',10,62001636,'lifo'),
  ('wycieraczki','50.40','WhipeThis',30,625372576,'lifo');
