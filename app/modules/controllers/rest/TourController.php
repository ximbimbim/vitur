<?php
namespace app\modules\controllers\rest;

use yii\rest\ActiveController;

use app\models\Tours;
use yii\data\ActiveDataProvider;

/**
 * TourController
 * @author NPShinigami
 *
 */
class TourController extends ActiveController
{
	public $modelClass = 'app\models\Tours';
	
	public function actions(){
		$actions = parent::actions();
		unset( $actions[ 'index' ] );
		return $actions;
	}
	
	/**
	 * actionIndex
	 * @param unknown $to
	 */
	public function actionIndex()
	{		
		$provider = new ActiveDataProvider([
			'query' => Tours::find()
				->with( [ 'hotelFk', 'hotelFk.hotelFeatures', 'hotelFk.hotelFeatures.featuresFk' ] )
				->asArray(),
			'pagination' => [
				'pageSize' => 2,
			],
		]);
		
		return $provider;
	}
}