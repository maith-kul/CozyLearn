<?php

session_start();


// Check AI Result
if (!isset($_SESSION['ai_result'])) {

    header("Location: upload.php");
    exit;

}


$result = $_SESSION['ai_result'];



// Safety checks

$summary = $result['summary'] ?? "";

$important_points = is_array($result['important_points'] ?? null)
? $result['important_points']
: [];

$mcqs = is_array($result['mcqs'] ?? null)
? $result['mcqs']
: [];

$flashcards = is_array($result['flashcards'] ?? null)
? $result['flashcards']
: [];

$priority_topics = is_array($result['priority_topics'] ?? null)
? $result['priority_topics']
: [];

$revision_notes = $result['revision_notes'] ?? "";
$study_planner = $result['study_planner'] ?? [];


?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CozyLearn Results</title>


<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="css/results.css">


<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


</head>



<body>


<header class="navbar">

    <div class="logo">

   <img src="images/pandas/logo.png" class="logo-image" alt="CozyLearn Logo">

    <h2 class="logo-text">
        Cozy<span>Learn</span>
    </h2>

</div>


    <!-- Menu Section -->
   <button class="menu-toggle">
    ☰
</button>

<nav>

    <ul class="nav-links">

            <li>
                <a href="index.php#home">🏠Home</a>
            </li>

            <li>
                <a href="#features">✨Features</a>
            </li>

            <li>
                <a href="upload.php">📤Upload</a>
            </li>

            <li>
                <a href="#steps">⚡Working</a>
            </li>

            <li>
                <a href="#discover">🔍Discover</a>
            </li>

            <li>
                <a href="#footer">🐼About</a>
            </li>

        </ul>

    </nav>


</header>

<section class="result-container">


<h1>
🐼 CozyLearn AI Analysis
</h1>


<p class="success-text">

✨ Your notes have been analyzed successfully.

</p>





<div class="result-card">



<!-- SUMMARY -->

<?php if(!empty($summary)): ?>


<div class="result-section">


<h2>
📄 Summary
</h2>


<p>

<?= nl2br(htmlspecialchars($summary)); ?>

</p>


</div>


<?php endif; ?>







<!-- IMPORTANT POINTS -->


<?php if(!empty($important_points)): ?>


<div class="result-section">


<h2>
⭐ Important Points
</h2>


<ul>


<?php foreach($important_points as $point): ?>


<li>

<?= htmlspecialchars($point); ?>

</li>


<?php endforeach; ?>


</ul>


</div>


<?php endif; ?>








<!-- QUIZ -->


<?php if(!empty($mcqs)): ?>


<div class="result-section">


<h2>
🧠 Smart Quiz
</h2>



<div id="quiz-container">



<?php


$q = 1;


foreach($mcqs as $mcq):


$question = $mcq['question'] ?? "";

$options = $mcq['options'] ?? [];

$answer = $mcq['answer'] ?? "";

$explanation = $mcq['explanation'] ?? "No explanation available.";


?>



<div class="quiz-card">


<h3>

Q<?= $q ?>.

<?= htmlspecialchars($question); ?>


</h3>




<div class="options">



<?php foreach($options as $option): ?>


<button

class="option-btn"

data-answer="<?= htmlspecialchars($answer, ENT_QUOTES, 'UTF-8'); ?>"

data-explanation="<?= htmlspecialchars($explanation, ENT_QUOTES, 'UTF-8'); ?>"

onclick="checkAnswer(this)">


<?= htmlspecialchars($option); ?>


</button>



<?php endforeach; ?>


</div>



</div>



<?php

$q++;

endforeach;

?>


</div>


<button class="next-btn" onclick="nextQuestion()">

Next Question ➜

</button>



</div>



<?php endif; ?>


<!-- FLASHCARDS -->


<?php if(!empty($flashcards)): ?>


<div class="result-section">


<h2>
🃏 Flashcards
</h2>

<script>


let flashcards = <?= json_encode(
$flashcards,
JSON_HEX_TAG |
JSON_HEX_APOS |
JSON_HEX_QUOT |
JSON_HEX_AMP
); ?>;


