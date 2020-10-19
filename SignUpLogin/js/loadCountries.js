window.onload = function loadCountries() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./php/getCountries.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var countries = JSON.parse(this.responseText);
      var output =
        "<option value='nothing is selected' selected>Select an option...</option>";
      for (var i in countries) {
        output += "<option>" + countries[i].countryNameEng + "</option>";
      }
      document.getElementById("nationalite").innerHTML = output;
      document.getElementById("nationalite").selectedIndex = "0";
    }
  };
  xhr.send();
};
