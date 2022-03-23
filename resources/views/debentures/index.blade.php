@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">

            <div class="card-body">
                <form action="{{ route('receipt.search') }}" method="GET">
                    <div style="width: 300px">
                        <input tabindex="1" type="text" name="search" id="search"
                            placeholder=" ابحث عن قيمة السنداو نوع السند او اسم العميل" class="form-control">
                    </div>
                </form>
                <h4 class="card-title text-center">{{ __('Bond Table') }}</h4>
                <div class="container">
                    <div class="row">


                        <div class="col-md-3">
                            <a href="{{ route('delete.receipt') }}" class="btn btn-danger btn-block "
                                style="width: 200px"><i class="fas fa-trash mr-1"></i>{{ __('Deleted Bonds') }}
                            </a>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3 float-right mb-3">
                            <a href="{{ route('receipt.create') }}" class="btn btn-primary btn-block "
                                style="width: 200px"><i class="fas fa-plus mr-1"></i>{{ __('Add A Receipt Voucher') }}</a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('catching.create') }}" class="btn btn-primary btn-block "
                                style="width: 200px"><i class="fas fa-plus mr-1"></i>
                                {{ __('Add A Voucher') }}</a>
                        </div>
                    </div>
                </div>



                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>

                            <tr>
                                <th>#</th>
                                <th>{{ __('Client Name') }}</th>
                                <th>{{ __('Receipt Amount') }}</th>
                                <th>{{ __('Receipt Type') }}</th>
                                <th>{{ __('Receipt Date') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>


                            </tr>
                        </thead>
                        <tbody>
                            @if (count($debentures) > 0)
                                @foreach ($debentures as $key => $debenture)
                                    <tr>

                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $debenture->client->name }}</td>
                                        @if ($debenture->type === 'catch')
                                            <td class="text-danger"> {{ Money::format($debenture->amount) }} <i
                                                    class="ti-arrow-down"></i></td>
                                        @else
                                            <td class="text-success"> {{ Money::format($debenture->amount) }}<i
                                                    class="ti-arrow-up"></i></td>
                                        @endif
                                        @if ($debenture->type === 'catch')
                                            <td><span class="badge badge-danger"><span>سند صرف</span></span>
                                            </td>
                                        @else
                                            <td><span class="badge badge-success"><span>سند قبض</span></span>
                                            </td>
                                        @endif
                                        <td>
                                            {{ date('d-m-Y', strtotime($debenture->created_at)) }}

                                        </td>

                                        @if ($debenture->status === 'notdeleted')
                                            <td>

                                                <div class="row text-center">
                                                    <div class="col-md-12">

                                                        <button type="button" class="btn btn-outline-danger"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $debenture->id }}">
                                                            <i class="fas fa-trash"></i>
                                                            {{ __('Delete') }}
                                                        </button>
                                                        <div class="modal fade" id="deleteModal{{ $debenture->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header d-flex flex-nowrap">

                                                                        <button type="button" class="close order-2"
                                                                            data-dismiss="modal" aria-label="Close"><span
                                                                                aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title text-dark order-1"
                                                                            id="myModalLabel">
                                                                            {{ __('Delete the bond') }}
                                                                        </h4>
                                                                    </div>
                                                                    <div class="modal-body text-dark">
                                                                        {{ __('Are you sure you want to delete') }}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form id="userForm"
                                                                            action="{{ route('receipt.destroy', $debenture->id) }}"
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

                                                </div>


                                            </td>
                                        @endif
                                @endforeach
                            @else
                                <div class="alert alert-warning text-center" role="alert">
                                    {{ __('There are no bonds !') }}
                                </div>
                            @endif

                        </tbody>
                    </table>
                    {!! $debentures->links() !!}
                </div>

            </div>
        </div>
    </div>
    <script>
        document.querySelector('#search').focus()
    </script>

@endsection
