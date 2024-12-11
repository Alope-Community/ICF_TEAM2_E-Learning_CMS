@if (auth()->user()->role == 'Admin')
    @include('layouts.sidebar.menu.admin')
@elseif (auth()->user()->role == 'Teacher')
    @include('layouts.sidebar.menu.teacher')
@endif
