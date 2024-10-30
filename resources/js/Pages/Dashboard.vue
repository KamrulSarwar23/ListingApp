<script setup>
import { router } from "@inertiajs/vue3";
import Title from "../Components/Title.vue";
import SessionMessages from "../Components/SessionMessages.vue";
import PaginationLinks from "../Components/PaginationLinks.vue";

const props = defineProps({
  listings: Object,
  status:String
});

const deleteListing = (id) => {
  if (confirm("Are You Sure?")) {
    router.delete(route("listings.destroy", id));
  }
};
</script>



<template>
  <div>
    <Head title="- Dashboard" />

    

    <div v-if="listings">
      <div v-if="Object.keys(listings.data).length">

       <div>
        <div class="flex items-center justify-between mb-4">
            <Title>Your Latest Listings</Title>

            <SessionMessages :status="status"/>
  
            <div class="flex items-center gap-4 text-xs">
              <p>
                Approved <i class="fa-solid fa-circle-check text-green-500"></i>
              </p>
              <p>
                Pending Approved
                <i class="fa-solid fa-circle-xmark text-red-500"></i>
              </p>
            </div>
          </div>
  
          <table
            class="w-full table-fixed border-collapse overflow-hidden rounded-md text-sm ring-1 ring-slate-300 dark:ring-slate-600 bg-white shadow-lg"
          >
            <thead
              class="bg-slate-300 text-xs uppercase text-slate-600 dark:slate-400 dark:bg-slate-900"
            >
              <tr>
                <th class="w-3/4 p-3 text-left">Listing Title</th>
  
                <th class="w-1/4 py-3 pr-3 text-right">View</th>
                <th class="w-1/4 py-3 pr-3 text-right">Edit</th>
                <th class="w-1/4 py-3 pr-3 text-right">Delete</th>
              </tr>
            </thead>
  
            <tbody>
              <tr
                v-for="listing in listings.data"
                :key="listing.id"
                class="border-b border-slate-200 hover:bg-slate-100 dark:bg-slate-800 dark:hover:bg-slate-600 dark:border-slate-600"
              >
                <td class="w-3/4 p-3 text-left">
                  <div class="flex items-center gap-2">
                    <img
                      class="h-10 w-10 rounded-full object-cover object-center"
                      :src="
                        listing.image
                          ? `/storage/${listing.image}`
                          : '/storage/images/listing/default.jpg'
                      "
                      alt=""
                    />
  
                    <h4 class="font-bold">
                      {{ listing.title }}
                      <i
                        :class="`fa-solid fa-${
                          listing.approved
                            ? 'circle-check text-green-500'
                            : 'circle-xmark text-red-500'
                        }`"
                      ></i>
                    </h4>
                  </div>
                </td>
  
                <td class="w-1/4 py-3 pr-3 text-right text-indigo-500">
                  <Link
                    v-if="listing.approved"
                    :href="route('listings.show', listing.id)"
                    >View</Link
                  >
                </td>
  
                <td class="w-1/5 py-3 pr-3 text-right text-indigo-500">
                  <Link :href="route('listings.edit', listing.id)">Edit</Link>
                </td>
  
                <td class="w-1/5 py-3 pr-3 text-right text-red-500">
                  <button @click="deleteListing(listing.id)"
                    type="submit">
                    Delete
                  </button>
                </td>
              </tr>
  
  
            </tbody>
          </table>
       </div>

       <div class="mt-8">
        <PaginationLinks :paginator="listings" />
       </div>


      </div>

      <div v-else>You have no listings!</div>
    </div>

    <div v-else>
      Due to violation of our terms your account has been suspended, Please
      contact us at <span class="text-link">email@admin.com</span>
    </div>
  </div>
</template>