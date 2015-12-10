<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * EmberAsset
 * @author NPShinigami
 *
 */
class EmberAsset extends AssetBundle
{
	public $sourcePath = '@app/assets/ember';
	
	public $js = [
		'ember-template-compiler.min.js',
		'ember.min.js'
	];
	
	public $depends = [
		'app\assets\NormalizeAsset'
	];
}