"use strict"
class App{
    constructor(){
        this.xmlhttp;
        this.initAjax();
        this.setupEventHandler();
    }

    initAjax(){
        //If, the activexobject is available, we must be using IE.
        if (window.ActiveXObject){
            this.xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } else {
            //Else, we can use the native Javascript handler.
            this.xmlhttp = new XMLHttpRequest();
        }
    }

    ajax(url, type, datastring, callback){
        this.xmlhttp.open(type, url, true);
        this.xmlhttp.onreadystatechange = ()=> {
            if (this.xmlhttp.readyState == 4 && this.xmlhttp.status == 200) {
                callback(this.xmlhttp.responseText);
            }
        }
        type === 'POST'? this.xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded") : null;
        this.xmlhttp.send(type === 'GET'? null : datastring);
    }

    setupEventHandler(){
        var btnreg = document.getElementById('btn-reg'), 
        btncancel = document.getElementById('btn-cancel'),
        btnlogin = document.getElementById('btn-login'),
        btnsignup = document.getElementById('btn-signup'),
        cardlogin =  document.getElementById('cardlogin'),
        cardreg =  document.getElementById('cardreg'),
        txtemail = document.getElementById('txt-email'),
        txtpassword = document.getElementById('txt-password'),

        txtfname = document.getElementById('txt-fname'),
        txtlname = document.getElementById('txt-lname'),
        txtemailr = document.getElementById('txt-emailr'),
        txtpasswordr = document.getElementById('txt-passwordr'),
        txtrepassword = document.getElementById('txt-repassword');

        btnreg.addEventListener('click', (e)=>{
            var p = e.currentTarget.parentElement;
            p.classList.add('dactive');
            cardreg.classList.remove('dactive');
        });

        btncancel.addEventListener('click', (e)=>{
            var p = e.currentTarget.parentElement;
            p.classList.add('dactive');
            cardlogin.classList.remove('dactive');
        });

        btnlogin.addEventListener('click', (e)=>{
            let datastring = 'login=true&email=' + txtemail.value + '&password=' + txtpassword.value;
            this.ajax(
                //window.location.hostname + '/pre-order/controller/login.php',
                'app/server.php',
                'POST',
                datastring,
                (data)=>{
                    let jsondata = JSON.parse(data);
                    if (jsondata != false) {
                        location.href = 'order.php?name=' + jsondata.fname + ' ' + jsondata.lname;
                    }else{
                        alert('Please sign in first.');
                    }
                }
            );
        });

        btnsignup.addEventListener('click', (e)=>{

            if(txtpasswordr.value != txtrepassword.value) {
                alert("Password mismatch");
            } 

            let id = (new Date()).getTime().toString(36);//creates new customer id
            let datastring = 'register=true&id='+ id + '&fname=' + txtfname.value + '&lname=' + txtlname.value + '&email=' + txtemailr.value + '&password=' + txtpasswordr.value;
            this.ajax(
                'app/server.php',
                'POST',
                datastring,
                (data)=>{
                    let jsondata = JSON.parse(data);
                    if (jsondata != false) {
                        cardreg.classList.add('dactive');
                        cardlogin.classList.remove('dactive');
                        alert("Please login to continue.");
                    }
                }
            );
        });
    }
}
