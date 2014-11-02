<?php

class FeedController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function rss()
    {
        $maxItemsData = PluginData::where('plugin_slug', '=', 'feed')->where('key', '=', 'max_results')->first();
        $maxItems = 15;
        if(!empty($maxItemsData->value)){
            $maxItems = $maxItemsData->value;
        }
        $media = Media::where('active', '=', 1)->orderBy('created_at', 'desc')->paginate($maxItems);

        $contents = View::make('feed.rss')->with('media', $media);
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'application/rss+xml');
        return $response;
    }
}