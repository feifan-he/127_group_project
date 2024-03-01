<?php include "head.php";?>

<body>
    <?php include "title.php";?>

    <div class="container">
        <form method="post" action="actors.php">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter minimum id" name="inputId">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="submitted">Query</button>
                </div>
            </div>
        </form>
    </div>
    <br>
    <div class="container">

        <?php

$columns = ['id', 'name', 'nationality', 'dob', 'gender'];
$columns_str = join(',', $columns);

if (isset($_POST['submitted'])) {
    $idLimit = $_POST["inputId"];
} else {
    $idLimit = 0;
}

$table = execute_query("SELECT $columns_str FROM People p JOIN Role r ON p.id = r.pid WHERE r.role_name = 'Actor' AND p.id >= $idLimit");

generate_table($columns, $table);

?>

    </div>
</body>