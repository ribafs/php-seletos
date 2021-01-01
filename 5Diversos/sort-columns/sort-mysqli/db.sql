CREATE TABLE IF NOT EXISTS `students` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` tinyint(100) NOT NULL,
  `joined` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

INSERT INTO `students` (`id`, `name`, `age`, `joined`) VALUES
(1, 'David Deacon', 23, '17/08/2018'),
(2, 'Sheri Warner', 19, '03/05/2018'),
(3, 'Sean Glover', 24, '24/07/2018'),
(4, 'John West', 17, '13/08/2018'),
(5, 'Rufus Clarke', 20, '28/07/2018'),
(6, 'Roosevelt Myers', 20, '25/07/2018'),
(7, 'Elvira Andrews', 22, '02/07/2018'),
(8, 'Richard    Cook', 26, '19/07/2018'),
(9, 'Lorenzo    Harris', 23, '01/07/2018'),
(10, 'Eduardo   Hoffman', 17, '03/07/2018'),
(11, 'Jeanne Fisher', 20, '13/08/2018'),
(12, 'Tracy Bowers', 30, '07/07/2018'),
(13, 'Heidi Lawrence', 18, '04/06/2018'),
(14, 'Tara Holland', 25, '01/07/1991'),
(15, 'Grant Edwards', 22, '22/06/2018'),
(16, 'Bradford Green', 29, '02/05/2018'),
(17, 'Gwen Schultz', 20, '02/05/2018'),
(18, 'Hope Dawson', 28, '21/08/2018'),
(19, 'Florence Osborne', 19, '17/05/2018'),
(20, 'Rickey Poole', 26, '28/06/2018'),
(21, 'Casey Sutton', 28, '06/07/2018'),
(22, 'Willie Lowe', 23, '11/05/2018'),
(23, 'Stephen   Schultz', 28, '15/07/2018'),
(24, 'Eileen Lynch', 18, '12/06/2018'),
(25, 'Aaron Ruiz', 29, '02/05/2018'),
(26, 'Mae Murray', 30, '24/06/2018'),
(27, 'Regina Hanson', 21, '26/07/2018'),
(28, 'Cameron   Mclaughlin', 20, '29/07/2018'),
(29, 'Earl Hale', 17, '30/06/2018'),
(30, 'Marta Blair', 24, '10/06/2018'),
(31, 'Alberta   Silva', 22, '05/06/2018'),
(32, 'Joanna Holmes', 20, '20/05/2018'),
(33, 'Alex Brock', 30, '12/05/2018'),
(34, 'Colin Wright', 19, '28/05/2018'),
(35, 'Peter Schmidt', 25, '10/07/2018'),
(36, 'Joshua Price', 27, '13/07/2018'),
(37, 'Elias Chandler', 22, '19/07/2018'),
(38, 'Stanley   Ross', 21, '02/06/2018'),
(39, 'Vera Cole', 26, '02/05/2018'),
(40, 'Johnny Daniels', 29, '19/07/2018'),
(41, 'Yvonne Hopkins', 21, '16/07/2018');


ALTER TABLE `students`
 ADD PRIMARY KEY (`id`);


ALTER TABLE `students`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
