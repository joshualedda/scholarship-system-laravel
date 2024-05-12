<div>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        @foreach ($notifications as $notification)
            <li class="dropdown-header">
                {{ $notification->count }} grantee ('s) added by {{ $notification->data}} 
            </li>
        @endforeach
        @if ($notifications->count() === 0)
            <li class="dropdown-header">
                No students added today.
            </li>
        @endif
    </ul>
</div>

