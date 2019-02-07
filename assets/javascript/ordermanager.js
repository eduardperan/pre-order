"use strict"
class OrderManager{
    constructor(){
        this.subitems = [];
        this.subid;

        //create instance of XMLHttpRespones obj
        this.initAjax();
        this.setupEventHandler();//set up all event listeners

        //if user is already login display the summary details of his/her pre-order
        this.ajax(
            'app/server.php?getsubid=true',
            'GET',
            null,
            (data)=>{
                let jsondata = JSON.parse(data);
                if (jsondata) {
                    let subid = jsondata;
                    this.orderDetails(subid);
                }else{
                    //get al available sub items
                    this.getAllSubItems();
                }
            }
        );
       
    }

    mode(isorder){
        let cat_cont = document.getElementById('categories-container');
        let det_cont = document.getElementById('orderdetails-container');
        let btn_order = document.getElementById('btn-order');
        let fc = document.getElementById('form-container');
        if (isorder) {
            cat_cont.classList.remove('dactive')
            det_cont.classList.add('dactive');
            btn_order.style.display = 'block';
            fc.style.display = 'block';
        } else {
            cat_cont.classList.add('dactive')
            det_cont.classList.remove('dactive');
            btn_order.style.display = 'none';
            fc.style.display = 'none';
        }
        
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

    getAllSubItems(){
        this.mode(true);
        this.ajax(
            'app/server.php?getallitems=true',
            'GET',
            null,
            (data)=>{
                let jsondata = JSON.parse(data);
                jsondata.forEach(category => {
                    this.subitems.push(new SubItem(category.id, category.name, category.items));
                });
            }
        );
    }

    setupEventHandler(){
        document.getElementById('btn-order')
        .addEventListener('click', (e)=>{
            if (document.querySelectorAll('input:checked').length <=0) {
                alert("Please choose from the menu.");
                return;
            } 
            this.checkOrderIfExist();
            this.checkOrderIfLate();
            this.saveCustomerSubId();
        });

        document.getElementById('btnlogout')
        .addEventListener('click', ()=>{
            location.href = "app/server.php?logout=1";
        });
    }

    checkOrderIfExist(){
        this.ajax(
            'app/server.php?chkifexst=true',
             'GET',
            null,
            (data)=>{
                let jsondata = JSON.parse(data);
                if (jsondata) {
                    alert('1 order per day only');
                    return; 
                }
            }
        );
    }

    checkOrderIfLate(){
        this.ajax(
            'app/server.php?chkiflte=true',
             'GET',
            null,
            (data)=>{
                let jsondata = JSON.parse(data);
                if (jsondata) {
                    alert('Late orders are not accepted.');
                    return; 
                }
            }
        );
    }

    saveCustomerSubId(){
        this.subid = (new Date()).getTime().toString(36);//creates new sub id
        let datastring = 'scsid=true&subid=' + this.subid;
        this.ajax(
            'app/server.php',
             'POST',
            datastring,
            (data)=>{
                let jsondata = JSON.parse(data);
                if (jsondata != false) {
                    this.saveSubItems();
                }
            }
        );
    }

    saveSubItems(){
        let categories_container = document.getElementById('categories-container');
        let queryStr = "insert into tblsubitem (sub_id, item_id) values";
        for(let i=0; i<categories_container.childElementCount; i++){
            let categorydiv = categories_container.children[i];
            let items_cont = categorydiv.children[1];
            for(let y=0; y<items_cont.childElementCount; y++){
                let input = items_cont.children[y].children[0];
                if(input.checked){
                    queryStr += "('" + this.subid + "', " + input.value + "),";
                 }
            }
        }
        queryStr = queryStr.substring(0, queryStr.length - 1) + ";";

        let datastring = 'ssitems=true&querystr=' + queryStr;
        this.ajax(
            'app/server.php',
             'POST',
            datastring,
            (data)=>{
                let jsondata = JSON.parse(data);
                if (jsondata != false) {
                    this.preOrder();
                }
            }
        );

    }

    preOrder(){
        let datastring = 'preorder=true&subid=' + this.subid + '&date=' + document.getElementById('txt-date').value;
        this.ajax(
            'app/server.php',
             'POST',
            datastring,
            (data)=>{
                let jsondata = JSON.parse(data);
                if (jsondata != false) {
                    this.orderDetails(this.subid);    
                }
            }
        );
    }

    orderDetails(subid){
        this.mode(false);
        this.ajax(
            'app/server.php?orddetails=true&subid=' + subid,
            'GET',
            null,
            (data)=>{
                let jsondata = JSON.parse(data);
                if (jsondata != false) {
                    //console.log(jsondata);
                    jsondata.forEach(item => {
                        let li = document.createElement('li');
                        li.setAttribute('id', item.id);
                        li.textContent = item.name;
                        document.getElementById(`box-cat-${item.cat_id}`).classList.remove('dactive');
                        document.getElementById(`cat-${item.cat_id}`).appendChild(li);
                    });

                }
            }
        );
    }

}