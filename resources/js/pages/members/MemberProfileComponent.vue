<template>
   <div class="md-layout">
       <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
            <div class="viewport">
                <md-toolbar :md-elevation="1">
                    <span class="md-title">User Information</span>
                </md-toolbar>
                <md-list class="md-double-line">
                    <md-subheader>Full Name</md-subheader>
                    <md-list-item>
                        <md-icon class="md-primary">person</md-icon>
                        <div class="md-list-item-text">
                            <span>{{member.firstName}} {{member.middleName}}  {{member.lastName}}</span>
                            <span>Names</span>
                        </div>
                    </md-list-item>
                    <md-divider></md-divider>
                    <md-subheader>Gender</md-subheader>
                    <md-list-item>
                        <md-icon class="md-primary">wc</md-icon>
                        <div class="md-list-item-text">
                            <span>{{member.gender}}</span>
                            <span>Mobile</span>
                        </div>
                    </md-list-item>
                    <md-divider></md-divider>
                    <md-subheader>Phone</md-subheader>
                    <md-list-item>
                        <md-icon class="md-primary">phone</md-icon>
                        <div class="md-list-item-text">
                            <span>{{member.phoneNumber}}</span>
                            <span>Mobile</span>
                        </div>
                    </md-list-item>
                    <md-divider></md-divider>
                    <md-subheader>Email</md-subheader>
                    <md-list-item>
                        <md-icon class="md-primary">email</md-icon>
                        <div class="md-list-item-text">
                            <span>{{member.email}}</span>
                            <span>Personal</span>
                        </div>
                    </md-list-item>
                    <md-divider></md-divider>
                    <md-subheader>Work</md-subheader>
                    <md-list-item>
                        <md-icon class="md-primary">work</md-icon>
                        <div class="md-list-item-text">
                            <span>{{member.occupation}}</span>
                            <span>Job</span>
                        </div>
                    </md-list-item>
                </md-list>
            </div>
        </div>
        <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-50">
            <div class="viewport">
                <md-toolbar :md-elevation="1">
                    <span class="md-title">Membership</span>
                </md-toolbar>
                <md-list class="md-double-line">
                    <md-subheader>Parish</md-subheader>
                    <md-list-item>
                        <md-icon class="md-primary">location_city</md-icon>
                        <div class="md-list-item-text">
                            <span>{{member.community.zone.parish.name}}</span>
                            <span>Parish</span>
                        </div>
                    </md-list-item>
                    <md-divider></md-divider>
                    <md-subheader>Zone</md-subheader>
                    <md-list-item>
                        <md-icon class="md-primary">radio_button_checked</md-icon>
                        <div class="md-list-item-text">
                            <span>{{member.community.zone.name}}</span>
                            <span>zone</span>
                        </div>
                    </md-list-item>
                    <md-divider></md-divider>
                    <md-subheader>Community</md-subheader>
                    <md-list-item>
                        <md-icon class="md-primary">people</md-icon>
                        <div class="md-list-item-text">
                            <span>{{member.community.name}}</span>
                            <span>Community</span>
                        </div>
                    </md-list-item>
                </md-list>
            </div>
        </div>
        <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-50">
            <div class="viewport">
                <md-toolbar :md-elevation="1">
                    <span class="md-title">Address</span>
                </md-toolbar>
                <md-list class="md-double-line">
                    <md-subheader>Address & Unit</md-subheader>
                    <md-list-item>
                        <md-icon class="md-primary">location_city</md-icon>
                        <div class="md-list-item-text">
                            <span>{{member.streetAddress}} {{member.unitNumber}}</span>
                            <span> Address & Unit</span>
                        </div>
                    </md-list-item>
                    <md-divider></md-divider>
                    <md-subheader>City</md-subheader>
                    <md-list-item>
                        <md-icon class="md-primary">radio_button_checked</md-icon>
                        <div class="md-list-item-text">
                            <span>{{member.city}}</span>
                            <span>City</span>
                        </div>
                    </md-list-item>
                    <md-divider></md-divider>
                    <md-subheader>State & Country</md-subheader>
                    <md-list-item>
                        <md-icon class="md-primary">people</md-icon>
                        <div class="md-list-item-text">
                            <span>{{member.state}} {{member.country}}</span>
                            <span>State & Country</span>
                        </div>
                    </md-list-item>
                </md-list>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  name: "member-profile-component",
  props: {
    member: {
      type: Object,
      required: true,
    }
  },
  data() {
    return {
         avatar: null,
    };
  }
};
</script>
<style lang="scss" scoped>
    .viewport {
        margin-bottom: 0.75rem;
        border: 1px solid rgba(#000, .12);
        border-radius: 10px;
    }

</style>
