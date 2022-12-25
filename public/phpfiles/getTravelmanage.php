<?php
    header('Access-Control-Allow-Origin:*');
    header("Content-Type:application/json;charset=utf-8");

    
    require_once("./connect_cgd103g4.php");
		//sql 指令
    $sql = "select 
    e.package_no, e.package_name, e.package_price, d.mem_no, d.mem_name, f.package_pay_status, f.package_order_date, f.package_ticket_amount 
    from travel_package e 
    join package_order f on(e.package_no = f.package_order_no) 
    join member d on (f.mem_no = d.mem_no)";
    //編譯, 執行
    $items = $pdo->query($sql);
    $itemsRow = $items->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($itemsRow);
?>