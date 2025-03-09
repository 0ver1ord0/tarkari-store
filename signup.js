function register(){
    var first=document.getElementById('first').value;
    var last=document.getElementById('last').value;
    var number=Number(document.getElementById('number').value);
    var email=document.getElementById('email').value;
    var password=document.getElementById('password').value;

    if(first=='' && last==''){
        document.write("please enter your name");
        return;
    }

    var numberpattern=/^[0-9]+&/;
    if(!numberpattern.match(number) && number==''){
        document.write("Please enter valid number");
        return;
    }
}