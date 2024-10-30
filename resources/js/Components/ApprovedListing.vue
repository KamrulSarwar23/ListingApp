<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  listing: [String, Number],
})

const form = useForm({

  approved: props.listing.approved

});

const submit = () => {
  if (confirm(`Do you want to change status`)) {

    form.put(route('admin.approved', props.listing.id));

  } else {

    form.approved = props.listing.approved

  }
};
</script>

<template>
  <div class="flex items-center gap2">
    <form @change="submit" class="flex flex-items gap-2">
      <label for="approved" class="sr-only">Status:</label>
      <select
        v-model="form.approved"
        name="approved"
        id=""
        class="text-slate-800 bg-slate-200 text-xs py-1 border-0 outline-0 rounded-lg"
      >
        <option value="1">Approved</option>
        <option value="0">Reject</option>
      </select>
    </form>
  </div>
</template>