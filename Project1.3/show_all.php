<?php include "head.php";?>

<body>
    <?php include "title.php";?>

    <div class="container">
        <?php


$tables = [
    'MotionPicture' => ['id', 'name', 'rating', 'production', 'budget'],
    'User' => ['email', 'name', 'age'],
    'Likes' => ['mpid', 'uemail'],
    'Movie' => ['mpid', 'boxoffice_collection'],
    'Series' => ['mpid', 'season_count'],
    'People' => ['id', 'name', 'nationality', 'dob', 'gender'],
    'Role' => ['mpid', 'pid', 'role_name'],
    'Award' => ['mpid', 'pid', 'award_name', 'award_year'],
    'Genre' => ['mpid', 'genre_name'],
    'Location' => ['mpid', 'zip', 'city', 'country'],
];

foreach ($tables as $tableName => $columns) {
    $columns_str = join(',', $columns);
    $query = "SELECT $columns_str FROM $tableName";
    $tableData = execute_query($query); 
    echo "<h2>$tableName</h2>"; 
    generate_table($columns, $tableData);
}
?>
    </div>
</body>