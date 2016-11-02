<?php
 
    include_once "mailer.php";
    td_delete_expired_listings();
 
    mail_for_scheduler_fb(">>>fb download started>>>>>>>>>>>>>>>");


    include_once( ETKINIX_PLUGIN_PATH . 'fb_event_download_core.php' );
    $pages = array("BiosBarTR","izmiroozevenue","izmircimkonserleri","247041263687","Sohoplusofficial","enveloofficial","soyerJBS","sherwoodizmir","bahcecafebar","EzgiTurkuCafeIzmir","GullumCafeBar","lapsusizmir","izmirarenabayrakli","hiltonizmir","solfejorganizasyonizmir","KafePiBeachClub","DorockBahceTeras","peyotenevizade","2012Performance","seksekbar");
    $categories = array("Konser");
    for($i=0;$i<sizeof($pages);$i++){
       array_push($categories, "Konser");
    }
    
    get_events($pages, $categories);

    $errorOutput = "";

    mail_for_scheduler_fb("END OF 6>>".$errorOutput);

    include_once( THEME_DOCUMENT_ROOT . '/inc/td-delete-expired-listings.php' );
    td_delete_expired_listings();

?>
