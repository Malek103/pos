@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">

            <div class="card-body">
                <form action="{{ route('supplier.search') }}" method="GET">
                    <div style="width: 300px">
                        <input tabindex="1" type="text" name="search" id="search"
                            placeholder=" ابحث عن قيمة السنداو نوع السند او اسم العميل" class="form-control">
                    </div>
                </form>
                <div class="col-md-4">


                </div>

                <h4 class="card-title text-center">تقرير الموردين</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>

                            <tr>
                                <th>#</th>
                                <th>{{ __('supplier name') }}</th>
                                <th>{{ __('Phone Number') }}</th>
                                <th>{{ __('Supplier Balance') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>


                            </tr>
                        </thead>
                        <tbody>
                            @if (count($clients) > 0)
                                @foreach ($clients as $key => $client)
                                    <tr>
                                        <td>{{ $key + 1 }}
                                        </td>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->phone ? $client->phone : 'لا يوجد رقم للعميل' }}
                                        </td>
                                        @if ($client->account > 0)
                                            <td class="text-success">
                                                {{ Money::format($client->account) }}
                                            </td>
                                        @else
                                            <td class="text-danger">
                                                {{ Money::format($client->account) }}
                                            </td>
                                        @endif
                                        {{-- <td>
                                            <div class="row text-center">
                                                <div class="col-md-12">
                                                    <a tabindex="4"
                                                        href="{{ route('reports-supplier.show', $client->id) }}"
                                                        class="btn btn-info"><span><i
                                                                class="fa fa-eye"></i></span></a>
                                                </div>

                                            </div>
                                        </td> --}}
                                        <td>
                                            <div class="row text-center">
                                                <div class="col-md-12">
                                                    <form action="{{ route('reports-supplier.show', $client->id) }}"
                                                        method="GET">
                                                        @csrf
                                                        @method('GET')
                                                        <button type="submit" class="btn btn-info"><span><i
                                                                    class="fa fa-eye"></i></button>
                                                        <label>
                                                            <input type="date" name="endDate" tabindex="5">
                                                            &nbsp;
                                                            {{ __('To Date') }}

                                                        </label>
                                                        <label>

                                                            <input type="date" name="startDate" tabindex="4">
                                                            &nbsp;
                                                            {{ __('From The Date Of') }}
                                                        </label>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                @endforeach
                            @else
                                <div class="alert alert-warning text-center" role="alert">
                                    {{ __('There Are No Suppliers !') }}
                                </div>
                            @endif

                        </tbody>
                    </table>
                    {!! $clients->links() !!}

                </div>

            </div>
        </div>
    </div>
    <script>
        $('.datepicker').datepicker({
            weekdaysShort: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            showMonthsShort: true
        })
    </script>
    <script>
        document.querySelector('#search').focus()
    </script>
@endsection
