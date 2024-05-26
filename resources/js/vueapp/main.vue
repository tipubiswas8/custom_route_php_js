<template>
  <app-header></app-header>
  <app-left-sidebar></app-left-sidebar>
  <router-view></router-view>
  <app-right-sidebar></app-right-sidebar>
  <app-footer></app-footer>
</template>

<script>
import AppHeader from "./components/myHeader.vue";
import AppLeftSidebar from "./components/left-sidebar.vue";
import AppRightSidebar from "./components/right-sidebar.vue";
import AppFooter from "./components/myFooter.vue";
export default {
  components: { AppHeader, AppFooter, AppLeftSidebar, AppRightSidebar },
};
</script>
