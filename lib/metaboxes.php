<?php

/*
Plugin Name: EIG Plugin
*/


// create custom plugin settings menu
add_action('admin_menu', 'eig_create_menu');

function eig_create_menu() {
  //create new top-level menu
	add_menu_page('EIG Plugin Settings', 'EIG Settings', 'administrator', __FILE__, 'eig_settings_page',plugins_url('/images/icon.png', __FILE__));

	//call register settings function
	add_action( 'admin_init', 'register_eig_settings' );
}

function register_eig_settings() {
	register_setting( 'eig-settings-group', 'class_for_content' );
	register_setting( 'eig-settings-group', 'how_many_per' );
	register_setting( 'eig-settings-group', 'begin_load' );
}

function eig_settings_page() {
?>

<div class="wrap">
<h2>Enhanced Image Gallery Settings</h2>
<hr />
<p>Unless you have a problem or an overpowering desire to play, you can leave these settings as they are.</p>

<form method="post" action="options.php">
    <?php settings_fields( 'eig-settings-group' ); ?>
    <?php
		$class= get_option('class_for_content');
		$class=( !empty($class) ? $class : 'content');
		$howmany= get_option('how_many_per');
		$howmany=( !empty($howmany) ? $howmany : '10');
		$begin= get_option('begin_load');
		$begin=( !empty($begin) ? $begin : '20');
		?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><strong>Class for Content</strong></th>
        <td><input type="text" name="class_for_content" value="<?php echo $class ?>" /></td>
        <td>This is the class or id for your content block. If you aren't sure, or are using a standard theme, just leave it as is.</td>
		</tr>
        
        <tr valign="top">
        <td scope="row"><strong>Load Next</strong></td>
        <td><input type="text" name="begin_load" value="<?php echo $begin ?>" size=3 />%</td>
        <td>Begin loading the next content when scrollbar is this far from the bottom of the page. For best results, leave this alone unless your wait times are too long.</td>
		</tr>
         
        <tr valign="top">
        <td scope="row"><strong>How Many to Load</strong></td>
        <td><input type="text" name="how_many_per" value="<?php echo $howmany ?>" size="3"></td>
        <td>How many items do you want loaded at a time? For longer posts, you might want to load only 5 at a time, for short items, you might increase this.</td>
		</tr>

    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php } ?>
