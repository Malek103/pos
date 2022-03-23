@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">تعديل منتج</h4>
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @method('put')

                    @include('definition.product.__form',[
                    'button'=>'تعديل'])
                </form>


            </div>
        </div>
    </div>
@endsection
