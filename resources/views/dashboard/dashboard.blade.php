@if (auth()->user()->role == 'Admin')
    @include('dashboard.menu.admin')
@elseif (auth()->user()->role == 'Teacher')
    @include('dashboard.menu.teacher')
@endif
