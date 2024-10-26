<script setup>

import Container from "../../Components/Container.vue";
import Title from "../../Components/Title.vue";
import InputField from "../../Components/InputField.vue";
import TextArea from "../../Components/TextAreaField.vue";
import ImageUpload from "../../Components/ImageUpload.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import { useForm } from '@inertiajs/vue3';


const form = useForm({
    title: null,
    email: null,
    tags: null,
    link: null,
    desc: null,
    image: null,
})


</script>


<template>
    <div>
        <Head title="- New Listing"/>

        <Container>
            <Title>Create a New Listing</Title>


            <ErrorMessages :errors="form.errors"/>

            <form @submit.prevent="form.post(route('listings.store'))" class="grid grid-cols-2 gap-6">

                <div class="space-y-6">

                    <InputField label="Title" icon="heading" placeholder="My New Listing" v-model="form.title"/>

                    <InputField label="Tags (Separate With Comma)" icon="tags" placeholder="one, two, three" v-model="form.tags"/>

                    <TextArea label="Description" icon="newspaper" placeholder="This is my listing description" v-model="form.desc"/>

                </div>

                <div class="space-y-6">

                    <InputField label="Email" icon="at" placeholder="example@email.com " v-model="form.email"/>

                    <InputField label="External Link" icon="up-right-from-square" placeholder="https://example.com" v-model="form.link"/>

                    <ImageUpload @image="(e) => (form.image = e)"/>
                </div>


                <div>
                    <PrimaryBtn>Create</PrimaryBtn>
                </div>
            </form>

        </Container>
    </div>
</template>