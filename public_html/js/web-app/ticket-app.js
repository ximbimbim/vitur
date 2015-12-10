/**
 * Search app 
 */
var search_app = angular.module( 'searchApp', [] );

/**
 * Configa cabecalho padrao
 */
search_app.config([ '$httpProvider', function( $httpProvider ) {
	$httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    $httpProvider.defaults.headers.common['X-CSRF-Token'] = $('meta[name="csrf-token"]').attr('content');
}]);

/**
 * Search Controller
 */
search_app.controller( 'searchCtrl', function( $scope, $http ) {
	// Inicia variaveis
	$scope.searchData 			= {};
	$scope.searchData.adults    = 1;
	$scope.searchData.childrens = 0;
	$scope.loading 				= false;
	$scope.dataPromise 			= null;
	
	// Configura eventos
	$scope.$on( 'LOAD',   function() { $scope.loading = true; } );
	$scope.$on( 'UNLOAD', function() { $scope.loading = false; } );
	
	// Inicia datepickers
	angular.element( document ).ready( function() {
		// Mostras erro
		angular.element( "#searchApp_viewer" ).removeClass( 'hide' );
		
		// Setup datepicker language
		if ( angular.element( 'html' ).attr( 'lang' ) == 'en-US' )
			$.datepicker.setDefaults($.datepicker.regional['en']);
		else
		if ( angular.element( 'html' ).attr( 'lang' ) == 'pt-BR' )
			$.datepicker.setDefaults($.datepicker.regional['pt']);
		
		// Setup min date
		angular.element( "[data-ng-model='searchData.go']" ).datepicker({
			dateFormat 	: 'dd/mm/yy',
			minDate 	: 8,			
		});
		
		// Setup min date
		angular.element( "[data-ng-model='searchData.back']" ).datepicker({
			dateFormat 	: 'dd/mm/yy',
		});
	} );
	
	/**
	 * updateBack
	 */
	$scope.updateBack = function() {
		var date 	 = $scope.searchData.go.split( '/' );
		var cur_date = new Date( date[ 1 ] + "/" + date[ 0 ] + "/" + date[ 2 ] );
		var now_date = new Date();
		var dif_date = Math.round( Math.abs( cur_date - now_date ) / ( 1000 * 60 * 60 * 24 ) );
		
		// Define data minima de volta
		angular.element( "[data-ng-model='searchData.back']" ).datepicker( 'option', 'minDate', dif_date + 7 );
		
		// Limpa volta
		$scope.searchData.back = '';
	};
	
	/**
	 * submitSearch
	 */
	$scope.submitSearch = function( url ) {
		$scope.hasError = false;
		$scope.msgError = "";

		// Valida dados do formulario
		if ( $scope.searchFrm.back.$invalid ) {	$scope.hasError = true;	$scope.msgError = "Selecione a data de volta.";	}		
		if ( $scope.searchFrm.go.$invalid )   { $scope.hasError = true; $scope.msgError = "Selecione a data de ida."; }
		if ( $scope.searchFrm.from.$invalid ) { $scope.hasError = true; $scope.msgError = "Selecione a cidade de origem."; }	
		if ( $scope.searchFrm.to.$invalid )   { $scope.hasError = true; $scope.msgError = "Selecione a cidade de destino."; }
		
		// Find
		if ( $scope.searchFrm.$valid ) {
			// Coloca em estado de loading
			$scope.$emit( 'LOAD' );
			
			// Limpa dados do resultado de consulta
			$scope.resultData = null;
			
			// Solicita informacoes por ajax
			$http.post( url, $scope.searchData )
				.then(
				/**
				 * Success
				 */
				function( res ) {
					$scope.$emit( 'UNLOAD' );
					$scope.resultData = res;
				},
				/**
				 * Error
				 */
				function( res ) {					
				}
			); // ./then
		}
	};
} );