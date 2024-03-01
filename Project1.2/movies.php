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
</body>