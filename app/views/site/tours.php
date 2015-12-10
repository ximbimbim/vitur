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
$this->registerJsFile( '@web/js/web-app/tour-app.js', [ 'depends' => 'app\assets\AngularAsset' ] );
$this->registerCssFile( '@web/css/tour_app.css', [ 'depends' => 'app\assets\AngularAsset' ] );
?>
<div data-ng-app="searchApp">
	<div data-ng-controller="searchCtrl">
		<div data-ng-init="url.hotel_rest='<?= Url::toRoute( 'v0/tours' ) ?>'"></div>
		<div class="row hide" id="searchApp_viewer">			
			<div class="col-md-4">
				<form name="searchFrm" data-ng-submit="submitSearch('<?= Url::to( 'site/find-tour' ) ?>')" novalidate>
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
								<input type="text" class="form-control" name="to" data-ng-model="searchData.to" required />
							</div>
							
							<div class="form-group">
								<label class="label label-default"><?= Yii::t( 'app', 'From' ) ?></label>
								<input type="text" class="form-control" name="from" data-ng-model="searchData.from" required />
							</div>

							<div class="row">
								<div class="col-xs-4">
									<div class="form-group">
										<label class="label label-default"><?= Yii::t( 'app', 'Adults' ) ?></label>
										<input type="number" class="form-control" name="adults" min="1" value="1" data-ng-model="searchData.adults" required />
									</div>
								</div>
								<div class="col-xs-4">
									<div class="form-group">
										<label class="label label-default"><?= Yii::t( 'app', 'Childrens' ) ?></label>
										<input type="number" class="form-control" name="childrens" min="0" value="0" data-ng-model="searchData.childrens" required />
									</div>
								</div>
								<div class="col-xs-4">
									<div class="form-group">
										<label class="label label-default"><?= Yii::t( 'app', 'Rooms' ) ?></label>
										<input type="number" class="form-control" name="rooms" min="1" value="1" data-ng-model="searchData.rooms" required />
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<label class="label label-default"><?= Yii::t( 'app', 'Go' ) ?></label>
										<input type="text" class="form-control" name="go" data-ng-model="searchData.go" data-ng-click="selectGoDate()" data-ng-change="updateBack()" readonly required />
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label class="label label-default"><?= Yii::t( 'app', 'Back' ) ?></label>
										<input type="text" class="form-control" name="back" data-ng-model="searchData.back" data-ng-click="selectBackDate()" readonly required />
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

					<div class="vtr-tour-item" data-ng-repeat="tour in ps().pageData">
						<div class="vtr-tour-img"><img data-ng-src="<?= Url::to( '@web/img/hotel' ) ?>_{{tour.hotelFk.id}}.jpg" class="img-responsive" /></div>
						<div class="vtr-tour-body">
							<div style="display: inline-block; width: 100%; height: 100%; position: relative">
								<h3>{{tour.hotelFk.name}}</h3>
								<p><strong><?= Yii::t( 'app', 'Localization' ) ?></strong> <a href="" class="vtr-see-map"><span class="glyphicon glyphicon-pushpin"></span> <?= Yii::t( 'app', 'Map' ) ?></a></p>
								<div class="vtr-features-box">									
									<span data-ng-repeat="feature in tour.hotelFk.features" class="fa fa-{{feature.class}}"></span>
								</div>
								<div class="vtr-price-box">
									<h4 class="vtr-price-value"><sub>R$</sub> {{tour.hotelFk.price}}<sup>,{{tour.hotelFk.price % 100}}</sup></h4>
									<h3 class="vtr-price-parcel"><sub>{{tour.hotelFk.price/tour.hotelFk.parcel}}x</sub> R$ {{tour.hotelFk.parcel}}<sup>,{{tour.hotelFk.parcel%100}}</sup></h3>
								</div>
							</div>
						</div>
						<div class="vtr-tour-tool">
							<table class="vtr-ticket-table">
								<tr>
									<td><span class="glyphicon glyphicon-arrow-right" style="color: green; font-size: 18px"></span></td>
									<td><strong style="display: inline-block; width: 50px"><?= Yii::t( 'app', 'Go' ) ?>:</strong> {{tour.go_date}}</td>
									<td>{{tour.go_hour}}</td>
									<td>{{tour.airport_go}}</td>
								</tr>
								<tr>
									<td><span class="glyphicon glyphicon-arrow-left" style="color: red; font-size: 18px"></span></td>
									<td><strong style="display: inline-block; width: 50px"><?= Yii::t( 'app', 'Back' ) ?>:</strong> {{tour.back_date}}</td>
									<td>{{tour.back_hour}}</td>
									<td>{{tour.airport_back}}</td>
								</tr>
							</table>
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
