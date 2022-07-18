@if ($errors->any())
    <div {{ $attributes }} id="error">
        <div class="font-medium text-red-600">{{ __('Maaf, ada yang salah.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        <x-jet-button class="ml-0 mt-2" id="btnok">
            OK
        </x-jet-button>
    </div>

    <script>
        document.getElementById('btnok').addEventListener('click', function() {
            document.getElementById('btnok').parentElement.remove();
        });
    </script>
@endif
