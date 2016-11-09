<?php include ROOT.'/views/layouts/header.php'; ?>

<section><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
				<?php if(isset($errors) && is_array($errors)): ?>
					<ul>
				<?php foreach ($errors as $error): ?>
					<li>- <?php echo $error; ?></li>
				<?php endforeach; ?>
					</ul>
				<?php endif; ?>
					<div class="login-form"><!--login form-->
						<h2>Вход на сайт</h2>
						<form action="#" method="POST">
							<input type="email" name="email" placeholder="Ваш Email" />
							<input type="password" name="password" placeholder="Введите пароль" />
							<span>
								<input type="checkbox" name="remember" id="remember" class="checkbox" /> 
								<label for="remember">Запомнить меня</label>
							</span>
							<button type="submit" name="submit" class="btn btn-default">Вход</button>
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
		<br/>
		<br/>
		<br/>
		<br/>
	</section><!--/form-->

	<?php include ROOT.'/views/layouts/footer.php'; ?>