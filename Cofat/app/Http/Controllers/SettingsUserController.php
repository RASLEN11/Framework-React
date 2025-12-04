<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;
use App\Models\ApplicationSetting;

class SettingsUserController extends Controller
{
    /**
     * Display the user settings page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $users = [];
        
        if ($user->is_admin) {
            $users = User::latest()->paginate(10);
        }

        // Get application settings (using database or config)
        $applicationSettings = [
            'job_applications_enabled' => $this->getApplicationSetting('job_applications_enabled'),
            'internship_applications_enabled' => $this->getApplicationSetting('internship_applications_enabled'),
        ];
        
        return view('admin.layouts.settings', compact('user', 'applicationSettings', 'users'));
    }

    /**
     * Get application setting from database or config
     */
    protected function getApplicationSetting($key)
    {
        // Option 1: Using database
        if (config('settings.use_database_for_settings', true)) {
            $setting = ApplicationSetting::first();
            return $setting ? $setting->$key : false;
        }
        
        // Option 2: Using config
        return config("settings.$key", false);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'sometimes|required|email|max:255|unique:users,email,'.Auth::id(),
        ]);

        try {
            $user = Auth::user();
            $user->update($validated);

            return redirect()
                ->route('settings')
                ->with('success', __('Profile updated successfully!'));
        } catch (\Exception $e) {
            Log::error('Profile update failed: '.$e->getMessage());
            return back()
                ->withInput()
                ->with('error', __('Failed to update profile. Please try again.'));
        }
    }

    /**
     * Update a user (admin only)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userUpdate(Request $request, User $user)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'is_admin' => 'sometimes|boolean',
        ]);

        try {
            $user->update($validated);
            return back()->with('success', __('User updated successfully!'));
        } catch (\Exception $e) {
            Log::error('User update failed: '.$e->getMessage());
            return back()->with('error', __('Failed to update user. Please try again.'));
        }
    }

    /**
     * Delete a user (admin only)
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userDestroy(User $user)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        try {
            // Prevent deleting yourself
            if ($user->id === Auth::id()) {
                return back()->with('error', __('You cannot delete your own account.'));
            }

            $user->delete();
            return back()->with('success', __('User deleted successfully!'));
        } catch (\Exception $e) {
            Log::error('User deletion failed: '.$e->getMessage());
            return back()->with('error', __('Failed to delete user. Please try again.'));
        }
    }

    /**
     * Update application availability settings (admin only)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateApplicationAvailability(Request $request)
    {
        if (!Auth::user()->is_admin) {
            return redirect()
                ->route('settings')
                ->with('error', __('Unauthorized action.'));
        }

        $validated = $request->validate([
            'job_applications_enabled' => 'sometimes|boolean',
            'internship_applications_enabled' => 'sometimes|boolean',
        ]);

        try {
            // Option 1: Using database
            if (config('settings.use_database_for_settings', true)) {
                $settings = ApplicationSetting::firstOrNew();
                $settings->job_applications_enabled = $request->boolean('job_applications_enabled');
                $settings->internship_applications_enabled = $request->boolean('internship_applications_enabled');
                $settings->save();
            } 
            // Option 2: Using config file
            else {
                $configPath = config_path('settings.php');
                $settings = file_exists($configPath) ? require $configPath : [];
                
                $settings['job_applications_enabled'] = $request->boolean('job_applications_enabled');
                $settings['internship_applications_enabled'] = $request->boolean('internship_applications_enabled');
                
                $content = '<?php return ' . var_export($settings, true) . ';';
                file_put_contents($configPath, $content);
            }

            return redirect()
                ->route('settings')
                ->with('success', __('Application settings updated successfully!'));
        } catch (\Exception $e) {
            Log::error('Application settings update failed: '.$e->getMessage());
            return back()
                ->with('error', __('Failed to update application settings. Please try again.'));
        }
    }

    /**
     * Update the user's avatar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAvatar(Request $request)
    {
        $validated = $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            $user = Auth::user();
            $this->deleteExistingAvatar($user);

            $avatarPath = $this->processAndStoreAvatar($request->file('avatar'));
            $user->update(['avatar' => $avatarPath]);

            return redirect()
                ->route('settings')
                ->with('success', __('Profile image updated successfully!'));
        } catch (\Exception $e) {
            Log::error('Avatar update failed: '.$e->getMessage());
            return back()
                ->withInput()
                ->with('error', __('Failed to update avatar. Please try again.'));
        }
    }

    /**
     * Remove the user's avatar.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeAvatar()
    {
        try {
            $user = Auth::user();
            $this->deleteExistingAvatar($user);
            $user->update(['avatar' => null]);

            return response()->json([
                'success' => true,
                'message' => __('Avatar removed successfully.')
            ]);
        } catch (\Exception $e) {
            Log::error('Avatar removal failed: '.$e->getMessage());
            return response()->json([
                'success' => false,
                'message' => __('Failed to remove avatar.')
            ], 500);
        }
    }

    /**
     * Delete the user's existing avatar if it exists.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function deleteExistingAvatar($user)
    {
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }
    }

    /**
     * Process and store the uploaded avatar.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @return string
     */
    protected function processAndStoreAvatar($file)
    {
        $path = $file->store('avatars', 'public');
        
        $image = Image::make(storage_path("app/public/{$path}"))
            ->fit(200, 200, function ($constraint) {
                $constraint->upsize();
            })
            ->encode('webp', 90)
            ->save();

        return $path;
    }
}