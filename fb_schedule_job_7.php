<?php
 
    include_once "mailer.php";
    td_delete_expired_listings();
 
    mail_for_scheduler_fb(">>>fb download started>>>>>>>>>>>>>>>");


    include_once( ETKINIX_PLUGIN_PATH . 'fb_event_download_core.php' );
    $pages = array("barikat1538","drunkenduckizmir","AhbapBar","222ParkONEnight","222park","weskisehir","spr.pub.esk","sesseskisehir","BudaClubEskisehir","peyote.eskisehir","KafePiEskisehirBomonti","hayalkahvesiadana","AdanaOra","LemanKulturAdana01","lanoche01","KahvezenAdana","654000464722030","miraakustiksahnesi","cazara.food.music","MackaLoungeClub");
    $categories = array("Konser");
    for($i=0;$i<sizeof($pages);$i++){
       array_push($categories, "Konser");
    }
    
    get_events($pages, $categories);

    $errorOutput = "";

    mail_for_scheduler_fb("END OF 7>>".$errorOutput);

    include_once( THEME_DOCUMENT_ROOT . '/inc/td-delete-expired-listings.php' );
    td_delete_expired_listings();

?>
