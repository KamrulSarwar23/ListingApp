<script setup>
import { Head } from '@inertiajs/vue3';
import UpdateInfo from './Sections/UpdateInfo.vue'
import UpdatePassword from './Sections/UpdatePassword.vue'
import DeleteAccount from './Sections/DeleteAccount.vue'

defineProps({
    user:Object,
    status:String
})

</script>


<template>
    <div>
        <Head title="-Profile"/>
        <h2>Profile</h2>

        <UpdateInfo :user="user" :status="status"/>
        <UpdatePassword/>
        <DeleteAccount/>
    </div>
</template>