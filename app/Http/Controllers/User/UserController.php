<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
    public function index(): Response
    {
        $users = User::all();
        return Inertia::render('Users/index', ['users' => $users]);
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Users/edit', ['user' => $user]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'telephone'=> 'digits:10|nullable',
            'active' => 'required|boolean',
        ]);

        $user->update($request->all());
        return Redirect::route('users.index')->with('info', 'Se actualizó el usuario correctamente');
    }
}
