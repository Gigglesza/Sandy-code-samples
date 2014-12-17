<?php
global $wpscf_token;
class sexycontactform_widget extends WP_Widget {

  // Constructor //
  function sexycontactform_widget() {
    $widget_ops = array(
      'classname' => 'sexycontactform_widget',
      'description' => 'Add Sexy Contact Form widget.'
    ); // Widget Settings
    $control_ops = array('id_base' => 'sexycontactform_widget'); // Widget Control Settings
    $this->WP_Widget('sexycontactform_widget', 'Sexy Contact Form', $widget_ops, $control_ops); // Create the widget
  }

  // Extract Args
  function widget($args, $instance) {
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);
    // Before widget
    echo $before_widget;
    // Title of widget
    if ($title) {
      echo $before_title . $title . $after_title;
    }
    // the widget content
    global $wpscf_token;
    if($wpscf_token == '') {
	    $wpscf_token = md5(time() * rand(1000,9999));
		$_SESSION['sexycontactform_token'] = $wpscf_token;
    }
	
    wpscf_enqueue_front_scripts($instance['form_id']);
    echo $sexy_rendered_content = wpscf_render_form($instance['form_id']);
    
    
    // After widget
    echo $after_widget;
  }

  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['title'] = $new_instance['title'];
    $instance['form_id'] = $new_instance['form_id'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    $defaults = array(
      'title' => '',
      'form_id' => 0
    );
    $instance = wp_parse_args((array)$instance, $defaults);
    global $wpdb; ?>
  <p>
    <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
           name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>"/>
    <label for="<?php echo $this->get_field_id('form_id'); ?>">Select a form:</label>
    <select name="<?php echo $this->get_field_name('form_id'); ?>'" id="<?php echo $this->get_field_id('form_id'); ?>"
            style="width:225px;text-align:center;">
      <option style="text-align:center" value="0">- Select a Form -</option>
      <?php
      $ids_sexycontactform = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "sexy_forms order by `id` DESC", 0);
      foreach ($ids_sexycontactform as $arr_sexycontactform) {
        ?>
        <option value="<?php echo $arr_sexycontactform->id; ?>" <?php if ($arr_sexycontactform->id == $instance['form_id']) {
          echo "SELECTED";
        } ?>><?php echo $arr_sexycontactform->name; ?></option>
        <?php }?>
    </select>
  <?php
  }
}

add_action('widgets_init', create_function('', 'return register_widget("sexycontactform_widget");'));
?>