@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">

            <div class="card-body">
                <form action="{{ route('reports.product.search') }}" method="GET">
                    <div style="width: 300px">
                        <input tabindex="1" type="text" name="search" id="search" placeholder=" ابحث عن اسم المنتج "
                            class="form-control">
                    </div>
                </form>
                <h4 class="card-title text-center">{{ __('Products Report') }}</h4>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>

                            <tr>
                                <th>#</th>
                                <th>{{ __('Product Name') }}</th>
                                <th>{{ __('Sold Quantity') }}</th>
                                <th>{{ __('Total Profit') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($products) > 0)
                                @foreach ($products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $product->name }}
                                        </td>

                                        <td><span class="badge badge-info">{{ $product->sold }}</span>
                                        </td>
                                        <td class="text-success">{{ Money::format($product->profits) }}
                                            <i class="ti-arrow-up"></i>
                                        </td>
                                @endforeach
                            @else
                                <div class="alert alert-warning text-center" role="alert">
                                    {{ __('There are no items !') }}
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
