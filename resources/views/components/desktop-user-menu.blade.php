<flux:sidebar.footer> {{-- Ini jadi pembungkus utamanya --}}
    @if(auth()->check())
        <flux:dropdown position="bottom" align="start" class="max-lg:hidden">
            <flux:sidebar.profile
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
                icon-trailing="chevrons-up-down"
            />

            <flux:menu class="w-[200px]">
                <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                    <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />
                    <div class="grid flex-1 text-start text-sm leading-tight">
                        <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                        <flux:text class="truncate text-xs">{{ auth()->user()->email }}</flux:text>
                    </div>
                </div>
                <flux:menu.separator />
                <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                    {{ __('Settings') }}
                </flux:menu.item>
                <flux:menu.separator />
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full cursor-pointer">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    @else
        <flux:sidebar.nav>
            <flux:sidebar.item icon="arrow-right-on-rectangle" href="{{ route('login') }}" wire:navigate>
                {{ __('Login') }}
            </flux:sidebar.item>
        </flux:sidebar.nav>
    @endif
</flux:sidebar.footer>