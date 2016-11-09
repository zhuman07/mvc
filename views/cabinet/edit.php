<?php include ROOT.'/views/layouts/header.php'; ?>

<section><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
				<?php if($result): ?>
					<p>Данные отредактированы</p>
				<?php else: ?>
					<?php if(isset($errors) && is_array($errors)): ?>
						<ul>
					<?php foreach ($errors as $error): ?>
						<li>- <?php echo $error; ?></li>
					<?php endforeach; ?>
						</ul>
					<?php endif; ?>
						<div class="login-form"><!--login form-->
							<h2>Изменение данных</h2>
							<form action="#" method="POST">
								<input type="text" name="name" value="<?php echo $name; ?>" placeholder="Введите Имя" />
								<input type="password" name="password" value="<?php echo $password; ?>" placeholder="Введите пароль" />
								<button type="submit" name="submit" class="btn btn-default">Изменить</button>
							</form>
						</div><!--/login form-->
				<?php endif; ?>
				</div>
			</div>
		</div>
		<br/>
		<br/>
		<br/>
		<br/>
	</section><!--/form-->

	<?php include ROOT.'/views/layouts/footer.php'; ?>