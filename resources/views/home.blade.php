<x-app-layout>
    <x-wrapper-container>
        <div
            class="w-full h-[50dvh]  p-[4%] md:p-[2%] text-zinc-100  mx-auto  max-w-7xl sm:px-6 lg:px-8 indigo-gradient rounded-lg mt-10">
            <div class="grid w-full h-full glass-effect place-content-center">
                <div
                    class="flex flex-col items-center justify-center w-full h-full space-y-4 lg:space-y-8 md:space-y-6">
                    <h1
                        class="text-3xl font-bold sm:text-4xl text-balance lg:text-6xl md:text-5xl font-poppins text-shadow-md">
                        Welcome
                        to Task
                        Manager</h1>
                    <p class="max-w-lg text-lg font-medium text-center text-zinc-200 md:text-xl">
                        Task Manager is a simple and easy-to-use task management tool that helps you stay organized and
                        productive.
                    </p>
                    <div
                        class="flex flex-col items-center justify-center space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                        @guest
                        <a wire:navigate href="{{ route('register') }}"
                            class="flex items-center justify-center w-full max-w-full gap-2 px-4 py-2 font-semibold text-center text-white uppercase transition-all duration-300 ease-in-out bg-transparent border-2 rounded-md shadow-md hover:scale-105 border-white/40 hover:border-white hover:bg-zinc-50 hover:text-black shrink-0">
                            Get Started

                        </a>
                        <a wire:navigate href="{{ route('login') }}"
                            class="flex items-center justify-center w-full max-w-full gap-2 px-4 py-2 font-semibold text-white uppercase transition-all duration-300 ease-in-out bg-indigo-500 border-2 rounded-md shadow-md hover:scale-105 border-white/40 hover:border-white hover:bg-indigo-700 hover:text-white shrink-0">
                            Login

                        </a>
                        @endguest
                        @auth
                        <a wire:navigate href="{{ route('dashboard') }}"
                            class="flex items-center justify-center w-full max-w-full gap-2 px-4 py-2 font-semibold text-white uppercase transition-all duration-300 ease-in-out bg-indigo-500 border-2 rounded-md shadow-md hover:scale-105 border-white/40 hover:border-white hover:bg-indigo-700 hover:text-white shrink-0">
                            Dashboard
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </x-wrapper-container>
</x-app-layout>
