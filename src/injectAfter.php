<?php

if( ! function_exists('injectAfter') ) {
    function injectAfter(array $array, string $afterKey, string $newKey, mixed $newValue)
    {
        $issetAftrerKey = isset($array[$afterKey]);
        $issetNewKey = isset($array[$newKey]);

        // if we have new key in array but dont have after key at same time
        if(!$issetAftrerKey && $issetNewKey) {
            throw new Exception('Unhandled');
        }

        // insert end of array
        if(!$issetAftrerKey) {
            $array[$newKey] = $newValue;
            return $array;
        }

        // remove current and call recursive to add in new position
        if($issetNewKey) {
            unset($array[$newKey]);
            injectAfter($array, $afterKey, $newKey, $newValue);
        }

        // slive array and insert end of first part
        $indexToSlice = array_search($afterKey,array_keys($array));
        $leftPart = array_slice($array, 0, $indexToSlice + 1);
        $rightPart = array_slice($array, $indexToSlice + 1, count($array));
        $leftPart[$newKey] = $newValue;
        return array_merge($leftPart, $rightPart);
    
    }
}

