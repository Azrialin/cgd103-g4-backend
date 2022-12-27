<?php 
const MY_DIR = "images";

switch($_FILES["image"]["error"] ){
	case UPLOAD_ERR_OK : 
		
		if( file_exists(MY_DIR) == false){
			mkdir(MY_DIR); //make directory
		}
		$from = $_FILES["image"]["tmp_name"];

		//$_FILES["image"]["name"]; //smile.gif,  sara.smile.gif, a313feexrer.gif
		$fileExt = pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION); //取得副檔名
		$fileName = uniqid() . ".". $fileExt; //決定檔案名稱, 如a313feexrer.gif
		$to = MY_DIR . "/". $fileName; //決定路徑名稱
		if(copy( $from, $to)){
			$msg = "上傳成功";
		}else{
			$msg = "上傳失敗";
		}
		break;
	case UPLOAD_ERR_INI_SIZE:
	    $msg = "上傳檔案太大,不能超過 ". ini_get("upload_max_filesize") ;	
	    break;
	case UPLOAD_ERR_FORM_SIZE:
	    $msg = "上傳檔案太大,不能超過 ".$_POST["MAX_FILE_SIZE"];			    
	    break;
    case UPLOAD_ERR_PARTIAL:
    	$msg = "上傳檔案不完整";
    	break;
    case UPLOAD_ERR_NO_FILE:
        $msg = "没有上傳檔案";
        break;
    default:
        $msg = "上傳檔案失敗，錯誤代碼: ".$_FILES["error"]."請通知系統開發人員";
}
if( $_FILES["image"]["error"] === 0){
  	
	try{
		require_once("./connect_cgd103g4.php");
		//sql 指令
		$sql = "insert into product values (null, :pname, :price, :author, :pages,:image)";
		//編譯, 執行
		$product = $pdo->prepare($sql);	
		$product->bindValue(":pname", $_POST["pname"]);
		$product->bindValue(":price", $_POST["price"]);
		$product->bindValue(":author", $_POST["author"]);
		$product->bindValue(":pages", $_POST["pages"]);
		$product->bindValue(":image", $fileName);
		$product->execute();	

	    $msg = "新增成功";
	} catch (PDOException $e) {
		$msg = "錯誤行號 : ".$e->getLine().", 錯誤訊息 : ".$e->getMessage();
	}	
}
//輸出結果
$result = ["msg"=>$msg];
echo json_encode($result);
?>    