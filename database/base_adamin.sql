CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('participant','formateur','admin') DEFAULT 'participant',
    full_name VARCHAR(255) DEFAULT NULL,
    address TEXT DEFAULT NULL,
    phone VARCHAR(50) DEFAULT NULL,
    bio TEXT DEFAULT NULL,
    photo VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Création de l'admin par défaut
INSERT INTO users (email, username, password, role, nom_prenom) 
VALUES (
  'nounonvenanromain@gmail.com',
  'bcc-center',
  -- Mot de passe hashé : Admain@bcc2025
  '$2y$10$GLjFG2bAcT5a1S9S97NTYOA7AdoH.9nCDmtmpsQiDqI5K6yRHkUS6',
  'admin',
  'Administrateur BCC-Center'
);
