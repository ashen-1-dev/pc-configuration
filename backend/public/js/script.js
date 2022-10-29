var allComponents = document.querySelectorAll(".component"); 
allComponents.forEach(component => {

    
    component.addEventListener('click', function(event) {
        if(event.target !== this)   
            return;
    

        if(component.classList.contains('expanded')) {
            component.classList.remove('expanded');
            return
        }
        component.classList.add('expanded'); 
        
        
    });
});
var button = document.getElementById('add-attribute');

let i = 0;
button.addEventListener('click', () => {
    var parent = button.parentNode;
    parent.insertBefore(createNewAttributeForm(i), button);
    i++;
});

var createNewAttributeForm = (i) => {
    var div = document.createElement('div');
    div.classList.add('attribute-item')
    var inputName = document.createElement('input');
    inputName.setAttribute('type', 'text');
    inputName.setAttribute('placeholder', 'Название характеристики');

    inputName.setAttribute('name', 'attributes[' + i + '][name]');

    var inputValue = document.createElement('input');
    inputValue.setAttribute('type', 'text');
    inputValue.setAttribute('placeholder', 'Значение');
    inputValue.setAttribute('name', 'attributes[' + i + '][value]');
    div.appendChild(inputName);
    div.appendChild(inputValue);
    return div;
}

// var elementByNameAttributeExist = (name) => {
//     console.log(name)
//     console.log(document.getElementsByClassName(name))
//     console.log(document.getElementsByClassName(name).length > 0)
//     return document.getElementsByName(name).length > 0;
// }
