<script setup>
  const props = defineProps({
      totalPrice: Number
  });

  const emit = defineEmits(['openDrawer']);
</script>

<template>
    <header class="flex justify-between border-b border-slate-300 px-10 py-8">
        <div class="flex items-center gap-4">
            <img src="/images/logo.png" alt="logo" class="w-10">
            <div>
                <h2 class="text-xl font-bold uppercase">Stripi.pleaser</h2>
                <p class="text-slate-500">Оригинальные стрипы из США</p>
            </div>
        </div>


        <ul class="flex items-center gap-10">
            <li @click="() => emit('openDrawer')"
                class="flex items-center gap-3 text-slate-500 hover:text-black cursor-pointer">
                <img src="/images/cart.svg" alt="cart">
                <b>{{ props.totalPrice }} руб.</b>
            </li>
<!--            <li class="flex items-center gap-3 cursor-pointer text-slate-500 hover:text-black ">-->
<!--                <img src="/images/heart.svg" alt="cart">-->
<!--                <span>Закладки</span>-->
<!--            </li>-->
<!--            <li class="flex items-center gap-3 cursor-pointer text-slate-500 hover:text-black ">-->
<!--                <img src="/images/profile.svg" alt="profile">-->
<!--                <span>Профиль</span>-->
<!--            </li>-->
        </ul>
    </header>
</template>
