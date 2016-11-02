<?php

function detect_language($text){
    if(!$text)
        return;
    if (strlen($text) >= 175)
        $text = substr($text, 0, 174);
    $access_token = "trnsl.1.1.20151205T092913Z.f8d16064f11c58aa.4aa9cce7fdd3c11f2b8676cecc50a9dfcc1e3f4a";
    $url = "https://translate.yandex.net/api/v1.5/tr.json/detect?key=".$access_token."&text=".$text; 
    $url = preg_replace("/ /", "%20", $url);
    echo $url;
    $response = file_get_contents($url);
    $response_array = json_decode($response, true);  
    $lang_iso_code = $response_array["lang"];
   
    return $lang_iso_code;
}

function get_city_yandex($lat,$lng){

    $url = "https://geocode-maps.yandex.ru/1.x/?format=json&geocode=".$lng.",".$lat."&lang=en-US";
    
    $content = file_get_contents($url);

    $json = json_decode($content, true); 
try{
    
   echo "exception>".$json['response'];
   print $json['response']['GeoObjectCollection']['featureMember']['0']['GeoObject']['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['AdministrativeAreaName'];
    }catch(Exception $e){
       
    }
         
    
}
    
function get_city_google($lat,$lng){
    
    $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&sensor=true";
    $content = file_get_contents($url);

    $json = json_decode($content, true); 
    echo "long".$lng . " lat".$lat . "\n";
    //echo "google returns?".$json['results']."\n";
    foreach($json['results'][0]['address_components'] as $item) {  
         
         
         if($item['types'][0] == 'administrative_area_level_1'){
             
             return $item['long_name'];                                          //ŞEHİR BURADA
         }
         
     }
    
}
?>