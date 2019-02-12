@extends('layout')

@section('content')
    <image-upload :url="'{{ route('api:images.store') }}'"></image-upload>
@endsection
