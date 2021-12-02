CREATE TABLE notes (
    id_note     INTEGER      PRIMARY KEY AUTOINCREMENT,
    id_user     INTEGER      REFERENCES users (id_user),
    title       VARCHAR (40),
    description TEXT,
    date_write  DATE,
    date_modify DATE,
    id_delete   INT          DEFAULT (0),
    deadline    VARCHAR
);

CREATE TABLE users (
    id_user     INTEGER       PRIMARY KEY AUTOINCREMENT,
    user        VARCHAR (20),
    password    VARCHAR (120),
    last_login  DATE,
    pass_change DATE,
    id_delete   INT           DEFAULT (0) 
);

INSERT INTO users ( id_user, user, password, last_login, pass_change, id_delete)
VALUES (NULL, 'dataedo', '$2y$10$tQ9rt5LCm0N3cPL3ZzsVkOlq2ncoC4n.EA0cxl3ZV8sqArMHXhd8i', NULL, NULL, 0);
-- password: Acme2021
INSERT INTO users ( id_user, user, password, last_login, pass_change, id_delete)
VALUES (NULL, 'tomasz', '$2y$10$8XvQ8Slm9ikMFnI1QA1RX.dUzVoQ3kJcrg9fR2thQ0T3IerhOSVXy', NULL, NULL, 0);
-- password: 1234$$go


