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
@elseif (Request::is('dashboard/zones'))
    <top-navbar-component
        current-page-title="Zones"
    ></top-navbar-component>
@elseif (Request::is('dashboard/communities'))
    <top-navbar-component
        current-page-title="Communities"
    ></top-navbar-component>
@elseif (Request::is('dashboard/givings'))
    <top-navbar-component
        current-page-title="Givings"
    ></top-navbar-component>
@elseif (Request::is('dashboard/settings'))
    <top-navbar-component
        current-page-title="General Settings"
    ></top-navbar-component>
@elseif (Request::is('dashboard/securities'))
    <top-navbar-component
        current-page-title="System Securities"
    ></top-navbar-component>
@elseif (Request::is('dashboard/giving-types'))
    <top-navbar-component
        current-page-title="Giving Types"
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


