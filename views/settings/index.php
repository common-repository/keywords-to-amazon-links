<form method="post" action="options.php" xmlns="http://www.w3.org/1999/html">
<?php settings_fields( 'kal-settings-group' ); ?>

<div class="well">
	<table class="form-table">

		<tr valign="top">
        <tr>
            <th scope="row"><label for="blogname">Main Settings</label></th>
            <td>
                <p style="<?php if(get_option('kal_enabled') != '1') { ?>color:red<?php } elseif(get_option('kal_enabled') == 1) { ?>color:green<?php } ?>"><input type="checkbox" name="kal_enabled" id="enabled" value="1"<?php if(get_option('kal_enabled') == '1') { echo " checked='checked';"; } ?>><label for="enabled">Enable Amazon Keywords to Links</label></p>
                <br /><p><b>Amazon Affiliate Tag ID</b></p>
                <p><input type="text" name="kal_amazon_affiliate_tag_id" value="<?=get_option('kal_amazon_affiliate_tag_id')?>" size=30></p>

                <p>Display in: <input type="checkbox" id="posts" name="kal_on_post" value="1"<?php if(get_option('kal_on_post') == 1 || (!get_option('kal_on_post') && !get_option('kal_on_post'))) { echo " checked='checked';"; } ?>><label for="posts">posts</label>
                    <input type="checkbox" name="kal_on_page" id="pages" value="1"<?php if(get_option('kal_on_page') == '1') { echo " checked='checked';"; } ?>><label for="pages">pages</label></p>
                <br /><p>Maximum replacements per post/page</p>
                <input type="text" name="kal_max_replacements" value="<?=get_option('kal_max_replacements')?>" size=10 placeholder="5" />
                <br /><p>Excluded post/page ID's (separated by commas)</p>
                <input type="text" name="kal_exclude_ids" value="<?=get_option('kal_exclude_ids')?>" size=60 />
            </td>
        </tr>
		<tr>
			<th></th>
			<td><p><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p></td>
		</tr>

	</table>
	</form>
</div>