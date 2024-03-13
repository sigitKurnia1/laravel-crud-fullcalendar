<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index() {
        $user = User::all();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete this data?";
        confirmDelete($title, $text);

        return view('user.index', compact('user'));
    }

    public function storeView() {
        return view('user.create');
    }

    public function updateView($id) {
        $user = User::findOrFail($id);

        return view('user.update', compact('user'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required|min:8|max:15',
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        if ($user) {
            Alert::success('Success!', 'New User has been added!');
            return redirect('/user-data');
        } else {
            Alert::error('Error!', 'Failed to add new user!');
            return redirect('/user-data');
        }
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->password == null) {
            $user->password = $request->old_password;
        } else {
            $request->validate(['password' => 'required|min:8|max:15']);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if ($user) {
            toast('User data has been updated!', 'success');
            return redirect('/user-data');
        } else {
            toast('Failed to update user data!', 'error');
            return redirect('/user-data');
        }
    }

    public function destroy($id) {
        $user = User::findOrFail($id);

        $user->delete();

        if ($user) {
            toast('User has been deleted!', 'success');
            return redirect()->back();
        } else {
            toast('Failed to delete data!', 'error');
            return redirect()->back();
        }
    }
}
