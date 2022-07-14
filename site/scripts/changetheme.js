function changetheme(id) {
    var xmlhttp = new XMLHttpRequest();
    let rq = "../controllers/changetheme.php?theme=" + id;
    xmlhttp.open("GET", rq,false);
    xmlhttp.send();
    const bg = "url('../assets/images/themes/"+id+".jpg')";
    document.body.style.backgroundImage = bg;

}