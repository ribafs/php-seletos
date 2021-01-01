CREATE TABLE `masterlogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `masterlogin` (`id`, `username`, `email`, `password`, `role`) VALUES
(11, 'hamid', 'hamid@gmail.com', '123456', 'admin'),
(12, 'ribafs', 'ribafs@gmail.com', 'ribafs1234', 'employee'),
(13, 'user', 'user@user.com', '123456', 'user');

