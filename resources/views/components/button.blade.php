<a href="{{ $route ? $route : ' ' }}"
    class="{{ $color }} {{ $hover }} {{ $margin }}">
    <i class="{{ $icon ? $icon : ' ' }}"></i>
    {{ $slot }}
</a>
