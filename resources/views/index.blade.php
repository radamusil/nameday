@extends('layout')

@section('content')
    <main class="bg-info bg-gradient d-flex justify-content-center align-items-center">
        <div class="w-25 bg-light text-center">
            <div class="bg-secondary p-2">
                Dnes je {{$now->format('d.m.Y')}}
            </div>
            <div>
                <div class="p-2">
                    Svátek má:
                </div>
                <div class="p-2 m-2 bg-secondary">
                    {{$nameday->name}}
                </div>
            </div>
        </div>
    </main>
@endsection
