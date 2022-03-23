@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">

            <div class="card-body">
                <form action="{{ route('sale.search') }}" method="GET">
                    <div style="width: 300px">
                        <input tabindex="1" type="text" name="search" id="search"
                            placeholder=" ابحث عن اسم الذمة او مجموع الفاتورة" class="form-control">
                    </div>
                </form>
                <h4 class="card-title text-center">{{ __('Sales Report') }}</h4>
                <div class="form-group row my-2">
                    <div class="col-md-4">


                    </div>
                    <div class="col-md-8">
                        <form action="{{ route('reports-sale.index') }}" method="GET" class="my-3">
                            @csrf
                            <div>
                                <button type="submit" class="btn btn-info w-25 mx-3" tabindex="6">{{ __('Reset History') }}
                                </button>
                                <label>
                                    <input style="height: 40px" type="date" name="endDate" tabindex="5">
                                    &nbsp;
                                    {{ __('To Date') }}

                                </label>
                                <label>

                                    <input style="height: 40px" type="date" name="startDate" tabindex="4">
                                    &nbsp;
                                    {{ __('From The Date Of') }}
                                </label>

                            </div>


                        </form>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>

                            <tr>
                                <th>#</th>
                                <th>اسم الذمة</th>
                                <th>{{ __('Total Bill') }}</th>
                                <th>{{ __('Total Discount :') }}</th>
                                <th>{{ __('Invoice Date') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($fheceipts) > 0)
                                @foreach ($fheceipts as $key => $fheceipt)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $fheceipt->client_id ? $fheceipt->client->name : 'مبيعات نقدية' }}
                                        </td>

                                        <td>{{ Money::format($fheceipt->total) }}</td>
                                        <td>{{ Money::format($fheceipt->discount) }}</td>
                                        <td>{{ $fheceipt->created_at }}
                                        </td>
                                        <td>
                                            <div class="row text-center">
                                                <div class="col-md-12">
                                                    <a tabindex="4"
                                                        href="{{ route('reports-sale.show', $fheceipt->id) }}"
                                                        class="btn btn-info"><span><i
                                                                class="fa fa-eye"></i></span></a>
                                                </div>

                                            </div>
                                        </td>
                                @endforeach
                            @else
                                <div class="alert alert-warning text-center" role="alert">{{ __('No sales invoices !') }}
                                </div>
                            @endif

                        </tbody>
                    </table>
                    {!! $fheceipts->links() !!}
                </div>

            </div>
        </div>
    </div>

    <script>
        document.querySelector('#search').focus()
    </script>
@endsection
