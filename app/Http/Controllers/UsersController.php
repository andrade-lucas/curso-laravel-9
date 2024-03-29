<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Returns an index view with a list of users.
     *
     * @return View
     *
     */
    public function index(): View
    {
        $users = User::query()->get();

        return view('user.index', [
            'users' => $users
        ]);
    }

    /**
     * Return a view to create user.
     *
     * @return View
     */
    public function create(): View
    {
        return view('user.create');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = User::query()->create($data);
        $user->address()->create($data);

        return redirect('users');
    }

    /**
     * Returns a show view with user.
     *
     * @param int $id
     *
     * @return View
     *
     */
    public function show(int $id): View
    {
        $user = User::query()->find($id);

        return view('user.show', ['user' => $user]);
    }

    /**
     * Returns an edit view of users.
     *
     * @param int $id
     *
     * @return View
     *
     */
    public function edit(int $id): View
    {
        $user = User::query()->find($id);
        if (!$user) return throw new ModelNotFoundException();

        return view('user.edit', ['user' => $user]);
    }

    /**
     * Updates an user.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse
     *
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $data = $request->only(['name', 'email']);

        $user = User::query()->find($id);

        $user->update($data);

        return redirect('users');
    }

    /**
     * Destroys a user by its id.
     *
     * @param int $id
     *
     * @return RedirectResponse
     *
     */
    public function destroy(int $id): RedirectResponse
    {
        $user = User::query()->find($id);

        if (!$user) {
            throw new ModelNotFoundException();
        }

        $user->delete();

        return redirect('users');
    }
}
