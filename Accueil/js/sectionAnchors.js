let sectionsAnchors = document.querySelectorAll(".point");
for (sectionsAnchor of sectionsAnchors) {
  sectionsAnchor.addEventListener("click", function (e) {
    $(".points>span.point").removeClass("active");
    e.target.classList.toggle("active");
  });
}
