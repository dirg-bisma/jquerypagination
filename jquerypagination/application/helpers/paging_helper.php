<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 27/12/2014
 * Time: 6:47 PM
 */
function configPaging()
{
    $config_pagination = array(
        "first_tag_open" => '<li>',
        "first_tag_close" => '</li>',
        "prev_tag_open" => '<li>',
        "prev_tag_close" => '</li>',

        "cur_tag_open" => '<a href="#"><li>',
        "cur_tag_close" => '</a></li>',
        "num_tag_open" => '<li>',
        "num_tag_close" => '</li>',

        "next_tag_open" => '<li>',
        "next_tag_close" => '</li>',
        "last_tag_open" => '<li>',
        "last_tag_close" => '</li>',
    );

    return $config_pagination;
}