<template>
    <div class="md-content search-container">
        <div class="md-layout">
            <div class="md-layout-item md-small-size-100 md-size-100">
                <md-field md-inline>
                    <label>{{searchLabel}}</label>
                    <md-input
                        @keyup="searchForMember()"
                        v-model="searchTerm">
                    </md-input>
                </md-field>
            </div>
        </div>
        <div class="md-layout search-result md-elevation-4" :class="{'hide-result': isHide}">
            <div class="md-layout-item md-small-size-100 md-size-100">
                <md-list class="md-triple-line" v-if="members && members.length > 0">
                    <template v-for="(member, memberIndex) in members">
                        <md-list-item
                        @click="selectedMember(member)"
                        :key="memberIndex">
                            <md-avatar>
                                <img src="https://placeimg.com/40/40/people/1" alt="People">
                            </md-avatar>
                            <div class="md-list-item-text">
                                <span>{{member.firstName}} {{member.lastName}}</span>
                                <span>Email : {{member.email}} Mobile: {{member.phoneNumber}}</span>
                                <p>Belongs to {{member.community.zone.name}}'s zone and {{member.community.name}}'s community</p>
                            </div>
                        </md-list-item>
                        <md-divider class="md-inset" :key=" 'divider-' + memberIndex"></md-divider>
                    </template>
                </md-list>
                <md-list class="md-triple-line" v-else-if=" members && members.length == 0 && hasResult">
                     <md-list-item>
                         No member was founf for the search term {{searchTerm}}.
                     </md-list-item>
                </md-list>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';

export default {
    props: {
        searchLabel: {
            type: String,
            default: 'Search...'
        },
    },
    data() {
        return {
            searchTerm: null,
            isHide: false,
            members: [],
            hasResult: false
        }
    },
    methods: {
        selectedMember(member) {
            this.isHide = true;
            this.hasResult = false,
            this.members = [];
            this.searchTerm = member.firstName + ' ' + member.lastName;
            this.$emit('onSelected', {
                member: member
            });
        },
        searchForMember() {
            this.isHide = false;
            this.hasResult = false;
            if (this.searchTerm) {
                this.$store.dispatch('searchMember', {
                    searchTerm: this.searchTerm
                }).then((data) => {
                    this.hasResult = true,
                   this.members = data.members;
                }).catch((error) => {
                    console.log(error);
                });
            } else {
                this.members = [];
            }
        }
    }

}
</script>
<style scoped>
    .search-container {
        position: relative;
        width: 100%;
        font-size: 16px;
        font-weight: 400;
        text-align: left;
        text-transform: none;
    }
    .search-result {
        position: absolute;
        width: 100%;
        z-index: 100;
        top: 51px;
        left: 13px;
        border-radius: 20px;
    }
    .search-result .md-layout-item {
        padding-right: 0px;
        padding-left: 0px;
    }
    .hide-result {
       display: none;
    }
</style>
