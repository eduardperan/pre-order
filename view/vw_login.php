<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cutomer | Login</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="assets/css/login.css"/>

</head>
<body>

<div class="container">
    <div class="form-box">
        <div class="box-header">
            <span>Login/Register</span>
        </div>
        <div class="box-body">
            <div id="cardlogin" class="card-login">              
                <input id="txt-email" placeholder="email" type="text" name="email"/> 
                <input id="txt-password" placeholder="password" type="password" name="password"/>
                <button id="btn-login">Log In</button>         
                <button id="btn-reg">Register</button>           
            </div>
            <div id="cardreg" class="card-register dactive"> 
                <input id="txt-fname" placeholder="first name" type="text" name="fname"/> 
                <input id="txt-lname" placeholder="last name" type="text" name="lname"/>             
                <input id="txt-emailr" placeholder="email" type="email" name="email"/> 
                <input id="txt-passwordr" placeholder="password" type="password" name="password"/>
                <input id="txt-repassword" placeholder="retype-password" type="repassword" name="repassword"/>
                <button id="btn-signup">Register</button>       
                <button id="btn-cancel">Cancel</button>         
            </div>
        </div>
    </div>
</div>

<!-- included javascript -->
<script src="assets/javascript/app.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    new App();
});
</script>

</body>
</html>