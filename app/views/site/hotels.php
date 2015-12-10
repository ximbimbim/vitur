<?php

use yii\web\View;

use yii\helpers\Url;
use yii\helpers\Html;

use app\assets\AngularAsset;
use app\assets\JQueryUIAsset;
use app\assets\FontAwesomeAsset;

FontAwesomeAsset::register( $this );
JQueryUIAsset::register( $this );
AngularAsset::register( $this );

// Search app JS's
$this->registerJsFile( '@web/js/web-app/hotel-app.js', [ 'depends' => 'app\assets\AngularAsset' ] );
$this->registerCssFile( '@web/css/hotel_app.css', [ 'depends' => 'app\assets\AngularAsset' ] );
?>
<div data-ng-app="searchApp">
	<div data-ng-controller="searchCtrl">
		<div data-ng-init="url.hotel_rest='<?= Url::toRoute( 'v0/hotels' ) ?>'"></div>
		<div class="row hide" id="searchApp_viewer">			
			<div class="col-md-4">
				<form name="searchFrm" data-ng-submit="submitSearch('<?= Url::to( 'site/find-tour' ) ?>')" novalidate>
					<div class="vtr-form">
						<div class="vtr-form-title"><?= Yii::t( 'app', 'Hotels' ) ?></div>
						<div class="vtr-form-body">
							<div class="ui-state-error ui-corner-all" style="padding: 6px 6px 0px 6px; margin-bottom: 5px" data-ng-show="hasError">
								<p>
									<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
									<strong><?= Yii::t( 'app', 'Alert' ) ?>:</strong> {{msgError}}
								</p>
							</div>
							
							<div class="form-group">
								<label class="label label-default"><?= Yii::t( 'app', 'To' ) ?></label>
								<input type="text" class="form-control" name="to" data-ng-model="searchData.to" required />
							</div>
						</div>
						
						<div class="vtr-form-footer clearfix">
							<div class="btn-group pull-right">
								<button type="submit" class="btn btn-primary"><?= Yii::t( 'app', 'Find' ) ?></button>
							</div>
						</div>
					</div>
				</form>
			</div> <!-- ./COL-LG -->
			
			<div class="col-md-8">
				<p data-ng-show="ps().loading"><img src="<?= Url::to( '@web/img/loading.gif' ) ?>" class="pull-center" /></p>
				<div data-ng-show="ps().pageData.length > 0">
					<div class="vtr-order-bar clearfix">
						<div class="vtr-order-title"></div>
						<div class="vtr-order-input pull-right">
							<div style="display: inline-block; margin-top: 3px"><?= Yii::t( 'app', 'Order by' ) ?></div> <select class="form-control pull-right">
								<option value=""><?= Yii::t( 'app', 'Best seller' ) ?></option>
								<option value=""><?= Yii::t( 'app', 'Lower price' ) ?></option>
								<option value=""><?= Yii::t( 'app', 'Highest price' ) ?></option>
								<option value=""><?= Yii::t( 'app', 'Less star' ) ?></option>
								<option value=""><?= Yii::t( 'app', 'More star' ) ?></option>
							</select>
						</div>
					</div> <!-- ./VTR-ORDER-BAR -->

					<div class="vtr-tour-item" data-ng-repeat="hotel in ps().pageData">
						<div class="vtr-tour-img"><img data-ng-src="<?= Url::to( '@web/img/hotel' ) ?>_{{hotel.id}}.jpg" class="img-responsive" /></div>
						<div class="vtr-tour-body">
							<div style="display: inline-block; width: 100%; height: 100%; position: relative">
								<h3>{{hotel.name}}</h3>
								<p><strong><?= Yii::t( 'app', 'Localization' ) ?></strong> <a href="" class="vtr-see-map"><span class="glyphicon glyphicon-pushpin"></span> <?= Yii::t( 'app', 'Map' ) ?></a></p>
								<div class="vtr-features-box">									
									<span data-ng-repeat="feature in hotel.hotelFeatures" class="fa fa-{{feature.featuresFk.class}}"></span>
								</div>
								<div class="vtr-price-box">
									<h4 class="vtr-price-value"><sub>R$</sub> {{hotel.price}}<sup>,{{hotel.price % 100}}</sup></h4>
									<h3 class="vtr-price-parcel"><sub>{{hotel.price/hotel.parcel}}x</sub> R$ {{hotel.parcel}}<sup>,{{hotel.parcel%100}}</sup></h3>
								</div>
							</div>
						</div>
					</div> <!-- ./VTR-TOUR-ITEM -->
					
					<div class="vtr-tool-bar">
						<div class="vtr-pagination" data-ng-show="ps().pageCount > 1"></div>
					</div> <!-- ./VTR-ORDER-BAR -->
				</div> <!-- ./#RESULT_DATA -->
				
				<div data-ng-show="ps().hasResult == false">
					<h3>Nenhum pacote localizado, para este destino.</h3>
				</div>
			</div> <!-- ./COL-LG -->
		</div> <!-- ./ROW -->
	</div> <!-- ./CONTROLER: searchCtrl -->
</div> <!-- ./APPLICATION: searchApp -->
