<template>
    <app-layout>
        <template #header>
            <BreadCrumbs :items="breadcrumbs" />
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    The Dashboard page content
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import BreadCrumbs from "@/Components/BreadCrumbs";

export default {
    components: {
        AppLayout,
        BreadCrumbs
    },
    computed: {
        breadcrumbs() {
            return [
                {
                    label: "Dashboard",
                    url: route("dashboard")
                }
            ];
        }
    }
};
</script>
