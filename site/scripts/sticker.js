var modal = document.getElementById("stickerModal");
var btn = document.getElementById("stickerButton");
var span = document.getElementById("stickerCloseButton");


// var stickerModalTitle = document.getElementById("groupsticker");
// var stickerModalUsers = document.getElementById("userssticker");

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = onClose;

window.onclick = function(event) {
  if (event.target == modal) {
    onClose();
  }
}

function onClose() {
  modal.style.display = "none";
}
