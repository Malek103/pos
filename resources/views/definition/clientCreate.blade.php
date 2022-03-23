@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">{{ __('Create A Client') }}</h4>
                <form action="{{ route('definition.store') }}" method="POST">
                    @include('definition.__form', [
                        'button' => 'انشاء',
                    ])
                </form>


            </div>
        </div>
    </div>
@endsection
