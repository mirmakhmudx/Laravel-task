<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>
    <div class="py-10 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-5xl mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">
                Received Applications
            </h2>
            <div class="space-y-6">
                @foreach($applications as $application)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6">
                        <div class="flex justify-between items-center border-b pb-3">
                            <div class="flex items-center space-x-3">
                                <div class="h-10 w-10 rounded-full bg-gray-300"></div>
                                <div
                                    class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$application->user->name}}</div>
                            </div>
                            <div class="text-sm text-gray-500">{{$application->created_at}}</div>
                        </div>
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <div class="mt-4">
                                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">{{$application->subject}}</h3>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">{{$application->message}}</p>
                                </div>

                                <div class="mt-4 text-sm text-gray-500">
                                    {{$application->user->email}}
                                </div>
                            </div>

                            <div class="mt-4 shrink-0">
                                @if(is_null($application->file_url))
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6 18 18 6M6 6l12 12"/>
                                    </svg>
                                @else
                                    <a href="{{asset('storage/'.$application->file_url)}}" target="_blank"
                                       class="flex items-center justify-center border rounded p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                                        </svg>
                                    </a>
                                @endif

                            </div>
                        </div>
                        @if($application->answer()->exists())
                            <div>
                                <hr>
                                <h3 class="text-xs font-semibold text-gray-300">Answer:</h3>
                                <p class="text-white">{{$application->answer->body}}</p>
                            </div>
                        @else
                            @if(auth()->user()->role->name == 'manager')
                                <div class="flex justify-end">
                                    <a href="{{route('application.answer.create',  ['application' => $application->id])}}" type="button" class="middle none center mr-4 rounded-lg bg-green-500 py-1 px-6 font-sanstext-sm font-bold uppercase text-white shadow-md shadow-green-500/20 transition-allhover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-non  disabled:opacity-50 disabled:shadow-none" data-ripple-light="true">
                                        Answer
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>
                @endforeach
                <div class="mt-6">
                    {{ $applications->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
