<!-- <div class="nav-item dropdown ks-languages">
    <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
    Notifications <span class="ks-text">Notifications</span>
    </a>
    <div aria-labelledby="Preview" class="dropdown-menu dropdown-menu-right ks-scrollable" style="overflow: hidden; padding: 0px; width: 220px;">
        <div class="jspContainer" style="width: 218px; height: 300px;">
            <div class="jspPane" style="padding: 0px; top: 0px; left: 0px; width: 100px;">
                <div class="ks-wrapper">
                  
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="nav-item dropdown ks-user">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
       aria-haspopup="true" aria-expanded="false">
        <span class="ks-avatar">
            <img src="/assets/img/avatars/placeholders/ava-128.png" width="36" height="36">
        </span>
        <span class="ks-info">
            <span class="ks-name">{{ auth()->user()->name }}</span>
                        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Preview">
        <a class="dropdown-item" href="#" onclick="$('#logoutForm').submit();">
            <span class="la la-sign-out ks-icon" aria-hidden="true"></span>
            <span>Logout</span>
        </a>
        <form id="logoutForm" method="post" action="{{ url("logout") }}">
            {!! csrf_field() !!}
        </form>
    </div>
</div>
