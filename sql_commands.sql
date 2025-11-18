-- Create table teams
CREATE TABLE teams (
    team_id INT AUTO_INCREMENT PRIMARY KEY,
    team_name VARCHAR(50) NOT NULL,
    stadium VARCHAR(100),
    manager_name VARCHAR(50)
);

-- Create table players
CREATE TABLE players (
    player_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    position ENUM('GK', 'DEF', 'MID', 'FWD') NOT NULL,
    price DECIMAL(5,2),
    points INT,
    fk_team INT,
    FOREIGN KEY (fk_team) REFERENCES teams(team_id)
);

-- Create table players
CREATE TABLE gameweeks (
    gameweek_id INT AUTO_INCREMENT PRIMARY KEY,
    week_number INT NOT NULL,
    player_id INT NOT NULL,
    points INT NOT NULL,
    FOREIGN KEY (player_id) REFERENCES players(player_id)
);

-- Insert data into table 'teams'
INSERT INTO teams (team_name, stadium, manager_name) VALUES
('Arsenal', 'Emirates Stadium', 'Mikel Arteta'),
('Aston Villa', 'Villa Park', 'Unai Emery'),
('AFC Bournemouth', 'Dean Court', 'Andoni Iraola'),
('Brentford', 'Brentford Community Stadium', 'Keith Andrews'),
('Brighton & Hove Albion', 'Falmer Stadium', 'Fabian Hürzeler'),
('Burnley', 'Turf Moor', 'Scott Parker'),
('Chelsea', 'Stamford Bridge', 'Enzo Maresca'),
('Crystal Palace', 'Selhurst Park', 'Oliver Glasner'),
('Everton', 'Hill Dickinson Stadium', 'David Moyes'),
('Fulham', 'Craven Cottage', 'Marco Silva'),
('Leeds United', 'Elland Road', 'Daniel Farke'),
('Liverpool', 'Anfield', 'Arne Slot'),
('Manchester City', 'Etihad Stadium', 'Pep Guardiola'),
('Manchester United', 'Old Trafford', 'Ruben Amorim'),
('Newcastle United', 'St James Park', 'Eddie Howe'),
('Nottingham Forest', 'City Ground', 'Ange Postecoglou'),
('Sunderland', 'Stadium of Light', 'Régis Le Bris'),
('Tottenham Hotspur', 'Tottenham Hotspur Stadium', 'Thomas Frank'),
('West Ham United', 'London Stadium', 'Nuno Espírito Santo'),
('Wolverhampton Wanderers', 'Molineux Stadium', 'Vitor Pereira');

-- Insert data into table 'players'
INSERT INTO players (full_name, position, price, points, fk_team) VALUES
('Senne Lammens', 'GK', 4.5, 9, 14),
('Jurrien Timber', 'DEF', 5.8, 12, 1),
('Dan Burn', 'DEF', 4.3, 11, 15),
('Jan Paul van Hecke', 'DEF', 4.5, 11, 5),
('Antoine Semenyo', 'MID', 4.9, 20, 3),
('Mohammed Kudus', 'MID', 6.3, 12, 18),
('Declan Rice', 'MID', 5.9, 11, 1),
('Donyell Malen', 'FWD', 2.3, 16, 2),
('Benjamin Šeško', 'FWD', 6.5, 9, 14);

-- Added a new column 'total_points' into table 'players'
ALTER TABLE players
ADD total_points INT AFTER points;

-- Update price, total_points of players in table 'players'
UPDATE players SET price = 5.0, total_points = 9 WHERE full_name = 'Senne Lammens';
UPDATE players SET price = 5.9, total_points = 48 WHERE full_name = 'Jurrien Timber';
UPDATE players SET price = 5.1, total_points = 43 WHERE full_name = 'Dan Burn';
UPDATE players SET price = 4.2, total_points = 22 WHERE full_name = 'Jan Paul van Hecke';
UPDATE players SET price = 7.9, total_points = 66 WHERE full_name = 'Antoine Semenyo';
UPDATE players SET price = 6.7, total_points = 39 WHERE full_name = 'Mohammed Kudus';
UPDATE players SET price = 6.5, total_points = 40 WHERE full_name = 'Declan Rice';
UPDATE players SET price = 5.1, total_points = 22 WHERE full_name = 'Donyell Malen';
UPDATE players SET price = 7.3, total_points = 23 WHERE full_name = 'Benjamin Šeško';

-- Insert two more players in table 'players'
INSERT INTO players (full_name, position, price, points, total_points, fk_team) VALUES
('Bruno Guimaraes', 'MID', 6.5, 14, 30, 15),
('Josko Gvardiol', 'DEF', 5.9, 12, 24, 13);

-- Updated Benjamin Sesko's name
UPDATE players
SET full_name = 'Benjamin Sesko'
WHERE full_name = 'Benjamin Šeško';

-- Deleted table 'gameweeks'
DROP TABLE gameweeks;

--Li,pengcheng's part:
-- Create table users
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert admin account
INSERT INTO users (email, password_hash)
VALUES ('lipengcheng@example.com', '$2y$10$pnF4gtv/tGybOItr4TCEZ.b9RRd93QdHzl0SXgc0nhVyz2bGRQym2');