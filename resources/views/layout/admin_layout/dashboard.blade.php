@extends('layout.main_layout.main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $jumlahKamar ?? '0' }}</h3>

                            <p>Jumlah Kamar</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $kamarTerisi ?? '0' }}</h3>

                            <p>Kamar Diisi</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-home"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $kamarKosong ?? '0' }}</h3>

                            <p>Kamar Kosong</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-home-outline"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Status Kamar</h3>

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
                            <canvas id="pieChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
@endSection

@section('script')
    <script>
        $(function() {
            const da = [@json($kamarTerisi), @json($kamarKosong)]
            var donutData = {
                labels: [
                    'Kosong',
                    'Terisi',
                ],
                datasets: [{
                    data: da,
                    backgroundColor: ['#f56954', '#00a65a'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }

            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })
        })
    </script>
@endSection
