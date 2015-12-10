<?php
use yii\web\View;
use yii\helpers\Url;

// $this->registerCss( $css, View::POS_END );
?>

<style>
/**************************************
 * FORM
 **************************************/
.vtr-form
{
	box-shadow: 2px 2px 6px #444;
	border: 1px solid green;
	border-radius: 10px;
	margin: 10px;
}
.vtr-form-body input[type=number],
.vtr-form-body input[type=text],
.vtr-form-body input[type=password],
.vtr-form-body select,
.vtr-form-body textarea
{
	background-color: rgba( 255, 255, 255, 0.4 );
}
.vtr-form-body textarea
{
	resize: none;
}
.vtr-form-body input[type=number]:focus,
.vtr-form-body input[type=text]:focus,
.vtr-form-body input[type=password]:focus,
.vtr-form-body select:focus,
.vtr-form-body textarea:focus
{
	border-color: #21AB89;
	box-shadow: 0 0 5px #74E5C8;
}
.vtr-form-title
{
	border-top-right-radius: 10px;
	border-top-left-radius: 10px;
	background-color: #74E5C8;
	border-bottom: 1px solid green;
	padding: 10px 20px 5px 20px;	
	font-size: 18px;
}
.vtr-form-body
{
	background-color: #e6fff7;
	background-image: url("<?= Url::to( '@web/img/vitur_palm.png' ) ?>");
	background-repeat: no-repeat;
	background-position: 100% 100%;
	border-bottom-right-radius: 10px;
	border-bottom-left-radius: 10px;
	min-height: 300px;
	padding: 20px;
}
.vtr-form-footer
{
	border-bottom-right-radius: 10px;
	border-bottom-left-radius: 10px;
	padding: 10px 20px 10px 20px;
	border-top: 1px solid green;
}
.vtr-form .btn-primary,
.vtr-form .btn-primary:hover,
.vtr-form .btn-primary:active,
.vtr-form .btn-default,
.vtr-form .btn-default:hover,
.vtr-form .btn-default:active
{
	border-color: #ccc;
	outline: none;
	border-radius: 20px;
	padding-left: 20px;
	padding-right: 20px;
}
/**************************************
 * PROMO BOX
 **************************************/
.vtr-pbox-title
{
	display: inline-block;
	padding: 5px 10px 5px 10px;
	background-color: yellow;
	border-top-right-radius: 10px;
	border-top-left-radius: 10px;
	font-size: 18px;
	text-shadow: 1px 1px 1px #000;
	box-shadow: 2px 2px 6px #444;
	color: #1FA382;
	left: 0px;
	border: 1px solid #777;
	border-bottom: none;
}
.vtr-pbox-body
{
	box-shadow: 2px 2px 6px #444;
	border: 1px solid #444;
	border-bottom: none;
}
.vtr-pbox-body img
{
	width: 100%;
}
.vtr-pbox-footer
{
	display: inline-block;
	padding: 8px 10px 8px 10px;
	background-color: yellow;
	width: 100%;
	text-align: center;	
	box-shadow: 2px 2px 6px #444;
	border: 1px solid #444;	
	border-top: none;
}
.vtr-pbox-footer sup
{
	top: -3px;
}
/**************************************
 * TOUR BOX
 **************************************/
.vtr-tour-box
{
	position: relative;
}
.vtr-tbox-title
{
	position: absolute;
	display: inline-block;
	padding: 2px 5px 2px 5px;
	background-color: yellow;
	font-size: 14px;
	text-shadow: 1px 1px 1px #000;
	box-shadow: 2px 2px 6px #444;
	border: 1px solid #777;
	border-bottom: none;
	color: red;
	left: 2%;
	top: 2%;
}
.vtr-tbox-body
{
	box-shadow: 2px 2px 6px #444;
	border: 1px solid #444;
	border-bottom: none;
	width: 100%;
}
.vtr-tbox-body img
{
	width: 100%;
}
.vtr-tbox-footer
{
	position: absolute;
	display: inline-block;
	padding: 3px 5px 3px 5px;
	background-color: yellow;
	text-align: center;	
	box-shadow: 2px 2px 6px #444;
	border: 1px solid #444;	
	border-top: none;
	bottom: 2%;
	right: 2%;
}
.vtr-tbox-footer sup
{
	top: -2px;
}
/**************************************
 * SEARCH BAR
 **************************************/
