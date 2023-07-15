 // Name and Email validation Function.
function validation(){
    var name = document.getElementByClass("firstname").value;
    var name = document.getElementByClass("lastname").value;
    var email = document.getElementByClass("e-mail").value;
    var emailReg = /^([w-.]+@([w-]+.)+[w-]{2,4})?$/;
    if( name ==='' || email ===''){
    alert("Please fill all fields...!!!!!!");
    return false;
    }else if(!(email).match(emailReg)){
    alert("Invalid Email...!!!!!!");
    return false;
    }else{
    return true;
    }
    }
document.getElementById("signup").onclick = function() {  
fun()  
};  
function fun() {  
document.getElementById("signup").submit(); 
}
document.getElementById("reset").onclick = function() {  
    fun()  
    };  
    function fun() {  
    document.getElementById("reset").submit(); 
    }