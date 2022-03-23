@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">{{ __('Create A Product') }}</h4>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @include('definition.product.__form', [
                        'button' => 'انشاء',
                    ])
                </form>


            </div>
        </div>
    </div>
@endsection
