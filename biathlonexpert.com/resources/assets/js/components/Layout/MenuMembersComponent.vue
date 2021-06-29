<template>
  <div>
    <section class="members-menu">
      <div class="container">
        <div class="wrap">
          <div class="wrap-nav">
            <div class="btn-menu-open"
                 @click="menuOpen = !menuOpen">
              <span class="btn-menu-line"></span>
            </div>
            <div class="wrapMenu" :class="{'wrapMenuOpen': menuOpen}">
              <ul class="menuList">
                <li class="menuList__item">
                  <a :href="routes.dashboard" class="menuList__item-link" :class="{active:textSlideDashboard}">
                    <div class="text-slide__text">{{ this.vocab[this.locale].dashboard }}</div>
                  </a>
                </li>
                <li class="menuList__item">
                  <a :href="routes.indexBook" class="menuList__item-link" :class="{active:textSlideIndexBook}">
                    <div class="text-slide__text">{{ this.vocab[this.locale].ebooks }}</div>
                  </a>
                </li>
                <li class="menuList__item">
                  <a :href="routes.manage" class="menuList__item-link" :class="{active:textSlideManage}">
                    <div class="text-slide__text" v-html="this.vocab[this.locale].manage"></div>
                  </a>
                </li>
                <li class="menuList__item">
                  <a :href="routes.logout" class="menuList__item-link">
                    <div class="text-slide__text">{{ this.vocab[this.locale].logout }}</div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="members-block">
            <div class="members-block__members-info">
              <div class="members-block__weather">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 0C5.3828 0 0 5.3828 0 12C0 18.6172 5.3828 24 12 24C18.6172 24 24 18.6172 24 12C24 5.3828 18.6172 0 12 0Z"
                        fill="white"/>
                  <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M13.3939 5.52655C13.2533 5.52655 13.1395 5.41263 13.1395 5.27212V4.25442C13.1395 4.11392 13.2533 4 13.3939 4C13.5344 4 13.6483 4.11392 13.6483 4.25442V5.27212C13.6483 5.41263 13.5344 5.52655 13.3939 5.52655ZM17.21 10.106C17.21 12.2136 15.5014 13.9223 13.3937 13.9223C11.2858 13.9223 9.57729 12.2136 9.57729 10.106C9.57729 7.99826 11.2858 6.28959 13.3937 6.28959C15.5014 6.28959 17.21 7.99826 17.21 10.106ZM18.2278 10.3606H19.2455C19.386 10.3606 19.4999 10.2467 19.4999 10.1062C19.4999 9.9657 19.386 9.85178 19.2455 9.85178H18.2278C18.0871 9.85178 17.9734 9.9657 17.9734 10.1062C17.9734 10.2467 18.0871 10.3606 18.2278 10.3606ZM9.83194 6.7986C9.76436 6.7986 9.69976 6.77176 9.65206 6.72406L8.63436 5.70636C8.56815 5.64251 8.54169 5.54784 8.56492 5.45889C8.58827 5.36995 8.65772 5.3005 8.74667 5.27727C8.83562 5.25391 8.93016 5.2805 8.99413 5.34659L10.0118 6.36429C10.0845 6.43709 10.1062 6.54653 10.0669 6.64157C10.0275 6.73661 9.93481 6.7986 9.83194 6.7986ZM16.721 6.64157C16.7604 6.73661 16.8531 6.7986 16.9561 6.7986C17.0236 6.7986 17.0883 6.77176 17.136 6.72406L18.1537 5.70636C18.2198 5.64251 18.2462 5.54784 18.223 5.45889C18.1998 5.36995 18.1302 5.3005 18.0412 5.27727C17.9523 5.25391 17.8578 5.2805 17.7939 5.34659L16.7762 6.36429C16.7034 6.43709 16.6817 6.54653 16.721 6.64157Z"
                        fill="#727171"/>
                  <path
                      d="M16.4469 13.4139C16.2608 13.4139 16.0751 13.4325 15.8927 13.4693C15.7552 12.7829 15.3106 12.1974 14.6863 11.8805C14.0622 11.5636 13.3271 11.5503 12.6918 11.8444C12.1169 10.2607 10.3669 9.443 8.78325 10.0179C7.19955 10.593 6.38187 12.3429 6.95681 13.9266C5.56952 13.9705 4.47368 15.1186 4.49443 16.5065C4.5153 17.8943 5.64518 19.009 7.03321 19.0112H16.4469C17.9925 19.0112 19.2456 17.7583 19.2456 16.2126C19.2456 14.6669 17.9925 13.4139 16.4469 13.4139Z"
                      fill="#1D1D1D"/>
                </svg>
                <span class="text"> {{ temperatureInCelsius(info.wind.deg)}}&deg;</span>
              </div>
              <div class="members-block__time">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 0C5.3828 0 0 5.3828 0 12C0 18.6172 5.3828 24 12 24C18.6172 24 24 18.6172 24 12C24 5.3828 18.6172 0 12 0ZM16.2756 14.1189L12.9294 11.6092V6.49691C12.9294 5.98288 12.5139 5.56738 11.9998 5.56738C11.4858 5.56738 11.0703 5.98288 11.0703 6.49691V12.074C11.0703 12.3668 11.2079 12.6429 11.4421 12.8176L15.1602 15.6062C15.3275 15.7317 15.5227 15.7921 15.7169 15.7921C16.0004 15.7921 16.2793 15.6647 16.4615 15.4193C16.7702 15.0094 16.6865 14.4266 16.2756 14.1189Z"
                        fill="#F0F0F0"/>
                </svg>
                <span>{{ this.time }}</span>
              </div>
            </div>

            <div class="members-block__profile">
              <a :href="routes.profile" class="members-block__profile-link"
                 :class="{active:textSlideProfile}">
                <span class="members-block__profile-name">{{ `${user.first_name} ${user.last_name}` }}</span>
                <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect width="56" height="56" rx="28" fill="#3E3E3E"/>
                  <path
                      d="M28.2119 40.208C25.8546 40.208 23.7239 39.6867 21.8199 38.644C19.9386 37.6013 18.4539 36.162 17.3659 34.326C16.3006 32.4673 15.7679 30.3933 15.7679 28.104C15.7679 25.8147 16.3006 23.752 17.3659 21.916C18.4539 20.0573 19.9499 18.6067 21.8539 17.564C23.7579 16.5213 25.8886 16 28.2459 16C30.0139 16 31.6459 16.2947 33.1419 16.884C34.6379 17.4733 35.9073 18.3347 36.9499 19.468L35.3519 21.066C33.4933 19.1847 31.1473 18.244 28.3139 18.244C26.4326 18.244 24.7213 18.6747 23.1799 19.536C21.6386 20.3973 20.4259 21.576 19.5419 23.072C18.6806 24.568 18.2499 26.2453 18.2499 28.104C18.2499 29.9627 18.6806 31.64 19.5419 33.136C20.4259 34.632 21.6386 35.8107 23.1799 36.672C24.7213 37.5333 26.4326 37.964 28.3139 37.964C31.1699 37.964 33.5159 37.012 35.3519 35.108L36.9499 36.706C35.9073 37.8393 34.6266 38.712 33.1079 39.324C31.6119 39.9133 29.9799 40.208 28.2119 40.208Z"
                      fill="white"/>
                </svg>
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
      vocab: {},
      time: '',
      info: 0,
    }
  },
    async mounted() {
      await fetch('https://api.openweathermap.org/data/2.5/weather?q=Zaporizhzhia,ua&appid=feb027b3faea87405a0cd6954a7dea30')
      .then(response => response.json())
      .then(json => this.info = json)

  },
  created() {
    setInterval(() => {  this.getTime();}, 0)
    this.vocab = vocab;
  },
  computed: {
    date() {
      //TODO make date like July, 14th of 2018
      return new Date().toLocaleDateString();
    },
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
    textSlideCoach() {
      return window.location == this.routes.coach;
    },

  },
  methods: {
    getTime() {
      this.time = new Date().toLocaleTimeString('uk-UA', {hour: 'numeric', minute: 'numeric'});
    },
    temperatureInCelsius(temp) {
      return Math.round((temp-32)*5/9);
    },
  }

}
</script>

