<?php include "head.php";?>

<body>
    <?php include "title.php";?>

    <div class="container">
        <h4>Youngest and Oldest Actors to Win at Least One Award</h4>
        <?php
$queryAwards = "SELECT p.name, a.award_year - YEAR(p.dob) AS age
                        FROM People p
                        JOIN Role r ON p.id = r.pid
                        JOIN Award a ON p.id = a.pid
                        WHERE r.role_name = 'Actor'
                        GROUP BY p.id
                        HAVING age = (
                            SELECT MIN(a.award_year - YEAR(p.dob))
                            FROM People p
                            JOIN Role r ON p.id = r.pid
                            JOIN Award a ON p.id = a.pid
                            WHERE r.role_name = 'Actor'
                        ) OR age = (
                            SELECT MAX(a.award_year - YEAR(p.dob))
                            FROM People p
                            JOIN Role r ON p.id = r.pid
                            JOIN Award a ON p.id = a.pid
                            WHERE r.role_name = 'Actor'
                        )
                        ORDER BY age;";

$awardWinningActors = execute_query($queryAwards);
generate_table(['name', 'age'], $awardWinningActors);
?>
    </div>
    <div class="container">
        <h4>Actors Who Have Played a Role in Both "Marvel" and "Warner Bros" Productions</h4>
        <?php
$queryMarvelWarner = "SELECT DISTINCT p.name AS actor_name, mp.name AS movie_name
                              FROM People p
                              JOIN Role r ON p.id = r.pid
                              JOIN MotionPicture mp ON r.mpid = mp.id
                              WHERE p.id IN (
                                  SELECT p.id
                                  FROM People p
                                  JOIN Role r ON p.id = r.pid
                                  JOIN MotionPicture mp ON r.mpid = mp.id
                                  WHERE mp.production = 'Marvel'
                                  INTERSECT
                                  SELECT p.id
                                  FROM People p
                                  JOIN Role r ON p.id = r.pid
                                  JOIN MotionPicture mp ON r.mpid = mp.id
                                  WHERE mp.production = 'Warner Bros'
                              )
                              ORDER BY p.name, mp.name;";

$marvelWarnerActors = execute_query($queryMarvelWarner);
generate_table(['actor_name', 'movie_name'], $marvelWarnerActors);
?>
    </div>
    <div class="container">
        <h4>Actors Who Share the Same Birthday</h4>
        <?php
$querySharedBirthdays = "SELECT DISTINCT p1.name AS actor1, p2.name AS actor2, p1.dob AS common_birthday
                                 FROM People p1
                                 JOIN People p2 ON p1.dob = p2.dob AND p1.id < p2.id
                                 JOIN Role r1 ON p1.id = r1.pid
                                 JOIN Role r2 ON p2.id = r2.pid
                                 WHERE r1.role_name = 'Actor' AND r2.role_name = 'Actor'
                                 ORDER BY p1.dob;";

$sharedBirthdayActors = execute_query($querySharedBirthdays);
generate_table(['actor1', 'actor2', 'common_birthday'], $sharedBirthdayActors);
?>
    </div>
</body>