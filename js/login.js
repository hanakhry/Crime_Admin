function validate(){
var username = document.getElementById("inputEmail").value;
var password = document.getElementById("inputPassword").value;
if ( username == "admin" && password == "admin"){
alert ("Login successfully");
window.location = "dashboard.php"; 
return false;
}
else{
alert("Wrong Username or Password !");

}
}