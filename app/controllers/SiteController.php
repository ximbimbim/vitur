<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\Hotels;
use app\models\City;
use app\models\Tickets;

/**
 * SiteController
 * @author NPShinigami
 *
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }
    
    /**
     * beforeAction
     * {@inheritDoc}
     * @see \yii\web\Controller::beforeAction()
     */
    public function beforeAction( $action )
    {
    	// Configura linguagem
    	if ( isset( \Yii::$app->session[ 'language' ] ) )
    		\Yii::$app->language = \Yii::$app->session[ 'language' ];
    	
    	return parent::beforeAction( $action );
    }
    
    /**
     * actionIndex
     */
    public function actionIndex()
    {
    	return $this->render( 'index' );
    }
    
    /**
     * actionComponent
     */
    public function actionComponent()
    {
    	return $this->render( 'component' );
    }
    
    /**
     * actionChangeLang
     */
    public function actionChangeLang( $lang, $route )
    {
    	// Setup language at session
    	\Yii::$app->session[ 'language' ] = $lang;
    	
    	// redirect
    	return $this->redirect( $route );
    }
    

    /**
     * actionTickets
     */
    public function actionTickets()
    {
    	return $this->render( 'tickets' );
    }
    

    /**
     * actionTours
     */
    public function actionTours()
    {
    	$find 			= \Yii::$app->getRequest()->get( 'find' );
    	$tours 			= array();
    	$random_tours 	= array();   
    	
    	if ( isset( $find ) ) {
	    	$tours = $random_tours;
    	}    	
		return $this->render( 'tours', [ 'tours' => $tours, 'random_tours' => $random_tours, 'find' => $find ] );
    }
    

    /**
     * actionHotels
     */
    public function actionHotels()
    {
		return $this->render( 'hotels' );
    }
    
    /**
     * actionTourDetail
     * @param $id
     * @return string
     */
    public function actionTour( $id )
    {    	    	
    	return $this->render( 'tour-detail' );
    }
    
    /**
     * actionGenerateTour
     * @param unknown $to
     * @param unknown $from
     * @param unknown $adults
     * @param unknown $childrens
     * @param unknown $rooms
     * @param unknown $go
     * @param unknown $back
     */
    public function actionGenerateTour( $to, $from, $adults, $childrens, $rooms, $go, $back )
    {
    	if ( \Yii::$app->request->isAjax )
    	{
    		$tour 			= [];
    		$city_to 		= City::findOne([ 'name' => $to ]);
    		$city_from 		= City::findOne([ 'name' => $from ]);
    		
    		$date_go 	 	= explode( '/', $go );
			$date_bk 	 	= explode( '/', $back );			
			$where_query 	= [];
			
			// Filtra por origem e destino
			$where_query[] 	= 'and';
			$where_query[] 	= [ '=', 'fly.airport_departure', $city_from->getAttribute( 'airport' ) ];
			$where_query[]	= [ '=', 'fly.airport_landing', $city_to->getAttribute( 'airport' ) ];
			
			// Filtra por data
			$where_query[] = [ 'or',
				[ '=', 'DATE(fly.departure)', $date_go[2].'-'.$date_go[1].'-'.$date_go[0] ],
				[ '=', 'DATE(fly.landing)', $date_bk[2].'-'.$date_bk[1].'-'.$date_bk[0] ]
			];
			
			// Localiza todos os hoteis disponiveis no destino
			$hotels = Hotels::find([ 'city_fk' => $city_to->getAttribute( 'airport' ) ])->with( 'hotelFeatures', 'hotelFeatures.featuresFk' )->asArray()->all();
			$tcs_ad = Tickets::find()->joinWith( 'flyFk' )->where( $where_query )->andWhere([ 'seat_type' => 'Adults' ])->asArray()->all();
			
			if ( intval( $childrens ) > 0 )
				$tcs_ch = Tickets::find()->joinWith( 'flyFk' )->where( $where_query )->andWhere([ 'seat_type' => 'Childrens' ])->asArray()->all();
			
			// Gera tours
			foreach ( $hotels as $hotel )
			{
				$tour = [];				
				$tour[ 'hotel' ] = $hotel;
				$tour[ 'tk_price' ] = 0;
				foreach ( $tcs_ad as $ticket )
				{
					$cia = [];
					$cia[ 'name' ]   = $ticket[ 'flyFk' ][ 'cia' ];
					$cia[ 'tickets' ][] = $ticket;
					
					if ( intval( $childrens ) > 0 ) {
						foreach ( $tcs_ch as $ticket )
						{
							if ( $cia[ 'name' ] == $ticket[ 'flyFk' ][ 'cia' ] ) {
								$cia[ 'tickets' ][] = $ticket;
							}
						}
					}
					
					// Gera preço
					$cia[ 'price' ] = 0;					
					foreach ( $cia[ 'tickets' ] as $ticket ) {
						if ( $ticket[ 'seat_type' ] == 'Adults' )
							$cia[ 'price' ] += $ticket[ 'price' ] * intval( $adults );
						if ( $ticket[ 'seat_type' ] == 'Childrens' )
							$cia[ 'price' ] += $ticket[ 'price' ] * intval( $childrens );
					}
					
					$tour[ 'tickets' ][] = $cia;
				}			
				
				// Gera o valor
				$go 			 	= new \DateTime( $date_go[2].'-'.$date_go[1].'-'.$date_go[0] );
				$back  			 	= new \DateTime( $date_bk[2].'-'.$date_bk[1].'-'.$date_bk[0] );
				$tour[ 'daily' ] 	= $go->diff( $back )->days * $rooms;
				
				// Adiciona tour a lista				
				$tours[] = $tour;
			}
			
			return json_encode( [
				'findTitle' => $to,
				'pageData' => $tours
			] );
    	}
    }
}