function changetheme(id) {
    var xmlhttp = new XMLHttpRequest();
    let rq = "../controllers/changetheme.php?theme=" + id;console.log(rq);
    xmlhttp.open("GET", rq,false);
    xmlhttp.send();

}