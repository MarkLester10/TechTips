<template>
    <jet-form-section @submitted="updateContactInformation">
        <template #title>
            Contact Information
        </template>

        <template #description>
            Update the contact section data
        </template>

        <template #form>
            <!--  Photo -->
            <div
                class="col-span-6 sm:col-span-6"
                v-if="$page.jetstream.managesProfilePhotos"
            >
                <!-- Contact Photo File Input -->
                <AppImage
                    :image-url="settings.data.contact_image_url"
                    label="Contact"
                    :error-message="form.error('contact_image')"
                    v-model="form.contact_image"
                />
            </div>

            <!-- Addresss -->
            <div class="col-span-6 sm:col-span-6">
                <jet-label for="address" value="Address" />
                <jet-input
                    id="address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.address"
                    autocomplete="address"
                />
                <jet-input-error
                    :message="form.error('address')"
                    class="mt-2"
                />
            </div>

            <!-- Phone -->
            <div class="col-span-6 sm:col-span-6">
                <jet-label for="phone" value="Phone" />
                <jet-input
                    id="phone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    autocomplete="phone"
                />
                <jet-input-error :message="form.error('phone')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-6">
                <jet-label for="email" value="Email" />
                <jet-input
                    id="email"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    autocomplete="email"
                />
                <jet-input-error :message="form.error('email')" class="mt-2" />
            </div>

            <!-- Google Map Url -->
            <div class="col-span-6 sm:col-span-6">
                <jet-label for="google_map_url" value="Google Map Url" />
                <AppTextarea
                    id="google_map_url"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.google_map_url"
                    autocomplete="google_map_url"
                />
                <jet-input-error
                    :message="form.error('google_map_url')"
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
import AppTextarea from "@/Components/Textarea";
import AppImage from "@/Components/Image";

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        AppTextarea,
        AppImage
    },

    props: ["settings"],

    data() {
        return {
            form: this.$inertia.form(
                {
                    google_map_url: this.settings.data.google_map_url,
                    contact_image: null,
                    phone: this.settings.data.phone,
                    address: this.settings.data.address,
                    email: this.settings.data.email
                },
                {
                    resetOnSuccess: false
                }
            )
        };
    },

    methods: {
        updateContactInformation() {
            this.form.post(route("settings.save-contact"), {
                preserveScroll: true
            });
        }
    }
};
</script>
