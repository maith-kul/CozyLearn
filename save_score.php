<?php

require_once "backend/config.php";


if($_SERVER["REQUEST_METHOD"] == "POST")
{


$score = $_POST['score'];

$total = $_POST['total'];

$percentage = $_POST['percentage'];



$sql = "INSERT INTO quiz_scores
(score,total_questions,percentage)
VALUES
('$score','$total','$percentage')";


if(mysqli_query($conn,$sql))
{

echo "success";

}

else
{

echo "error";

}


}

?>