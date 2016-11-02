<?php
 
    include_once "mailer.php";
    td_delete_expired_listings();
 
    mail_for_scheduler_fb(">>>fb download started>>>>>>>>>>>>>>>");


    include_once( ETKINIX_PLUGIN_PATH . 'fb_event_download_core.php' );
    $pages =
array("jollyjokeristanbul","BabylonBomonti","BronxPiSahne","garajistanbul","Kadikoysahne","dorockxl","ZorluPerformansSanatlariMerkezi","CemalResitRey","borusansanat","AkbankSanat","TheMekanTaksim","beyrutperformance","360istanbul","45likistanbul","anjeliqueclub","arsenlupenteras","beatistanbul","Bibucuk","bkmmutfaksahne","B1Live");        /*array("jollyjokeristanbul","BabylonBomonti","BronxPiSahne","garajistanbul","Kadikoysahne","dorockxl","ZorluPerformansSanatlariMerkezi","CemalResitRey","borusansanat","AkbankSanat","TheMekanTaksim","beyrutperformance","360istanbul","45likistanbul","anjeliqueclub","arsenlupenteras","beatistanbul","Bibucuk","bkmmutfaksahne","B1Live","bkmonline","coopbar","CueIstanbul","Curcuna","Dorock.Bar","depotaksim","eskibeyrut","fedorabistro","GizliBahceIstanbul","hayalkahvesibeyoglu","HodjaPasha","saloniksv","indigo.istanbul","issanat","istanbulcongresscenter","JurnalPub","Jokerno19","kiki.istanbul","kasettemusikk","klosteristanbul","KucukBeyogluGroup","kucukciftlikpark","kikiortakoy","LifeParkistanbul","istanbullutfikirdar.icec","MachineClub","MamaShelterIstanbul","masklivemusic","menthamentha","minimuzikhol","vernonbeyoglu","beyoglumuaf","murekkepp","nayahistanbul","oldcitycomedyclub","Hasbihal.com.tr","congresiumankara","passagepubankara","AnkaraMeydanSahnesi","191418711043875","jollyjokerankara","674881972554572","campuskulturmerkezi","TelwePH","KirikPlakRestoran","roxannepubankara","ClubQuaestor","Twisterbestekar","Hayyamisarap","eskiyeni.bar.ankara","ankaranefes","HayalKahvesi.Ank","manhattanbarankara","clubfiestaankara","LivaneBarAnkara","kiteankara","bomontiankara","NoxusBar","backhousepub","dubhlinnirish","KafkaBarBistro","sakarya312arena","3erestaurant","SEYYAH.SAHNESI","BiberAlternatifCafePub","magazinliveankara","City.Lounge.Bestekar","acmecafebar","roomclubankara","182214305158918","altiustubar","noisecafebar","bigbossankara","1441077866154788","nhkm.izmir","containerhall","trenbarizmir","official.neva","SummerfestCruise","BiosBarTR","izmiroozevenue","izmircimkonserleri","247041263687","Sohoplusofficial","enveloofficial","soyerJBS","sherwoodizmir","bahcecafebar","EzgiTurkuCafeIzmir","GullumCafeBar","lapsusizmir","izmirarenabayrakli","hiltonizmir","solfejorganizasyonizmir","KafePiBeachClub","DorockBahceTeras","peyotenevizade","2012Performance","seksekbar","barikat1538","drunkenduckizmir","AhbapBar","222ParkONEnight","222park","weskisehir","spr.pub.esk","sesseskisehir","BudaClubEskisehir","peyote.eskisehir","KafePiEskisehirBomonti","hayalkahvesiadana","AdanaOra","LemanKulturAdana01","lanoche01","KahvezenAdana","654000464722030","miraakustiksahnesi","cazara.food.music","MackaLoungeClub","PaddysAdana","1537469769912875","704578259559200","179735742113389","sahneadana","hollywoodcafebarkaraoke","borsa.lounge","onesaavm");*/
    $categories = array("Konser");
    for($i=0;$i<sizeof($pages);$i++){
       array_push($categories, "Konser");
    }
    
    get_events($pages, $categories);

    $errorOutput = "";

    mail_for_scheduler_fb("END OF 1>>".$errorOutput);

    include_once( THEME_DOCUMENT_ROOT . '/inc/td-delete-expired-listings.php' );
    td_delete_expired_listings();

?>
