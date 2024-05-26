
<template>
  <div class="col-md-10" style="display: inline-block; position: absolute">
    <button class="bg-success">
      <router-link :to="{ name: 'module-create' }" class="text-right text-white"
        >Create</router-link
      >
    </button>
    <table id="example" class="table table-striped" style="width: 100%">
      <tr>
        <th>Sl</th>
        <th>Name</th>
        <th>Type</th>
        <th>Serial</th>
        <th>Status</th>
      </tr>

      <tbody>
        <tr v-for="(item, key) in modules" :key="key">
          <td>{{ key + 1 }}</td>
          <td>{{ item.name }}</td>
          <td v-if="item.type == '1'">Module</td>
          <td v-if="item.type == '2'">Main Menu</td>
          <td v-if="item.type == '3'">Sub Menu</td>
          <td v-if="item.type == '4'">Other</td>
          <td>{{ item.serial }}</td>
          <td>{{ item.active_status }}</td>
        </tr>
      </tbody>
    </table>
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
    document.getElementById("leftSiteBar").style.display = "inline";
  },
};
</script>



