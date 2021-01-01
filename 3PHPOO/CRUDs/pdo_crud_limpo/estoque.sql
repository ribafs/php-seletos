SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Database: `estoque`

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `cpf` char(11) DEFAULT NULL,
  `nome` char(45) NOT NULL,
  `credito_liberado` char(1) NOT NULL,
  `data_nasc` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `cpf`, `nome`, `credito_liberado`, `data_nasc`, `email`) VALUES
(1, '11111111111', 'Joao Pereira Brito', 's', '0000-00-00', 'joao@brito.com'),
(2, '11111111112', 'Roberto Pereira Brito', 'n', '0000-00-00', 'roberto@brito.com'),
(3, '11111111113', 'Antônio Pereira Brito', 'n', '0000-00-00', 'antonio@brito.com'),
(4, '11111111114', 'Carlos Pereira Brito', 's', '0000-00-00', 'carlos@brito.com'),
(5, '11111111115', 'Otoniel Pereira Brito', 's', '0000-00-00', 'otoniel@brito.com'),
(6, '11111111116', 'Helena Pereira Brito', 's', '0000-00-00', 'helena@brito.com'),
(7, '11111111117', 'Flávio Pereira Brito', 's', '0000-00-00', 'flavio@brito.com'),
(8, '11111111118', 'Joana Pereira Brito', 'n', '0000-00-00', 'joana@brito.com'),
(9, '11111111119', 'Francisco Pereira Brito', 'n', '0000-00-00', 'francisco@brito.com'),
(10, '11111111110', 'Jorge Pereira Brito', 's', '0000-00-00', 'jorje@brito.com'),
(11, '11111111121', 'Pedro Pereira Brito', 's', '0000-00-00', 'pedro@brito.com'),
(12, '11111111131', 'Ribamar Pereira Brito', 's', '0000-00-00', 'ribamar@brito.com'),
(13, '11111111141', 'Tiago Pereira Brito', 's', '0000-00-00', 'tiago@brito.com'),
(14, '11111111151', 'Elias Pereira Brito', 'n', '0000-00-00', 'elias@brito.com'),
(15, '11111111161', 'Marcos Pereira Brito', 's', '0000-00-00', 'marcos@brito.com'),
(16, '11111111171', 'Ricardo Pereira Brito', 's', '0000-00-00', 'ricardo@brito.com'),
(17, '11111111181', 'Rômulo Pereira Brito', 's', '0000-00-00', 'romulo@brito.com'),
(18, '11111111191', 'Henrique Pereira Brito', 'n', '0000-00-00', 'henrique@brito.com'),
(19, '11111111101', 'Francis Pereira Brito', 's', '0000-00-00', 'francis@brito.com'),
(20, '11111111211', 'Otávio Pereira Brito', 's', '1947-12-02', 'otavio@brito.com'),
(21, '11111111311', 'Rogério Pereira Brito', 's', '0000-00-00', 'rogerio@brito.com'),
(22, '11111111411', 'Jurandir Pereira Brito', 's', '0000-00-00', 'jurandir@brito.com'),
(24, '12106826345', 'Ribamar Sousa', 's', '1956-08-03', 'ribafs@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `cpf` char(11) DEFAULT NULL,
  `nome` char(45) NOT NULL,
  `senha` char(32) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `data_nasc` date NOT NULL,
  `empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `cpf`, `nome`, `senha`, `email`, `data_nasc`, `empresa`) VALUES
(1, '11111111111', 'Joao Pereira Brito', '12345678', 'joao@brito.com', '0000-00-00', 1),
(2, '11111111112', 'Roberto Pereira Brito', '33345678', 'roberto@brito.com', '0000-00-00', 1),
(3, '11111111113', 'Antônio Pereira Brito', 'gg345678', 'antonio@brito.com', '0000-00-00', 1),
(4, '11111111114', 'Carlos Pereira Brito', 's345678', 'carlos@brito.com', '0000-00-00', 1),
(5, '11111111115', 'Otoniel Pereira Brito', 's34567844', 'otoniel@brito.com', '0000-00-00', 1),
(6, '11111111116', 'Helena Pereira Brito', '345678s', 'helena@brito.com', '0000-00-00', 1),
(7, '11111111117', 'Flávio Pereira Brito', '66345678s', 'flavio@brito.com', '0000-00-00', 1),
(8, '11111111118', 'Joana Pereira Brito', 'jjj345678n', 'joana@brito.com', '0000-00-00', 1),
(9, '11111111119', 'Francisco Pereira Brito', 'nn345678n', 'francisco@brito.com', '0000-00-00', 1),
(10, '11111111110', 'Jorge Pereira Brito', '88345678s', 'jorje@brito.com', '0000-00-00', 1),
(11, '11111111121', 'Pedro Pereira Brito', '99345678s', 'pedro@brito.com', '0000-00-00', 1),
(12, '11111111131', 'Ribamar Pereira Brito', '44345678s', 'ribamar@brito.com', '0000-00-00', 1),
(13, '11111111141', 'Tiago Pereira Brito', 's66345678', 'tiago@brito.com', '0000-00-00', 1),
(14, '11111111151', 'Elias Pereira Brito', 'n77345678', 'elias@brito.com', '0000-00-00', 1),
(15, '11111111161', 'Marcos Pereira Brito', 's44345678', 'marcos@brito.com', '0000-00-00', 1),
(16, '11111111171', 'Ricardo Pereira Brito', 's33345678', 'ricardo@brito.com', '0000-00-00', 1),
(17, '11111111181', 'Rômulo Pereira Brito', 's22345678', 'romulo@brito.com', '0000-00-00', 1),
(18, '11111111191', 'Henrique Pereira Brito', '44345678n', 'henrique@brito.com', '0000-00-00', 1),
(19, '11111111101', 'Francis Pereira Brito', '34567888', 'francis@brito.com', '0000-00-00', 1),
(20, '11111111211', 'Otávio Pereira Brito', 's34567899', 'otavio@brito.com', '1947-12-02', 1),
(21, '11111111311', 'Rogério Pereira Brito', 's345678666', 'rogerio@brito.com', '1983-04-04', 1),
(23, '11111111511', 'Raquél Pereira Brito', '345678676', 'raquel@brito.com', '1956-08-03', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
