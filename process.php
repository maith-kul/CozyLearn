<?php

session_start();

error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);

// ==========================================
// CozyLearn - Process Upload
// ==========================================

require_once __DIR__ . "/backend/config.php";
// require_once __DIR__ . "/backend/ocr.php";
require_once __DIR__ . "/backend/gemini.php";
require_once __DIR__ . "/backend/prompt.php";
require_once __DIR__ . "/backend/parser.php";

// ==========================================
// Only POST Request
// ==========================================

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid Request");
}

$notes = "";
$filePath = "";
$extension = "";

// ==========================================
// Uploaded File
// ==========================================

if (isset($_FILES['study_file']) && $_FILES['study_file']['error'] === UPLOAD_ERR_OK) {

    $file = $_FILES['study_file'];

    $uploadDir = UPLOAD_FOLDER;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = time() . "_" . basename($file['name']);
    $filePath = $uploadDir . $fileName;

    move_uploaded_file($file['tmp_name'], $filePath);

    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

    switch ($extension) {

        case "txt":
            $notes = extractTextFromTXT($filePath);
            break;

        case "pdf":
            $notes = extractTextFromPDF($filePath);
            break;

        case "doc":
        case "docx":
            $notes = extractTextFromDOCX($filePath);
            break;

        case "ppt":
        case "pptx":
            $notes = extractTextFromPPTX($filePath);
            break;

        case "xls":
        case "xlsx":
            $notes = extractTextFromXLSX($filePath);
            break;

        case "png":
        case "jpg":
        case "jpeg":
        case "gif":
        case "bmp":
        case "webp":
            $notes = extractTextFromImage($filePath);
            break;

        default:
            die("Unsupported File Type: " . $extension);

    }

}

// ==========================================
// Pasted Notes
// ==========================================

if (empty(trim($notes)) && !empty($_POST['study_text'])) {
    $notes = trim($_POST['study_text']);
}

// ==========================================
// Nothing Uploaded
// ==========================================

if (empty(trim($notes))) {
    die("Please upload a file or paste notes.");
}

// ==========================================
// Selected Features
// ==========================================

$features = $_POST['features'] ?? [];
$planner_duration = $_POST['planner_duration'] ?? "";

// ==========================================
// Build Prompt
// ==========================================

$prompt = buildPrompt(
    $notes,
    $features,
    $planner_duration
);

// ==========================================
// Ask Gemini
// ==========================================

$response = askGemini($prompt);

// ==========================================
// Parse Gemini Response
// ==========================================

$parsed = parseGeminiResponse($response);

if (!$parsed['success']) {

    echo "<pre>";
    print_r($parsed);
    echo "</pre>";
    exit;

}

// ==========================================
// Save Session
// ==========================================

$_SESSION['ai_result'] = $parsed['data'];

// ==========================================
// Redirect
// ==========================================

header("Location: results.php");
exit;

?>
