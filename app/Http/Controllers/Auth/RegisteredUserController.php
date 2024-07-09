<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
   /**
    * Display the registration view.
    */
   public function create(): View
   {
      return view('auth.register');
   }

   /**
    * Handle an incoming registration request.
    *
    * @throws \Illuminate\Validation\ValidationException
    */
   public function store(Request $request): RedirectResponse
   {
      $attributes = $request->validate([
         'name' => ['required', 'string', 'max:255'],
         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
         'password' => ['required', 'confirmed', Rules\Password::min(4)],
         'imageUrl' => ['file', 'image', 'mimes:jpeg,jpg,png,webp,bmp,tiff', 'max:2048'],
      ]);

      $image = $attributes['imageUrl'] ?? null;

      $path = '';
      if ($image) {
         $path = $image->store('users/' . Str::random(), 'public');
      }

      $user = User::create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => Hash::make($request->password),
         'imageUrl' => $path,
      ]);

      SendMailJob::dispatch(event(new Registered($user)));

      Auth::login($user);

      return redirect(route('post.index', absolute: false));
   }
}
