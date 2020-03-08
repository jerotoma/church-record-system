<template>
<div class="content">
    <template  v-if="parish && parish !== null && parish !== 'undefined'">
        <zone-view-component
            :parish="parish"
        ></zone-view-component>
    </template>
</div>
</template>
<script>
import ZoneViewComponent from '../zones/ZoneViewComponent.vue';
import { mapGetters } from 'vuex';

export default {
    name: 'parish-view-component',
    props: {
        parish: {
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
        ZoneViewComponent
    },
    data(){
        return {
        }
    },
    methods: {
        loadParish(parishId) {
            this.$store.dispatch('loadParish', parishId);
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
