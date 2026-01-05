<?php

namespace App\Helpers;

class YoutubeHelper {
    public static function getEmbedUrl($url) {

        $videoId = null;
        
        if (preg_match('/youtu\.be\/([^\?&]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/youtube\.com\/.*v=([^\?&]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/youtube\.com\/live\/([^\?&]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/youtube\.com\/shorts\/([^\?&]+)/', $url, $matches)) {
            $videoId = $matches[1];
        }

        if($videoId) {
            return "https://www.youtube.com/embed/". $videoId;
        }

        return $url;
    }
}