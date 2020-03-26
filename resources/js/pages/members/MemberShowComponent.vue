<template>
    <div class="content">
        <div class="md-layout">
             <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <nav-tabs-card>
                    <template slot="content">
                        <md-tabs class="md-success" md-alignment="left">
                        <md-tab id="tab-my-profile" md-label="Member Profile" md-icon="bug_report">
                            <member-profile-component
                                :member="member"
                            ></member-profile-component>
                        </md-tab>
                        <md-tab id="tab-my-giving" md-label="Member Givings" md-icon="code">
                            <member-giving-component
                                :member="member"
                            ></member-giving-component>
                        </md-tab>
                        <md-tab id="tab-edit-my-profile" md-label="Edit My Profile" md-icon="cloud">
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
import MemberProfileComponent from './MemberProfileComponent';
import MemberGivingComponent from './MemberGivingComponent';
import { mapGetters } from 'vuex';

export default {
  name: "member-show-component",
    props: {
        member: {
        type: Object,
        required: true,
        }
     },
    computed:{
        ...mapGetters([
            'givings',
            'pagination',
        ]),
    },
  components: {
      MemberProfileComponent,
      MemberGivingComponent,
  },
  data() {
    return {};
  },
  methods: {
    loadGivingsByMemberId() {
        this.$store.dispatch('loadGivingsByMemberId', {
            memberId: this.member.id,
            pagination: this.pagination
        });
    },

  },
  created() {
     this.loadGivingsByMemberId();
  }
};
</script>
<style>
    .md-card{
        margin: 0 0;
    }
</style>
