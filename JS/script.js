// change nav stylr on social

window.addEventListener('scroll',()=> {
    document.querySelector('nav').classList.toggle('window-scrolled'), window.scrollY > 0;

})

const nav = document.querySelector('.nav_links');
const openNavBtn = document.querySelector('#nav_toggle-open');
const closeNavBtn = document.querySelector('#nav_toggle-close');

const openNav = () => {
   nav.style.display = 'flex';
   openNavBtn.style.display = 'none';
   closeNavBtn.style.display = 'inline-block';
}

openNavBtn.addEventListener('click', openNav);

const closeNav = () => {
    nav.style.display = 'none';
    openNavBtn.style.display = 'inline-block';
    closeNavBtn.style.display = 'none';
 }
 
 closeNavBtn.addEventListener('click', closeNav);


 if (document.body.clientWidth <1024){
    nav.querySelector('li a').forEach(navlink => {
        navlink.addEventListener('click', closeNav);
     })
 }
 // profile button 
/*
 profile = document.querySelector('.profile');

 document.querySelector('#user-btn').onclick = () =>{
    profile.classList.toggle('active');
    navbar.classList.remove('active');
 }
 window.onscroll = () =>{
   //navbar.classList.remove('active');
   profile.classList.remove('active');
}
*/

 // product page image replacer

 function imagePointer(smallImg){
    let fullImg = document.getElementById("product-img");
    fullImg.src=smallImg.src;
 }

// js for prouduct gallery 

var ProductImg = document.getElementById(product-img);
var smallImg = document.getElementById("small-img");

smallImg[0].onclick = function(){
   ProductImg.src=smallImg[0].src;
}


//Sweet alert

swal({
   title: "Good job!",
   text: "You clicked the button!",
   icon: "success",
   button: "Aww yiss!",
 });

