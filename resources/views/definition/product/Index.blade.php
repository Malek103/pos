@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <form action="{{ route('product.search') }}" method="GET">
                    <div style="width: 300px">
                        <input type="text" name="search" id="search"
                            placeholder=" ابحث عن اسم المنتج او سعر المنتج او كمية المنتج" class="form-control">
                    </div>
                </form>
                <h4 class="card-title text-center">{{ __('Products Table') }}</h4>
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-block float-right mb-3"
                    style="width: 200px"><i class="fas fa-plus mr-1"></i>{{ __('Add Product') }}
                </a>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>

                            <tr>
                                <th>#</th>
                                <th>{{ __('Product Name') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Cost') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>


                            </tr>
                        </thead>
                        <tbody>
                            @if (count($products) > 0)
                                @foreach ($products as $key => $product)
                                    <tr>

                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <span
                                                class="badge badge-info"><span>{{ Money::format($product->price) }}</span></span>
                                        </td>

                                        <td>
                                            <span
                                                class="badge badge-secondary"><span>{{ Money::format($product->cost) }}</span></span>
                                        </td>

                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            @if ($product->status === 'active')
                                                <label class="badge badge-primary">{{ __('Active') }}</label>
                                            @else
                                                <label class="badge badge-danger">{{ __('In Active') }}</label>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="row text-center">
                                                <div class="col-md-6">
                                                    <a tabindex="3" href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-primary"><i
                                                            class="fas fa-edit"></i>{{ __('Edit') }}</a>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                                        data-target="#deleteModal{{ $product->id }}">
                                                        <i class="fas fa-trash"></i>
                                                        حذف
                                                    </button>
                                                    <div class="modal fade" id="deleteModal{{ $product->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header d-flex flex-nowrap">

                                                                    <button type="button" class="close order-2"
                                                                        data-dismiss="modal" aria-label="Close"><span
                                                                            aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title text-dark order-1"
                                                                        id="myModalLabel">{{ __('Delete Product') }}حذف
                                                                        المنتج</h4>
                                                                </div>
                                                                <div class="modal-body text-dark">
                                                                    {{ __('Are you sure you want to delete') }}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form id="userForm"
                                                                        action="{{ route('products.destroy', $product->id) }}"
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
                                    {{ __('There are no products !') }} ! لا يوجد منتجات
                                </div>
                            @endif

                        </tbody>
                    </table>
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('#search').focus()
    </script>
@endsection
