@csrf
<div class="form-row text-right">
    <div class="col-md-12">
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <x-form.input placeholder="رقم العميل" tabindex="2" name="phone" label="رقم العميل"
                        :value="$client->phone" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <x-form.input placeholder="اسم العميل" tabindex="1" name="name" id="name" label="اسم العميل"
                        :value="$client->name" required />
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="gender">{{ __('Gender') }}</label>
                    <select tabindex="5" class="form-control text-right" id="gender" name="gender">
                        <option value="male" @if ($client->gender == 'male') selected @endif>{{ __('Male') }}
                        </option>
                        <option value="female" @if ($client->gender == 'female') selected @endif>{{ __('Female') }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="gender">{{ __('Customer Type') }}</label>
                    <select tabindex="4" class="form-control text-right" id="type" name="type">
                        <option value="customer" @if ($client->type == 'customer') selected @endif>
                            {{ __('Customer') }}</option>
                        <option value="supplier" @if ($client->type == 'supplier') selected @endif>
                            {{ __('Supplier') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-3">
                    <x-form.input class="mt-2" tabindex="3" placeholder="مكان العميل" name="place"
                        label="{{ __('Client Place') }}" :value="$client->place" />
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-3">
            <x-form.textarea tabindex="6" label="{{ __('Description') }}" class="text-right" name="description"
                :value="$client->description" />
        </div>
    </div>


</div>
<button tabindex="7" tabindex="7" type="submit" class="btn btn-success btn-block">{{ $button }}</button>
<script>
    document.querySelector('#name').focus()
</script>
