@extends('layout.main_layout.main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-solid">
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
                <div class="card-body pb-0">
                    <div class="row">
                        <?php 
                            use Carbon\Carbon;
                            foreach($data as $da):?>
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">

                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <h2 class="lead"><b>Kamar {{ $da->kNomor }} </b></h2>
                                            <p class="text-muted text-sm"><b>Fasilitas:
                                                    {{ str_replace(',', ', ', $da->kFitur) }}</b>
                                            </p>
                                            <hr>
                                            @if ($da->pId)
                                                <p class="text-muted text-sm"><b>Penyewa: </b> {{ $da->pNama }} </p>
                                                <p class="text-muted text-sm"><b>Mulai Sewa:
                                                    </b>{{ Carbon::parse($da->created_at)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                                </p>
                                                <p class="text-muted text-sm"><b>Akhir Sewa: </b>
                                                    {{ Carbon::parse($da->expired_at)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                                </p>
                                                <p class="text-muted text-sm"><b>Hp: </b> {{ $da->pTelpon }} </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        @if ($da->status != 0)
                                            <a href="#" class="btn btn-sm bg-teal"
                                                style="pointer-events: none;cursor: not-allowed;text-decoration: none;">
                                                Terisi</i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-primary"
                                                onclick="hapus({{ $da->id }})">
                                                <i class="fas fa-edit"></i> Kosongkan Kamar
                                            </a>
                                            <form action="{{ route('kosongKamar') }}" method="post"
                                                id="formHapus{{ $da->id }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $da->id }}">
                                            </form>
                                        @endif
                                        @if ($da->status == 0 || !$da->pId)
                                            <a href="#" class="btn btn-sm bg-danger"
                                                style="pointer-events: none;cursor: not-allowed;text-decoration: none;">
                                                Belum Terisi</i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#modal-isi-{{ $da->id }}">
                                                <i class="fas fa-edit"></i> Isi Kamar
                                            </a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div><!--/. container-fluid -->
    </section>
    @foreach ($data as $da)
        <div class="modal fade" id="modal-isi-{{ $da->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Isi Kamar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('isiKamar') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $da->id }}">
                            <div class="row">
                                <div class="col-sm-12 row">
                                    <!-- text input -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nomor Kamar</label>
                                            <input type="text" class="form-control" placeholder="Nomor Kamar"
                                                value="{{ $da->kNomor }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Penghuni</label>
                                            <select class="form-control select2" style="width: 100%;" name="penyewa_id">
                                                <option selected="selected">-Penghuni-</option>
                                                @foreach ($penyewa as $pe)
                                                    <option value="{{ $pe->id }}">{{ $pe->nama }}</option>
                                                @endforeach
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

        });

        function hapus(id) {
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Kamu Tidak Akan Bisa Mengembalikannya Lagi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kosongkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('form#formHapus' + id).submit();
                }
            })
        }
    </script>
@endSection
