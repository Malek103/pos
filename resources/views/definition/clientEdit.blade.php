@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">{{ __('Edit Client') }}</h4>
                <form action="{{ route('definition.update', $client->id) }}" method="POST">
                    @method('put')

                    @include('definition.__form', [
                        'button' => 'تعديل',
                    ])
                </form>


            </div>
        </div>
    </div>
@endsection
