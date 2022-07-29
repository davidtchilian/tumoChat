function changetheme(id) {
    var xmlhttp = new XMLHttpRequest();
    let rq = `../controllers/changetheme.php?theme=${id}`;
    xmlhttp.open("GET", rq,false);
    xmlhttp.send();
    const bg = "url('../assets/images/themes/"+id+".jpg')";
    document.body.style.backgroundImage = bg;
    if(id == 1 || id == 3){
        document.getElementById("noFriends").style.color = "#fff";
        document.getElementById("FriendsText").style.color = "#fff";
    }
    else{
        document.getElementById("noFriends").style.color = null;
        document.getElementById("FriendsText").style.color = null;  
    }
}
