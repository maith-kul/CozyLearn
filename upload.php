<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Upload Notes | CozyLearn</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/upload.css?v=999">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>

<!-- ==========================================
                NAVBAR
========================================== -->

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


<!-- ==========================================
            UPLOAD SECTION
========================================== -->

<section class="upload-page">

    <!-- ==================================
            LEFT SIDE
    =================================== -->

    <div class="upload-left">

        <h1>📂 Upload Your Study Notes</h1>
		<p>
			Upload your notes and let Panda generate summaries, quizzes,
			flashcards, important topics, and much more in seconds.
			<br><br>
			Supports: PDF, Word, PowerPoint, Excel, Text & Image files.
		</p>

        <form
            id="uploadForm"
            action="process.php"
            method="POST"
            enctype="multipart/form-data">

            <!-- Upload Box -->

            <div class="drop-zone">

				<input
				type="file"
				id="fileInput"
				name="study_file"
				accept=".txt,.pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.png,.jpg,.jpeg,.webp,.bmp,.gif"
				hidden>

                <label for="fileInput" class="upload-label">

                    <h2>📁 Drag & Drop Your Notes</h2>

                    <p>or click here to browse files</p>

                </label>

            </div>

            <!-- Selected File -->

            <div id="filePreview">

                No file selected

            </div>

            <h3>OR</h3>

            <!-- Paste Notes -->

            <textarea
                name="study_text"
                placeholder="Paste your study notes here..."></textarea>
					<h3>🐼 Tell Panda What You Need</h3>
					<p class="option-note">Choose multiple options for better results.</p>

            <div class="ai-options">

    <label>
        <input
            type="checkbox"
            name="features[]"
            value="summary">

        📄 Smart Summary
    </label>

    <label>
        <input
            type="checkbox"
            name="features[]"
            value="mcqs">

        📝 MCQs
    </label>

    <label>
        <input
            type="checkbox"
            name="features[]"
            value="flashcards">

        🧠 Flashcards
    </label>

    <label>
        <input
            type="checkbox"
            name="features[]"
            value="important">

        ⭐ Important Points
    </label>

    <label>
        <input
            type="checkbox"
            name="features[]"
            value="priority">

        🎯 Priority Topics
    </label>

    <label>
        <input
            type="checkbox"
            name="features[]"
            value="planner">

        📅 Study Planner
    </label>
	<div id="planner-duration-box" style="display:none;">

    <h3>⏳ How much time do you have?</h3>

    <input 
        type="text"
        name="planner_duration"
        placeholder="Example: 5 days, 2 weeks">

</div>

</div>

            <button
                type="submit"
                class="generate-btn">

                ✨ Generate Study Material

            </button>

        </form>

    </div>

    <!-- RIGHT SIDE STARTS BELOW -->
	    <!-- ==================================
            RIGHT SIDE
    =================================== -->

    <div class="upload-right">

        <!-- Panda -->

        <div class="panda-avatar">

            <img
                src="images/pandas/newpanda.jpg"
                alt="CozyLearn Panda">

        </div>

        <!-- Speech Box -->

        <div class="speech-box">

            <h3>🐼 Hi, Study Buddy!</h3>

            <p>

                Your notes look tired... let me give them a smart makeover! ✨📖

            </p>

        </div>

        <!-- Feature Boxes -->

        <div class="feature-boxes">

            <div class="feature-box">

                <span class="icon">🐼</span>

                <span>Learn with Ease</span>

            </div>

            <div class="feature-box">

                <span class="icon">⚡</span>

                <span>Revise in Seconds</span>

            </div>

            <div class="feature-box">

                <span class="icon">🧠</span>

                <span>Remember More</span>

            </div>

            <div class="feature-box">

                <span class="icon">📚</span>

                <span>Study with Confidence</span>

            </div>

            <div class="feature-box">

                <span class="icon">🎯</span>

                <span>Achieve Your Goals</span>

            </div>

        </div>

        <!-- AI Badge -->

        <div class="ai-badge">

            💜 Cozy Vibes. Clever Minds.
        </div>

    </div>

</section>

<!-- ==========================================
            LOADING POPUP
========================================== -->

<div
    id="loadingBox"
    class="loading-box">

    <img
        src="images/pandas/panda-reading.png"
        alt="Loading Panda">

    <h2>Analyzing your notes...</h2>

    <p>

        Panda AI is reading your notes and preparing
        personalized study material.

    </p>

</div>

<!-- ==========================================
                FOOTER
========================================== -->

<footer class="footer">

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

<!-- JavaScript -->

<script src="js/upload.js"></script>

</body>

</html>