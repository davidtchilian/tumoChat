var button = document.querySelector('.search');
var input = document.querySelector('.srch-input').value;
var groups = document.querySelector('.card');
var names = document.getElementsByClassName('group-name');

for(i = 0; i < 3; i++){
    var grp_name = names[i];
    if(grp_name = input){
        alert("Yes");
    };
};

// button.onclick = function(){
//     alert(input);
// };