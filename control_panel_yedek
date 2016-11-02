<?php 
    etkinix_posts_options();
    // Define new menu page content
    function etkinix_posts_options() {
        if (!current_user_can('manage_options'))  {
            wp_die( __('You do not have sufficient permissions to access this page.') );
        } else { 

            ?>

        <!-- Output for Plugin Options Page -->
        <div class="wrap">
            <?php  if(isset($_GET['add_bundle']))if ($_GET["add_bundle"] == true){ ?>
                <div class="updated below-h2" id="message">
                    <p>Example Post Bundle Added!</p>
                </div>
            <?php } elseif ($_GET["remove_all"] == true){;?>
                <div class="updated below-h2" id="message">
                    <p>All Example Posts Removed!</p>
                </div>
            <?php }; // endif ?> 
            <?php  if(isset($_GET['publish_post']))if ($_GET["publish_post"] == true) if ($_GET["publish_post"] == true)
                if(isset($_GET['post_id']))if(isset($_GET['post_title'])){ ?>
            <div class="updated below-h2" id="message">
                    <p>Event Posted: <?php echo $_GET['post_title']; ?></p>
                </div>
            <?php };?>
            <h2 id="">Events here:</h2>
            <?php 
                    // Publish Posts -------------------------
        if(isset($_GET['publish_post']))
        {
            if ($_GET["publish_post"] == true){
                if(isset($_GET['post_id'])){
            $postToUpdate = array( 'ID' => $_GET['post_id'], 'post_status' => 'publish' );
            wp_update_post($postToUpdate);  
                }
        };
        }
            printDraftPosts();
            ?>
            <p>Add the events to DB</p>
            <a href="?page=etkinix-fb&amp;add_bundle=true" class="button">Add Bundle of Sample Posts</a>

            <h3 id="">Remove All Posts</h3>
            <p>Remove the added events.</p>
            <a href="?page=etkinix-fb&amp;remove_all=true" class="button">Remove All Sample Posts</a>
        </div>
        <!-- End Output for Plugin Options Page -->

    <?php 

        // Add Posts -------------------------
        if(isset($_GET['add_bundle']))
        {
            if ($_GET["add_bundle"] == true){
                global $wpdb;
                // Get content for all posts and pages, then insert posts
                include 'content.php';
                foreach ($add_posts_array as $post){
                     insertEvent($post);
                };
               
        };
        }
        // ---------------------------------------

        //  Remove Posts -------------------------
        if(isset($_GET['remove_all']))
        if ($_GET["remove_all"] == true){
            // Get content for all posts and pages, then remove them
            include 'content.php';
            foreach($remove_posts_array as $array){
                $page_name = $array["post_title"];
                global $wpdb;
                $page_name_id = $wpdb->get_results("SELECT ID FROM " . $wpdb->base_prefix . "posts WHERE post_title = '". $page_name ."'");
                  foreach($page_name_id as $page_name_id){
	        	$page_name_id = $page_name_id->ID;
	        	wp_delete_post( $page_name_id, true );
	        };
            };
        };
        // ---------------------------------------
    }};


function insertEvent($post_information) {

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
			$event_start_date_number = strtotime($date);
			update_post_meta($post_id, 'event_start_date_number', $event_start_date_number);
    
    		update_post_meta($post_id, 'fb_page_id',  $post_information ['fb_page_id']);

			/*
            // Featured image
			$attach_id = sanitize_text_field($_POST['avatar-image-id']);
			update_post_meta($post_id, '_thumbnail_id', $attach_id);
            
            $terms_cat = sanitize_text_field($_POST['listingFormCat']);
			wp_set_post_terms( $post_id, $terms_cat, "event_cat", $append );

			$terms_loc = sanitize_text_field($_POST['listingFormLoc']);
			wp_set_post_terms( $post_id, $terms_loc, "event_loc", $append );

			// Location
			$event_location = sanitize_text_field($_POST['locationName']);
			update_post_meta($post_id, 'event_location', $event_location);

			// Address
			$event_address_country = sanitize_text_field($_POST['listingFormCountry']);
			update_post_meta($post_id, 'event_address_country', $event_address_country);

			$event_address_state = sanitize_text_field($_POST['listingFormState']);
			update_post_meta($post_id, 'event_address_state', $event_address_state);

			$event_address_city = sanitize_text_field($_POST['listingFormCity']);
			update_post_meta($post_id, 'event_address_city', $event_address_city);

			$event_address_address = sanitize_text_field($_POST['listingFormAddress']);
			update_post_meta($post_id, 'event_address_address', $event_address_address);

			$event_address_zip = sanitize_text_field($_POST['listingFormZipCode']);
			update_post_meta($post_id, 'event_address_zip', $event_address_zip);

			$event_phone = sanitize_text_field($_POST['listingFormPhone']);
			update_post_meta($post_id, 'event_phone', $event_phone);

			$event_email = sanitize_text_field($_POST['listingFormEmail']);
			update_post_meta($post_id, 'event_email', $event_email);

			$event_website = sanitize_text_field($_POST['listingFormWebsite']);
			update_post_meta($post_id, 'event_website', $event_website);

			$event_address_latitude = sanitize_text_field($_POST['item_address_latitude']);
			update_post_meta($post_id, 'event_address_latitude', $event_address_latitude);

			$event_address_longitude = sanitize_text_field($_POST['item_address_longitude']);
			update_post_meta($post_id, 'event_address_longitude', $event_address_longitude);

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
function printDraftPosts(){
          global $wpdb;
           $draftPosts = $wpdb->get_results("SELECT * FROM " . $wpdb->base_prefix . "posts WHERE post_status = 'draft' AND post_type='event'");
     foreach ($draftPosts as $post){
         ?>
    <div id=<?php echo $post->ID;?> >
   <?php echo $post->post_title." ";
 echo $post->ID?>
 <a href="?page=etkinix-fb&amp;publish_post=true&amp;post_id=<?php echo $post->ID; ?>&amp;post_title=<?php echo $post->post_title; ?>" class="button">publish</a>
        </div>
<?php
         echo "<br>";
                };
}

?>