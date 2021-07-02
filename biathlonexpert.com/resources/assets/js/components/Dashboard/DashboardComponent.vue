<template>
  <section class="member-dashboard">
    <div class="container">
      <MyPlan
        :local="locale"
        :expirationData="expirationData"
        :totalBooks="totalBooks"
        :availableBooks="availableBooks"
        :planName="planName"
        btnName="Upgrade"
      />
    </div>
    <div class="dash-block">
      <RecentBooks
        :title="this.vocab[this.locale].books"
        :recent-books="recentBooks"
      ></RecentBooks>
    </div>
  </section>
</template>

<script>

import vocab from '../../translates/member_area/dashboard';
import RecentBooks from '../Assets/RecentBooks'
import MyPlan from "../Assets/MyPlan";


export default {
  name: "DashboardComponent",
  props: {
    totalBooks: {
      type: Number,
      require: true
    },
    availableBooks: {
      type: Number,
      require: true
    },
    previewBooks: {
      type: Array,
      require: true
    },
    expirationData: {
      type: String,
      require: true
    },
    locale: {
      type: String,
      require: true
    },
    recentBooks: {},
    topBook: {},
    planTexts: {},
    plans: {},
    user: {},
  },
  components: {MyPlan, RecentBooks},
  data() {
    return {
      info: null,
      vocab: {},
      sliderBooks: [
        {
          src: '/img/book1.png',
          desc: 'Before You Deliver'
        },
        {
          src: '/img/book2.png',
          desc: 'The Impatient Woman\'s Guide to Getting Pregnant'
        },
        {
          src: '/img/book3.png',
          desc: 'Mom Life: A Snarky Adult Coloring Book'
        },
        {
          src: '/img/book1.png',
          desc: 'Before You Deliver'
        },
        {
          src: '/img/book2.png',
          desc: 'The Impatient Woman\'s Guide to Getting Pregnant'
        },
        {
          src: '/img/book3.png',
          desc: 'Mom Life: A Snarky Adult Coloring Book'
        }
      ],
      btnUpgrade: "Upgrade",

    }
  },
  mounted() {
    this.btnUpgrade = this.vocab[this.locale].upgrade;
  },

  computed: {
    planName() {
      return this.plans[this.currentPlan].slug;
    },
    },
  created() {
    this.vocab = vocab;
    this.currentPlan = this.user.plan_id - 1;
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
        this.$refs.slick.reSlick();
      });
    },
  }
}
</script>

<style lang="scss" scoped>
.imgEbooks img {
  width: 100%;
}

</style>
