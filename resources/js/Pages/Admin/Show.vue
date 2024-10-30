<script setup>
import PaginationLinks from "../../Components/PaginationLinks.vue";
import ApprovedListing from "../../Components/ApprovedListing.vue";
import SessionMessages from "../../Components/SessionMessages.vue";


defineProps({
    listings: Object,
    status: String
});

</script>

<template>


  <div>

    <Head title="- Admin Dashboard" />

   <div class="flex items-center">

    <div class="mb-5 mr-10">Users Listings</div>

    <SessionMessages :status="status" />
   </div>

    <table
      v-if="listings"
      class="bg-white dark:bg-slate-800 w-full rounded-lg overflow-hidden ring-1 ring-slate-300"
    >
      <thead>
        <tr class="bg-slate-600 text-slate-300 text-xs text-left uppercase">
          <th class="w-3/6 p-3">Image</th>
          <!-- <th class="w-3/6 p-3">Title</th> -->
          <th class="w-1/6 p-3">Email</th>
          <th class="w-1/6 p-3">Link</th>
          <th class="w-1/6 p-3">Approved</th>
          <th class="w-1/6 p-3 text-right">View</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-slate-300 divide-dashed">
        <tr v-for="listing in listings.data" :key="listing.id">

            <td class="w-3/6 py-5 px-3">
    
                <img class="w-full h-[100px] object-cover object-center" :src="listing.image ? `/storage/${listing.image}` : '/storage/images/listing/default.jpg' " alt="">
    
              </td>

          <!-- <td class="w-3/6 py-5 px-3">
    
            <p class="font-bold mb-1">{{ listing.title }}</p>

          </td> -->

          <td class="w-2/6 py-5 px-3">{{ listing.email }}</td>

          <td class="w-2/6 py-5 px-3">{{ listing.link }}</td>

          <td class="w-2/6 py-5 px-3"> 

            <ApprovedListing :listing="listing"/>
            
          </td>

          <td v-if="listing.approved" class="w-1/6 py-5 px-3"><Link :href="route('listings.show', listing.id)">View</Link></td>

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