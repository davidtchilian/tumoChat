var button = document.querySelector('.search');
var input = document.querySelector('.srch-input');
<<<<<<< HEAD
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
=======
var groups = document.querySelector('.col-lg-4')

button.addEventListener("click", search());

function search() {
    input.value = "Hello";
};

>>>>>>> b3da7349c76c8e80163ea5e21ede6ad323279fa6
