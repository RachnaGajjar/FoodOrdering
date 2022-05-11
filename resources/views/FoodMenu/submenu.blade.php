<?php /*@if ((count($menu->children) > 0) AND ($menu->parent_id > 0))

<li class="nav-item dropdown">
    <a href="{{ url($menu->slug) }}" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">
        {{ $menu->menu_title }}
        @if(count($menu->children) > 0)
        <i class="fa fa-caret-right"></i>
        @endif
    </a>
    @else
<li class="nav-item @if($menu->parent_id === 0 && count($menu->children) > 0) dropdown @endif">
    <a href="{{ url($menu->slug) }}" class="nav-link dropdown-toggle" data-toggle="dropdown">
        {{ $menu->menu_title }}
        @if(count($menu->children) > 0)
            <i class="fa fa-caret-down"></i>
        @endif
    </a>
    @endif
    @if (count($menu->children) > 0)
    <ul class="@if($menu->parent_id !== 0 && (count($menu->children) > 0)) submenu @endif dropdown-menu" aria-labelledby="dropdownBtn">
        @foreach($menu->children as $menu)
        @include('FoodMenu.submenu', $menu)
        @endforeach
    </ul>
    @endif
</li>*/ ?>



{{-- //Important
    @foreach ($menu->children as $menu)
        @if(isset($menu->children) && $menu->children->count() > 0)
            @each('FoodMenu.submenu', $menu->children, 'menu', 'empty')
        @else
            <option value="">{{ $menu->menu_title }}</option>
        @endif
    <option value="">-{{ $menu->menu_title }}</option>
    @endforeach --}}




{{--
@if ($menu->children->count() > 0)
    <option value="">-{{ $menu->menu_title }}</option>

    @foreach ($menu->children as $menu)
        @include('FoodMenu.submenu', $menu)
    @endforeach

@else
    @if($menu->parent_id == 0)
        <option value="">55{{ $menu->menu_title }}</option>
    @endif
@endif
 --}}
 @foreach ($menu->children as $menu)
        @if(isset($menu->children) && $menu->children->count() > 0)
            @each('FoodMenu.submenu', $menu->children, 'menu', 'empty')
        @else
            <option value="">{{ $menu->menu_title }}</option>
        @endif
    <option value="">-{{ $menu->menu_title }}</option>
    @endforeach
