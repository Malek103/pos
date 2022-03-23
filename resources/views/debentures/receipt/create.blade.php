@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">

            <div class="card-body">
                <div style="width: 300px">
                </div>
                <h4 class="card-title text-center">انشاء سند قبض</h4>
                <form action="{{ route('receipt.store') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="col-md-12">
                        <div class="form-row text-right">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label style="font-size: 20px" for="client_id">: المبلغ </label>
                                    <input tabindex="2" type="number" step="0.5" min="0.5" name="amount" id="amount"
                                        placeholder="المبلغ" class="form-control text-right" value="{{ old('amount') }}"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label style="font-size: 20px" for="client_id">اسم العميل</label>
                                    <select tabindex="1" name="client_id" id="client_id" required
                                        class="form-control  text-right @error('client_id') is-invalid @enderror">
                                        <option class="h4" value="">اختار الزبون</option>
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
                        </div>
                    </div>
                    <div class="text-center mt-3 row">

                        <button tabindex="3" type="submit" class="btn btn-success form-control col mx-2">انشأ</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        document.querySelector('#client_id').focus()
    </script>
@endsection
