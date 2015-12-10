<?php
use yii\web\View;
use yii\helpers\Url;

$js = <<<EOF
	window.openAsd = function() {
		$( '#asd' ).toggleClass( 'open' );
	}
EOF;
$this->registerJs( $js, View::POS_READY );
?>

<style>
.min
{
	height: auto;
	max-height: 26px;
	border: 1px solid black;
	
	-webkit-transition: max-height 2s linear;
            transition: max-height 2s linear;
}
.min.open
{
	border: 1px solid black;
	max-height: 200px;
}
.gray-box
{
	background-color: gray;
	height: 100px;
}
</style>


<div id="asd" class="min">
	<button type="button" onclick="window.openAsd()">Ok</button>
	<div class="gray-box"></div>	
</div>