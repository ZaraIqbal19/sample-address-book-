<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-black px-4">
        
        <div class="w-full max-w-md bg-[#111] rounded-2xl shadow-xl p-8 border border-pink-600">
            
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <x-authentication-card-logo />
            </div>

            <!-- Info Text -->
            <p class="mb-4 text-sm text-gray-300 text-center">
                {{ __('Before continuing, please verify your email address by clicking on the link we just emailed to you. If you didn’t receive the email, we can send another one.') }}
            </p>

            <!-- Success Message -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-sm font-medium text-green-400 text-center">
                    {{ __('A new verification link has been sent to your email address.') }}
                </div>
            @endif

            <!-- Actions -->
            <div class="mt-6 flex flex-col gap-4">

                <!-- Resend -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-full py-3 rounded-xl bg-pink-600 hover:bg-pink-700 text-white font-bold transition">
                        Resend Verification Email
                    </button>
                </form>

                <!-- Links -->
                <div class="flex justify-between text-sm text-gray-400">
                    
                    <a href="{{ route('profile.show') }}"
                       class="hover:text-pink-500 transition font-semibold">
                        Edit Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="hover:text-pink-500 transition font-semibold">
                            Log Out
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
