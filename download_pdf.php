<?php

session_start();

if (!isset($_SESSION['ai_result'])) {
    die("No AI Result Found.");
}

require_once __DIR__ . '/tcpdf/tcpdf.php';

$result = $_SESSION['ai_result'];

$pdf = new TCPDF();

$pdf->SetCreator('CozyLearn');
$pdf->SetAuthor('CozyLearn AI');
$pdf->SetTitle('Study Notes');
$pdf->SetMargins(15,20,15);
$pdf->SetAutoPageBreak(TRUE,20);

$pdf->AddPage();

$pdf->SetFont('dejavusans','B',20);
$pdf->SetTextColor(124,92,255);

$pdf->Cell(0,12,'CozyLearn AI Study Notes',0,1,'C');

$pdf->Ln(5);

$pdf->SetTextColor(0,0,0);

/* =========================
   SUMMARY
========================= */

if(!empty($result['summary'])){

    $pdf->SetFont('dejavusans','B',16);
    $pdf->SetTextColor(124,92,255);

    $pdf->Cell(0,10,'Summary',0,1);

    $pdf->SetFont('dejavusans','',12);
    $pdf->SetTextColor(0,0,0);

    $pdf->writeHTML(
        nl2br(htmlspecialchars($result['summary'])),
        true,
        false,
        true,
        false,
        ''
    );

    $pdf->Ln(8);

}
/* =========================
   IMPORTANT POINTS
========================= */

if(!empty($result['important_points'])){

    $pdf->SetFont('dejavusans','B',16);
    $pdf->SetTextColor(124,92,255);

    $pdf->Cell(0,10,'Important Points',0,1);

    $pdf->SetFont('dejavusans','',12);
    $pdf->SetTextColor(0,0,0);

    foreach($result['important_points'] as $point){

        $pdf->MultiCell(
            0,
            8,
            "• ".$point,
            0,
            'L'
        );

    }

    $pdf->Ln(6);

}


/* =========================
   SMART QUIZ
========================= */

if(!empty($result['mcqs'])){

    $pdf->SetFont('dejavusans','B',16);
    $pdf->SetTextColor(124,92,255);

    $pdf->Cell(0,10,'Smart Quiz',0,1);

    $pdf->SetTextColor(0,0,0);

    $number = 1;

    foreach($result['mcqs'] as $mcq){

        $pdf->SetFont('dejavusans','B',12);

        $pdf->MultiCell(
            0,
            8,
            "Q".$number.". ".$mcq['question'],
            0,
            'L'
        );

        $pdf->SetFont('dejavusans','',11);

        foreach($mcq['options'] as $option){

            $pdf->MultiCell(
                0,
                7,
                "○ ".$option,
                0,
                'L'
            );

        }

        $pdf->SetTextColor(0,130,0);

        $pdf->MultiCell(
            0,
            8,
            "Correct Answer : ".$mcq['answer'],
            0,
            'L'
        );

        $pdf->SetTextColor(90,90,90);

        if(!empty($mcq['explanation'])){

            $pdf->MultiCell(
                0,
                8,
                "Explanation : ".$mcq['explanation'],
                0,
                'L'
            );

        }

        $pdf->SetTextColor(0,0,0);

        $pdf->Ln(5);

        $number++;

    }

}
/* =========================
   FLASHCARDS
========================= */

if(!empty($result['flashcards'])){

    $pdf->SetFont('dejavusans','B',16);
    $pdf->SetTextColor(124,92,255);

    $pdf->Cell(0,10,'Flashcards',0,1);

    $pdf->SetTextColor(0,0,0);

    $count = 1;

    foreach($result['flashcards'] as $card){

        $pdf->SetFont('dejavusans','B',12);
        $pdf->Cell(0,8,"Flashcard ".$count,0,1);

        $pdf->SetFont('dejavusans','',11);

        $pdf->MultiCell(
            0,
            8,
            "Question : ".$card['question'],
            0,
            'L'
        );

        $pdf->MultiCell(
            0,
            8,
            "Answer : ".$card['answer'],
            0,
            'L'
        );

        $pdf->Ln(4);

        $count++;

    }

}


