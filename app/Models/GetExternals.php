<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Mail;

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

    public static function getversionstring()
    {
        $file_contents = file_get_contents('https://marketsoft.io/config/version.json');
        $json_content = json_decode($file_contents, true);
        $version = env('APP_VERSION');

        if ($version == null) {
            $type = "alert-danger";
            $string = "APP_VERSION is removed in your .env please add APP_VERSION=(YOURVERSION) back to see if your site is up to date!";
            return [$string, $type];
        }

        if ($json_content == null) {
            $type = "alert-warning";
            $string = "Your using version v" . $version . " of MarketSoft. (Our webserver is down so we coudn't check the latest version)";
            return [$string, $type];
        }

        if ($json_content["version"] > $version) {
            $type = "alert-danger";
            $string = "Your using version v" . $version . " of MarketSoft. There is a new version out v" . $json_content["version"];
        } elseif ($json_content["version"] <= $version) {
            $type = "alert-info";
            $string = "Your using version v" . $version . " of MarketSoft.";
        } else {
            $type = "alert-info";
            $string = "Your using version v" . $version . " of MarketSoft.";
        }
        
        return [$string, $type];
    }
}
