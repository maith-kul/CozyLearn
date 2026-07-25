const faqButtons=document.querySelectorAll(".faq-item button");

console.log(faqButtons);


faqButtons.forEach(button=>{

button.addEventListener("click",()=>{

console.log("clicked");

let item=button.parentElement;

item.classList.toggle("active");

});

});
const menuBtn = document.querySelector(".menu-toggle");
const navLinks = document.querySelector(".nav-links");

menuBtn.addEventListener("click", () => {

    navLinks.classList.toggle("active");

});