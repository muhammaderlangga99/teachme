<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/effect-fade';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
//   import './style.css';
import { Autoplay, EffectFade, Navigation, Pagination } from 'swiper/modules';

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        return {
        modules: [Autoplay ,EffectFade, Navigation, Pagination],
        };
    },
};
</script>

<template>
    <swiper
    :spaceBetween="30"
    :effect="'fade'"
    :navigation="false"
    :pagination= false
    :centeredSlides="true"
    :modules="modules"
    :autoplay="{
      delay: 2500,
      disableOnInteraction: false,
    }"
    class="mySwiper"
  >
    <swiper-slide>
        <img src="img/learn.svg" class="bg-white dark:bg-black md:dark:bg-zinc-950 object-cover w-1/2 m-auto" />
    </swiper-slide>
    <swiper-slide>
        <img src="img/teaching.svg" class="bg-white dark:bg-black md:dark:bg-zinc-950 object-cover w-1/2 m-auto" />
    </swiper-slide>
    <swiper-slide>
        <img src="img/sketching.svg" class="bg-white dark:bg-black md:dark:bg-zinc-950 object-cover w-1/2 m-auto" />
    </swiper-slide>
  </swiper>
</template>