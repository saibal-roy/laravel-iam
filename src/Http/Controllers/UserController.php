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
        $users = User::where('id', '!=', auth()->user()->id)
        ->excludeSudo()
        ->get();

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
        $roles = Role::get();
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
        User::userUpdateCreateBasedOnRoles(
            $request->only('email', 'name', 'password', 'roles')
        );

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
        $user = User::excludeSudo()->excludeAuthUser()->find($id);
        if(!$user)
        {
            return redirect()->route('users.index')->withErrors(['Not Allowed.']);
        }
        $roles = Role::get();

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
            'password' => 'nullable|min:6|confirmed'
        ]);
        $user = $user->userUpdateCreateBasedOnRoles(
            $request->only('email', 'name', 'password', 'roles'),
            $user
        );
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
