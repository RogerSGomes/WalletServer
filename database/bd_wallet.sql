-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Set-2022 às 00:43
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_wallet`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `wallet_avatar`
--

CREATE TABLE `wallet_avatar` (
  `avatar_id` int(11) NOT NULL,
  `avatar_url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `wallet_avatar`
--

INSERT INTO `wallet_avatar` (`avatar_id`, `avatar_url`) VALUES
(1, '../../images/avatar-1.png'),
(2, '../../images/avatar-2.png'),
(3, '../../images/avatar-3.png'),
(4, '../../images/avatar-4.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `wallet_transaction`
--

CREATE TABLE `wallet_transaction` (
  `transaction_id` int(11) NOT NULL,
  `transaction_user_id` int(11) NOT NULL,
  `transaction_type` varchar(15) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_cost` varchar(20) NOT NULL,
  `transaction_payment` varchar(100) NOT NULL,
  `transaction_origin` varchar(15) NOT NULL,
  `transaction_description` varchar(30) DEFAULT NULL,
  `transaction_adress` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `wallet_transaction`
--

INSERT INTO `wallet_transaction` (`transaction_id`, `transaction_user_id`, `transaction_type`, `transaction_date`, `transaction_cost`, `transaction_payment`, `transaction_origin`, `transaction_description`, `transaction_adress`) VALUES
(8, 1, 'Gasto', '2022-09-30', 'testeteste', 'testeteste', 'testeteste', 'testeteste', 'testeteste'),
(9, 1, 'Gasto', '2022-09-01', 'R$ 99,90', 'Dinheiro', 'Internacional', 'Remédio dos filhos', ''),
(10, 1, 'Gasto', '2022-08-29', 'R$ 99,90', 'PIX', 'Internacional', 'Remédio', ''),
(11, 1, 'Gasto', '2022-09-09', 'R$ 99,90', 'Cartão de débito', 'Nacional', 'Teste', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `wallet_user`
--

CREATE TABLE `wallet_user` (
  `user_id` int(11) NOT NULL,
  `user_avatar_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_nickname` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `wallet_user`
--

INSERT INTO `wallet_user` (`user_id`, `user_avatar_id`, `user_name`, `user_nickname`, `user_email`, `user_password`, `user_token`) VALUES
(1, 4, 'Roger', 'RogerSilva', 'example@gmail.com', '19288164da2fc5415d3cbbeb9bc5868e', '9ec86d4c4a3d7d61426fca2e5c82f243wallet2022260214');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `wallet_avatar`
--
ALTER TABLE `wallet_avatar`
  ADD PRIMARY KEY (`avatar_id`);

--
-- Índices para tabela `wallet_transaction`
--
ALTER TABLE `wallet_transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `transaction_user_id` (`transaction_user_id`);

--
-- Índices para tabela `wallet_user`
--
ALTER TABLE `wallet_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_avatar_id` (`user_avatar_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `wallet_avatar`
--
ALTER TABLE `wallet_avatar`
  MODIFY `avatar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `wallet_transaction`
--
ALTER TABLE `wallet_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `wallet_user`
--
ALTER TABLE `wallet_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `wallet_transaction`
--
ALTER TABLE `wallet_transaction`
  ADD CONSTRAINT `wallet_transaction_ibfk_1` FOREIGN KEY (`transaction_user_id`) REFERENCES `wallet_user` (`user_id`);

--
-- Limitadores para a tabela `wallet_user`
--
ALTER TABLE `wallet_user`
  ADD CONSTRAINT `wallet_user_ibfk_1` FOREIGN KEY (`user_avatar_id`) REFERENCES `wallet_avatar` (`avatar_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
