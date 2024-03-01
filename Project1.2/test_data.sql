-- Inserting into MotionPicture
INSERT INTO
    MotionPicture (id, name, rating, production, budget)
VALUES
    (1, 'Inception', 8.8, 'Warner Bros.', 160000000.00);

INSERT INTO
    MotionPicture (id, name, rating, production, budget)
VALUES
    (2, 'The Matrix', 8.7, 'Warner Bros.', 63000000.00);

INSERT INTO
    MotionPicture (id, name, rating, production, budget)
VALUES
    (
        3,
        'Interstellar',
        8.6,
        'Paramount Pictures',
        165000000.00
    );

-- Inserting into User
INSERT INTO
    User (email, name, age)
VALUES
    ('alice@example.com', 'Alice', 30);

INSERT INTO
    User (email, name, age)
VALUES
    ('bob@example.com', 'Bob', 25);

INSERT INTO
    User (email, name, age)
VALUES
    ('charlie@example.com', 'Charlie', 28);

-- Inserting into Likes
-- Inserting into Movie
INSERT INTO
    Movie (mpid, boxoffice_collection)
VALUES
    (1, 829000000.00);

INSERT INTO
    Movie (mpid, boxoffice_collection)
VALUES
    (2, 463517383.00);

-- Inserting into Series
INSERT INTO
    Series (mpid, season_count)
VALUES
    (3, 5);

-- Inserting into People
INSERT INTO
    People (id, name, nationality, dob, gender)
VALUES
    (
        1,
        'Leonardo DiCaprio',
        'American',
        '1974-11-11',
        'male'
    );

INSERT INTO
    People (id, name, nationality, dob, gender)
VALUES
    (
        2,
        'Keanu Reeves',
        'Canadian',
        '1964-09-02',
        'male'
    );

INSERT INTO
    People (id, name, nationality, dob, gender)
VALUES
    (
        3,
        'Christopher Nolan',
        'British',
        '1970-07-30',
        'male'
    );

INSERT INTO
    People (id, name, nationality, dob, gender)
VALUES
    (
        4,
        'Steven Spielberg',
        'American',
        '1946-12-18',
        'male'
    );

INSERT INTO
    People (id, name, nationality, dob, gender)
VALUES
    (
        5,
        'Quentin Tarantino',
        'American',
        '1963-03-27',
        'male'
    );

-- Inserting into Role
INSERT INTO
    Role (mpid, pid, role_name)
VALUES
    (1, 1, 'Actor');

INSERT INTO
    Role (mpid, pid, role_name)
VALUES
    (2, 2, 'Actor');

INSERT INTO
    Role (mpid, pid, role_name)
VALUES
    (1, 3, 'Director');

INSERT INTO
    Role (mpid, pid, role_name)
VALUES
    (2, 4, 'Director');

INSERT INTO
    Role (mpid, pid, role_name)
VALUES
    (3, 5, 'Director');

-- Inserting into Award
INSERT INTO
    Award (mpid, pid, award_name, award_year)
VALUES
    (1, 1, 'Best Actor', 2010);

INSERT INTO
    Award (mpid, pid, award_name, award_year)
VALUES
    (2, 2, 'Best Actor', 2014);

-- Inserting into Genre
INSERT INTO
    Genre (mpid, genre_name)
VALUES
    (1, 'Sci-Fi');

INSERT INTO
    Genre (mpid, genre_name)
VALUES
    (2, 'Action');

-- Inserting into Location
INSERT INTO
    Location (mpid, zip, city, country)
VALUES
    (1, '90001', 'Los Angeles', 'USA');

INSERT INTO
    Location (mpid, zip, city, country)
VALUES
    (2, 'E1 6AN', 'London', 'UK');