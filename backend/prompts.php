<?php


function buildPrompt($notes)
{

    return <<<PROMPT

You are CozyLearn AI, an expert study assistant.

Analyze the given study notes.

IMPORTANT:
Return ONLY valid JSON.
Do not use markdown.
Do not add ```json.
Do not write anything outside JSON.


JSON FORMAT:


{
    "summary": "Short summary of notes",

    "important_points": [
        "Important point 1",
        "Important point 2"
    ],

    "mcqs": [
        {
            "question": "Question",
            "options": [
                "Option A",
                "Option B",
                "Option C",
                "Option D"
            ],
            "answer": "Correct option text",
            "explanation": "Explanation"
        }
    ],

    "flashcards": [
        {
            "question": "Term",
            "answer": "Meaning"
        }
    ],

    "priority_topics": {
        "high": [],
        "medium": [],
        "low": []
    },

    "revision_notes": "Quick revision notes"
}


Study Notes:

$notes


PROMPT;

}


?>