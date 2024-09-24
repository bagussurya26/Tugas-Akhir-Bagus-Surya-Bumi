<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('hrd.user.daftaruser', compact('users'));
    }

    public function create()
    {
        return view('hrd.user.insertuser');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'role' => 'required',
        ], [
            'username.required' => 'Wajib diisi!',
            'password.required' => 'Wajib diisi!',
            'nama.required' => 'Wajib diisi!',
            'no_hp.required' => 'Wajib diisi!',
            'email.required' => 'Wajib diisi!',
            'role.required' => 'Wajib diisi!',
        ]);

        try {
            User::create([
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']),
                'real_pass' => $validatedData['password'],
                'nama' => $validatedData['nama'],
                'no_hp' => $validatedData['no_hp'],
                'email' => $validatedData['email'],
                'role' => $validatedData['role'],
            ]);

            DB::commit();

            toast('Penambahan data berhasil!', 'success');
            return redirect()->route('user.create');

        } catch (\Exception $e) {
            DB::rollback();

            toast('Penambahan data gagal!', 'warning');
            return redirect()->route('user.create')->withInput();
        }
    }

    public function show($id)
    {
        $users = User::find($id);

        return view('hrd.user.detailuser', compact('users'));
    }

    public function edit($id)
    {
        $users = User::find($id);

        return view('hrd.user.edituser', compact('users'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'role' => 'required',
        ], [
            'username.required' => 'Wajib diisi!',
            'password.required' => 'Wajib diisi!',
            'nama.required' => 'Wajib diisi!',
            'no_hp.required' => 'Wajib diisi!',
            'email.required' => 'Wajib diisi!',
            'role.required' => 'Wajib diisi!',
        ]);

        $user = User::find($id);

        try {

            User::find($id)
                ->update([
                    'username' => $validatedData['username'],
                    'password' => Hash::make($validatedData['password']),
                    'real_pass' => $validatedData['password'],
                    'nama' => $validatedData['nama'],
                    'no_hp' => $validatedData['no_hp'],
                    'email' => $validatedData['email'],
                    'role' => $validatedData['role'],
                ]);

            DB::commit();

            toast('Pengubahan data berhasil!', 'success');
            return redirect()->route('user.show', $id);

        } catch (\Exception $e) {
            DB::rollback();

            toast('Pengubahan data gagal!', 'warning');
            return redirect()->route('user.edit', $id);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            User::find($id)->delete();

            DB::commit();

            alert()->success('Berhasil!', 'Penghapusan Data Berhasil!');
            return redirect()->route('user.index');

        } catch (\Exception $e) {
            DB::rollback();

            // echo ($e);
            alert()->error('Yahhh..', 'Menghapus data tidak berhasil!');
            return redirect()->route('user.index');
        }
    }
}
