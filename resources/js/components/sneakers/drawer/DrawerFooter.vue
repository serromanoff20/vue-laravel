<script setup>

</script>

<template>
    <div class="flex flex-col gap-4 my-6">
        <div class="flex gap-2">
            <span>Итого:</span>
            <div class="flex-1 border-b border-dashed" />
            <span class="font-bold">1000 руб.</span>
        </div>

        <div class="flex gap-2">
            <span>Налог 5%:</span>
            <div class="flex-1 border-b border-dashed" />
            <span class="font-bold">50 руб.</span>
        </div>

        <button
            disabled=""
            class="mt-10 flex justify-center items-center gap-3 w-full py-3 bg-lime-500 text-white rounded-xl transition active:bg-lime-700 hover:bg-lime-600 disabled:bg-slate-300"
        >
            Оформить заказ
            <!--        <img src="/images/arrow-next.svg" alt="Arrow" />-->
        </button>
    </div>
</template>

<style scoped>

</style>
