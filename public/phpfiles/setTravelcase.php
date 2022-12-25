<?php
    header('Access-Control-Allow-Origin:*');
    header("Content-Type:application/json;charset=utf-8");

    try{
		require_once("./connect_cgd103g4.php");
		//sql 指令
		$sql = "insert into `travel_package` values (
            null, 
            :package_name, 
            current_date(), 
            :package_status, 
            :package_price, 
            :package_title, 
			:package_subtitle,
            :package_des,
            :package_tag,
            :package_pic,
            :package_buy,
            :package_indes
			)";
		//編譯, 執行
		$items = $pdo->prepare($sql);	
		$items->bindValue(":package_name", $_POST["package_name"]);
		$items->bindValue(":package_status", $_POST["package_status"]);
		$items->bindValue(":package_price", $_POST["package_price"]);
		$items->bindValue(":package_title", $_POST["package_title"]);
		$items->bindValue(":package_subtitle", $_POST["package_subtitle"]);
		$items->bindValue(":package_des", $_POST["package_des"]);
		$items->bindValue(":package_tag", $_POST["package_tag"]);
		$items->bindValue(":package_pic", $_POST["package_pic"]);
		$items->bindValue(":package_buy", $_POST["package_buy"]);
		$items->bindValue(":package_indes", $_POST["package_indes"]);
		$items->execute();	

        $msg = "新增成功";
	} catch (PDOException $e) {
		$msg = "錯誤行號 : ".$e->getLine().", 錯誤訊息 : ".$e->getMessage();
	}	
    echo json_encode($msg)
?>