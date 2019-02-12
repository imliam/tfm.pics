<template>
  <div class="mb-4">
    <div class="flex items-center justify-between flex-wrap bg-teal-light p-6 w-full mb-4">
      <div class="flex items-center flex-no-shrink text-white mr-6 flex-col md:flex-row w-full">
        <label class="flex items-center md:mr-4 mb-2 md:mb-0">
          <span class="mr-2">Filter</span>
          <input
            type="text"
            class="bg-teal-lightest appearance-none border-2 border-teal-light rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple"
            v-model="filterPath"
            @change="updateList()"
            @keyup="updateList()"
          >
        </label>

        <label class="md:mr-4 mb-2 md:mb-0">
          <input
            type="radio"
            name="sort-order"
            value="latest"
            v-model="sortOrder"
            @change="updateList()"
          >
          Latest first
        </label>

        <label class="md:mr-4 mb-2 md:mb-0">
          <input
            type="radio"
            name="sort-order"
            value="oldest"
            v-model="sortOrder"
            @change="updateList()"
          >
          Oldest first
        </label>

        <label class="md:mr-4 mb-2 md:mb-0">
          <input
            type="radio"
            name="sort-order"
            value="largest"
            v-model="sortOrder"
            @change="updateList()"
          >
          Largest first
        </label>

        <label class="md:mr-4 mb-2 md:mb-0">
          <input
            type="radio"
            name="sort-order"
            value="smallest"
            v-model="sortOrder"
            @change="updateList()"
          >
          Smallest first
        </label>

        <div
          class="md:ml-auto"
        >Showing {{ Math.min(amountToShow, displayedImages.length) }} of {{ displayedImages.length }} images</div>
      </div>
    </div>

    <div v-if="displayedImages.length === 0" class="container mx-auto">
      <p>No images have been found.</p>
    </div>

    <div v-else>
      <div class="flex flex-wrap items-center justify-center">
        <div v-for="(image, key) in displayedImages">
          <image-block
            v-if="key < amountToShow"
            :url="image.url"
            :path="image.path"
            :height="image.height"
            :width="image.width"
            :area="image.area"
          ></image-block>
        </div>
      </div>
      <div class="text-center" v-if="amountToShow < images.length">
        <button
          href="#"
          class="text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal bg-teal-light hover:bg-teal-lighter mt-4 md:mt-0"
          @click="showMore()"
        >Show More</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["url"],

  data() {
    return {
      amountToShow: 50,
      filterPath: "",
      loaded: false,
      images: [],
      response: null,
      displayedImages: [],
      sortOrder: "latest",
      infiniteScrollBusy: false
    };
  },

  created() {
    axios.get(this.url).then(response => {
      this.response = response.data;
      this.images = response.data.data;
      this.loaded = true;
      this.updateList();
    });
  },

  methods: {
    updateList() {
      const filterPath = this.filterPath;
      const sortOrder = this.sortOrder;
      this.amountToShow = 50;

      this.displayedImages = this.images
        .filter(function(image) {
          return image.path.toLowerCase().includes(filterPath.toLowerCase());
        })
        .sort(function(a, b) {
          if (sortOrder === "latest") {
            return new Date(b.date_added) - new Date(a.date_added);
          }

          if (sortOrder === "oldest") {
            return new Date(a.date_added) - new Date(b.date_added);
          }

          if (sortOrder === "largest") {
            return b.area - a.area;
          }

          if (sortOrder === "smallest") {
            return a.area - b.area;
          }
        });
    },

    scroll() {
      window.onscroll = () => {
        let bottomOfWindow =
          document.documentElement.scrollTop + window.innerHeight ===
          document.documentElement.offsetHeight;

        if (bottomOfWindow && this.amountToShow < this.images.length) {
          this.showMore();
        }
      };
    },

    showMore() {
      this.amountToShow = Math.min(this.amountToShow + 50, this.images.length);
    }
  },

  mounted() {
    this.scroll();
  }
};
</script>
