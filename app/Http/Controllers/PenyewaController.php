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
            'password'      => bcrypt($pass),
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
        $dataSpec = $this->penyewaModel->find($id);

        $updateData = $dataSpec->update($data);
        if ($updateData) {
            return redirect()->back()->with('success', 'Data Berhasil Diubah');
        }
        return redirect()->back()->with('error', 'Data Gagal Diubah');
    }

    /**\ Delete */
    public function delete(Request $request)
    {
        $id = intval($request['id']);
        $data = $this->penyewaModel->find($id);
        $akun = $this->akunModel->find($data['akun_id']);
        $deleteData = $data->delete();
        $deleteAkun = $akun->delete();
        if ($deleteData && $deleteAkun) {
            return redirect()->back()->with('success', 'Penyewa Berhasil Dihapus');
        }
        return redirect()->back()->with('error', 'Penyewa Gagal Dihapus');
    }



    //user
    public function profil()
    {
        $id = session()->get('data')->pId;
        $data = [
            'title'     => "Profil",
            'folder'    => "Home",
            'profil'    => $this->penyewaModel->find($id)
        ];
        return view('layout/user_layout/profil', $data);
    }
}
