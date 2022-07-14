var infoModal = document.getElementById("infoModal");
var infoModalButton = document.getElementById("infoButton");
var infoModalCloseButton = document.getElementById("closeButton");

var infoModalTitle = document.getElementById("groupInfo");
var infoModalUsers = document.getElementById("usersInfo");
var infoModalInteractions = document.getElementById("modal-extra-interactions");

infoModalButton.onclick = function() {
  infoModal.style.display = "block";
}



window.onclick = function(event) {
  if (event.target == infoModal) {
    onClose();
  }
}

// infoModalCloseButton.onclick = onClose;
// function onClose() {
//   infoModal.style.display = "none";
//   // infoModalUsers.innerHTML = "";
//   // infoModalInteractions.innerHTML = "";
//   // window.location.replace(removeParam("modal", window.location.href));
// }