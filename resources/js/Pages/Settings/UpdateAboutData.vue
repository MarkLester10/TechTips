<template>
    <jet-form-section @submitted="updateHeroInformation">
        <template #title>
            About Us Information
        </template>

        <template #description>
            Update the about us section data
        </template>

        <template #form>
            <!--  Photo -->
            <div
                class="col-span-6 sm:col-span-6"
                v-if="$page.jetstream.managesProfilePhotos"
            >
                <!-- Profile Photo File Input -->
                <AppImage
                    :image-url="settings.data.about_image_url"
                    label="About"
                    :error-message="form.error('about_image')"
                    v-model="form.about_image"
                />
            </div>

            <!-- Hero title -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="about_title" value="About Title" />
                <jet-input
                    id="about_title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.about_title"
                    autocomplete="about_title"
                />
                <jet-input-error
                    :message="form.error('about_title')"
                    class="mt-2"
                />
            </div>

            <!-- Description -->
            <div class="col-span-6 sm:col-span-6">
                <jet-label for="about_description" value="About Description" />
                <AppCKEditor v-model="form.about_description" />
                <jet-input-error
                    :message="form.error('about_description')"
                    class="mt-2"
                />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import AppImage from "@/Components/Image";
import AppCKEditor from "@/Components/CKEditor";

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        AppImage,
        AppCKEditor
    },

    props: ["settings"],

    data() {
        return {
            form: this.$inertia.form(
                {
                    about_description: this.settings.data.about_description,
                    about_image: null,
                    about_title: this.settings.data.about_title
                },
                {
                    resetOnSuccess: false
                }
            )
        };
    },

    methods: {
        updateHeroInformation() {
            this.form.post(route("settings.save-about"), {
                preserveScroll: true
            });
        }
    }
};
</script>
