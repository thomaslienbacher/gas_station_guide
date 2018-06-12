@extends('layouts.app')

@section('content')
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="padding: 1em">
                    <h2> {{ $station->name }} </h2>
                    <img src='{{ $station->imageurl }}' style="width: 100%">
                    <br>

                    <h3>Position</h3>
                    <div id="mapcanvas">
                        Laden von Google Maps...
                    </div>

                    <script>
                        function load() {
                            var mapcanvas = document.getElementById('mapcanvas');
                            mapcanvas.style.height = '400px';
                            mapcanvas.style.width = '100%';

                            var latlng = new google.maps.LatLng({{ $station->lat }}, {{ $station->long }});

                            var myOptions = {
                                zoom: 15,
                                center: latlng,
                                mapTypeControl: false,
                                navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            };

                            var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);

                            var marker = new google.maps.Marker({
                                position: latlng,
                                map: map,
                                title: "{{ $station->name }}"
                            });
                        }

                        window.addEventListener("load", load, false);
                    </script>
                    <br>

                    <h3>Beschreibung</h3>
                    <div>
                        {!! $station->description !!}
                    </div>
                    <br>

                    <h3>Bewertungen</h3>
                    <div>
                        <span class="fa fa-star rating-star@php if(round($station->stars) >= 1) echo '-good' @endphp"></span>
                        <span class="fa fa-star rating-star@php if(round($station->stars) >= 2) echo '-good' @endphp"></span>
                        <span class="fa fa-star rating-star@php if(round($station->stars) >= 3) echo '-good' @endphp"></span>
                        <span class="fa fa-star rating-star@php if(round($station->stars) >= 4) echo '-good' @endphp"></span>
                        <span class="fa fa-star rating-star@php if(round($station->stars) >= 5) echo '-good' @endphp"></span>
                        <span class="rating-text">{{ $station->stars }}</span>
                    </div>
                    <br>
                    <ul class="list-group">
                        @foreach($station->comments as $key => $comment)
                            <il class="list-group-item">
                                <h4>{{ $comment->user->name }}</h4>
                                <div>
                                    {{ $comment->comment }}
                                </div>
                                <br>
                                <div>
                                    <span class="fa fa-star rating-star-small@php if($comment->stars >= 1) echo '-good' @endphp"></span>
                                    <span class="fa fa-star rating-star-small@php if($comment->stars >= 2) echo '-good' @endphp"></span>
                                    <span class="fa fa-star rating-star-small@php if($comment->stars >= 3) echo '-good' @endphp"></span>
                                    <span class="fa fa-star rating-star-small@php if($comment->stars >= 4) echo '-good' @endphp"></span>
                                    <span class="fa fa-star rating-star-small@php if($comment->stars >= 5) echo '-good' @endphp"></span>
                                </div>
                            </il>
                        @endforeach
                    </ul>
                    <br>

                    <h3>Bewertung aufgeben</h3>
                    @if(Auth::check())

                    <form method="POST" action="/view">
                        @csrf

                        <input name="stationid" type="hidden" value="{{ $station->id }}">
                        <input name="todo" type="hidden" value="update">

                        <div class="form-group row">
                            <label for="comment" class="col-sm-2 col-form-label text-md-right">Kommentar</label>

                            <div class="col-md-10">
                                <textarea rows="5" cols="50" id="comment" class="form-control" name="commenttext" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stars" class="col-sm-2 col-form-label text-md-right">Sterne</label>

                            <div class="col-md-10">
                                <input name="commentstars" id="commentstars" type="hidden" value="1">

                                <button type="button" class="rating-button" onclick="rate(1)">
                                    <span class="fa fa-star rating-star-small-good" id="ratingstar1"></span>
                                </button>
                                <button type="button" class="rating-button" onclick="rate(2)">
                                    <span class="fa fa-star rating-star-small" id="ratingstar2"></span>
                                </button>
                                <button type="button" class="rating-button" onclick="rate(3)">
                                    <span class="fa fa-star rating-star-small" id="ratingstar3"></span>
                                </button>
                                <button type="button" class="rating-button" onclick="rate(4)">
                                    <span class="fa fa-star rating-star-small" id="ratingstar4"></span>
                                </button>
                                <button type="button" class="rating-button" onclick="rate(5)">
                                    <span class="fa fa-star rating-star-small" id="ratingstar5"></span>
                                </button>
                            </div>
                        </div>

                        <script src="{{ asset('js/rating.js') }}"></script>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                                <button type="submit" class="btn btn-primary wide-button">
                                    Bewerten
                                </button>
                            </div>
                        </div>
                    </form>


                    @else
                        Anmelden um Bewertungen abzugeben
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
