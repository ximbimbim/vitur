<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * NormalizeAsset
 * @author NPShinigami
 *
 */
class NormalizeAsset extends AssetBundle
{
	public $sourcePath = '@app/assets/normalize';
	
	public $css = [
		'normalize.css'
	];
}