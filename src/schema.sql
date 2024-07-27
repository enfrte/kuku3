DROP TABLE IF EXISTS translations;

CREATE TABLE translations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    timestamp DATE DEFAULT (DATE('now')),
    source_line TEXT NOT NULL,
    translation_line TEXT NOT NULL
);
