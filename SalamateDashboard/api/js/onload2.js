window.onload = function onload() {
  // fill all the countries in the form of add user
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./dashboard/php/getCountries.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var countries = JSON.parse(this.responseText);
      var output =
        "<option value='nothing is selected' selected>Select an option...</option>";
      var output2 = output;
      for (var i in countries) {
        output += "<option>" + countries[i].countryNameEng + "</option>";
        output2 += `<option value = ${countries[i].idcountry} >  ${countries[i].countryNameEng} </option>`;
      }
      document.getElementById("nationality").innerHTML = output;
      document.getElementById("nationality").selectedIndex = "0";
      document.getElementById("country").innerHTML = output2;
      document.getElementById("country").selectedIndex = "0";
    }
  };
  xhr.send();

  // count the users
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./api/users/count.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var count = JSON.parse(this.responseText);
      document.getElementById("countUsers").innerHTML = count;
      document.querySelector(".badgeCountUsers").innerHTML = count;
    } else {
      console.log("not ok");
    }
  };
  xhr.send();

  // count the diseases
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./api/maladies/count.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var count = JSON.parse(this.responseText);
      document.getElementById("countDiseases").innerHTML = count;
      document.querySelector(".badgeCountDiseases").innerHTML = count;
    } else {
      console.log("not ok");
    }
  };
  xhr.send();

  // count the vaccines
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./api/vaccines/count.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var count = JSON.parse(this.responseText);
      document.getElementById("countVaccines").innerHTML = count;
      document.querySelector(".badgeCountVaccines").innerHTML = count;
    } else {
      console.log("not ok");
    }
  };
  xhr.send();

  // count the news
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./api/actualites/count.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var count = JSON.parse(this.responseText);
      document.getElementById("countActualites").innerHTML = count;
      document.querySelector(".badgeCountActualites").innerHTML = count;
    } else {
      console.log("not ok");
    }
  };
  xhr.send();

  // fill the table of lastestUsers
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./api/users/latestUsers.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var latestUsers = JSON.parse(this.responseText);
      if (latestUsers.Message) {
        // show the row of no users found, give an attribute of colspan so it can fill all the columns and display the response of xhr
        var noUsersTr = $("#latestUsersTable tbody tr:eq(0)");
        noUsersTr.css("display", "table-row");
        var noUsersTd = $("#latestUsersTable tbody tr:eq(0) > td");
        noUsersTd.html(latestUsers.Message);
        noUsersTd.attr("colspan", 6);
        noUsersTd.css("text-align", "center");
      } else {
        var output = "";
        var latestUsersTable = document
          .querySelector("#latestUsersTable")
          .getElementsByTagName("tbody")[0];
        for (var i in latestUsers) {
          output += "<tr>";
          output += "<td>" + latestUsers[i].username + "</td>";
          output += "<td>" + latestUsers[i].fullName + "</td>";
          output += "<td>" + latestUsers[i].gmail + "</td>";
          output += "<td>" + latestUsers[i].role + "</td>";
          output += "<td>" + latestUsers[i].verified + "</td>";
          output += "<td>" + latestUsers[i].createdAt + "</td>";
          output += "</tr>";
          latestUsersTable.innerHTML = output;
        }
      }
    } else {
      console.log("not ok");
    }
  };
  xhr.send();

  // get the verified User
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./api/users/countVerifiedUsers.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var verifiedUsers = JSON.parse(this.responseText);
      var allUsers = document.getElementById("countUsers").innerHTML;
      var verifiedUsers = parseInt((100 * verifiedUsers) / allUsers);
      // console.log(parseInt(verifiedUsers));
      var progressBarVerifiedUsers = document.getElementById(
        "progress-bar-verifiedUsers"
      );
      progressBarVerifiedUsers.setAttribute("aria-valuenow", verifiedUsers);
      progressBarVerifiedUsers.setAttribute(
        "style",
        "width:" + verifiedUsers + "%"
      );
      progressBarVerifiedUsers.innerHTML = verifiedUsers + "%";
    } else {
      console.log("not ok");
    }
  };
  xhr.send();

  // get the unverified Users
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./api/users/countUnverifiedUsers.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var unverifiedUsers = JSON.parse(this.responseText);
      //console.log(unverifiedUsers);
      var allUsers = document.getElementById("countUsers").innerHTML;
      var unverifiedUsers = parseInt((100 * unverifiedUsers) / allUsers);
      //console.log(parseInt(unverifiedUsers));
      var progressBarUnverifiedUsers = document.getElementById(
        "progress-bar-unverifiedUsers"
      );
      progressBarUnverifiedUsers.setAttribute("aria-valuenow", unverifiedUsers);
      progressBarUnverifiedUsers.setAttribute(
        "style",
        "width:" + unverifiedUsers + "%"
      );
      progressBarUnverifiedUsers.innerHTML = unverifiedUsers + "%";
    } else {
      console.log("not ok");
    }
  };
  xhr.send();

  // get all the disease and fill them into the "addVaccineModal"

  var xhr = new XMLHttpRequest();
  xhr.open("GET", "./api/maladies/read.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var diseases = JSON.parse(this.responseText);
      var output =
        "<option value='nothing is selected' selected>Select an option...</option>";
      for (var i in diseases) {
        output += `<option value = ${diseases[i].iddisease} > ${diseases[i].diseaseName} </option>`;
      }
      document.getElementById("vaccineDisease").innerHTML = output;
      document.getElementById("vaccineDisease").selectedIndex = "0";
    } else {
      console.log("not ok");
    }
  };
  xhr.send();
};
