
/**
 * Author:  ba3
 * Created: 14-may-2020
 */



CREATE DATABASE socialfreelancer CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE socialfreelancer.users (
	id INT auto_increment NOT NULL,
	role varchar(100) NOT NULL,
	name varchar(100) NOT NULL,
	nick varchar(100) NOT NULL,
	email varchar(100) NOT NULL,
	password varchar(100) NOT NULL,
	image varchar(100) NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME NULL,
	remember_token varchar(100) NULL,
	status BOOL NOT NULL,
	CONSTRAINT users_PK PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci
COMMENT='registro de usuarios - laravel 5.7 framework';

INSERT INTO socialfreelancer.users ( role, name, nick, email, password, image, created_at,  status) 
                             VALUES( 'ADMINISTRATOR', 'Administrator', 'admin', 'admin@mail.com', '$2y$10$5CS.qH.Q6Qr3MzXnCXMg1Oae49KbjwWo0fWX99shshqDWKqgrGZ2K', 'img-user-default.png', CURDATE(), 1);


CREATE TABLE socialfreelancer.password_resets (
	id INT auto_increment NOT NULL,
	email varchar(100) NOT NULL,
	token varchar(100) NULL,
	created_at DATETIME NULL,
	CONSTRAINT password_resets_PK PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci
COMMENT='tabla pibote de reseteo de contrasena usuario';



CREATE TABLE socialfreelancer.Tbl_images (
	id INT auto_increment NOT NULL,
	user_id INT NOT NULL,
	images_path_image varchar(100) NOT NULL,
	description_image TEXT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME NULL,
	status_image BOOL NOT NULL,
	CONSTRAINT Tbl_images_PK PRIMARY KEY (id),
        CONSTRAINT images_user_FK FOREIGN KEY (user_id) REFERENCES users(id)
	
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci
COMMENT='registro de imagenes';


CREATE TABLE socialfreelancer.Tbl_comments (
	id INT auto_increment NOT NULL,
	user_id INT NOT NULL,
	image_id INT NOT NULL,
	content_comment TEXT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME NULL,
	status_comment BOOL NOT NULL,
	CONSTRAINT Tbl_comments_PK PRIMARY KEY (id),
        CONSTRAINT comments_users_FK FOREIGN KEY (user_id) REFERENCES users(id),
        CONSTRAINT comments_images_FK FOREIGN KEY (image_id) REFERENCES Tbl_images(id)
        
        
	
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci
COMMENT='registro de comentarios';


CREATE TABLE socialfreelancer.Tbl_likes (
	id INT auto_increment NOT NULL,
	user_id INT NOT NULL,
	image_id INT NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME NULL,
	status_like BOOL NOT NULL,
	CONSTRAINT Tbl_likes_PK PRIMARY KEY (id),
        CONSTRAINT likes_users_FK FOREIGN KEY (user_id) REFERENCES users(id),
        CONSTRAINT likes_images_FK FOREIGN KEY (image_id) REFERENCES Tbl_images(id)
	
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci
COMMENT='registro de likes';


