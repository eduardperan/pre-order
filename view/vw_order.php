<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cutomer | Pre-Order</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="assets/css/order.css"/>

</head>
<body>

<div class="container">
    <div class="box">
        <div id="order-section" class="panel">
            <div class="panel-header">
                <div>
                    <p style="font-size: 25px; font-weight: bold;">Pre-Order Your <span style="color: red;">SUB</span> by 8:30am</p>
                    <p>Late orders are <span style="text-decoration: underline;">not</span> accepted</p>
                    <span style="text-decoration: underline;">Orders not picked upp will not be allowed to pre order again</span>
                </div>
                <div id="form-container">
                    <table>
                        <tr>
                            <td>
                                <label>First and Last Name:</label>
                            </td>
                            <td>
                                <input id="txt-fullname" value="<?php echo $_GET['name'];?>" type="text"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Date:</label>
                            </td>
                            <td>
                                <input id="txt-date" value="<?php echo date("Y-m-d");?>" type="date"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a id="btnlogout" href="#">Logout</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="panel-body">
                <div id="categories-container">
                    <!-- sub category will appear here -->   
                </div>
                <div id="orderdetails-container" class="orderdetails-section dactive">
                    <!-- order details will appear here -->
                    <div id="box-summary">
                        <h3>Pre-Order Summary: </h3>
                        <div id="box-cat-1" class="dactive">
                            <p>#1 Bread</p>
                            <ul id="cat-1">
                                <!-- items will goes here -->
                            </ul>
                        </div>
                        <div id="box-cat-2" class="dactive">
                            <p>#2 Sause</p>
                            <ul id="cat-2">
                                <!-- items will goes here -->
                            </ul>
                        </div>
                        <div id="box-cat-3" class="dactive">
                            <p>#3 Sandwich Type</p>
                            <ul id="cat-3">
                                <!-- items will goes here -->
                            </ul>
                        </div>
                        <div id="box-cat-4" class="dactive">
                            <p>#4 Cheese</p>
                            <ul id="cat-4">
                                <!-- items will goes here -->
                            </ul>
                        </div>
                        <div id="box-cat-5" class="dactive">
                            <p>#5 Veggies</p>
                            <ul id="cat-5">
                                <!-- items will goes here -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button id="btn-order">Order</button>
            </div>
        </div>
    </div>
</div>

<!-- included javascript -->
<script src="assets/javascript/subitem.js"></script>
<script src="assets/javascript/ordermanager.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    new OrderManager();
});
</script>

</body>
</html>