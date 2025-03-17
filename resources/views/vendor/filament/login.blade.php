<form wire:submit.prevent="authenticate" class="space-y-8">
    <img id="logo" src="{{ URL::to('images/event_tube_logo.png') }}" width="350px" height="auto" alt="Logo">
    <x-filament::button class="w-full">
        <a href="{{ url('auth/google/redirect') }}" class="w-full font-bold text-lg">
            Log in with Google
        </a>
    </x-filament::button>
</form>

<script>
    function setLogo() {
        const logo = document.getElementById('logo');
        const theme = localStorage.getItem('theme');

        if (theme === 'light') {
            logo.src = '{{ URL::to('images/event_tube_logo.png') }}';
        } else if (theme === null || theme === 'dark') {
            logo.src = '{{ URL::to('images/event_tube_logo.png') }}';
        }
    }

    window.addEventListener('load', setLogo);
    window.addEventListener('storage', setLogo);
</script>

