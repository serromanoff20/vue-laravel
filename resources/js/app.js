import './bootstrap';
import '../css/app.css';
import { createApp } from 'vue';
// import SneakersComponent from './components/SneakersComponent.vue';
import StripesComponent from "@/components/StripesComponent.vue";
import InformationComponent from "@/components/InformationComponent.vue";

// const app = createApp({});
// app.component('sneakers-component', SneakersComponent);
// app.mount('#app');
const app = createApp({});
app.component('information-component', InformationComponent);
app.component('stripes-component', StripesComponent);
app.mount('#app');
