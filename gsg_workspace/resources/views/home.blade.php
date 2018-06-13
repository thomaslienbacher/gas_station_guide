@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="padding: 1em">
                    <h1 class="text-center">Die besten Tankstellen in ihrer Nähe</h1>

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

                                <form method="POST" action="/view">
                                    @csrf

                                    <input name="stationid" type="hidden" value="{{ $value->id }}">

                                    <div class="form-group row mb-0">
                                        <div class="col-md-12 offset-md-0">
                                            <button type="submit" class="btn btn-primary wide-button">
                                                Ansehen
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </il>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
