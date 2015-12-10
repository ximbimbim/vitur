<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * FontAwesomeAsset
 * @author NPShinigami
 *
 */
class FontAwesomeAsset extends AssetBundle
{
	public $sourcePath = '@app/assets/fontawesome';
	
	public $css = [
		'css/font-awesome.min.css'
	];
	
	public $depends = [
		'yii\bootstrap\BootstrapPluginAsset'
	];
}