<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Myyield
{
    function doYield()
    {
        global $OUT;

        $CI =& get_instance();
        $output = $CI->output->get_output();

        //$CI->yield = isset($CI->yield) ? TRUE : FALSE;
        $CI->yield = isset($CI->yield) ? $CI->yield : TRUE;
        $CI->layout = isset($CI->layout) ? $CI->layout : 'default';

        if($CI->yield === TRUE){

            ///if(!preg_match('/(.+).php$/', $CI->layout))
            $requested = VIEWPATH . 'layouts/'.$CI->layout.EXT;

            if(file_exists($requested)){
                $layout = $CI->load->file($requested, true);
                $output = str_replace('{yield}', $output, $layout);

                if(preg_match_all('/{yield[\s]*([^}]*)}/', $layout, $matches)  && array_key_exists(1, $matches)){
                    foreach($matches[1] as $k => $v){
                        if(!empty($v)){
                            $requested = VIEWPATH . 'layouts/'.$CI->layout.'/'.$v.EXT;
                            if(!file_exists(FCPATH.$requested)){
                                $requested = VIEWPATH . 'layouts/default/'.$v.EXT;
                            }

                            $yield = $CI->load->file($requested, true);
                            $output = str_replace(sprintf('{yield %s}', $v), $yield, $output);
                        }
                    }
                }

            }
        }
        $OUT->_display($output);
    }
}