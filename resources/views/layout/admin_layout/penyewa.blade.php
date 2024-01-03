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
                <div class="card-header">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fas fa-check"></i>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fas fa-check"></i>
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>No Ktp</th>
                                <th>Gender</th>
                                <th>kontak Darurat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 1;
                            ?>
                            @foreach ($data as $da)
                                <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>{{ $da->nama }}
                                    </td>
                                    <td>{{ $da->email }}</td>
                                    <td> {{ $da->telpon }}</td>
                                    <td> {{ $da->ktp }}</td>
                                    <td> {{ $da->gender == 1 ? 'Laki - Laki' : 'Perempuan' }}</td>
                                    <td> {{ $da->kontak_darurat }}</td>

                                    <td>
                                        <button type="button" class="btn btn-warning btn-xs" style="width: 50%"
                                            id="editButton-{{ $da->id }}" data-toggle="modal"
                                            data-target="#modal-update-{{ $da->id }}"><i
                                                class="fas fa-edit"></i></button>
                                        <button type="button" class="btn  btn-danger btn-xs"
                                            style="margin-top: 0;width: 50%" id="deleteButton"
                                            onclick="hapus({{ $da->id }})"><i
                                                class="fas fa-solid fa-trash"></i></button>
                                        <form action="{{ route('deletePenyewa') }}" method="post"
                                            id="formHapus{{ $da->id }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $da->id }}">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!--/. container-fluid -->
    </section>
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Penyewa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addPenyewa') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 row">
                                <!-- text input -->
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>No KTP</label>
                                        <input type="text" class="form-control" placeholder="No KTP" name="ktp"
                                            minlength="16" maxlength="16">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" placeholder="Nama" name="nama">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 row">
                                <!-- text input -->
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" placeholder="Alamat Email"
                                            name="email">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Telpon</label>
                                        <input type="text" pattern="[0-9]+" class="form-control"
                                            placeholder="Nomor Telepon" name="telpon" maxlength="15">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 row">
                                <!-- text input -->
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Kontak Darurat</label>
                                        <input type="text" pattern="[0-9]+" class="form-control"
                                            placeholder="Kontak Darurat" name="kontak_darurat" maxlength="15">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="custom-select" name="gender">
                                            <option value="1">Laki - Laki</option>
                                            <option value="0">Wanita</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Jumlah Penghuni</label>
                                        <select class="custom-select" name="penghuni">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="simpanAdd">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    @foreach ($data as $da)
        <div class="modal fade" id="modal-update-{{ $da->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Penyewa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updatePenyewa') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $da->id }}">

                            <div class="row">
                                <div class="col-sm-12 row">
                                    <!-- text input -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>No KTP</label>
                                            <input type="text" class="form-control" placeholder="No KTP"
                                                name="ktp" minlength="16" maxlength="16"
                                                value="{{ $da->ktp }}" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" placeholder="Nama" name="nama"
                                                value="{{ $da->nama }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 row">
                                    <!-- text input -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" placeholder="Alamat Email"
                                                name="email" value="{{ $da->email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Telpon</label>
                                            <input type="text" pattern="[0-9]+" class="form-control"
                                                placeholder="Nomor Telepon" name="telpon" maxlength="15"
                                                value="{{ $da->telpon }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 row">
                                    <!-- text input -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kontak Darurat</label>
                                            <input type="text" pattern="[0-9]+" class="form-control"
                                                placeholder="Kontak Darurat" name="kontak_darurat" maxlength="15"
                                                value="{{ $da->kontak_darurat }}" required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="custom-select" name="gender">
                                                <option value="1" {{ $da->gender == 1 ? 'selected' : '' }}>Laki -
                                                    Laki</option>
                                                <option value="0" {{ $da->gender == 0 ? 'selected' : '' }}>Wanita
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Jumlah Penghuni</label>
                                            <select class="custom-select" name="penghuni">
                                                <option value="1" {{ $da->penghuni == 1 ? 'selected' : '' }}>1
                                                </option>
                                                <option value="2" {{ $da->penghuni == 2 ? 'selected' : '' }}>2
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach
@endSection

@section('script')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                    "text": "Tambah Penyewa",
                    "className": "btn btn-primary btn-info",
                    "action": function() {
                        $('#modal-add').modal('show');
                    }
                }],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        });

        $('#simpanAdd').click(function() {
            $("#loader").show();
        });

        function hapus(id) {
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Kamu Tidak Akan Bisa Mengembalikannya Lagi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('form#formHapus' + id).submit();
                }
            })
        }
    </script>
@endSection
