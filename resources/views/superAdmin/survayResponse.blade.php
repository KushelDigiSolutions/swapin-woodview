<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5 mt-2">
            {{ __('Survay Management') }}
        </h2>
        <div class="flex flex-row justify-between items-center">
            <div>
                <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                    <li class="inline-flex items-center">
                        <a class="flex items-center text-sm text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:focus:text-blue-500"
                            href="#">
                            {{ Auth::user()->role->role_name }} DashBoard
                        </a>
                        <svg class="flex-shrink-0 mx-2 overflow-visible size-4 text-gray-400 dark:text-neutral-600"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </li>
                    <li class="inline-flex items-center">
                        <a class="flex items-center text-sm text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:focus:text-blue-500"
                            href="#">
                            Survay Management
                            <svg class="flex-shrink-0 mx-2 overflow-visible size-4 text-gray-400 dark:text-neutral-600"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                    </li>
                    <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200"
                        aria-current="page">
                        View Survay Response
                    </li>
                </ol>
            </div>
            <div>
                <a href="{{ route('addUser') }}"
                    class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5 3a1 1 0 011-1h8a1 1 0 011 1v2h3a1 1 0 011 1v12a1 1 0 01-1 1H6a1 1 0 01-1-1V6a1 1 0 011-1h3V3zm5 2H6v12h9V5h-3zM8 8a1 1 0 011-1h2a1 1 0 010 2H9a1 1 0 01-1-1zm0 4a1 1 0 011-1h2a1 1 0 010 2H9a1 1 0 01-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Create Survay
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-100 text-sm">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session()->has('success_message'))
                        <div class="rounded-md bg-green-50 p-4 mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <!-- Heroicon name: solid/check-circle -->
                                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM5 9a1 1 0 011-1h1.6a1 1 0 01.7.3l3.3 3.4 2.7-2.7a1 1 0 111.4 1.4l-3 3a1 1 0 01-1.4 0l-4-4a1 1 0 010-1.4l1.5-1.5a1 1 0 011.4 0H14a1 1 0 010 2H7a1 1 0 01-1-1V9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">
                                        {{ session('success_message') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session()->has('error_message'))
                        <div class="rounded-md bg-red-50 p-4 mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <!-- Heroicon name: solid/x-circle -->
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM5.293 6.707a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414L11.414 12l3.293 3.293a1 1 0 01-1.414 1.414L10 13.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 12 5.293 8.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">
                                        {{ session('error_message') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee Name</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Survey Name</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($usersurveys as $usersurvey)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{$usersurvey->id}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$usersurvey->user->name}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$usersurvey->survey->title}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="min-w-[10rem] h-4 bg-gray-200 rounded-full">
                                        <div class="h-full text-center text-xs text-white bg-green-500 rounded-full" style="width: {{$usersurvey->percentCompleted}}%;">{{$usersurvey->percentCompleted}}%</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                    
                </div>
            </div>

            
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-100 text-sm">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ $usersurveys->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
