@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">Order Placed</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="container">
            <!-- Title -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order #{{ $order->id }}</h2>
            </div>

            <!-- Main content -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- Details -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3 d-flex justify-content-between">
                                <div>
                                    <span class="me-3">{{ $order->created_at }}</span>
                                    <span class="me-3">#{{ $order->id }}</span>
                                    <span class="badge rounded-pill bg-info">{{ strtoupper($order->type) }}</span>
                                </div>
                            </div>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex mb-2">
                                                <div class="flex-shrink-0">
                                                    <img src="https://www.bootdey.com/image/280x280/87CEFA/000000"
                                                        alt="" width="35" class="img-fluid">
                                                </div>
                                                <div class="flex-lg-grow-1 ms-3">
                                                    <h6 class="small mb-0"><a href="#" class="text-reset">{{ $order->menu->name }}</a>
                                                    </h6>
                                                    <span class="small">{{ $order->menu->description }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>1</td>
                                        <td class="text-end">RM {{ number_format($order->menu->price, 2, '.', ',') }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Subtotal</td>
                                        <td class="text-end">RM {{ number_format($order->total_price, 2, '.', ',') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Points Earned</td>
                                        <td class="text-danger text-end">{{ $order->total_price }} points</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td colspan="2">TOTAL</td>
                                        <td class="text-end">RM {{ number_format($order->total_price, 2, '.', ',') }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- Payment -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="h6">Payment Method</h3>
                                    <p>Visa<br>
                                        Total: RM {{ number_format($order->total_price, 2, '.', ',') }}
                                        <span class="badge bg-success rounded-pill">PAID</span>
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="h6">Billing address</h3>
                                    @if ($order->address)
                                      <address>
                                          <strong>{{ $order->user->name }}</strong><br>
                                          {{ $order->house_no }}, {{ $order->apartment_no }}, {{ $order->street_name }}<br>
                                          {{ $order->address }}, Malaysia<br>
                                      </address>
                                    @else
                                    -
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Customer Notes -->
                    <div class="card mb-4">
                        <!-- Shipping information -->
                        <div class="card-body">
                            <h3 class="h6">Delivery Information</h3>
                            <hr>
                            <h3 class="h6">Address</h3>
                            @if ($order->address)
                              <address>
                                  <strong>{{ $order->user->name }}</strong><br>
                                  {{ $order->house_no }}, {{ $order->apartment_no }}, {{ $order->street_name }}<br>
                                  {{ $order->address }}, Malaysia<br>
                              </address>
                            @else
                              Pickup
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
