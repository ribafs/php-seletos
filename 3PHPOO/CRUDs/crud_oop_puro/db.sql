CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
);

INSERT INTO `users` (`id`, `name`, `age`, `email`) VALUES
(1,	'Ribamar FS',	63,	'ribafs@gmail.com'),
(2,	'Tiago EF',	26,	'tiago@tiago.com'),
(3,	'Elias Evangelista Ferreira',	18,	'elias@elias.com'),
(4,	'Fátima EF',	47,	'fatima@fatima.net');
