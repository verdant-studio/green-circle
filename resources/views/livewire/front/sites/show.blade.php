<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="flex flex-col items-center min-h-screen pt-6 sm:pt-0">
            <div>
                <x-jet-authentication-card-logo />
            </div>

            {{ $site->name }}
        </div>
    </div>
</x-guest-layout>
