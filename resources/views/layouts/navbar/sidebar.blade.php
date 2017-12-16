<ul class="nav nav-pills nav-stacked">
    @role('admin')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="ks-icon la la-file-excel-o"></span>
            <span>Reports</span>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url("reports/p-l-report") }}">P/L Report</a>
        </div>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('reports/route-report') }}">Route Expense Report</a>
        </div>
    </li>
    @endrole
    <li class="nav-item">
        <a class="nav-link" href="{{ url('trucks') }}">
            <span class="ks-icon la la-truck"></span>
            <span>Trucks</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="ks-icon la la-check-square"></span>
            <span>Trips</span>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('trips') }}">Trips</a>
        </div>
         <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('trips/orders/pods?status=pending') }}">PODs</a>
        </div>

    </li>
     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="ks-icon la la-inr"></span>
            <span>Finances</span>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('trips/orders/credits') }}">Credits</a>
        </div>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('trips/orders/balance-payments') }}">Balance Payments</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="ks-icon la la-money"></span>
            <span>Requirements</span>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('requirements/create') }}">Create</a>
        </div>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('requirements?status=pending') }}">Approve</a>
        </div>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('requirements/remittance') }}">Remittance</a>
        </div>
    </li>
</ul>
