<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <form action="action">
            <h1>Payment</h1>
            <hr>
                <label class="acccard" for="acccard">Accepted Cards</label>
                <div class="icon-container">
                <i class="fa fa-cc-visa" style="color:navy;"></i>
                <i class="fa fa-cc-paypal" style="color:blue"></i>
                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                </div>
                <label for="cname">Name on Card</label><br>
                <input class="box1" type="text" id="cname" name="cardname" placeholder="Name"><br>

                <label for="cname">Credit card number</label><br>
                <input class="box1" type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444"><br>

                <label for="expmonth">Exp Month</label><br>
                
                <select class="box1" id="expmonth" name="expmonth">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select><br>

                <div class="div1">
                    <label for = "cardye">Exp Year</label><br>
                    <input class = "box2" type = "year" name = "year" id = "year" placeholder = "YYYY"><br>
                </div>

                <div class="div1">
                    <label for="cardCVC">CVV</label><br>
                    <input class = "box2" type="cvv" name="cvv" id="cvv" placeholder = "CVV"><br>
                </div>

                <label>
                <br><input type="checkbox" checked="checked" name="savecard">Save card details for next time
                </label>
                <hr>
                <p>Total <span id="totalAmount" class="price" style="color:black"><b></b></span></p>
                <p class="VAT">The total cost includes a 15% VAT</p>
                <input type="submit" value="Continue to checkout" class="btn">

                <script>
                      // Assuming you pass the total amount as a query parameter in the URL
                      var urlParams = new URLSearchParams(window.location.search);
                      var totalAmount = urlParams.get('totalAmount');

                      // Display the total amount on the payment page
                      document.getElementById('totalAmount').innerHTML = `<b>${totalAmount} SAR</b>`;
                </script>
        </form>
    </div>
</body>
</html>

<style>
@import url("https://fonts.googleapis.com/css?family=Poppins");

body{
  margin:0 ;
  padding: 0;
  background-color: #bbb;
  font-family: "Poppins", sans-serif;
}

.container{
  width: 600px;
  height: 720px;
  margin: 50px auto 0 320px;
  padding: 25px;
  background-color:whitesmoke;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

h1{
  text-align: center;
}
.acccard{
 padding: 7px 0 0  440px;
}
.icon-container{
  margin-bottom: 20px;
  padding: 7px 0 0  455px;
  font-size: 24px
}

form{
  width: 600px;
  margin: 10px auto 0 auto;
  padding: 10px;
}

select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
  margin-bottom: 15px;
  font-size: 16px;
  color: #555;
}

select option {
  background-color: #fff;
  color: #555;
}

select:focus {
  outline: none;
  border-color: #66afe9;
  box-shadow: 0 0 5px #66afe9;
}

.box1{
  width: 100%;
  padding: 10px;
  border: none;
  box-sizing: border-box;
  margin: 15px 0 15px 0;

}

.div1{
  display: inline-block;

}

.box2{
  padding: 10px;
  border: none;
  margin: 10px 5px 15px 0;
}

span.price {
  float: right;
  color: grey;
}

.VAT{
 font-size: 12px;
 color: #bbb;
}

.btn {
  background-color: #AC3B61;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: rgb(61, 69, 75);
}
</style>
