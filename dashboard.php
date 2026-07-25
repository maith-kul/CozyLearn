<?php

session_start();

?>

<!DOCTYPE html>
<html>

<head>

<title>🐼 CozyLearn Dashboard</title>

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="css/dashboard.css">

</head>


<body>


<header>

<nav class="navbar">

<div class="logo">

<img src="images/pandas/panda-wave.png">

<h2>CozyLearn</h2>

</div>


<ul class="nav-links">

<li>
<a href="index.php">Home</a>
</li>


<li>
<a href="upload.php">Upload</a>
</li>


<li>
<a href="dashboard.php">Dashboard</a>
</li>


</ul>

</nav>

</header>



<section class="dashboard-container">


<h1>🐼 Your Learning Dashboard</h1>



<div class="stats">


<div class="stat-card">

<h2>0</h2>

<p>Total Quiz</p>

</div>



<div class="stat-card">

<h2>0%</h2>

<p>Average Score</p>

</div>




<div class="stat-card">

<h2>0%</h2>

<p>Best Score</p>

</div>


</div>




<div class="chart-box">

<h2>📈 Learning Progress</h2>

<p>Your quiz progress will appear here.</p>


</div>



</section>


</body>

</html>