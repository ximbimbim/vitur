<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

use app\assets\NormalizeAsset;
use yii\helpers\Url;
use yii\bootstrap\Nav;

NormalizeAsset::register( $this );

$this->registerCssFile( '@web/css/layout.css', [ 'depends' => 'app\assets\NormalizeAsset' ] );
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
	    <meta charset="<?= Yii::$app->charset ?>">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <?= Html::csrfMetaTags() ?>
	    <title><?= Html::encode($this->title) ?></title>
	    <?php $this->head() ?>
	</head>
	<body>
	<?php $this->beginBody() ?>
		<header>
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container">					
					<ul class="nav navbar-nav">
						<li>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<?= Yii::t( 'app', 'Language' )?> <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="<?= Url::toRoute( [ '/change-lang', 'lang' => 'en-US', 'route' => Yii::$app->request->url ] ) ?>">English</a></li>
								<li><a href="<?= Url::toRoute( [ '/change-lang', 'lang' => 'pt-BR', 'route' => Yii::$app->request->url ] ) ?>">Português</a></li>
							</ul>
						</li>
					</ul>
	
					<ul class="nav navbar-nav pull-right">
						<li><a href="<?= Url::to( [ 'site/index' ] ) ?>"><span class="glyphicon glyphicon-home"></span> <?= Yii::t( 'app', 'Home' ) ?></a></li>
						<?php if ( Yii::$app->user->isGuest ) { ?>
							<li><a href="#" data-toggle="modal" data-target="#signModal"><?= Yii::t( 'app', 'Sign Up' ) ?></a></li>
							<li><a href="#" data-toggle="modal" data-target="#connModal"><?= Yii::t( 'app', 'Login' ) ?></a></li>
						<?php } else { ?>
							<li><a href="<?= Url::to( [ 'site/logout' ] ) ?>"><?= Yii::t( 'app', 'Logout' ) ?></a></li>
						<?php }?>						
						</ul>
				</div>
			</nav>
	
			<img src="<?= Url::to( '@web/img/logo.png' )?>" class="vt-logo" />
	
			<div class="header clearfix">
				<img src="<?= Url::to( '@web/img/vitur_palm.png') ?>" class="img-responsive pull-left" />
				<img src="<?= Url::to( '@web/img/vitur_cloud.png') ?>" class="img-responsive pull-right" />
			</div>
	
			<nav class="navbar navbar-inverse navbar-center">
				<div class="container">
					<?=
						Nav::widget([
							'items' => [
								[ 'url' => 'tours',   'label' => Yii::t( 'app', 'Tours' )   ],
								[ 'url' => 'tickets', 'label' => Yii::t( 'app', 'Tickets' ) ],
								[ 'url' => 'hotels',  'label' => Yii::t( 'app', 'Hotels' )  ],
							],
							'options' => [ 'class' => 'nav nav-center navbar-nav' ]
						]);
					?>
				</div>
			</nav>
		</header>

		<div class="container">
			<?= $content?>
		</div>
		
		<!-- Conection modal -->
		<div class="modal fade" id="connModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Login</h4>
					</div>
					<form action="">
						<div class="modal-body" style="margin-left: 30px; margin-right: 30px">						
							<div class="form-group">
								<label class="label label-default"><?= Yii::t( 'app', 'User' ) ?></label>
								<input type="text" class="form-control" />
							</div>
							<div class="form-group">
								<label class="label label-default"><?= Yii::t( 'app', 'Password' ) ?></label>
								<input type="password" class="form-control" />
								<a href=""><?= Yii::t( 'app', 'Forgot your password?' ) ?></a>
							</div>							
						</div>
						
						<div class="modal-footer">
							<div class="btn-group pull-right" style="margin-left: 30px; margin-right: 30px">								
								<button type="submit" class="btn btn-primary"><?= Yii::t( 'app', 'Register' )?></button>
								<button type="reset" class="btn btn-default"><?= Yii::t( 'app', 'Reset' )?></button>								
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<!-- Sign Up modal -->
		<div class="modal fade" id="signModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Sign up</h4>
					</div>
					<form action="">
						<div class="modal-body" style="margin-left: 30px; margin-right: 30px">
							<div class="form-group">
								<label class="label label-default"><?= Yii::t( 'app', 'CPF' ) ?></label>
								<input type="text" class="form-control" />
							</div>
							<div class="form-group">
								<label class="label label-default"><?= Yii::t( 'app', 'User' ) ?></label>
								<input type="text" class="form-control" />
							</div>
							<div class="form-group">
								<label class="label label-default"><?= Yii::t( 'app', 'Email' ) ?></label>
								<input type="text" class="form-control" />
							</div>
							<div class="form-group">
								<label class="label label-default"><?= Yii::t( 'app', 'Password' ) ?></label>
								<input type="password" class="form-control" />
							</div>
							<div class="form-group">
								<label class="label label-default"><?= Yii::t( 'app', 'Re-type password' ) ?></label>
								<input type="password" class="form-control" />
							</div>
						</div>
						
						<div class="modal-footer">
							<div class="btn-group pull-right" style="margin-left: 30px; margin-right: 30px">								
								<button type="submit" class="btn btn-primary"><?= Yii::t( 'app', 'Register' )?></button>
								<button type="reset" class="btn btn-default"><?= Yii::t( 'app', 'Reset' )?></button>								
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<footer class="footer">
			<nav class="navbar navbar-inverse">
				<h5 style="text-align: center; color: white"> ViTur 2015 &copy; Todos os direitos reservados </h5>
			</nav>
		</footer>
	<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>
