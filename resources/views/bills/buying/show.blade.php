@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center"> {{ $h_receipt->name }} {{ __('Invoice') }}</h4>
                <table class="table table-borderless text-center" id="dynamicAddRemove">

                    <tr>


                        <td>
                            <h3 class="">
                                {{ $h_receipt->client->name }}

                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                {{ __('supplier name :') }}

                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                {{ $h_receipt->name }}


                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                : {{ __('Invoice Name') }}

                            </h3>
                        </td>
                    </tr>
                    <hr>
                    <tr>


                        <td>
                            <h3 class="">
                                <span>{{ Money::format($h_receipt->discount) }}</span>


                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                {{ __('Total Discount :') }}

                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                <span>{{ Money::format($h_receipt->total) }}</span>



                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                :{{ __('Total Bill') }}

                            </h3>
                        </td>
                    </tr>
                </table>

                <table class="table table-bordered " id="dynamicAddRemove">
                    <tr class="text-right decoration-none text-center">
                        <th>{{ __('The Resulting') }}</th>
                        <th>{{ __('Product Quantity') }}</th>
                        <th>{{ __('Product Cost') }}</th>
                        <th>{{ __('Product Name') }}</th>
                        <th>#</th>
                    </tr>
                    @foreach ($f_receipts as $key => $f_receipt)
                        <tr class="text-center">
                            <td>

                                <span>{{ Money::format($f_receipt->quantity * $f_receipt->cost) }}</span>

                            </td>
                            <td>

                                {{ $f_receipt->quantity }}

                            </td>
                            <td>

                                <span>{{ Money::format($f_receipt->cost) }}</span>

                            </td>
                            <td>

                                {{ $f_receipt->product->name }}

                            </td>
                            <td>{{ $key + 1 }}</td>

                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
@endsection
