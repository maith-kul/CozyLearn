<?php
// ==========================================
// CozyLearn Configuration
// ==========================================


// ==========================================
// Gemini API Configuration
// ==========================================

define(
    "GEMINI_API_KEY",
    getenv("GEMINI_API_KEY")
);


define(
    "GEMINI_MODEL",
    "gemini-2.5-flash"
);


// ==========================================
// Upload Folder
// ==========================================

define(
    "UPLOAD_FOLDER",
    "uploads/"
);


// ==========================================
// Tesseract Path
// ==========================================
// Render Linux path

define(
    "TESSERACT_PATH",
    "/usr/bin/tesseract"
);


// ==========================================
// Maximum Upload Size
// ==========================================

define(
    "MAX_FILE_SIZE",
    20 * 1024 * 1024
);


// ==========================================
// Allowed Extensions
// ==========================================

$allowedExtensions = [
    "pdf",
    "txt",
    "doc",
    "docx",
    "ppt",
    "pptx",
    "xls",
    "xlsx",
    "png",
    "jpg",
    "jpeg",
    "webp",
    "bmp",
    "gif"
];

?>



