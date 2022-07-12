var button = document.querySelector('.search');
var input = document.querySelector('.srch-input');
var groups = document.getElementsByClassName('card');
var names = document.getElementsByClassName('group-name');
var namesArr = [];

for (i = 0; i < groups.length; i++) {
    namesArr[i] = names[i].innerHTML;
}

button.onclick = function(){
    var anun = namesArr.filter(function (elements) {
        return elements.includes(input.value);
    })
    // for (i = 0; i < groups.length; i++) {
    //     groups[i].setAttribute("style", "display: none;");
    //     if (anun.includes(String(names[i]))) {
    //         groups[i].setAttribute("style", "display: block;");
    //     };
    // };
    return false;
};

//<li class="list-group-item group-name">myGroup2</li>
// var groups = document.querySelector('.col-lg-4')

// button.addEventListener("click", search());

// function search() {
//     input.value = "Hello";
// };

