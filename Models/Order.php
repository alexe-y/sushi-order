<?php
class Order
{
    public static function updatePart($item)
    {
        $db = db::getInstance()->db;
        $result = $db->prepare("UPDATE parts SET name=:name,  price=:price, supplier=:supplier, ttn=:ttn WHERE id_item=:id_item AND id=:id;");
        $result->execute(array(
            'name' => $item['part'],
            'price' => $item['part_price'],
            'supplier' => $item['supplier'],
            'ttn' => $item['ttn'],
            'id_item' => $item['id'],
            'id' => $item['id_part'],
        ));
        return $result;
    }

    public static function addPart($name, $price, $supplier, $ttn, $id_item)
    {
        $db = db::getInstance()->db;
        $result = $db->prepare("INSERT INTO parts (id_item, name, price, ttn, supplier) VALUES (:id_item, :name, :price, :ttn, :supplier);");
        $result->execute(array(
            'name' => $name,
            'price' => $price,
            'supplier' => $supplier,
            'ttn' => $ttn,
            'id_item' => $id_item,
        ));
        return $result;
    }

    public static function getOrderList()
    {
        $db = db::getInstance()->db;
        $result = $db->query('SELECT o.* FROM mg_order o  ORDER BY add_date DESC');
        $i = 0;
        $orderList = false;
        while ($row = $result->fetch()) {
            $orderList[$i]['id'] = $row['id'];
            $orderList[$i]['update_date'] = $row['updata_date'];
            $orderList[$i]['add_date'] = $row['add_date'];
            $orderList[$i]['close_date'] = $row['close_date'];
            $orderList[$i]['phone'] = $row['phone'];
            $orderList[$i]['address'] = $row['address'];
            $orderList[$i]['summ'] = $row['summ'];
            $orderList[$i]['order_content'] = unserialize(stripslashes($row['order_content']));
            $i++;
        }


        return $orderList;
    }
}
