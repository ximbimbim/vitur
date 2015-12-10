<?php
namespace app\modules\controllers\rest;

use yii\rest\ActiveController;

use app\models\Hotels;
use yii\data\ActiveDataProvider;

/**
 * HotelController
 * @author NPShinigami
 *
 */
class HotelController extends ActiveController
{
	public $modelClass = 'app\models\Hotels';
	
	public function actions(){
		$actions = parent::actions();
		unset( $actions[ 'index' ] );
		return $actions;
	}
	
	/**
	 * actionIndex
	 * @param unknown $to
	 */
	public function actionIndex( $to )
	{		
		$provider = new ActiveDataProvider([
			'query' => Hotels::find()->where([ 'to' => $to ])->with( 'features' ),
			'pagination' => [
				'pageSize' => 6,
			],
		]);
		
		return $provider;
	}
}