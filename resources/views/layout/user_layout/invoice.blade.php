@extends('layout.main_layout.main')
@section('style')
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            /* Background semi-transparan */
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 100000;
            opacity: 0.5;
            /* Z-index tinggi untuk memastikan loader tampil di atas konten */
        }

        .dot-spinner {
            --uib-size: 2.8rem;
            --uib-speed: .9s;
            --uib-color: #183153;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            height: var(--uib-size);
            width: var(--uib-size);
        }

        .overlay::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            /* Background semi-transparan */
            z-index: -1;
            /* Z-index negatif untuk memastikan tidak tumpang tindih dengan konten */
        }

        .dot-spinner__dot {
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            height: 100%;
            width: 100%;
        }

        .dot-spinner__dot::before {
            content: '';
            height: 20%;
            width: 20%;
            border-radius: 50%;
            background-color: var(--uib-color);
            transform: scale(0);
            opacity: 0.5;
            animation: pulse0112 calc(var(--uib-speed) * 1.111) ease-in-out infinite;
            box-shadow: 0 0 20px rgba(18, 31, 53, 0.3);
        }

        .dot-spinner__dot:nth-child(2) {
            transform: rotate(45deg);
        }

        .dot-spinner__dot:nth-child(2)::before {
            animation-delay: calc(var(--uib-speed) * -0.875);
        }

        .dot-spinner__dot:nth-child(3) {
            transform: rotate(90deg);
        }

        .dot-spinner__dot:nth-child(3)::before {
            animation-delay: calc(var(--uib-speed) * -0.75);
        }

        .dot-spinner__dot:nth-child(4) {
            transform: rotate(135deg);
        }

        .dot-spinner__dot:nth-child(4)::before {
            animation-delay: calc(var(--uib-speed) * -0.625);
        }

        .dot-spinner__dot:nth-child(5) {
            transform: rotate(180deg);
        }

        .dot-spinner__dot:nth-child(5)::before {
            animation-delay: calc(var(--uib-speed) * -0.5);
        }

        .dot-spinner__dot:nth-child(6) {
            transform: rotate(225deg);
        }

        .dot-spinner__dot:nth-child(6)::before {
            animation-delay: calc(var(--uib-speed) * -0.375);
        }

        .dot-spinner__dot:nth-child(7) {
            transform: rotate(270deg);
        }

        .dot-spinner__dot:nth-child(7)::before {
            animation-delay: calc(var(--uib-speed) * -0.25);
        }

        .dot-spinner__dot:nth-child(8) {
            transform: rotate(315deg);
        }

        .dot-spinner__dot:nth-child(8)::before {
            animation-delay: calc(var(--uib-speed) * -0.125);
        }

        @keyframes pulse0112 {

            0%,
            100% {
                transform: scale(0);
                opacity: 0.5;
            }

            50% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
@endSection
@section('content')
    @php
        use Carbon\Carbon;

    @endphp
    <div class="overlay" id="loader" style="display: none">
        <div class="dot-spinner">
            <div class="dot-spinner__dot"></div>
            <div class="dot-spinner__dot"></div>
            <div class="dot-spinner__dot"></div>
            <div class="dot-spinner__dot"></div>
            <div class="dot-spinner__dot"></div>
            <div class="dot-spinner__dot"></div>
            <div class="dot-spinner__dot"></div>
            <div class="dot-spinner__dot"></div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div id="snap-container"></div>
                    </div>
                    <div class="row">
                        @if ($data)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-info"></i> Note:</h5>
                                    Anda Harus membayar sebelum tanggal akhir sewa agar Tanggal Otomatis diUpdate
                                    <div class="text-left">
                                        <p class="text-muted text-sm" id="jeda" data-exp="{{ $data->kostExpired_at }}">
                                            <b>Sisa Waktu:</b><b id="sisa"></b>
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <a href="#" class="btn btn-sm btn-success" onclick="bayar(this)"
                                            style="color: white; text-decoration:none" data-id="{{ $data->kostId }}"
                                            data-amount="{{ $data->kamarHarga }}" data-nama="{{ $data->nama }}"
                                            data-email="{{ $data->email }}" data-telpon="{{ $data->telpon }}">
                                            Perpanjang sekarang
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-8 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">

                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <h2 class="lead"><b>Kamar {{ $data->kamarNomor }}</b></h2>
                                                <p class="text-muted text-sm"><b>Fasilitas:
                                                        {{ str_replace(',', ', ', $data->kamarFitur) }}</b>
                                                </p>
                                                <p class="text-muted text-sm"><b>Harga:</b><b id="harga">
                                                        {{ $data->kamarHarga }}</b>
                                                </p>
                                                <hr>
                                                <p class="text-muted text-sm"><b>Mulai Sewa:
                                                    </b>{{ Carbon::parse($data->kostCreated_at)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                                </p>
                                                <p class="text-muted text-sm"><b>Akhir Sewa: </b>
                                                    {{ Carbon::parse($data->kostExpired_at)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">

                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-info"></i> Note:</h5>
                                    Anda Belum Memiliki Kamar
                                </div>
                            </div>
                        @endif
                    </div>

                </div>

                <!-- /.card-body -->
            </div>
        </div><!--/. container-fluid -->
    </section>
@endSection
@section('script')
    <script>
        $(function() {

            function idr() {
                const harga = $("#harga").text();
                const newText = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                }).format(harga);
                $("#harga").text(newText);
            }
            idr();

            const waktuExp = $('#jeda').data('exp');

            function hitungHari(tanggalTarget) {
                const tanggalTargetObj = new Date(tanggalTarget);
                const tanggalSekarangObj = new Date();
                const selisih = tanggalTargetObj - tanggalSekarangObj;
                const hari = Math.floor(selisih / (1000 * 60 * 60 * 24));
                console.log(tanggalSekarangObj)
                return hari;
            }
            const sisaHari = hitungHari(waktuExp);
            if (sisaHari > 0) {

                $('#sisa').text(sisaHari + " Hari")
            } else {
                $('#sisa').text(" Anda Telat " + Math.abs(sisaHari) + " Hari")
            }
        })

        function bayar(element) {
            $("#loader").show();
            const storeData = {
                id: $(element).data('id'),
                // amount: 1000,
                amount: $(element).data('amount'),
                nama: $(element).data('nama'),
                email: $(element).data('email'),
                telpon: $(element).data('telpon')
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('bayarkost') }}",
                data: {
                    'data': storeData
                },
                type: 'POST',
                dataType: 'json',
                success: function(result) {
                    $("#loader").hide();
                    const tokenSnap = result.data;

                    if (tokenSnap) {

                        openSnap(tokenSnap)
                    } else {
                        alert("Error")
                    }
                }
            });
        }

        function openSnap(token) {
            window.snap.pay(token, {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    console.log(result);
                    console.log({{ $data->kostId }});
                    const dataUp = {
                        id: {{ $data->kostId }}
                    }
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('successPayment') }}",
                        data: {
                            'data': dataUp
                        },
                        type: 'POST',
                        dataType: 'json',
                        success: function(result) {
                            console.log(result);
                            const res = result.data;
                            if (res) {
                                location.reload();
                            } else {
                                alert("Payment Unsuccessfull");
                            }
                        }
                    });
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        }
    </script>
@endSection
