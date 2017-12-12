<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 table-responsive">
			<h3 class="text-center">Панель управления</h3>
			<table class="table table-striped table-bordered table-hover table-condensed">


            <?php foreach($ustroistva as $ustroistvo): ?>
				<tr>
					<td style="background: #cecdcd;"><?php echo $ustroistvo['name']; ?></td>
				</tr>
				<tr>
					<td>Состояние: <?php if($ustroistvo['trig'] == 0){echo "Выкл";} else {echo "Вкл";} ?></td>
					<td> <a href="/cabinet/trig/<?php echo $ustroistvo['id'];?>" class="btn ustr-trig">Выключатель</a></td>
				</tr>
				
					<?php foreach($datchiki as $datchik): ?>
						<?php if($ustroistvo['id'] == $datchik['ustroistvo_id']): ?>
				    <tr>
                       <td><?php echo $datchik['name']; ?></td>
                       <td><?php echo $datchik['value'].$datchik['izm']; ?></td>
                   </tr>
                        <?php endif; ?>
				    <?php endforeach; ?>
				
			<?php endforeach; ?>

			</table>
		</div>
	</div>
</div>
<?php include ROOT . '/views/layouts/footer.php'; ?>