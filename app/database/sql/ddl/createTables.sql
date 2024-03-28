CREATE TABLE IF NOT EXISTS sectors(
    id_sector int AUTO_INCREMENT PRIMARY KEY,
    sector_name varchar(30) UNIQUE NOT NULL
);

CREATE TABLE IF NOT EXISTS assessments(
    id_assessment int AUTO_INCREMENT PRIMARY KEY,
    assessment_name varchar(200) UNIQUE NOT NULL,
    id_sector int NOT NULL,
    availability int NOT NULL, 
    FOREIGN KEY (id_sector) REFERENCES sectors(id_sector)
);


CREATE TABLE IF NOT EXISTS questions(
    id_question int PRIMARY KEY AUTO_INCREMENT,
    question_text varchar(255) NOT NULL,
    id_sector int NOT NULL,
    assessment int NOT NULL, 
    FOREIGN KEY (id_sector) REFERENCES sectors(id_sector),
    FOREIGN KEY (assessment) REFERENCES assessments(id_assessment)
);


CREATE TABLE IF NOT EXISTS workers(
    id_worker int AUTO_INCREMENT PRIMARY KEY,
    name varchar(80) NOT NULL, 
    user varchar(50) NOT NULL UNIQUE, 
    email varchar(200) NOT NULL UNIQUE,
    password varchar(200) NOT NULL,
    id_sector int NOT NULL,  
    rating_permission TINYINT DEFAULT 0, 
    admin_permission TINYINT DEFAULT 0,
    super_admin TINYINT DEFAULT 0,
    FOREIGN KEY (id_sector) REFERENCES sectors(id_sector)
);

CREATE TABLE IF NOT EXISTS question_answers(
    id_answer int AUTO_INCREMENT PRIMARY KEY, 
    id_sector int NOT NULL, 
    id_question int NOT NULL, 
    answer int NOT NULL,
    FOREIGN KEY (id_sector) REFERENCES sectors(id_sector),
    FOREIGN KEY (id_question) REFERENCES questions(id_question)
);


CREATE TABLE IF NOT EXISTS assessment_answers(
    id_answer int AUTO_INCREMENT PRIMARY KEY,
    id_assessment int NOT NULL, 
    id_worker int NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_assessment) REFERENCES assessments(id_assessment),
    FOREIGN KEY (id_worker) REFERENCES workers(id_worker)
);