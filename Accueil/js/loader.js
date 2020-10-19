setTimeout(function () {
  $("#body").css("display", "none");
  $(".loader").fadeToggle();
}, 3000).then(() => {
  $("#body").css("display", "block");
});
