<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>
    <div class="py-10 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-5xl mx-auto px-4">
            <div class="flex items-center justify-center">
                <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
                    <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white">
                        Answer application #{{$application->id}}
                    </h2>
                    <hr class="my-6">
                    <form action="{{route('application.answer.store', ['application' =>$application->id ])}}" method="POST"
                          class="space-y-4">
                        @csrf
                        <div>
                            <label class="text-sm font-semibold text-gray-600 dark:text-gray-300">Answer</label>
                            <textarea rows="4" name="body" class="w-full p-3 mt-1 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none"></textarea>
                        </div>
                        <input type="submit" class="middle none center mr-4 rounded-lg bg-green-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" value="Send">
                        <a href="{{route('dashboard')}}" class="middle none center mr-4 rounded-lg bg-red-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                            Cancel
                        </a>>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
