<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 table-responsive">
			<h3 class="text-center">Панель управления</h3>
			<table class="table table-striped table-bordered table-hover table-condensed">



				<tr>
					<td class="text-center">Исполнительное устройство</td>
					<td>Состояние</td>

					<?php foreach($data as $item): ?>
					<td><?php echo $item['datchik_name']; ?></td>
				    <?php endforeach; ?>
				</tr>
				


					<?php 
					//array_unique($data[$i]);
					$names = array();
					 foreach($data as $item): ?>
				<tr>
						<td><?php 
						    if(in_array($item['name'], $names)) {continue;} 
						    else { echo $item['name'];
						    $names[] = $item['name']; } ?>		
						</td>

						<td><?php if($item['trig'] == 1) {echo "Включено";} else {echo "Выключено";}?></td>

					<?php $name = $item['name'];
					foreach($data as $item): ?>
						<td> <?php 
						if($name != $item['name']) {continue;}
						echo $item['value']. " ".$item['izm'];
						?></td>
					<?php endforeach; ?>
				</tr>
					<?php endforeach; ?>
				

			</table>
		</div>
	</div>
</div>
<script src="/template/js/jquery.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/main.js"></script>