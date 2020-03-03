@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('pages.dashboard') }}</div>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h4>{{ __('pages.welcome') }}</h4>
                        <img src="https://pozitiv365.ru/wp-content/uploads/2018/09/87_main-1024x682.jpg" alt="Funny"
                             width="400">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
