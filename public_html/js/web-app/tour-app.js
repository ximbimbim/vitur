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

search_app.factory( 'PaginationService', function( $http ) {
	return {
		changed		: false,
		loading		: false,
		page 		: 0,
		pageCount	: 0,
		pageData	: [],
		url			: '',
		formData	: {},
		hasResult	: undefined,
		
		/**
		 * findData
		 */
		findData	: function() {
			var $self = this;
			
			// Loading flag
			$self.loading = true;
			$self.formData.expand = 'hotelFk,hotelFk.features';
			
			// Realiza consulta
			$http({
				url 	: $self.url,				
				params	: $self.formData,
				method	: 'get'
			})
			.success( function( res, status, header, xhr ) {
				// 200: OK
				if ( status == 200 ) {
					$self.loading = false;
					
					// Configura dados de paginação
					$self.page		= header( 'X-Pagination-Current-Page' );;
					$self.pageCount	= header( 'X-Pagination-Page-Count' );
					$self.pageData	= res;					
					$self.changed	= true;
					
					// Verifica se tem resultados
					$self.hasResult = res.length > 0;
				}
			} );
		},
		
		/**
		 * nextPage
		 */
		nextPage 	: function() {
			var $self = this;
			
			if ( $self.page < $self.pageCount ) {
				$self.formData.page = ++$self.page;
				
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
						$self.page		= header( 'X-Pagination-Current-Page' );;
						$self.pageData	= res;
					}
				} );
			}
		},
		
		/**
		 * backPage
		 */
		backPage 	: function() {
			var $self = this;
			
			if ( $self.page > 1 ) {
				$self.formData.page = --$self.page;
				
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
						$self.page		= header( 'X-Pagination-Current-Page' );;
						$self.pageData	= res;
					}
				} );
			}
		}
	};
} );

/**
 * Search Controller
 */
search_app.controller( 'searchCtrl', function( $scope, $http, PaginationService ) {
	// Inicia variaveis
	$scope.searchData 			= {};
	$scope.searchData.to		= 'Paris';
	$scope.searchData.from		= 'Belo Horizonte';
	$scope.searchData.adults	= 1;
	$scope.searchData.childrens	= 0;
	$scope.searchData.rooms		= 1;
	$scope.searchData.go		= '20/12/2015';
	$scope.searchData.back		= '28/12/2015';
	$scope.url					= {};
		
	// Inicia datepickers
	angular.element( document ).ready( function() {
		angular.element( "#searchApp_viewer" ).removeClass( 'hide' );
	} );
	
	// PaginationService instance
	$scope.ps = function() { return PaginationService; };
			
	/**
	 * submitSearch
	 */
	$scope.submitSearch = function() {
		$scope.hasError = false;
		$scope.msgError = "";
		
		// Valida dados do formulario
		if ( $scope.searchFrm.to.$invalid ) { $scope.hasError = true; $scope.msgError = "Selecione o destino.";	}
		if ( $scope.searchFrm.from.$invalid ) { $scope.hasError = true; $scope.msgError = "Selecione a origem.";	}
		if ( $scope.searchFrm.go.$invalid ) { $scope.hasError = true; $scope.msgError = "Selecione a data de ida.";	}
		if ( $scope.searchFrm.back.$invalid ) { $scope.hasError = true; $scope.msgError = "Selecione a data de volta.";	}
		
		// Find
		if ( $scope.searchFrm.$valid ) {
			// Configura dados
			PaginationService.url 		  = $scope.url.hotel_rest;
			PaginationService.formData.to = $scope.searchData.to;
			
			// Processa e atualiza informações
			PaginationService.findData();
		};
	};
} );

/**
 * Pagination directive
 */
search_app.directive( 'vtrPagination', function( $compile, PaginationService ) {
	return {
		restrict 	: 'C',
		controller 	: function( $scope ) {
			$scope.isActive = function( page ) { return PaginationService.page == page; }
			
			$scope.backPage = function() { PaginationService.backPage(); }
			$scope.nextPage = function() { PaginationService.nextPage(); }
			
			$scope.backBtn = function() { return PaginationService.page == 1; }
			$scope.nextBtn = function() { return PaginationService.page == PaginationService.pageCount }
		},
		link	 	: function( $scope, $el, $attrs ) {					
			// Detecta mudanca no serviço
			$scope.$watch(
				function() { return PaginationService.changed; },
				function( newVal ) {
					if ( newVal == true ) {
						var table 	= angular.element( '<table class="vtr-pagination-bar"></table>' );
						var tr 		= angular.element( '<tr></tr>' );
						
						// Adiciona botao para voltar
						tr.append( '<td data-ng-class="{\'disable\': backBtn()}"><a href="" data-ng-click="backPage()"><span class="glyphicon glyphicon-menu-left"></span></a></td>' );
						
						// Adiciona botao de paginação
						for ( var i = 1; i <= PaginationService.pageCount; i++ )
							tr.append( '<td data-ng-class="{ \'active\': isActive(' + i + ')}"><a href="" data-ng-click="changePage(' + i + ')">' + i + '</a></td>' );
						
						// Adiciona botao para avançar
						tr.append( '<td data-ng-class="{\'disable\': nextBtn()}"><a href="" data-ng-click="nextPage()"><span class="glyphicon glyphicon-menu-right"></span></a></td>' );
						
						// Adiciona linha a tabela
						table.append( tr );
						
						// Adiciona tabela ao elemento 
						$el.html( $compile( table )( $scope ) );
						
						// Muda flag
						PaginationService.changed = false;
					}
				}
			);
		}
	};
} );