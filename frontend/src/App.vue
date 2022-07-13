<template>
  <main
      class="w-100 h-screen bg-gradient-to-r from-blue-600 via-blue-500 to-blue-500 relative"
  >
    <form
        class="w-11/12 md:w-1/2 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"
        @submit.prevent="generateShortURL()"
    >

      <h1 class="text-center text-white text-2xl my-4 uppercase font-bold">
        Easy and Fast.
      </h1>

      <label
          class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300"
          for="generate"
      >Long URL</label
      >
      <div class="relative">
        <div
            class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
        >
          <svg
              class="w-6 h-6 text-gray-500"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
          >
            <path
                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
            ></path>
          </svg>
        </div>
        <input
            id="generate"
            v-model="destination_url"
            class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Long URL"
            required=""
            type="url"
        />
        <button
            class="text-white absolute right-2.5 bottom-2.5 bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="submit"
        >
          Get Short URL
        </button>
      </div>
    </form>
    <Alert v-show="this.alert.show" title="Your Short URL is in your clipboard, start pasting it!."></Alert>
  </main>
</template>
<script lang="ts">
import Alert from './components/Alert.vue'
import axios from "axios";

export default {
  name: "App",
  components: {
    Alert
  },
  data() {
    return {
      destination_url: "",
      short_url: '',
      alert: {
        show: false
      }
    };
  },
  methods: {
    generateShortURL() {
      // Request to generate short url
      axios.post(import.meta.env.VITE_API_URL + '/generate/?destination=' + this.destination_url)
          .then(({data}) => {
            // save short url
            this.short_url = data.short_link

            // copy url to clipboard
            navigator.clipboard.writeText(this.short_url)

            // show success alert
            this.alert.show = true

            // hide it after 2s
            setTimeout(() => {
              this.alert.show = false
            }, 2000)
          });
    },
  },
};
</script>
