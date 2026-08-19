<script setup>
import Card from "./Card.vue";

defineProps({
    cardList: Array,
});

const emit = defineEmits(['addToFavorite', 'addToCart'])

const changeAdd = () => {
    alert('Добавить в корзину');
}


</script>

<template>
    <div class="grid grid-cols-4 gap-5">
        <Card v-for="card in cardList"
              :key="card.id"
              :name="card.name"
              :model="card.model"
              :cost="card.cost"
              :image="card.image"
              :is-favorite="card.isFavorite"
              :on-click-favorite="() => emit('addToFavorite', card)"
              :is-added="card.isAdded"
              :on-click-add="() => emit('addToCart', card)"
        />
    </div>
</template>

<style scoped>

</style>
