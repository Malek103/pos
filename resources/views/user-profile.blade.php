@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">{{ __('Settings') }}</h4>
                <form action="{{ route('profile.update') }}" method="POST">
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


                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label style="font-size: 20px" for="name">{{ __('User Email') }}</label>
                                    <input tabindex="1" type="text" name="email" id="email"
                                        placeholder={{ __('User Email') }}" class="form-control text-right"
                                        value="{{ $user->email }}" required />
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label style="font-size: 20px" for="name">{{ __('User Name') }}</label>
                                    <input tabindex="1" type="text" name="name" id="name"
                                        placeholder="{{ __('User Name') }}" class="form-control text-right"
                                        value="{{ $user->name }}" required />
                                </div>

                            </div>

                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-row text-right">
                            <div class="col-md-6">


                            </div>

                            <div class="col-md-6">
                                <a href="{{ route('index.password') }}">
                                    <h4>تغير كلمة السر</h4>
                                </a>

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
