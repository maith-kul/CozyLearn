

<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once "config.php";

use Smalot\PdfParser\Parser;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpPresentation\IOFactory as PPTFactory;
use PhpOffice\PhpSpreadsheet\IOFactory as SpreadsheetFactory;

/**
 * ==========================================
 * CozyLearn OCR & Text Extraction
 * ==========================================
 */


/* ==========================================
   IMAGE OCR
========================================== */

function extractTextFromImage($imagePath)
{
    if (!file_exists($imagePath)) {
        return "";
    }

    $outputFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "ocr_" . uniqid();

    $command =
        '"' . TESSERACT_PATH . '" "' .
        $imagePath .
        '" "' .
        $outputFile .
        '" --oem 3 --psm 6 -l eng';

    exec($command);

    if (file_exists($outputFile . ".txt")) {

        $text = file_get_contents($outputFile . ".txt");

        unlink($outputFile . ".txt");

        return trim($text);

    }

    return "";
}


/* ==========================================
   TXT
========================================== */

function extractTextFromTXT($filePath)
{
    return trim(file_get_contents($filePath));
}


/* ==========================================
   PDF
========================================== */

function extractTextFromPDF($filePath)
{
    try {

        $parser = new Parser();

        $pdf = $parser->parseFile($filePath);

        return trim($pdf->getText());

    } catch (Exception $e) {

        return "";

    }
}


/* ==========================================
   DOCX
========================================== */

function extractTextFromDOCX($filePath)
{
    try {

        $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath);

        $text = "";

        foreach ($phpWord->getSections() as $section) {

            foreach ($section->getElements() as $element) {

                // Normal text
                if ($element instanceof \PhpOffice\PhpWord\Element\Text) {

                    $text .= $element->getText() . "\n";

                }

                // TextRun (contains multiple text elements)
                elseif ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {

                    foreach ($element->getElements() as $textElement) {

                        if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {

                            $text .= $textElement->getText() . " ";

                        }

                    }

                    $text .= "\n";

                }

            }

        }

        return trim($text);

    }
    catch (Exception $e) {

        return "";

    }
}

/* ==========================================
   PPT / PPTX
========================================== */

function extractTextFromPPTX($filePath)
{
    $zip = new ZipArchive();

    if ($zip->open($filePath) === TRUE) {

        $text = "";

        for ($i = 1; ; $i++) {

            $slideName = "ppt/slides/slide" . $i . ".xml";

            $index = $zip->locateName($slideName);

            if ($index === false) {
                break;
            }

            $xml = $zip->getFromIndex($index);

            $dom = new DOMDocument();
            @$dom->loadXML($xml);

            $texts = $dom->getElementsByTagName("t");

            foreach ($texts as $node) {
                $text .= $node->nodeValue . " ";
            }

            $text .= "\n\n";
        }

        $zip->close();

        return trim($text);
    }

    return "";
}


/* ==========================================
   XLSX
========================================== */

function extractTextFromXLSX($filePath)
{
    try {

        $spreadsheet = SpreadsheetFactory::load($filePath);

        $text = "";

        foreach ($spreadsheet->getWorksheetIterator() as $sheet) {

            foreach ($sheet->toArray() as $row) {

                foreach ($row as $cell) {

                    $text .= $cell . " ";

                }

                $text .= "\n";

            }

        }

        return trim($text);

    }
    catch (Exception $e) {

        return "";

    }
}

?>