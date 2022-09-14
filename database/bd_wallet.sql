-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Set-2022 às 02:06
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
(1, './assets/avatar-1.png'),
(2, './assets/avatar-2.png'),
(3, './assets/avatar-3.png'),
(4, './assets/avatar-4.png');

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
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `wallet_avatar`
--
ALTER TABLE `wallet_avatar`
  ADD PRIMARY KEY (`avatar_id`);

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
-- AUTO_INCREMENT de tabela `wallet_user`
--
ALTER TABLE `wallet_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `wallet_user`
--
ALTER TABLE `wallet_user`
  ADD CONSTRAINT `wallet_user_ibfk_1` FOREIGN KEY (`user_avatar_id`) REFERENCES `wallet_avatar` (`avatar_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
