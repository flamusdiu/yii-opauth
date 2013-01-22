<?php foreach (Yii::app()->user->getFlashes() as $key => $message): ?>
	<div class="flash-error"> <?php echo $message ?> </div>
<?php endforeach; ?>		
<ul class='opauth-providerlist'>
	<?php foreach ($providers as $provider => $settings): ?>
		<li class='active' >
			<a id="opauth-<?php echo $provider ?>" href="<?php echo $this->controller->createUrl("/".$baseUrl)."/".strtolower($provider) ?>" >
				<img src="<?php echo $assetsUrl ?>/images/<?php echo strtolower($provider)?>.png"/>
			</a>
		</li>
	<?php endforeach; ?>
</ul>