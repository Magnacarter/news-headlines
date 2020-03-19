<?php
/**
 * Grab the headlines data.
 *
 *
 *
 */
namespace Wizeline\NewsHeadlines;

$headlines = new Headlines;

/**
 * Class Headlines
 */
class Headlines {
	/**
	 * @var json
	 */
	public $api_data;

	public function __construct() {
		$this->set_api_data();
		$this->show_api_data_in_error_log();
		$this->build_drafts();
	}

	public function run_curl() {
		$curl = curl_init();

		curl_setopt_array( $curl, array(
			CURLOPT_URL => "http://newsapi.org/v2/top-headlines?country=us&category=business&apiKey=0247e290c70f4c7dbcc8c0763e06b102",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_POSTFIELDS => "",
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json",
				"cache-control: no-cache"
			),
		));

		$response = curl_exec( $curl );
		$err      = curl_error( $curl );
		$data     = json_decode( $response, true );

		return $data;
	}

	public function set_api_data() {
		$data = $this->run_curl();
		$this->api_data = $data;
	}

	/**
	 * TODO: Figure out how to parse the api array.
	 * Use wp_insert_post to create draft.
	 *
	 */
	public function build_drafts() {
		$api_data = $this->api_data;
		$count = array_sum( $api_data['articles']['title'] );

		for ($i = 0; $i < $count; $i++) { 
			error_log( print_r($api_data['articles'][$i], true ) );
		}
		// foreach ( $api_data['articles'][0] as $arr ) {
		
		// 	// foreach ( $arr as $post ) {
		// 	// 	error_log( print_r( $post, true ) );
		// 	// 	$postarr = array(
		// 	// 		'post_title'  => $val,
		// 	// 		'post_status' => 'draft',
		// 	// 	);
		// 	// 	//wp_insert_post( $postarr, $wp_error = false );
		// 	// }
		// 	$i++;
		// }
	}

	public function show_api_data_in_error_log() {
		error_log( print_r( $this->api_data, true ) );
	}
}
