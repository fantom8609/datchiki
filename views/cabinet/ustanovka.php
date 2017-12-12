<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 table-responsive">
			<h3 class="text-center">Установка значения датчика в ручную</h3>

			<form method="post">
				<p><?php echo $datchik['name']; ?></p>
                <input type="text" name="new_value" value="<?php echo $datchik['value']; ?>">
                <?php echo  $datchik['izm']; ?><br>
                <input type="submit" name="set_value" value="установить новое значение">
			</form>
	
		</div>
	</div>
</div>
<?php include ROOT . '/views/layouts/footer.php'; ?>