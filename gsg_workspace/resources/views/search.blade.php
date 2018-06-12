@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="padding: 1em">
                    <h2>Suchen</h2>
                    <form method="POST">
                        @csrf

                        <input name="todo" type="hidden" value="search">

                        <div class="form-group row">
                            <label for="searchkeyword" class="col-sm-2 col-form-label text-md-right">Suchbegriff</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="searchkeyword" value="" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                                <button type="submit" class="btn btn-primary wide-button">
                                    Suchen
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>

                    <ul class="list-group">
                        @foreach($stations as $key => $value)
                            <il class="list-group-item">
                                <h2> {{ $value->name }} </h2>
                                <br>
                                <div id="mapcanvas_{{ $value->id }}">
                                    Laden von Google Maps...
                                </div>

                                <script>
                                    function load_{{ $value->id }}() {
                                        var mapcanvas = document.getElementById('mapcanvas_{{ $value->id }}');
                                        mapcanvas.style.height = '400px';
                                        mapcanvas.style.width = '100%';

                                        var latlng = new google.maps.LatLng({{ $value->lat }}, {{ $value->long }});

                                        var myOptions = {
                                            zoom: 15,
                                            center: latlng,
                                            mapTypeControl: false,
                                            navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
                                            mapTypeId: google.maps.MapTypeId.ROADMAP
                                        };

                                        var map = new google.maps.Map(document.getElementById("mapcanvas_{{ $value->id }}"), myOptions);

                                        var marker = new google.maps.Marker({
                                            position: latlng,
                                            map: map,
                                            title: "{{ $value->name }}"
                                        });
                                    }

                                    window.addEventListener("load", load_{{ $value->id }}, false);
                                </script>
                                <br>
                                <div>
                                    {!! $value->description !!}
                                </div>
                                <br>
                                <div>
                                    <span class="fa fa-star rating-star@php if(round($value->stars) >= 1) echo '-good' @endphp"></span>
                                    <span class="fa fa-star rating-star@php if(round($value->stars) >= 2) echo '-good' @endphp"></span>
                                    <span class="fa fa-star rating-star@php if(round($value->stars) >= 3) echo '-good' @endphp"></span>
                                    <span class="fa fa-star rating-star@php if(round($value->stars) >= 4) echo '-good' @endphp"></span>
                                    <span class="fa fa-star rating-star@php if(round($value->stars) >= 5) echo '-good' @endphp"></span>
                                    <span class="rating-text">{{ $value->stars }}</span>
                                </div>
                            </il>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
