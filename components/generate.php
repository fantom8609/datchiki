<?php
        // Соединение с БД
$db = Db::getConnection();
$list = Model::getDatchiki();
foreach($list as $datchik) {
	$id = $datchik['id'];
	$new_value = rand(1,100);
	$sql = "UPDATE datchik 
	SET value = :value,  
	WHERE id = :id";
	$result = $db->prepare($sql);
	$result->bindParam(':id', $id, PDO::PARAM_INT);
	$result->bindParam(':value', $new_value, PDO::PARAM_INT);
	$result->execute();
}



?>