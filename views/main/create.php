<style>
.width27-5 {
	width: 27.5%! important;
}
</style>
<?php $c = new KAL_Controller(); echo $c->renderPartial(KAL_PLUGIN_PATH . 'views/main/_form.php', array('keyword_model' => $keyword_model)); ?>