var modal = document.getElementById("infoModal");
var btn = document.getElementById("infoButton");
var span = document.getElementById("closeButton");
var info = document.getElementById("groupInfo");
var usersInfo = document.getElementById("usersInfo");

var extraInteractions = document.getElementById("modal-extra-interactions");

window.onload = () => {
  window.scrollTo({
    top: 1000,
    behavior: 'instant'
  }, document.body.scrollHeight);
}

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
  usersInfo.innerHTML = "";
  extraInteractions.innerHTML = "";
  window.location.replace(removeParam("modal", window.location.href));
}


function getGroupIdInfo(userId, groupId, isAdmin, groupAdminId) {
  info.innerText = "Loading...";
  const Http = new XMLHttpRequest();
  const url=`../controllers/getgroupinfo.php?id=${groupId}`;
  Http.open("GET", url);
  Http.send();
  Http.onreadystatechange = (e) => {
    if(Http.readyState !== XMLHttpRequest.DONE) {
      return;
    }
    let output = Http.responseText;
    let jsonObject = null;

    try {
      jsonObject = JSON.parse(output);
    } catch (e) {
      info.innerText = "Unexpected error, while trying to get the corresponding group information, please try again.";
      return;
    }

    let groupInfo = jsonObject[0][0];
    let groupUsersInfo = jsonObject[1];
    info.innerText = groupInfo.group_name + " - " + groupInfo.group_bio;

    for (let user of groupUsersInfo) {

      let userInfo = document.createElement("div");
      userInfo.classList.add("user_info_page")
      userInfo.innerText = user[0].user_email;
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
      let addUserButton = createButton("add_user", "add_user", "Add User", null);
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


const edit = document.getElementById("editId")
const txt = document.getElementById("text")
const form = document.getElementById("form")
 
 
function myFunction(event) {
 var x = event.target.name;
 console.log(x)
 const messageCont = document.getElementById(x)
 console.log(messageCont.innerText)

  txt.value = messageCont.innerText
  const url =  "../controllers/update.php?id="+x
  form.action = url
  
  var y = document.getElementById("editId" + x)
  console.log(y)
  if(event.target == y){
    let dropdownDiv = document.getElementsByClassName("dropdown")
    for (let i = 0; i < dropdownDiv.length; i++) {
      dropdownDiv[i].style.display = "none"
      
    }  
  
  }
  window.scrollTo(0, document.body.scrollHeight)


}

function show(event){
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

function deleteMessage(event){  
  var x = event.target.name;  
  const url =  "../controllers/delete.php?id="+x
  form.action = url
  var y = document.getElementById("delete3")
  console.log(y)

}