/**
 * PaginationService
 */
search_app.factory( 'PaginationService', function() {
	return {
		page 		: 0,
		numPages	: 0,
		numItems	: 0,
	};
} );

/**
 * Pagination directive
 */
search_app.directive( 'vtrPagination', function( $compile, PaginationService ) {
	return {
		restrict 	: 'C',
		scope		: {			
		},
		controller 	: function( $scope ) {
			/**
			 * A pagina esta ativa
			 */
			$scope.isActive = function( page ) { return page == PaginationService.offset; }
			
			/**
			 * Configura botao 
			 */
			$scope.backBtn = function() {
				return PaginationService.page == 1;
			}
			
			/**
			 * Configura botao 
			 */
			$scope.nextBtn = function() {
				return PaginationService.page == PaginationService.pageCount;
			}
			
			/**
			 * Muda de pagina
			 */
			$scope.changePage = function( page ) {
				PaginationService.offset = page;
			}
			
			/**
			 * pagina anterior 
			 */
			$scope.backPage = function( page ) {
				if ( PaginationService.offset > 0 )
					PaginationService.offset--;
			}
			
			/**
			 * Proxima pagina 
			 */
			$scope.nextPage = function( page ) {
				if ( PaginationService.offset < PaginationService.numPages - 1 )
					PaginationService.offset++;
			}
		},
		link : function( $scope, $el, $attrs ) {			
			// Detecta mudanca no serviço
			$scope.$watch(
				function() { return PaginationService.numPages; },
				function( newVal ) {
					var table 	= angular.element( '<table class="vtr-pagination-bar"></table>' );
					var tr 		= angular.element( '<tr></tr>' );
															
					// Adiciona botao para voltar
					tr.append(
						'<td data-ng-class="{ \'disable\': backBtn() }">' +
							'<a href="" data-ng-click="backPage()"><span class="glyphicon glyphicon-menu-left"></span></a>' +
						'</td>'
					);
					
					// Adiciona botoes de paginação
					for ( var i = 0; i < PaginationService.numPages; i++ ) {
						tr.append(
							'<td data-ng-class="{ \'active\': isActive(' + i + ')}">' + 
								'<a href="" data-ng-click="changePage(' + i + ')">' + ( i + 1 ) + '</a>' +
							'</td>'
						);
					}
					
					// Adiciona botao para avançar
					tr.append(
						'<td data-ng-class="{ \'disable\' : nextBtn() }">' +
							'<a href="" data-ng-click="nextPage()"><span class="glyphicon glyphicon-menu-right"></span></a>' +
						'</td>'
					);
					
					// Adiciona linha a tabela
					table.append( tr );
					
					// Adiciona tabela ao elemento 
					$el.html( $compile( table )( $scope ) );
				}				
			);
		}
	};
} );