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
	$scope.formData 			= {};
	$scope.formData.to			= 'Buzios';
	$scope.formData.from		= 'Belo Horizonte';
	$scope.formData.adults		= 1;
	$scope.formData.childrens	= 0;
	$scope.formData.rooms		= 1;
	$scope.formData.go			= '20/12/2015';
	$scope.formData.back		= '28/12/2015';
	$scope.formData.orderBy		= 'lpri';
	$scope.page					= null;
	$scope.pageCount			= null;
	$scope.url					= {};
	$scope.loading				= false;
	$scope.selCia				= '0';
		
	// Inicia datepickers
	angular.element( document ).ready( function() {
		angular.element( "#searchApp_viewer" ).removeClass( 'hide' );
		
		// Configura linguagem
		$.datepicker.setDefaults(
			$.datepicker.regional[ angular.element( 'html' ).attr( 'lang' ) ]
		);
		
		// Configura datepicker de ida
		angular.element( '[data-ng-model="formData.go"]' ).datepicker({
			minDate 	: 7,
			dateFormat 	: 'dd/mm/yy',
		});
		
		angular.element( '[data-ng-model="formData.back"]' ).datepicker({
			dateFormat 	: 'dd/mm/yy',
		});
	} );
	
	// Setup datepicker
	$scope.selectGoDate = function() {		
		angular.element( '[data-ng-model="formData.go"]' ).datepicker( 'show' );
	};
	
	// Setup datepicker
	$scope.updateBack = function() {
		var $d		 = $scope.formData.go.split( '/' );
		var go_date  = new Date( $d[1] + '-' + $d[0] + '-' + $d[2] );
		var cur_date = new Date();
		var diff 	 = go_date.getDate() - cur_date.getDate();

		// Limpa campo
		$scope.formData.back = '';
		
		// inicia datepicker
		angular.element( '[data-ng-model="formData.back"]' ).datepicker( 'option', 'minDate', diff + 3 );		
	};
	
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
				$self.pageData	= res.pageData;
				$self.findTitle = res.findTitle;
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
		if ( $scope.searchFrm.to.$invalid )   { $scope.hasError = true; $scope.msgError = "Selecione o destino.";	}
		if ( $scope.searchFrm.from.$invalid ) { $scope.hasError = true; $scope.msgError = "Selecione a origem.";	}
		if ( $scope.searchFrm.go.$invalid )   { $scope.hasError = true; $scope.msgError = "Selecione a data de ida.";	}
		if ( $scope.searchFrm.back.$invalid ) { $scope.hasError = true; $scope.msgError = "Selecione a data de volta.";	}
		
		// Find
		if ( $scope.searchFrm.$valid )
			$scope.changePage( null );
	};
} );
