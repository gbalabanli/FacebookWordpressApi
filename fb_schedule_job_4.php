<?php
 
    include_once "mailer.php";
    td_delete_expired_listings();
 
    mail_for_scheduler_fb(">>>fb download started>>>>>>>>>>>>>>>");


    include_once( ETKINIX_PLUGIN_PATH . 'fb_event_download_core.php' );
    $pages = array("jollyjokerankara","674881972554572","campuskulturmerkezi","TelwePH","KirikPlakRestoran","roxannepubankara","ClubQuaestor","Twisterbestekar","Hayyamisarap","eskiyeni.bar.ankara","ankaranefes","HayalKahvesi.Ank","manhattanbarankara","clubfiestaankara","LivaneBarAnkara","kiteankara","bomontiankara","NoxusBar","backhousepub","dubhlinnirish");
    $categories = array("Konser");
    for($i=0;$i<sizeof($pages);$i++){
       array_push($categories, "Konser");
    }
    
    get_events($pages, $categories);

    $errorOutput = "";

    mail_for_scheduler_fb("END OF 4>>".$errorOutput);

    include_once( THEME_DOCUMENT_ROOT . '/inc/td-delete-expired-listings.php' );
    td_delete_expired_listings();

?>
