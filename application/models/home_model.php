<?php

class Home_model extends CI_Model
{
	public function pagination()
	{
        $offset = $this->input->get("per_page");
		$config_pagination = array(
            "first_tag_open" => '<li>',
            "first_tag_close" => '</li>',
            "prev_tag_open" => '<li>',
            "prev_tag_close" => '</li>',

            "cur_tag_open" => '<li class="active"><a href="#"><strong>',
            "cur_tag_close" => '</strong></a></li>',
            "num_tag_open" => '<li>',
            "num_tag_close" => '</li>',

            "next_tag_open" => '<li>',
            "next_tag_close" => '</li>',
            "last_tag_open" => '<li>',
            "last_tag_close" => '</li>',
        );

        $config_pagination["base_url"] = base_url() . "?c=home&m=ajaxData";
        $config_pagination["total_rows"] = $this->getDataTest('','')->num_rows();
        $config_pagination["per_page"] = 10;
        $config_pagination["nameFunc"] = "renderTableAndPagination";
        $this->jquerypagination->initialize($config_pagination);
        $data["test"] = $this->getDataTest($config_pagination["per_page"],$offset)->result();
        $data["paging"] = $this->jquerypagination->create_links();

        $data["url"] = $config_pagination["base_url"];
        $data["id_dom"] = "#ajax";

        return $data;
	}

	function getDataTest($paging = "",$offset)
	{
        if($offset == ""){
            $offset = 0;
        }
        if($paging != ""){
            $this->db->limit($paging, $offset);
        }
        return $this->db->get("test");
	}
}