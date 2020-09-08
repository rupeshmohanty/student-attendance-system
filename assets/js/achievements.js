function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementsByClassName("button special_blue");

  if (dots.style.display = "none") {
      dots.style.display = "inline";
      btnText.innerHTML="See All";
      moreText.style.display = "none";
  }
   else {
      dots.style.display = "none";
      btnText.innerHTML="See less";
      moreText.style.display = "inline";
  }
}