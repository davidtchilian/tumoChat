function changetheme(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "changetheme.php?theme="+id,true);
    xmlhttp.send();

}