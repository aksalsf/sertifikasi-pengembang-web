<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(Request $request) {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['total_gpa'] = round(($data['math'] + $data['indonesian'] + $data['english']) / 3, 2);

        User::create($data);
        return redirect('/admin/login');
    }
}
