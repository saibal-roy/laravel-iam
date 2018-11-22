<?php
namespace LaravelIam\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();
        return view('laraveliam::roles.index')
                        ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
                    
        return view('laraveliam::roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
            'name' => 'required|unique:roles',
            //'permissions' => 'required',
            ]
        );

        $name = $request['name'];
        $role = new Role();
        $role->name = $name;
        $role->save();
        if($request->has('permissions'))
        {
            $permissions = $request['permissions'];
            foreach ($permissions as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail();
                $role = Role::where('name', '=', $name)->first();
                $role->givePermissionTo($p);
            }
        } 

        return redirect()->route('roles.index')
                            ->with('flash_message', 'Role' . $role->name . ' added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if(config('iamconstants.sudo_user_role') == $role->name)
        {
            return redirect()->route('roles.index')->withErrors(['Not Allowed.']);
        }
        $permissions = Permission::all();
        return view('laraveliam::roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {        

        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $role->id,
            //'permissions' => 'required',
        ]);

        $input = $request->except(['permissions']);
        
        $role->fill($input)->save();
        
        if($request->has('permissions'))
        {
            $permissions = $request['permissions'];
            $p_all = Permission::all();

            foreach ($p_all as $p) {
                $role->revokePermissionTo($p);
            }

            foreach ($permissions as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form permission in db
                $role->givePermissionTo($p);
            }
        }

        return redirect()->route('roles.index')
                            ->with('flash_message', 'Role' . $role->name . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if(config('iamconstants.sudo_user_role') == $role->name)
        {
            return response()->json(['errors'=>"Not Allowed."]);
        }
        
        $role->delete();

        return response()->json($response = array('delete' => true), 200);
    }
}
