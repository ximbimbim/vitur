<?php
namespace app\modules\controllers\rest;

use yii\rest\ActiveController;

use app\models\Hotels;
use yii\data\ActiveDataProvider;
use app\models\City;

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
	public function actionIndex( $to, $pageSize = 2 )
	{
		$provider = new ActiveDataProvider([
			'query' => Hotels::find()
				->where([ 'city_fk' => City::findOne([ 'name' => $to ])->getAttribute( 'airport' ) ])
				->with([ 'hotelFeatures', 'hotelFeatures.featuresFk' ])
				->asArray(),
			'pagination' => [
				'pageSize' => $pageSize,
			],
		]);
		
		return $provider;
	}
}