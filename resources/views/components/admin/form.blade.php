<div>
    <!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
    <form action="{{ $action }}" method="POST">
        @csrf
        @method($method)
        {{ $slot }}
        <button type="submit" class="btn btn-primary">{{ $submit }}</button>
    </form>
    

</div>