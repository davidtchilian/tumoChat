function changetheme(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "../controllers/changetheme.php?theme="+id,true);
    xmlhttp.send();

}