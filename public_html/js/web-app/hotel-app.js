/**
 * Search app 
 */
var search_app = angular.module( 'searchApp', [] );

/**
 * Configura cabecalho padrao
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
	$scope.formData		= {};
	$scope.formData.to	= 'Buzios';
	$scope.page			= null;
	$scope.pageCount	= null;
	$scope.url			= {};
	$scope.loading		= false;
		
	// Inicia datepickers
	angular.element( document ).ready( function() {
		angular.element( "#searchApp_viewer" ).removeClass( 'hide' );
	} );
	
	/**
	 * changePage
	 */
	$scope.changePage	= function( page ) {
		var $self = $scope;
		
		// Define flag de loading
		$self.loading = true;
		
		// Setup page
		if ( page !== null ) $self.formData.page = page;
				
		// Realiza consulta
		$http({
			url 	: $self.url,				
			params	: $self.formData,
			method	: 'get'
		})
		.success( function( res, status, header, xhr ) {
			// 200: OK
			if ( status == 200 ) {					
				// Configura dados de paginação
				$self.page		= header( 'X-Pagination-Current-Page' );
				$self.pageCount = header( 'X-Pagination-Page-Count' );
				$self.pageData	= res;
			}
			
			// Define flag de loading
			$self.loading = false;
		} );
	};
			
	/**
	 * submitSearch
	 */
	$scope.submitSearch = function() {
		$scope.hasError = false;
		$scope.msgError = "";
		
		// Valida dados do formulario
		if ( $scope.searchFrm.to.$invalid ) { $scope.hasError = true; $scope.msgError = "Selecione o destino.";	}
		
		// Find
		if ( $scope.searchFrm.$valid )
			$scope.changePage( null );
	};
} );