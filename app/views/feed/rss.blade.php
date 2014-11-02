<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<?php $settings = Setting::first(); ?>
<channel>
    <title>{{ $settings->website_name }}</title>
    <link>{{ URL::to('/') }}</link>
    <description>{{ $settings->website_description }}</description>
    <atom:link href="{{ URL::to('/feed') }}" rel="self" type="application/rss+xml" />
    <?php
    $addEnclosureData = PluginData::where('plugin_slug', '=', 'feed')->where('key', '=', 'add_enclosure')->first();
    if(empty($addEnclosureData->value)){
        $addEnclosure = "";
    }else{
        $addEnclosure = $addEnclosureData->value;
    }

    $addMediaData = PluginData::where('plugin_slug', '=', 'feed')->where('key', '=', 'add_media')->first();
    if(empty($addMediaData->value)){
        $addMedia = "";
    }else{
        $addMedia = $addMediaData->value;
    }

    ?>
@foreach($media as $item)
    <?php $url = URL::to('media') . '/' . $item->slug;
    if($item->vid != 1){
        $media_url = Config::get('site.uploads_dir') . '/images/' . $item->pic_url;
        $mime_type = mime_content_type(base_path() . '/../content/uploads/images/' . $item->pic_url);
    }
    ?>

    <item>
        <title>{{$item->title}}</title>
        <link>{{ $url }}</link>
        <description><![CDATA[
            @if($settings->media_description && isset($item->description) && !empty($item->description)){{ $item->description }}@endif
            @if($item->vid != 1 && $addMedia == 1)
            <br/><br/><img src="{{$media_url}}" alt="{{ $item->title }}"/>
            @endif]]>
        </description>
        <guid>{{ $url }}</guid>
        <pubDate>{{ date("D, d M Y H:i:s O", strtotime($item->created_at)) }}</pubDate>
        <category>{{ $item->category->name }}</category>
        @if($item->vid != 1 && $addEnclosure == 1)
            <enclosure url="{{ $media_url  }}" type="{{ $mime_type }}"/>
        @endif
    </item>
@endforeach
</channel>
</rss>
