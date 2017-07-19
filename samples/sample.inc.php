<?php

function show_usage($filename, $args)
{
    $args_list = implode(' ', $args);
    echo 'USAGE:',PHP_EOL,'  php '.basename($filename),' ',$args_list,PHP_EOL;
}

function get_args($argdefs, $filename)
{
    global $argv, $argc;
    
    $args_for_usage = array_keys($argdefs);
    
    $param_count = 0;
    $index = 1;
    foreach($argdefs as $key => $type){
        
        $is_option = preg_match('/\[([a-zA-Z0-9].*)\]/', $key);
        if(!$is_option){
            $param_count ++;
        }
    
        $index++;
    }
    
    if ($argc < $param_count){
        show_usage($filename, $args_for_usage);
        exit;
    }
    
    $args = array();
    
    $index = 1;
    foreach($argdefs as $key => $type){
        
        $arg = isset($argv[$index]) ? $argv[$index] : null;
    
        $is_option = preg_match('/\[([a-zA-Z0-9].*)\]/', $key);
        
        // empty check
        if(!$is_option && empty($arg)){
            echo 'bad parameter: ',$key,'(empty)',PHP_EOL;
            show_usage($filename, $args_for_usage);
            exit;
        }
        
        if (empty($arg)||$arg === 'NULL'||$arg === 'null'){
            $arg = null;
        }
        else{
            // integer check
            if(!empty($arg) && $type =='integer' && !is_numeric($arg)){
                echo 'bad parameter: ',$key,'(integer)',PHP_EOL;
                show_usage($filename, $args_for_usage);
                exit;
            }
            // float check
            if(!empty($arg) && $type =='float' && !is_numeric($arg)){
                echo 'bad parameter: ',$key,'(float)',PHP_EOL;
                show_usage($filename, $args_for_usage);
                exit;
            }
        }
    
        $args[] = $arg;
        $index++;
    }
    return $args;
}

function bitflyer_credentials()
{
    $api_key = getenv('PHITFLYER_API_KEY');
    $api_secret = getenv('PHITFLYER_API_SECRET');
    
    echo 'PHITFLYER_API_KEY:',$api_key,PHP_EOL;
    echo 'PHITFLYER_API_SECRET:',$api_secret,PHP_EOL;
    
    return array($api_key, $api_secret);
}

