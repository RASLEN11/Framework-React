<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <i class="fas fa-user-circle mr-2"></i>{{ __('Profile Settings') }}
            </h2>
            <x-breadcrumbs :items="[
                ['name' => 'Dashboard', 'url' => route('dashboard')],
                ['name' => 'Profile', 'url' => route('profile.edit')]
            ]"/>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profile Information Section -->
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-lg rounded-xl transition-all duration-300 hover:shadow-xl">
                <div class="max-w-2xl">
                    <div class="flex items-center mb-6">
                        <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 mr-4">
                            <i class="fas fa-user text-lg"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                            {{ __('Personal Information') }}
                        </h3>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Update Section -->
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-lg rounded-xl transition-all duration-300 hover:shadow-xl">
                <div class="max-w-2xl">
                    <div class="flex items-center mb-6">
                        <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 mr-4">
                            <i class="fas fa-lock text-lg"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                            {{ __('Update Password') }}
                        </h3>
                    </div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Account Deletion Section -->
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-lg rounded-xl border border-red-100 dark:border-red-900">
                <div class="max-w-2xl">
                    <div class="flex items-center mb-6">
                        <div class="p-3 rounded-full bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-300 mr-4">
                            <i class="fas fa-exclamation-triangle text-lg"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                            {{ __('Delete Account') }}
                        </h3>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
                    </p>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-input, .form-textarea, .form-select, .form-multiselect {
            transition: all 0.3s ease;
            border-radius: 0.375rem;
        }
        
        .form-input:focus, .form-textarea:focus, .form-select:focus, .form-multiselect:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
        }
        
        .btn-primary {
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
        }
    </style>
</x-app-layout>