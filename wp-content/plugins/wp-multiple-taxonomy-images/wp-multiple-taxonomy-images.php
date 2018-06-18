<?php
/**
 * Plugin Name: WP Multiple Taxonomy Images
 * Plugin URI: www.cruso.ch
 * Description: This plugin allows to add multiple images to a taxonomy. 
 * Author: Otto Bibartiu 
 * Version: 0.3
 * Author URI: www.cruso.ch
 * Domain Path: /languages
 * Text Domain: cvti
 */

if (!defined('CVTI_PLUGIN_URL')){
	define('CVTI_PLUGIN_URL', untrailingslashit(plugins_url('', __FILE__)));
}

define('CVTI_PLACEHOLDER', CVTI_PLUGIN_URL.'/placeholder.jpg' );

load_plugin_textdomain('cvti', FALSE, 'wp-multiple-taxonomy-images/languages');

/*
 * Setup WP Multiple Taxonomy Images
 */
class WP_Multi_Tax_Images{
    
    public function __construct() {
        add_action('admin_init', array($this,'init') );
        add_action('admin_enqueue_scripts', array($this,'add_scripts'));
        
        $my_settings_page = new WP_Multi_Tax_Images_Options();
    }
    
    /**
     *  Add image boxes to all non-exculded taxonomies.
     */
    public function init(){
        $taxonomies = get_taxonomies();
        $excluded_taxonomies = $this->get_excluded_taxonomies();
        if (is_array($taxonomies)) {
            foreach ($taxonomies as $taxonomy) {
                // Ignore exluded taxonomies
                if (in_array($taxonomy, $excluded_taxonomies)){
                        continue;
                }
                // Setup image boxes
                new WP_Multi_Tax_Images_Boxes( $taxonomy );
	    }
        }
    }
    
    public function get_excluded_taxonomies(){
        $cvti_options = get_option('cvti_options');
        if (empty($cvti_options['excluded_taxonomies'])){
                $cvti_options['excluded_taxonomies'] = array();
        }
        return $cvti_options['excluded_taxonomies'];
    }
    
    public function add_scripts( $hook ){
        if ('edit-tags.php' != $hook && 'term.php' != $hook) {
            return;
        }
        wp_enqueue_media();
        wp_enqueue_style( 'cvti_css', CVTI_PLUGIN_URL . '/style.css' );
        wp_enqueue_script( 'cvti_js', CVTI_PLUGIN_URL . '/main.js',array('jquery') );
        wp_localize_script( 'cvti_js', 'cvti_options', 
                array( "placeholder" => CVTI_PLACEHOLDER, 
                    'btn_add' => __('Upload/Add image', 'cvti') , 
                    'btn_remove' => __('Clear', 'cvti')) );
    }
}

/**
 * Image boxes
 */
class WP_Multi_Tax_Images_Boxes{
    
    function __construct( $taxonomy ) {
        add_action($taxonomy.'_add_form_fields', array($this,'add_field'));
        add_action($taxonomy.'_edit_form_fields', array($this,'edit_field'));
        add_filter( 'manage_edit-' . $taxonomy . '_columns', array($this,'columns' ));
        add_filter( 'manage_' . $taxonomy . '_custom_column', array($this,'column'), 10, 3 );
        add_action('edit_'. $taxonomy,array($this,'save_images'));
        add_action('create_'. $taxonomy,array($this,'save_images'));
        add_action('quick_edit_custom_box', array($this,'quick_edit'), 10, 3);
	add_filter("attribute_escape", array($this,"change_button_text"), 10, 2);
    }
    
    public function main_field($url, $title = '', $shape = '' , $max_width = '100px'){
        return '<div class="cvti-container"> 
                <img  class="cvti-image" src="' . $url . '"  style="max-width: ' . $max_width . '; width: auto; height: auto"/><br>    
		<input type="hidden" class="cvti_post_image" name="cvti_post_image[]" value="' .$url. '" />
                <span class="cvti-title">' . $title . '</span> - 
                <span class="cvti-shape">' . $shape . '</span><br>
		<button class="cvti_upload_button button">' . __('Upload/Add image', 'cvti') . '</button>
                <button class="cvti_remove_button button" style="display:none;">' . __('Clear', 'cvti') . '</button>
             </div>';
    }
    

