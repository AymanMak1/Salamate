/****************************
          DataTables
 * ************************ */

// DataTable Users
// initiliaze Datatable and fetch data into the table
$.ajax({
  url: "./api/users/read.php",
  method: "GET",
  dataType: "json",
  success: function (data) {
    usersTable = $("#crudUsersTable").DataTable({
      processing: false,
      responsive: true,
      rowReorder: {
        selector: "td:nth-child(2)",
      },
      columnDefs: [
        {
          width: "100%",
          targets: 10,
          data: null,
          defaultContent:
            "<div class='text-center'><div class='btn-group'><button class='btn btnEdit'>Edit</button><button class='btn btnDelete'>Delete</button><button class='btn btnVerify' style='background:#858796; color:white;'>Verify</button></div></div>",
        },
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 1 },
      ],
      data: data,
      columns: [
        { data: "iduser" },
        { data: "username" },
        { data: "fullName" },
        { data: "nationality" },
        { data: "phoneNumber" },
        { data: "birthday" },
        { data: "gmail" },
        { data: "verified" },
        { data: "role" },
        { data: "createdAt" },
      ],
      //"ajax" : "./api/users/read.php",

      language: {
        lengthMenu: "View Records _MENU_",
        zeroRecords: "Aucun résultat trouvé",
        info:
          "Showing records from _START_ to _END_ out of a total of _TOTAL_ records",
        infoEmpty: "Showing records from 0 to 0 out of a total of 0 records",
        infoFiltered: "(filter a total of _MAX_ records)",
        sSearch: "Search:",
        oPaginate: {
          sFirst: "First",
          sLast: "Last",
          sNext: "Next",
          sPrevious: "Previous",
        },
      },
    });
  },
  error: function (XMLHttpRequest, textStatus, errorThrown) {
    alert("Status: " + textStatus);
    alert("Error: " + errorThrown);
  },
});

// DataTable Diseases
$.ajax({
  url: "./api/maladies/read.php",
  method: "GET",
  dataType: "json",
  success: function (data) {
    diseasesTable = $("#crudDiseasesTable").DataTable({
      processing: false,
      columnDefs: [
        {
          width: "100%",
          targets: 4,
          data: null,
          defaultContent:
            "<div class='text-center'><div class='btn-group'><button class='btn btnEdit'>Edit</button><button class='btn btnDelete'>Delete</button></div></div>",
        },
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 2 },
      ],
      data: data,
      columns: [
        { data: "iddisease" },
        { data: "countryNameFr" },
        { data: "diseaseName" },
        { data: "addedAt" },
      ],
      //"ajax" : "./api/users/read.php",

      language: {
        lengthMenu: "View Records _MENU_",
        zeroRecords: "Aucun résultat trouvé",
        info:
          "Showing records from _START_ to _END_ out of a total of _TOTAL_ records",
        infoEmpty: "Showing records from 0 to 0 out of a total of 0 records",
        infoFiltered: "(filter a total of _MAX_ records)",
        sSearch: "Search:",
        oPaginate: {
          sFirst: "First",
          sLast: "Last",
          sNext: "Next",
          sPrevious: "Previous",
        },
      },
      /*
          rowReorder: {
            selector: "td:nth-child(2)",
          },
          */
      responsive: true,
    });
  },
  error: function (XMLHttpRequest, textStatus, errorThrown) {
    alert("Status: " + textStatus);
    alert("Error: " + errorThrown);
  },
});

// DataTable Vaccines
$.ajax({
  url: "./api/vaccines/read.php",
  method: "GET",
  dataType: "json",
  success: function (data) {
    vaccinesTable = $("#crudVaccinesTable").DataTable({
      processing: false,
      columnDefs: [
        {
          width: "100%",
          targets: 7,
          data: null,
          defaultContent:
            "<div class='text-center'><div class='btn-group'><button class='btn btnEdit'>Edit</button><button class='btn btnDelete'>Delete</button></div></div>",
        },
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 1 },
      ],

      data: data,
      columns: [
        { data: "idvaccine" },
        { data: "vaccineName" },
        { data: "diseaseName" },
        { data: "vaccineInfos" },
        { data: "nbrDoses" },
        { data: "daysBetween" },
        { data: "addedAt" },
      ],

      language: {
        lengthMenu: "View Records _MENU_",
        zeroRecords: "Aucun résultat trouvé",
        info:
          "Showing records from _START_ to _END_ out of a total of _TOTAL_ records",
        infoEmpty: "Showing records from 0 to 0 out of a total of 0 records",
        infoFiltered: "(filter a total of _MAX_ records)",
        sSearch: "Search:",
        oPaginate: {
          sFirst: "First",
          sLast: "Last",
          sNext: "Next",
          sPrevious: "Previous",
        },
      },
      responsive: true,
    });
  },
  error: function (XMLHttpRequest, textStatus, errorThrown) {
    alert("Status: " + textStatus);
    alert("Error: " + errorThrown);
  },
});

// DataTable Actualites

$.ajax({
  url: "./api/actualites/read.php",
  method: "GET",
  dataType: "json",
  success: function (data) {
    actualitesTable = $("#crudActualitesTable").DataTable({
      processing: false,
      columnDefs: [
        {
          width: "100%",
          targets: 5,
          data: null,
          defaultContent:
            "<div class='text-center'><div class='btn-group'><button class='btn btnEdit'>Edit</button><button class='btn btnDelete'>Delete</button><button class='btn btnPublish' style='background:#858796; color:white;'>Publish</button></div></div>",
        },
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 1 },
      ],

      data: data,
      columns: [
        { data: "idavis" },
        { data: "title" },
        { data: "publicationDate" },
        { data: "description" },
        { data: "published" },
      ],

      language: {
        lengthMenu: "View Records _MENU_",
        zeroRecords: "Aucun résultat trouvé",
        info:
          "Showing records from _START_ to _END_ out of a total of _TOTAL_ records",
        infoEmpty: "Showing records from 0 to 0 out of a total of 0 records",
        infoFiltered: "(filter a total of _MAX_ records)",
        sSearch: "Search:",
        oPaginate: {
          sFirst: "First",
          sLast: "Last",
          sNext: "Next",
          sPrevious: "Previous",
        },
      },
      responsive: true,
    });
  },
  error: function (XMLHttpRequest, textStatus, errorThrown) {
    alert("Status: " + textStatus);
    alert("Error: " + errorThrown);
  },
});
