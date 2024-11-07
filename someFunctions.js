/* set the size of bar and main when open is pressed*/
const mobile = window.matchMedia("(max-width: 900px)")

function openNav() {
  document.getElementById("sidebar").style.width = "350px";
  if(!mobile.matches){
      document.getElementById("main").style.marginLeft = "350px";
  }
}
  
/* set the size of bar to 0 and main to original size when close is pressed*/
function closeNav() {
  document.getElementById("sidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
}


/* Open the form for logging in */
function openForm() {
  document.getElementById("loginform").style.display="block";
}

function closeForm() {
  document.getElementById("loginform").style.display="none";
}