@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">{{ __('Create An Invoice') }}</h4>
                <form action="{{ route('buying.store') }}" method="POST">
                    @method('POST')
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-2 text-center" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="close" data-bs-dismiss="alert"
                                aria-label="Close">&times;</button>
                        </div>
                    @endif
                    @if (Session::has('required'))
                        <div class="alert alert-danger alert-dismissible fade show mt-2 text-center" role="alert">
                            {{ Session::get('required') }}
                            <button type="button" class="close" data-bs-dismiss="alert"
                                aria-label="Close">&times;</button>
                        </div>
                    @endif
                    <div class="col-md-12">
                        <div class="form-row text-right">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label style="font-size: 20px" for="client_id">{{ __('Client Name') }}</label>
                                    <select tabindex="2" name="client_id" id="client_id" required
                                        class="form-control  text-right @error('client_id') is-invalid @enderror">
                                        <option class="h4" value="">{{ __('Choose A Supplier') }}
                                        </option>
                                        @foreach ($clients as $client)
                                            <option class="h4" value="{{ $client->id }}"
                                                @if ($client->id == old('client_id', $client->client_id)) selected @endif>{{ $client->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('product_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label style="font-size: 20px" for="name">{{ __('Invoice Name') }}</label>
                                    <input tabindex="1" type="text" name="name" id="invoiceName" placeholder="أسم  الفاتوره"
                                        class="form-control text-right" value="{{ old('invoiceName') }}" required />
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row text-right">
                            <div class="col-md-6">
                                <div class="form-group mb-3">

                                    <label style="font-size: 20px" for="discount">{{ __('Discount') }}</label>
                                    <input tabindex="3" type="number" step="0.1" min="0" name="discount" id="discount"
                                        placeholder="الخصم" class="form-control form-control-lg text-right"
                                        value="{{ old('discount') }}" />
                                    @error('discount')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label style="font-size: 20px" for="total">{{ __('Total Bill') }}</label>
                                    <input type="number" name="total" id="total" placeholder="مجموع الفاتوره"
                                        class="form-control form-control-lg text-right" value="{{ old('total') }}"
                                        readonly />
                                </div>

                            </div>

                        </div>
                    </div>



                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr class="text-right decoration-none">
                            <th>
                                {{ __('Delete') }}
                            </th>
                            <th>{{ __('Product Quantity') }}</th>
                            <th>{{ __('Product Cost') }}</th>
                            <th>{{ __('Product Name') }}</th>
                        </tr>
                        <tr class="text-center">
                            <td>
                            </td>
                            <td>

                                <input tabindex="6" type="number" step="0.1" min="0" name="addmore[0][quantity]"
                                    placeholder="كمية المنتج" class="form-control prc text-right " id="quantity[0]"
                                    onfocusout="addtotal(this)" required />

                            </td>
                            <td>

                                <input tabindex="5" type="number" step="0.1" min="0" name="addmore[0][cost]"
                                    placeholder="تكلفة المنتج" class="form-control prc text-right" id="cost[0]" required />

                            </td>
                            <td>

                                <select tabindex="4" name="addmore[0][product_id]" id="product_id" required
                                    class="form-control text-right @error('product_id') is-invalid @enderror">
                                    <option value="">اختار منتج</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            @if ($product->id == old('product_id', $product->category_id)) selected @endif>{{ $product->name }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('product_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                            </td>

                        </tr>
                    </table>
                    <div class="text-center mt-3 row">
                        <button tabindex="7" type="button" name="add" id="dynamic-ar"
                            class="btn btn-outline-primary col mx-2">{{ __('Add Another Field') }}
                            </button>
                        <button tabindex="8" type="submit"
                            class="btn btn-success form-control col mx-2">{{ __('Add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('#invoiceName').focus()
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script>
        var sum = 0;
        let total = 0;
        let totalArr = []


        function addtotal(x) {
            let discount = document.getElementById('discount').value;

            let index = parseInt(x.getAttribute('id').replace('quantity[', ' ').replace(']', ' '))

            let amount = document.getElementById('cost[' + index + ']');
            total = parseInt(x.value) * parseInt(amount
                .value);
            if (index > totalArr.lenght) {
                totalArr.push(total);

            } else {

                totalArr[index] = total;

            }

            getSum()
            $('#total').val(sum - discount);
            // console.log(total);
        }

        function getSum() {
            sum = 0
            totalArr.forEach(element => {
                sum += element;
            });
            return sum
        }
    </script>
    <script type="text/javascript">
        var i = 1;
        $("#dynamic-ar").click(function() {
            $("#dynamicAddRemove").append(
                `<tr><td class="text-center"><button id="${i}" type="button" class="btn btn-outline-danger remove-input-field">أحذف الحقل</button></td><td><input type="number" step="0.1" min="0" name="addmore[${i}][quantity]" id="quantity[${i}]" onfocusout="addtotal(this)" placeholder="كمية المنتج" class="form-control text-right" /></td>
                    <td><input type="number" step="0.1" min="0" name="addmore[${i}][cost]" id="cost[${i}]" placeholder="تكلفة المنتج" class="form-control text-right" /></td>
                    <td><select  name="addmore[${i}][product_id]" id="product_id" class="form-control text-right @error('product_id') is-invalid @enderror"> <option value="">اختار المنتج</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" @if ($product->id == old('product_id', $product->category_id)) selected @endif>{{ $product->name }}
                    </option>
                @endforeach < /td></tr > `

            );
            ++i;
        });
        $(document).on('click', '.remove-input-field', function() {
            let i = $(this).attr('id')
            console.log(i)
            $(this).parents('tr').remove();

            totalArr[i] = 0
            getSum()
            $('#total').val(sum);
            console.log(totalArr)
        });
    </script>
    <script src="jquery-3.5.0.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        let total = 0;
        let totalArr = []


        function addtotal(x) {
            let discount = document.getElementById('discount').value;

            let index = parseInt(x.getAttribute('id').replace('quantity[', ' ').replace(']', ' '))

            let amount = document.getElementById('cost[' + index + ']');
            total = parseInt(x.value) * parseInt(amount
                .value);
            if (index > totalArr.lenght) {
                totalArr.push(total);

            } else {

                totalArr[index] = total;

            }
            let sum = 0;
            totalArr.forEach(element => {
                sum += element;
            });
            $('#total').val(sum - discount);
            // console.log(total);
        }
    </script>
@endsection
