<template>
  <!-- <router-link :to="{ name: 'product-page', params: { pro_name: 'apple' } }"
    >Product
  </router-link>
  <br />
  <router-link :to="{ path: 'about' }">About</router-link> -->
  <div class="row">
    <div
      v-for="(item, key) in modules"
      :key="key"
      style="height: 100px; width: 200px; background-color: beige; margin: 50px"
      class="col-md-3 text-center"
    >
      <router-link :to="{ name: 'module-path', params: { link: item.id } }" class="text-center text-info"
        >{{ item.name }}
      </router-link>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      modules: {},
    };
  },

  async mounted() {
    try {
      const response = await axios.get("http://localhost:8000/api/");
      this.modules = response.data;
      // console.log(response.data);
    } catch (error) {
      // console.error("Error:", error);
    }
    document.getElementById("leftSiteBar").style.display = "none";
  },
};
</script>

