var stickerModal = document.getElementById("infoModal");

var sticketrButton = document.getElementById("infoButton");
var stickerClose = document.getElementById("closeButton");
var groupName = document.getElementById("groupInfo");
var usersInfo = document.getElementById("usersInfo");

const groupInfoDiv = document.getElementById("groupinfo-container");

var extraInteractions = document.getElementById("modal-extra-interactions");

window.onload = () => {
  window.scrollTo({
    top: 1000,
    behavior: 'instant'
  }, document.body.scrollHeight);
}

sticketrButton.onclick = function () {
  stickerModal.style.display = "block";
}



stickerClose.onclick = onClose;

window.onclick = function (event) {
  stickerModal.style.display = "none";
  usersInfo.innerHTML = "";
  extraInteractions.innerHTML = "";
}

function onClose() {
  stickerModal.style.display = "none";
  usersInfo.innerHTML = "";
  extraInteractions.innerHTML = "";
  window.location.replace(removeParam("modal", window.location.href));
}


function getGroupIdInfo(userId, groupId, isAdmin, groupAdminId) {
  groupName.innerText = "Loading...";
  const Http = new XMLHttpRequest();
  const url = `../controllers/getgroupinfo.php?id=`+groupId;
  Http.open("GET", url);
  Http.send();
  Http.onreadystatechange = (e) => {
    if (Http.readyState !== XMLHttpRequest.DONE) {
      return;
    }
    let output = Http.responseText;
    let jsonObject = null;

    try {
      jsonObject = JSON.parse(output);
    } catch (e) {
      groupName.innerText = "Unexpected error, while trying to get the corresponding group information, please try again.";
      return;
    }

    let groupInfo = jsonObject[0][0];
    let groupUsersInfo = jsonObject[1];
    groupName.innerText = groupInfo.group_name;

    if (groupInfo.group_bio) {
      let groupBio = document.createElement("p");
      groupBio.classList.add("group_bio");
      groupBio.innerText = groupInfo.group_bio;
      groupInfoDiv.appendChild(groupBio);
    }

    for (let user of groupUsersInfo) {

      let userInfo = document.createElement("div");
      let userEmail = document.createElement("p");
      userEmail.classList.add("user-email");
      userEmail.innerText = user[0].user_email;
      userInfo.classList.add("user_info_page")
      userInfo.appendChild(userEmail);
      usersInfo.appendChild(userInfo);

      if (!isAdmin) {
        continue;
      }

      if (user[0].user_id == groupAdminId) {
        let adminSpan = document.createElement('span');
        adminSpan.innerText = "⚡";
        userInfo.appendChild(adminSpan);
        continue;
      }

      let userDeleteButton = document.createElement("a");
      userDeleteButton.classList.add("user_delete_button");
      userDeleteButton.href = `../controllers/deleteuserfromgroup.php?delid=${user[0].user_id}&id=${groupId}`;
      userDeleteButton.innerText = "X";
      userInfo.appendChild(userDeleteButton);

    }

    if (isAdmin) {
      let addUserButton = createButton("add_user", "add_user", "Add User", "#");
    
      extraInteractions.appendChild(addUserButton);

      let deleteGroup = createButton("delete_group", "delete_group", "Delete Group", `../controllers/deletegroup.php?id=${groupId}`);
      extraInteractions.appendChild(deleteGroup);
    }
    else {
      let leaveGroup = createButton("leave_group", "leave_group", "Leave Group", `../controllers/deleteuserfromgroup.php?delid=${userId}&id=${groupId}`);
      extraInteractions.appendChild(leaveGroup);
    }

  }
}

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


// function myFunction(event) { 
//   var x = event.target;
//   console.log(x.innerText);
//   console.log(x.name);
//   console.log(x)
//   if(x != edit){
//     txt.value = x.innerText
//     console.log(true)
//   }
// }

// function update(){
//   // form.action = ".../controllers/update.php"
//   txt.innerText = "<?= $message?>"
//   console.log(1)
// }








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
const button = document.getElementById("send")
const messageSenderId = document.getElementById("jsUserId").value
const br = document.getElementById("br")










function deleteMessage(event) {
  var x = event.target.name;

  // const url =  "../controllers/delete.php?id="+x
  // form.action = url
  // var y = document.getElementById("delete" + x)
  // console.log(y)




}




function show(event) {
  let dropdownDiv = document.getElementsByClassName("dropdown")
  for (let i = 0; i < dropdownDiv.length; i++) {
    dropdownDiv[i].style.display = "none"


  }




  var y = event.target.id
  let id = "dropdown" + y

  const dropdown = document.getElementById(id)
  dropdown.style.display = "inline-block"
  dropdown.style.position = "absolute"
}


//update

var x
function myFunction(event) {
  button.id = "submit"

  x = event.target.name

  const messageCont = document.getElementById(x)

  // document.getElementById("submit").addEventListener("click", function(event){
  //   event.preventDefault()

  // })
  txt.value = messageCont.innerText
  const url = "../controllers/update.php?id=" + x
  form.action = url

  var y = document.getElementById("editId" + x)

  if (event.target == y) {
    let dropdownDiv = document.getElementsByClassName("dropdown")
    for (let i = 0; i < dropdownDiv.length; i++) {
      dropdownDiv[i].style.display = "none"

    }


  }
  console.log(messageCont.innerText)
  const messageId = document.getElementById("message_id")
  messageId.value = x



}


// document.getElementById("submit").addEventListener("click", function(event){
//   var xmlhttp = new XMLHttpRequest();
//   let rq = "../controllers/update.php?id=" + x;console.log(rq);
//   xmlhttp.open("POST", rq,false);
//   xmlhttp.send();
//   console.log(true)
//   console.log(txt.value)
//   txt.value = "asxasx"
//   button.id = "send"

// })



// document.getElementById("bodyHTML").addEventListener("click", function(event) {
//   if (event.target != edit){
//   let id = button.id

//   document.getElementById(id).addEventListener("click", function(event) {
//     const message_cont = txt.value




//     var params = "user_id="+messageSenderId+"&"+"message_id="+x+"&"+"message_content="+message_cont
//     if(message_cont != ""){
//       var xmlhttp = new XMLHttpRequest();
//       let rq = "../controllers/update.php"
//       xmlhttp.open("GET", "../controllers/update.php?="+messageSenderId,false);
//       xmlhttp.send(params);




//       // txt.value = ""
//       button.id = "send"
//     }


//   })

//   }
// })


function post(path, params, method = 'post') {

  // The rest of this code assumes you are not using a library.
  // It can be made less verbose if you use one.
  const form = document.createElement('form');
  form.method = method;
  form.action = path;

  for (const key in params) {
    if (params.hasOwnProperty(key)) {
      const hiddenField = document.createElement('input');
      hiddenField.type = 'hidden';
      hiddenField.name = key;
      hiddenField.value = params[key];

      form.appendChild(hiddenField);
    }
  }

  document.body.appendChild(form);
  form.submit();
}

function sendSticker(stickerId, groupId) {
  stickerId = stickerId.replace(" ", "");
  post("../controllers/sendmessage.php", {
    message_content: `STICKER_${stickerId}`,
    group_id: groupId
  });
}