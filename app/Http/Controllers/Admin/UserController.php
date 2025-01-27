<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('role', User::ROLE_CUSTOMER)
            ->when($request->has('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('email', 'like', '%' . $request->search . '%');
            })
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->only(['name', 'email']));
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function deactivate(User $user)
    {
        $user->update(['active' => false]);
        return redirect()->route('admin.users.index')->with('success', 'User deactivated successfully.');
    }

    public function reactivate(User $user)
    {
        $user->update(['active' => true]);
        return redirect()->route('admin.users.index')->with('success', 'User reactivated successfully.');
    }
}