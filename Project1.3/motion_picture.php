<?php include "head.php";?>

<body>
    <?php include "title.php";?>

    <div class="container">
        <h4> Find the Motion Picture by Motion Picture Name. </h4>
        <form method="post" action="">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter Motion Picture name"
                    name="motionPictureName">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="submitted">Search</button>
                </div>
            </div>
        </form>

        <?php

$columns = ['name', 'rating', 'production', 'budget'];
$columns_str = join(',', $columns);

if (isset($_POST['submitted'])) {
    $motionPictureName = $_POST["motionPictureName"];
    $table = execute_query("SELECT $columns_str FROM MotionPicture mp WHERE mp.name = '$motionPictureName'");
    generate_table($columns, $table);
}

?>

        <form method="post" action="">
            <h4> Find the Motion Picture by Shooting Location Country. </h4>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter Shooting Location Country"
                    name="locationCountry">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="submitted">Search</button>
                </div>
            </div>
        </form>

        <?php

$columns = ['name'];
$columns_str = join(',', $columns);

if (isset($_POST['submitted'])) {
    $locationCountry = $_POST["locationCountry"];
    $table = execute_query("SELECT DISTINCT mp.name
    FROM MotionPicture mp
    JOIN Location l ON mp.id = l.mpid
    WHERE l.country = '$locationCountry'");
    generate_table($columns, $table);
}

?>


        <h4> Motion Pictures that have a higher rating than the average rating of all comedy Motion
            Pictures. </h4>

        <?php

$columns = ['name', 'ratings'];
$columns_str = join(',', $columns);

$table = execute_query("SELECT mp.name, mp.rating
    FROM MotionPicture mp
    WHERE mp.rating > (
        SELECT AVG(mp_comedy.rating)
        FROM MotionPicture mp_comedy
        JOIN Genre g ON mp_comedy.id = g.mpid
        WHERE g.genre_name = 'Comedy'
    )
    ORDER BY mp.rating DESC;
    ");
generate_table($columns, $table);

?>

    </div>
</body>