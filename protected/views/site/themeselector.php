<style type="text/css">
	#top-black-bar-wrapper
	{
		position:relative;
		top:0;
		left:0;
		background-color:black;
		color:#fff;
		padding:10px 0px;
	}

	#top-black-bar-inner
	{
		width:960px;
		margin:0 auto;
	}

	#top-black-bar-inner a
	{
		color: white;
		font-weight: bolder;
		text-decoration:none;
		font-size: 10px;
	}

	#top-black-bar-inner a:hover
	{
		color: yellow;
	}
</style>
<?php $form=$this->beginWidget('CActiveForm'); ?>
<div id="top-black-bar-wrapper">
    <div id="top-black-bar-inner">
        Welcome to the <strong>Yii Dressing Room!</strong> Please select a Theme to `wear` :)
        <?php  echo isset( $theme ) ? CHtml::activeDropDownList( $theme, 'id', CHtml::listData( Theme::model()->findAll( 'score=1000 ORDER BY `name`' ), 'id', 'name' ) ) : CHtml::activeDropDownList( Theme::model(), 'id', CHtml::listData( Theme::model()->findAll( 'score=1000 ORDER BY `name`' ), 'id', 'name' ) ); ?>
		<?php
			echo CHtml::submitButton( 'change theme' );
		?>
		<?php if( isset( $theme ) ) : ?>
		<a href="http://yiithemes.mehesz.net/theme/<?php echo $theme->id ?>/<?php echo ImHelp::stringToUrl( $theme->name ); ?>" title="if you wanna download this theme">Download theme <?php echo strtoupper( $theme->name ); ?></a> - 
		<?php endif; ?>
		<a href="http://yiithemes.mehesz.net" title="just simply back to the main Yii Themes site">Back to Yii Themes</a>
    </div>
<?php $this->endWidget(); ?>
	<hr />
	<center>
		<script type="text/javascript"><!--
			google_ad_client = "ca-pub-1319358860215477";
			/* Yii Dressing Room */
			google_ad_slot = "7925383539";
			google_ad_width = 728;
			google_ad_height = 90;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
	</center>

</div>
