<?php
// 解決跨域問題
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");

try{
	require_once("./connect_cgd103g4.php");
	// sql 指令
	// 跟資料庫表格的欄位數目必須相同
	//$id = $_POST['emp_id'];
	//$sql = "select * from `emp` where emp_id = :emp_id";
	$sql = "insert into emp values (:emp_psw, :emp_name, :emp_email, :emp_status)";
	// 編譯, 執行
	$faq = $pdo->prepare($sql);
	// $faq->bindValue(":emp_id", $_POST["emp_id"]);
	$faq->bindValue(":emp_psw", $_POST["emp_psw"]);
	$faq->bindValue(":emp_name", $_POST["emp_name"]);
	$faq->bindValue(":emp_email", $_POST["emp_email"]);
	$faq->bindValue(":emp_status", $_POST["emp_status"]);
	$faq->execute();

	$msg = "新增成功";
}
// 成功連上後，如果有錯會跳訊息
catch (PDOException $e) {
	$msg = "錯誤行號 : ".$e->getLine().", 錯誤訊息 : ".$e->getMessage();
}

// 輸出結果
$result = ["msg"=>$msg];
echo json_encode($result);
?>