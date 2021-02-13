<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class GetExternals extends Model
{
    public static function getthemes()
    {
        $themes = [];

        // Get Addons & Themes
        $files = File::allFiles(storage_path('themes/'));
        foreach ($files as $file) {
            if (str_contains($file->getFilename(), 'config.json')) {
                $content = file_get_contents($file->getPathname());
                $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
                $json = json_decode($content, true);
                array_push($themes, $json);
            }
        }

        return $themes;
    }

    public static function getaddons()
    {
        $addons = [];

        $files = File::allFiles(storage_path('addons/'));
        foreach ($files as $file) {
            if (str_contains($file->getFilename(), 'config.json')) {
                $content = file_get_contents($file->getPathname());
                $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
                $json = json_decode($content, true);
                array_push($addons, $json);
            }
        }

        return $addons;
    }

    public static function geticons()
    {
        $icons = [];

        // Get Addons & Themes
        $files = File::allFiles(storage_path('icons/'));
        foreach ($files as $file) {
            $iconname = explode(".", $file->getFilename());
            array_push($icons, $iconname[0]);
        }

        return $icons;
    }

    public static function getversion()
    {
        $file_contents = file_get_contents('https://marketsoft.io/config/version.json');
        $json_content = json_decode($file_contents, true);

        return $json_content["version"];
    }
}
