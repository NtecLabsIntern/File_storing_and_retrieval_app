$(".toggle-password").click(
    function(){
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input =$($(this).attr("toggle"));

        if(input.attr("type")=="password"){
            input.attr("type","text");
        }else{
            input.attr("type","password")
        }
    }
);

// validation box

var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

//validation on click

myInput.onfocus = function(){
    document.getElementById("validation_box").style.display ="block";
}

//hide the validation box outside of password field

myInput.onblur = function(){
    document.getElementById("validation_box").style.display = "none";
}

//when user starts to type something inside the password field

myInput.onkeyup = function(){

    //validation for lowercase

    var lowerCaseLetters = /[a-z]/g;

    if(myInput.ariaValueMax.match(lowerCaseLetters)){
        letter.classList.remove("invalide");
        letter.classList.add("valid");
    }else{

        letter.classList.remove("valid");
        letter.classList.add("invalid")
    }

     //validation for uppercase

     var upperCaseLetters = /[A-Z]/g;

     if(myInput.ariaValueMax.match(upperCaseLetters)){
        capital.classList.remove("invalide");
        capital.classList.add("valid");
     }else{
 
        capital.classList.remove("valid");
        capital.classList.add("invalid")
     }
     
      //validation for number

      var numbers = /[0-9]/g;

      if(myInput.ariaValueMax.match(numbers)){
         number.classList.remove("invalide");
         number.classList.add("valid");
      }else{
  
         number.classList.remove("valid");
         number.classList.add("invalid");
      }

      //validation for lenght 

      if(myInput.value.length>=6){
        length.classList.remove("invalid");
        length.classList.add("valid");
      }else{
        length.classList.remove("valid");
        length.classList.add("invalid");
      }
}