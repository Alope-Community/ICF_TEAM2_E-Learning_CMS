@if (auth()->user()->role == 'Admin' || 'admin')
    @include('layouts.sidebar.menu.admin')
@elseif (auth()->user()->role == 'Teacher' || 'teacher')
    @include('layouts.sidebar.menu.teacher')
@endif
