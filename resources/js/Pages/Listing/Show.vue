<script setup>
import { Head, router } from "@inertiajs/vue3";
import Container from "../../Components/Container.vue";


const props = defineProps({
    listing:Object,
    user: Object,
    canModify: Boolean
})

const deleteListing = (id) => {

    if (confirm('Are You Sure?')) {
        router.delete(route('listings.destroy', props.listing.id))
    }
 
}

const toggleApprove = () => {

let msg = props.listing.approved ? 'Disapproved This Listing' : 'Approve This Listing'

if (confirm(msg)) {
  router.put(route('listing.approved', props.listing.id));

}   
}

</script>

<template>
    <div>

        <Head title="- Listing Details"/>

        <div v-if="$page.props.auth.user.role === 'admin'" class="bg-slate-800 text-white mb-6 p-6 rounded-md font-medium flex items-center justify-between">
            <p>This listing is {{listing.approved ? 'approved' : 'Not Approved'}}</p>

            <button @click.prevent="toggleApprove" class="bg-slate-600 px-3 py-1 rounded-md">
                {{ listing.approved ? 'Disapprove it' : 'Approve it'}}
            </button>
        </div>

        <Container class="flex gap-4">
            <div class="w-1/4 rounded-md overflow-hidden">
                <img class="w-full h-[150px] object-cover object-center" :src="listing.image ? `/storage/${listing.image}` : '/storage/images/listing/default.jpg' " alt="">
            </div>

            <div class="w-3/4">
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-slate-400 w-full border-b">Listing Details</p>

                        <div class="pl-4 flex items-center gap-4">


                           <Link v-if="canModify" class="bg-green-500 rounded-md text-white px-6 py-2 hover:outline outline-green-500 outline-offset-2" :href="route('listings.edit', listing.id )">Edit</Link>
                
                            <button v-if="canModify" @click="deleteListing" type="submit" class="bg-red-500 rounded-md text-white px-6 py-2 hover:outline outline-red-500 outline-offset-2">Delete</button>
                    

                        </div>
                    </div>

                    <h3 class="font-bold text-2xl mb-4">{{listing.title}}</h3>

                    <p>{{listing.desc}}</p>
                </div>

                <div v-if="listing.email" class="mb-6">
                    <p class="text-slate-400 w-full border-b mb-2">Contact Info</p>        

                    <div class="flex items-center mb-2 gap-2">
                        <i class="fa-solid fa-at"></i>
                        <p>Email:</p>
                        <a :href="`mailto:${listing.email}`" class="text-link">{{listing.email}}</a>
                    </div>
                </div>


                <div v-if="listing.link" class="mb-6">
                    <p class="text-slate-400 w-full border-b mb-2">Contact Info</p>        

                    <div class="flex items-center mb-2 gap-2">
                        <i class="fa-solid fa-up-right-from-square"></i>
                        <p>External Link:</p>
                        <a :href="listing.link" target="_blank" class="text-link">{{listing.link}}</a>
                    </div>
                </div>

                <div class="mb-6">
                    <p class="text-slate-400 w-full border-b mb-2">Contact Info</p>        

                    <div class="flex items-center mb-2 gap-2">
                        <i class="fa-solid fa-up-right-from-square"></i>
                        <p>Listed By:</p>

                       <Link class="text-link" :href="route('home', { user_id:user.id })">{{user.name}}</Link>
                    </div>
                </div>
 
                <div class="mb-6">

                    <p class="text-slate-400 w-full border-b mb-2">Tags</p>        
                    <div class="flex items-center gap-3">
                        
                            <div v-for="tag in listing.tags.split(',')" :key="tag">
                                <Link :href="route('home', {tag})" class="bg-slate-500 text-white px-2 py-1 rounded-full hover:bg-slate-700 dark:hover:bg-slate-500">{{ tag }}</Link>
                            </div>
                    </div>
                </div>

            </div>
        </Container>
           
    </div>
</template>