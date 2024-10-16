<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(session('status')== 'verification-link-sent')
        <div>
            <p>New verification link has been sent to your email address</p>
        </div>
    @endif

    @if(Auth::user()->hasVerifiedEmail())
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Your Email not yet verified. 
                    <a onclick="event.preventDefault(); document.getElementById('email-form').submit();">Click here to verify</a>
                    <form id="email-form" action="{{route('verification.send')}}" method="POST">
                   @csrf
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
    @endif


    @if(Auth::user()->level == 'admin')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                       Admin Page
                       <br>
                        <a href="{{url('management_users')}}"><x-secondary-button>User Management</x-secondary-button></a>
                    
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
