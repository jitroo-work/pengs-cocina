CREATE TABLE `Users` (
  `UserID` int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `Users`
    ADD UNIQUE KEY `Username` (`Username`);

-- INSERT INTO `Users` (`Username`, `Password`) VALUES
-- ('', '');

-- CREATE TABLE `users` (
--   `id` int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
--   `first_name` varchar(255) NOT NULL,
--   `last_name` varchar(255) NOT NULL,
--   `username` varchar(50) NOT NULL,
--   `password` varchar(255) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ALTER TABLE `users`
--   ADD UNIQUE KEY `username` (`username`);
