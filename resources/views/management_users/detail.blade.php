<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="post" action="{{ url('/management_users/update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="address" :value="__('Address')" />
                                <textarea id="address" name="address" type="text" class="mt-1 block w-full" :value="old('name', $user->address)" style="color: black;" required autofocus>{{$user->address}}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>

                            <div>
                                <x-input-label for="level" :value="__('Level')" />
                                <select name="level" style="color: black;">
                                    <option selected value="{{$user->level}}">{{$user->level}}</option>
                                    <option value="admin">admin</option>
                                    <option value="user">user</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('level')" />
                            </div>


                            <div>
                                <div>
                                    <img src="{{url('photo')}}/{{$user->photo}}" style="max-width: 20%;">
                                </div>
                                <x-input-label for="photo" :value="__('Photo')" />
                                <x-text-input id="photo" name="photo" type="file" class="mt-1 block w-full" required autofocus  />
                                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                              
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('Saved.') }}</p>
                                @endif

                                <a href="{{url('/management_users/delete/')}}/{{$user->id}}"><x-secondary-button>{{ __('Delete') }}</x-secondary-button></a>
                            </div>
                        </form>

                        </div>
                </div>
            </div>
        </div>

    </x-app-layout>