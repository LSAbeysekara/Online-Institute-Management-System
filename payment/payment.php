<?php
if (isset($_GET['orderId']) && isset($_GET['amount']) && isset($_GET['itemName'])) {
    $orderId = $_GET['orderId'];
    $amount = $_GET['amount'];
    $itemName = $_GET['itemName'];

    echo "Received Order ID: " . $orderId . "<br>";
    echo "Amount:" . $amount . "<br>";
    echo "Item Name: " . $itemName;
} else {
    echo "Required parameters not provided.";
}
?>
