CREATE TABLE IF NOT EXISTS managers(
    id_manager int AUTO_INCREMENT PRIMARY KEY,
    name varchar(80),
    sector_name varchar(30) UNIQUE
);

CREATE TABLE IF NOT EXISTS workers(
    id_worker int AUTO_INCREMENT PRIMARY KEY,
    name varchar(80) NOT NULL, 
    user varchar(50) NOT NULL UNIQUE, 
    password varchar(200) NOT NULL,
    id_manager int NOT NULL,  
    rating_permission TINYINT, 
    admin_permission TINYINT,
    FOREIGN KEY (id_manager) REFERENCES managers(id_manager)
);

CREATE TABLE IF NOT EXISTS manager_rating(
    id_rating int AUTO_INCREMENT PRIMARY KEY, 
    id_manager int NOT NULL, 
    id_worker int NOT NULL, 
    rating_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    questao_1 int NOT NULL, 
    questao_2 int NOT NULL, 
    questao_3 int NOT NULL, 
    questao_4 int NOT NULL, 
    questao_5 int NOT NULL, 
    questao_6 int NOT NULL, 
    questao_7 int NOT NULL, 
    questao_8 int NOT NULL, 
    questao_9 int NOT NULL, 
    questao_10 int NOT NULL,
    questao_11 int NOT NULL,
    questao_12 int NOT NULL,
    questao_13 int NOT NULL,
    questao_14 int NOT NULL,
    questao_15 int NOT NULL,
    questao_16 int NOT NULL,
    questao_17 int NOT NULL,
    questao_18 int NOT NULL,
    FOREIGN KEY (id_manager) REFERENCES managers(id_manager),
    FOREIGN KEY (id_worker) REFERENCES workers(id_worker)
);
