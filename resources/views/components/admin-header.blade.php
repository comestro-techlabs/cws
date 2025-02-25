<flux:header container
    class="bg-zinc-50 fixed top-0 z-50 w-full dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
    <flux:navbar class="-mb-px max-lg:hidden">
        <img src="{{asset('assets/LearnSyntax.png')}}" alt="Acme Inc. Logo" width="150px"
            class="object-contain dark:hidden">
        <flux:navbar.item icon="home" href="{{ route('admin.dashboard') }}" current>Home</flux:navbar.item>
        <flux:navbar.item icon="inbox" badge="12" href="#">Inbox</flux:navbar.item>
        <flux:navbar.item icon="document-text" href="#">Documents</flux:navbar.item>
        <flux:navbar.item icon="calendar" href="#">Calendar</flux:navbar.item>

        <flux:separator vertical variant="subtle" class="my-2" />

        <flux:dropdown class="max-lg:hidden">
            <flux:navbar.item icon-trailing="chevron-down">Favorites</flux:navbar.item>
            <flux:navmenu>
                <flux:navmenu.item href="#">Marketing site</flux:navmenu.item>
                <flux:navmenu.item href="#">Android app</flux:navmenu.item>
                <flux:navmenu.item href="#">Brand guidelines</flux:navmenu.item>
            </flux:navmenu>
        </flux:dropdown>
    </flux:navbar>

    <flux:spacer />

    <flux:navbar class="mr-4">
        <flux:navbar.item icon="magnifying-glass" href="#" label="Search" />
        <flux:navbar.item class="max-lg:hidden" icon="cog-6-tooth" href="#" label="Settings" />
        <flux:navbar.item class="max-lg:hidden" icon="information-circle" href="#" label="Help" />
    </flux:navbar>

    <flux:dropdown position="top" align="start">
        <flux:profile avatar="https://www.pngitem.com/pimgs/m/551-5510463_default-user-image-png-transparent-png.png" />
        <flux:menu>
            <flux:menu.radio.group>
                <flux:menu.radio checked>{{ auth()->user()->name ?? 'Sadique Hussian' }}</flux:menu.radio>
            </flux:menu.radio.group>
            <flux:menu.separator />
            <flux:navbar.item href="{{ route('auth.logout') }}">Logout</flux:navbar.item>
        </flux:menu>
    </flux:dropdown>
</flux:header>

<flux:sidebar stashable sticky
    class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <!-- Light Mode Sidebar Brand -->
    <flux:brand href="{{ route('admin.dashboard') }}" logo="{{ asset('assets/LearnSyntax.png') }}" name="Acme Inc."
        class="h-12 w-12 object-contain px-2 dark:hidden" alt="Acme Inc. Logo" />
    <!-- Dark Mode Sidebar Brand -->
    <flux:brand href="{{ route('admin.dashboard') }}"
        logo="{{ asset('assets/LearnSyntax-dark.png') ?? asset('assets/LearnSyntax.png') }}" name="Acme Inc."
        class="h-12 w-12 object-contain px-2 hidden dark:flex" alt="Acme Inc. Logo (Dark)" />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="home" href="{{ route('admin.dashboard') }}" current>Home</flux:navlist.item>
        <flux:navlist.item icon="inbox" badge="12" href="#">Inbox</flux:navlist.item>
        <flux:navlist.item icon="document-text" href="#">Documents</flux:navlist.item>
        <flux:navlist.item icon="calendar" href="#">Calendar</flux:navlist.item>

        <flux:navlist.group expandable heading="Favorites" class="max-lg:hidden">
            <flux:navlist.item href="#">Marketing site</flux:navlist.item>
            <flux:navlist.item href="#">Android app</flux:navlist.item>
            <flux:navlist.item href="#">Brand guidelines</flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>

    <flux:spacer />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>
        <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
    </flux:navlist>
</flux:sidebar>