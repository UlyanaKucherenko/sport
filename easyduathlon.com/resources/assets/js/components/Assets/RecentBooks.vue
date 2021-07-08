<template>
  <div class="dash-slider">
    <div class="container">
      <div class="dash-slider__title member-title">{{ title }}</div>
    </div>
    <div class="slick-wrapper">
      <template v-if="overlaysAreVisible">
        <div class="slick-wrapper__overlay"/>
        <div class="slick-wrapper__overlay slick-wrapper__overlay--reversed"/>
      </template>

      <slick ref="slick" :options="slickOptions" v-if="showSlider" class="dash-slider__slick">
        <div class="dash-slider__slide" v-for="(slide, key) in recentBooks" :key="key">
          <div class="dash-slider__img">
            <img :src="`/storage/${slide.book.img}`" alt="">
            <a class="dash-slider__btn" :href="`books/${slide.book.id}`" @mousedown="handleClick(book)">
              <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="28" cy="28" r="28" fill="black"/>
                <path
                    d="M36.1666 24.5H31.4999V17.5H24.4999V24.5H19.8332L27.9999 32.6667L36.1666 24.5ZM19.8332 35V37.3333H36.1666V35H19.8332Z"
                    fill="white"/>
              </svg>
            </a>
          </div>
          <div class="dash-slider__text">{{ slide.book.title }}</div>
        </div>
      </slick>
    </div>
  </div>
</template>
<script>

import Slick from 'vue-slick';

const slidesToShow = {
  1201: 5,
  767: 3,
  500: 1,
  default: 7
}

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
      windowWidth: 0,
      isActive: false,
      recentBooks2: [...this.recentBooks, ...this.recentBooks.slice(-3)],
      showSlider: true,
      slickOptions: {
        slidesToShow: slidesToShow.default,
        slidesToScroll: 1,
        speed: 1200,
        autoplay: true,
        arrows: true,
        touchMove: true,
        prevArrow: '<span class="dash-slider__prev"></span>',
        nextArrow: '<span class="dash-slider__next"></span>',
        responsive: [
          {
            breakpoint: 1201,
            settings: {
              slidesToShow: slidesToShow[1201]
            }
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: slidesToShow[767]
            }
          },
          {
            breakpoint: 500,
            settings: {
              slidesToShow: slidesToShow[500],
              arrows: false,
            }
          },
        ]
      },
    }
  },
  computed: {
    overlaysAreVisible() {
      const booksCount = this.recentBooks.length
      let currentSlidesToShow
      if (this.windowWidth >= 1201) currentSlidesToShow = slidesToShow.default
      else if (this.windowWidth >= 767) currentSlidesToShow = slidesToShow[1201]
      else if (this.windowWidth >= 500) currentSlidesToShow = slidesToShow[767]
      else currentSlidesToShow = slidesToShow[500]
      return booksCount > currentSlidesToShow
    }
  },
  mounted() {
    this.windowWidth = window.innerWidth
    window.addEventListener('resize', () => {
      this.windowWidth = window.innerWidth
    })
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
    display: block;
    left: 0;
    top: 0;
    bottom: 0;
    width: calc(100% / 6 - 27px);
    z-index: 1;
    background: #1D1D1D;
    -webkit-mask-image: -webkit-gradient(linear, left top, right top, from(rgba(0, 0, 0, 1)), to(rgb(0 0 0 / 0%)));

    &--reversed {
      left: auto;
      right: 0;
      -webkit-mask-image: -webkit-gradient(linear, right top, left top, from(rgba(0, 0, 0, 1)), to(rgb(0 0 0 / 0%)));
    }

    @media screen and (max-width: 767px) {
      &__overlay {
        width: calc(100% / 6 + 40px);
      }
    }

    @media screen and (max-width: 500px) {
      display: none;
    }
  }
}
</style>
