<template>
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
            <!-- More rows... -->
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        headers: {
            type: Array,
            required: true
        }
    }
};
</script>
