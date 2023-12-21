@extends('layout.main_layout.main')

@section('content')
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
                                        <form action="{{ route('deleteKamar') }}" method="post"
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- @foreach ($data as $da)
        <div class="modal fade" id="modal-update-{{ $da->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Kamar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateKamar') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $da->id }}">
                            <div class="row">
                                <div class="col-sm-12 row">
                                    <!-- text input -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nomor Kamar</label>
                                            <input type="text" class="form-control" placeholder="Nomor Kamar"
                                                name="nomor" value="{{ $da->nomor }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="number" class="form-control" placeholder="Harga Sewa"
                                                name="harga" value="{{ $da->harga }}">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-12">
                                    <!-- textarea -->

                                    <div class="form-group">
                                        @php
                                            $dataFromDatabase = $da->fitur;
                                            $dataArray = explode(',', str_replace(' ', '', $dataFromDatabase));
                                        @endphp
                                        <label>Fasilitas</label>
                                        <select name="fitur[]" class="select2" multiple="multiple"
                                            data-placeholder="Select a State" style="width: 100%;">
                                            <option
                                                {{ in_array(strtolower('kamarmandidalam'), array_map('strtolower', $dataArray)) ? 'selected' : '' }}>
                                                Kamar
                                                Mandi Dalam</option>
                                            <option
                                                {{ in_array(strtolower('kamarmandiluar'), array_map('strtolower', $dataArray)) ? 'selected' : '' }}>
                                                Kamar
                                                Mandi Luar</option>
                                            <option
                                                {{ in_array(strtolower('kasur'), array_map('strtolower', $dataArray)) ? 'selected' : '' }}>
                                                Kasur</option>
                                            <option
                                                {{ in_array(strtolower('ac'), array_map('strtolower', $dataArray)) ? 'selected' : '' }}>
                                                AC</option>
                                            <option
                                                {{ in_array(strtolower('lemari'), array_map('strtolower', $dataArray)) ? 'selected' : '' }}>
                                                Lemari</option>
                                            <option
                                                {{ in_array(strtolower('MejadanKursiBelajar'), array_map('strtolower', $dataArray)) ? 'selected' : '' }}>
                                                Meja dan Kursi Belajar</option>
                                            <option
                                                {{ in_array(strtolower('wifi'), array_map('strtolower', $dataArray)) ? 'selected' : '' }}>
                                                Wifi</option>
                                            <option
                                                {{ in_array(strtolower('DapurBersama'), array_map('strtolower', $dataArray)) ? 'selected' : '' }}>
                                                Dapur Bersama</option>
                                            <option
                                                {{ in_array(strtolower('Loundri'), array_map('strtolower', $dataArray)) ? 'selected' : '' }}>
                                                Loundri</option>
                                            <option
                                                {{ in_array(strtolower('ParkirMotor'), array_map('strtolower', $dataArray)) ? 'selected' : '' }}>
                                                Parkir Motor</option>
                                            <option
                                                {{ in_array(strtolower('ParkirMobil'), array_map('strtolower', $dataArray)) ? 'selected' : '' }}>
                                                Parkir Mobil</option>
                                            <option
                                                {{ in_array(strtolower('Akses24Jam'), array_map('strtolower', $dataArray)) ? 'selected' : '' }}>
                                                Akses 24 Jam</option>
                                        </select>
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
    @endforeach --}}
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
