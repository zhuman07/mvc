<?php include ROOT.'/views/layouts/header.php'; ?>

<section>
	<div class="container">
		<div class="row">
			<h1>Личный кабинет</h1>
			<h3>Привет, <?php echo $user['name']; ?></h3>
			<ul>
				<li><a href="/cabinet/edit">Изменить данные</a></li>
				<li><a href="/user/history">Список покупок</a></li>
			</ul>
		</div>
	</div>
</section>

<?php include ROOT.'/views/layouts/footer.php'; ?>