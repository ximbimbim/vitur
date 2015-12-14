<?php
namespace app\modules\controllers\rest;

use yii\rest\ActiveController;

use app\models\Tours;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

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
	 * behaviors
	 * {@inheritDoc}
	 * @see \yii\rest\Controller::behaviors()
	 */
	public function behaviors()
	{
		$behaviors = parent::behaviors();
		
		$behaviors[ 'access' ] = [
			'class' => AccessControl::className(),
			'only' => [ 'index', 'view', 'update', 'create', 'delete', 'options' ],
			'rules' => [
				[
					'allow' => true,
					'actions' => [ 'index', 'view', 'options' ],
					'roles' => [ '?' ],
				],
				[
					'allow' => true,
					'actions' => [ 'index', 'view', 'update', 'create', 'delete', 'options' ],
					'roles' => [ '@' ],
				],
			],
		];
		
		return $behaviors;
	}
	
	/**
	 * actionIndex
	 * @param unknown $to
	 */
	public function actionIndex( $pageSize = 2 )
	{		
		$provider = new ActiveDataProvider([
			'query' => Tours::find()
				->with( [ 'hotelFk', 'hotelFk.hotelFeatures', 'hotelFk.hotelFeatures.featuresFk' ] )
				->asArray(),
			'pagination' => [
				'pageSize' => $pageSize,
			],
		]);
		
		return $provider;
	}
}