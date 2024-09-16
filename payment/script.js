function paymentGateway(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = () => {
        if(xhttp.readyState == 4 && xhttp.status == 200){
            var obj = JSON.parse(xhttp.responseText);

            payhere.onCompleted = function onCompleted(orderId) {
                var amount = obj["amount"];
                var itemName = "Product XYZ";
                
                window.location.href = 'payment.php?orderId=' + orderId + '&amount=' + amount + '&itemName=' + itemName;
            };

            payhere.onDismissed = function onDismissed() {
                alert("Payment dismissed");
            };

            payhere.onError = function onError(error) {
                alert("Error:"  + error);
            };

            var payment = {
                "sandbox": true,
                "merchant_id": "1223737",    
                "return_url": "http://localhost/OIMS/payment/",     
                "cancel_url": "http://localhost/OIMS/payment/",   
                "notify_url": "http://localhost/OIMS/payment/notify.php", 
                "order_id": obj["order_id"],
                "items": "Door bell wireles",
                "amount": obj["amount"],
                "currency": obj["currency"],
                "hash": obj["hash"], 
                "first_name": "Saman",
                "last_name": "Perera",
                "email": "samanp@gmail.com",
                "phone": "0771234567",
                "address": "No.1, Galle Road",
                "city": "Colombo",
                "country": "Sri Lanka",
                "delivery_address": "No. 46, Galle road, Kalutara South",
                "delivery_city": "Kalutara",
                "delivery_country": "Sri Lanka",
                "custom_1": "",
                "custom_2": ""
            };

            payhere.startPayment(payment);
        }
    }
    xhttp.open('GET',"payhereprocess.php",true);
    xhttp.send();
}