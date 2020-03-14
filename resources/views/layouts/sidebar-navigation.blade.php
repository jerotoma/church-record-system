

<side-bar
    title="{{ config('app.name', 'Record System') }}"
    background-image="/storage/assets/img/sidebar-2.jpg">
    <mobile-menu-component slot="content"></mobile-menu-component>
    <sidebar-link
        is-active="{{ Request::path() == 'dashboard' ? 'active' : 'inactive' }}"
        to="/dashboard">
        <md-icon>dashboard</md-icon>
        <p>Dashboard</p>
    </sidebar-link>
    <sidebar-link
        is-active="{{ Request::is('dashboard/users') ? 'active' : 'inactive' }}"
        to="/dashboard/users">
        <md-icon>people</md-icon>
        <p>Users</p>
    </sidebar-link>
    <sidebar-link
        is-active="{{ Request::is('dashboard/members') ? 'active' : 'inactive' }}"
        to="/dashboard/members">
        <md-icon>people</md-icon>
        <p>Members</p>
    </sidebar-link>
    <sidebar-link
        is-active="{{ Request::is('dashboard/givings') ? 'active' : 'inactive' }}"
        to="/dashboard/givings">
        <md-icon>money</md-icon>
        <p>Givings</p>
    </sidebar-link>
    <sidebar-link
        is-active="{{ Request::is('dashboard/patrons') ? 'active' : 'inactive' }}"
        to="/dashboard/patrons">
        <md-icon>bubble_chart</md-icon>
        <p>Patrons</p>
    </sidebar-link>
    <collapsable-sidebar-link
        is-active="{{
            Request::is('dashboard/zones') ||
            Request::is('dashboard/parishes') ||
            Request::is('dashboard/communities')
            ? 'active' : 'inactive'
        }}"
        :link="{title: 'Parishes', icon:'home'}">
        <sidebar-link
            is-active="{{ Request::is('dashboard/parishes') ? 'active' : 'inactive' }}"
            to="/dashboard/parishes">
            <p>List of Parishes</p>
        </sidebar-link>
        <sidebar-link
            is-active="{{ Request::is('dashboard/zones') ? 'active' : 'inactive' }}"
            to="/dashboard/zones">
            <p>List of Zones</p>
        </sidebar-link>
        <sidebar-link
            is-active="{{ Request::is('dashboard/communities') ? 'active' : 'inactive' }}"
            to="/dashboard/communities">
            <p>List of Communities</p>
        </sidebar-link>
    </collapsable-sidebar-link>
    <collapsable-sidebar-link
        is-active="{{
            Request::is('dashboard/settings') ||
            Request::is('dashboard/settings') ||
            Request::is('dashboard/settings')
            ? 'active' : 'inactive'
        }}"
        :has-active-pro="'active'"
        :link="{title: 'System Settings', icon:'settings'}">
        <sidebar-link
            is-active="{{ Request::is('dashboard/settings') ? 'active' : 'inactive' }}"
            to="/dashboard/parishes">
            <p>List of Parishes</p>
        </sidebar-link>
        <sidebar-link
            is-active="{{ Request::is('dashboard/settings') ? 'active' : 'inactive' }}"
            to="/dashboard/zones">
            <p>List of Zones</p>
        </sidebar-link>
        <sidebar-link
            is-active="{{ Request::is('dashboard/settings') ? 'active' : 'inactive' }}"
            to="/dashboard/communities">
            <p>List of Communities</p>
        </sidebar-link>
    </collapsable-sidebar-link>
</side-bar>
