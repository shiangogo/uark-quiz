@extends('layouts.base')
@section('content')
    <main id="app" class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full lg:w-2/3 py-6">
                @yield('main')
            </div>
        </div>
    </main>
        @yield('script')
@endsection