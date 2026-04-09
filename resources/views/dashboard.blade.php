<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>
    <div class="py-10 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-5xl mx-auto px-4">
            @if(auth()->user()->role->name === 'manager')
                <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">
                    Received Applications
                </h2>
                <div class="space-y-6">
                    @foreach($applicatoins as $application)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6">
                            <div class="flex justify-between items-center border-b pb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="h-10 w-10 rounded-full bg-gray-300"></div>
                                    <div class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$application->user->name}}</div>
                                </div>
                                <div class="text-sm text-gray-500">{{$application->created_at}}</div>
                            </div>
                            <div class="mt-4">
                                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">{{$application->subject}}</h3>
                                <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">{{$application->message}}</p>
                            </div>
                            <div class="mt-4 text-sm text-gray-500">
                                {{$application->user->email}}
                            </div>
                        </div>
                    @endforeach
                        <div class="mt-6">
                            {{ $applicatoins->links() }}
                        </div>
                </div>

            @elseif(auth()->user()->role->name === 'client')
                @if(session()->has('error'))
                    <div class="max-w-lg mx-auto">
                        <div class="flex bg-blue-100 rounded-lg p-4 mb-4 text-sm text-blue-700" role="alert">
                            <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <div>
                                <span class="font-medium">Info alert!</span> {{session()->get('error')}}
                            </div>
                        </div>
                    </div>>
                @endif

                <div class="flex items-center justify-center">
                    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
                        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white">
                            Submit your application
                        </h2>
                        <hr class="my-6">
                        <form action="{{route('applications.store')}}" method="POST" enctype="multipart/form-data"
                              class="space-y-4">
                            @csrf
                            <div>
                                <label class="text-sm font-semibold text-gray-600 dark:text-gray-300">Subject</label>
                                <input type="text" name="subject"
                                       class="w-full p-3 mt-1 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-600 dark:text-gray-300">Message</label>
                                <textarea rows="4" name="message"
                                          class="w-full p-3 mt-1 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none"></textarea>
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-600 dark:text-gray-300">File</label>
                                <input type="file" name="file" class="text-sm">
                            </div>
                            <button
                                class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                                Send Application
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
