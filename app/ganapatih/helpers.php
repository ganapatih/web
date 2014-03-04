<?php

if ( !function_exists('ganapatih_port') ) {
    
    function ganapatih_port($port)
    {
        return url('/').':'.$port.'/';
    }
    
}