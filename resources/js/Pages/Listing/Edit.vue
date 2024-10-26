<script setup>

import Container from "../../Components/Container.vue";
import Title from "../../Components/Title.vue";
import InputField from "../../Components/InputField.vue";
import TextArea from "../../Components/TextAreaField.vue";
import ImageUpload from "../../Components/ImageUpload.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import { useForm } from '@inertiajs/vue3';


const props = defineProps({
    listing:Object
})

const form = useForm({
    title: props.listing.title,
    email: props.listing.email,
    tags: props.listing.tags,
    link: props.listing.link,
    desc: props.listing.desc,
    image: props.listing.null
})


</script>


<template>
    <div>
        <Head title="- Edit Listing"/>

        <Container>
            <Title>Edit Listing</Title>

            <ErrorMessages :errors="form.errors"/>

            <form @submit.prevent="form.put(route('listings.update',listing.id ))" class="grid grid-cols-2 gap-6">

                <div class="space-y-6">

                    <InputField label="Title" icon="heading" placeholder="My New Listing" v-model="form.title"/>

                    <InputField label="Tags (Separate With Comma)" icon="tags" placeholder="one, two, three" v-model="form.tags"/>

                    <TextArea label="Description" icon="newspaper" placeholder="This is my listing description" v-model="form.desc"/>

                </div>

                <div class="space-y-6">

                    <InputField label="Email" icon="at" placeholder="example@email.com " v-model="form.email"/>

                    <InputField label="External Link" icon="up-right-from-square" placeholder="https://example.com" v-model="form.link"/>

                    <ImageUpload :listingImage="listing.image" @image="(e) => (form.image = e)"/>
                </div>


                <div>
                    <PrimaryBtn :disabled="form.processing">Update</PrimaryBtn>
                </div>
            </form>

        </Container>
    </div>
</template>