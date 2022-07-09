var modal = document.getElementById("infoModal");
var btn = document.getElementById("infoButton");
var span = document.getElementById("closeButton");

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

let info = document.getElementById("groupInfo");

function getGroupIdInfo(groupId) {
  info.innerText = "Loading...";
  const Http = new XMLHttpRequest();
  const url=`../controllers/getgroupinfo.php?id=${groupId}`;
  Http.open("GET", url);
  Http.send();
  Http.onreadystatechange = (e) => {
    let output = Http.responseText;
    let jsonObject = null;
    try {
      jsonObject = JSON.parse(output);
    } catch (e) {
      info.innerText = "Unexpected error, while trying to get the corresponding group information, please try again.";
      return;
    }
    let groupInfo = jsonObject[0][0];
    info.innerText = groupInfo.group_name + " - " + groupInfo.group_bio;
  }
}