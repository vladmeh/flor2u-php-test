<template>
    <div class="mb-3 flex justify-between items-center">
        <div>
            <router-link
                    tag="button"
                    :to="{ query: {page: prevPage}}"
                    :disabled="!prevPage"
                    :class="!prevPage ? 'opacity-50 cursor-not-allowed' : ''"
                    class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
            >Previous
            </router-link>
            <router-link
                    tag="button"
                    :to="{ query: {page: nextPage}}"
                    :disabled="!nextPage"
                    :class="!nextPage ? 'opacity-50 cursor-not-allowed' : ''"
                    class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
            >Next
            </router-link>
        </div>
        <div v-text="paginationCount" class="font-bold"></div>
    </div>
</template>

<script>
    export default {
        name: "PagePaginate",
        props: {
            links: Object,
            meta: Object
        },
        computed: {
            nextPage() {
                if (!this.meta || this.meta.current_page === this.meta.last_page) {
                    return;
                }

                return this.meta.current_page + 1;
            },
            prevPage() {
                if (!this.meta || this.meta.current_page === 1) {
                    return;
                }

                return this.meta.current_page - 1;
            },
            paginationCount() {
                if (!this.meta) {
                    return;
                }

                const {current_page, last_page} = this.meta;

                return `${current_page} of ${last_page}`;
            },
        },
    }
</script>