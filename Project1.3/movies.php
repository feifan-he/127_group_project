<?php include "head.php";?>

<body>
    <?php include "title.php";?>
    <div class="container">
        <form method="post" action="movies.php">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter minimum budget" name="inputBudget">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="submitted">Query</button>
                </div>
            </div>
        </form>

        <?php

$columns = ['boxoffice_collection', 'mpid', 'id', 'name', 'rating', 'production', 'budget'];
$columns_str = join(',', $columns);
if (isset($_POST['submitted'])) {
    $budgetLimit = $_POST["inputBudget"];
} else {
    $budgetLimit = 0;
}

$table = execute_query("SELECT $columns_str FROM Movie m JOIN MotionPicture mp ON m.mpid=mp.id WHERE mp.budget >= $budgetLimit");

generate_table($columns, $table);

?>

    </div>
    <div class="container">
        <h4> Find the movies that have been liked by a specific user’s email. </h4>
        <form method="post" action="movies.php">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter user email" name="inputEmail">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="submitted">Query</button>
                </div>
            </div>
        </form>

        <?php

$columns = ['name', 'rating', 'production', 'budget'];
$columns_str = join(',', $columns);
if (isset($_POST['submitted'])) {
    $userEmail = $_POST["inputEmail"];
} else {
    $userEmail = '';
}

$query = "SELECT mp.name, mp.rating, mp.production, mp.budget
                  FROM MotionPicture mp
                  JOIN Likes l ON mp.id = l.mpid
                  JOIN User u ON l.uemail = u.email
                  WHERE u.email = '$userEmail'";

$table = execute_query($query);

generate_table($columns, $table);

?>
    </div>
    <div class="container">
        <h4>Top 2 Rated Thriller Movies Shot Exclusively in Boston</h4>
        <?php
$queryThriller = "SELECT mp.name, mp.rating
                          FROM MotionPicture mp
                          JOIN Genre g ON mp.id = g.mpid
                          JOIN Location l ON mp.id = l.mpid
                          WHERE g.genre_name = 'thriller'
                          AND l.city = 'Boston'
                          GROUP BY mp.id
                          HAVING COUNT(DISTINCT l.city) = 1
                          ORDER BY mp.rating DESC
                          LIMIT 2;";

$thrillerMovies = execute_query($queryThriller);
generate_table(['name', 'rating'], $thrillerMovies);
?>
    </div>
    <div class="container">
        <h4>Movies with More Than "X" Likes by Users Under Age "Y"</h4>
        <form method="post" action="movies.php">
            <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="Enter likes threshold" name="likesThreshold">
                <input type="number" class="form-control" placeholder="Enter age limit" name="ageLimit">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="likesQuery">Query</button>
                </div>
            </div>
        </form>

        <?php
if (isset($_POST['likesQuery'])) {
    $ageLimit = $_POST['ageLimit'];
    $likesThreshold = $_POST['likesThreshold'];

    $queryLikes = "SELECT mp.name, COUNT(l.uemail) AS likes_count
                           FROM MotionPicture mp
                           JOIN Likes l ON mp.id = l.mpid
                           JOIN User u ON l.uemail = u.email
                           WHERE u.age < $ageLimit
                           GROUP BY mp.id
                           HAVING likes_count > $likesThreshold
                           ORDER BY likes_count DESC;";

    $likedMovies = execute_query($queryLikes);
    generate_table(['name', 'likes_count'], $likedMovies);
}
?>
    </div>
    <div class="container">
        <h4>Top 5 Movies with the Highest Number of People Playing a Role</h4>
        <?php
$queryTopRoles = "SELECT mp.name, COUNT(DISTINCT r.pid) AS people_count, COUNT(r.role_name) AS role_count
                  FROM MotionPicture mp
                  JOIN Role r ON mp.id = r.mpid
                  GROUP BY mp.id
                  ORDER BY people_count DESC, role_count DESC
                  LIMIT 5;";

$topRoleMovies = execute_query($queryTopRoles);
generate_table(['name', 'people_count', 'role_count'], $topRoleMovies);
?>
    </div>
    </div>
</body>