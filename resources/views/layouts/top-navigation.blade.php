@if (Request::path() == 'dashboard')
    <top-navbar-component
        current-page-title="Dashboard"
    ></top-navbar-component>
@elseif (Request::is('dashboard/members'))
    <top-navbar-component
        current-page-title="Members"
    ></top-navbar-component>
@elseif (Request::is('dashboard/parishes'))
    <top-navbar-component
        current-page-title="Parishes"
    ></top-navbar-component>
@elseif (Request::is('dashboard/givings'))
    <top-navbar-component
        current-page-title="Givings"
    ></top-navbar-component>
@elseif (Request::is('dashboard/patrons'))
    <top-navbar-component
        current-page-title="Patrons"
    ></top-navbar-component>
@elseif (Request::is('dashboard/maps'))
    <top-navbar-component
        current-page-title="Maps"
    ></top-navbar-component>
@else
    <top-navbar-component
        current-page-title="Dashboard"
    ></top-navbar-component>
@endif


