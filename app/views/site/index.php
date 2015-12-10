<?php
use yii\helpers\Url;

$this->registerCssFile( '@web/css/index.css' );
?>

<div class="row">
	<div class="col-md-12">
		<div class="promo-box">
			<div id="promo-carousel" class="carousel slide" data-ride="carousel">
		
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img src="<?= Url::to( '@web/img/promo1.jpg' ) ?>" class="img-responsive thumbnail" />
					</div>
					<div class="item">
						<img src="<?= Url::to( '@web/img/promo2.jpg' ) ?>" class="img-responsive thumbnail" />
					</div>
				</div>
		
				<!-- Controls -->
				<a class="left carousel-control" href="#promo-carousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				
				<a class="right carousel-control" href="#promo-carousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div>
</div>

<h3 class="info-title"><?= Yii::t( 'app', 'Tour' ) ?></h3>
<hr />
<div class="row">
	<div class="col-md-4">
		<a href="<?= Url::to( [ 'site/tour', 'id' => 1000 ] ) ?>">
			<div class="mini-promo-box">
				<img src="<?= Url::to( '@web/img/mini-promo1.jpg' ) ?>" class="thumbnail img-responsive" />
				<div class="title-box">
					Rio de Janeiro
				</div>
				<div class="price-box">
					R$ 2.200<sup>,00</sup>
				</div>
			</div>
		</a>
	</div>
	<div class="col-md-4">
		<a href="<?= Url::to( [ 'site/tour', 'id' => 1001 ] ) ?>">
			<div class="mini-promo-box">
				<img src="<?= Url::to( '@web/img/mini-promo2.jpg' ) ?>" class="thumbnail img-responsive" />
				<div class="title-box">
					São Paulo
				</div>
				<div class="price-box">
					R$ 2.200<sup>,00</sup>
				</div>
			</div>
		</a>
	</div>
	<div class="col-md-4">
		<a href="<?= Url::to( [ 'site/tour', 'id' => 1002 ] ) ?>">
			<div class="mini-promo-box">
				<img src="<?= Url::to( '@web/img/mini-promo3.jpg' ) ?>" class="thumbnail img-responsive" />
				<div class="title-box">
					Porto Alegre
				</div>
				<div class="price-box">
					R$ 2.200<sup>,00</sup>
				</div>
			</div>
		</a>
	</div>
</div>

<hr />

<div class="row last-box">
	<div class="col-md-4">
		<div class="media">
			<div class="media-left">
				<a href="#">
					<img class="media-object" src="<?= Url::to( '@web/img/sac.png' ) ?>" />
				</a>
			</div>
			<div class="media-body">
				<h4 class="media-heading"><?= Yii::t( 'app', 'Contact Us' ) ?></h4>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="media">
			<div class="media-left">
				<a href="#">
					<img class="media-object" src="<?= Url::to( '@web/img/pagamento.png' ) ?>" />
				</a>
			</div>
			<div class="media-body">
				<h4 class="media-heading"><?= Yii::t( 'app', 'Payment' ) ?></h4>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="media">
			<div class="media-left">
				<a href="#">
					<img class="media-object" src="<?= Url::to( '@web/img/seguranca.png' ) ?>" />
				</a>
			</div>
			<div class="media-body">
				<h4 class="media-heading"><?= Yii::t( 'app', 'Security' ) ?></h4>
			</div>
		</div>
	</div>
</div>