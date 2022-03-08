@extends('layout')

@section('content')
    <main class="bg-info bg-gradient d-flex justify-content-center align-items-center">
        <div class="w-25 bg-light text-center">
            <div class="bg-secondary p-2">
                {{$nameday->name}}
            </div>
            <div>
                <div class="p-2">
                    má svátek
                </div>
                <div class="p-2 m-2 bg-secondary">
                    {{$nameday->day}}. {{$nameday->month}}.
                </div>
            </div>
        </div>
    </main>
@endsection