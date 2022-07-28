var groupType = document.getElementById("groupType").name
var isadmin = document.getElementById("admin").name
var stickerModal = document.getElementById("infoModal");
var addUserModal = document.getElementById("addModal");
var sticketrButton = document.getElementById("infoButton");
var stickerClose = document.getElementById("closeButton");
var groupName = document.getElementById("groupInfo");
var usersInfo = document.getElementById("usersInfo");

const groupInfoDiv = document.getElementById("groupinfo-container");

var typeName = document.getElementById("chat").getAttribute("typeName");
var imageSrc = document.getElementById("chat").getAttribute("imageSrc");

var extraInteractions = document.getElementById("modal-extra-interactions");
var addUserButton = document.getElementById("add_user");
window.onload = () => {
  window.scrollTo({
    top: 1000,
    behavior: 'instant'
  }, document.body.scrollHeight);
}

var rgb;  

if (typeName == "public") {
  //GET COLOR
  var img = document.createElement('img');
  img.src = "../assets/comm_icons/" + imageSrc + ".png";
  function getAverageRGB(imgEl) {

    var blockSize = 5, // only visit every 5 pixels
      defaultRGB = { r: 0, g: 0, b: 0 }, // for non-supporting envs
      canvas = document.createElement('canvas'),
      context = canvas.getContext && canvas.getContext('2d'),
      data, width, height,
      i = -4,
      length,
      rgb = { r: 0, g: 0, b: 0 },
      count = 0;

    if (!context) {
      return defaultRGB;
    }

    height = canvas.height = imgEl.naturalHeight || imgEl.offsetHeight || imgEl.height;
    width = canvas.width = imgEl.naturalWidth || imgEl.offsetWidth || imgEl.width;

    context.drawImage(imgEl, 0, 0);

    try {
      data = context.getImageData(0, 0, width, height);
    } catch (e) {
      /* security error, img on diff domain */
      return defaultRGB;
    }

    length = data.data.length;

    while ((i += blockSize * 4) < length) {
      ++count;
      rgb.r += data.data[i];
      rgb.g += data.data[i + 1];
      rgb.b += data.data[i + 2];
    }

    // ~~ used to floor values
    rgb.r = ~~(rgb.r / count);
    rgb.g = ~~(rgb.g / count);
    rgb.b = ~~(rgb.b / count);

    let diff = 1.4 / ((rgb.r / 255) + (rgb.g / 255) + (rgb.b / 255));
    rgb.r = rgb.r * diff;
    rgb.g = rgb.g * diff;
    rgb.b = rgb.b * diff;


    return rgb;
  }
  rgb = getAverageRGB(img);
  document.getElementById("navbar").style.backgroundColor = 'rgb(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ')';
  document.getElementById("navbar1").style.backgroundColor = 'rgb(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ')';
  document.getElementById("modalCont").style.backgroundColor = 'rgb(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ')';
  document.getElementById("stickerCont").style.backgroundColor = 'rgb(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ')';
  document.getElementById("stickerCloseButton").style.backgroundColor = 'rgb(' + rgb.r / 1.2 + ',' + rgb.g / 1.2 + ',' + rgb.b / 1.2 + ')';
  document.getElementById("groupinfo-container").style.backgroundColor = 'rgb(' + rgb.r / 1.2 + ',' + rgb.g / 1.2 + ',' + rgb.b / 1.2 + ')';
  document.getElementById("closeButton").style.backgroundColor = 'rgb(' + rgb.r / 1.2 + ',' + rgb.g / 1.2 + ',' + rgb.b / 1.2 + ')';

  Array.from(document.getElementsByClassName("messageEnvoye")).map((element) => {
    element.style.backgroundColor = 'rgb(' + rgb.r * 1.2 + ',' + rgb.g * 1.2 + ',' + rgb.b * 1.2 + ')'; element.style.borderColor = 'rgb(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ')'
  });
  document.getElementById("infoButton").onmouseover = function () {
    this.style.borderColor = 'rgb(' + rgb.r / 1.2 + ',' + rgb.g / 1.2 + ',' + rgb.b / 1.2 + ')';
  }
  document.getElementById("infoButton").onmouseout = function () {
    this.style.borderColor = 'rgba(255,255,255,0)';
  }
  document.getElementById("send").onmouseover = function () {
    this.style.borderColor = 'rgb(' + rgb.r / 1.2 + ',' + rgb.g / 1.2 + ',' + rgb.b / 1.2 + ')';
  }
  document.getElementById("send").onmouseout = function () {
    this.style.borderColor = 'rgba(255,255,255,0)';
  }
}

