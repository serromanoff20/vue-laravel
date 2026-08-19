<script setup>
    import CartItem from "./CartItem.vue";
    import { inject } from "vue";

    const { cart, removeFromCart } = inject('cart');

</script>

<template>
    <div class="flex flex-col gap-4">
        <CartItem v-for="item in cart"
                  :key="item.id"
                  :name="item.name"
                  :cost="item.cost"
                  :image="item.image"
                  @on-click-remove="() => removeFromCart(item)"
        />

    </div>
</template>

<style scoped>

</style>
