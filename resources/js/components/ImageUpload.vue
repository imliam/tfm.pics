<template>
  <div class="container m-auto mt-4">
    <label for="links" class="font-bold text-upper text-teal-darkest mb-2">Links</label>
    <p class="text-teal-darker mb-2">
      Enter as many links to images on
      <code>transformice.com</code> and
      <code>images.atelier801.com</code> as you like, with one link per line. Any link that is not already listed on the site will be added.
    </p>
    <textarea
      name="links"
      id="links"
      cols="30"
      rows="10"
      class="bg-teal-lightest appearance-none border-2 border-teal-light rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple"
      v-model="links"
    ></textarea>

    <button
      class="bg-teal hover:bg-teal-dark text-white font-bold py-2 px-4 rounded"
      @click="submit"
    >Submit links</button>

    <p v-if="error.length" class="bg-red text-white w-full px-8 py-4 rounded mt-4">{{ error }}</p>

    <table
      v-if="typeof response.data !== 'undefined' && Object.keys(response.data).length"
      class="w-full text-left table-collapse"
    >
      <thead>
        <tr>
          <th class="text-sm font-semibold text-grey-darker p-2 bg-grey-lightest">Link</th>
          <th class="text-sm font-semibold text-grey-darker p-2 bg-grey-lightest">Result</th>
        </tr>
      </thead>
      <tbody class="align-baseline">
        <tr v-for="(value, key) in response.data">
          <td
            class="p-2 border-t border-grey-light font-mono text-xs text-teal-darker whitespace-no-wrap"
          >{{ key }}</td>
          <td
            class="p-2 border-t border-grey-light text-xs text-teal-darker whitespace-no-wrap"
          >{{ value }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["url"],

  data() {
    return {
      links: "",
      response: {},
      error: ""
    };
  },

  methods: {
    submit() {
      this.error = "";
      this.response = {};

      if (this.links.length === 0) {
        this.error = "You must submit at least one link.";
        return;
      }

      axios
        .post(this.url, {
          links: this.links
        })
        .then(response => {
          this.response = response.data;
        })
        .catch(() => {
          this.error = "Something went wrong, please try again…";
        });
    }
  }
};
</script>
