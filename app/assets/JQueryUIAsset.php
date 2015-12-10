<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * JQueryUIAsset
 * @author NPShinigami
 *
 */
class JQueryUIAsset extends AssetBundle
{
	public $sourcePath = '@app/assets/jui';
	
	public $css = [
		'jquery-ui.min.css'
	];
	
	public $js = [
		'jquery-ui.min.js',
		'jquery-ui-i18n.min.js'	
	];
	
	public $depends = [
		'app\assets\NormalizeAsset'
	];
}