</script>


<div class="flashcard-container">



<div class="flashcard" onclick="flipCard()">



<div class="flashcard-inner">


<div class="flashcard-front">


<h3 id="flash-question">

Loading...

</h3>


<p>

Click card to reveal answer 🐼

</p>


</div>

<div class="flashcard-back">


<h3>

💡 Answer

</h3>


<p id="flash-answer">

Loading...

</p>


</div>



</div>


</div>





<div class="flash-buttons">


<button onclick="previousCard()">

⬅ Previous

</button>


<button onclick="nextCard()">

Next ➡

</button>


</div>




<p id="flash-count"></p>




</div>


</div>



<?php endif; ?>


<!-- PRIORITY TOPICS -->


<?php if(!empty($priority_topics)): ?>


<div class="result-section">


<h2>
🔥 Priority Topics
</h2>




<?php if(!empty($priority_topics['high'])): ?>


<h3>
🔴 High Priority
</h3>


<ul>

<?php foreach($priority_topics['high'] as $topic): ?>

<li>
<?= htmlspecialchars($topic); ?>
</li>

<?php endforeach; ?>

</ul>


<?php endif; ?>





<?php if(!empty($priority_topics['medium'])): ?>


<h3>
🟡 Medium Priority
</h3>


<ul>

<?php foreach($priority_topics['medium'] as $topic): ?>

<li>
<?= htmlspecialchars($topic); ?>
</li>

<?php endforeach; ?>

</ul>


<?php endif; ?>





<?php if(!empty($priority_topics['low'])): ?>


<h3>
🟢 Low Priority
</h3>


<ul>

<?php foreach($priority_topics['low'] as $topic): ?>

<li>
<?= htmlspecialchars($topic); ?>
</li>

<?php endforeach; ?>

</ul>


<?php endif; ?>



</div>


<?php endif; ?>

<!-- ==========================
        STUDY PLANNER
=========================== -->


<?php if(!empty($study_planner)): ?>


<div class="result-section">


<h2>
📅 Smart Study Planner
</h2>



<h3>
🎯 Goal
</h3>


<p>
<?= htmlspecialchars($study_planner['goal'] ?? ""); ?>
</p>




<h3>
⏳ Duration
</h3>


<p>
<?= htmlspecialchars($study_planner['duration'] ?? ""); ?>
</p>




<h3>
📚 Plan
</h3>



<?php foreach($study_planner['plan'] ?? [] as $day): ?>


<div class="planner-card">


<h4>
<?= htmlspecialchars($day['day']); ?>
</h4>


<p>
<?= htmlspecialchars($day['task']); ?>
</p>


</div>


<?php endforeach; ?>



</div>


<?php endif; ?>

<!-- REVISION NOTES -->


<?php if(!empty($revision_notes)): ?>


<div class="result-section">


<h2>
⚡ Last Minute Revision Notes
</h2>


<p>

<?= nl2br(htmlspecialchars($revision_notes)); ?>

</p>


</div>


<?php endif; ?>





</div>

<a href="download_pdf.php" class="pdf-btn">

📄 Download Study Notes PDF

</a>




<a href="upload.php" class="back-btn">

⬅ Analyze More Notes

</a>

</section>



<!-- =========================
        FOOTER
========================= -->

<footer class="footer" id="footer">

    <div class="footer-container">

        <div class="footer-brand">

            <h2>🐼 CozyLearn</h2>

            <p>
                Study Smarter. Relax More.<br>
                Your AI-powered study companion.
            </p>

        </div>

        <div class="footer-fun">

            <div class="fun-card">
                📚 Free Forever
            </div>

            <div class="fun-card">
                🤖 Gemini AI Powered
            </div>

            <div class="fun-card">
                ⚡ Instant Revision
            </div>

           

        </div>


        

    </div>

    <hr>

    <p class="copyright">
        © 2026 CozyLearn • Made with 💜 for Students
    </p>

</footer>


<script src="js/results.js"></script>


</body>

</html>