<template>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8" :class="ctWidth">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                    >
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        ctWidth: {
            type: String
        }
    }
};
</script>
