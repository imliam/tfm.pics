@extends('layout')

@section('content')
    <div class="mt-8 flex items-center justify-center">
        <div class="container mx-auto">
            <div class="flex flex-col sm:flex-row sm:items-end">
                <a href="{{ route('images.index', ['type' => 'transformice.com']) }}" class="flex flex-col my-8 text-center sm:w-1/2 sm:px-4 no-underline text-teal-darkest hover:text-teal-darker">
                    <div class="text-center mb-2">
                        <img src="{{ asset('images/map.png') }}" alt="Maps" class="max-h-sm">
                    </div>
                    <h2>Map Images</h2>
                    <p>
                        Images that can be used in any map created in the map editor
                    </p>
                </a>
                <a href="{{ route('images.index', ['type' => 'images.atelier801.com']) }}" class="flex flex-col my-8 text-center sm:w-1/2 sm:px-4 no-underline text-teal-darkest hover:text-teal-darker">
                    <div class="text-center mb-2">
                        <img src="{{ asset('images/module.png') }}" alt="Modules" class="max-h-sm">
                    </div>
                    <h2>Module Images</h2>
                    <p>
                        Images that can be used with <code>tfm.exec.addImage()</code> in modules
                    </p>
                </a>
            </div>
        </div>
    </div>
@endsection
