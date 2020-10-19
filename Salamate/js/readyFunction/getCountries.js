// fill all the countries in the f  orm of add user
var xhr = new XMLHttpRequest();
xhr.open("POST", "../SalamateDashboard/dashboard/php/getCountries.php", true);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.onload = function () {
  if (this.status == 200) {
    var countries = JSON.parse(this.responseText);
    var output =
      "<option value='nothing is selected' selected>Select an option...</option>";
    for (var i in countries) {
      output += "<option>" + countries[i].countryNameEng + "</option>";
    }
    // Edit profil modal nationality field
    document.getElementById("nationality").innerHTML = output;
    document.getElementById("nationality").selectedIndex = "0";
    // Add Trip modal nationality field
    document.getElementById("tripDestination").innerHTML = output;
    document.getElementById("tripDestination").selectedIndex = "0";
    document.getElementById("tripDeparture").innerHTML = output;
    document.getElementById("tripDeparture").selectedIndex = "0";
    // Edit Trip modal nationality field
    document.getElementById("editTripDestination").innerHTML = output;
    document.getElementById("editTripDestination").selectedIndex = "0";
    document.getElementById("editTripDeparture").innerHTML = output;
    document.getElementById("editTripDeparture").selectedIndex = "0";
  }
};
xhr.send();
