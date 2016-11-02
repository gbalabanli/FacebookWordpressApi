<?php
 include "remote_services.php";
function insertEvent($post_information) {
    if(is_event_inserted($post_information ['fb_event_id'])){
        echo "\n this event is not inserted because it is alread at DB\n";
        echo '<br>';
        return false;
    }
    $originalContent  = $post_information['post_content'];
    $originalContent = str_replace('http://','link:', $originalContent);
    $post_information['post_content'] = $originalContent;
    
    $post_id = wp_insert_post($post_information);

    //$postStatus = sanitize_text_field($_POST['postStatus']);

    if(current_user_can('administrator')) {
            // admin right can be given
    }

    $append = false;

    // Details
    update_post_meta($post_id, 'event_start_date', $post_information ['event_start_date']);

    update_post_meta($post_id, 'event_start_time',  $post_information ['event_start_time']);

    $date = "".$post_information ['event_start_date']." ". $post_information ['event_start_time']."";
    if($post_information ['fb_timezone'])
        date_default_timezone_set($post_information ['fb_timezone']);
    $event_start_date_number = strtotime($date);
    update_post_meta($post_id, 'event_start_date_number', $event_start_date_number);

    //event category
    $terms_cat = sanitize_text_field( $post_information['event_cat']);
    wp_set_object_terms( $post_id, $terms_cat, "event_cat", $append );

    //mekan ismi
    update_post_meta($post_id, 'event_location', $post_information['event_location']);

    // Address
    update_post_meta($post_id, 'event_address_country', $post_information['event_address_country']);

    update_post_meta($post_id, 'event_address_city', $post_information['event_address_city']);

    update_post_meta($post_id, 'event_address_address', $post_information['event_address_address']);

    update_post_meta($post_id, 'event_address_latitude', $post_information['event_address_latitude']);

    update_post_meta($post_id, 'event_address_longitude',               $post_information['event_address_longitude']);

    update_post_meta($post_id, 'event_website',  $post_information ['fb_ticket_uri']);

    update_post_meta($post_id, 'fb_event_id',  $post_information ['fb_event_id']);

    update_post_meta($post_id, 'fb_page_id',  $post_information ['fb_page_id']);

    update_post_meta($post_id, 'fb_image_link',  $post_information ['fb_image_link']);

    update_post_meta($post_id, 'fb_timezone',  $post_information ['fb_timezone']);

    update_post_meta($post_id, 'fb_end_time',  $post_information ['fb_end_time']);

    //TERM location city google mapsten alinacak ve locationa insert edilecek simdi bos olacak

    update_post_meta($post_id, 'fb_end_time',  $post_information ['fb_end_time']);
    
    //to get language
    //$lang = detect_language($post_information['post_content']);
    //update_post_meta($post_id, 'desc_language', $lang);
    
        //to get language
    if(isset($post_information['event_address_latitude']) && isset($post_information['event_address_longitude'])){
          $city = get_city_google($post_information['event_address_latitude'],$post_information['event_address_longitude']);
    update_post_meta($post_id, 'event_address_city', $city);  
    }

    

    //-----tage girilecekler-----
    
    $event_tags = "";
    //mekan ismi //facebook location
    $event_tag1="";
    $event_tag1 = $post_information ['event_location'];
    insert_tag($post_id, $event_tag1);
    
    $event_tag2="";
    $event_tag2 = $post_information ['fb_category'];
    insert_tag($post_id, $event_tag2);
    
    $event_tag3="";
    $event_tag3 = $post_information ['event_address_city'];
    insert_tag($post_id, $event_tag3);
    
    $event_tag4="";
    $event_tag4 = $post_information ['event_cat'];
    insert_tag($post_id, $event_tag4);
    
    if(isset($city) && strcmp($post_information ['event_address_city'], $city) ){
        $event_tag5="";
        $event_tag5 = $city;
        insert_tag($post_id, $event_tag5);
    }
     echo "city_google:". $city."\n";
    echo "city_event:". $post_information ['event_address_city']."\n";
    
    /*
    // Featured image
    $attach_id = sanitize_text_field($_POST['avatar-image-id']);
    update_post_meta($post_id, '_thumbnail_id', $attach_id);

    //location city google mapsten alinacak ve locationa insert edilecek simdi bos olacak
    $terms_loc = sanitize_text_field($_POST['listingFormLoc']);
    wp_set_post_terms( $post_id, $terms_loc, "event_loc", $append );

    $event_address_state = sanitize_text_field($_POST['listingFormState']);
    update_post_meta($post_id, 'event_address_state', $event_address_state);

    $event_address_zip = sanitize_text_field($_POST['listingFormZipCode']);
    update_post_meta($post_id, 'event_address_zip', $event_address_zip);

    $event_phone = sanitize_text_field($_POST['listingFormPhone']);
    update_post_meta($post_id, 'event_phone', $event_phone);

    $event_email = sanitize_text_field($_POST['listingFormEmail']);
    update_post_meta($post_id, 'event_email', $event_email);

    if(isset($_POST['item_address_streetview'])) {
        $event_address_streetview = sanitize_text_field($_POST['item_address_streetview']);
        update_post_meta($post_id, 'event_address_streetview', $event_address_streetview);
    };

    $event_googleaddress = sanitize_text_field($_POST['item_googleaddress']);
    update_post_meta($post_id, 'event_googleaddress', $event_googleaddress);

    // Amenities
    $event_amenities = sanitize_text_field($_POST['item_amenities']);
    wp_set_post_terms($post_id, $event_amenities, 'event_tag' );*/

    //=========================================
    echo 'success insert<br>';
  	//die(); // this is required to return a proper result
}

function insert_tag($post_id,$event_tag_value){
    if(isset($event_tag_value)){ 
        $event_tag = ltrim($event_tag_value, ',');
        wp_set_object_terms($post_id, $event_tag_value, 'event_tag',true ); 
    }
}

function is_event_inserted($event_id){
    //DEBUG POINT
    /*echo "\n==================================";
    echo "\ncheck id:", $event_id;*/
    $posts = get_posts(array(
	'numberposts'	=> -1,
	'post_type'		=> 'event',
	'meta_key'		=> 'fb_event_id',
    'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'),
	'meta_value'	=> $event_id
    ));
    if(count($posts)>0){
        //echo "\npost var!!!";
        return true;
    }
    else{
        //echo "\npost yok!!!";
        return false;
    }
    //DEBUG POINT
    /*foreach ( $posts as $post ) {
        echo "\n post var:", $post->ID;
        echo "\n fb_event_id:",  get_post_meta( $post->ID, 'fb_event_id', true );
        echo "\n-";
    }*/
}
?>