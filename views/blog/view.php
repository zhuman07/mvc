<?php include ROOT.'/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Раздел</h2>
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


                    <div class="shipping text-center"><!--shipping-->
                            <img src="images/home/shipping.jpg" alt="" />
                    </div><!--/shipping-->
                </div>
            </div>

                <div class="col-sm-9">
                   <div class="blog-post-area">
                    <h2 class="title text-center">Запись в блоге</h2>
                    <div class="single-blog-post">
                        <h3><?php echo $blogById['h1'] ?></h3>
                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-calendar"></i><?php $blogById['date'] = explode(' ', $blogById['date']); echo $blogById['date']['0']; ?></li>
                                <li><i class="fa fa-clock-o"></i> <?php echo $blogById['date']['1'] ?></li>
                            </ul>
                        </div>
                        <a href="">
                            <img src="<?php echo Product::getImage($blogById['id']) ?>" alt="">
                        </a>
                        <p><?php echo $blogById['content']; ?></p>
                        <div class="pager-area">
                            <div class="pager pull-right">
                                <a href="/blog/">Назад в блог</a>
                            </div>
                        </div>
                    </div>
                </div><!--/blog-post-area-->  
            </div>

        </div>
    </div>
</section>

<?php include ROOT.'/views/layouts/footer.php'; ?>