<template>
    <app-layout>
        <template #header>
            <BreadCrumbs :items="breadcrumbs" />
        </template>

        <AppContainer ct-width="max-w-4xl">
            <div
                class="px-4 py-6 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
            >
                <form @submit.prevent="saveArticle">
                    <!-- Image -->
                    <AppImage
                        class="mt-2"
                        v-model="form.image"
                        :image-url="imageUrl"
                        label="Image"
                        :error-message="form.error('image')"
                    />

                    <!-- Title -->
                    <div class="mt-4">
                        <jet-label for="title" value="Title" />
                        <jet-input
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.title"
                            autocomplete="title"
                        />
                        <jet-input-error
                            :message="form.error('title')"
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

                    <!-- Categories -->
                    <div class="mt-4">
                        <jet-label for="category" value="Category" />

                        <select
                            name="category"
                            id="category"
                            class="block w-full form-input"
                            v-model="form.category_id"
                        >
                            <option value="">Select</option>
                            <option
                                v-for="category in categories.data"
                                :key="category.id"
                                :value="category.id"
                                >{{ category.name }}</option
                            >
                        </select>
                        <jet-input-error
                            :message="form.error('category_id')"
                            class="mt-2"
                        />
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <jet-label for="description" value="Description" />
                        <AppCkEditor v-model="form.description" />

                        <jet-input-error
                            :message="form.error('description')"
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
                            :href="route('articles.index')"
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
import AppCkEditor from "@/Components/CKEditor";
import BreadCrumbs from "@/Components/BreadCrumbs";
import { strSlug } from "@/helpers/slugify.js";
import AppImage from "@/Components/Image";

export default {
    components: {
        AppLayout,
        JetButton,
        JetInput,
        JetLabel,
        JetActionMessage,
        AppContainer,
        BreadCrumbs,
        JetInputError,
        AppImage,
        AppCkEditor
    },
    props: {
        edit: Boolean,
        article: Object,
        categories: {
            type: Object,
            default: function() {
                return {
                    data: []
                };
            }
        }
    },
    data() {
        return {
            imageUrl: "",
            form: this.$inertia.form(
                {
                    _method: this.edit ? "PUT" : "",
                    category_id: "",
                    title: "",
                    slug: "",
                    description: this.edit ? this.article.data.description : "",
                    image: ""
                },
                {
                    resetOnSuccess: false
                }
            )
        };
    },
    methods: {
        saveArticle() {
            this.edit
                ? this.form.post(
                      route("articles.update", { id: this.article.data.id })
                  )
                : this.form.post(route("articles.store"));
        }
    },
    computed: {
        breadcrumbs() {
            return [
                {
                    label: "Articles",
                    url: route("articles.index")
                },
                {
                    label: this.edit ? "Edit Article" : "Add Article"
                }
            ];
        }
    },
    watch: {
        "form.title"(title) {
            this.form.slug = strSlug(title);
        }
    },
    mounted() {
        if (this.edit) {
            this.form.category_id = this.article.data.category_id;
            this.form.title = this.article.data.title;
            this.form.slug = this.article.data.slug;
        }
        this.imageUrl = this.article.data.image_url;
    }
};
</script>
