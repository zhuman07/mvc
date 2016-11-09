<?php include ROOT.'/views/layouts/header.php'; ?>

<div id="contact-page" class="container">

    	<div class="bg">
	    	   	
    		<div class="row"> 
					 <div class="col-sm-3">
                        <div class="left-sidebar">
                            <h2>Каталог</h2>
                            <div class="panel-group category-products">
                                <?php foreach ($categories as $categoryItem): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a href="/category/<?php echo $categoryItem['id']; ?>"
                                        class="<?php if($categoryId == $categoryItem['id']) echo "active"; ?>" ><?php echo $categoryItem['name']; ?></a></h4>
                                    </div>
                                </div>
                              <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

	    		<div class="col-sm-5 col-sm-offset-2">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Оформление заказа</h2>
	    				<?php if($result): ?>
	    					<h1>Заявка отправлена!</h1>
	    				<?php else: ?>
	    					<?php if(isset($errors) && is_array($errors)): ?>
	    					<ul>
									<?php foreach($errors as $error): ?>
										<li>-<?php echo $error; ?></li>
									<?php endforeach; ?>
	    					</ul>
								<?php endif; ?>
	    				<p>Оформите заказ и наш менеджер свяжется с вами</p>
	    				<div class="status alert alert-success" style="display: none"></div>
	    				<p>Выбрано товаров: <?php echo $totalQuantity; ?>. На сумму $<?php echo $totalPrice; ?></p>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
				    		
				            <div class="form-group col-md-6">
				            		<label for="name">Ваше Имя:</label>
				                <input type="text" name="name" id="name" class="form-control" value="<?php echo $userName; ?>" required="required" placeholder="Name" />
				            </div>
				            <div class="form-group col-md-6">
				            		<label for="phone">Ваш номер:</label>
				                <input type="text" name="phone" id="phone" class="form-control" required="required" placeholder="Phone">
				            </div>
				            <div class="form-group col-md-12">
				            		<label for="message">Комментарий к заказу:</label>
				                <textarea name="message" id="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
				      <?php endif; ?>
	    			</div>
	    		</div>
	    		
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->

    <?php include ROOT.'/views/layouts/footer.php'; ?>