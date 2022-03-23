@csrf
<div class="form-row text-right">
    <div class="col-md-12">
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <x-form.input tabindex="2" placeholder="الباركود" name="barcode"
                        label="{{ __('Product Barcode') }}" :value="$product->barcode" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <x-form.input tabindex="1" placeholder="اسم المنتج" name="name" id="name"
                        label="{{ __('Product Name') }}" :value="$product->name" />
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-12">
        <div class="form-row">
            <div class="col-md-4">
                <div class="mb-3 d-flex justify-content-center align-items-center">
                    <input tabindex="5" type="checkbox" id="favare" name="favare"
                        @if (old('favare', $product->favare)) checked @endif />
                    <label class="mt-4 mx-5 h3" for="favare">{{ __('Favorite') }}</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-3">
                    <select tabindex="4" style="margin-top: 22px" class="form-control text-right" id="status"
                        name="status">
                        <option value="active" @if ($product->status == 'active') selected @endif>{{ __('Active') }}
                        </option>
                        <option value="inactive" @if ($product->status == 'inactive') selected @endif>
                            {{ __('In Active') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-3">
                    <x-form.input tabindex="3" type="number" min="0" step="0.5" placeholder="سعر المنتج" name="price"
                        id="price" label="{{ __('Price') }}" :value="$product->price" />
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <div class="form-group mb-3 text-center">
                    <label for="image">

                        <img tabindex="6" src="{{ $product->image_url }}" alt="{{ $product->image }}" id="thum"
                            width="400" height="400">

                    </label>
                    <div class="mb-2">

                    </div>
                    <input style="display: none" type="file" id="image" name="image"
                        class="form-control @error('image') is-invalid @enderror"
                        onchange="document.getElementById('thum').src=window.URL.createObjectURL(this.files[0])">
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror


                </div>
            </div>

        </div>
    </div>

</div>
<button tabindex="7" type="submit" class="btn btn-success btn-block">{{ $button }}</button>
<script>
    document.querySelector('#name').focus()
</script>
