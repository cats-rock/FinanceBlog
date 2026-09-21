{{-- This shared layout was moved here from resources/views/components/site-layout.blade.php. --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        {{-- This shared metadata is included on every page that uses <x-site-layout>. --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Site title</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
    </head>
    <body>
    {{-- Shared navigation: changing it here changes every page that uses this layout. --}}
    <div style="background-color: #f0f0f0; padding: 10px;">
        Logo |
        @foreach($menu as $item)
            <a href="{{$item['link']}}" style="padding-right: 8px;"> {{$item['label']}} </a>
        @endforeach
    </div>

    {{-- Laravel inserts the content between <x-site-layout> and </x-site-layout> here. --}}
    {{ $slot }}

    {{-- Shared footer: individual pages no longer need to repeat this markup. --}}
    <div style="background-color: #000000; padding: 10px; color: #03FF03;">
    @foreach($menu as $item)
            <a href="{{$item['link']}}" style="padding-right: 8px; color: #03FF03;"> {{$item['label']}} </a><br/>
        @endforeach
    </div>

    </body>
</html>
