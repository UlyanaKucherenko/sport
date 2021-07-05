<template>
  <div class="dash-slider">
    <div class="container">
      <div class="dash-slider__title">{{ title }}</div>
    </div>
    <div class="slick-wrapper">
      <div class="slick-wrapper__overlay" />
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
.RecentBooks {

}

.dash-slider {
  width: 100%;
  min-height: 360px;
  padding: 20px;
  margin-bottom: 30px;
  border-radius: 10px;
  position: relative;

  &__icon {
    position: absolute;
    bottom: 60px;
    right: 0;
  }

  &__title {
    font-size: 30px;
    font-weight: 600;
    color: var(--color-member-area);
  }

  &__slide {
    display: inline !important;
    max-width: 400px;
    margin: 0 auto;
    position: relative;
  }

  &__img {
    display: block;
    width: 100%;
    min-height: 160px;
    position: relative;
    margin: 15px auto 10px;

    img {
      width: auto;
      height: auto;
      max-width: 400px;
      max-height: 130px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
  }

  &__author {
    font-size: 12px;
    color: #000;
    text-align: center;
  }

  &__text {
    font-size: 14px;
    line-height: 20px;
    font-weight: 600;
    margin-top: 10px;
    color: #fff;
    text-align: center;
  }

  &__prev {
    position: absolute;
    bottom: -40px;
    left: calc(50% - 20px);
    cursor: pointer;

    &:before {
      content: '';
      display: inline-block;
      width: 15px;
      height: 15px;
      border: none;
      border-top: 2px solid #898888;
      border-left: 2px solid #898888;
      transform: rotate(-45deg);
    }

    &:hover:before {
      border-color: var(--color-member-area);
      filter: drop-shadow(0 3px 11px rgba(var(--color-member-area), 0.5));
    }
  }

  &__next {
    position: absolute;
    bottom: -40px;
    right: calc(50% - 20px);
    cursor: pointer;

    &:before {
      content: '';
      display: inline-block;
      width: 15px;
      height: 15px;
      border: none;
      border-top: 2px solid #898888;
      border-right: 2px solid #898888;
      transform: rotate(45deg);
    }

    &:hover:before {
      border-color: var(--color-member-area);
      filter: drop-shadow(0 3px 11px rgba(var(--color-member-area), 0.5));
    }
  }
}
</style>
