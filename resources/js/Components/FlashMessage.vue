<template>
    <transition
        leave-active-class="transition ease-in duration-300"
        leave-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="$page.flash.success || $page.flash.failure"
            class="fixed bottom-4 right-4 flex items-center text-white rounded px-8 py-4"
            :class="{
                'bg-red-500': $page.flash.failure,
                'bg-green-400': $page.flash.success
            }"
        >
            <div v-if="$page.flash.success">👍 {{ $page.flash.success }}</div>
            <div v-if="$page.flash.failure">😿 {{ $page.flash.failure }}</div>
            <button
                class="flex ml-4 focus:outline-none focus:shadow-none"
                @click="hideFlashMessage"
            >
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    ></path>
                </svg>
            </button>
        </div>
    </transition>
</template>

<script>
export default {
    methods: {
        hideFlashMessage() {
            this.$page.flash.success = "";
            this.$page.flash.failure = "";
        }
    }
};
</script>

<style lang="scss" scoped></style>
