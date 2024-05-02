@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <div class="col-md-8">
                <h1 class="m-lg-0">{{ $restaurant->name }}</h1>
                <div class="d-inline-flex align-items-center">
                    <small class="text-muted ml-1 mr-1">{{ $restaurant->description ?? '' }}</small>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid page__container">
        <div class="row">
            @foreach ($menus as $menu)
                <div class="col-md-3">
                    <div class="card card__course">
                        <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                            <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="">
                                <span class="course__title">{{ $menu->name }}</span>
                                <span class="course__subtitle">{{ $menu->description }}</span>
                            </a>
                        </div>
                        <div class="p-3">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('restaurant.placeOrder', $menu->id) }}" class="btn btn-primary ml-auto">Place Order <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('js')
    <script>
    </script>
@endpush