@extends('dashboard.index')
<style>
    td.day {
        color: white;
    }

    /*
    .datepicker {
        pointer-events: none
    } */

</style>

@section('content')
    <section class="content">
        <link rel="stylesheet" href="{{ asset('chart/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset('chart/plugins/jqvmap/jqvmap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('chart/dist/css/adminlte.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('chart/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('chart/plugins/daterangepicker/daterangepicker.css') }}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('chart/plugins/summernote/summernote-bs4.min.css') }}">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $productsNum }}</h3>

                        <p>{{ __('Product Number') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-bar-chart-o"></i>
                    </div>
                    <a href="{{ route('products.index') }}" class="small-box-footer">{{ __('More Info') }} <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $clientsNum }}</h3>

                        <p>{{ __('Number Of Clients') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="{{ route('definition.index') }}" class="small-box-footer">{{ __('More Info') }} <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $buyingNum }}</h3>

                        <p>{{ __('Number Of Purchase Invoices') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <a href="{{ route('buying.index') }}" class="small-box-footer">{{ __('More Info') }} <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner ">
                        <h3>{{ $saleNum }}</h3>

                        <p>{{ __('Number Of Sales Invoices') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="{{ route('reports-sale.index') }}" class="small-box-footer">{{ __('More Info') }} <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">


                        </h3>
                        <div class="card-tools">

                        </div>
                    </div><!-- /.card-header -->

                    <div class="card-body" style="height: 270px;">
                        <div class="tab-content p-0">
                            <div class="col-md-12 mt-3">
                                <p class="text-center">
                                    <strong>{{ __('Best Selling Products') }}</strong>
                                </p>
                                @foreach ($products as $product)
                                    <div class="progress-group">
                                        {{ $product->name }}
                                        <span
                                            class="float-right"><b>{{ $product->sold }}</b>/{{ $product->sum('sold') }}</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar
                                            @if (($product->sold / $product->sum('sold')) * 100 <= 20) bg-danger
                                                @elseif (($product->sold / $product->sum('sold')) * 100 >= 20 && ($product->sold / $product->sum('sold')) * 100 < 40) bg-warning
                                                @elseif (($product->sold / $product->sum('sold')) * 100 >= 40 && ($product->sold / $product->sum('sold')) * 100 < 60) bg-info
                                                @elseif (($product->sold / $product->sum('sold')) * 100 >= 60 && ($product->sold / $product->sum('sold')) * 100 < 80) bg-primary

                                                @else
                                                bg-success @endif
                                            "
                                                style="width: {{ ($product->sold / $product->sum('sold')) * 100 }}%">
                                            </div>


                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
            </section>

            <section class="col-lg-5 connectedSortable">
                <div class="card card-danger">
                    <div class="card-header ">
                        <h3 class="card-title ">{{ __('Sales Invoices') }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donut"
                            style="min-height: 210px; height: 210px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>


            </section>

        </div>


    </section>
    <div class="row">
        <section class="col-lg-7 connectedSortable">
            <div class="card bg-gradient-success">
                <div class="card-header border-0">

                    <h3 class="card-title">
                        <i class="far fa-calendar-alt"></i>
                        Calendar
                    </h3>
                    <!-- tools card -->
                    <div class="card-tools">

                        <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pt-0">
                    <!--The calendar -->
                    <div id="calendar" style="width: 100%;"></div>
                    {{-- <div id="dp5" style="width: 100%;" data-date="12-02-2013" data-date-format="dd-mm-yyyy"></div> --}}
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <label for="">المبيعات</label>
                        </div>
                        <div class="col-md-3">
                            <input id="sale" class="form-control mb-3" type="text" readonly>
                        </div>
                        <div class="col-md-3 text-center">
                            <label for="">صافي الربح</label>
                        </div>
                        <div class="col-md-3">
                            <input id="profit" class="form-control" type="text" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="col-lg-5 connectedSortable">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('Last 5 Sales Invoices') }}</h3>

                </div>
                <div class="card-body table-responsive p-0">

                    <table class="table table-striped table-valign-middle">
                        <thead>

                            <tr>
                                <th>#</th>
                                <th>{{ __('Customer Name') }}</th>
                                <th>{{ __('Total Bill') }}</th>
                                <th ">{{ __('Actions') }}</th>
                                     </tr>
                                </thead>
                                 <tbody>

                                         @foreach ($bills as $key=> $bill)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $bill->client_id ? $bill->client->name : 'مبيعات نقدية' }}
                                </td>

                                <td>{{ Money::format($bill->total) }}</td>
                                <td>
                                    <a href="{{ route('reports-sale.show', $bill->id) }}" class="text-muted">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </td>

                            </tr>
                            @endforeach


                            </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('chart/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('chart/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('chart/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('chart/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('chart/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('chart/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('chart/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('chart/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('chart/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('chart/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('chart/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('chart/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('chart/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('chart/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('chart/dist/js/demo.js') }}"></script>
    {{-- <script src="{{ asset('chart/docs/assets/js/pages/dashboard.js') }}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('chart/dist/js/pages/dashboard.js') }}"></script>
    <script>
        var cash = {{ $cash }};
        var debt = {{ $debt }};
        var donutChartCanvas = $('#donut').get(0).getContext('2d')
        var donutData = {
            labels: [
                'مبيعات نقدية',
                'مبيعات دين',

            ],
            datasets: [{
                data: [cash, debt],
                backgroundColor: ['#00a65a', '#f39c12'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    </script>
    <script>
        $('#calendar').datetimepicker({
            format: 'Y-m-d H:i',
            inline: true
        })

        // function clickHandler(target) {
        //     // Here, `this` refers to the element the event was hooked on
        //     if (this.classList.contains('day')) {
        //         console.log(this)

        //     }
        // }
        // document.querySelectorAll('td')
        //     .forEach(e => e.addEventListener("click", clickHandler));

        $('.datepicker').on('click', '.day', function() {
            let date = new Date();
            date = $(this).attr('data-day').split("/").reverse().join("-");
            // console.log(date)
            async function postData(url = '') {

                const response = await fetch(url, {
                    method: 'get', // *GET, POST, PUT, DELETE, etc.
                    mode: 'cors', // no-cors, *cors, same-origin
                    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                    credentials: 'same-origin', // include, *same-origin, omit
                    headers: {
                        'Content-Type': 'application/json'
                        // 'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    redirect: 'follow', // manual, *follow, error
                    referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url

                });
                return response.json(); // parses JSON response into native JavaScript objects

            }

            let url = "http://127.0.0.1:8000/calendars/" + date
            postData(url).then(data => {
                console.log(data)
                let getTotal = {
                    'tot': data[0],
                    'pro': data[1]

                }
                console.log(getTotal.tot)
                console.log(getTotal.pro)
                $('#sale').val(getTotal.tot);
                $('#profit').val(getTotal.pro);
            });


        })
    </script>
@endsection
