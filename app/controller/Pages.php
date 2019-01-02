<?php

class Pages extends Controller{
	public function __construct(){
		# This is where you load a model...
		// $this->pageModel = $this->model('Page');
	}

	public function index(){

		$data = [
			'title' => 'HELLCOME!',
			'description' => "This is <strong>Jovan Ničković's PHP MVC framework</strong>. Please refer to the documentation on how to use it."
		];

		$this->view('pages/index', $data); # How to display data v1
	}

	public function about(){

		/*$data = [
			'title' => 'ABOUT US...'
		];*/

		$this->view('pages/about'/*, $data*/); # How to display data v2
	}
}