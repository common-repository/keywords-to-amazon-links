<?php
global $wpdb;
?>
<style>
    .well {
        min-height: 20px;
        padding: 10px;
        margin-bottom: 10px;
        background-color: #f5f5f5;
        border: 1px solid #e3e3e3;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
    }
    .alert {
        padding: 10px 35px 10px 15px;
        margin-bottom: 20px;
        color: #c09853;
        background-color: #fcf8e3;
        border: 1px solid #fbeed5;
        border-radius: 4px;
        font-size:13px;
    }
    .alert-danger {
        color: #b94a48;
        background-color: #f2dede;
        border-color: #eed3d7;
    }
    .alert-success {
        color: #468847;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }
</style>
<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   PluginName
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2013 Your Name or Company Name
 */
?>
<div class="wrap">

    <?php screen_icon('plugins'); ?>
    <h2><?=($c->page_title ? $c->page_title : esc_html(get_admin_page_title()))?><?php if($_GET['page'] == 'kal') { ?> <a href="?page=<?=$_GET['page']?>&sub=<?=$_GET['sub']?>&sub2=create" class="add-new-h2">Add New</a><?php } ?></h2>


    <?php if($c->message) { ?>
    <div class="<?php echo $c->message_type; ?> below-h2">
        <p><strong><?php echo strtoupper($c->message_type); ?></strong>: <?php echo $c->message; ?></p>	</div>
    <?php } ?>

    <?=$content?>

    <p><a href="http://www.savingadvice.com/tools/wordpress/">More Plugins</a> from <a href="http://www.savingadvice.com">SavingAdvice.com</a></p>

</div>