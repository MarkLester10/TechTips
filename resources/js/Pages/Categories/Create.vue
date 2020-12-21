<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Category
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div
                            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                        >
                            <div
                                class="px-4 py-6 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                            >
                                <form @submit.prevent="saveCategory">
                                    <!-- Name -->
                                    <div>
                                        <jet-label for="name" value="Name" />
                                        <jet-input
                                            id="name"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.name"
                                            autocomplete="name"
                                        />
                                        <jet-input-error
                                            :message="form.error('name')"
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Slug -->
                                    <div class="mt-4">
                                        <jet-label for="slug" value="Slug" />
                                        <jet-input
                                            id="slug"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.slug"
                                            autocomplete="slug"
                                        />
                                        <jet-input-error
                                            :message="form.error('slug')"
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Actions -->
                                    <div class="mt-4">
                                        <jet-action-message
                                            :on="form.recentlySuccessful"
                                            class="mr-3"
                                        >
                                            Saved.
                                        </jet-action-message>

                                        <jet-button
                                            class="bg-green-400 hover:bg-green-500 active:bg-green-400 focus:outline-none focus:border-green-400"
                                            :class="{
                                                'opacity-25': form.processing
                                            }"
                                            :disabled="form.processing"
                                        >
                                            Save
                                        </jet-button>

                                        <a
                                            class="font-semibold text-xs uppercase tracking-widest text-gray-900 bg-transparent px-4 py-3 rounded-md hover:bg-gray-200"
                                            :href="route('categories.index')"
                                        >
                                            Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import { strSlug } from "@/helpers/slugify.js";

export default {
    components: {
        AppLayout,
        JetButton,
        JetInput,
        JetLabel,
        JetActionMessage,
        JetInputError
    },
    data() {
        return {
            form: this.$inertia.form({
                name: "",
                slug: ""
            })
        };
    },
    methods: {
        saveCategory() {
            this.form.post(route("categories.store"));
        }
    },
    watch: {
        "form.name"(name) {
            this.form.slug = strSlug(name);
        }
    }
};
</script>
