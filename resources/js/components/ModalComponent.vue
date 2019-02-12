<template>
  <div
    v-if="modal.visible"
    @click.self="dismissModal"
    class="pin absolute flex items-center justify-center bg-transparent-black"
  >
    <div class="bg-white rounded shadow p-8 m-4 max-w-lg max-h-full overflow-y-scroll min-w-md">
      <div class="mb-4">
        <!-- <h1>{{ modal.header }}</h1> -->
      </div>

      <div class="mb-4">
        <a :href="image.path">
          <img :src="url" :alt="path" class="h-16 rounded-lg image-block">
        </a>
      </div>

      <div class="mb-8">
        <!-- <p>{{ modal.body }}</p> -->
      </div>
      <div>
        <button class="text-white py-2 px-4 rounded bg-teal-dark" @click="dismissModal">Ok</button>
      </div>
    </div>
  </div>
</template>

<script>
import VueModal from "../modal.js";

export default {
  data() {
    return {
      modal: {
        image: {},
        visible: false
      }
    };
  },

  created() {
    this.initModal();
  },

  methods: {
    initModal() {
      window.vueModal = (image = {}, visible = true) => {
        return new VueModal(image, visible);
      };

      this.initListeners();
    },

    initListeners() {
      window.bus.$on("show-modal", modal => {
        this.modal = modal;
        document.body.classList.add("overflow-hidden");
      });

      window.bus.$on("dismiss-modal", () => {
        this.modal.visible = false;
        document.body.classList.remove("overflow-hidden");
      });
    },

    dismissModal() {
      return vueModal().dismiss();
    }
  }
};
</script>

<style>
.image-block {
  background: #fff;
  background-image: url(/images/transparent-grid.png);
}
</style>
