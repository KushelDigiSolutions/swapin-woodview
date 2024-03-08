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
                            href="{{ route('allSurvay') }}">
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
                        {{ $survey->title }} Edit
                    </li>
                </ol>
            </div>
            <div>
                <a href="{{ route('allSurvay') }}"
                    class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5 3a1 1 0 011-1h8a1 1 0 011 1v2h3a1 1 0 011 1v12a1 1 0 01-1 1H6a1 1 0 01-1-1V6a1 1 0 011-1h3V3zm5 2H6v12h9V5h-3zM8 8a1 1 0 011-1h2a1 1 0 010 2H9a1 1 0 01-1-1zm0 4a1 1 0 011-1h2a1 1 0 010 2H9a1 1 0 01-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="min-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('success_message'))
                <div class="rounded-md bg-green-50 p-4 mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: solid/check-circle -->
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
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
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
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
            <h1 class="text-2xl font-bold mb-4 mt-8 text-center">{{ $survey->title }}</h1>
            <div class="bg-gray-100 font-sans flex h-screen items-center justify-center">
                <div x-data="{ openTab: 1 }" class="p-8 min-w-full">
                    <div class="min-w-full mx-auto">
                        <div class="mb-4 flex space-x-4 p-2 bg-white rounded-lg shadow-md">
                            <button x-on:click="openTab = 1" :class="{ 'bg-blue-600 text-white': openTab === 1 }"
                                class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue transition-all duration-300">
                                Edit Part I
                            </button>
                            <button x-on:click="openTab = 2" :class="{ 'bg-blue-600 text-white': openTab === 2 }"
                                class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue transition-all duration-300">Edit
                                Questions
                            </button>
                            <button x-on:click="openTab = 3" :class="{ 'bg-blue-600 text-white': openTab === 3 }"
                                class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue transition-all duration-300">Section
                                3</button>
                        </div>

                        <div x-show="openTab === 1"
                            class="transition-all duration-300 bg-white p-4 rounded-lg shadow-md border-l-4 border-blue-600 min-w-full">
                            <h2 class="text-2xl font-semibold mb-2 mx-4 text-blue-600">Part I: Instructions</h2>
                            <div class="p-4 space-y-4 text-justify">
                                <form action="{{ route('updateSurvay', ['id' => $survey->id]) }}" method="POST">
                                    @csrf <!-- CSRF protection for Laravel -->
                                    @method('PATCH')
                                    <textarea name="description"
                                        class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-500" rows="15">{!! $survey->description !!}</textarea>
                                    <button type="submit"
                                        class="w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-400 focus:outline-none focus:bg-blue-400 mt-2">Update</button>
                                </form>
                            </div>


                            <h3 class="text-lg font-normal mb-4 mx-4">EVALUATION SCALE</h3>
                            <div class="overflow-x-auto mx-4">
                                <table class="table-auto border-collapse">
                                    <tbody>
                                        @foreach ($survey->evaluation as $scale)
                                            <tr class="border">
                                                <td class="border px-4 py-2 font-extrabold">{{ $scale->abbreviation }}
                                                </td>
                                                <td class="border px-4 py-2 font-bold">{{ $scale->fullForm }}</td>
                                                <td class="border px-4 py-2">{{ $scale->description }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="font-bold mb-4 m-4 ">
                                <strong>
                                    If you are unable to evaluate or comment within a specific area, please skip and
                                    move to the
                                    next area/review question.
                                </strong>
                            </div>

                            {{-- button --}}
                            <div class="flex justify-end my-6 mx-4 gap-x-1">
                                {{-- <a href="" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded disabled">
                            Previous
                        </a> --}}
                                <a href="{{ route('viewSurvaySteptwo', ['Id' => $survey->id, 'part' => 'Part II']) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Next
                                </a>
                            </div>
                        </div>

                        <div x-show="openTab === 2"
                            class="transition-all duration-300 bg-white p-4 rounded-lg shadow-md border-l-4 border-blue-600 min-w-full">
                            <h2 class="text-2xl font-semibold mb-2 mx-4 text-blue-600">Edit Questions</h2>

                            @foreach ($survey->questions as $question)
                                <div class="flex items-center gap-1 mb-2 mx-4">
                                    <!-- First column -->
                                    <div class="p-2 text-center">{{ $question->id }}</div>

                                    <!-- Second column -->
                                    <div class="flex-1 flex bg-gray-200 p-2">
                                        <!-- Input field -->
                                        <form method="POST" action="{{ route('updateQuestion') }}"
                                            class="flex items-center flex-1">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id" value="{{ $question->id }}">
                                            <input type="text" value="{{ $question->questionText }}"
                                                name="questionText"
                                                class="border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-400 flex-grow mr-2 w-full">
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-2 rounded">
                                                Update
                                            </button>
                                            <button type="button"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded disabled">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div x-show="openTab === 3"
                            class="transition-all duration-300 bg-white p-4 rounded-lg shadow-md border-l-4 border-blue-600 min-w-full">
                            <h2 class="text-2xl font-semibold mb-2 text-blue-600">Section 3 Content</h2>
                            <p class="text-gray-700">Fusce hendrerit urna vel tortor luctus, nec tristique odio
                                tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                                cubilia Curae.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
