<!-- Output for Plugin Options Page -->
        <div class="wrap">
              <?php  
            include "mailer.php";
            if(isset($_GET['scan_pages']))if ($_GET["scan_pages"] == true){ 
            mail_for_scheduler_fb("Manually scan pages successfull ");
            ?>
                <div class="updated below-h2" id="message">
                    <p>scan process completed!</p>
                </div>
            <?php 

            require_once( ETKINIX_PLUGIN_PATH . 'fb_event_download.php' );
    
           
            }?>
           

            <h1>Please insert facebook pages:</h1>
            <form id="startScan" action="?page=etkinix-fb&amp;scan_pages=true" method="post">
                
            <input type="text" name="pages[]" value="jollyjokeristanbul">
                <?php show_category(); ?>
            <br>    
            <input type="text" name="pages[]" value="BabylonBomonti">
                <?php show_category(); ?>
            <br>
            <input type="text" name="pages[]" value="BronxPiSahne">
                <?php show_category(); ?>
            <br>  
            <input type="text" name="pages[]" value="garajistanbul">
                <?php show_category(); ?>
            <br>  
            <input type="text" name="pages[]" value="Kadikoysahne">
                  <?php show_category(); ?>
            <br>
            <input type="text" name="pages[]" value="dorockxl">
                  <?php show_category(); ?>
            <br>
            <input type="text" name="pages[]" value="ZorluPerformansSanatlariMerkezi">
                  <?php show_category(); ?>
            <br> 
            <input type="text" name="pages[]" value="CemalResitRey">
                <?php show_category(); ?>
            <br>    
            <input type="text" name="pages[]" value="borusansanat">
                  <?php show_category(); ?>
            <br>
            <input type="text" name="pages[]" value="AkbankSanat">
                  <?php show_category(); ?>
            <br>
            <input type="text" name="pages[]" value="TheMekanTaksim">
                <?php show_category(); ?>
            <br> 
            <input type="text" name="pages[]" value="beyrutperformance">
                  <?php show_category(); ?>
            <br>
       
           
         
            <input type="submit" name="Scan Pages" value="Submit" />
            </form>     
            <a href="?page=etkinix-fb&amp;delete_past_events=true" class="button">Delete past events</a>
            <a href="?page=etkinix-fb&amp;delete_all_events=true" class="button">Delete all events</a></br>
            <a href="?page=etkinix-fb&amp;start_schedule_job=true" class="button">Start Schedule job</a></br>
<a href="?page=etkinix-fb&amp;start_schedule_job_2=true" class="button">Start Schedule job2</a></br>
<a href="?page=etkinix-fb&amp;start_schedule_job_3=true" class="button">Start Schedule job3</a></br>
<a href="?page=etkinix-fb&amp;start_schedule_job_4=true" class="button">Start Schedule job4</a></br>
<a href="?page=etkinix-fb&amp;start_schedule_job_5=true" class="button">Start Schedule job5</a></br>
<a href="?page=etkinix-fb&amp;start_schedule_job_6=true" class="button">Start Schedule job6</a></br>
<a href="?page=etkinix-fb&amp;start_schedule_job_7=true" class="button">Start Schedule job7</a></br>
<a href="?page=etkinix-fb&amp;start_schedule_job_8=true" class="button">Start Schedule job8</a></br>
            </div>

<?php 
if(isset($_GET['delete_past_events']))if ($_GET["delete_past_events"] == true){
    /*
    |--------------------------------------------------------------------------
    | Delete Expired Listings
    |--------------------------------------------------------------------------
    */
    echo "delete past events occured started!</br>";
    include_once( THEME_DOCUMENT_ROOT . '/inc/td-delete-expired-listings.php' );
    td_delete_expired_listings();
    echo "delete past events occured ended!</br>";
}
if(isset($_GET['delete_all_events']))if ($_GET["delete_all_events"] == true){
    /*
    |--------------------------------------------------------------------------
    | Delete All Listings
    |--------------------------------------------------------------------------
    */
    echo "delete all events occured started!</br>";
    include_once( THEME_DOCUMENT_ROOT . '/inc/td-delete-expired-listings.php' );
    td_delete_all_listings();
    echo "delete all events occured ended!</br>";
}
if(isset($_GET['start_schedule_job']))if ($_GET["start_schedule_job"] == true){
    /*
    |--------------------------------------------------------------------------
    | Start Schedule Job
    |--------------------------------------------------------------------------
    */
    echo "schedule job started!</br>";
    //include_once( 'fb_schedule_job.php' );
    //exec("fb_schedule_job.php >/dev/null 2>&1 &");
    require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job.php' );
    //echo "schedule jobs ended!</br>";
}
if(isset($_GET['start_schedule_job_2']))if ($_GET["start_schedule_job_2"] == true){
       echo "schedule job started!</br>";
       require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job_2.php' );
}
if(isset($_GET['start_schedule_job_3']))if ($_GET["start_schedule_job_3"] == true){
       echo "schedule job started!</br>";
       require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job_3.php' );
}
if(isset($_GET['start_schedule_job_4']))if ($_GET["start_schedule_job_4"] == true){
       echo "schedule job started!</br>";
       require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job_4.php' );
}
if(isset($_GET['start_schedule_job_5']))if ($_GET["start_schedule_job_5"] == true){
       echo "schedule job started!</br>";
       require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job_5.php' );
}
if(isset($_GET['start_schedule_job_6']))if ($_GET["start_schedule_job_6"] == true){
       echo "schedule job started!</br>";
       require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job_6.php' );
}
if(isset($_GET['start_schedule_job_7']))if ($_GET["start_schedule_job_7"] == true){
       echo "schedule job started!</br>";
       require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job_7.php' );
}
if(isset($_GET['start_schedule_job_8']))if ($_GET["start_schedule_job_8"] == true){
       echo "schedule job started!</br>";
       require_once( ETKINIX_PLUGIN_PATH . 'fb_schedule_job_8.php' );
}
function show_category(){
    ?>

									<select name="category[]">

										<option value="<?php _e( "Konser", "themesdojo" ); ?>">
										    
										<?php _e( "Konser", "themesdojo" ); ?>
										    
										</option>

										<?php

											$categories = get_categories( array('taxonomy' => 'event_cat', 'hide_empty' => false,  'parent' => 0) );

											foreach ($categories as $category) {
												$option = '<option value="'.$category->slug.'">';
												$option .= $category->cat_name;
												$option .= '</option>';

												$catID = $category->term_id;

												$categories_child = get_categories( array('taxonomy' => 'event_cat', 'hide_empty' => false,  'parent' => $catID) );

												foreach ($categories_child as $category_child) {
													$option .= '<option value="'.$category_child->slug.'"> - ';
													$option .= $category_child->cat_name;
													$option .= '</option>';

												}

												echo $option;
											}

										?>

									</select>

<?php }


?>