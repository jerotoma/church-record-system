

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
        is-active="{{ Request::is('dashboard/members') ? 'active' : 'inactive' }}"
        to="/dashboard/members">
        <md-icon>people</md-icon>
        <p>Members</p>
    </sidebar-link>
    <sidebar-link
        is-active="{{ Request::is('dashboard/parishes') ? 'active' : 'inactive' }}"
        to="/dashboard/parishes">
        <md-icon>content_paste</md-icon>
        <p>Parishes</p>
    </sidebar-link>
    <sidebar-link
        is-active="{{ Request::is('dashboard/typography') ? 'active' : 'inactive' }}"
        to="/dashboard/typography">
        <md-icon>library_books</md-icon>
        <p>Typography</p>
    </sidebar-link>
    <sidebar-link
        is-active="{{ Request::is('dashboard/icons') ? 'active' : 'inactive' }}"
        to="/dashboard/icons">
        <md-icon>bubble_chart</md-icon>
        <p>Icons</p>
    </sidebar-link>
    <sidebar-link
        is-active="{{ Request::is('dashboard/maps') ? 'active' : 'inactive' }}"
        to="/dashboard/maps">
        <md-icon>location_on</md-icon>
        <p>Maps</p>
    </sidebar-link>
    <sidebar-link
        is-active="{{ Request::is('dashboard/notifications') ? 'active' : 'inactive'}}"
        to="/dashboard/notifications">
        <md-icon>notifications</md-icon>
        <p>Notifications</p>
    </sidebar-link>
    <sidebar-link
        is-active="{{ Request::is('dashboard/upgrade') ? 'active' : 'inactive' }}"
        to="/dashboard/upgrade" class="active-pro">
        <md-icon>unarchive</md-icon>
        <p>Upgrade to PRO</p>
    </sidebar-link>
</side-bar>
