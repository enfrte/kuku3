-- comment;

CREATE TABLE  translations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    timestamp DATE DEFAULT (DATE('now')),
    source_line TEXT NOT NULL,
    translation_line TEXT NOT NULL
);

CREATE TABLE  visitor (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    visit_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
