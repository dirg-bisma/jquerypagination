<?php

class Home extends CI_Controller{

    /**
     * @var Home_model
     */
    public  $Home_model;

	function __construct()
	{
		parent::__construct();
        $this->load->model("Home_model");
	}

	public function index()
	{
        $data["id_dom"] = "#ajax";
        $data["url"] = base_url() . "?c=home&m=ajaxData";
		$this->load->view("home",$data);
	}

    public function ajaxData()
    {
        $this->load->library("jquerypagination");
        $data = $this->Home_model->pagination();
        $this->load->view("ajax-data",$data);
    }
}