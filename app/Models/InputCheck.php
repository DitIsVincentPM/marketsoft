<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputCheck extends Model
{
    public static function check(array $input) {

    $string = false;
    $x = 0; 

    for($i = 0; $i < count($input); $i++){
        if(!isset($input[$i])) {
            $x++;
        }
    }

    if($x > 0) {
        $string = "You didn't put any value in the text fields.";
    }
    
        return $string;
    }

    public static function email(array $input) {

        $string = false;
        $x = 0; 
    
        for($i = 0; $i < count($input); $i++){
            if (strpos($input[$i], '@') !== false) {
                if (strpos($input[$i], '.') !== false) {
                $x++;
                }
            }
        }
    
        if($x > 0) {
            $string = "The email you put in is not valid.";
        }
        
            return $string;
        }
}
