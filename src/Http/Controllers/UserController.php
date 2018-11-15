<?php
namespace LaravelIam\Http\Controllers;

use Illuminate\Http\Request;
use LaravelIam\Storage\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();

        return view('laraveliam::users.index')
                    ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name', '!=', config('iamconstants.sudo_user_role'))->get();
        if ($roles->isEmpty()) 
        {
            return redirect()->route('users.index')
                                ->withErrors('Please create a role first.');
        }
        
        return view('laraveliam::users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create($request->only('email', 'name', 'password'));

        $roles = $request['roles'];

        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r);
            }
        }

        return redirect()->route('users.index')
                            ->with('flash_message', 'User successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::where('name', '!=', config('iamconstants.sudo_user_role'))->get();

        return view('laraveliam::users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|min:6|confirmed'
        ]);

        $input = $request->only(['name', 'email', 'password']);
        $roles = $request['roles'];
        //dd($roles);
        $user->fill($input)->save();

        if (isset($roles)) {
            $user->roles()->sync($roles);
        } else {
            $user->roles()->detach();
        }
        return redirect()->route('users.index')
                            ->with('flash_message', 'User successfully edited.');
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
        $user->delete();

        return response()->json($response = array('delete' => true), 200);
    }
}