    public function add_field(){
	echo '<div class="form-field cvti-form-field">'.
		$this->main_field( CVTI_PLACEHOLDER )
              .'</div>
              <div class="form-field" id="cvti_bottom">
                <button name="sbn1" class="cvti_more_button button">' . __('More Images', 'cvti') . '</button>
                <button name="sbn2" class="cvti_less_button button">' . __('Less Images', 'cvti') . '</button>
              </div>';
    }
    

    public function edit_field( $taxonomy ){
	$image_obj = new WP_Multi_Tax_Images_API( $taxonomy->term_id );
        $image_array = $image_obj->url(null);
        
        foreach ($image_array as $image_url) {
            if(empty($image_url)){
                continue;
            }
            $att_id = $image_obj->get_attachment_id_by_url($image_url);
            $img_meta = wp_get_attachment_metadata( $att_id );
            
            echo '<tr class="form-field cvti-form-field">
                    <th scope="row" valign="top"></th>
                    <td>'.$this->main_field( $image_url , get_the_title($att_id) , $img_meta[ 'width' ].' x '.$img_meta[ 'height' ]) .'</td>
                  </tr>';
        }        
        
        echo '<tr class="form-field" id="cvti_bottom"><th scope="row"></th><td>
                <button name="sbn1" class="cvti_more_tr_button button">' . __('More Images', 'cvti') . '</button>
                <button name="sbn2" class="cvti_less_button button">' . __('Less Images', 'cvti') . '</button>
              </td></tr>';
        
    }
    
    public function save_images($term_id) {
        if(isset($_POST['cvti_post_image']) && is_array($_POST['cvti_post_image'])){
            $new = array();
            foreach ($_POST['cvti_post_image'] as $value) {
                if(!empty($value)){
                    $new[] = $value;
                }
            }
            update_option('wmti_tax_image_' . $term_id, $new, NULL);
        }
    }
    
    public function quick_edit($column_name = null, $screen = null, $name =  null) {
        return; //Todo: Extend with quick edit box
    }
    
    public function change_button_text($safe_text, $text) {
        return str_replace( __("Insert into Post","cvti"), __("Use this image","cvti"), $text);
    }
    
    public function columns( $columns ) {
           $new_columns = array();
           $new_columns['cb'] = $columns['cb'];
           $new_columns['cvti-thumb'] = __('Images', 'cvti');
           unset( $columns['cb'] );
           return array_merge( $new_columns, $columns );
   }

   public function column( $columns, $column, $id ) {
        if ( $column == 'cvti-thumb' ){
            $image_obj = new WP_Multi_Tax_Images_API( $id );
            $image_array = $image_obj->url('thumbnail');
            foreach ($image_array as $image_url) {
                if(!empty($image_url)){
                    $columns .= '<span><img width="30" src="' . $image_url . '" alt="' . __('Thumbnail', 'cvti') . '" class="wp-post-image" /></span>';
                }
            }
        }            
        return $columns;
   }
}

/**
 * Admin option page
 */
