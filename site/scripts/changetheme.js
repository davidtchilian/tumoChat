function changetheme(id) {
    var xmlhttp = new XMLHttpRequest();
    let rq = "../controllers/changetheme.php?theme=" + id;console.log(rq);
    xmlhttp.open("GET", rq,false);
    xmlhttp.send();
    const bg = "url('../assets/images/themes/"+id+".jpg')";
    console.log(bg);
    document.body.style.backgroundImage = bg;

}