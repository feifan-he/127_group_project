<?php include "head.php";?>

<body>
    <?php include "title.php";?>

    <div class="container">

        <form method="post" action="">
            <h4> Find Directors of TV Series by Shooting Location Zip Code. </h4>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter Shooting Location Zip Code"
                    name="locationZip">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="submitted">Search</button>
                </div>
            </div>
        </form>


        <?php

$columns = ['director name', 'TV series name'];
$columns_str = join(',', $columns);

if (isset($_POST['submitted'])) {
    $locationZip = $_POST["locationZip"];
    $table = execute_query("SELECT DISTINCT p.name AS director_name, mp.name AS series_name
    FROM People p
    JOIN Role r ON p.id = r.pid
    JOIN MotionPicture mp ON r.mpid = mp.id
    JOIN Location l ON mp.id = l.mpid
    WHERE l.zip = '$locationZip'
    AND r.role_name = 'Director'
    AND EXISTS (SELECT 1 FROM Series s WHERE s.mpid = mp.id);
    ");
    generate_table($columns, $table);
}

?>


        <form method="post" action="">
            <h4> Find the people who have received more than k awardsforasinglemotion picture in the same year.
            </h4>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter number of awards" name="kAwards">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="submitted">Search</button>
                </div>
            </div>
        </form>


        <?php

$columns = ['person name', 'motion picture name', 'award year', 'award count'];
$columns_str = join(',', $columns);

if (isset($_POST['submitted'])) {
    $kAwards = $_POST["kAwards"];
    $table = execute_query("SELECT p.name AS person_name, mp.name AS motion_picture_name, a.award_year, COUNT(a.award_name) AS award_count
    FROM People p
    JOIN Award a ON p.id = a.pid
    JOIN MotionPicture mp ON a.mpid = mp.id
    GROUP BY p.name, mp.name, a.award_year
    HAVING COUNT(a.award_name) > '$kAwards';
    ");
    generate_table($columns, $table);
}

?>

    </div>
    <div class="container">
        <h4>American Producers who had a box office collection of more than or equal to “X” with a
            budget less than or equal to “Y”</h4>
        <form method="post" action="">
            <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="Enter minimum box office collection"
                    name="boxOfficeCollection">
                <input type="number" class="form-control" placeholder="Enter maximum budget" name="budget">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="submitted">Query</button>
                </div>
            </div>
        </form>

        <?php
$columns = ['producer name', 'movie name', 'box office collection', 'budget'];
$columns_str = join(',', $columns);

if (isset($_POST['submitted'])) {

    $boxOfficeCollection = floatval($_POST["boxOfficeCollection"]);
    $budget = intval($_POST["budget"]);

    $table = execute_query("SELECT p.name AS producer_name, mp.name AS movie_name, m.boxoffice_collection, mp.budget
    FROM People p
    JOIN Role r ON p.id = r.pid
    JOIN MotionPicture mp ON r.mpid = mp.id
    JOIN Movie m ON mp.id = m.mpid
    WHERE p.nationality = 'USA'
    AND r.role_name = 'Producer'
    AND m.boxoffice_collection >= 500000000.00
    AND mp.budget <= 200000000
    ");
    generate_table($columns, $table);
}

?>


    </div>
    <div class="container">
        <h4>People who have played multiple roles in a motion picture where the rating is more than “X”</h4>
        <form method="post" action="">
            <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="Enter minimum rating" name="rating">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="submitted">Query</button>
                </div>
            </div>
        </form>

        <?php
$columns = ['person name', 'motion picture name ', 'number of roles'];
$columns_str = join(',', $columns);

if (isset($_POST['submitted'])) {
    $rating = floatval($_POST["rating"]);
    $table = execute_query("SELECT p.name AS PersonName, mp.name AS MotionPictureName, COUNT(r.role_name) AS NumberOfRoles
    FROM People p
    JOIN Role r ON p.id = r.pid
    JOIN MotionPicture mp ON r.mpid = mp.id
    WHERE mp.rating > $rating
    GROUP BY p.id, mp.id
    HAVING COUNT(r.role_name) > 1
    ORDER BY p.name, mp.name;
    ");
    generate_table($columns, $table);
}
?>



    </div>
</body>