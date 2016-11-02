<?php
// ---------- Posts ----------
$post0 =array(
				'post_title' => 'borabora1',
				'post_content' => 'borabora1',
				'post_type' => 'event',
				'comment_status' => 'open',
				'ping_status' => 'open',
                'event_start_date' =>  sanitize_text_field('12/29/2015'),
                'event_start_time' =>  sanitize_text_field('10:30 AM'),
                'fb_page_id' =>  sanitize_text_field('facebook.com/bora'),
				'post_status' => 'draft');

$post1 =array(
				'post_title' => 'borabora2',
				'post_content' => 'borabora2',
				'post_type' => 'event',
				'comment_status' => 'open',
				'ping_status' => 'open',
                'event_start_date' =>  sanitize_text_field('12/24/2015'),
                'event_start_time' =>  sanitize_text_field('06:30 AM'),
                'fb_page_id' =>  sanitize_text_field('facebook.com/bora2'),
				'post_status' => 'draft');

$add_posts_array = array($post0,$post1);
$remove_posts_array = array($post0,$post1);

?>