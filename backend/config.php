<?php
// ==========================================
// CozyLearn Configuration
// ==========================================


// ==========================================
// Gemini API Configuration
// ==========================================

define(
    "GEMINI_API_KEY",
    getenv("AQ.Ab8RN6JSdvA3moRoTs41Zd2P6JyRnxCY55m0FwOpxhFoviVP2Q")
);
echo "ENV KEY: ";
echo getenv("GEMINI_API_KEY");
exit;

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



