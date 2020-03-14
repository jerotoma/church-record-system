<template>
  <div class="wrapper" :class="{ 'nav-open': $sidebar.showSidebar }">
    <notifications></notifications>
    <slot></slot>
  </div>
</template>
<style lang="scss"></style>
<script>
export default {

};
</script>
