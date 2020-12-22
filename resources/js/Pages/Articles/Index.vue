<template>
    <app-layout>
        <template #header>
            <BreadCrumbs :items="breadcrumbs" />
        </template>

        <AppContainer ct-width="max-w-7xl">
            <jet-button
                :href="route('categories.create')"
                class="mb-6 ml-4 sm:ml-0 bg-green-400 hover:bg-green-500 active:bg-green-400 focus:outline-none focus:border-green-400"
                >Add New
                <svg
                    class="w-6 h-6 ml-2"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                    ></path>
                </svg>
            </jet-button>
            <div
                class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
            >
                <AppTable :headers="headers" :items="articles">
                    <tr v-for="article in articles.data" :key="article.id">
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                        >
                            {{ article.title }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                        >
                            {{ article.category.name }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                        >
                            {{ article.created_at_for_human }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                        >
                            {{ article.modified_at_for_human }}
                        </td>
                        <td
                            class="px-6 py-4 flex items-center justify-end space-x-6 text-sm font-medium"
                        >
                            <EditButton
                                :url="
                                    route('articles.edit', {
                                        article: article.id
                                    })
                                "
                            />

                            <DeleteButton
                                module-name="article"
                                :url="
                                    route('articles.destroy', {
                                        article: article.id
                                    })
                                "
                            />
                        </td>
                    </tr>
                </AppTable>
            </div>
        </AppContainer>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import EditButton from "@/Components/EditButton";
import DeleteButton from "@/Components/DeleteButton";
import AppTable from "@/Components/Table";
import AppContainer from "@/Components/Container";
import BreadCrumbs from "@/Components/BreadCrumbs";
import JetButton from "@/Jetstream/Button";

export default {
    props: {
        articles: {}
    },
    components: {
        AppLayout,
        EditButton,
        DeleteButton,
        AppTable,
        BreadCrumbs,
        AppContainer,
        JetButton
    },
    computed: {
        headers() {
            return [
                {
                    name: "Title",
                    class: "font-bold text-gray-900"
                },
                {
                    name: "Category",
                    class: "font-bold text-gray-900"
                },
                {
                    name: "Created Date",
                    class: "font-bold text-gray-900"
                },
                {
                    name: "Modified Date",
                    class: "font-bold text-gray-900"
                },
                {
                    name: "Actions",
                    class: "font-bold text-gray-900 text-right"
                }
            ];
        },
        breadcrumbs() {
            return [
                {
                    label: "Articles",
                    url: route("categories.index")
                }
            ];
        }
    }
};
</script>
