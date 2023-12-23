<?php

namespace App\Http\Controllers;

use App\Models\kostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class KostanController extends Controller
{
    function index()
    {
        $data = [
            'title'     => "Manage Kostan",
            'folder'    => "Home",
            'data'      => $this->kostModel->getData(),
            'penyewa'   => $this->penyewaModel->penyewaKosong()
        ];
        return view('layout/admin_layout/kostan', $data);
    }

    function isiKamar(Request $request)
    {
        $data = $request->all();
        $year = intval(date("Y"));
        $month = intval(date('m')) + 1;
        $day = intval(date('d'));

        if ($month > 12) {
            $year++;
            $month -= 12;
        }
        $dataInsert = array(
            'penyewa_id'        => $data['penyewa_id'],
            'status'            => 1,
            'created_at'        => date("Y-m-d"),
            'expired_at'        => $year . "-" . $month . "-" . $day
        );
        $realData = $this->kostModel->find($data['id']);
        if ($realData) {
            $inserted = $realData->update($dataInsert);
            if ($inserted) {
                return redirect()->back()->with('success', 'Kamar Berhasil Diisi');
            }
            return redirect()->back()->with('error', 'Kamar Gagal Diisi');
        }
        return redirect()->back()->with('error', 'Data Tidak Ditemukan');
    }

    function kosongKamar(Request $request)
    {
        $id = intval($request['id']);
        $dataInsert = array(
            'penyewa_id'        => null,
            'status'            => 0,
            'created_at'        => null,
            'expired_at'        => null
        );
        $realData = $this->kostModel->find($id);
        if ($realData) {
            $inserted = $realData->update($dataInsert);
            if ($inserted) {
                return redirect()->back()->with('success', 'Kamar Berhasil Dikosongkan');
            }
            return redirect()->back()->with('error', 'Kamar Gagal Dikosongkan');
        }
        return redirect()->back()->with('error', 'Data Tidak Ditemukan');
    }

    function bayarkost(Request $request)
    {

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }
}
