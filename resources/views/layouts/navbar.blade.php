@if (Request::path() == 'dashboard')
    <navbar-component
        current-page-title="Dashboard"
    ></navbar-component>
@elseif (Request::is('dashboard/members'))
    <navbar-component
        current-page-title="Members"
    ></navbar-component>
@elseif (Request::is('dashboard/parishes'))
    <navbar-component
        current-page-title="Parishes"
    ></navbar-component>
@elseif (Request::is('dashboard/zones'))
    <navbar-component
        current-page-title="Zones"
    ></navbar-component>
@elseif (Request::is('dashboard/communities'))
    <navbar-component
        current-page-title="Communities"
    ></navbar-component>
@elseif (Request::is('dashboard/givings'))
    <navbar-component
        current-page-title="Givings"
    ></navbar-component>
@elseif (Request::is('dashboard/settings'))
    <navbar-component
        current-page-title="General Settings"
    ></navbar-component>
@elseif (Request::is('dashboard/securities'))
    <navbar-component
        current-page-title="System Securities"
    ></navbar-component>
@elseif (Request::is('dashboard/giving-types'))
    <navbar-component
        current-page-title="Giving Types"
    ></navbar-component>
@elseif (Request::is('dashboard/patrons'))
    <navbar-component
        current-page-title="Patrons"
    ></navbar-component>
@elseif (Request::is('dashboard/maps'))
    <navbar-component
        current-page-title="Maps"
    ></navbar-component>
@else
    <navbar-component
        current-page-title="Dashboard"
    ></navbar-component>
@endif


