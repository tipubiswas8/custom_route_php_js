<template>
  <div class="col-md-10" style="display: inline-block; position: absolute">
    <form @submit.prevent="submitForm">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label" for="name">Module Name:</label>
              <input
                id="name"
                type="text"
                v-model="formData.name"
                class="form-control"
              />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label" for="serial">Serial:</label>
              <input
                id="serial"
                type="text"
                v-model="formData.serial"
                class="form-control"
              />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label" for="status">Status:</label>
              <select
                id="status"
                v-model="formData.status"
                class="form-control"
              >
                <option value="1" selected>Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input
                id="submit"
                type="submit"
                class="form-control bg-primary mt-5 text-white"
                value="Submit"
              />
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      formData: {
        name: "",
        serial: "",
        status: "",
      },
    };
  },

  methods: {
   async submitForm() {
     await axios.post('http://localhost:8000/api/module/store', this.formData)
        .then(response => {
          console.log(response.data);
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
  }
  
};
//document.getElementById("leftSiteBar").style.display = "inline";
</script>