CREATE TABLE IF NOT EXISTS games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    game_name VARCHAR(150) NOT NULL,
    genre VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    status VARCHAR(20) NOT NULL default 'rozpracovana',
    player_count INT NOT NULL
);

CREATE TABLE IF NOT EXISTS characters (
id INT AUTO_INCREMENT PRIMARY KEY,
game_id INT NOT NULL,
character_name VARCHAR(150) NOT NULL,
character_type VARCHAR(20) NOT NULL DEFAULT 'playable',
role VARCHAR(50),
description TEXT NOT NULL,
is_culprit BOOLEAN NOT NULL DEFAULT FALSE,

CONSTRAINT fk_characters_game
FOREIGN KEY (game_id) REFERENCES games(id)
        ON DELETE CASCADE
);