<?php

// ==========================================
// CozyLearn AI Prompt Builder
// ==========================================

function buildPrompt(
    $notes,
    $features = [],
    $planner_duration = ""
)
{

    // ==========================================
    // Decide number of MCQs based on content
    // ==========================================

    $wordCount = str_word_count(strip_tags($notes));

	   if ($wordCount <= 1200)   // Up to ~3 pages
	{
		$mcqCount = 5;
	}
	elseif ($wordCount <= 2500)   // ~4–6 pages
	{
		$mcqCount = 10;
	}
	else   // 7+ pages
	{
		$mcqCount = 15;
	}


    $requirements = "";

    $jsonFormat = "{\n";


    // Summary
    if(in_array("summary",$features))
    {
        $requirements .= "- Generate a clear summary\n";

        $jsonFormat .= '
        "summary":"",
        ';
    }


    // Important Points
    if(in_array("important",$features))
    {
        $requirements .= "- Generate important points\n";

        $jsonFormat .= '
        "important_points":[],
        ';
    }


    // MCQs
    if(in_array("mcqs",$features))
    {
        $requirements .= "
- Generate exactly {$mcqCount} multiple-choice questions.
- Each MCQ must contain:
  - Question
  - Four options
  - Correct answer
  - Explanation
";


        $jsonFormat .= '
        "mcqs":[
            {
                "question":"",
                "options":[
                    "",
                    "",
                    "",
                    ""
                ],
                "answer":"",
                "explanation":""
            }
        ],
        ';
    }


    // Flashcards
    if(in_array("flashcards",$features))
    {
        $requirements .= "- Generate flashcards with question and answer\n";

        $jsonFormat .= '
        "flashcards":[
            {
                "question":"",
                "answer":""
            }
        ],
        ';
    }


    // Priority Topics
    if(in_array("priority",$features))
    {
        $requirements .= "- Generate priority topics with high medium low categories\n";

        $jsonFormat .= '
        "priority_topics":{
            "high":[],
            "medium":[],
            "low":[]
        },
        ';
    }


    // Planner
    if(in_array("planner",$features))
    {
       $requirements .=
"- Generate a study planner for {$planner_duration} days.\n".
"- Each day's task must be ONE short sentence (maximum 15 words).\n".
"- Start each task with an action verb like Read, Revise, Practice, Solve, or Review.\n".
"- Do NOT write paragraphs.\n".
"- Do NOT insert extra spaces or blank lines.\n";


        $jsonFormat .= '
        "study_planner":{
            "goal":"",
            "duration":"",
            "plan":[
                {
                    "day":"",
                    "task":""
                }
            ]
        },
        ';
    }


    // If no feature selected
    if(empty($features))
    {
        $requirements = "
        - Generate summary
        - Generate important points
        - Generate MCQs
        - Generate flashcards
        - Generate priority topics
        ";


        $jsonFormat .= '
        "summary":"",
        "important_points":[],
        "mcqs":[],
        "flashcards":[],
        "priority_topics":{
            "high":[],
            "medium":[],
            "low":[]
        }
        ';
    }


    // Remove extra comma
    $jsonFormat = rtrim($jsonFormat,",\n");

    $jsonFormat .= "\n}";


    $prompt = <<<PROMPT

You are CozyLearn AI, an intelligent study assistant.

Analyze the study notes below.

IMPORTANT RULES:

1. Return ONLY valid JSON.
2. Do not return markdown.
3. Do not write explanations outside JSON.
4. Generate ONLY requested features.
5. Do not create empty fields that were not requested.

Requested Features:

$requirements


Return JSON in this format:

$jsonFormat


IMPORTANT:

Generate exactly the requested number of MCQs.
Do NOT generate fewer questions.
If notes are long, cover different topics instead of repeating the same concept.


Study Notes:

$notes

PROMPT;


    return $prompt;

}

?>