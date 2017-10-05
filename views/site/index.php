<?php include ROOT . '/views/layouts/header.php'; ?>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-6">

				<!-- Задание значений для датчиков -->
				<span>Датчик температуры</span><br>
				<input type="text" name="temperature">°С<br>
				<span>Датчик скорости </span><br>
				<input type="text" name="speed">об/сек<br><br>
				<input type="button" class="btn btn-success set_ts"  value="установить значения датчиков"> 

				<!-- Исполнительные механизмы -->
				<h4>Вентилятор</h4>
				<p>Состояние: <?php if($trig == "0") {echo "Выключен";} else {echo "Включен";}?></p>
				<p>Скорость: <span id="result_s"><?php if($trig == "0") {echo "0";} else {echo $speed;}?>об/сек</span></p>
				<p>Температура: <span id="result_t"><?php echo $temperature;?>°С</span></p><br>
				
			</div>

			<div class="col-md-6">
				<span>Датчик давления в поршне </span><br>
				<input type="text" name="pressure">
				<input type="button" class="btn btn-success set_pressure"  value="установить значение датчика"> <br><br>
				<h4>Поршень</h4>
				<p>Состояние: <?php if($trig == "0") {echo "Выключен";} else {echo "Включен";}?></p>
				<p>Давление: <span id="result_p"><?php echo $pressure;?>Па</span></p>
				
			</div>	

		</div>
	</div>
</section>
<?php include ROOT . '/views/layouts/footer.php'; ?>