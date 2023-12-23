@extends('layout.main_layout.main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                {{-- <div class="card-header">
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
                </div> --}}
                <!-- /.card-header -->
                <div class="card-body">

                    @csrf
                    <input type="hidden" name="id" value="{{ $profil->id }}">
                    <div class="row">
                        <div class="col-sm-12 row">
                            <!-- text input -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>No KTP</label>
                                    <input type="text" class="form-control" placeholder="No KTP" name="ktp"
                                        minlength="16" maxlength="16" value="{{ $profil['ktp'] }}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama" name="nama"
                                        value="{{ $profil['nama'] }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 row">
                            <!-- text input -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="Alamat Email" name="email"
                                        value="{{ $profil['email'] }}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Telpon</label>
                                    <input type="text" pattern="[0-9]+" class="form-control" placeholder="Nomor Telepon"
                                        name="telpon" maxlength="15" value="{{ $profil['telpon'] }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 row">
                            <!-- text input -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Kontak Darurat</label>
                                    <input type="text" pattern="[0-9]+" class="form-control" placeholder="Kontak Darurat"
                                        name="kontak_darurat" maxlength="15" value="{{ $profil['kontak_darurat'] }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="custom-select" name="gender">
                                        <option value="1" {{ $profil['gender'] == 1 ? 'selected' : '' }}>Laki -
                                            Laki
                                        </option>
                                        <option value="0" {{ $profil['gender'] == 0 ? 'selected' : '' }}>Wanita
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Jumlah Penghuni</label>
                                    <select class="custom-select" name="penghuni">
                                        <option value="1" {{ $profil['penghuni'] == 1 ? 'selected' : '' }}>1
                                        </option>
                                        <option value="2" {{ $profil['penghuni'] == 2 ? 'selected' : '' }}>2
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </form>
                <!-- /.card-body -->
            </div>
        </div><!--/. container-fluid -->
    </section>
@endSection
@section('script')
    <script></script>
@endSection
