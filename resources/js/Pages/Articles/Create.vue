<template>
    <app-layout>
        <template #header>
            <BreadCrumbs :items="breadcrumbs" />
        </template>

        <AppContainer ct-width="max-w-2xl">
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
                            <span v-if="this.edit">Update</span>
                            <span v-else>Save</span>
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
        </AppContainer>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import AppContainer from "@/Components/Container";
import BreadCrumbs from "@/Components/BreadCrumbs";
import { strSlug } from "@/helpers/slugify.js";

export default {
    components: {
        AppLayout,
        JetButton,
        JetInput,
        JetLabel,
        JetActionMessage,
        AppContainer,
        BreadCrumbs,
        JetInputError
    },
    props: {
        edit: Boolean,
        category: Object
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
            this.edit
                ? this.form.put(
                      route("categories.update", { id: this.category.data.id })
                  )
                : this.form.post(route("categories.store"));
        }
    },
    computed: {
        breadcrumbs() {
            return [
                {
                    label: "Categories",
                    url: route("categories.index")
                },
                {
                    label: this.edit ? "Edit Category" : "Add Category"
                }
            ];
        }
    },
    watch: {
        "form.name"(name) {
            this.form.slug = strSlug(name);
        }
    },
    mounted() {
        if (this.edit) {
            this.form.name = this.category.data.name;
            this.form.slug = this.category.data.slug;
        }
    }
};
</script>
