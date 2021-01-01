-- banco pdo
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(45) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `cpf` char(11) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `clientes` (`id`, `nome`, `email`, `data_nasc`, `cpf`) VALUES
(1, 'Erin Pate Skinner', 'dolor.vitae.dolor@mollisvitaeposuere.ca', '2013-10-07', '74426302285'),
(2, 'Leonard Martinez Hays', 'dignissim.magna.a@dolorvitae.org', '2012-08-22', '75278965048'),
(3, 'Aladdin Curry French', 'eu.augue@eutemporerat.org', '2012-10-28', '10376915676'),
(4, 'Chloe Macdonald Dalton', 'parturient.montes@Mauris.ca', '2013-05-12', '64444679077'),
(5, 'Mallory Sweet Strong', 'lorem@fringillaporttitor.ca', '2013-05-19', '15687101505'),
(6, 'Jermaine Pierce Woodward', 'mi.pede.nonummy@molestiearcu.ca', '2013-03-22', '36712502261'),
(7, 'Bell Raymond Pruitt', 'dignissim.tempor.arcu@nuncac.org', '2013-03-09', '64629428663'),
(8, 'Lydia Bell Whitfield', 'Sed@semper.com', '2013-12-02', '41962749289'),
(9, 'Tad Mason Graham', 'elit.erat@vestibulum.edu', '2012-06-08', '05642745964'),
(10, 'Felix Bradshaw Mccray', 'dui@elitCurabitursed.edu', '2013-09-16', '82071617437'),
(11, 'Idona Jensen Garrett', 'sem@Crasvulputate.com', '2014-01-08', '07941004794'),
(12, 'Wayne Ray Padilla', 'luctus.felis.purus@nonjustoProin.org', '2014-04-03', '60934465323'),
(13, 'Nelle Finch Cantu', 'placerat.eget@Donec.ca', '2012-05-29', '64704574060'),
(14, 'Maite Emerson Best', 'dui.augue@quisdiam.com', '2014-04-01', '04531857574'),
(15, 'Jada Holman Wilkins', 'dolor@tristiquealiquet.com', '2013-01-11', '88994190741'),
(16, 'Beverly Lane Lindsay', 'et.euismod@ametfaucibusut.com', '2013-10-22', '40194697135'),
(17, 'Hayden Clayton Foreman', 'enim@aliquamenimnec.edu', '2013-04-16', '72583040904'),
(18, 'Hadassah Leonard Key', 'dui.quis@augueidante.com', '2013-04-07', '72626859924'),
(19, 'Adrian Ballard Peters', 'enim.Curabitur@faucibus.com', '2012-07-13', '50918748283'),
(20, 'Phyllis Richmond Wynn', 'eget.laoreet@justoeuarcu.org', '2013-07-01', '62712888794'),
(21, 'Amelia Baird Barrera', 'id.ante@dignissim.org', '2012-06-09', '12106836368'),
(22, 'Whitney Mack Lamb', 'quam.Curabitur.vel@PraesentluctusCurabitur.org', '2012-06-26', '52403407001'),
(23, 'Myra Mcmahon Valentine', 'ac.mi@fringillami.edu', '2012-07-27', '42961419194');
