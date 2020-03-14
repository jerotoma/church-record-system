

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
    <collapsable-sidebar-link
        is-active="{{
            Request::is('dashboard/zones') ||
            Request::is('dashboard/parishes') ||
            Request::is('dashboard/communities')
            ? 'active' : 'inactive'
        }}"
        :link="{title: 'Parishes', icon:'gamepad'}">
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
            Request::is('dashboard/patrons') ||
            Request::is('dashboard/givings')
            ? 'active' : 'inactive'
        }}"
        :link="{title: 'Contributions', icon:'local_atm'}">
        <sidebar-link
            is-active="{{ Request::is('dashboard/givings') ? 'active' : 'inactive' }}"
            to="/dashboard/givings">
            <p>Givings</p>
        </sidebar-link>
        <sidebar-link
            is-active="{{ Request::is('dashboard/patrons') ? 'active' : 'inactive' }}"
            to="/dashboard/patrons">
            <p>Patrons</p>
        </sidebar-link>
    </collapsable-sidebar-link>
    <collapsable-sidebar-link
        is-active="{{
            Request::is('dashboard/users') ||
            Request::is('dashboard/members')
            ? 'active' : 'inactive'
        }}"
        :link="{title: 'Users & Members', icon:'people'}">
        <sidebar-link
            is-active="{{ Request::is('dashboard/users') ? 'active' : 'inactive' }}"
            to="/dashboard/users">
            <p>Users</p>
        </sidebar-link>
        <sidebar-link
            is-active="{{ Request::is('dashboard/members') ? 'active' : 'inactive' }}"
            to="/dashboard/members">
            <p>Members</p>
        </sidebar-link>
    </collapsable-sidebar-link>
    <collapsable-sidebar-link
        is-active="{{
            Request::is('dashboard/settings') ||
            Request::is('dashboard/giving-types') ||
            Request::is('dashboard/securities')
            ? 'active' : 'inactive'
        }}"
        :has-active-pro="'active'"
        :link="{title: 'System Settings', icon:'settings'}">
        <sidebar-link
            is-active="{{ Request::is('dashboard/settings') ? 'active' : 'inactive' }}"
            to="/dashboard/settings">
            <p>General Settings</p>
        </sidebar-link>
        <sidebar-link
            is-active="{{ Request::is('dashboard/securities') ? 'active' : 'inactive' }}"
            to="/dashboard/securities">
            <p>Securities</p>
        </sidebar-link>
        <sidebar-link
            is-active="{{ Request::is('dashboard/giving-types') ? 'active' : 'inactive' }}"
            to="/dashboard/giving-types">
            <p>Giving Types</p>
        </sidebar-link>
    </collapsable-sidebar-link>
</side-bar>
