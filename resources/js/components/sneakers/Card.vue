<script setup>
defineProps({
    id: Number,
    title: String,
    price: Number,
    imageUrl: String,

    changeFavorite: Function,
    // isAdded: Boolean,
    changeAdd: Function,
})

</script>

<template>
    <div>
        <div class="relative bg-white border border-slade-100 rounded-3xl p-8 cursor-pointer hover:-translate-y-2 hover:shadow-2xl transition ">
            <img
                :src="changeFavorite ? '/images/like-2.svg' : '/images/like-1.svg'"
                alt="like-1"
                class="absolute top-8 left-8"
            >

            <img :src="imageUrl" alt="Sneaker">

            <p class="mt-2">{{ title }}</p>

            <div class="flex justify-between mt-2">
                <div class="flex flex-col">
                    <b>Цена: </b>
                    <span class="text-slate-400">{{ price }} .руб</span>

                    <img
                        :src="!isAdded ? '/images/plus.svg' : '/images/checked.svg'"
                        @click="changeAdd"
                        alt="plus"
                        class="w-8 mr-0"
                    >
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
