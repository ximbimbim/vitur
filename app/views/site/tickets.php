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
$this->registerJsFile( '@web/js/web-app/directives.js', [ 'depends' => 'app\assets\AngularAsset' ] );
$this->registerCssFile( '@web/css/ticket_app.css', [ 'depends' => 'app\assets\AngularAsset' ] );
?>
<div data-ng-app="searchApp">
	<div data-ng-controller="searchCtrl">
		<div data-ng-init="url='<?= Url::toRoute( 'v0/tickets' ) ?>'"></div>
		<div class="row hide" id="searchApp_viewer">			
			<div class="col-md-4">
				<form name="searchFrm" data-ng-submit="submitSearch()" novalidate>
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
								<input type="text" class="form-control" name="to" data-ng-model="formData.to" required />
							</div>
							
							<div class="form-group">
								<label class="label label-default"><?= Yii::t( 'app', 'From' ) ?></label>
								<input type="text" class="form-control" name="from" data-ng-model="formData.from" required />
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
							
							<div class="form-group">
								<label class="label label-default"><?= Yii::t( 'app', 'Seat type' ) ?></label>
								<div class="row">
									<div class="col-md-6 col-lg-6">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="childrens" data-ng-model="formData.adults" />
												<?= Yii::t( 'app', 'Adults' ) ?>
											</label>
										</div>
									</div>
									
									<div class="col-md-6 col-lg-6">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="childrens" data-ng-model="formData.childrens" />
												<?= Yii::t( 'app', 'Childrens' ) ?>
											</label>
										</div>
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
					
					<!-- TODO: Ticket interface -->
					<div class="vtr-tour-item" data-ng-repeat="ticket in pageData">
						<table class="table table-condensed">
							<tr>
								<th style="width: 150px"><?= Yii::t( 'app', 'Company' ) ?></th><td>{{ticket.flyFk.cia}}</td>
							</tr>
							<tr>
								<th style="width: 150px"><?= Yii::t( 'app', 'Seat type' ) ?></th><td>{{ticket.seat_type}}</td>
							</tr>
							<tr>
								<th style="width: 150px"><?= Yii::t( 'app', 'Price' ) ?></th><td>R$ {{ticket.price}}</td>
							</tr>
							<tr>
								<td colspan="2">
									<table class="vtr-ticket-table">
										<tr>
											<td><span class="glyphicon glyphicon-chevron-up" style="color: green; font-size: 18px"></span></td>
											<td><strong style="display: inline-block; width: 100px"><?= Yii::t( 'app', 'Departure' ) ?>:</strong> {{ticket.flyFk.departure}}</td>
											<td>{{ticket.flyFk.airport_departure}}</td>
										</tr>
										<tr>
											<td><span class="glyphicon glyphicon-chevron-down" style="color: red; font-size: 18px"></span></td>
											<td><strong style="display: inline-block; width: 100px"><?= Yii::t( 'app', 'Landing' ) ?>:</strong> {{ticket.flyFk.landing}}</td>
											<td>{{ticket.flyFk.airport_landing}}</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>						
					</div>
					
					<tool-bar data-page="page" data-page-count="pageCount" data-change-page="changePage"></tool-bar>
				</div> <!-- ./#RESULT_DATA -->
				
				<div data-ng-show="pageCount == 0">
					<h3>Nenhuma passagem localizada, com estes parametros.</h3>
				</div>
			</div> <!-- ./COL-LG -->
		</div> <!-- ./ROW -->
	</div> <!-- ./CONTROLER: searchCtrl -->
</div> <!-- ./APPLICATION: searchApp -->
