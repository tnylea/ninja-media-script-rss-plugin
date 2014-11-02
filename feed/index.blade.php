@extends('layouts.master')
    @section('content')

        <?php $add_enclosure = 0; $add_media = 0; $max_results = 15; ?>
        @foreach($plugin_data as $data)
            <?php
            switch($data->key){
                case 'add_enclosure':
                    $add_enclosure = $data->value;
                    break;
                case 'max_results':
                    $max_results = $data->value;
                    break;
                case 'add_media':
                    $add_media = $data->value;
                    break;
                case 'link_color':
                    $link_color = $data->value;
                    break;
                default:
                    break;
            }
            ?>
        @endforeach

        <div class="main_home_container container">
            <div class="white_container row" style="margin-top:20px;">
                <img src="/content/plugins/feed/logo.png" height="75" style="float:left; margin-right:15px; margin-bottom:15px;" />
                <h1>RSS Plugin</h1>
                <div style="clear:both"></div>
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-xs-4">
                            <label for="title">Max items</label>
                            <input type="text" class="form-control" name="max_results" id="max_results" value="{{ $max_results }}" />
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-xs-4">
                            @if(empty($link_color))<?php $link_color = "#ed832f" ?>@endif
                            <label for="link_color">Link color</label>
                            <div>
                            {{ Form::text('link_color', $link_color, array('class'=>'form-control', 'id' => 'link_color',  'style'=> 'width:110px;')) }}
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-xs-4">
                            @if(empty($add_enclosure))<?php $add_enclosure = 0; ?>@endif
                            <label for="add_enclosure">Add enclosure</label>
                            <div class="onoffswitch">
                                {{ Form::checkbox('add_enclosure', '', $add_enclosure, array('class' => 'onoffswitch-checkbox', 'id' => 'add_enclosure')) }}
                                <label class="onoffswitch-label" for="add_enclosure">
                                    <div class="onoffswitch-inner"></div>
                                    <div class="onoffswitch-switch"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-xs-4">
                            @if(empty($add_media))<?php $add_media = 0; ?>@endif
                            <label for="add_media">Add media</label>
                            <div class="onoffswitch">
                                {{ Form::checkbox('add_media', '', $add_media, array('class' => 'onoffswitch-checkbox', 'id' => 'add_media')) }}
                                <label class="onoffswitch-label" for="add_media">
                                    <div class="onoffswitch-inner"></div>
                                    <div class="onoffswitch-switch"></div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <input type="button" class="btn btn-color" id="submit" style="float:right; margin-top:20px;" value="submit" />
                </form>
            </div>
        </div>
        <script type="text/javascript" src="{{ URL::to('/') }}/application/assets/js/jquery-minicolors/jquery.minicolors.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                jQuery('input#link_color').minicolors();

                var $ = document;
                var head  = $.getElementsByTagName('head')[0];
                var admin  = $.createElement('link');
                admin.rel  = 'stylesheet';
                admin.type = 'text/css';
                admin.href = '{{ URL::to('/') }}/application/assets/css/admin.css';
                admin.media = 'all';
                head.appendChild(admin);

                var minicolors  = $.createElement('link');
                minicolors.rel  = 'stylesheet';
                minicolors.type = 'text/css';
                minicolors.href = '{{ URL::to('/') }}/application/assets/js/jquery-minicolors/jquery.minicolors.css';
                minicolors.media = 'all';
                head.appendChild(minicolors);

                jQuery('#submit').click(function() {
                    jQuery.post("",{
                        add_media : jQuery("#add_media").is(":checked") ? '1' : '0',
                        add_enclosure : jQuery("#add_enclosure").is(":checked") ? '1' : '0',
                        max_results : jQuery("#max_results").val(),
                        link_color : jQuery("#link_color").val()
                    });
                });
            });
        </script>
    @endsection
@stop