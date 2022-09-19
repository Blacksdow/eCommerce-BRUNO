<?php 
$cm = new CategoryManager();
$cat = $cm->getAll();

?>


<div class="container-xl">
	<div class="row">
		<div class="col-md-12">
			<h2>TRENDING <b>Categories</b></h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active">
					<div class="row">
                        <?php foreach($cat as $c): ?>
						<div class="col-sm-4">
							<div class="thumb-wrapper m-3">
								<div class="img-box">
									<img src="<?php echo ROOT_URL ?>img/categories/<?php echo $c->name ?>.jpeg" class="img-fluid" alt="">									
								</div>
								<div class="thumb-content">
									<h4><?php echo $c->name ?></h4>									
									<div class="star-rating">
										<ul class="list-inline">
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star-o"></i></li>
										</ul>
									</div>
									<a href="<?php echo ROOT_URL?>shop/?page=products-list&category=<?php echo $c->id ?>" class="btn btn-primary">Visualizza</a>
								</div>						
							</div>
						</div>
                        <?php endforeach; ?>
					</div>
				</div>
			</div>
			<!-- Carousel controls -->
			
		</div>
		</div>
	</div>
</div>

<p class="lead">Benvenuti nel sito</p>
<p class="lead">Clicca sul bottone per iniziare gli acquisti.</p>
<a href="<?php ROOT_URL ?>../shop/?page=products-list" class="normal-btn btn btn-lg mb-5 mt-3">Vai allo Shopping &raquo;</a>

