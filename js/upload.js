// ==========================================
// CozyLearn Upload Page JavaScript
// ==========================================

// Elements
const fileInput = document.getElementById("fileInput");
const preview = document.getElementById("filePreview");
const dropZone = document.querySelector(".drop-zone");
const uploadForm = document.getElementById("uploadForm");
const loadingBox = document.getElementById("loadingBox");

// -----------------------------
// Show Selected File
// -----------------------------

fileInput.addEventListener("change", function () {

    if (this.files.length > 0) {

        const file = this.files[0];

        const size = (file.size / 1024 / 1024).toFixed(2);

        preview.innerHTML = `
            <h3>📄 ${file.name}</h3>
            <p>Size : ${size} MB</p>
        `;

    }

});

// -----------------------------
// Drag & Drop
// -----------------------------

dropZone.addEventListener("dragover", function(e){

    e.preventDefault();

    dropZone.style.background="#DFF7DF";

});

dropZone.addEventListener("dragleave", function(){

    dropZone.style.background="#F7FFF7";

});

dropZone.addEventListener("drop", function(e){

    e.preventDefault();

    dropZone.style.background="#F7FFF7";

    fileInput.files = e.dataTransfer.files;

    const file = fileInput.files[0];

    if(file){

        const size=(file.size/1024/1024).toFixed(2);

        preview.innerHTML=`
            <h3>📄 ${file.name}</h3>
            <p>Size : ${size} MB</p>
        `;
    }

});

// -----------------------------
// File Validation
// -----------------------------

uploadForm.addEventListener("submit", function(e){

    const file=fileInput.files[0];

    const text=document.querySelector("textarea").value.trim();

    if(!file && text===""){

        e.preventDefault();

        alert("Please upload a file or paste some text.");

        return;

    }

    // Show Panda Loading Animation
    loadingBox.style.display="flex";

});
// ===============================
// Study Planner Duration Toggle
// ===============================


const plannerCheckbox =
document.querySelector('input[value="planner"]');


const plannerBox =
document.getElementById("planner-duration-box");



if(plannerCheckbox){


plannerCheckbox.addEventListener("change",()=>{


    if(plannerCheckbox.checked){

        plannerBox.style.display="block";

    }

    else{

        plannerBox.style.display="none";

    }


});


}
const menuBtn = document.querySelector(".menu-toggle");
const navLinks = document.querySelector(".nav-links");

menuBtn.addEventListener("click", () => {

    navLinks.classList.toggle("active");

});