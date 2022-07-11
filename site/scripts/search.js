var button = document.querySelector('.search');
var input = document.querySelector('.srch-input');
var groups = document.getElementsByClassName('.card');
var names = document.getElementsByClassName('group-name');



button.onclick = function(){
    for (i = 0; i < 3; i++) {
        var grp_name = names[i].innerHTML;
        if (input.value != grp_name) {
            groups[i].style.display = "none";
        }
    }
    return false;
};

//<li class="list-group-item group-name">myGroup2</li>