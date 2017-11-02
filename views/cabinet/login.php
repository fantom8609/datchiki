<section>
	<div class="container">
		<div class="row">
			<div class="col-md-4">

				<?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                
				<h3>Войти в панель управления</h3>
				<form action="#" method="post">
					<span>Введите логин</span>
					<input type="text" name="login"><br><br>
					<span>Введите пароль</span>
					<input type="password" name="password"><br><br>
					<input type="submit" name="submit" value="OK">
				</form>
			</div>			
		</div>
	</div>
</section>