sticketrButton.onclick = function () {
  console.log("Click")
  stickerModal.style.display = "block";
}

stickerClose.onclick = () => {
  onClose();
}


window.onclick = function (event) {
  if (event.target == stickerModal) {
    onClose();
  }
}

function onClose() {
  stickerModal.style.display = "none";
  usersInfo.innerHTML = "";
  extraInteractions.innerHTML = "";
  window.location.replace(removeParam("modal", window.location.href));
}
if(groupType == "private" && isadmin == 1){
  addUserButton.onclick = function () {
            stickerModal.style.display = "none";
            addUserModal.style.display = "block";
          };
 }

// function getGroupIdInfo(userId, groupId, isAdmin, groupAdminId) {
//   groupName.innerText = "Loading...";
//   const Http = new XMLHttpRequest();
//   const url = `../controllers/getgroupinfo.php?id=${groupId}`;
//   Http.open("GET", url);
//   Http.send();
//   Http.onreadystatechange = (e) => {
//     if (Http.readyState !== XMLHttpRequest.DONE) {
//       return;
//     }
//     let output = Http.responseText;
//     let jsonObject = null;

//     try {
//       jsonObject = JSON.parse(output);
//     } catch (e) {
//       groupName.innerText = "Unexpected error, while trying to get the corresponding group information, please try again.";
//       return;
//     }

//     let groupInfo = jsonObject[0][0];
//     let groupUsersInfo = jsonObject[1];
//     groupName.innerText = groupInfo.group_name;

//     if (groupInfo.group_bio) {
//       let groupBio = document.createElement("p");
//       groupBio.classList.add("group_bio");
//       groupBio.innerText = groupInfo.group_bio;
//       groupInfoDiv.appendChild(groupBio);
//     }

//     for (let user of groupUsersInfo) {

//       let userInfo = document.createElement("div");
//       let userEmail = document.createElement("p");
//       userEmail.classList.add("user-email");
//       userEmail.innerText = user[0].user_email;
//       userInfo.classList.add("user_info_page")
//       userInfo.appendChild(userEmail);
//       usersInfo.appendChild(userInfo);

//       if (!isAdmin) {
//         continue;
//       }

//       if (user[0].user_id == groupAdminId) {
//         let adminSpan = document.createElement('span');
//         adminSpan.innerText = "⚡";
//         userInfo.appendChild(adminSpan);
//         continue;
//       }

//       let userDeleteButton = document.createElement("a");
//       userDeleteButton.classList.add("user_delete_button");
//       userDeleteButton.href = `../controllers/deleteuserfromgroup.php?delid=${user[0].user_id}&id=${groupId}`;
//       userDeleteButton.innerText = "X";
//       userInfo.appendChild(userDeleteButton);

//     }

//     if (isAdmin) {
//       let addUserButton = createButton("add_user", "add_user", "Add User", "#");
//       addUserButton.onclick = function () {
//         stickerModal.style.display = "none";
//         addUserModal.style.display = "block";
//       };
//       extraInteractions.appendChild(addUserButton);

//       let deleteGroup = createButton("delete_group", "delete_group", "Delete Group", `../controllers/deletegroup.php?id=${groupId}`);
//       extraInteractions.appendChild(deleteGroup);
//     }
//     else {
//       let leaveGroup = createButton("leave_group", "leave_group", "Leave Group", `../controllers/deleteuserfromgroup.php?delid=${userId}&id=${groupId}`);
//       extraInteractions.appendChild(leaveGroup);
//     }

//   }
// }



