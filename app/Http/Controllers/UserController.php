<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get('role');
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';
        $number = numberPagination(5);

        if ($status) {
            $users = User::Role($status)
                ->where("name", "LIKE", "%$keyword%")
                ->paginate(5);

        } else {
            $users = User::where("name", "LIKE", "%$keyword%")
                ->paginate(5);
        }

        return view('admin.user.index', compact('users', 'number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = new User;

            $user->name = $request->get('name');
            $user->username = $request->get('username');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->address = $request->get('address');
            $user->phone = $request->get('phone');
            $user->status = 'ACTIVE';

            $avatar = $request->file('avatar');

            if ($avatar)
            {
                $avatar_path = saveOriginalPhoto($avatar, $user->username, 'user-avatars');

                $user->avatar = $avatar_path;

            } else {

                $user->avatar = "";
            }

            $user->save();

            $user->assignRole($request->role);

            return redirect()
                    ->route('users.index')
                    ->with('status', 'User successfully add');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['status' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $dataRoles = $request->get('role');
        
        $user = User::findOrFail($request->user_id);

        $user->name = $request->get('name');
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->status = $request->get('status');

        if ($request->file('avatar'))
        {
            if($user->avatar && file_exists(storage_path('app/public/' . $user->avatar)))
            {
                Storage::delete('public/' . $user->avatar);
            }

            $file = saveOriginalPhoto($request->file('avatar'), $request->username, 'user-avatars');

            $user->avatar = $file;
        }

        $user->save();

        $user->syncRoles($dataRoles);

        return back()
            ->with('status','User succesfully updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->avatar != "")
        {
            Storage::delete('public/' . $user->avatar);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('status', 'User successfully delete');
    }

    /**
     * merubah password pengguna
     * 
     */
    public function change_password(Request $request) 
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required | string | min:5 | confirmed',
        ]);
    
        $email = $request->get('email');
        $old_password = $request->get('old_password');
        $new_password = $request->get('password');
        
        if (($email == \Auth::user()->email) && Hash::check($old_password, \Auth::user()->password)) {
            $user = User::findOrFail(\Auth::user()->id);

            $user->password = Hash::make($new_password);
            $user->save();

            return redirect(route('admin.dashboard'))
                ->with(['status' => 'Password berhasil dirubah']);
            } else {
            return redirect(route('admin.dashboard'))
                ->with(['error' => 'Ubah password gagal']);

            // dd("Berhasil", $request);
        }
    }
    
}
