<template>
<div class="content">
    <template  v-if="zone && zone !== null && zone !== 'undefined'">
        <community-view-component
            :zone="zone"
        ></community-view-component>
    </template>
</div>
</template>
<script>
import CommunityViewComponent from './communities/CommunityViewComponent.vue';
import { mapGetters } from 'vuex';

export default {
    name: 'zone-show-component',
    props: {
        zone: {
            type: Object,
            required:true,
            default: null
        },
    },
    computed: {
        ...mapGetters([

        ]),
    },
    components: {
        CommunityViewComponent
    },
    data(){
        return {
        }
    },
    methods: {
        loadParish(parishId) {
            this.$store.dispatch('loadZone', { zoneId: this.zone.id, parishId: this.zone.parishId});
        }
    },
    created() {
       // this.loadParish(this.parish.id);
    }

}
</script>

<style scoped>
    .main-panel > .content {
        padding:0;
    }
    .md-ripple > span {
        position: relative;
    }
</style>
