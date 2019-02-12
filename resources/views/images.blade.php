@extends('layout')

@section('content')
    <div class="flex items-center justify-center">
        <div class="flex flex-col justify-around h-full w-full">
            {{-- <image-list :url="'{{ route('api:images.index', ['type' => $type, 'per_page' => '150']) }}'"></image-list> --}}
            <image-list :url="'{{ route('api:images.index', ['type' => $type, 'all' => true]) }}'"></image-list>
        </div>
    </div>
@endsection
