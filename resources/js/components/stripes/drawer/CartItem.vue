<script setup>
    defineProps({
        id: Number,
        name: String,
        cost: Number,
        image: String,
    });

    const emit = defineEmits(['onClickRemove']);
</script>

<template>
    <div class="flex items-center border border-slate-200 p-4 rounded-xl">
        <img class="w-16 h-16" :src="image" :alt="name">
        <div class="flex flex-col flex-1">
            <p>{{ name }}</p>

            <div class="flex justify-between mt-2">
                <b class="flex-1">{{ cost }} руб.</b>
                <img @click="emit('onClickRemove')"
                     class="opacity-40 hover:opacity-100 cursor-pointer transition"
                     src="/images/close.svg"
                     alt="close">
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
