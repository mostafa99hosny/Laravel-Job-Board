<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $user->update($request->only(['name', 'email', 'bio']));
        
        return redirect()->route('profile.edit')->with('status', 'Profile updated.');
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        $user->delete();

        return redirect('/')->with('status', 'Account deleted successfully.');
    }
}
?>