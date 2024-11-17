/* set the size of bar and main when open is pressed*/
const mobile = window.matchMedia("(max-width: 900px)")

function openNav() {
  document.getElementById("sidebar").style.width = "350px";
  if(!mobile.matches){
      document.getElementById("headerpanel").style.paddingLeft = "355px";
      document.getElementById("currency").style.marginLeft = "5px";
  }
}
  
/* set the size of bar to 0 and main to original size when close is pressed*/
function closeNav() {
  document.getElementById("sidebar").style.width = "0";
  document.getElementById("currency").style.marginLeft = "95px";
  document.getElementById("headerpanel").style.paddingLeft = "5px";
}


/* Open the form for logging in */
function openLoginForm() {
  document.getElementById("loginform").style.display="block";
  document.getElementById("popupOverlay").style.display="block";
}

function closeLoginForm() {
  document.getElementById("loginform").style.display="none";
  document.getElementById("popupOverlay").style.display="none";
}


/* Open the form for registration */
function openRegisterForm() {
  document.getElementById("registerform").style.display="block";
  document.getElementById("popupOverlay").style.display="block";
}

function closeRegisterForm() {
  document.getElementById("registerform").style.display="none";
  document.getElementById("popupOverlay").style.display="none";
}