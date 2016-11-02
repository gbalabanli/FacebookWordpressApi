<?php
 
    include_once "mailer.php";
    td_delete_expired_listings();
 
    mail_for_scheduler_fb(">>>fb download started>>>>>>>>>>>>>>>");


    include_once( ETKINIX_PLUGIN_PATH . 'fb_event_download_core.php' );
    $pages = array("KafkaBarBistro","sakarya312arena","3erestaurant","SEYYAH.SAHNESI","BiberAlternatifCafePub","magazinliveankara","City.Lounge.Bestekar","acmecafebar","roomclubankara","182214305158918","altiustubar","noisecafebar","bigbossankara","1441077866154788","nhkm.izmir","containerhall","trenbarizmir","official.neva","SummerfestCruise");
    $categories = array("Konser");
    for($i=0;$i<sizeof($pages);$i++){
       array_push($categories, "Konser");
    }
    
    get_events($pages, $categories);

    $errorOutput = "";

    mail_for_scheduler_fb("END OF 5>>".$errorOutput);

    include_once( THEME_DOCUMENT_ROOT . '/inc/td-delete-expired-listings.php' );
    td_delete_expired_listings();

?>
