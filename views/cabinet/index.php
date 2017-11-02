<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 table-responsive">
			<h3 class="text-center">Панель управления</h3>
			<table class="table table-striped table-bordered table-hover table-condensed">
				<tr>
					<td class="text-center">Исполнительное устройство</td>
					<td>Температура</td>
					<td>Частота</td>
					<td>Скорость</td>
					<td>Давление</td>
					<td>Состояние</td>
					<td>Действие</td>
				</tr>
				
					<?php foreach($ustroistva as $item): ?>
				<tr>
						<td><?php echo $item['name'];?></td>
						<td><?php if($item['trig'] == 1) {echo "Включено";} else {echo "Выключено";}?></td>
				</tr>
					<?php endforeach; ?>
				

			</table>
		</div>
	</div>
</div>
<script src="/template/js/jquery.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/main.js"></script>