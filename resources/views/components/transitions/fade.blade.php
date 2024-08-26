@props([
    'onEnterOnly' => false,
    'onLeaveOnly' => false,

    'enter' => 'duration-300 ease-in-out',
    'enterStart' => 'opacity-0',
    'enterEnd' => 'opacity-100',

    'leave' => 'duration-100 ease-in',
    'leaveStart' => 'opacity-0',
    'leaveEnd' => 'opacity-100',
])

<div
    x-transition:enter="{{ $onLeaveOnly ? null : $enter }}"
    x-transition:enter-start="{{ $onLeaveOnly ? null : $enterStart }}"
    x-transition:enter-end="{{ $onLeaveOnly ? null : $enterEnd }}"

    x-transition:leave="{{ $onEnterOnly ? null : $leave }}"
    x-transition:leave-start="{{ $onEnterOnly ? null : $leaveStart }}"
    x-transition:leave-end="{{ $onEnterOnly ? null : $leaveEnd }}"

    {{ $attributes }}>

    {{ $slot }}

</div>
