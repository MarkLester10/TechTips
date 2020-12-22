<template>
    <div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th
                        v-for="(header, index) in headers"
                        :key="`header-${index}`"
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        :class="header.class"
                    >
                        {{ header.name }}
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <slot></slot>
                <tr v-if="items.data.length === 0">
                    <td
                        class="px-6 py-4 text-sm font-semibold"
                        :colspan="headers.length"
                    >
                        No Data available
                    </td>
                </tr>
                <!-- More rows... -->
            </tbody>
        </table>

        <div class="mt-4 px-4 py-6" v-if="items.data.length > 0">
            <SimplePagination
                :prev-url="items.links.prev"
                :next-url="items.links.next"
            />
        </div>
    </div>
</template>

<script>
import SimplePagination from "@/Components/SimplePagination";
export default {
    props: {
        headers: {
            type: Array,
            required: true
        },
        items: {
            type: Object,
            required: true
        }
    },
    components: {
        SimplePagination
    }
};
</script>
