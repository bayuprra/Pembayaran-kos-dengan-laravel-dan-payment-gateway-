<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KamarController extends Controller
{
    function index()
    {
        $data = [
            'title'     => "Manage Kamar",
            'folder'    => "Home",
            'data'      => $this->kamarModel->get()
        ];
        return view('layout/admin_layout/kamar', $data);
    }

    /**\ Create */
    public function store(Request $request)
    {
        $data = $request->all();
        $fitur = strtoupper(implode(",", $data['fitur']));
        $dataToInserted = array(
            'nomor'     => $data['nomor'],
            'harga'     => intval($data['harga']),
            'fitur'     => $fitur
        );
        $inserted = $this->kamarModel::create($dataToInserted);
        if ($inserted) {
            $kostData = [
                'kamar_id'      => $inserted->id,
                'penyewa_id'    => null,
            ];
            $this->kostModel::create($kostData);
            return redirect()->back()->with('success', 'Kamar Berhasil Ditambahkan');
        }
        return redirect()->back()->with('error', 'Kamar Gagal Ditambahkan');
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
