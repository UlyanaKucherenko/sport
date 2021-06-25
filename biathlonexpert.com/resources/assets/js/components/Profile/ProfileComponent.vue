<template>
  <section class="member-profile">
    <div class="container">
      <div class="member-profile__title">{{ this.vocab[this.locale].tab1 }}</div>
      <personal-form
          v-if="activeTab"
          :user="user"
          :data="data"
          :routes="routes"
          :locale="locale"
      ></personal-form>
      <!--                <body-form-->
      <!--                        v-else-->
      <!--                        :user="user"-->
      <!--                        :data="data"-->
      <!--                        :routes="routes"-->
      <!--                        :locale="locale"-->
      <!--                ></body-form>-->
    </div>
  </section>
</template>

<script>

import vocab from '../../translates/member_area/profile';
import personalForm from '../Assets/PersonalProfileForm';
import bodyForm from '../Assets/BodyProfileForm';


export default {
  name: "ProfileComponent",
  components: {
    personalForm,
    bodyForm
  },

  props: {
    user: {
      type: Object,
      require: true
    },
    data: {
      type: Array,
      require: true
    },
    routes: {
      type: Object,
      require: true
    },
    locale: {
      type: String,
      require: true
    }
  },
  data() {
    return {
      activeTab: true,
      vocab: {}
    }
  },
  created() {
    this.vocab = vocab;
  },

}
</script>

<style scoped>

</style>
