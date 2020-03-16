<template>
    <div class="content">
        <div class="md-layout">
             <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <nav-tabs-card>
                    <template slot="content">
                        <md-tabs class="md-success" md-alignment="left">
                        <md-tab id="tab-role" md-label="Roles" md-icon="bug_report">
                            <role-view-component></role-view-component>
                        </md-tab>
                        <md-tab id="tab-permission" md-label="Permissions" md-icon="code">
                            <permission-view-component></permission-view-component>
                        </md-tab>
                        <md-tab id="tab-active-role" md-label="server" md-icon="cloud">
                            <nav-tabs-table></nav-tabs-table>
                        </md-tab>
                        </md-tabs>
                    </template>
                </nav-tabs-card>
            </div>
        </div>
    </div>
</template>
<script>
import PermissionViewComponent from './permissions/PermissionViewComponent.vue';
import RoleViewComponent from './roles/RoleViewComponent.vue';
export default {
    components: {
        'permission-view-component': PermissionViewComponent,
        'role-view-component': RoleViewComponent,
    },
    data() {
        return {

        }
    },
    methods: {

    }

}
</script>
<style scoped>
    .md-tabs-content table thead {
        display: table-header-group;
    }
</style>
