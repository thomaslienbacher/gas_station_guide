@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">MyStations</div>
                    <ul class="list-group">
                        @foreach($stations as $key => $value)
                            <li class="list-group-item">
                                <pre>@php print_r($value) @endphp</pre>
                                <h2>{{ $value->name }}</h2>
                                <img src='{{ $value->imageurl }}'>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
