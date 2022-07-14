var stickerModal = document.getElementById("stickerModal");
var stickerModalButton = document.getElementById("stickerButton");
// var infoModalCloseButton = document.getElementById("closeButton");

// var infoModalTitle = document.getElementById("groupInfo");
// var infoModalUsers = document.getElementById("usersInfo");
var infoModalInteractions = document.getElementById("modal-extra-interactions");

stickerModalButton.onclick = function () {
  stickerModal.style.display = "block";
};

// infoModalCloseButton.onclick = onClose;

// window.onclick = function (event) {
//   if (event.target == infoModal) {
//     onClose();
//   }
// };

// function onClose() {
//   infoModal.style.display = "none";
//   infoModalUsers.innerHTML = "";
//   infoModalInteractions.innerHTML = "";
//   window.location.replace(removeParam("modal", window.location.href));
// }
