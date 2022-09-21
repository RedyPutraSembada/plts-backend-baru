<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bpr;
use App\Models\Login;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class BprController extends Controller
{
    public function index()
    {
        $banyakBpr = Bpr::with('lokasi')->get();
        return view('pages.admin.bpr.index', [
            'judul' => 'Data Admin BPR',
            'banyakBpr' => $banyakBpr
        ]);
    }
    public function create()
    {
        $banyakLokasi = Lokasi::all();
        return view('pages.admin.bpr.create', [
            'judul' => 'Tambah Data BPR',
            'banyakLokasi' => $banyakLokasi
        ]);
    }

    public function store(Request $request)
    {
        // Validasi Form BPR
        $validatedData1 = $request->validate([
            'email' => 'required|email|unique:logins,email',
            'username' => 'required|min:6|unique:logins,username|regex:/^\S*$/u',
            'password' => 'required|min:6',
        ]);
        $validatedData2 = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'nik' => 'required|numeric|digits_between:15,16',
            'alamat' => 'required|max:500',
            'lokasi_id' => 'required',
            'nip' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'jenis_kelamin' => 'required'
        ]);

        // Menambahkan Akses Login
        $validatedData1['password'] = bcrypt($validatedData1['password']);
        $validatedData1['roles'] = 'bpr';
        $validatedData1['is_active'] = true;
        $login = Login::create($validatedData1);

        // Menambahkan Data admin Berdasarkan Data Login
        $validatedData2['login_id'] = $login->id;
        Bpr::create($validatedData2);

        Alert::toast('Data BPR berhasil ditambahkan!', 'success');
        return redirect(route('master-bpr.index'));
    }

    public function show(Bpr $bpr)
    {
        //
    }

    public function edit($id)
    {
        $bpr = Bpr::findOrFail($id);
        $banyakLokasi = Lokasi::all();
        return view('pages.admin.bpr.edit', [
            'judul' => 'Edit Data BPR',
            'bpr' => $bpr,
            'banyakLokasi' => $banyakLokasi
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi Form Update

        $validatedData2 = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'lokasi_id' => 'required',
            'nip' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'alamat' => 'required|max:500',
            'jenis_kelamin' => 'required'
        ]);

        $bpr = Bpr::findOrFail($id);

        if ($request->input('username') != $bpr->Login->username) {
            if ($request->input('email') != $bpr->Login->email) {
                if ($request->input('password') != null) {
                    $validatedData1 = $request->validate([
                        'email' => 'required|email|unique:Logins,email',
                        'username' => 'required|min:6|unique:Logins,username|regex:/^\S*$/u',
                        'password' => 'required|min:6'
                    ]);
                    $validatedData1['password'] = bcrypt($validatedData1['password']);
                    // Update data database
                    $bpr->Login->update($validatedData1);
                } else {
                    $validatedData1 = $request->validate([
                        'email' => 'required|email|unique:Logins,email',
                        'username' => 'required|min:6|unique:Logins,username|regex:/^\S*$/u',
                    ]);
                    // Update data database
                    $bpr->Login->update($validatedData1);
                }
            } else {
                if ($request->input('password') != null) {
                    $validatedData1 = $request->validate([
                        'username' => 'required|min:6|unique:Logins,username|regex:/^\S*$/u',
                        'password' => 'required|min:6'
                    ]);
                    $validatedData1['password'] = bcrypt($validatedData1['password']);
                    // Update data database
                    $bpr->Login->update($validatedData1);
                } else {
                    $validatedData1 = $request->validate([
                        'username' => 'required|min:6|unique:Logins,username|regex:/^\S*$/u',
                    ]);
                    // Update data database
                    $bpr->Login->update($validatedData1);
                }
            }
        } elseif ($request->input('email') != $bpr->Login->email) {
            // ddd($request->input('email').''. $user->Login->email);
            if ($request->input('password') != null) {
                $validatedData1 = $request->validate([
                    'email' => 'required|email|unique:Logins,email',
                    'password' => 'required|min:6'
                ]);
                $validatedData1['password'] = bcrypt($validatedData1['password']);
                // Update data database
                $bpr->Login->update($validatedData1);
            } else {
                $validatedData1 = $request->validate([
                    'email' => 'required|email|unique:Logins,email'
                ]);
                // Update data database
                $bpr->Login->update($validatedData1);
            }
        } elseif ($request->input('password') != null) {
            $validatedData1 = $request->validate([
                'password' => 'required|min:6'
            ]);
            $validatedData1['password'] = bcrypt($validatedData1['password']);
            // Update data database
            $bpr->Login->update($validatedData1);
        }


        $validatedData2['login_id'] = $bpr->login_id;
        $bpr->update($validatedData2);

        Alert::toast('Data BPR berhasil diupdate!', 'success');
        return redirect(route('master-bpr.index'));
    }

    public function destroy(Bpr $bpr)
    {
        //
    }
}
