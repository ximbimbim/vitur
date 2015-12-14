<?php

use yii\web\View;

use yii\helpers\Url;
use yii\helpers\Html;

use app\assets\AngularAsset;
use app\assets\JQueryUIAsset;
use app\assets\FontAwesomeAsset;
use app\assets\NormalizeAsset;

FontAwesomeAsset::register( $this );
JQueryUIAsset::register( $this );
AngularAsset::register( $this );

// Search app JS's
$this->registerJsFile( '@web/js/web-app/tour-app.js', [ 'depends' => 'app\assets\AngularAsset' ] );
$this->registerJsFile( '@web/js/web-app/directives.js', [ 'depends' => 'app\assets\AngularAsset' ] );
$this->registerCssFile( '@web/css/tour_app.css', [ 'depends' => 'app\assets\AngularAsset' ] );
?>
<div data-ng-app="searchApp">
	<div data-ng-controller="searchCtrl">
		<div data-ng-init="url='<?= Url::toRoute( '/generate-tour' ) ?>'"></div>
		<div class="row hide" id="searchApp_viewer">			
			<div class="col-md-4">
				<form name="searchFrm" data-ng-submit="submitSearch()" novalidate>
					<div class="vtr-form">
						<div class="vtr-form-title"><?= Yii::t( 'app', 'Tour' ) ?></div>
						<div class="vtr-form-body">
							<div class="ui-state-error ui-corner-all" style="padding: 6px 6px 0px 6px; margin-bottom: 5px" data-ng-show="hasError">
								<p>
									<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
									<strong><?= Yii::t( 'app', 'Alert' ) ?>:</strong> {{msgError}}
								</p>
							</div>
											
							<div class="form-group">
								<label class="label label-default"><?= Yii::t( 'app', 'To' ) ?></label>
								<input type="text" class="form-control" name="to" data-ng-model="formData.to" required />
							</div>
							
							<div class="form-group">
								<label class="label label-default"><?= Yii::t( 'app', 'From' ) ?></label>
								<input type="text" class="form-control" name="from" data-ng-model="formData.from" required />
							</div>

							<div class="row">
								<div class="col-xs-4">
									<div class="form-group">
										<label class="label label-default"><?= Yii::t( 'app', 'Adults' ) ?></label>
										<input type="number" class="form-control" name="adults" min="1" value="1" data-ng-model="formData.adults" required />
									</div>
								</div>
								<div class="col-xs-4">
									<div class="form-group">
										<label class="label label-default"><?= Yii::t( 'app', 'Childrens' ) ?></label>
										<input type="number" class="form-control" name="childrens" min="0" value="0" data-ng-model="formData.childrens" required />
									</div>
								</div>
								<div class="col-xs-4">
									<div class="form-group">
										<label class="label label-default"><?= Yii::t( 'app', 'Rooms' ) ?></label>
										<input type="number" class="form-control" name="rooms" min="1" value="1" data-ng-model="formData.rooms" required />
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<label class="label label-default"><?= Yii::t( 'app', 'Go' ) ?></label>
										<input type="text" class="form-control" name="go" data-ng-model="formData.go" data-ng-click="selectGoDate()" data-ng-change="updateBack()" readonly required />
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label class="label label-default"><?= Yii::t( 'app', 'Back' ) ?></label>
										<input type="text" class="form-control" name="back" data-ng-model="formData.back" data-ng-click="selectBackDate()" readonly required />
									</div>
								</div>
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
				<p data-ng-show="loading"><img src="<?= Url::to( '@web/img/loading.gif' ) ?>" class="pull-center" /></p>
				<div data-ng-show="loading == false && pageData.length > 0">
					<div class="vtr-order-bar clearfix">
						<div class="vtr-order-title">{{findTitle}}</div>
						<div class="vtr-order-input pull-right">
							<div style="display: inline-block; margin-top: 3px"><?= Yii::t( 'app', 'Order by' ) ?></div>
							<select class="form-control pull-right" data-ng-model="formData.orderBy">
								<option value="lpri"><?= Yii::t( 'app', 'Lower price' ) ?></option>
								<option value="hpri"><?= Yii::t( 'app', 'Highest price' ) ?></option>
								<option value="lstr"><?= Yii::t( 'app', 'Less star' ) ?></option>
								<option value="mstr"><?= Yii::t( 'app', 'More star' ) ?></option>
							</select>
						</div>
					</div> <!-- ./VTR-ORDER-BAR -->

					<div class="vtr-tour-item" data-ng-repeat="tour in pageData">
						<div class="vtr-tour-img"><img data-ng-src="<?= Url::to( '@web/img/hotel' ) ?>_{{tour.hotel.id}}.jpg" class="img-responsive" /></div>
						<div class="vtr-tour-body">
							<div style="display: inline-block; width: 100%; height: 100%; position: relative">
								<h3>{{tour.hotel.name}}</h3>								
								<p><strong><?= Yii::t( 'app', 'Localization' ) ?></strong> <a href="" class="vtr-see-map"><span class="glyphicon glyphicon-pushpin"></span> <?= Yii::t( 'app', 'Map' ) ?></a></p>
								<p><select class="sel-ticket-box" data-ng-model="selCia"><option data-ng-repeat="t in tour.tickets" value="{{$index}}">{{t.name}}</option></select></p>
								<div class="vtr-features-box">									
									<span data-ng-repeat="feature in tour.hotel.hotelFeatures" class="fa fa-{{feature.featuresFk.class}}"></span>
								</div>
								<div class="vtr-price-box">
									<h4 class="vtr-price-value"><sub>R$</sub> {{tour.hotel.price*tour.daily+tour.tickets[selCia].price}}<sup>,00</sup></h4>
									<h3 class="vtr-price-parcel"><sub>10x</sub> R$ {{(tour.hotel.price*tour.daily+tour.tickets[selCia].price)/10}}<sup>,00</sup></h3>
								</div>
							</div>
						</div>
						<div class="vtr-tour-tool">
							<table class="vtr-ticket-table">
								<tr>
									<td><span class="glyphicon glyphicon-chevron-up" style="color: green; font-size: 18px"></span></td>
									<td><strong style="display: inline-block; width: 100px"><?= Yii::t( 'app', 'Departure' ) ?>:</strong> {{tour.tickets[selCia].tickets[0].flyFk.departure}}</td>
									<td>{{tour.tickets[selCia].tickets[0].flyFk.airport_departure}}</td>
								</tr>
								<tr>
									<td><span class="glyphicon glyphicon-chevron-down" style="color: red; font-size: 18px"></span></td>
									<td><strong style="display: inline-block; width: 100px"><?= Yii::t( 'app', 'Landing' ) ?>:</strong> {{tour.tickets[selCia].tickets[0].flyFk.landing}}</td>
									<td>{{tour.tickets[selCia].tickets[0].flyFk.airport_landing}}</td>
								</tr>
							</table>
						</div>
					</div> <!-- ./VTR-TOUR-ITEM -->
					
					<tool-bar data-page="page" data-page-count="pageCount" data-change-page="changePage"></tool-bar>
				</div> <!-- ./#RESULT_DATA -->
				
				<div data-ng-show="pageCount == 0">
					<h3>Nenhum pacote localizado, para este destino.</h3>
				</div>
			</div> <!-- ./COL-LG -->
		</div> <!-- ./ROW -->
	</div> <!-- ./CONTROLER: searchCtrl -->
</div> <!-- ./APPLICATION: searchApp -->
