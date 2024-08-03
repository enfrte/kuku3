-- DROP TABLE IF EXISTS translations; -- if you want to recreate the table

CREATE TABLE IF NOT EXISTS translations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    timestamp DATE DEFAULT (DATE('now')),
    source_line TEXT NOT NULL,
    translation_line TEXT NOT NULL
);

DROP TABLE IF EXISTS visitor

CREATE TABLE IF NOT EXISTS visitor (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    visit_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
