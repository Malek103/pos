@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">

            <div class="card-body">
                <form action="{{ route('invoice.search') }}" method="GET">
                    <div style="width: 300px">
                        <input tabindex="1" type="text" name="search" id="search"
                            placeholder=" ابحث عن اسم المنتج او سعر المنتج او كمية المنتج" class="form-control">
                    </div>
                </form>
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-md-3"><a href="{{ route('delete.show') }}" class="btn btn-danger btn-block"
                                style="width: 200px"><i class="fas fa-trash mr-1"></i>{{ __('Deleted Invoices') }}
                            </a></div>

                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"><a href="{{ route('buying.create') }}"
                                class="btn btn-primary btn-block " style="width: 200px"><i
                                    class="fas fa-plus mr-1"></i>{{ __('Add A Purchase Invoice') }}
                            </a></div>

                    </div>
                </div>
                <h4 class="card-title text-center">{{ __('Purchase Invoices Table') }}</h4>




                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>

                            <tr>
                                <th>#</th>
                                <th>{{ __('Invoice Name') }}</th>
                                <th>{{ __('Client Name') }}</th>
                                <th>{{ __('Total Bill') }}</th>
                                <th>{{ __('Discount') }}</th>
                                <th>{{ __('Invoice Creation Date') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>


                            </tr>
                        </thead>
                        <tbody>
                            @if (count($receipts) > 0)
                                @foreach ($receipts as $key => $receipt)
                                    <tr>

                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $receipt->name }}</td>
                                        <td>{{ $receipt->client->name }}</td>

                                        <td><span
                                                class="badge badge-secondary"><span>{{ Money::format($receipt->total) }}</span></span>
                                        </td>

                                        <td><span
                                                class="badge badge-info"><span>{{ Money::format($receipt->discount) }}</span></span>
                                        </td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($receipt->created_at)) }}

                                        </td>





                                        <td>
                                            <div class="row text-center">
                                                @if ($receipt->status === 'notdeleted')
                                                    <div class="col-md-6">
                                                        <a tabindex="3" href="{{ route('buying.show', $receipt->id) }}"
                                                            class="btn btn-info"><i
                                                                class="fas fa-eye mr-2"></i>{{ __('Show') }}</a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-outline-danger"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $receipt->id }}">
                                                            <i class="fas fa-trash"></i>
                                                            {{ __('Delete') }}
                                                        </button>
                                                        <div class="modal fade" id="deleteModal{{ $receipt->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header d-flex flex-nowrap">

                                                                        <button type="button" class="close order-2"
                                                                            data-dismiss="modal" aria-label="Close"><span
                                                                                aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title text-dark order-1"
                                                                            id="myModalLabel">
                                                                            {{ __('Delete Invoice') }}</h4>
                                                                    </div>
                                                                    <div class="modal-body text-dark">
                                                                        {{ __('Are you sure you want to delete') }}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form id="userForm"
                                                                            action="{{ route('buying.destroy', $receipt->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="hidden" name="id">
                                                                            <button type="button" class="btn btn-default"
                                                                                data-dismiss="modal">{{ __('Close') }}</button>
                                                                            <button type="submit"
                                                                                class="btn btn-outline-danger">{{ __('Delete') }}</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-md-12">
                                                        <a tabindex="3" href="{{ route('buying.show', $receipt->id) }}"
                                                            class="btn btn-info"><i
                                                                class="fas fa-eye mr-2"></i>{{ __('Show') }}</a>
                                                    </div>
                                                @endif

                                            </div>
                                        </td>
                                @endforeach
                            @else
                                <div class="alert alert-warning text-center" role="alert">
                                    {{ __('No bills !') }}
                                </div>
                            @endif

                        </tbody>
                    </table>
                    {!! $receipts->links() !!}
                </div>

            </div>
        </div>
    </div>
    <script>
        document.querySelector('#search').focus()
    </script>

@endsection
