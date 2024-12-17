<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Set;
use App\Models\FavouriteSet;
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
        return view('profile.profile');
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


    public function addToFavorites(Request $request)
    {
        $userId = Auth::id(); 
        $setNumber = $request->input('set_number');

        Log::debug('Add to Favorites Request', ['user_id' => $userId, 'set_number' => $setNumber]);

        if (!$setNumber) {
            return response()->json(['success' => false, 'message' => 'Set number is required'], 400);
        }

        FavouriteSet::firstOrCreate([
            'user_id' => $userId,
            'set_number' => $setNumber,
        ]);

        return response()->json(['success' => true, 'message' => 'Set added to favorites']);
    }

    public function removeFromFavorites(Request $request)
    {
        $userId = Auth::id(); 
        $setNumber = $request->input('set_number');

        Log::debug('Remove from Favorites Request', ['user_id' => $userId, 'set_number' => $setNumber]);

        if (!$setNumber) {
            return response()->json(['success' => false, 'message' => 'Set number is required'], 400);
        }

        FavouriteSet::where('user_id', $userId)
                    ->where('set_number', $setNumber)
                    ->delete();

        return response()->json(['success' => true, 'message' => 'Set removed from favorites']);
    }



    public function updateFavouriteThemes(Request $request)
    {
        $themes = $request->input('themes', []);

        $request->validate([
            'themes' => 'array',
            'themes.*' => 'exists:themes,id',
        ]);

        $user = auth()->user();

        try {
            $user->favouriteTheme()->sync($themes);
            session()->flash('status', 'Favourite themes updated successfully!');

        } catch (\Exception $e) {
            \Log::error('Error updating favourite themes: ' . $e->getMessage());
            session()->flash('error', 'Failed to update favourite themes.');
        }

        return response()->json(['message' => session('status')]);
    }

    public function updateFavouriteSubthemes(Request $request)
    {
        $subthemes = $request->input('subthemes', []);

        $request->validate([
            'subthemes' => 'array',
            'subthemes.*' => 'exists:subthemes,id',
        ]);

        $user = auth()->user();

        try {
            $user->favouriteSubtheme()->sync($subthemes);
            session()->flash('status', 'Favourite subthemes updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error updating favourite subthemes: ' . $e->getMessage());
            session()->flash('error', 'Failed to update favourite subthemes.');
        }

        return response()->json(['message' => session('status')]);
    }

    
    /*
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
    */
}
