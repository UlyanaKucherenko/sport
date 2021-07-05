<template>
  <button class="x-button" :class="[type]" @click="$emit('click')">
        <span class="x-button__text">
            <slot />
        </span>
  </button>
</template>

<script>
export default {
name: "XButton",
  props: {
    type: {
      validator(value){
        return ['primary','upgrade'].indexOf(value) !== -1;
      },
      default: "primary",
    },
    icon: {
      type: String,
    },
    spin: {
      type: Boolean,
      default: false
    }
  },
}
</script>

<style lang="scss">
.x-button {
  background-color: #C7A17A;
  border-radius: 19px;
  border: none;
  outline: none;
  color: white;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 46px;
  padding: 0 24px;
  cursor: pointer;
  transition: .2s ease;

  &:hover {
    background-color: lighten(#C7A17A, 10%);
  }
  &:active {
    background-color: darken(#C7A17A, 10%);
  }
}


</style>