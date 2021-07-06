<template>
  <div class="dash-slider">
    <div class="container">
      <div class="dash-slider__title">{{ title }}</div>
    </div>
    <div class="slick-wrapper">
      <div class="slick-wrapper__overlay" />
      <div class="slick-wrapper__overlay slick-wrapper__overlay--reversed" />
      <slick ref="slick" :options="slickOptions" v-if="showSlider" class="dash-slider__slick">
        <div class="dash-slider__slide" v-for="(slide, key) in recentBooks" :key="key">
          <div class="dash-slider__img"><img :src="`/storage/${slide.book.img}`" alt=""></div>
          <div class="dash-slider__text">{{ slide.book.title }}</div>
          <div class="dash-slider__text">{{ slide.book.author }}</div>
        </div>
        <!---->
        <div class="dash-slider__slide" v-for="(slide, key) in recentBooks" :key="key">
          <div class="dash-slider__img"><img :src="`/storage/${slide.book.img}`" alt=""></div>
          <div class="dash-slider__text">{{ slide.book.title }}</div>
          <div class="dash-slider__text">{{ slide.book.author }}</div>
        </div>
        <!---->
      </slick>
    </div>
  </div>
</template>
<script>

import Slick from 'vue-slick';

export default {
  name: 'RecentBooks',
  props: {
    recentBooks: {
      type: Array
    },
    title: {},
  },
  downloading: {},
  components: {Slick},
  data() {
    return {
      showSlider: true,
      slickOptions: {
        slidesToShow: 6,
        slidesToScroll: 1,
        speed: 1200,
        autoplay: false,
        arrows: true,
        prevArrow: '<span class="dash-slider__prev"></span>',
        nextArrow: '<span class="dash-slider__next"></span>',
        responsive: [
          {
            breakpoint: 1201,
            settings: {
              slidesToShow: 4
            }
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 2
            }
          },
          {
            breakpoint: 500,
            settings: {
              slidesToShow: 1
            }
          }]
      },
    }
  },
  computed: {
    len() {
      return this.recentBooks.length;
    }
  },
  methods: {
    next() {
      this.$refs.slick.next();
    },
    prev() {
      this.$refs.slick.prev();
    },
    reInit() {
      this.$nextTick(() => {
        this.showSlider = true;
        this.$refs.slick.reSlick();
      });
    },
  },
  watch: {
    recentBooks(newVal, oldVal) {
      this.showSlider = false;
      this.reInit();
    }
  },
}
</script>
<style lang="scss">

.slick-wrapper {
  position: relative;

  &__overlay {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: calc(100% / 6 - 27px);
    z-index: 1;
    background: #1D1D1D;
    -webkit-mask-image: -webkit-gradient(linear, left top, right top, from(rgba(0,0,0,1)), to(rgb(0 0 0 / 0%)));

    &--reversed {
      left: auto;
      right: 0;
      -webkit-mask-image: -webkit-gradient(linear, right top, left top, from(rgba(0,0,0,1)), to(rgb(0 0 0 / 0%)));
    }
  }
}
</style>
