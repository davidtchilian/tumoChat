var infoModal = document.getElementById("infoModal");
var infoModalButton = document.getElementById("infoButton");
var infoModalCloseButton = document.getElementById("closeButton");

var infoModalTitle = document.getElementById("groupInfo");
var infoModalUsers = document.getElementById("usersInfo");
var infoModalInteractions = document.getElementById("modal-extra-interactions");

infoModalButton.onclick = function() {
  infoModal.style.display = "block";
}

infoModalCloseButton.onclick = onClose;

window.onclick = function(event) {
  if (event.target == infoModal) {
    onClose();
  }
}

function removeParam(key, sourceURL) {
  var rtn = sourceURL.split("?")[0],
      param,
      params_arr = [],
      queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
  if (queryString !== "") {
      params_arr = queryString.split("&");
      for (var i = params_arr.length - 1; i >= 0; i -= 1) {
          param = params_arr[i].split("=")[0];
          if (param === key) {
              params_arr.splice(i, 1);
          }
      }
      if (params_arr.length) rtn = rtn + "?" + params_arr.join("&");
  }
  return rtn;
}

function onClose() {
  // infoModalUsers.innerHTML = "dadad";
  infoModal.style.display = "none";
  infoModalInteractions.innerHTML = "";
  window.location.replace(removeParam("modal", window.location.href));
}