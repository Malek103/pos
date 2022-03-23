@extends('dashboard.index')
<style>
    .imgs {
        width: 200px !important;
        height: 200px !important;
        margin-left: auto;
        margin-right: auto;
    }

    icon-shape {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        vertical-align: middle;
    }

    .icon-sm {
        width: 2rem;
        height: 2rem;

    }

</style>

@section('content')
    <div class="row">


        <div class="pos-content col-8">
            <div class="pos-content-container  h-100 p-4" data-scrollbar="true" data-height="100%">
                <div class="row gx-4 text-center">
                    @foreach ($products as $product)
                        <div class="col-xxl-2 col-md-3 col-sm-4 pb-4">

                            <div class="card h-100">
                                <div class="card-body h-100 p-1">
                                    <div class="d-none id">{{ $product->id }}</div>

                                    <div class="imgs" style="background-image: url({{ $product->ImageUrl }})">
                                    </div>
                                    <div class="info">
                                        <div id="name" class="name">{{ $product->name }}</div>
                                        <div class="price">
                                            {{ __('Price') }}:{{ Money::format($product->price) }}</div>
                                        <div class="qty">{{ __('Quantity') }}:{{ $product->quantity }}</div>
                                    </div>

                                </div>
                                <div class="card-arrow">
                                    <div class="card-arrow-top-left"></div>
                                    <div class="card-arrow-top-right"></div>
                                    <div class="card-arrow-bottom-left"></div>
                                    <div class="card-arrow-bottom-right"></div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
                {!! $products->links() !!}
            </div>
        </div>



        <div style="background-color: #e6e6ff" class="pos-sidebar col-4" id="pos-sidebar">

            <div class="m-3">
                <input type="text" name="search" id="search" placeholder="ابحث عن باركود المنتج"
                    class="form-control text-center">
            </div>
            <form method="POST" id="order_id">

                <div class="h-100 d-flex flex-column p-0">

                    <div class="pos-sidebar-header">
                        <div class="back-btn">
                            <button type="button" data-toggle-class="pos-mobile-sidebar-toggled" data-toggle-target="#pos"
                                class="btn">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                        </div>
                        <div style="font-size: 20px; font-family: Arial, Helvetica, sans-serif"
                            class="title text-center mb-3">
                            {{ __('Create A Sales Invoice') }}
                        </div>

                    </div>





                    <div class="pos-sidebar-body tab-content" data-scrollbar="true" data-height="100%">

                        <div class="tab-pane fade h-100 show active" id="newOrderTab">


                        </div>
                    </div>


                    <div class="pos-sidebar-footer">
                        <div class="mb-2 text-center">
                            <div class="text-center">
                                <input type="text" id="inputtotal" name="total" hidden value="">
                                <label id="total" class="flex-1 text-end h4 mb-0 text-center" value="0">₪
                                    0</label>
                                : {{ __('Total Bill') }}
                            </div>
                        </div>
                        <div class="text-center">
                            <div>:{{ __('Discount') }}<input id="discount" name="discount" class="input-group text-center"
                                    type="number" min="0" step="0.5" value="0" onkeyup="sumTotal()" />
                            </div>

                        </div>
                        <hr />
                        <div class="text-center mb-2 ">
                            <div>{{ __('The Amount:') }}</div>
                            <div id="sumtotal" class="text-center h2 mb-0">₪ 0</div>
                        </div>

                    </div>
                    <select style="width: 250px;margin-left: 130px" name="client_id" id="client_id"
                        class="form-control  text-right mb-3">
                        <option class="h4" value="">اختار الذمة</option>
                        @foreach ($clients as $client)
                            <option class="h4" value="{{ $client->id }}">{{ $client->name }}
                            </option>
                        @endforeach

                    </select>
                    <div class="container">
                        <div class="row">
                            <button type="button" id="add_order" style="width:250px" class="btn btn-info"><i
                                    class="fa fa-save" onclick="addOrder()">
                                    {{ __('Save The Invoice') }}</i>
                            </button>
                            <button style="width:250px" type="reset" class="btn btn-danger ml-1"><i class="fa fa-trash"
                                    onclick="deleteAllItem()"> {{ __('Delete Invoice') }}
                                </i>
                            </button>

                        </div>
                    </div>

                </div>
                <span class="text-center"></span>
            </form>
        </div>
        <div class="card-arrow">
            <div class="card-arrow-top-left"></div>
            <div class="card-arrow-top-right"></div>
            <div class="card-arrow-bottom-left"></div>
            <div class="card-arrow-bottom-right"></div>
        </div>
    </div>
    <script>
        document.querySelector('#search').focus()
    </script>
    <script src="{{ asset('js/sale.js') }}"></script>
@endsection
