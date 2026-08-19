<script setup>
import Card from "./Card.vue";

defineProps({
    cardList: Array,
});

const changeAdd = () => {
    alert('Добавить в корзину');
}

const changeFavorite = () => {
    alert('Добавить в избранное');
}

</script>

<template>
    <div class="grid grid-cols-4 gap-5">
        <Card v-for="card in cardList"
              :key="card.id"
              :title="card.title"
              :price="card.price"
              :image-url="card.image_url"
              :change-favorite="changeFavorite"
              :change-add="changeAdd"
        />
<!--              :is-added="true"-->

<!--        <Card id="1" title="тест" price="12.05" imageUrl="/images/sneakers/sneakers-12.jpg" />-->
<!--        <Card id="1" title="тест" price="12.05" imageUrl="/images/sneakers/sneakers-12.jpg" />-->
<!--        <Card id="1" title="тест" price="12.05" imageUrl="/images/sneakers/sneakers-12.jpg" />-->
<!--        <Card id="1" title="тест" price="12.05" imageUrl="/images/sneakers/sneakers-12.jpg" />-->
    </div>
</template>

<style scoped>

</style>
