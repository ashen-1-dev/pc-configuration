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

