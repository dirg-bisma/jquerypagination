<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User: dirg
 * Date: 11/17/12
 * Time: 1:01 PM
 * To change this template use File | Settings | File Templates.
 */
/**
 * Yield  ::  HOOKS
 *
 * Adds layout support :: Similar to RoR <%= yield =>
 * '{yield}' will be replaced with all output generated by the controller/view.
 */
class Template
{
    function doYield()
    {
        global $OUT;

        $CI =& get_instance();
        $output = $CI->output->get_output();

        if (isset($CI->layout))
        {
            if (!preg_match('/(.+).php$/', $CI->layout))
            {
                $CI->layout .= '.php';
            }

            $requested = BASEPATH . '../application/views/layouts/' . $CI->layout;
            $default = BASEPATH . '../application/views/layouts/default.php';

            if (file_exists($requested))
            {
                $layout = $CI->load->file($requested, true);
                $view = str_replace("{yield}", $output, $layout);
            }
            else
            {
                $layout = $CI->load->file($default, true);
                $view = str_replace("{yield}", $output, $layout);
            }
        }
        else
        {
            $view = $output;
        }

        $OUT->_display($view);
    }
}

?>