<script setup>
    import Header from "@/components/sneakers/Header.vue";
    import CardList from "@/components/sneakers/CardList.vue";
    import Drawer from "@/components/sneakers/drawer/Drawer.vue";
    import {onMounted, reactive, ref, watch} from "vue";

    const cardList = ref([]);

    const filters = reactive({
        sortBy: 'title',
        searchQuery: '',
    });

    const onChangeSelect = event => {
        filters.sortBy = event.target.value;

        // console.log(sortBy.value);
    };

    const onChangeSearchInput = (event) => {
        filters.searchQuery = event.target.value;
    };

    const fetchItems = async () => {
        try {
            const params = {
                sortBy: filters.sortBy,
            };
            if (filters.searchQuery) {
                params.title = `%${filters.searchQuery}%`
            }

            // const { data } = await axios.get('/api/sneakers/sort-by/'+filters.sortBy);
            const { data } = await axios.get('/api/sneakers/list', { params });

            cardList.value = data;
        } catch (err) {
            console.err("Ошибка: " + err);
        }
    };

    onMounted(fetchItems);

    watch(filters, fetchItems)

</script>

<template>
<!--    <Drawer />-->

    <div class="bg-white w-4/5 rounded-xl shadow-xl mt-14 mx-auto">
        <Header />

        <div class="p-10">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Все кроссовки</h2>

                <div class="flex gap-4">
                    <select @change="onChangeSelect" class="py-2 px-3 border border-gray-200 focus:border-gray-400 rounded-md focus:outline-none">
                        <option value="likeTitle">По названию</option>
                        <option value="priceAsc">По цене (дешёвые)</option>
                        <option value="priceDesc">По цене (дорогие)</option>
                    </select>

                    <div class="relative">
                        <img class="absolute left-4 top-3" src="/images/search.svg" alt="search">

                        <input
                            @input="onChangeSearchInput"
                            class="border rounded-md py-2 pl-10 pr-4 outline-none"
                            placeholder="Поиск..."/>

                    </div>

                </div>

            </div>

            <CardList :cardList="cardList" />
        </div>
    </div>
</template>

<style scoped>

</style>
