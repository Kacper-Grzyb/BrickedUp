<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Set;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use DB;

class ProfileController extends Controller
{
    public function view() 
    {
        $sets = Set::with('setImage')->orderBy('set_number')->get();
        //debug because aaaaaaaa
        //dd($sets->toArray());

        return view('profile/profile', compact('sets'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile/edit-profile');
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

        $request->user()->save();

        return Redirect::route('settings')->with('status', 'Profile updated successfully!');

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

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateFavouriteSets(Request $request) {
        // Remove the previous records
        $userID = auth()->user()->id;
        DB::table('favourite_sets')->where('user_id', '=', $userID)->delete();

        // Get the values from the checkbox input
        $setNumbers = $request->input('set-checkbox', []);
        
        // Add the records to the database
        if(is_array($setNumbers)) 
        {
            foreach($setNumbers as $setNumber) 
            {
                DB::table('favourite_sets')->insert([
                    'user_id' => $userID,
                    'set_number' => $setNumber
                ]);
            }
        }
        else 
        {
            DB::table('favourite_sets')->insert([
                'user_id' => $userID,
                'set_number' => $setNumbers
            ]);
        }

        return Redirect::route('settings')->with('status', 'Favourite sets updated successfully!');
    }

    public function updateFavouriteThemes(Request $request) 
    {
        // Remove the previous records
        $userID = auth()->user()->id;
        DB::table('favourite_themes')->where('user_id', '=', $userID)->delete();

        // Get the values from the checkbox input
        $themeIds = $request->input('theme-checkbox', []);
        
        // Add the records to the database
        if(is_array($themeIds)) 
        {
            foreach($themeIds as $themeId) 
            {
                DB::table('favourite_themes')->insert([
                    'user_id' => $userID,
                    'theme_id' => $themeId
                ]);
            }
        }
        else 
        {
            DB::table('favourite_themes')->insert([
                'user_id' => $userID,
                'theme_id' => $themeIds
            ]);
        }
        
        return Redirect::route('settings')->with('status', 'Favourite themes updated successfully!');
    }

    public function updateFavouriteSubthemes(Request $request) 
    {
                // Remove the previous records
                $userID = auth()->user()->id;
                DB::table('favourite_subthemes')->where('user_id', '=', $userID)->delete();
        
                // Get the values from the checkbox input
                $subthemeIds = $request->input('subtheme-checkbox', []);
                
                // Add the records to the database
                if(is_array($subthemeIds)) 
                {
                    foreach($subthemeIds as $subthemeId) 
                    {
                        DB::table('favourite_subthemes')->insert([
                            'user_id' => $userID,
                            'subtheme_id' => $subthemeId
                        ]);
                    }
                }
                else 
                {
                    DB::table('favourite_subthemes')->insert([
                        'user_id' => $userID,
                        'subtheme_id' => $subthemeIds
                    ]);
                }

        return Redirect::route('settings')->with('status', 'Favourite subthemes updated successfully!');
    }
}
