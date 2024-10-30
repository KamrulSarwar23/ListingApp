<script setup>
import PaginationLinks from "../../Components/PaginationLinks.vue";
import ApprovedListing from "../../Components/ApprovedListing.vue";
import SessionMessages from "../../Components/SessionMessages.vue";
import Title from "../../Components/Title.vue";
import { router, useForm } from "@inertiajs/vue3";
import InputField from "../../Components/InputField.vue";

const params = route().params;

const props = defineProps({
  listings: Object,
  user: Object,
  status: String,
});

const form = useForm({
  search: params.search,
});

const search = () => {
  router.get(
    route("admin.show", {
      user: props.user.id,
      search: form.search,
    })
  );
};

const showDisapproved = (e) => {
  if (e.target.checked) {
    router.get(
      route("admin.show", {
        search: params.search,
        user: props.user.id,
        disapproved: true,
      })
    );
  } else {
    router.get(
      route("admin.show", {
        search: params.search,
        user: props.user.id,
        disapproved: null,
      })
    );
  }
};


const toggleApprove = (listing) => {

    let msg = listing.approved ? 'Disapproved This Listing' : 'Approve This Listing'


    if (confirm(msg)) {
      router.put(route('listing.approved', listing.id));

    }   
}


</script>

<template>
  <div>
    <Head :title="`${user.name} Listing`" />
    <div class="mb-5 mr-5">
      <Title>{{ user.name }} Latest Listings</Title>
    </div>

    <div class="flex items-center justify-between">
      <div
        class="flex items-center gap-1 text-xs hover:bg-slate-300 dark:hover:bg-slate-800 px-2 py-1 rounded-md"
      >
        <input
          @input="showDisapproved"
          :checked="params.disapproved"
          type="checkbox"
          id="showDisapproved"
          class="rounded-md border-1 outline-0 text-indigo-500 ring-indigo-500 border-slate-700 cursor-pointer"
        />
        <label
          for="showDisapproved"
          class="block text-sm font-medium text-slate-700 dark:text-slate-300 cursor-pointer"
        >
          Show Disapproved Listing
        </label>
      </div>

      <div class="flex items-center justify-between">
        <div class="mb-5">
          <Link
            class="px-2 py-1 rounded-md bg-indigo-500 text-white flex items-center gap-2 mr-2"
            v-if="params.search"
            :href="
              route('admin.show', {
                ...params,
                search: null,
                page: null,
                user: user.id,
              })
            "
            >{{ params.search }}
            <i class="fa-solid fa-xmark"></i>
          </Link>
        </div>
        <div class="w-1/10 mb-5">
          <form @submit.prevent="search">
            <InputField
              type="search"
              label=""
              icon="magnifying-glass"
              placeholder="Search..."
              v-model="form.search"
            />
          </form>
        </div>
      </div>
    </div>

    <SessionMessages :status="status" />

    <table
      v-if="listings"
      class="bg-white dark:bg-slate-800 w-full rounded-lg overflow-hidden ring-1 ring-slate-300"
    >
      <thead>
        <tr class="bg-slate-600 text-slate-300 text-xs text-left uppercase">
          <th class="w-3/6 p-3">Image</th>
          <!-- <th class="w-3/6 p-3">Title</th> -->
          <th class="w-1/6 p-3">Title</th>
          <th class="w-1/6 p-3">Approved</th>
          <th class="w-1/6 p-3 text-right">View</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-slate-300 divide-dashed">
        <tr v-for="listing in listings.data" :key="listing.id">
          <td class="w-3/6 py-5 px-3">
            <img
              class="w-full h-[100px] object-cover object-center"
              :src="
                listing.image
                  ? `/storage/${listing.image}`
                  : '/storage/images/listing/default.jpg'
              "
              alt=""
            />
          </td>
          <td class="w-2/6 py-5 px-3">{{ listing.title }}</td>

          <td class="w-1/6 py-5 px-3">
           <button @click.prevent="toggleApprove(listing)">
            <i
            :class="`fa-solid fa-${
              listing.approved
                ? 'circle-check text-green-500'
                : 'circle-xmark text-red-500'
            }`"
          ></i>
           </button>
          </td>


          <td class="w-1/6 py-5 px-3">
            <Link
              class="fa-solid fa-up-right-from-square px-3 text-indigo-400"
              :href="route('listings.show', listing.id)"
            ></Link>
          </td>
        </tr>
      </tbody>
    </table>

    <div v-else>
      <h1>No Data Found</h1>
    </div>

    <div class="mt-8">
      <PaginationLinks :paginator="listings" />
    </div>
  </div>
</template>