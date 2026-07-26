<?php


require_once __DIR__ . "/config.php";



/**
 * ==========================================
 * CozyLearn Gemini AI
 * ==========================================
 */


function askGemini($prompt)
{


    $apiKey = getenv("GEMINI_API_KEY");


    if(empty($apiKey))
    {

        die("Gemini API Key Missing");

    }



    $model = GEMINI_MODEL;



    $url =
    "https://generativelanguage.googleapis.com/v1beta/models/"
    .$model.
    ":generateContent?key="
    .$apiKey;





    $data = [

        "contents"=>[

            [

                "parts"=>[

                    [

                        "text"=>$prompt

                    ]

                ]

            ]

        ],


        "generationConfig"=>[

            "temperature"=>0.4

        ]

    ];





    $ch = curl_init($url);



    curl_setopt(
        $ch,
        CURLOPT_RETURNTRANSFER,
        true
    );


    curl_setopt(
        $ch,
        CURLOPT_POST,
        true
    );


    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        [

            "Content-Type: application/json"

        ]
    );


    curl_setopt(
        $ch,
        CURLOPT_POSTFIELDS,
        json_encode($data)
    );




    $response = curl_exec($ch);




    if(curl_errno($ch))
    {

        die(
            "Curl Error : "
            .curl_error($ch)
        );

    }




    curl_close($ch);



   echo "<pre>";
echo "URL:\n";
echo $url;
echo "\n\nRESPONSE:\n";
echo $response;
echo "</pre>";
exit;



}


?>
