let logs;
const form = document.getElementById("iForm");
const alertas = document.getElementsByClassName("alert")
const inputs = document.getElementsByTagName("input");


fetch('/Evaluation-System/logs/logerrors.json')
  .then(response => response.json())
  .then(data => {
    
    logs = data;
    console.log(data);
})
  .catch(error => {
    console.error('Ocorreu um erro ao tentar abrir o arquivo JSON:', error);
  });



/**
 * 
 * @param {HTMLElement} parent 
 * @param {HTMLElement} element
 * @param {String} content
 * @param {HTMLElement} sibling
 * @param {Array} Attrs
*/
function insertCustomDOM(parent, element, sibling, content, Attrs){
    element.innerText = content;

    for (const key in Attrs) {
        if (Attrs.hasOwnProperty(key)) {
            element.setAttribute(key, Attrs[key]);
        }
    }
    
    parent.insertBefore(element, sibling)
}



for (let i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener("focus", function(event) {

        for (let i = 0; i < alertas.length; i++) {
            const element = alertas[i];
            element.remove();
        }
    });
}






document.getElementById("iForm").addEventListener("submit", function(event) {
    event.preventDefault();
    const alerts = document.getElementsByClassName("alert");


    if (alerts.length > 0) return;

    const name = document.getElementById("iName");
    const user = document.getElementById("iUser");
    const password1 = document.getElementById("iPassword1");
    const password2 = document.getElementById("iPassword2");


   
    const formErrors = logs.FORM_ERRORS;
    

    if (name.value.length < 3) {
        
        insertCustomDOM(form, document.createElement("div"), name.nextSibling, formErrors.NAME_ERROR, {class:"alert"})
        
        return;
    }

    if (user.value.length < 6) {
        
        insertCustomDOM(form, document.createElement("div"), user.nextSibling, formErrors.USER_CHR_ERROR, {class:"alert"})

        return;
    }

    if (password1.value.length < 8 ) return insertCustomDOM(form, document.createElement("div"), password1.nextSibling, formErrors.PASSWORD_CHR_ERROR, {class:"alert"}) ;
        
    if (password2.value.length < 8 ) return insertCustomDOM(form, document.createElement("div"), password2.nextSibling, formErrors.PASSWORD_CHR_ERROR, {class:"alert"});

   
    

    if (password1.value !== password2.value) {
        insertCustomDOM(form, document.createElement("div"), document.getElementById("iSubmit").previousSibling, formErrors.PASSWORD_UNMATCH_ERROR, {class:"alert"})

        
        return;
    }
    
    this.submit();

});
