<?php

/**
 * ==========================================
 * CozyLearn JSON Parser
 * ==========================================
 * Extracts Gemini response and converts it
 * into PHP associative array.
 * ==========================================
 */


function parseGeminiResponse($response)
{


    // Decode Gemini API response

    $geminiData = json_decode($response, true);



    if(!$geminiData)
    {

        return [

            "success"=>false,
            "error"=>"Invalid Gemini API Response"

        ];

    }




    // Extract AI generated text

    $text = 
    $geminiData['candidates'][0]['content']['parts'][0]['text']
    ?? "";





   if(empty($text))
{

    return [

        "success"=>false,
        "error"=>"Empty AI Response",

        "FULL_GEMINI_RESPONSE"=>$geminiData

    ];

}





    // Remove markdown if Gemini adds it

    $text = trim($text);


    $text = preg_replace('/```json/i','',$text);

    $text = str_replace("```","",$text);


    $text = trim($text);





    // Convert AI JSON into PHP array

    $result = json_decode($text,true);





    if(json_last_error() !== JSON_ERROR_NONE)
    {

        return [

            "success"=>false,

            "error"=>"AI JSON Parsing Failed : "
            .json_last_error_msg(),

            "raw_response"=>$text

        ];

    }





    return [

        "success"=>true,

        "data"=>$result

    ];

}


?>