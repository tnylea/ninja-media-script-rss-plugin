<?php

Config::set('site.rss', 'rss_header');

function rss_header(){
    $linkColorData = PluginData::where('plugin_slug', '=', 'feed')->where('key', '=', 'link_color')->first();
    $linkColor = "#ed832f";
    if(!empty($linkColorData->value)){
        $linkColor = $linkColorData->value;
    }

    echo '<style>.feed {margin-left: 5px;margin-top: 10px;padding: 0 0 0 19px;background: url("/content/plugins/feed/rss.png") no-repeat 0 50%; color : ' . $linkColor . ';</style>';
    echo '<script src="/content/plugins/feed/functions.js"></script>';
}

