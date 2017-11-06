<?php
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/models/Model.php');
require_once(ROOT.'/components/Db.php');


        // Соединение с БД
$list = Model::getDatchiki();
print_r($list);
foreach($list as $datchik) {
	$id = $datchik['id'];
	$new_value = rand(1,100);
	$db = Db::getConnection();
	$sql = "UPDATE datchik 
	SET value = :value  
	WHERE id = :id";
	$result = $db->prepare($sql);
	$result->bindParam(':id', $id, PDO::PARAM_INT);
	$result->bindParam(':value', $new_value, PDO::PARAM_INT);
	$result->execute();
 

}
?>