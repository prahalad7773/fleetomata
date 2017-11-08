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
    {{-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="ks-icon la la-file-excel-o"></span>
            <span>Reports</span>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url("reports/p-l-report") }}">P/L Report</a>
        </div>
    </li> --}}
</ul>
