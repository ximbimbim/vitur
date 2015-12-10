<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * AngularAsset
 * @author NPShinigami
 *
 */
class AngularAsset extends AssetBundle
{
	public $sourcePath = '@app/assets/angular';
	
	public $js = [
		'angular.min.js'
	];
	
	public $depends = [
		'app\assets\NormalizeAsset'
	];
}