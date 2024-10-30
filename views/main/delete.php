<p>You are about to delete the survey: <strong><?=$survey_model->title?></strong></p>

<form method="post" style="display:inline">
	<input type="hidden" name="id" value="<?=$_GET['id']?>" />
	<input class="button" type="submit" name="action" value="Yes, delete this survey" />
</form>

<form method="post" style="display:inline">
    <input class="button" type="submit" name="action" value="No, return me to the survey list" />
</form>