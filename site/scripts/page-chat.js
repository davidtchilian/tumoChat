var modal = document.getElementById("infoModal");
var btn = document.getElementById("infoButton");
var span = document.getElementById("closeButton");
var info = document.getElementById("groupInfo");
var usersInfo = document.getElementById("usersInfo");

window.onload = () => {
  window.scrollTo(0, document.body.scrollHeight);
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
}


function getGroupIdInfo(groupId) {
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
    let id = 1
    info.innerText = groupInfo.group_name + " - " + groupInfo.group_bio;
    for (let user of groupUsersInfo) {
      let userInfo = document.createElement("li");
      userInfo.classList.add("user_info_page")
      userInfo.innerText = user[0].user_email;


      let user_delete_button = document.createElement("button")
      user_delete_button.classList.add("user_delete_button")
      user_delete_button.innerText = "X"
      
      //let user_id = document.createTextNode(id)
      
      usersInfo.appendChild(userInfo);
      //userInfo.insertBefore(user_id,userInfo.firstChild)
      userInfo.appendChild(user_delete_button)

      let AdduserButton = document.createElement("button")
      AdduserButton.classList.add("add_user","btn")
      AdduserButton.setAttribute("id","add_user")
      AdduserButton.innerText = "Add User"
      document.getElementById("modal_buttons").insertBefore(AdduserButton,document.getElementById("modal_buttons").firstChild)
      //id++;
    }
  }
}
const edit = document.getElementById("editId")
const txt = document.getElementById("text")


function myFunction(event) { 
  var x = event.target;
  console.log(x.innerText);
  console.log(x.name);
  console.log(x)
  if(x != edit){
    txt.value = x.innerText
    console.log(true)
  }
}

function update(){
  // form.action = ".../controllers/update.php"
  txt.innerText = "<?= $message?>"
  console.log(1)
}