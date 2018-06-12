@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">MyStations</div>
                    <ul class="list-group">
                        @foreach($stations as $key => $value)
                            <il class="list-group-item">
                                <h2>{{ $value->name }}</h2>
                                <img src='{{ $value->imageurl }}' style="width: 100%">
                                <br>

                                <form method="POST">
                                    @csrf

                                    <input name="stationid" type="hidden" value="{{ $value->id }}">
                                    <input name="todo" type="hidden" value="update">

                                    <h3>Grunddaten</h3>
                                    <div class="form-group row">
                                        <label for="stationname" class="col-sm-2 col-form-label text-md-right">Name</label>

                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="stationname" value="{{ $value->name }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="comment" class="col-sm-2 col-form-label text-md-right">Bild URL</label>

                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="stationimageurl" value="{{ $value->imageurl }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="stationdescription" class="col-sm-2 col-form-label text-md-right" style="font-size: 95%">Beschreibung</label>

                                        <div class="col-md-10">
                                            <textarea rows="5" cols="50" class="form-control" id="stationdescription" name="stationdescription" required>{!! $value->description !!}</textarea>
                                        </div>
                                    </div>

                                    <h3>Position</h3>
                                    <div class="form-group row">
                                        <label for="comment" class="col-sm-2 col-form-label text-md-right">Latitude</label>

                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="stationlat" value="{{ $value->lat }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="comment" class="col-sm-2 col-form-label text-md-right">Longitude</label>

                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="stationlong" value="{{ $value->long }}" required>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-12 offset-md-0">
                                            <button type="submit" class="btn btn-primary wide-button">
                                                Aktualisieren
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <br>

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
                        <il class="list-group-item">
                            <h2>Neue Tankstelle erstellen</h2>

                            <form method="POST">
                                @csrf

                                <input name="todo" type="hidden" value="add">

                                <h3>Grunddaten</h3>
                                <div class="form-group row">
                                    <label for="stationname" class="col-sm-2 col-form-label text-md-right">Name</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="stationname" value="" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="comment" class="col-sm-2 col-form-label text-md-right">Bild URL</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="stationimageurl" value="" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="stationdescription" class="col-sm-2 col-form-label text-md-right" style="font-size: 95%">Beschreibung</label>

                                    <div class="col-md-10">
                                        <textarea rows="5" cols="50" class="form-control" id="stationdescription" name="stationdescription" required></textarea>
                                    </div>
                                </div>

                                <h3>Position</h3>
                                <div class="form-group row">
                                    <label for="comment" class="col-sm-2 col-form-label text-md-right">Latitude</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="stationlat" value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="comment" class="col-sm-2 col-form-label text-md-right">Longitude</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="stationlong" value="" required>
                                    </div>
                                </div>

                                <br>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12 offset-md-0">
                                        <button type="submit" class="btn btn-primary wide-button">
                                            Erstellen
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </il>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
