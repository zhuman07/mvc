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
                                        <h4 class="panel-title"><a href="/blog/category/<?php echo $categoryItem['id']; ?>"
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
                            <h2 class="title text-center"><?php echo $catName['name']; ?></h2>
                            <?php foreach ($blogListByCat as $blog): ?>
                            <div class="single-blog-post">
                                <h3><?php echo $blog['h1'] ?></h3>
                                <div class="post-meta">
                                    <ul>
                                        <li><i class="fa fa-calendar"></i><?php echo $blog['date'] ?></li>
                                        <li><i class="fa fa-clock-o"></i> 13:33</li>
                                    </ul>
                                </div>
                                <a href="">
                                    <img src="<?php echo Product::getImage($blog['id']) ?>" alt="">
                                </a>
                                <p><?php echo $blog['short_content']; ?></p>
                                <a href="/blog/<?php echo $blog['id'] ?>" class="btn btn-primary" href="">Читать полностью</a>
                            </div>
                            <hr>
                            <?php endforeach; ?>
                            <?php /*echo $pagination->get();*/ ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include ROOT.'/views/layouts/footer.php'; ?>