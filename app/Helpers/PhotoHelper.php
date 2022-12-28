<?php
namespace App\Helpers;
class PhotoHelper{
    public static function storePhoto($file,$location='book/cover'){
        $dir="public/".$location;
        $newName = uniqid()."_cover.".$file->getClientOriginalExtension();
        $file->storeAs($dir,$newName);
        return $newName;
    }
}
