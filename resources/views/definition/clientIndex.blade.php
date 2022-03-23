@extends('dashboard.index')

@section('content')
    <div class="container">
        <div class="card">

            <div class="card-body">
                <form action="{{ route('client.search') }}" method="GET">
                    <div style="width: 300px">
                        <input tabindex="1" type="text" name="search" id="search"
                            placeholder=" ابحث عن اسم العميل او رقم العميل او رصيده" class="form-control">
                    </div>
                </form>
                <h4 class="card-title text-center">{{ __('Customer Table') }}جدول العملاء</h4>
                <a href="{{ route('definition.create') }}" class="btn btn-primary btn-block float-right mb-3"
                    style="width: 200px"><i class="fas fa-plus mr-1"></i>{{ __('Add Customer') }}</a>


                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>

                            <tr>
                                <th> # </th>
                                <th>{{ __('Customer Name') }}</th>
                                <th> {{ __('Customer Number') }} </th>
                                <th> {{ __('Customer Type') }} </th>
                                <th> {{ __('Customer Balance') }} </th>
                                <th> {{ __('Place') }} </th>
                                <th>{{ __('Gender') }} </th>
                                <th>{{ __('Description') }}

                                </th>
                                <th class="text-center">
                                    {{ __('Actions') }}
                                </th>


                            </tr>
                        </thead>
                        <tbody>
                            @if (count($clients) > 0)
                                @foreach ($clients as $key => $client)
                                    <tr>

                                        <td>{{ $key + 1 }}
                                        </td>
                                        <td>{{ $client->name }}
                                        </td>
                                        <td>{{ $client->phone ? $client->phone : 'لا يوجد رقم للعميل' }}
                                        </td>
                                        <td>
                                            @if ($client->type === 'customer')
                                                <label class="badge badge-info">{{ __('Customer') }}</label>
                                            @else
                                                <label class="badge badge-warning">{{ __('Supplier') }}</label>
                                            @endif
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
                                        <td><label>{{ $client->place ? $client->place : 'لا يوجد مكان' }}</label>
                                        </td>
                                        <td>
                                            @if ($client->gender === 'male')
                                                <label class="badge badge-secondary">
                                                    {{ __('Male') }}
                                                </label>
                                            @else
                                                <label class="badge badge-dark">
                                                    {{ __('Female') }}
                                                </label>
                                            @endif
                                        </td>
                                        <td>{{ $client->description ? $client->description : 'لا يوجد وصف' }}
                                        </td>

                                        <td>
                                            <div class="row text-center">
                                                <div class="col-md-6">
                                                    <a tabindex="3" href="{{ route('definition.edit', $client->id) }}"
                                                        class="btn btn-primary"><i
                                                            class="fas fa-edit"></i>{{ __('Edit') }}</a>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                                        data-target="#deleteModal{{ $client->id }}">
                                                        <i class="fas fa-trash"></i>
                                                        {{ __('Delete') }}
                                                    </button>
                                                    <div class="modal fade" id="deleteModal{{ $client->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header d-flex flex-nowrap">

                                                                    <button type="button" class="close order-2"
                                                                        data-dismiss="modal" aria-label="Close"><span
                                                                            aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title text-dark order-1"
                                                                        id="myModalLabel">{{ __('Remove Client') }}حذف
                                                                        العميل</h4>
                                                                </div>
                                                                <div class="modal-body text-dark">
                                                                    {{ __('Are you sure you want to delete') }}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form id="userForm"
                                                                        action="{{ route('definition.destroy', $client->id) }}"
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
                                @endforeach
                            @else
                                <div class="alert alert-warning text-center" role="alert">
                                    {{ __('There is no client!') }}

                                </div>
                            @endif

                        </tbody>
                    </table>

                    {!! $clients->links() !!}

                </div>
            </div>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript">
        < /scrip> <
        script src = "{{ asset('js/client.js') }}" >
    </script>

    <script>
        document.querySelector('#search').focus()
    </script>
@endsection
