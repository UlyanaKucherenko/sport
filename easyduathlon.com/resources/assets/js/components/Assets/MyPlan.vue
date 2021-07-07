<template>
  <div class="my-plan">
    <div class="my-plan__container">
      <div class="my-plan__title member-title">My Plan</div>
      <div class="my-plan__content">
        <div class="my-plan__content-col">
          <span class="my-plan__text">Available Books:</span>
          <span class="my-plan__number">{{ availableBooks }}/{{ totalBooks }}</span>
        </div>
        <div class="my-plan__content-col">
          <span class="my-plan__text">End of Subscription:</span>
          <span class="my-plan__number">{{ expirationData }}</span>
        </div>
        <div class="my-plan__content-col">
          <span class="my-plan__text">Plan:</span>
          <span class="my-plan__number">{{ planName }}</span>
        </div>
      </div>
      <a
          v-if="btnName === 'Upgrade'"
          class="member-btn"
          href="/member_area/manage"
      >
        {{ btnName }}
      </a>
      <a
          v-else
          @click="showConfirm"
          class="member-btn member-btn--reverse"
      >
        {{ btnName }}
      </a>
    </div>

    <confirm
        :show-confirm="show_confirm"
        @closeConfirm="closeConfirm"
    ></confirm>

  </div>

</template>

<script>
import vocab from '../../translates/member_area/myplan';
import Confirm from "../Popup/PopupConfirm";

export default {
  name: "MyPlan",
  components: {Confirm},
  props: {
    locale: {
      type: String,
      require: true
    },
    routes: {
      type: Object,
      require: true
    },
    expirationData: {
      type: String,
      require: true
    },
    totalBooks: {
      type: Number,
      require: true
    },
    availableBooks: {
      type: Number,
      require: true
    },
    planName: {
      type: String,
      require: true
    },
    btnName: {
      type: String,
      default: "Upgrade"
    }
  },
  data() {
    return {
      vocab: vocab[this.locale],
      show_confirm: false,
    }
  },
  methods: {
    showConfirm() {
      this.show_confirm = true;
    },
    closeConfirm() {
      this.show_confirm = false;
    },
  }
}
</script>

<style lang="scss" scoped>
.my-plan {

  &__container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
    flex-wrap: wrap;
    width: 100%;
    color: white;
    padding-top: 50px;
    margin-bottom: 83px;
  }

  &__content {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    flex-wrap: wrap;
    margin-bottom: 32px;
  }

  &__content-col {
    margin-right: 48px;

    &:last-child {
      margin-right: 0;
    }
  }

  &__title {
    margin-bottom: 24px;
  }

  &__text {
    width: 100%;
    font-size: 24px;
    margin-bottom: 24px;
    color: #F0F0F0;
  }

  &__img {
    path {
      fill: var(--color-member-area);
    }
  }

  &__number {
    font-size: 24px;
    color: var(--color-member-area);
    text-align: right;
  }
}

@media screen and (max-width: 400px) {
  .my-plan {

    &__container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    &__content-col {
      margin-right: 0;
    }

    &__text,
    &__number{
      font-size: 18px;
      text-align: center;
    }
  }
}


</style>
