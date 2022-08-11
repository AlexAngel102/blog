<?php

$db = "mysql:host=db;dbname=myapp";
$user = "Q_werty";
$pass = "Qwasz#112233";

$connection = new PDO($db, $user, $pass);
$selectAllPosts = "
    SELECT *
    FROM post
    INNER JOIN comment, post_rating, user
";

$rateCount = "
    SELECT rate_value 
    FROM post_rating
    ";

$rate = $connection->query($rateCount);
$rowRate = $rate->fetchAll();
$res = $connection->query($selectAllPosts);
$rows = $res->fetchAll(PDO::FETCH_ASSOC);

print_r($rowRate);

foreach ($rows as $row){
//    $rate = array_sum($rows['value'])/count($rows['value']);
    echo "
    <div>
    <span>{}</span>
    <div>
    <p class=\"text-left\">{$row['post']}</p>
    </div>
    <span>
    {$row['post_date']}
    </span>
    <span>{$row['user_name']}</span>
    </div>
    ";
}