<template>
  <div>
    <section class="membersMenu">
      <div class="container">
        <div class="" :class="{'btn-menu-close': menuOpen, 'btn-menu-open': !menuOpen}"
             @click="menuOpen = !menuOpen">
          <span class="btn-menu-line"></span>
        </div>
        <div class="wrapMenu" :class="{'wrapMenuOpen': menuOpen}">
          <ul class="menuList">
            <li><a :href="routes.dashboard" class="menuList__link" :class="{active:textSlideDashboard}">
              {{ vocab.dashboard }}
            </a></li>
            <li><a :href="routes.indexBook" class="menuList__link" :class="{active:textSlideIndexBook}">
             {{ vocab.ebooks }}
            </a></li>
            <li><a :href="routes.manage" class="menuList__link" :class="{active:textSlideManage}">
              <div v-html="vocab.manage"></div>
            </a></li>
            <li><a :href="routes.logout" class="menuList__link">
              <div v-html="vocab.logout"></div>
            </a></li>
          </ul>

          <div class="menu-profile">
            <div class="menu-profile__info">
              <div class="menu-profile__weather">
                <img :src="'http://openweathermap.org/img/w/' + iconWeather + '.png' "/>
                <span class="text"> {{ Math.round(temp) }}&deg;</span>
              </div>
              <div class="menu-profile__time">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 0C5.3828 0 0 5.3828 0 12C0 18.6172 5.3828 24 12 24C18.6172 24 24 18.6172 24 12C24 5.3828 18.6172 0 12 0ZM16.2756 14.1189L12.9294 11.6092V6.49691C12.9294 5.98288 12.5139 5.56738 11.9998 5.56738C11.4858 5.56738 11.0703 5.98288 11.0703 6.49691V12.074C11.0703 12.3668 11.2079 12.6429 11.4421 12.8176L15.1602 15.6062C15.3275 15.7317 15.5227 15.7921 15.7169 15.7921C16.0004 15.7921 16.2793 15.6647 16.4615 15.4193C16.7702 15.0094 16.6865 14.4266 16.2756 14.1189Z"
                        fill="#F0F0F0"/>
                </svg>
                <span>{{ time }}</span>
              </div>
            </div>

            <div class="menu-profile__profile">
              <a :href="routes.profile" class="menu-profile__link"
                 :class="{active:textSlideProfile}">
                <div class="menu-profile__name">{{ `${user.first_name} ${user.last_name}` }}</div>
                <div class="menu-profile__photo">
                  <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="56" height="56" rx="28" fill="#3E3E3E"/>
                    <path
                        d="M28.2119 40.208C25.8546 40.208 23.7239 39.6867 21.8199 38.644C19.9386 37.6013 18.4539 36.162 17.3659 34.326C16.3006 32.4673 15.7679 30.3933 15.7679 28.104C15.7679 25.8147 16.3006 23.752 17.3659 21.916C18.4539 20.0573 19.9499 18.6067 21.8539 17.564C23.7579 16.5213 25.8886 16 28.2459 16C30.0139 16 31.6459 16.2947 33.1419 16.884C34.6379 17.4733 35.9073 18.3347 36.9499 19.468L35.3519 21.066C33.4933 19.1847 31.1473 18.244 28.3139 18.244C26.4326 18.244 24.7213 18.6747 23.1799 19.536C21.6386 20.3973 20.4259 21.576 19.5419 23.072C18.6806 24.568 18.2499 26.2453 18.2499 28.104C18.2499 29.9627 18.6806 31.64 19.5419 33.136C20.4259 34.632 21.6386 35.8107 23.1799 36.672C24.7213 37.5333 26.4326 37.964 28.3139 37.964C31.1699 37.964 33.5159 37.012 35.3519 35.108L36.9499 36.706C35.9073 37.8393 34.6266 38.712 33.1079 39.324C31.6119 39.9133 29.9799 40.208 28.2119 40.208Z"
                        fill="white"/>
                  </svg>
                </div>
              </a>
            </div>

          </div>
        </div>
      </div>
    </section>

  </div>

</template>

<script>

import vocab from '../../translates/member_area/menu_members';
import {api} from '../../api';

export default {
  name: "MenuMembersComponent",
  components: {},
  props: {
    routes: {
      type: Object,
      require: true
    },
    locale: {
      type: String,
      require: true
    },
    user: {},
  },
  data() {
    return {
      menuOpen: false,
      vocab: vocab[this.locale],
      time: '',
      info: 0,
      temp: 0,
      iconWeather: ''
    }
  },
  async mounted() {
    const weatherRes = await api.getWeather()
    this.temp = weatherRes.main.temp
    this.iconWeather = weatherRes.weather[0].icon
  },
  created() {
    setInterval(() => {
      this.getTime();
    }, 0)
  },
  computed: {
    textSlideDashboard() {
      return window.location == this.routes.dashboard;
    },
    textSlideIndexBook() {
      return window.location == this.routes.indexBook;
    },
    textSlideManage() {
      return window.location == this.routes.manage;
    },
    textSlideProfile() {
      return window.location == this.routes.profile;
    },

  },
  methods: {
    getTime() {
      this.time = new Date().toLocaleTimeString('uk-UA', {hour: 'numeric', minute: 'numeric'});
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
