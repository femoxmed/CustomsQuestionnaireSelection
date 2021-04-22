<?php

function processQuestionaire() {
    global $argv;
    $groups = array();
    $groupIndex = 0;
    // print_r($argv);
    
    // checking if the input  file exist
    $fileIndex = array_search('input.txt', $argv);
    if(!$fileIndex) {
        echo 'input.txt file was not found';
        return;
    }

    // get the filename 
    $filename = $argv[$fileIndex];
    
    // reading the file
    $fileArr = file($filename);
    
    foreach ($fileArr as $line) {
        $line = trim($line);
        if(strlen($line) === 0) {
            $groupIndex++;
        }

        if(strlen($line) > 0 ) {
           
            if($groups[$groupIndex]){
                $groups[$groupIndex] .= $line;
            } else {
                $groups[$groupIndex] = $line;
            }
            $groups[$groupIndex] = removeDuplicate($groups[$groupIndex]);
        }
    }
    

    // Count 
   $total = array_reduce($groups, function($accumulator, $currentValue){
           return $accumulator +  strlen($currentValue);
    }, 0);

    
    echo 'The sum of these count is ' . $total;
}

function removeDuplicate($str) {
    $strArr = str_split($str);
    $newStrArr = array_filter($strArr, function($val, $key) use($strArr){
        return array_search($val, $strArr) === $key;
    }, ARRAY_FILTER_USE_BOTH);

    return  implode('', $newStrArr);
}

processQuestionaire();