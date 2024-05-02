@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <div class="col-md-8">
                <div class="d-inline-flex align-items-center">
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('restaurant.payment') }}" method="POST">
            @csrf
            <div class="row">
                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                <div class="col-xl-5 col-lg-12">
                    <div class="checkout-order">
                        <div class="title-checkout">
                            <h2>Your order:</h2>
                        </div>
                        <div class="col-md-12">
                            <div class="card card__course">
                                <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                    <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="">
                                        <span class="course__title">{{ $menu->name }}</span>
                                        <span class="course__subtitle">RM {{ $menu->price }}</span>
                                    </a>
                                </div>
                                <div class="p-3">
                                    <div class="mb-2">
                                        <strong>{{ $menu->name }}</strong><br />
                                        <small class="text-muted">Restaurant: {{ $menu->restaurant->name }}</small>
                                        <br>
                                        <small class="text-muted">Price: RM {{ $menu->price }}</small>
                                        <br>
                                        <small class="text-muted">Description: {{ $menu->description }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="offset-xl-1 col-xl-6 col-lg-12" data-aos="flip-up"  data-aos-delay="300" data-aos-duration="400">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-pickup-tab" data-toggle="pill" href="#pills-pickup" role="tab" aria-controls="pills-pickup" aria-selected="true">Pickup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-delivery-tab" data-toggle="pill" href="#pills-delivery" role="tab" aria-controls="pills-delivery" aria-selected="false">Delivery</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-pickup" role="tabpanel" aria-labelledby="pills-pickup-tab"></div>
                        <div class="tab-pane fade" id="pills-delivery" role="tabpanel" aria-labelledby="pills-delivery-tab">
                            <h4 class="two">Delivery addresses</h4>
                            <div class="form-group">
                                <select id="address" name="address" class="form-control">
                                    <option value="">Choose One</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input id="street_name" name="street_name" type="text" class="form-control" placeholder="Street" value="">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input id="house_no" name="house_no" type="text" class="form-control" placeholder="House number" value="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    
                                    <div class="form-group">
                                        <input id="apartment_no" name="apartment_no" type="text" class="form-control" placeholder="Apartment number" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-block btn-primary" type="submit">Proceed to Checkout</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
    </script>
@endpush