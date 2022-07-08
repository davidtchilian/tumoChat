var button = document.querySelector('.search');
var input = document.querySelector('.srch-input');
var groups = document.querySelector('.col-lg-4')

button.addEventListener("click", search());

function search() {
    input.value = "Hello";
};

