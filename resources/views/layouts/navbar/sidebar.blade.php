<ul class="nav nav-pills nav-stacked">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('trucks') }}">
            <span class="ks-icon la la-truck"></span>
            <span>Trucks</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('trips') }}">
            <span class="ks-icon la la-check-square"></span>
            <span>Trips</span>
        </a>
    </li>
     <li class="nav-item">
        <a class="nav-link" href="{{ url('approvals?status=pending') }}">
            <span class="ks-icon la la-user-plus"></span>
            <span>Approvals</span>
        </a>
    </li>
</ul>
