<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Social_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function get_all(){
		/*****GET SOCIAL INFOS*****/

		require_once('php/facebook/facebook.php');
		
		$fbappId = FACEBOOK_APP_ID;
		$fbsecret = FACEBOOK_SECRET_ID;
		$fbId = FACEBOOK_ID;
		
		$fb = new Facebook(array(  

			'appId'  => $fbappId,  

			'secret' => $fbsecret,  

			'cookie' => true

		));  	

		$fb_page = $fb->api(array(  

			'method'	=> 'fql.query',  

			'query'		=> 'select fan_count, page_url from page where page_id = '. $fbId

		));	
		
		$fb_page_stream = $fb->api(array(  

			'method'	=> 'fql.query',  

			'query'		=> 'select message, created_time from stream where source_id = '.$fbId.' limit 0,5' 

		));	
		$facebook = array(

			'link'		=> FACEBOOK_LINK,//$fb_page[0]['page_url'],
			'likes'		=> $fb_page[0]['fan_count']		,
			'alldata'	=> $fb_page_stream	

		);
		
		/*****GET TWITTER INFOS*****/		
		$twitter_screen_name = TWITTER_SCREEN_NAME;
		require_once("php/twitter/twitteroauth.php"); //Path to twitteroauth library
		$twitteruser = "$twitter_screen_name";
		$notweets = 5;
		$consumerkey = TWITTER_CONKEY;
		$consumersecret = TWITTER_CONSEC;
		$accesstoken = TWITTER_ACCTOK;
		$accesstokensecret = TWITTER_ACCSEC;
		 
		function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
		  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
		  return $connection;
		}
		
		$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
		$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);			
		$twitter_data = $connection->get('https://api.twitter.com/1.1/users/show.json?screen_name='.$twitter_screen_name);
		$twitter = array(
			'link'			=> TWITTER_LINK,
			'followers'		=> $twitter_data->followers_count,
			'tweets'		=> $tweets
		);
		
//		/*****GET GOOGLE + INFOS*****/				
//		$google_plusid = GOOGLE_ID;
//		$google_pluskey = GOOGLE_API_KEY;
//		$google_plus_feed = json_decode(file_get_contents('https://www.googleapis.com/plus/v1/people/'.$google_plusid.'/activities/public?key='.$google_pluskey));
//		$google_page_circle = 'https://www.googleapis.com/plus/v1/people/'.$google_plusid.'?key='.$google_pluskey.'';
//		$google_data = json_decode(file_get_contents($google_page_circle));
//		$google_plus = array(			
//			'id'				=> GOOGLE_ID,
//			'api_key'			=> GOOGLE_API_KEY,
//			'link'				=> GOOGLE_PLUS_LINK,
//			'google_plus_feed'	=> $google_plus_feed,
//			'google_data'		=> $google_data

//		);
		
		// RETURNS
		return array(/*'google_plus' => $google_plus, */'twitter' => $twitter, 'facebook' => $facebook);
	}
}