@extends('dashboard.index')
<style>
    .receipt {
        list-style: none;
    }

    .receipt li {
        text-align: right;
        font-size: 1rem;
        font-weight: 600;
    }

</style>
@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center"> {{ __('Customer Report') }} {{ $client->name }}</h4>
                <table class="table table-borderless text-center" id="dynamicAddRemove">

                    <tr>


                        <td>
                            <h3 class="">
                                {{ $client->phone }}

                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                : {{ __('Phone Number') }}

                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                {{ $client->name }}


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
                                <span>{{ $client->place }}</span>


                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                : {{ __('Place') }}

                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                <span>{{ Money::format($client->account) }}</span>



                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                : {{ __('Customer Balance') }}

                            </h3>
                        </td>
                    </tr>
                </table>
                @if (count($h_receipts) > 0)
                    <h3 class="text-center">{{ __('Sales Invoices') }}</h3>
                @endif
                @foreach ($h_receipts as $h_receipt)
                    <table>
                        {{-- <tr>{{ $h_receipt->name }} :{{ __('Invoice Name') }}</tr> --}}
                    </table>
                    <table class="table table-bordered " id="dynamicAddRemove">
                        <tr class="text-right decoration-none text-center">
                            <th>{{ __('The Resulting') }}</th>
                            <th> {{ __('Product Quantity') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Product Name') }}</th>
                            <th>#</th>
                        </tr>

                        @foreach ($h_receipt->fReceipts as $key => $fReceipt)
                            <tr class="text-center">
                                <td>

                                    <span>{{ Money::format($fReceipt->quantity * $fReceipt->price) }}</span>

                                </td>
                                <td>

                                    {{ $fReceipt->quantity }}

                                </td>
                                <td>

                                    <span> {{ Money::format($fReceipt->price) }}</span>

                                </td>
                                <td>

                                    {{ $fReceipt->product->name }}

                                </td>
                                <td>{{ $key + 1 }}</td>

                            </tr>
                        @endforeach
                    </table>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">


                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">



                            </div>


                            <ul class="receipt">
                                <li>{{ Money::format($h_receipt->total) }} :مجموع الفاتورة</li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                @endforeach
                @if (count($debentures) > 0)
                    <h3 class="text-center">{{ __('Receipt') }}</h3>
                    <table class="table table-bordered " id="dynamicAddRemove">
                        <tr class="text-right decoration-none text-center">
                            <th>{{ __('Receipt Date') }}</th>
                            <th>{{ __('Receipt Amount') }}</th>
                            <th>{{ __('Receipt Type') }}</th>
                            <th>#</th>
                        </tr>

                        @foreach ($debentures as $key => $debenture)
                            <tr class="text-center">
                                <td>

                                    {{ $debenture->created_at }}

                                </td>
                                <td>

                                    <span> {{ Money::format($debenture->amount) }}</span>

                                </td>
                                <td>

                                    سند قبض

                                </td>
                                <td>{{ $key + 1 }}</td>

                            </tr>
                        @endforeach
                    </table>
                    <hr>
                @endif

            </div>
        </div>
    </div>
@endsection
