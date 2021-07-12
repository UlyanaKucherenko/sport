<template>
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
</template>

<script>
import {api} from "../../api";

export default {
name: "WeatherData",
  data() {
    return {
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
  methods: {
    getTime() {
      this.time = new Date().toLocaleTimeString('uk-UA', {hour: 'numeric', minute: 'numeric'});
    }
  }
}
</script>

<style scoped>

</style>