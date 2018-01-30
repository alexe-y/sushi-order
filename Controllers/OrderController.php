<?php

class OrderController
{
    public function __construct()
    {
        require_once  ROOT. '/Models/Order.php';

    }

    public function actionOrders(){
        $orderList=Order::getOrderList();
        include ROOT.'/Views/orders.php';
        return true;
    }

    public function actionIndex(){
        include_once ROOT.'/Views/header.php';
        $this->actionOrders();
        require_once ROOT.'/Views/footer.php';
        return true;
    }

    public static function actionEditOrder()
    {
//        if (isset($_POST)) {
//            $name = trim($_POST['name']);
//            $price = trim($_POST['price']);
//            $supplier = trim($_POST['supplier']);
//            $ttn = trim($_POST['ttn']);
//            $result = Part::addPart($name, $price, $supplier, $ttn, '');
//        }
//        header("Location: /admin/parts");
        return true;
    }

}