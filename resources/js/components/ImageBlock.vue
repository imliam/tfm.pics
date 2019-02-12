<template>
  <div class="px-4 py-2 mb-2">
    <div>
      <img :src="url" :alt="path" class="h-16 rounded-lg image-block" @click="showModal()">
    </div>
    <!-- <a :href="url">{{ path }}</a> -->
  </div>
</template>

<script>
export default {
  props: ["url", "path", "height", "width", "area"],

  methods: {
    showModal() {
      console.log(this.$props);
      return window
        .vueModal()
        .image(this.$props)
        .show();
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