.vtr-order-bar
{
 	padding: 10px 25px 10px 25px;
 	background-color: #74E5C8;
 	box-shadow: 2px 2px 6px #444;
 	border-top-left-radius: 8px;
 	border-top-right-radius: 8px;
 	border-bottom: 8px solid yellow;
 	width: 100%;
}
.vtr-order-title
{
	display: inline-block;
	font-size: 18px;
}
.vtr-order-input
{
 	width: 300px;
}
.vtr-order-input input,
.vtr-order-input select
{
	display: inline;
	width: 210px;
 	padding: 2px;
 	height: 25px;
 	color: #555;
}
.vtr-order-input input:focus,
.vtr-order-input select:focus
{
	border-color: #21AB89;	
	box-shadow: 0 0 5px #74E5C8;
}
/**************************************
 * TOUR ITEM
 **************************************/
.vtr-tour-item
{
	display: block;
	width: 100%;
	padding: 10px;
	background-color: #e6fff7;
	border: 1px solid black;
	border-radius: 10px;
	box-shadow: 2px 2px 6px #444;
}
.vtr-tour-img
{
	display: table-cell;
	width: 40%;
	height: auto;
	border-top: 1px solid #333;
	border-left: 1px solid #333;
	border-bottom: 1px solid #333;
	box-shadow: 2px 2px 6px #444;
}
.vtr-tour-body
{
	display: table-cell;
	vertical-align: top;
	background-color: white;
	border-top: 1px solid #333;
	border-right: 1px solid #333;
	border-bottom: 1px solid #333;
	box-shadow: 2px 2px 6px #444;
}
.vtr-tour-body p,
.vtr-tour-body h3 { margin: 2px 0 0 10px; padding: 0; }
.vtr-features-box .glyphicon:first-child { margin-left: 10px; }
@media (min-width: 1199px) {
	.vtr-features-box
	{
		display: inline-block;
		position: absolute;
		height: 29px;
		width: 100%;
		top: 96px;
	}
	.vtr-price-box
	{
		display: inline-block;
		position: absolute;
		background-color: rgba( 255, 255, 0, 0.6);
		border-top: 3px solid red;
		height: 75px;
		width: 100%;
		top: 125px;
	}
}
@media (min-width: 992px) and (max-width: 1199px) {
	.vtr-features-box
	{
		display: inline-block;
		position: absolute;
		height: 29px;
		width: 100%;
		top: 60px;
	}
	.vtr-price-box
	{
		display: inline-block;
		position: absolute;
		background-color: rgba( 255, 255, 0, 0.6);
		border-top: 3px solid red;
		height: 75px;
		width: 100%;
		top: 89px;
	}
}
.vtr-tour-tool
{
	display: block;
	border: 1px solid #333;
	margin: 10px 0px 10px 0px;
	padding: 5px 10px 5px 10px;
	box-shadow: 2px 2px 6px #444;
	background-color: white;
}
.vtr-ticket-table { margin: 10px auto; }
.vtr-ticket-table td:first-child { padding: 0px 20px 0px 0px; }
.vtr-ticket-table td:last-child { padding: 0px 0px 0px 20px; }
.vtr-ticket-table td { padding: 0px 20px 0px 20px; }
.vtr-see-map,
.vtr-see-map:hover,
.vtr-see-map:visited
{
	color: red;
	font-weight: bold;
	text-decoration: none;
}
.vtr-see-map .glyphicon { font-size: 18px; }
.vtr-price-value { text-align: center; }
.vtr-price-value sub { top: 0px; font-size: 12px; }
.vtr-price-value sup { top: -4px; }
.vtr-price-parcel { text-align: center; }
.vtr-price-parcel sub { top: -1px; font-size: 14px; }
.vtr-price-parcel sup { top: -4px; }
</style>

