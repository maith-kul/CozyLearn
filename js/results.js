// ===============================
// CozyLearn Results JS
// ===============================


// ===============================
// QUIZ SYSTEM
// ===============================


let currentQuestion = 0;
let score = 0;


const questions = document.querySelectorAll(".quiz-card");





function showQuestion(){


    questions.forEach((question,index)=>{


        question.style.display =
        index === currentQuestion
        ? "block"
        : "none";


    });


}





function normalize(text){

    return text
    .toLowerCase()
    .replace(/^[a-d][\.\)]\s*/,"")
    .replace(/^option\s*[a-d][\.\)]?\s*/i,"")
    .trim();

}







function checkAnswer(button){



    const correctAnswer =
    normalize(button.dataset.answer);



    const explanation =
    button.dataset.explanation;



    const options =
    button.parentElement.querySelectorAll(".option-btn");



    options.forEach(btn=>{

        btn.disabled=true;

    });




    const selected =
    normalize(button.innerText);



    let correct=false;



    // Direct text match

    if(selected === correctAnswer){

        correct=true;

    }




    // Check A/B/C/D answer

    let correctIndex=-1;



    options.forEach((btn,index)=>{


        let letter =
        String.fromCharCode(97+index);



        if(
            correctAnswer === letter ||
            correctAnswer === "option "+letter
        ){

            correctIndex=index;

        }


    });





    if(correctIndex!==-1){


        if(button === options[correctIndex]){

            correct=true;

        }


    }







    if(correct){


        button.classList.add("correct");

        score++;


    }

    else{


        button.classList.add("wrong");



        // highlight correct answer


        if(correctIndex!==-1){


            options[correctIndex]
            .classList.add("correct");


        }
        else{


            options.forEach(btn=>{


                if(
                    normalize(btn.innerText)
                    === correctAnswer
                ){

                    btn.classList.add("correct");

                }


            });


        }




        showExplanation(
            button,
            button.dataset.answer,
            explanation
        );



    }



}








function showExplanation(
button,
answer,
explanation
){



    let parent =
    button.parentElement;



    if(parent.querySelector(".explanation-box"))
    return;





    let box =
    document.createElement("div");



    box.className =
    "explanation-box";



    box.innerHTML=`

    <h4>
    ❌ Wrong Answer
    </h4>


    <p>
    <b>Correct Answer:</b><br>
    ${answer}
    </p>


    <p>
    💡 <b>Explanation:</b><br>
    ${explanation}
    </p>

    `;



    parent.appendChild(box);



}








function nextQuestion(){



    currentQuestion++;



    if(currentQuestion < questions.length){


        showQuestion();


    }

    else{


        let percentage =
        Math.round(
            (score/questions.length)*100
        );



        let message="";



        if(percentage>=90){

            message="🏆 Outstanding!";

        }
        else if(percentage>=75){

            message="🌟 Great Job!";

        }
        else if(percentage>=50){

            message="👍 Good Attempt!";

        }
        else{

            message="📚 Keep Practicing!";

        }






        document.getElementById(
            "quiz-container"
        ).innerHTML=`

        <div class="final-score">


        <h1>
        🎉 Quiz Completed!
        </h1>


        <div class="score-circle">

        ${percentage}%

        </div>



        <h2>

        ${message}

        </h2>



        <h3>

        Score :
        ${score}/${questions.length}

        </h3>



        <p>

        ✅ Correct :
        ${score}

        <br><br>

        ❌ Wrong :
        ${questions.length-score}

        </p>



        <button onclick="location.reload()">

        🔄 Restart Quiz

        </button>


        </div>

        `;


    }


}






if(questions.length>0){

    showQuestion();

}







// ===============================
// FLASHCARD SYSTEM
// ===============================


let currentFlash=0;




function showFlashcard(){



    if(
        typeof flashcards==="undefined" ||
        flashcards.length===0
    )
    return;




    let card =
    flashcards[currentFlash];



    document.getElementById(
        "flash-question"
    ).innerHTML =
    card.question ?? "No Question";



    document.getElementById(
        "flash-answer"
    ).innerHTML =
    card.answer ?? "No Answer";



    document.getElementById(
        "flash-count"
    ).innerHTML =
    `Card ${currentFlash+1} of ${flashcards.length}`;



}






function flipCard(){


    let card =
    document.querySelector(".flashcard");


    if(card){

        card.classList.toggle("flip");

    }


}






function nextCard(){


    if(typeof flashcards==="undefined")
    return;



    if(currentFlash < flashcards.length-1){


        currentFlash++;


        document.querySelector(".flashcard")
        ?.classList.remove("flip");


        showFlashcard();


    }


}






function previousCard(){


    if(typeof flashcards==="undefined")
    return;



    if(currentFlash>0){


        currentFlash--;


        document.querySelector(".flashcard")
        ?.classList.remove("flip");


        showFlashcard();


    }


}




showFlashcard();
const menuBtn = document.querySelector(".menu-toggle");
const navLinks = document.querySelector(".nav-links");

menuBtn.addEventListener("click", () => {

    navLinks.classList.toggle("active");

});