function createButton(className, id, innerText, href) {
  let button = document.createElement("a");
  if (href != null) {
    button.href = href;
  }
  button.classList.add(className, "btn", "modal_interaction");
  button.setAttribute("id", id);
  button.innerText = innerText;
  return button;
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


const edit = document.getElementById("editId")
const txt = document.getElementById("text")
const form = document.getElementById("form")
let button = document.getElementById("send")
const messageSenderId = document.getElementById("jsUserId").value
const groupId = document.getElementById("groupId").value
const messageId = document.getElementById("message_id")
const cont0 = document.getElementById("cont0")


document.getElementById("send").addEventListener("click", function (event) {
  event.preventDefault()

})

var x
const editDelete = document.getElementById("EditDelete")
function show(event) {
  x = event.target.id

  const editBtn = document.getElementById("editBtn")
  const deleteBtn = document.getElementById("deleteBtn")

  editBtn.setAttribute("name", x)
  deleteBtn.setAttribute("name", x)

  editDelete.style.display = "block"
}

//update


function myFunction(event) {

  console.log(x)
  const messageCont = document.getElementById(x)

  document.getElementById("send").addEventListener("click", function (event) {
    event.preventDefault()

  })
  txt.value = messageCont.innerText


  var y = document.getElementById("editBtn")

  button.setAttribute("onclick", "updateMessages(event)")
}


let y



function updateMessages(event) {
  const message_cont = txt.value


  if (message_cont != "") {
    $.ajax(
      {
        type: 'post',
        url: "../controllers/update.php",
        data: {
          "user_id": messageSenderId,
          "group_id": groupId,
          "message_id": x,
          "message_content": message_cont

        },
        success: function (response) {
          console.log("Success !!");
          document.getElementById(x).innerText = message_cont

          console.log(response)


        },
        error: function () {
          x
          console.log("Error !!");
        }
      }
    );

    txt.value = ""
    button.id = "send"
  }

  button.setAttribute("onclick", "sendMessage(event)")
  editDelete.style.display = "none"
}




function deleteMessages(event) {
  $.ajax(
    {
      type: 'post',
      url: "../controllers/delete.php",
      data: {

        "message_id": x,


      },
      success: function (response) {
        console.log("Success !!");


        console.log(response)
        const element = document.getElementById(x)
        element.style.display = "none"

      },
      error: function () {
        x
        console.log("Error !!");
      }
    }


  );
  editDelete.style.display = "none";

}
var id
function sendMessage(event) {
  if (txt.value != "") {
    $.ajax(
      {
        type: 'post',
        url: "../controllers/sendmessage.php",
        data: {
          "group_id": groupId,
          "message_content": txt.value,
          "message_id": x

        },
        success: function (response) {
          id = response
          const cont = document.createElement("div")
          cont.setAttribute("class", "row")
          cont.setAttribute("id", "messages")
          const div3 = document.createElement("div")
          div3.setAttribute("class", "col-4")
          const div = document.createElement("div")
          div.setAttribute("class", "col-8")
          cont.appendChild(div3)
          cont.appendChild(div)

          const button2 = document.createElement("button")
          button2.setAttribute("class", "btn btn-primary messageEnvoye mt-2")
          if (groupId < 16) {
            button2
          }
          button2.setAttribute("onclick", "show(event)")
          button2.setAttribute("style", "float : right; color: black;")
          button2.setAttribute("id", id)
          if (typeName == "public") {
            button2.style.backgroundColor = 'rgb(' + rgb.r * 1.2 + ',' + rgb.g * 1.2 + ',' + rgb.b * 1.2 + ')';
            button2.style.borderColor = 'rgb(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ')';
          }
          const span = document.createElement("span")
          span.setAttribute("class", "message_content_span")
          span.setAttribute("onclick", "show(event)")
          if (txt.value.startsWith("STICKER_")) {
            let sticker = document.createElement("img");
            sticker.src = `../assets/stickers/${txt.value.split("_")[1]}.png`;
            sticker.style.width = "140px";
            sticker.style.height = "100px";
            sticker.setAttribute("name", id)
            span.appendChild(sticker);
          }
          else {
            span.setAttribute("id", id)
            span.innerText = txt.value;
          }
          button2.appendChild(span)
          div.appendChild(button2)





          cont0.appendChild(cont)

          cont.scrollIntoView({ behavior: "smooth" })

          txt.value = ""

        },
        error: function () {
          x
          console.log("Error !!");
        }


      });
  }



}

function sendSticker(stickerId) {
  stickerId = stickerId.replace(" ", "");
  txt.value = `STICKER_${stickerId}`;
  sendMessage(null);
}

// let winY = window.scrollY

// console.log(document.getElementById("cont0").childElementCount)

console.log(true)

function deleteUser(event) {
  $.ajax(
    {
      type: 'post',
      url: "../controllers/deleteuserfromgroup.php",
      data: {
        "user_id": event.target.id,
        "group_id": groupId,

      },
      success: function (response) {
        console.log("Success !!");
        console.log(response)


      },
      error: function () {
        console.log("Error !!");
      }
    }

  );

  const div = document.getElementById("div"+event.target.id)
  div.setAttribute("style", "display: none;")
  console.log(div)


  }
