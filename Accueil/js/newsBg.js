var i = 0;
var images = [];
var time = 5000;

//images list
document.querySelector("#news .parallax").style.backgroundImage =
  "url('Accueil/imgs/pinkdisease.jpg')";
images[0] = "Accueil/imgs/pinkdisease.jpg";
images[1] = "Accueil/imgs/pinkdisease2.jpg";
images[2] = "Accueil/imgs/pinkdisease4.jpg";
images[3] = "Accueil/imgs/pinkdisease5.jpg";
document.querySelector("#news .parallax").style.backgroundImage =
  "url(" + images[0] + ")";
function autoslider() {
  if (i < images.length - 1) {
    i++;
    document.querySelector("#news .parallax").style.backgroundImage =
      "url(" + images[i] + ")";
    //console.log(images[i]);
  } else {
    i = 0;
    document.querySelector("#news .parallax").style.backgroundImage =
      "url(" + images[i] + ")";
    //console.log(images[i]);
  }
  setTimeout("autoslider()", time);
}

autoslider();
