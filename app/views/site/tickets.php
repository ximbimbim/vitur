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
$this->registerJsFile( '@web/js/web-app/ticket-app.js', [ 'depends' => 'app\assets\AngularAsset' ] );
$this->registerCssFile( '@web/css/ticket_app.css', [ 'depends' => 'app\assets\AngularAsset' ] );
?>
<div data-ng-app="searchApp">
	<div data-ng-controller="searchCtrl">
		<div class="row hide" id="searchApp_viewer">			
			<div class="col-md-4">
				<form name="searchFrm" data-ng-submit="submitSearch('<?= Url::to( 'site/find-tour' ) ?>')" novalidate>
					<div class="vtr-form">
						<div class="vtr-form-title"><?= Yii::t( 'app', 'Tickets' ) ?></div>
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
								<div class="col-xs-6">
									<div class="form-group">
										<label class="label label-default"><?= Yii::t( 'app', 'Adults' ) ?></label>
										<input type="number" class="form-control" name="adults" min="1" value="1" data-ng-model="searchData.adults" required />
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label class="label label-default"><?= Yii::t( 'app', 'Childrens' ) ?></label>
										<input type="number" class="form-control" name="childrens" min="0" value="0" data-ng-model="searchData.childrens" required />
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
				<p data-ng-show="loading"><img src="<?= Url::to( '@web/img/loading.gif' ) ?>" class="pull-center" /></p>
				<div data-ng-show="resultData">
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
					
					<?php for( $j = 0; $j < 3; $j++ ) { ?>
					<div class="vtr-tour-item">
						<div class="vtr-tour-img"><img src="<?= Url::to( '@web/img/mini-promo2.jpg') ?>" class="img-responsive" /></div>
						<div class="vtr-tour-body">
							<div style="display: inline-block; width: 100%; height: 100%; position: relative">
								<h3>Titulo</h3>
								<p><strong><?= Yii::t( 'app', 'Localization' ) ?></strong> <a href="" class="vtr-see-map"><span class="glyphicon glyphicon-pushpin"></span> <?= Yii::t( 'app', 'Map' ) ?></a></p>
								<div class="vtr-features-box">									
									<span class="fa fa-coffee"></span>
									<span class="fa fa-wifi"></span>
									<span class="fa fa-cutlery"></span>
									<span class="fa fa-bicycle"></span>
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
									<td><strong style="display: inline-block; width: 50px"><?= Yii::t( 'app', 'Go' ) ?>:</strong> 15/12/2015</td>
									<td>09:30</td>
									<td>CNF/SDU</td>
								</tr>
								<tr>
									<td><span class="glyphicon glyphicon-arrow-left" style="color: red; font-size: 18px"></span></td>
									<td><strong style="display: inline-block; width: 50px"><?= Yii::t( 'app', 'Back' ) ?>:</strong> 15/01/2016</td>
									<td>14:30</td>
									<td>SDU/CNF</td>
								</tr>
							</table>
						</div>
					</div> <!-- ./VTR-TOUR-ITEM -->
					<?php } ?>
					
					<div class="vtr-tool-bar">
						<p>&nbsp;</p>
					</div> <!-- ./VTR-ORDER-BAR -->
				</div> <!-- ./#RESULT_DATA -->
			</div> <!-- ./COL-LG -->
		</div> <!-- ./ROW -->
	</div> <!-- ./CONTROLER: searchCtrl -->
</div> <!-- ./APPLICATION: searchApp -->