class WP_Multi_Tax_Images_Options
{
    private $options;
    
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    public function add_plugin_page()
    {
        add_options_page(
            'WP Multiple Taxonomy Images Admin', 
            'WP Multiple Taxonomy Images', 
            'manage_options', 
            'wmti-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    public function create_admin_page()
    {
        $this->options = get_option( 'cvti_options' );
        ?>
        <div class="wrap">
            <h1>WP Multiple Taxonomy Images Admin</h1>
            <form method="post" action="options.php">
            <?php
                settings_fields( 'wpmti_option_group' );
                do_settings_sections( 'wmti-setting-admin' );
                submit_button();
            ?>
            </form>
            <?php 
                echo $this->donation_field();
            ?>
        </div>

        <?php
    }

    public function page_init()
    {        
        register_setting(
            'wpmti_option_group', // Option group
            'cvti_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'wpmti_setting_section_id', // ID
            __('Taxonomy Settings','cvti'), // Title
            array( $this, 'print_section_info' ), // Callback
            'wmti-setting-admin' // Page
        );  

        add_settings_field(
            'tax_id', // ID
            __('Exclude Taxonomies', 'cvti'), // Title 
            array( $this, 'input_fields_callback' ), // Callback
            'wmti-setting-admin', // Page
            'wpmti_setting_section_id' // Section           
        );      

    }

    public function sanitize( $input )
    {
        return $input;
    }

    public function print_section_info()
    {
        print __('Enter your settings below:','cvti');
    }


    public function input_fields_callback()
    {
        $disabled_taxonomies = array('nav_menu', 'link_category', 'post_format');
	foreach (get_taxonomies() as $tax) { 
            $s_tax = esc_attr($tax);
            if (in_array($tax, $disabled_taxonomies)){ 
                continue; 
            }
            printf('<input type="checkbox" name="cvti_options[excluded_taxonomies][%s]" value="%s" %s />%s<br />',
                    $s_tax, $s_tax, (isset($this->options['excluded_taxonomies'][$s_tax])? "checked='checked'" : ""), $s_tax);
	}
    }
  
    public function donation_field(){
        return  '
            <h2>Support Us</h2>
            This plugin is surely helpful. Our small team loves to drink coffee and coffee helps us to work a lot and to create new plugins, so we are happy for every donation.<br>
            <form action = "https://www.paypal.com/cgi-bin/webscr" method = "post" target = "_top">
                <input type = "hidden" name = "cmd" value = "_s-xclick">
                <input type = "hidden" name = "hosted_button_id" value = "ZPAVLC9SMUVXW">
                <input type = "image" src = "https://www.paypalobjects.com/en_US/CH/i/btn/btn_donateCC_LG.gif" border = "0" name = "submit" alt = "PayPal - The safer, easier way to pay online!">
                <img alt = "" border = "0" src = "https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width = "1" height = "1">
            </form>';
    }
}

/**
 * API to access the images of a taxonomy
 */
class WP_Multi_Tax_Images_API{
     
    private $term_id;
    private $cache;

    function __construct($term_id = NULL) {
        $this->term_id = $term_id;
        $this->cache = false;
    }
    
    public function get_attachment_id_by_url($image_src) {
        global $wpdb;
        $query = $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid = %s", $image_src);
        $id = $wpdb->get_var($query);
        return (!empty($id)) ? $id : NULL;
    }
    
    public function get_option(){
        $taxonomy_image_url_array = $this->cache;
        if(!$taxonomy_image_url_array){
            $taxonomy_image_url_array = get_option('wmti_tax_image_'.$this->term_id);
            $this->cache = $taxonomy_image_url_array;
        }
        return $taxonomy_image_url_array;
    }
    
    public function get_attr(){
        wp_get_attachment_metadata( $attachment_id, $unfiltered );
    }

    public function  url( $size = 'full') {
        $term_id = $this->term_id;
        if (!$term_id) {
            if (is_category()){
                $term_id = get_query_var('cat');
            }elseif (is_tag()){
                $term_id = get_query_var('tag_id');
            }elseif (is_tax()) {
                $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                $term_id = $current_term->term_id;
            }
        }
        
        $taxonomy_image_res = array();
        $taxonomy_image_url_array =  $this->get_option();
        if(is_array($taxonomy_image_url_array)){
            foreach ($taxonomy_image_url_array as $taxonomy_image_url) {
                if(!empty($taxonomy_image_url)) {
                    $attachment_id = $this->get_attachment_id_by_url($taxonomy_image_url);
                    if(!empty($attachment_id)) {
                        $taxonomy_image_url = wp_get_attachment_image_src($attachment_id, $size);
                        $taxonomy_image_res[] = $taxonomy_image_url[0];
                    }
                }
            }
        }
        
        return $taxonomy_image_res;
    }
    
    public function HTML( $size = 'full', $attr = false, $echo = false) {
        $term_id = $this->term_id;
	if (!$term_id) {
            if (is_category()){
                $term_id = get_query_var('cat');
            }elseif (is_tag()){
                $term_id = get_query_var('tag_id');
            }elseif (is_tax()) {
                $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                $term_id = $current_term->term_id;
            }
	}
	
        $taxonomy_image = array();
        $taxonomy_image_url_array = $this->get_option();
        if(is_array($taxonomy_image_url_array)){
            foreach ($taxonomy_image_url_array as $taxonomy_image_url) {
                if(!empty($taxonomy_image_url)) {
                    $attachment_id = $this->get_attachment_id_by_url($taxonomy_image_url);
                    if(!empty($attachment_id)){
                        $taxonomy_image[] = wp_get_attachment_image($attachment_id, $size, FALSE, $attr);
                    }else {
                        $image_attr = '';
                        if(is_array($attr)) {
                                if(!empty($attr['class']))
                                        $image_attr .= ' class="'.$attr['class'].'" ';
                                if(!empty($attr['alt']))
                                        $image_attr .= ' alt="'.$attr['alt'].'" ';
                                if(!empty($attr['width']))
                                        $image_attr .= ' width="'.$attr['width'].'" ';
                                if(!empty($attr['height']))
                                        $image_attr .= ' height="'.$attr['height'].'" ';
                                if(!empty($attr['title']))
                                        $image_attr .= ' title="'.$attr['title'].'" ';
                        }
                        $taxonomy_image[] = '<img src="'.$taxonomy_image_url.'" '.$image_attr.'/>';
                    }
                }
            }    
        }
        if ($echo){
            echo join('',$taxonomy_image);
        }else{
            return $taxonomy_image;
        }
    }
}

if(is_admin()){
    new WP_Multi_Tax_Images();
}

if(!function_exists('get_tax_image_urls')){
    /**
     * Return all image urls as array, which belong to a term.
     * 
     * @since 0.0.1
     *
     * @see get_tax_images()
     * @see get_tax_image_metadata()
     * 
     * @param int $term_id Term  ID
     * @param string $size  Optional. Default 'full'.
     * @return array If no images found, than the array is empty.
     */
    function get_tax_image_urls($term_id , $size = 'full'){
        $image_obj = new WP_Multi_Tax_Images_API( $term_id );
        return  $image_obj->url( $size );
    }
}

if(!function_exists('get_tax_images')){
    /**
     * Return all images belonging to a term as HTML tags.
     * 
     * @since 0.0.1
     *
     * @see get_tax_image_urls()
     * @see get_tax_image_metadata()
     * 
     * @param int $term_id Term  ID
     * @param string $size  Optional. Default 'full'.
     * @return string  A string of img-tags. Value is empty if no images. 
     */
    function get_tax_images( $term_id , $size = 'full'){
        $image_obj = new WP_Multi_Tax_Images_API( $term_id );
        return  $image_obj->HTML( $size );
    }
}

if(!function_exists('get_tax_image_metadata')){
    /**
     * Return meta information of all images belonging to a term.
     * 
     * Returns an array of image meta, which are associated with a term
     * identified by $term_id. Each entry of the array is the result which corresponds to the 
     * return value of wp_get_attachment_image() for each image.
     * A empty array is
     * 
     * @since 0.0.1
     *
     * @see get_tax_image_urls()
     * @see get_tax_images()
     * 
     * @param int $term_id Term  ID
     * @return array If no images found, than the array is empty.
     */
    function get_tax_image_metadata($term_id){
        $image_obj = new WP_Multi_Tax_Images_API( $term_id );
        $image_array = $image_obj->url(null);
        
        $image_meta = array();
        foreach ($image_array as $image_url) {
            if(empty($image_url)){
                continue;
            }
            $att_id = $image_obj->get_attachment_id_by_url($image_url);
            $image_meta[] = wp_get_attachment_metadata( $att_id );
        }
        return $image_meta;
    }
}