<div class="row">
	<div class="col-xs-6">
		<p style="margin-left: 15px">Form</p>
		<form action="">
			<div class="vtr-form">
				<div class="vtr-form-title">Title</div>
				<div class="vtr-form-body">
					<div class="form-group">
						<label class="label label-default">Label #1</label>
						<input type="text" class="form-control" required />
					</div>
					
					<div class="form-group">
						<label class="label label-default">Label #2</label>
						<select class="form-control" required>
							<option value="">- Selecione uma opção -</option>
							<option value="opt_1">Option #1</option>
							<option value="opt_2">Option #2</option>
						</select>
					</div>
					
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								<label class="label label-default">Label #3</label>
								<input type="text" class="form-control" required />
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label class="label label-default">Label #4</label>
								<input type="text" class="form-control" required />
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="label label-default">Label #5</label>
						<textarea class="form-control" rows="5" required></textarea>
					</div>
				</div>				
				<div class="vtr-form-footer clearfix">
					<div class="btn-group pull-right">
						<button type="submit" class="btn btn-primary">Botão</button>
						<button type="reset" class="btn btn-default">Botão</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	<div class="col-xs-3">
		<p style="margin-left: 15px">Promo box</p>
		<div class="vtr-promo-box">
			<div class="vtr-pbox-title">Rio de janeiro</div>
			<div class="vtr-pbox-body"><img src="<?= Url::to( '@web/img/mini-promo1.jpg') ?>" /></div>
			<div class="vtr-pbox-footer"><h3 style="margin: 0"><span style="font-size: 12px">10x</span> R$ 240<sup>,00</sup></h3></div>
		</div>
	</div>
	
	<div class="col-xs-3">
		<p style="margin-left: 15px">&nbsp;</p>
		<div class="vtr-promo-box">
			<div class="vtr-pbox-title">São paulo</div>
			<div class="vtr-pbox-body"><img src="<?= Url::to( '@web/img/mini-promo2.jpg') ?>" /></div>
			<div class="vtr-pbox-footer"><h3 style="margin: 0"><span style="font-size: 12px">10x</span> R$ 240<sup>,00</sup></h3></div>
		</div>
	</div>
	
	<div class="col-xs-3">
		<br />
		<p style="margin-left: 15px">Tour box</p>
		<div class="vtr-tour-box">
			<div class="vtr-tbox-title">Rio de janeiro</div>
			<div class="vtr-tbox-body"><img src="<?= Url::to( '@web/img/mini-promo1.jpg') ?>" class="img-responsive" /></div>
			<div class="vtr-tbox-footer"><span style="font-size: 12px">10x</span> R$ 240<sup>,00</sup></div>
		</div>
	</div>
	
	<div class="col-xs-3">
		<br />
		<p style="margin-left: 15px">&nbsp;</p>
		<div class="vtr-tour-box">
			<div class="vtr-tbox-title">São paulo</div>
			<div class="vtr-tbox-body"><img src="<?= Url::to( '@web/img/mini-promo2.jpg') ?>" class="img-responsive" /></div>
			<div class="vtr-tbox-footer"><span style="font-size: 12px">10x</span> R$ 240<sup>,00</sup></div>
		</div>
	</div>
	
	<div class="col-xs-12">
		<br />
		<p>Order bar</p>
		<div class="vtr-order-bar clearfix">
			<div class="vtr-order-title">Titulo</div>
			<div class="vtr-order-input pull-right">
				<div style="display: inline-block; margin-top: 3px">Ordenar por</div> <select class="form-control pull-right">
					<option value="">Mais vendido</option>
					<option value="">Menor preço</option>
					<option value="">Maior preço</option>
					<option value="">Estrelas crescente</option>
					<option value="">Estrelas decrescente</option>
				</select>
			</div>
		</div>
	</div>
	
	<div class="col-xs-8">
		<br />
		<p>Tour item</p>
		<div class="vtr-tour-item">
			<div class="vtr-tour-img"><img src="<?= Url::to( '@web/img/mini-promo2.jpg') ?>" class="img-responsive" /></div>
			<div class="vtr-tour-body">
				<div style="display: inline-block; width: 100%; height: 100%; position: relative">
					<h3>Titulo</h3>
					<p><strong>Localização</strong> <a href="" class="vtr-see-map"><span class="glyphicon glyphicon-pushpin"></span> Mapa</a></p>
					<div class="vtr-features-box">
						<?php for ( $i = 0; $i < 20; $i++ ) { ?>
							<span class="glyphicon glyphicon-home"></span>
						<?php } ?>
					</div>
					<div class="vtr-price-box">
						<h4 class="vtr-price-value"><sub>R$</sub> 1865<sup>,35</sup></h4>
						<h3 class="vtr-price-parcel"><sub>10x</sub> R$186<sup>,54</sup></h3>
					</div>
				</div>
			</div>
			<div class="vtr-tour-tool">
				<table class="vtr-ticket-table">
					<tr>
						<td><span class="glyphicon glyphicon-arrow-right" style="color: green; font-size: 18px"></span></td>
						<td><strong style="display: inline-block; width: 50px">Ida:</strong> 15/12/2015</td>
						<td>09:30</td>
						<td>CNF/SDU</td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-arrow-left" style="color: red; font-size: 18px"></span></td>
						<td><strong style="display: inline-block; width: 50px">Volta:</strong> 15/01/2016</td>
						<td>14:30</td>
						<td>SDU/CNF</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<br /> <br /> <br />