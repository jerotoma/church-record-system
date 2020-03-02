<template>
<div class="content">
    <div class="md-layout">
        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
            <h1>{{parish.name}}</h1>
        </div>
    </div>
   <template  v-if="parish !== null && parish !== 'undefined'">
        <zone-view-component
        :parishName="name"
        :parishId="id"
    ></zone-view-component>
   </template>
</div>
</template>
<script>
import ZoneViewComponent from './zones/ZoneViewComponent.vue';
import { mapGetters } from 'vuex';

export default {
    name: 'zone-view-component',
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
            name: this.parish.name,
            id: this.parish.id,
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

<style>

</style>