/* =========================
   PRIORITY TOPICS
========================= */

if(!empty($result['priority_topics'])){

    $pdf->SetFont('dejavusans','B',16);
    $pdf->SetTextColor(124,92,255);

    $pdf->Cell(0,10,'Priority Topics',0,1);

    $pdf->SetTextColor(0,0,0);

    foreach([
        'high'=>'High Priority',
        'medium'=>'Medium Priority',
        'low'=>'Low Priority'
    ] as $key=>$title){

        if(!empty($result['priority_topics'][$key])){

            $pdf->SetFont('dejavusans','B',13);

            $pdf->Cell(0,8,$title,0,1);

            $pdf->SetFont('dejavusans','',11);

            foreach($result['priority_topics'][$key] as $topic){

                $pdf->MultiCell(
                    0,
                    7,
                    "• ".$topic,
                    0,
                    'L'
                );

            }

            $pdf->Ln(3);

        }

    }

}


/* =========================
   REVISION NOTES
========================= */

if(!empty($result['revision_notes'])){

    $pdf->SetFont('dejavusans','B',16);
    $pdf->SetTextColor(124,92,255);

    $pdf->Cell(0,10,'Revision Notes',0,1);

    $pdf->SetFont('dejavusans','',11);
    $pdf->SetTextColor(0,0,0);

    $pdf->writeHTML(
        nl2br(htmlspecialchars($result['revision_notes'])),
        true,
        false,
        true,
        false,
        ''
    );

    $pdf->Ln(8);

}
/* =========================
   SMART STUDY PLANNER
========================= */

if (!empty($result['study_planner'])) {

    $planner = $result['study_planner'];

    $pdf->SetFont('dejavusans','B',16);
    $pdf->SetTextColor(124,92,255);
    $pdf->Cell(0,10,'Smart Study Planner',0,1);

    $pdf->SetTextColor(0,0,0);

    // Goal
    $pdf->SetFont('dejavusans','B',13);
    $pdf->Cell(0,8,'Goal',0,1);

    $pdf->SetFont('dejavusans','',11);
    $pdf->MultiCell(0,8,$planner['goal']);
    $pdf->Ln(3);

    // Duration
    $pdf->SetFont('dejavusans','B',13);
    $pdf->Cell(0,8,'Duration',0,1);

    $pdf->SetFont('dejavusans','',11);
    $pdf->Cell(0,8,$planner['duration'].' Days',0,1);
    $pdf->Ln(5);

    // Study Plan
    $pdf->SetFont('dejavusans','B',13);
    $pdf->Cell(0,8,'Study Plan',0,1);

    foreach ($planner['plan'] as $dayPlan) {

        $pdf->SetFont('dejavusans','B',12);
        $pdf->SetTextColor(124,92,255);
        $pdf->Cell(0,8,$dayPlan['day'],0,1);

        $pdf->SetFont('dejavusans','',11);
        $pdf->SetTextColor(0,0,0);

        $pdf->MultiCell(
    0,
    8,
    "• " . trim(preg_replace('/\s+/', ' ', $dayPlan['task'])),
    0,
    'L',
    false,
    1
);

        $pdf->Ln(3);
    }

    $pdf->Ln(5);
}
/* =========================
   FOOTER
========================= */

$pdf->Ln(5);

$pdf->SetDrawColor(220,220,220);
$pdf->Line(15,$pdf->GetY(),195,$pdf->GetY());

$pdf->Ln(6);

$pdf->SetFont('dejavusans','I',10);
$pdf->SetTextColor(120,120,120);

$pdf->Cell(
    0,
    8,
    "Generated by CozyLearn AI | ".date("d M Y"),
    0,
    1,
    'C'
);

$pdf->Output("CozyLearn_Study_Notes.pdf","D");
exit;