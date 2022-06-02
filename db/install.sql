CREATE TABLE IF NOT EXISTS user (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	email TEXT NOT NULL UNIQUE,
	password TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS idea (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	author_id INTEGER NOT NULL,
    title TEXT NOT NULL,
    slug TEXT NOT NULL,
    description TEXT NOT NULL,
    publish_date TEXT NOT NULL,
    image TEXT NOT NULL,
    FOREIGN KEY (author_id) 
    REFERENCES user (id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS idea_user (
	author_id INTEGER NOT NULL,
	idea_id INTEGER NOT NULL,
	vote INTEGER NOT NULL,
    PRIMARY KEY (author_id, idea_id),
    FOREIGN KEY (author_id) 
       REFERENCES user (id) 
          ON DELETE CASCADE 
          ON UPDATE CASCADE,
    FOREIGN KEY (idea_id)
       REFERENCES idea (id) 
          ON DELETE CASCADE 
          ON UPDATE CASCADE
);