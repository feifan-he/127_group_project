<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Bootstrap JS dependencies -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSI 127b</title>
</head>

<body>




    <?php

// generic table builder. It will automatically build table data rows irrespective of result
class TableRows extends RecursiveIteratorIterator
{
    public function __construct($it)
    {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    public function current()
    {
        return "<td style='text-align:center'>" . parent::current() . "</td>";
    }
    public function beginChildren()
    {
        echo "<tr>";
    }
    public function endChildren()
    {
        echo "</tr>" . "\n";
    }
}

function execute_query($query)
{
    try {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "COSI127b";

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare statement for executions. This part needs to change for every query
        $stmt = $conn->prepare($query);

        // execute statement
        $stmt->execute();

        // set the resulting array to associative.
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    return new TableRows(new RecursiveArrayIterator($stmt->fetchAll()));

}

function generate_table($columns, $table)
{
    echo "<table class='table table-md table-bordered'><thead class='thead-dark' style='text-align: center'><tr>";

    foreach ($columns as $col) {
        echo "<th class='col-md-2'>$col</th>";
    }

    echo "</tr></thead>";
    foreach ($table as $k => $v) {
        echo $v;
    }

    echo "</table>";
}

?>