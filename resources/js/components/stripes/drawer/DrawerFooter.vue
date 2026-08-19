<script setup>
    import {inject} from "vue";

    const totalPrice = inject('totalPrice');
    const { cart, openModalWindow } = inject('cart');

    const createOrder = () => {
        // cart.value = [];

    }
</script>

<template>
    <div class="flex flex-col gap-4 my-6">
        <div class="flex gap-2">
            <span>Итого:</span>
            <div class="flex-1 border-b border-dashed" />
            <span class="font-bold">{{ totalPrice }} руб.</span>
        </div>

<!--        <div class="flex gap-2">-->
<!--            <span>Налог 5%:</span>-->
<!--            <div class="flex-1 border-b border-dashed" />-->
<!--            <span class="font-bold">50 руб.</span>-->
<!--        </div>-->

        <button
            :disabled="!totalPrice"
            class="mt-10 flex justify-center items-center gap-3 w-full py-3 bg-pink-600 text-white rounded-xl transition active:bg-pink-600 hover:bg-pink-700 disabled:bg-pink-300"
            @click="openModalWindow"
        >
            Оформить заказ
<!--                    <img src="/images/arrow-next.svg" alt="Arrow" />-->
        </button>
    </div>
</template>

<style scoped>

</style>
