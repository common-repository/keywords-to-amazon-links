<?php global $wpdb; //print("<pre>"); print_r($_POST); ?>
<script>
    jQuery(function () {
        jQuery('.remove_existing_question').on('click', function () {
        });
    });
</script>
<style>
    .remove {
        cursor: pointer;
    }
</style>
<form method="post" id="edit_add_form">
    <div id="poststuff">

        <div id="post-body" class="metabox-holder columns-2">

            <div id="post-body-content">
                <div id="namediv" class="stuffbox">
                    <h3><label for="title"><?php if($_GET['sub2'] == 'create') { echo "Create"; } else { echo "Update"; } ?> Keyword to Amazon Affiliate Link</label></h3>
                    <div class="inside">
                        <table class="form-table editcomment">
                            <tbody>
                            <tr>
                                <td class="first"><label for="keyword">Keyword: *</label></td>
                                <td><input type="text" name="keyword" value="<?=htmlentities(stripslashes($keyword_model->keyword))?>" id="keyword"></td>
                            </tr>
                            <tr>
                                <td class="first"><label for="url">URL:</label></td>
                                <td><input type="text" name="url" value="<?=htmlentities(stripslashes($keyword_model->url))?>" id="url" placeholder="Optional (You can leave this blank, and we'll link to the Amazon search page for your keywords above)"></td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>
            </div>

            <div id="postbox-container-1" class="postbox-container">
                <div id="submitdiv" class="stuffbox">
                    <h3><span class="hndle">Action</span></h3>
                    <div class="inside">
                        <div class="submitbox" id="submitcomment">
                            <div id="major-publishing-actions">
                                <?php if($_GET['sub2'] == 'edit') { ?>
                                    <div id="delete-action">
                                        <a class="submitdelete deletion" href="?page=kal&sub=main&sub2=delete&id=<?=$_GET['id']?>">Move to Trash</a>
                                    </div>
                                <?php } ?>
                                <div id="publishing-action">
                                    <input type="submit" name="save" id="save" class="button button-primary" value="<?php if($_GET['sub2'] == 'create') { echo "Create"; } else { echo "Update"; } ?>"></div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div><!-- /submitdiv -->
            </div>

            <br style="clear:both" />

        </div>
    </div>
</form>