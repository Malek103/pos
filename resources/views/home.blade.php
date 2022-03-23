@extends('dashboard.index')

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
                    <div class="inner text-right">
                        <h3>{{ $productsNum }}</h3>

                        <p>{{ __('Product Number') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('products.index') }}" class="small-box-footer">{{ __('More Info') }} <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner text-right">
                        <h3>{{ $clientsNum }}</h3>

                        <p>{{ __('Number Of Clients') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('definition.index') }}" class="small-box-footer">{{ __('More Info') }} <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner text-right">
                        <h3>{{ $buyingNum }}</h3>

                        <p>{{ __('Number Of Purchase Invoices') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('buying.index') }}" class="small-box-footer">{{ __('More Info') }} <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner text-right">
                        <h3>{{ $saleNum }}</h3>

                        <p>{{ __('Number Of Sales Invoices') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
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
@endsection
