@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">{{ __('Sale Invoice') }}</h4>
                <table class="table table-borderless text-center" id="dynamicAddRemove">

                    <tr>


                        <td>
                            <h3 class="">
                                {{ $hreceipts->created_at }}

                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                : {{ __('Invoice Date') }}

                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                {{ $hreceipts->client_id ? $hreceipts->client->name : 'مبيعات نقدية' }}


                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                : {{ __('Customer Name') }}

                            </h3>
                        </td>
                    </tr>
                    <hr>
                    <tr>


                        <td>
                            <h3 class="">
                                <span>{{ Money::format($hreceipts->discount) }}</span>


                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                {{ __('Total Discount :') }}

                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                <span>{{ Money::format($hreceipts->total) }}</span>



                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                : {{ __('Total Bill') }}

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
                    @foreach ($freceipts as $key => $freceipt)
                        <tr class="text-center">
                            <td>

                                <span>{{ Money::format($freceipt->quantity * $freceipt->price) }}</span>

                            </td>
                            <td>

                                {{ $freceipt->quantity }}

                            </td>
                            <td>

                                <span>{{ Money::format($freceipt->price) }}</span>

                            </td>
                            <td>

                                {{ $freceipt->product->name }}

                            </td>
                            <td>{{ $key + 1 }}</td>

                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
@endsection
