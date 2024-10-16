<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



    @if(Auth::user()->level == 'admin')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                      User Management Page
                        <div>
                        @if($users != null)
                            <table>
                                <tr>
                                    <td>
                                        Name
                                    </td>
                                    <td>
                                        Email
                                    </td>
                                    <td>
                                        Detail
                                    </td>
                                </tr>
                               @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                    <td>
                                        <a href="{{url('management_users/detail')}}/{{$user->id}}">detail...</a>
                                    </td>

                                </tr>
                                @endforeach

                            </table>
                            @else
                                <div>No Data</td>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
