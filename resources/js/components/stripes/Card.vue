<script setup>

const props = defineProps({
    id: Number,
    name: String,
    model: String,
    cost: Number,
    image: String,
    isFavorite: Boolean,
    onClickFavorite: Function,
    isAdded: Boolean,
    onClickAdd: Function,
})


</script>

<template>
    <div>
        <div class="relative bg-white border border-slade-100 rounded-3xl p-8 cursor-pointer hover:-translate-y-2 hover:shadow-2xl transition ">
<!--            <img-->
<!--                :src="props.isFavorite ? '/images/like-2.svg' : '/images/like-1.svg'"-->
<!--                alt="like-1"-->
<!--                class="absolute top-8 left-8"-->
<!--                @click="onClickFavorite"-->
<!--            >-->

            <img :src="props.image" alt="Stripe">

            <b class="mt-2">{{ props.model }}</b>
            <p class="mt-2">{{ props.name }}</p>

            <div class="flex justify-between mt-2">
                <div class="flex flex-col">
                    <b>Цена: </b>
                    <span class="text-slate-400">{{ props.cost }} .руб</span>

                    <img
                        :src="!props.isAdded ? '/images/plus.svg' : '/images/checked.svg'"
                        @click="props.onClickAdd"
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
