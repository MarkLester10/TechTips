<template>
    <h2 class="font-semibold text-md text-gray-800 leading-tight">
        <span v-for="(item, index) in items" :key="index">
            <inertia-link v-if="item.url" :href="item.url">{{
                item.label
            }}</inertia-link>
            <span v-else class="text-gray-500">{{ item.label }}</span>
            <span v-if="index < items.length - 1" class="mx-2">|</span>
        </span>
    </h2>
</template>

<script>
export default {
    props: {
        items: {
            type: Array,
            required: true
        }
    }
};
</script>
