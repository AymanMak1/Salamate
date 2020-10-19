$(".izimodal").iziModal({
  title: "",
  subtitle: "Salamat-e",
  headerColor: "#ff3b5f",
  width: 800,
  padding: 16,
  top: 20,
  bottom: 20,
  radius: 8,
  zindex: 9999,
  fullscreen: true,
  closeOnEscape: true,
  closeButton: true,
  overlay: true,
  overlayClose: true,
  overlayColor: "rgba(0,0,0,0.4)",
  timeoutProgressbarColor: "rgba(255,255,255,0.5)",
  transitionIn: "fadeInRight",
  transitionOut: "fadeOutLeft",
  transitionInOverlay: "fadeIn",
  transitionOutOverlay: "fadeOut",
  onFullscreen: function () {},
  onResize: function () {},
  onOpening: function () {},
  onOpened: function () {},
  onClosing: function () {},
  onClosed: function () {},
  afterRender: function () {},
});

$(".recommendedVaccinesModal").iziModal(
  "setTitle",
  "<div style='font-size:2.5rem; font-family: 'Courgette', cursive;'><b>Recommended Vaccines<b><div>"
);

$(".travelNoticesModal").iziModal(
  "setTitle",
  "<div style='font-size:2.5rem; font-family: 'Courgette', cursive;'><b>Travel Notice<b><div>"
);
$(".travelNoticesModal").iziModal("setTop", 100);
