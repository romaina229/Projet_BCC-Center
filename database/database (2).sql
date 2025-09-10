CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fullname VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  username VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('participant','formateur','admin') DEFAULT 'participant',
  address TEXT,
  profile_pic VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (fullname,email,username,password,role) VALUES
('Administrateur','nounonvenanromain@gmail.com','bcc-center',
'$2y$10$8V0x.lzFZf0pZK2aGQZJjO9GEG7T2vJXlMBaNopdZn0HqWj7R4s3q','admin');
