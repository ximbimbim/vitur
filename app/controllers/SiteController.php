<?php
namespace app\controllers;

use yii\web\Controller;

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
     * actionFindTour
     */
    public function actionFindTour()
    {
    	$hotels = [
    		[
    			'id' => 1000,
    			'name' => 'Hotel San Juan',
    			'features' => [ 'coffee', 'wifi', 'bicycle' ],
    			'price' => [ 'full' => 1923, 'cent' => 20 ],
    			'parcel' => [ 'full' => 192, 'cent' => 32, 'quant' => 10 ],
    		],
    		[
    			'id' => 1001,
    			'name' => 'Hotel San Marino',
    			'features' => [ 'coffee', 'wifi', 'bicycle' ],
    			'price' => [ 'full' => 1823, 'cent' => 20 ],
    			'parcel' => [ 'full' => 182, 'cent' => 32, 'quant' => 10 ],
    		],
    		[
    			'id' => 1002,
    			'name' => 'Hotel Guanabara',
    			'features' => [ 'coffee', 'wifi', 'bicycle' ],
    			'price' => [ 'full' => 2823, 'cent' => 20 ],
    			'parcel' => [ 'full' => 282, 'cent' => 32, 'quant' => 10 ],
    		]
    	];
    	
    	if ( \Yii::$app->request->isAjax )
    	{
    		$data = json_decode( \Yii::$app->request->getRawBody() );
    		
    		// Gera dados
    		$page = [];
    		for ( $i = $data->offset; $i < $data->offset + 2; $i++ )
    			$page[] = $hotels[ $i ];
    		
    		return json_encode([
    			'numPages' => 2,
    			'numItems' => 3,
    			'data' => json_encode( $page ),
    		]);
    	}
    }
}