<?php include "head.php";?>

<body>
    <?php include "title.php";?>


    <div class="container">
        <form method="post" action="index.php">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter user email" name="inputEmail">
                <input type="text" class="form-control" placeholder="Enter movie mpid" name="inputMovie">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="submitted">Like</button>
                </div>
            </div>
        </form>




        <?php
if (isset($_POST['submitted'])) {
    $email = $_POST["inputEmail"];
    $movie = $_POST["inputMovie"];
    echo "INSERT INTO Likes (uemail, mpid) VALUES ($email, $movie);";
    execute_query("INSERT INTO Likes (uemail, mpid) VALUES ('$email', $movie);");
}

?>

    </div>
</body>