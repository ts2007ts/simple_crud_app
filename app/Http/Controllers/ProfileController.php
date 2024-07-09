<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user = User::findOrFail(Auth::id());

        //dd($user->imageUrl);

        if ($user->imageUrl) {
            Storage::disk('public')->deleteDirectory(dirname($user->imageUrl));
        }

        $image = $request['imageUrl'] ?? null;

        if ($image) {
            $path = $image->store('users/' . Str::random(), 'public');
            $request->user()->imageUrl = $path;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($user->imageUrl) {
            Storage::disk('public')->deleteDirectory(dirname($user->imageUrl));
        }

        $this->deleteAllUserPostsImage($user);

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    private function deleteAllUserPostsImage(User $user)
    {

        $posts = $user->posts()->get();

        foreach ($posts as $post) {
            if ($post->imageUrl) {
                Storage::disk('public')->deleteDirectory(dirname($post->imageUrl));
            }
        }
    }
}
