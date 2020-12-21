<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div
                            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                        >
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
                                <AppTable :headers="headers">
                                    <tr
                                        v-for="category in categories.data"
                                        :key="category.id"
                                    >
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        >
                                            {{ category.name }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        >
                                            {{ category.slug }}
                                        </td>
                                        <td
                                            class="px-6 py-4 flex items-center justify-end space-x-6 text-sm font-medium"
                                        >
                                            <EditButton
                                                :url="
                                                    route('categories.edit', {
                                                        category: category.id
                                                    })
                                                "
                                            />

                                            <DeleteButton
                                                module-name="category"
                                                :url="
                                                    route(
                                                        'categories.destroy',
                                                        {
                                                            category:
                                                                category.id
                                                        }
                                                    )
                                                "
                                            />
                                        </td>
                                    </tr>
                                </AppTable>

                                <div class="mt-4 px-4 py-6">
                                    <SimplePagination
                                        :prev-url="categories.links.prev"
                                        :next-url="categories.links.next"
                                    />
                                </div>
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
import EditButton from "@/Components/EditButton";
import DeleteButton from "@/Components/DeleteButton";
import SimplePagination from "@/Components/SimplePagination";
import AppTable from "@/Components/Table";
import JetButton from "@/Jetstream/Button";

export default {
    props: {
        categories: {}
    },
    components: {
        AppLayout,
        EditButton,
        DeleteButton,
        SimplePagination,
        AppTable,
        JetButton
    },
    computed: {
        headers() {
            return [
                {
                    name: "Name",
                    class: "font-bold text-gray-900"
                },
                {
                    name: "Slug",
                    class: "font-bold text-gray-900"
                },
                {
                    name: "Actions",
                    class: "font-bold text-gray-900 text-right"
                }
            ];
        }
    }
};
</script>
