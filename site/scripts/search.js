var button = document.querySelector('.search');
var input = document.querySelector('.srch-input');
var groups = document.getElementsByClassName('card');
var names = document.getElementsByClassName('group-name');



// button.onclick = function(){
//     for (i = 0; i < groups.length; i++) {
//         var grp_name = names[i].innerHTML;
//         if (input.value != grp_name) {
//             groups[i].setAttribute("style", "display: none;");
//         };
//     };
//     return false;
// };
var anun;
button.onclick = function clicked(){
    anun = names.filter(function (element) {
        return element.includes(input.value);
    })
    console.log(anun);
    return false;
};

//<li class="list-group-item group-name">myGroup2</li>
// var groups = document.querySelector('.col-lg-4')

// button.addEventListener("click", search());

// function search() {
//     input.value = "Hello";
// };

