CREATE TABLE posts
(
    id int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    title varchar(250) NULL,
    content varchar(250) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO posts(title, content) VALUES
("First Post", "My nice first post"),
("Second Post", "The second post looks nicer"),
("Third post", "Hmmm, I will go for the third Post");