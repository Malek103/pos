@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">{{ __('Password Settings') }}</h4>
                <form action="{{ route('change.password') }}" method="POST">
                    @method('patch')
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
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label style="font-size: 20px" for="name">{{ __('Confirm Password') }}</label>
                                    <input tabindex="3" type="password" name="password_confirmation" id="password-confirm"
                                        placeholder="{{ __('Confirm Password') }}" class="form-control text-right"
                                        required />
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label style="font-size: 20px" for="name">{{ __('New Password') }}</label>
                                    <input tabindex="2" type="password" name="new_password" id="new_password"
                                        placeholder="{{ __('New Password') }}" class="form-control text-right" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label style="font-size: 20px" for="name">{{ __('Password') }}</label>
                                    <input tabindex="1" type="password" name="password" id="password"
                                        placeholder="{{ __('New Password') }}" class="form-control text-right"
                                        required />
                                </div>

                            </div>
                            <button tabindex="8" type="submit"
                                class="btn btn-primary form-control col mx-2">{{ __('Edit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('#invoiceName').focus()
    </script>
@endsection
