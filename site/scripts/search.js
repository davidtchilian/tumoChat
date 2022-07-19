var button = document.querySelector('.search');
var input = document.querySelector('.srch-input');
var groups = document.getElementsByClassName('group-chats');
var names = document.getElementsByClassName('group-name');
var namesArr = [];



function updateNames(){
    namesArr = []
    for (i = 0; i < groups.length; i++) {
        namesArr[i] = names[i].innerHTML.toLowerCase();
    }
}

function updateElements(){
    groups = document.querySelectorAll('.group-chats')
    names = document.querySelectorAll('.group-name')
}

function find(){
    updateNames()

    var anun = namesArr.filter(function (elements) {
        return elements.includes(input.value);
    })
    for (i = 0; i < groups.length; i++) {
        if (anun.includes(String(namesArr[i]).toLowerCase())) {
            groups[i].setAttribute("style", "display: block;");
        }else{
            groups[i].setAttribute("style", "display: none;");
        }
    };
    return false;
}

input.addEventListener('input', function(){
    find();
});


button.onclick = find();