var stickerModal = document.getElementById("infoModal");
var addUserModal = document.getElementById("addModal");
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

sticketrButton.onclick = function() {
  console.log("Click")
  stickerModal.style.display = "block";
}

stickerClose.onclick = () => {
  onClose();
}

window.onclick = function(event) {
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


function getGroupIdInfo(userId, groupId, isAdmin, groupAdminId) {
  groupName.innerText = "Loading...";
  const Http = new XMLHttpRequest();
  const url = `../controllers/getgroupinfo.php?id=${groupId}`;
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
      addUserButton.onclick = function() {
        stickerModal.style.display = "none";
        addUserModal.style.display = "block";
      };
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


    // for (let user of groupUsersInfo) {

    //   let userInfo = document.createElement("div");
    //   let userEmail = document.createElement("p");
    //   userEmail.classList.add("user-email");
    //   userEmail.innerText = user[0].user_email;
    //   userInfo.classList.add("user_info_page")
    //   userInfo.appendChild(userEmail);
    //   usersInfo.appendChild(userInfo);
 
    //   if (!isAdmin) {
    //     continue;
    //   }

    //   if (user[0].user_id == groupAdminId) {
    //     let adminSpan = document.createElement('span');
    //     adminSpan.innerText = "⚡";
    //     userInfo.appendChild(adminSpan);
    //     continue;
    //   }

    //   let userDeleteButton = document.createElement("a");
    //   userDeleteButton.classList.add("user_delete_button");
    //   userDeleteButton.href = `../controllers/deleteuserfromgroup.php?delid=${user[0].user_id}&id=${groupId}`;
    //   userDeleteButton.innerText = "X";
    //   userInfo.appendChild(userDeleteButton);
    
    // }

    // if (isAdmin) {
    //   let addUserButton = createButton("add_user", "add_user", "Add User", null);
    //   extraInteractions.appendChild(addUserButton);

    //   let deleteGroup = createButton("delete_group", "delete_group", "Delete Group", `../controllers/deletegroup.php?id=${groupId}`);
    //   extraInteractions.appendChild(deleteGroup);
    // }
    // else {
    //   let leaveGroup = createButton("leave_group", "leave_group", "Leave Group", `../controllers/deleteuserfromgroup.php?delid=${userId}&id=${groupId}`);
    //   extraInteractions.appendChild(leaveGroup);
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
let button = document.getElementById("send")
const messageSenderId = document.getElementById("jsUserId").value
const groupId = document.getElementById("groupId").value
const messageId = document.getElementById("message_id")
const cont0 = document.getElementById("cont0")
console.log(messageId)

document.getElementById("send").addEventListener("click", function(event){
  event.preventDefault()

})

var x

function show(event){
  x = event.target.id
  let dropdownDiv = document.getElementsByClassName("dropdown")
  for (let i = 0; i < dropdownDiv.length; i++) {
    dropdownDiv[i].style.display = "none"
    
  }
  var y = event.target.id
  let id = "dropdown" + x

  
  const dropdown = document.getElementById(id)
 
  dropdown.style.display = "block"
  dropdown.style.position = "absolute"
}


//update


function myFunction(event) {


  x = event.target.name

  const messageCont = document.getElementById(x)

  document.getElementById("send").addEventListener("click", function(event){
    event.preventDefault()
  
  })
  txt.value = messageCont.innerText
  //  const url =  "../controllers/update.php?id="+x
  //  form.action = url
   
   var y = document.getElementById("editId" + x)
 
   if(event.target == y){
     let dropdownDiv = document.getElementsByClassName("dropdown")
     for (let i = 0; i < dropdownDiv.length; i++) {
       dropdownDiv[i].style.display = "none"
       
     }  
   
   }
  button.setAttribute("onclick", "updateMessages(event)")
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


let y 


  
  function updateMessages(event){
    const message_cont = txt.value
  
   

    var params = "user_id="+5+"&"+"message_id="+73+"&"+"message_content="+"hello"
    if(message_cont != ""){
      $.ajax(
        {
           type: 'post',
           url:  "../controllers/update.php",
           data: { 
             "user_id" : messageSenderId,
             "group_id" : groupId,
             "message_id": x,
             "message_content": message_cont
            
           },
           success: function (response) {
             console.log("Success !!");
             document.getElementById(x).innerText = message_cont
            //  var xmlhttp = new XMLHttpRequest();
            //  xmlhttp.open(this.type, this.url ,true);
            //  xmlhttp.send(this.data);
            //  console.log(this.type)
           console.log(response)
             
           
           },
           error: function () {x
             console.log("Error !!");
           }
          }        
     );
     
      txt.value = ""
      button.id = "send"
    }
    button.setAttribute("onclick", "sendMessage(event)")
  }




function deleteMessages(event){
  $.ajax(
    {
       type: 'post',
       url:  "../controllers/delete.php",
       data: { 
      
         "message_id": x,
    
        
       },
       success: function (response) {
         console.log("Success !!");
        
        //  var xmlhttp = new XMLHttpRequest();
        //  xmlhttp.open(this.type, this.url ,true);
        //  xmlhttp.send(this.data);
        //  console.log(this.type)
       console.log(response)
        const element = document.getElementById(x)
        element.style.display = "none"
       
       },
       error: function () {x
         console.log("Error !!");
       }
    }
    
   
 );

 let dropdownDiv = document.getElementsByClassName("dropdown")
    for (let i = 0; i < dropdownDiv.length; i++) {
      dropdownDiv[i].style.display = "none"
      
    }

}
var id
function sendMessage(event){
if(txt.value != ""){
          $.ajax(
            {
              type: 'post',
              url:  "../controllers/sendmessage.php",
              data: { 
                "group_id" : groupId,
                "message_content": txt.value,
                "message_id" : x
                
              },
              success: function (response) {
                id = response
                const cont = document.createElement("div")
                cont.setAttribute("class", "row") 
                cont.setAttribute("id", "messages") 
                const div3 = document.createElement("div")
                div3.setAttribute("class", "col-4")
                const div = document.createElement("div")
                div.setAttribute("class", "col-7")
                cont.appendChild(div3)
                cont.appendChild(div)
                
               
                const button2 = document.createElement("button")
                button2.setAttribute("class", "btn btn-primary messageEnvoye mt-2")
                button2.setAttribute("onclick", "show(event)")
                button2.setAttribute("style", "float : right; color: black;")
                button2.setAttribute("id", id)
                const pre = document.createElement("pre")
                const span = document.createElement("span")
                pre.setAttribute("onclick", "show(event)")
                span.setAttribute("class", "message_content_span")
                span.setAttribute("onclick", "show(event)")
                if (txt.value.startsWith("STICKER_")) {
                  let sticker = document.createElement("img");
                  sticker.src = `../assets/stickers/${txt.value.split("_")[1]}.png`;
                  sticker.style.width = "100px";
                  sticker.style.height = "100px";
                  span.appendChild(sticker);
                }
                else {
                  span.setAttribute("id",  id)
                  span.innerText = txt.value;
                }
                pre.appendChild(span)
                button2.appendChild(pre)
                div.appendChild(button2)
                const div0 = document.createElement("div")
                div0.setAttribute("class","dropdown")
                div0.setAttribute("style", "width:30px; margin-left:900px; margin-top:-30px;")
                div0.setAttribute("id", "dropdown"+id)
                
                const div1 = document.createElement("div")
                div1.setAttribute("class", "dropdown-content")
                div1.setAttribute("id", "dropdown-content")
                const a0 = document.createElement("a")
                a0.setAttribute("onclick", "myFunction(event)")
                a0.setAttribute("id", "editId"+id)
                a0.setAttribute("name", id)
                a0.innerText = "Edit"
                div1.appendChild(a0)
                div0.appendChild(div1)
                div.appendChild(div0)

                const a1 = document.createElement("a")
                a1.setAttribute("onclick", "deleteMessages(event)")
                a1.setAttribute("id", "delete"+id)
                a1.setAttribute("name", id)
                a1.innerText = "Delete"
                div1.appendChild(a1)
                cont0.appendChild(cont)
               
                cont.scrollIntoView({behavior: "smooth"})
                
             
                txt.value = ""
               
              },
              error: function () {x
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
