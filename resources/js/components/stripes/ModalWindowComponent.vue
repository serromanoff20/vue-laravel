<script setup>
    import {inject, ref} from "vue";

    const emit = defineEmits(['closeModalWindow'])
    const cart = inject('cart');

    const fioForm = ref("");
    const mailForm = ref("");

    const sendOrder = async () => {
        try {
            const params = {
                fioForm: fioForm.value,
                mailForm: mailForm.value,
                order: localStorage.getItem('cart'),
            };

            const { data } = await axios.post('/api/stripes/send-order', { params });

            if (data.code === 200) {
                emit('closeModalWindow');

                cart.value = [];
                // localStorage.setItem('cart', JSON.stringify(cart.value));

                alert(data.message);
            }
        } catch (err) {
            console.warn("Ошибка: " + err);
        }
    };
</script>

<template>
    <div class="fixed top-0 left-0 h-full w-full bg-black z-10 opacity-70"></div>

    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" class="flex fixed z-50 justify-center items-center md:inset-0">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                    <h3 class="text-xl font-bold">
                        Форма обратной связи
                    </h3>
                    <button type="button"
                            class="opacity-30 cursor-pointer rotate-180 hover:opacity-100 transition"
                            data-modal-hide="authentication-modal"
                            @click="() => emit('closeModalWindow')"
                    >
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <div class="mb-4">
                        <label for="fio" class="block mb-1 text-sm text-gray-700">Ваше имя</label>
                        <input type="text" name="fio" id="fio" placeholder="Иванов И.И." class="bg-gray-50 border text-black-900 text-sm rounded-lg block w-full p-2.5" v-model=fioForm required />
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block mb-1 text-sm text-gray-700">Ваш e-mail</label>
                        <input type="email" name="email" id="email" placeholder="name@company.com" class="bg-gray-50 border text-gray-900 text-sm rounded-lg block w-full p-2.5" v-model=mailForm required />
                    </div>

                    <button
                        class="flex justify-center items-center w-full py-3 bg-pink-600 text-white rounded-xl transition active:bg-pink-600 hover:bg-pink-700"
                        @click="sendOrder"
                    >
                        Оформить заказ
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
