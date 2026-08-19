<script setup>
import Header from "@/components/stripes/Header.vue";
import CardList from "@/components/stripes/CardList.vue";
import Drawer from "@/components/stripes/drawer/Drawer.vue";
import ModalWindowComponent from "@/components/stripes/ModalWindowComponent.vue";
import {provide, onMounted, reactive, ref, watch, computed} from "vue";

const cardList = ref([]);
const cart = ref([]);

const drawerOpen = ref(false);

const isShowModalWindow = ref(false);

const filters = reactive({
    sortBy: 'name',
    searchQuery: '',
});

const totalPrice = computed(
    () => cart.value.reduce((acc, item) => acc + item.cost, 0)
);
// const vatPrice = computed(
//     () => Math.round((totalPrice * 5) / 100)
// )

const addToCart = (item) => {
    item.isAdded = true;
    cart.value.push(item);
}

const removeFromCart = (item) => {
    item.isAdded = false;
    cart.value.splice(cart.value.indexOf(item), 1);
}

const onClickAddPlus = (item) => {
    if (!item.isAdded) {
        addToCart(item);
    } else {
        removeFromCart(item);
    }


    // console.log(cart);
}

const closeDrawer = () => {
    drawerOpen.value = false;
}

const openDrawer = () => {
    drawerOpen.value = true;
}

const closeModalWindow = () => {
    isShowModalWindow.value = false;
}

const openModalWindow = () => {
    isShowModalWindow.value = true;
    closeDrawer();
}

const onChangeSelect = event => {
    filters.sortBy = event.target.value;
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
            params.name = `%${filters.searchQuery}%`
        }

        const { data } = await axios.get('/api/stripes/list', { params });

        cardList.value = data.map((item) => {
            item.cost = parseFloat(item.cost);

            return {...item};
        });
    } catch (err) {
        console.warn("Ошибка: " + err);
    }
};

const fetchFavorites = async () => {
    try {
        const { data } = await axios.get('/api/stripes/favorites');

        cardList.value = cardList.value.map(obj => {
            let elFavorite = false;

            data.forEach((dataEl) => {
                if (obj.id === dataEl.stripe_id) {
                    elFavorite = dataEl.is_favorited
                }
            });

            return {...obj, isFavorite: elFavorite};
        });
    } catch (err) {
        console.warn("Ошибка: " + err);
    }
};

const addToFavorite = async (item) => {
    try {
        const params = {
            stripeId: item.id,
        };

        if (!item.isFavorite) {

            await axios.post('/api/stripes/add-in-favorite', { params });
        } else {

            await axios.delete('/api/stripes/delete-in-favorite', { params });
        }

        item.isFavorite = !item.isFavorite;
    } catch (err) {
        console.warn("Ошибка: " + err);
    }
}

onMounted( async () => {
    const localCart = localStorage.getItem('cart');
    cart.value = localCart ? JSON.parse(localCart) : [];

    await fetchItems();
    await fetchFavorites();

    cardList.value = cardList.value.map((item) => ({
        ...item,
        isAdded: cart.value.some((cartItem) => cartItem.id === item.id)
    }));
});

watch(filters,  async () => {
    await fetchItems()
    await fetchFavorites()
})

watch(cart, () => {
    cardList.value = cardList.value.map((item) => ({
        ...item,
        isAdded: false,
    }))
})

watch(cart, () => {
    localStorage.setItem('cart', JSON.stringify(cart.value))
}, { deep: true });

provide('cart', {
    cart,
    closeDrawer,
    openDrawer,
    addToCart,
    removeFromCart,
    openModalWindow,
});

provide('totalPrice', totalPrice);

</script>

<template>
    <Drawer v-if="drawerOpen" /><!-- :vatPrice="vatPrice"-->

    <div class="bg-white w-4/5 rounded-xl shadow-xl mt-14 mx-auto">
        <Header :totalPrice="totalPrice" @open-drawer="openDrawer"/>

        <ModalWindowComponent v-if="isShowModalWindow" @close-modal-window="closeModalWindow"/>

        <div class="p-10">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Все туфли</h2>

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

            <CardList :cardList="cardList" @add-to-favorite=addToFavorite @add-to-cart="onClickAddPlus"/>
        </div>
    </div>
</template>

<style scoped>

</style>
