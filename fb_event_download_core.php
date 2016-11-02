<?php
ini_set("max_execution_time", 0);
include "event_insert.php";

function get_events($pages,$categories){
 
    $page_counter = 0;
    $event_counter= 0;
    echo "event gather started";
    foreach($pages as $page_name) { 
    
    $category_page =$categories[$page_counter];
    echo '<br><br>pages:'.$page_name ;
    echo "<br>page_counter:".$page_counter;
    echo '<br>category:'.$category_page ;
    ob_flush();
    flush();
        // mail every 15 page
    /*if($page_counter % 15 == 0){
        $page_details = "page_name:".$page_name."page_counter:".$page_counter;
        mail_for_scheduler_fb("insertion finished>>".$page_details);
    }*/
    $lookfor = $page_name;

    // Long Lived Access Token
 $accesstoken="CAAQODaYACNIBAL9gT6p1zAyTVVzCrACrYLZCQe9fZADoG5Erqsr8z1ZA12GfCU5nYZBCnWgbgZCI5vc8QbNZATCe5XNd2GSxFYpFdiTe3n3Oc4oMYWW84rtb3p1dHcxS9E3au6U3zrxVf2HLuacaAgMf5hwLwfZCoRX1gqcxLAdcbdvH2oVzhQ1";

    //$lookfor = "aÄŸrÄ±";
    //$lookfor = 'jollyjokeristanbul';

    //eventin baÄŸlÄ± olduÄŸu sayfa
    $url = "https://graph.facebook.com/".$lookfor."?fields=events&access_token=".$accesstoken;


    do{
        $content = file_get_contents($url);
        $json = json_decode($content, true);  

        if (is_array($json['events']['data']) || is_object($json['events']['data']))
        {
        foreach($json['events']['data'] as $item) {

            $eventid =$item['id'];   

            // event sayfasi
            $url2 = "https://graph.facebook.com/".$eventid."?fields=name,description,cover,start_time,end_time,place,timezone,owner,ticket_uri&date_format=U&access_token=".$accesstoken;

            $content2 = file_get_contents($url2);
            $json2 = json_decode($content2, true);


            if(isset($json2['cover']['source'])){
            ?>
             <!--   <img src='<?php //echo $json2['cover']['source']?>' alt="pic" style='width:304px;height:228px;' />
                <a href='<?php //echo $json2['cover']['source'] ?>' > Event FotografÄ± </a> -->

            <?php     
                //If needed, other fields of the event node are here : https://developers.facebook.com/docs/graph-api/reference/event
                //print $url2;
                print '<br>';  
                print ++$event_counter.' ';  
                print 'Name: ' .$json2['name'].' <br>fb_id:'.$json2['id'].'<br>';         //Name of the Event 
                /*print 'Start Time:           '.$json2['start_time'].'<br>';          // Start Time  
                print 'End Time:             '.$json2['end_time'].'<br>';            // End Time  
                print 'Category:             '.$json2['owner']['category'].'<br>';   // Category 
                print 'Type:                 '.$json2['owner']['type'].'<br>';               // Start Time  
                print 'Event ID:             '.$json2['id'].'<br>';                         // Event id   
                print 'Description:          '.$json2['description'].'<br>';               // Description   
                print 'Location Name:        '.$json2['place']['name'].'<br>';             // Location Name 
                print 'Country:              '.$json2['place']['location']['country'].'<br>';  // Country 
                print 'City:                 '.$json2['place']['location']['city'].'<br>';     // City
                print 'Latitude, Longitude:  '.$json2['place']['location']['latitude'].','.$json2['place']['location']['longitude'].'<br>'; 
                print 'Street:               '.$json2['place']['location']['street'].'<br>';    // Street
                print 'Owner id:             '.$json2['owner']['id'].'<br>';  // page id
                print 'Ticket uri:           '.$json2['ticket_uri'].'<br>';  // ticket uri
                print 'Timezone:             '.$json2['timezone'].'<br><br>';              // TimeZone
                */
                if(isset($json2['timezone'])){
                    date_default_timezone_set($json2['timezone']);
                }   
                $ts = strtotime($json2['start_time']);
                //echo date( "m/d/Y", $ts );
                //echo date( "h:i A", $ts );
                
                //City google mapsten alinacak
                $fb_event_for_post =array(
                'post_title' => isset($json2['name'])?$json2['name']:"",
                'post_content' => isset($json2['description'])?$json2['description']:"",
                'event_cat'  => isset($category_page)?$category_page:"",
                'event_start_date' =>  date( "m/d/Y", $ts ),
                'event_start_time' =>  date( "h:i A", $ts ),
                'event_location'   => isset($json2['place']['name'])?$json2['place']['name']:"",
                'event_address_country'   => isset( $json2['place']['location']['country'])? $json2['place']['location']['country']:"",
                'event_address_city' => isset($json2['place']['location']['city'])?$json2['place']['location']['city']:"",
                'event_address_address' => isset($json2['place']['location']['street'])?$json2['place']['location']['street']:"",
                'event_address_latitude' => isset($json2['place']['location']['latitude'])?$json2['place']['location']['latitude']:"",
                'event_address_longitude' => isset($json2['place']['location']['longitude'])?$json2['place']['location']['longitude']:"",
                'fb_event_id' => isset($json2['id'])?$json2['id']:"",
                'fb_ticket_uri' => isset($json2['ticket_uri'])?$json2['ticket_uri']:"",
                'fb_event_id' => isset($json2['id'])?$json2['id']:"",
                'fb_page_id' =>  isset( $json2['owner']['id'])?$json2['owner']['id']:"",
                'fb_image_link' => isset($json2['cover']['source'])?$json2['cover']['source']:"",
                'fb_timezone' => isset($json2['timezone'])?$json2['timezone']:"",
                'fb_end_time' => isset($json2['end_time'])?$json2['end_time']:"",
                'post_type' => 'event',
                'comment_status' => 'open',
                'ping_status' => 'open',
                'post_status' => 'publish',
                //exp this is not the event post field
                'fb_category' => isset($json2['owner']['category'])?$json2['owner']['category']:"");
            }
            insertEvent($fb_event_for_post);
        }
        }

        if(isset($json['paging']['next'])){
            $url = $json['paging']['next'];
        }

        }while(isset($json['paging']['next']));
    //echo $json['paging']['next'];
    $page_counter++;
    }
}