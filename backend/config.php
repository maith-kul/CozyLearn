<?php
// ==========================================
// CozyLearn Configuration
// ==========================================


// Gemini API Configuration

define(
    "GEMINI_API_KEY",
    "AQ.Ab8RN6LMaEh49Eceu27Z0tXgfOVSssvRcycptp6Nonjd5GWC4g"
);

define(
    "GEMINI_MODEL",
    "gemini-2.5-flash"
);



// Upload Folder

define(
    "UPLOAD_FOLDER",
    "../uploads/"
);



// Tesseract Path

define(
    "TESSERACT_PATH",
    "C:\\Program Files\\Tesseract-OCR\\tesseract.exe"
);



// Maximum Upload Size

define(
    "MAX_FILE_SIZE",
    20 * 1024 * 1024
);



// Allowed Extensions

$allowedExtensions = [
    "pdf",
    "txt",
    "docx",
    "png",
    "jpg",
    "jpeg",
    "webp",
    "bmp",
    "gif"
];

?>
