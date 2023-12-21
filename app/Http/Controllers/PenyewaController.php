<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class PenyewaController extends Controller
{
    function index()
    {
        $data = [
            'title'     => "Manage Penyewa",
            'folder'    => "Home",
            'data'      => $this->penyewaModel->get()
        ];
        return view('layout/admin_layout/penyewa', $data);
    }

    function generateRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    /**\ Create */
    public function store(Request $request)
    {
        $data = $request->all();
        $pass = $this->generateRandomString();
        $akun = array(
            'username'      => $data['email'],
            'password'      => sha1($pass),
            'role_id'       => 2
        );
        $emailData = array(
            'link'     => URL::to('/'),
            'password'  => $pass
        );
        Mail::to($data['email'])->send(new SendEmail($emailData));
        $insertAkun = $this->akunModel::create($akun);
        if ($insertAkun) {
            $dataToInserted = array(
                'akun_id'       => $insertAkun->id,
                'nama'      => $data['nama'],
                'telpon'       => $data['telpon'],
                'ktp'       => intval($data['ktp']),
                'email'         => $data['email'],
                'gender'        => intval($data['gender']),
                'kontak_darurat'        => $data['kontak_darurat'],
                'penghuni'      => intval($data['penghuni']),
            );
            $inserted = $this->penyewaModel::create($dataToInserted);
            if ($inserted) {
                return redirect()->back()->with('success', 'Penyewa Berhasil Ditambahkan ');
            }
        }
        return redirect()->back()->with('error', 'Penyewa Gagal Ditambahkan');
    }
    public function update(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $dataSpec = $this->kamarModel->find($id);

        $fitur = strtoupper(implode(",", $data['fitur']));
        $dataToUpdate = [
            'nomor'     => $data['nomor'],
            'harga'     => intval($data['harga']),
            'fitur'     => $fitur
        ];

        $updateData = $dataSpec->update($dataToUpdate);
        if ($updateData) {
            return redirect()->back()->with('success', 'Kamar Berhasil Diubah');
        }
        return redirect()->back()->with('error', 'Kamar Gagal Diubah');
    }

    /**\ Delete */
    public function delete(Request $request)
    {
        $id = intval($request['id']);
        $data = $this->kamarModel->find($id);
        $deleteData = $data->delete();
        if ($deleteData) {
            return redirect()->back()->with('success', 'Kamar Berhasil Dihapus');
        }
        return redirect()->back()->with('error', 'Kamar Gagal Dihapus');
    }
}
