CREATE TABLE
    MotionPicture (
        id INT PRIMARY KEY,
        name VARCHAR(255),
        rating FLOAT CHECK (
            rating >= 0
            AND rating <= 10
        ),
        production VARCHAR(255),
        budget DECIMAL(15, 2)
    );

CREATE TABLE
    User (
        email VARCHAR(255) PRIMARY KEY,
        name VARCHAR(255),
        age INT
    );

CREATE TABLE
    Likes (
        uemail VARCHAR(255),
        mpid INT,
        PRIMARY KEY (uemail, mpid),
        FOREIGN KEY (uemail) REFERENCES User (email),
        FOREIGN KEY (mpid) REFERENCES MotionPicture (id)
    );

CREATE TABLE
    Movie (
        mpid INT PRIMARY KEY,
        boxoffice_collection DECIMAL(15, 2),
        FOREIGN KEY (mpid) REFERENCES MotionPicture (id)
    );

CREATE TABLE
    Series (
        mpid INT PRIMARY KEY,
        season_count INT,
        FOREIGN KEY (mpid) REFERENCES MotionPicture (id)
    );

CREATE TABLE
    People (
        id INT PRIMARY KEY,
        name VARCHAR(255),
        nationality VARCHAR(255),
        dob DATE,
        gender ENUM ('male', 'female', 'other')
    );

CREATE TABLE
    Role (
        mpid INT,
        pid INT,
        role_name VARCHAR(255),
        PRIMARY KEY (mpid, pid),
        FOREIGN KEY (mpid) REFERENCES MotionPicture (id),
        FOREIGN KEY (pid) REFERENCES People (id)
    );

CREATE TABLE
    Award (
        mpid INT,
        pid INT,
        award_name VARCHAR(255),
        award_year YEAR,
        PRIMARY KEY (mpid, pid, award_name, award_year),
        FOREIGN KEY (mpid) REFERENCES MotionPicture (id),
        FOREIGN KEY (pid) REFERENCES People (id)
    );

CREATE TABLE
    Genre (
        mpid INT,
        genre_name VARCHAR(255),
        PRIMARY KEY (mpid, genre_name),
        FOREIGN KEY (mpid) REFERENCES MotionPicture (id)
    );

CREATE TABLE
    Location (
        mpid INT,
        zip VARCHAR(20),
        city VARCHAR(255),
        country VARCHAR(255),
        PRIMARY KEY (mpid, zip),
        FOREIGN KEY (mpid) REFERENCES MotionPicture (id)
    );