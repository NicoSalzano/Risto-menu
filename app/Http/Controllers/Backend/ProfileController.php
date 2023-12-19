<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('admin.Profile.edit');
    }

    public function updateProfile(Request $request)
    {
        $messages = [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.max' => 'Il campo nome non può superare i 50 caratteri.',
            'email.required' => 'Il campo email è obbligatorio.',
            'email.email' => 'Inserisci un indirizzo email valido.',
            'email.unique' => 'Questo indirizzo email è già in uso.',
        ];
        
        // dd($request);
        $request->validate([
            'name' =>['required', 'max:50'],
            'email' =>['required', 'email','unique:users,email,'.Auth::user()->id],
        ],$messages); 
        


        // $user = Auth::user();
        // $user->name = $request->name;
        // $user->email = $request->email;
        
        // $user->save();

        $request->user()->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);

        return redirect()->back()->with('message', 'Il profilo è stato modificato.');
    }

    public function updateProfilePassword(Request $request)
    {
        $messages = [
            'current_password.required' => 'Il campo password è obbligatorio.',
            'password.required' => 'Il campo inserisci la tua password è obbligatorio.',
            'password.min'=> 'La password deve contenere almeno 8 caratteri'
        ];
        // dd($request);
        $request->validate([
            'current_password' =>['required', 'current_password'],
            'password' => ['required', 'min:8'],
        ],$messages);

        $request->user()->update([
            'password'=> bcrypt($request->password)
        ]);

        return redirect()->back();
    }
}