<style lang="scss" scoped>

.members-menu {
  padding: 25px 0 80px;

  .wrap-nav {
    display: flex;
    align-items: center;
  }

  .wrap {
    display: grid;
    justify-content: space-between;
    grid-template-columns: repeat(2, 1fr);
  }

  .menuList {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    flex-wrap: wrap;
    font-size: 20px;

    &__item {
      margin-right: 20px;

      &:last-child {
        margin-right: 0;
      }
    }

    &__item-link {
      color: #F0F0F0;

      &:hover,
      &.active {
        color: #FF1212;
      }
    }
  }

  .members-block {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    flex-wrap: wrap;
    font-size: 20px;
    letter-spacing: 0.0015em;
    color: #F0F0F0;
    text-decoration: none;
    margin-right: 20px;

    &__members-info {
      display: flex;
      margin-right: 20px;
    }

    &__weather {
      margin-right: 20px;
    }

    &__time,
    &__weather {
      display: flex;
      align-items: center;

      svg {
        margin-right: 10px;
      }
    }

    &__profile {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-wrap: nowrap;
      font-size: 20px;
    }

    &__profile-link {
      color: #F0F0F0;
      display: contents;

      svg {
        margin-left: 5px;
        width: 40px;
        height: 40px;
      }

      &:hover,
      &.active {
        color: #FF1212;

        path {
          fill: red;
        }
      }
    }

  }

  .btn-menu-open {
    display: none;
    width: 35px;
    height: 35px;
    cursor: pointer;
    float: right;
    margin-top: 9px;
    margin-right: 15px;

    .btn-menu-line,
    &:before,
    &:after {
      border-radius: 3px;
      background: #fff;
      content: '';
      display: block;
      height: 3px;
      margin: 8px 0;
      width: 100%;
      transition: all .25s linear;
    }

  }

  .btn-menu-close {
    position: relative;
    width: 35px;
    height: 35px;
    cursor: pointer;
    float: right;
    margin-top: 9px;
    margin-right: 15px;

    &:before {
      position: absolute;
      top: 10px;
      left: 0;
      border-radius: 3px;
      background: #000;
      content: '';
      display: block;
      height: 3px;
      margin: 8px 0;
      width: 100%;
      transition: all .25s linear;
      transform: rotate(45deg);
    }

    &:after {
      position: absolute;
      top: 10px;
      right: 0;
      border-radius: 3px;
      background: #000;
      content: '';
      display: block;
      height: 3px;
      margin: 8px 0;
      width: 100%;
      transition: all .25s linear;
      transform: rotate(-45deg);
    }
  }

  @media screen and (max-width: 1200px) {
    .menuList {
      display: none;
    }
    .members-block {
      display: flex;
      flex-direction: column;

      &__members-info {
        margin-right: 0;
      }
    }
    .btn-menu-open {
      display: block;
    }
  }
}
</style>
