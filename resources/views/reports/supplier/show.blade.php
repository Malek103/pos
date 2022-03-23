@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center"> تقرير المورد {{ $client->name }}</h4>
                <table class="table table-borderless text-center" id="dynamicAddRemove">

                    <tr>


                        <td>
                            <h3 class="">
                                {{ $client->phone }}

                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                : {{ __('Supplier No') }}

                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                {{ $client->name }}


                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                : {{ __('supplier name') }}

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
                                : {{ __('Supplier Location') }}

                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                <span>{{ Money::format($client->account) }}</span>



                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                : {{ __('Supplier Balance') }}

                            </h3>
                        </td>
                    </tr>
                </table>
                @if (count($h_receipts) > 0)
                    <h3 class="text-center">{{ __('Purchase Invoices') }}</h3>
                @endif
                @foreach ($h_receipts as $h_receipt)
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="">
                                    <li> {{ $h_receipt->name }} :{{ __('Invoice Name') }}</li>
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="">

                                    <li>{{ Money::format($h_receipt->total) }} :{{ __('Total Bill') }}</li>
                                </h5>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered " id="dynamicAddRemove">
                        <tr class="text-right decoration-none text-center">
                            <th>{{ __('The Resulting') }}</th>
                            <th>{{ __('Product Quantity') }}</th>
                            <th>{{ __('Product Cost') }}</th>
                            <th>{{ __('Product Name') }}</th>
                            <th>#</th>
                        </tr>

                        @foreach ($h_receipt->fReceipts as $key => $fReceipt)
                            <tr class="text-center">
                                <td>

                                    <span>{{ Money::format($fReceipt->quantity * $fReceipt->cost) }}</span>

                                </td>
                                <td>

                                    {{ $fReceipt->quantity }}

                                </td>
                                <td>

                                    <span> {{ Money::format($fReceipt->cost) }}</span>

                                </td>
                                <td>

                                    {{ $fReceipt->product->name }}

                                </td>
                                <td>{{ $key + 1 }}</td>

                            </tr>
                        @endforeach
                    </table>
                    <hr>
                @endforeach
                @if (count($debentures) > 0)
                    <h3 class="text-center">سندات الصرف</h3>
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

                                    سند صرف

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
