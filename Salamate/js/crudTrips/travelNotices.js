function avisInfos(idAvis) {
  $.ajax({
    url: "../SalamateDashboard/api/actualites/read_single.php",
    type: "GET", // http method
    data: { idavis: idAvis },
    success: function (data, status, xhr) {
      html = `
        <div class="travelNotice">
            <div class="travelNoticeTitle">${data.title}</div>
            <hr>
            <div class="travelNoticePublicationDate">${data.publicationDate}</div>
            <div class="travelNoticeDescription">${data.description}</div>
        </div>
        `;
      $(".travelNoticesModal .iziModal-content").html(html);
      $(".travelNoticesModal").iziModal("open");
    },
    error: function (jqXhr, textStatus, errorMessage) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Something went wrong!",
      });
    },
  });
}

$.ajax({
  url: "../SalamateDashboard/api/actualites/read.php",
  type: "GET", // http method
  success: function (data, status, xhr) {
    var avis = JSON.parse(xhr.responseText);
    var appendAvis = "";
    if (avis["Message"] == undefined) {
      $("#noAvis").addClass("noAvisHide");
      for (var i in avis) {
        if (avis[i].published == 1) {
          appendAvis += `
              <div class="avis" id="avis${avis[i].idavis}">
                  <div class="avisTitle"> ${avis[i].title} </div>
                  <div class="avisPublicationDate">${avis[i].publicationDate}</div> 
                      <div class="avisInfosIcon">
                          <i class="fas fa-info-circle" title="Click for more infos"  onclick="avisInfos(${avis[i].idavis})" ></i>
                      </div>
                      <hr>
               </div>
              `;
        }
      }
    } else {
      $("#noAvis").addClass("noAvisShow");
    }
    $(".listAvisContainer").append(appendAvis);
  },

  error: function (jqXhr, textStatus, errorMessage) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Something went wrong!",
    });
  },
});
