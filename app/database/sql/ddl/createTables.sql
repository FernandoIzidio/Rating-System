CREATE TABLE IF NOT EXISTS sectors(
    id_sector int AUTO_INCREMENT PRIMARY KEY,
    sector_name varchar(30) UNIQUE
);


CREATE TABLE sector_questions(
    id_question int PRIMARY KEY AUTO_INCREMENT,
    question_text varchar(255),
    id_sector int,
    FOREIGN KEY (id_sector) REFERENCES sectors(id_sector)
);


CREATE TABLE IF NOT EXISTS workers(
    id_worker int AUTO_INCREMENT PRIMARY KEY,
    name varchar(80) NOT NULL, 
    user varchar(50) NOT NULL UNIQUE, 
    password varchar(200) NOT NULL,
    id_sector int NOT NULL,  
    rating_permission TINYINT DEFAULT 0, 
    admin_permission TINYINT DEFAULT 0,
    super_admin TINYINT DEFAULT 0,
    FOREIGN KEY (id_sector) REFERENCES sectors(id_sector)
);

CREATE TABLE IF NOT EXISTS sector_rating(
    id_rating int AUTO_INCREMENT PRIMARY KEY, 
    id_sector int NOT NULL, 
    id_worker int NOT NULL, 
    id_question int NOT NULL, 
    rating_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_sector) REFERENCES sectors(id_sector),
    FOREIGN KEY (id_worker) REFERENCES workers(id_worker),
    FOREIGN KEY (id_question) REFERENCES sector_questions(id_question)
);
