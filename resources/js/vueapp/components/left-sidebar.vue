
<template>
  <div id="leftSiteBar">
    <div
      class="col-md-2"
      style="
        height: 800px;
        background-color: #dde39f;
        display: inline-block;
        position: relative;
      "
    >
      <div class="text-white">
        <router-link :to="{ path: '/' }">Dashboard</router-link>
        <br />
        <router-link :to="{ path: this.moduleRoute.url }">{{ this.module.name }}</router-link>
        <br />
        <router-link
          style="margin-left: 15px"
          v-for="(mainMenu, index) in mainMenus"
          :key="index"
          :to="{ path: this.mmRoute[index].url }"
          >{{ mainMenu.name }}
          <br />
          <router-link
          v-for="(subMenu, index) in sMenus"
          :key="index"
          :to="{ name: this.smRoute[index].name }"
          >
            <div
              v-if="mainMenu.id == subMenu.parent_menu_id"
              style="margin-left: 30px"
            >
              {{ subMenu.name }}
            </div>
          </router-link>
        </router-link>
        <br />
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      module: {},
      moduleRoute: [],
      mainMenus: {},
      mmRoute: [],
      sMenus: {},
      smRoute: [],
    };
  },

  async mounted() {
    try {
      const response = await axios.get("/api/module/path/" + 1);
      this.module = response.data.module;
      this.moduleRoute = response.data.moduleRoute;
      this.mainMenus = response.data.mainMenus;
      this.mmRoute = response.data.mmRoute;
      this.sMenus = response.data.sMenus;
      this.smRoute = response.data.smRoute;
      // console.log(this.smRoute);
    } catch (error) {
       console.log(error);
    }
  },
};
</script>
