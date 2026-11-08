CREATE TABLE IF NOT EXISTS games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    game_name VARCHAR(150) NOT NULL,
    genre VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    status VARCHAR(20) NOT NULL default 'rozpracovana',
    player_count INT NOT NULL
);